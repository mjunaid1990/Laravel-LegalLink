<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use Illuminate\Support\Facades\Validator;
use Auth;

class PromotionsController extends Controller {

    public function index(Request $request) {
        
        $title = 'Promotions';
        
        $q = $request->get('q') ? $request->get('q') : '';
        $sort = $request->get('sort') ? $request->get('sort') : '';

        $lists = Promotion::when(!empty($q), function ($query) use ($q) {
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

        return view('admin/promotions/index', compact('title', 'lists', 'q', 'sort'))->render();
    }

    public function create() {
        $title = 'Add Promotion';

        $html = view('admin/promotions/form', compact('title'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request) {

        $validate = Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'discount' => ['required']
        ]);

        if ($validate->fails()) {
            return response()->json(array('success' => false, 'errors' => ErrorsHtml($validate->errors())));
        }

        $model = new Promotion();


        $model->added_from = Auth::user()->id;
        $model->name = $request->input('name') ? $request->input('name') : null;
        $model->discount = $request->input('discount') ? $request->input('discount') : null;
        $model->description = $request->input('description') ? nl2br($request->input('description')) : null;
        $model->status = $request->input('status') ? $request->input('status') : null;

        if ($model->save()) {
            
            return response()->json(array('success' => true, 'message' => 'Promotion is saved successfully.'));
        }

        return response()->json(array('success' => false, 'message' => 'Something went wrong!'));
    }

    public function edit($id) {
        $title = 'Edit Promotion';
        $model = Promotion::where('id', '=', $id)->first();
        $html = view('admin/promotions/form', compact('title', 'model'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function update(Request $request, $id) {

        $model = Promotion::where('id', '=', $id)->first();

        $model->name = $request->input('name') ? $request->input('name') : null;
        $model->discount = $request->input('discount') ? $request->input('discount') : null;
        $model->description = $request->input('description') ? nl2br($request->input('description')) : null;
        $model->status = $request->input('status') ? $request->input('status') : null;

        if ($model->save()) {
            return response()->json(array('success' => true, 'message' => 'Promotion is saved successfully.'));
        }
        return response()->json(array('success' => true, 'message' => 'Something went wrong!'));
    }

    public function delete(Request $request, $id) {
        $model = Promotion::where('id', '=', $id)->first();
        if ($model) {
            $model->delete();
        }
        $request->session()->flash('message', 'Promotion is deleted successfully');
        return redirect('/admin/promotions');
    }

}
