<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agreements;
use App\Models\Categories;
use App\Models\Promotion;
use App\Models\CustomFields;
use App\Models\AssignCustomFields;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\HTML;
use PhpOffice\PhpWord\Settings;
use DOMDocument;
use Auth;

class AgreementsController extends Controller {

    public function index(Request $request) {
        
        $title = 'Agreements';
        
        $q = $request->get('q') ? $request->get('q') : '';
        $sort = $request->get('sort') ? $request->get('sort') : '';

        $lists = Agreements::when(!empty($q), function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%");
                    $query->orWhere('description', 'like', "%{$q}%");
                })
                ->when(!empty($sort), function ($query) use ($sort) {
                    if ($sort == 'asc') {
                        $query->orderBy('id', "asc");
                    } else if ($sort == 'desc') {
                        $query->orderBy('id', "desc");
                    }
                })
                ->when(empty($sort), function ($query) use ($sort) {
                    $query->orderBy('id', "desc");
                })
                ->paginate(12);

        return view('admin/agreements/index', compact('title', 'lists', 'q', 'sort'))->render();
    }

    public function create() {
        $title = 'Add Agreement';
        $categories = Categories::all();
        $promotions = Promotion::all();
        $html = view('admin/agreements/form', compact('title','categories', 'promotions'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request) {

        $validate = Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255']
        ]);

        if ($validate->fails()) {
            return response()->json(array('success' => false, 'errors' => ErrorsHtml($validate->errors())));
        }

        $model = new Agreements();

        $file = $request->file('image');
        if ($file) {
            $fileName = time() . '.' . $request->image->extension();
        }
        $model->added_from = Auth::user()->id;
        $model->name = $request->input('name') ? $request->input('name') : null;
        $model->slug = $request->input('name') ? $model->createSlug($request->input('name')) : null;
        $model->category_id = $request->input('category_id') ? $request->input('category_id') : null;
        $model->language = $request->input('language') ? $request->input('language') : null;
        $model->page_count = $request->input('page_count') ? $request->input('page_count') : null;
        $model->status = $request->input('status') ? $request->input('status') : null;
        $model->date = $request->input('date') ? $request->input('date') : null;
        $model->description = $request->input('description') ? $request->input('description') : null;
        $model->regular_price = $request->input('regular_price') ? $request->input('regular_price') : null;
        $model->sale_price = $request->input('sale_price') ? $request->input('sale_price') : null;
        $model->promotion_id = $request->input('promotion_id') ? $request->input('promotion_id') : null;
        $model->is_featured = $request->input('is_featured') ? $request->input('is_featured') : null;
        $model->is_recomended = $request->input('is_recomended') ? $request->input('is_recomended') : null;
        
        $model->tags = $request->input('tags') ? $request->input('tags') : null;
        
        $model->image = isset($fileName) ? $fileName : null;
        
        if ($model->save()) {
            if ($file) {
                $storage_path = public_path('uploads/agreements/'.$model->id.'/');
                if(!File::exists($storage_path)) {
                    File::makeDirectory($storage_path, 0775, true, true);
                }
                $request->image->move($storage_path, $fileName);
            }
            return response()->json(array('success' => true, 'message' => 'Agreement is saved successfully.', 'id'=>$model->id));
        }

        return response()->json(array('success' => false, 'message' => 'Something went wrong!'));
    }

    public function edit($id) {
        $title = 'Edit Agreement';
        $model = Agreements::where('id', '=', $id)->first();
        $categories = Categories::all();
        $promotions = Promotion::all();
        $html = view('admin/agreements/form', compact('title', 'model', 'categories', 'promotions'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function update(Request $request, $id) {

        $model = Agreements::where('id', '=', $id)->first();

        $file = $request->file('image');
        if ($file) {
            $fileName = time() . '.' . $request->image->extension();
        }
        $model->name = $request->input('name') ? $request->input('name') : null;
        $model->category_id = $request->input('category_id') ? $request->input('category_id') : null;
        $model->language = $request->input('language') ? $request->input('language') : null;
        $model->page_count = $request->input('page_count') ? $request->input('page_count') : null;
        $model->status = $request->input('status') ? $request->input('status') : null;
        $model->date = $request->input('date') ? $request->input('date') : null;
        $model->description = $request->input('description') ? $request->input('description') : null;
        $model->regular_price = $request->input('regular_price') ? $request->input('regular_price') : null;
        $model->sale_price = $request->input('sale_price') ? $request->input('sale_price') : null;
        $model->promotion_id = $request->input('promotion_id') ? $request->input('promotion_id') : null;
        $model->is_featured = $request->input('is_featured') ? $request->input('is_featured') : null;
        $model->is_recomended = $request->input('is_recomended') ? $request->input('is_recomended') : null;
        
        $model->tags = $request->input('tags') ? $request->input('tags') : null;
        $model->image = isset($fileName) ? $fileName : $model->image;

        if ($model->save()) {
            $storage_path = public_path('uploads/agreements/'.$model->id.'/');
            
            if ($file && $model->image) {
                $oldfile = $storage_path . $model->image;
                if (file_exists($oldfile)) {
                    unlink($oldfile);
                    unlink($storage_path);
                }
            }
            if ($file) {
                if(!File::exists($storage_path)) {
                    File::makeDirectory($storage_path, 0775, true, true);
                }
                $request->image->move($storage_path, $fileName);
            }
            
            return response()->json(array('success' => true, 'message' => 'Agreement is saved successfully.'));
        }
        return response()->json(array('success' => true, 'message' => 'Something went wrong!'));
    }
    
    
    public function add_inputs(Request $request, $id) {
        $title = 'Agreement Input';
        $agreement = Agreements::where('id', '=', $id)->first();
        $fields = CustomFields::all();
        $html = view('admin/agreements/inputs', compact('title','id', 'fields', 'agreement'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }
    
    public function agreement_append_input($id) {
        $field = CustomFields::where('id', $id)->first();
        $html = view('_partials/_input_list', compact('field'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }
    
    public function save_inputs(Request $request, $id) {
        $data = $request->all();

        $model = Agreements::where('id', '=', $id)->first();
        $success = false;
        if($model) {
            if($model->added_from != Auth::user()->id) {
                return response()->json(array('success' => false, 'message'=> 'Invalid user!'));
            }
            if($data['text']) {
                $model->agreement_text = $data['text'];
                $model->save();
            }
            if($data['fields']) {
                AssignCustomFields::where('agreement_id', $id)->delete();
                foreach ($data['fields'] as $field) {
                    $custom = new AssignCustomFields();
                    $custom->agreement_id = $id;
                    $custom->custom_field_id = $field;
                    $custom->save();
                }
            }
            $success = true;
        }

        return response()->json(array('success' => $success, 'message'=> 'Agreement inputs saved successfully!'));
    }

    public function delete(Request $request, $id) {
        $model = Agreements::where('id', '=', $id)->first();
        if ($model) {
            $storage_path = '/storage/agreements/' . $model->id . '/';
            if ($model->image) {
                $oldfile = $storage_path . $model->image;
                if (file_exists($oldfile)) {
                    unlink($oldfile);
                    unlink($storage_path);
                }
            }
            $model->delete();
        }
        $request->session()->flash('message', 'Agreement is deleted successfully');
        return redirect('/admin/agreements');
    }
    
    public function import_doc(Request $request) {
        $request->validate([
            'file' => 'required',
        ]);
        $rand = rand(1111, 9999);
        
        $file = $request->file('file');
        $tmpFilePath = $file->getRealPath();
        $filename = 'agreement-'.$rand.'.php';
        $filepath = public_path().'/'.$filename;
//        $sp = public_path('dummy-file.docx');

        Settings::setOutputEscapingEnabled(true);
        
        $phpWord = IOFactory::load($tmpFilePath);
        
        $htmlWriter = new HTML($phpWord);
        $htmlFilePath = $filepath;
        $htmlWriter->save($htmlFilePath);
        
        $file = file_get_contents($filepath);
        $dom = new \DOMDocument;
        libxml_use_internal_errors(true); // Suppress HTML5 parsing errors
        
        $dom->loadHTML($file);
        $htmlElement = $dom->getElementsByTagName('html')->item(0);
        // Find the <body> tag and get its content
        $bodyContent = '';
        foreach ($htmlElement->getElementsByTagName('body')->item(0)->childNodes as $child) {
            $bodyContent .= $dom->saveHTML($child);
        }
        if(file_exists($filepath)) {
            unlink($filepath);
        }

        return response()->json(['html' => $bodyContent]);
    }

}
