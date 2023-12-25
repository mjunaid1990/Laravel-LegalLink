<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agreements;
use App\Models\AgreementsPurchased;
use App\Models\AssignCustomFields;
use App\Models\CustomFieldValues;
use App\Models\CustomFields;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Auth;
use Dompdf\Options;

class UserController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $title = 'Dashboard';
        $purchased_agreements = AgreementsPurchased::addedFrom()->orderBy('id', 'desc')->limit(5)->get();
        return view('user/index', compact('title', 'purchased_agreements'));
    }

    public function agreements() {
        $products = AgreementsPurchased::addedFrom()->orderBy('id', 'desc')->paginate(12);
        return view('user/agreements', compact('products'));
    }

    public function generate_agreement(Request $request, $id) {
        $purchased = AgreementsPurchased::addedFrom()->where('agreement_id', $id)->where('status', 'pending')->first();
        if (!$purchased) {
            return abort(404);
        }

        if ($request->method() == 'POST') {
            $data = $request->all();
            if ($data['custom_fields']) {
                foreach ($data['custom_fields'] as $fieldid => $field) {
                    $model = new CustomFieldValues();
                    $model->purchase_id = $purchased->id;
                    $model->agreement_id = $id;
                    $model->custom_field_id = $fieldid;
                    $model->field_value = $field['value'] ? $field['value'] : null;
                    $model->save();
                }

                $purchased->status = 'completed';
                $purchased->save();
                return redirect('/user/agreement/view/' . $id);
            }
        }

        $agreement = Agreements::where('id', $purchased->agreement_id)->first();
        $fields = AssignCustomFields::where('agreement_id', $agreement->id)->get();
        return view('user/generate-agreement', compact('agreement', 'fields', 'id'));
    }

    public function agreement_view($id) {
        $purchased = AgreementsPurchased::addedFrom()->where('agreement_id', $id)->where('status', 'completed')->first();
        if (!$purchased) {
            return abort(404);
        }
        return view('user/agreement-view', compact('purchased'));
    }

    public function download_agreement(Request $request, $id) {

        $purchased = AgreementsPurchased::addedFrom()->where('id', $id)->where('status', 'completed')->first();
        if (!$purchased) {
            return abort(404);
        }
        $mergefields = [];
        $custom_fields_values = CustomFieldValues::where('purchase_id', $purchased->id)->get();
        if ($custom_fields_values) {
            foreach ($custom_fields_values as $cf) {
                $customfield = CustomFields::where('id', $cf->custom_field_id)->first();
                if ($customfield) {
                    $mergefields[$customfield->document_name] = $cf->field_value;
                }
            }
        }
        $content = _parse_agreement_template_variables($purchased->agreement->agreement_text, $mergefields);

        $data = $request->all();
        $filename = str_replace(' ', '-', $purchased->agreement->name).'-'.date('d-m-Y');
        if ($data['type'] == 'word') {

            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $section = $phpWord->addSection();
            $html = strip_word_html($content);

            \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);
            $documentProtection = $phpWord->getSettings()->getDocumentProtection();
            $documentProtection->setPassword('EIAxHGh6G61Q4jx');
            $documentProtection->setEditing(\PhpOffice\PhpWord\SimpleType\DocProtect::READ_ONLY);
            
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $filename_ = $filename.'.docx';
            $objWriter->save($filename_);
            return response()->download(public_path($filename_));
        } else if ($data['type'] == 'pdf') {
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);
            $pdf = PDF::loadView('user/_pdf', ['content' => $content]);
//            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            $pdf->getDomPDF()->getCanvas()->get_cpdf()->setEncryption('', '', [
                    'print' => true, // Allow printing
                    'copy' => true, // Allow copying
                    'modify' => false, // Disallow modification
                    'annot-forms' => false, // Disallow form field modification
                ]);
            $filename = $filename.'.pdf';
            return $pdf->stream($filename);
        }
    }
    
    protected function protectPDFWithPassword($pdfContent, $password)
{
    // Create a new FPDI instance for importing the PDF
    $pdf = new FPDI();
    $pageCount = $pdf->setSourceData($pdfContent);

    // Set a password for the imported PDF
    $pdf->SetProtection(['copy', 'print'], $password, $password);

    // Import all pages from the source PDF
    for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
        $templateIndex = $pdf->importPage($pageNumber);
        $pdf->AddPage();
        $pdf->useTemplate($templateIndex);
    }

    // Output the protected PDF content
    ob_start();
    $pdf->Output();
    $protectedPdfContent = ob_get_clean();

    return $protectedPdfContent;
}
    
    public function profile(Request $request) {
        $model = User::where('id', Auth::user()->id)->first();
        if($request->method() == 'POST') {
            $model->firstname = $request->input('firstname');
            $model->lastname = $request->input('lastname')?$request->input('lastname'):null;
            $model->phone = $request->input('phone')?$request->input('phone'):null;
            if($request->input('password')) {
                $model->password = Hash::make($request->input('password'));
            }
            $model->save();
            $request->session()->flash('message', 'Profile saved successfully!');
            return redirect('/user/profile');
        }
        return view('user/profile', compact('model'));
    }

}
