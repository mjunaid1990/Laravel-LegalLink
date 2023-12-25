<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomFields;
use Illuminate\Support\Facades\Validator;
use Auth;

class CustomFieldsController extends Controller {

    public function index(Request $request) {
        
        $title = 'Agreement Inputs';
        
        $q = $request->get('q') ? $request->get('q') : '';
        $sort = $request->get('sort') ? $request->get('sort') : '';

        $lists = CustomFields::when(!empty($q), function ($query) use ($q) {
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

        return view('admin/customfields/index', compact('title', 'lists', 'q', 'sort'))->render();
    }
    
    public function create_ajax() {
        $html = view('_partials/_inputs_crud')->render();
        return response()->json(array('success' => true, 'html' => $html));
    }
    

    public function create() {
        $title = 'Add Agreement Inputs';

        $html = view('admin/customfields/form', compact('title'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request) {

        $validate = Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:300'],
            'document_name' => ['required', 'string', 'max:300'],
            'field_type' => ['required']
        ]);

        if ($validate->fails()) {
            return response()->json(array('success' => false, 'errors' => ErrorsHtml($validate->errors())));
        }

        $model = new CustomFields();


        $model->added_from = Auth::user()->id;
        $model->name = $request->input('name') ? $request->input('name') : null;
        $model->document_name = $request->input('document_name') ? $request->input('document_name') : null;
        $model->description = $request->input('description') ? nl2br($request->input('description')) : null;
        $model->field_type = $request->input('field_type') ? $request->input('field_type') : null;
        $model->field_options = $request->input('field_options') ? $request->input('field_options') : null;

        if ($model->save()) {
            
            return response()->json(array('success' => true, 'message' => 'Agreement input is saved successfully.', 'id'=>$model->id));
        }

        return response()->json(array('success' => false, 'message' => 'Something went wrong!'));
    }
    
    public function edit_ajax($id) {
        $model = CustomFields::where('id', '=', $id)->first();
        $html = view('_partials/_inputs_crud', compact('model'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function edit($id) {
        $title = 'Edit Promotion';
        $model = Promotion::where('id', '=', $id)->first();
        $html = view('admin/promotions/form', compact('title', 'model'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function update(Request $request, $id) {

        $validate = Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:300'],
            'document_name' => ['required', 'string', 'max:300'],
            'field_type' => ['required']
        ]);
        
        if ($validate->fails()) {
            return response()->json(array('success' => false, 'errors' => ErrorsHtml($validate->errors())));
        }
        
        $model = CustomFields::where('id', '=', $id)->first();

        $model->name = $request->input('name') ? $request->input('name') : null;
        $model->document_name = $request->input('document_name') ? $request->input('document_name') : null;
        $model->description = $request->input('description') ? nl2br($request->input('description')) : null;
        $model->field_type = $request->input('field_type') ? $request->input('field_type') : null;
        $model->field_options = $request->input('field_options') ? $request->input('field_options') : null;

        if ($model->save()) {
            return response()->json(array('success' => true, 'message' => 'Agreement input is saved successfully.', 'new'=>1));
        }
        return response()->json(array('success' => true, 'message' => 'Something went wrong!'));
    }

    public function delete(Request $request, $id) {
        $model = CustomFields::where('id', '=', $id)->first();
        if ($model) {
            $model->delete();
            
        }
        $request->session()->flash('message', 'Agreement input is deleted successfully');
        return redirect('/admin/customfields');
    }
    
    public function delete_ajax($id) {
        $model = CustomFields::where('id', '=', $id)->first();
        if ($model && $model->added_from == Auth::user()->id) {
            $model->delete();
            return response()->json(array('success' => true));
        }
        return response()->json(array('success' => false));
    }

}
