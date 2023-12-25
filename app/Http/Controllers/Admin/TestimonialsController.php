<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonials;
use Illuminate\Support\Facades\Validator;
use Auth;

class TestimonialsController extends Controller {

    public function index(Request $request) {
        
        $title = 'Testimonials';
        
        $q = $request->get('q') ? $request->get('q') : '';
        $sort = $request->get('sort') ? $request->get('sort') : '';

        $lists = Testimonials::when(!empty($q), function ($query) use ($q) {
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

        return view('admin/testimonials/index', compact('title', 'lists', 'q', 'sort'))->render();
    }

    public function create() {
        $title = 'Add Testimonials';

        $html = view('admin/testimonials/form', compact('title'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request) {

        $validate = Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'description' => ['required']
        ]);

        if ($validate->fails()) {
            return response()->json(array('success' => false, 'errors' => ErrorsHtml($validate->errors())));
        }

        $model = new Testimonials();

        $model->name = $request->input('name') ? $request->input('name') : null;
        $model->company = $request->input('company') ? $request->input('company') : null;
        $model->description = $request->input('description') ? $request->input('description') : null;
        $model->rate = $request->input('rate') ? $request->input('rate') : null;

        if ($model->save()) {
            
            return response()->json(array('success' => true, 'message' => 'Testimonial is saved successfully.'));
        }

        return response()->json(array('success' => false, 'message' => 'Something went wrong!'));
    }

    public function edit($id) {
        $title = 'Edit Testimonials';
        $model = Testimonials::where('id', '=', $id)->first();
        $html = view('admin/testimonials/form', compact('title', 'model'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function update(Request $request, $id) {

        $model = Testimonials::where('id', '=', $id)->first();

        $model->name = $request->input('name') ? $request->input('name') : null;
        $model->company = $request->input('company') ? $request->input('company') : null;
        $model->description = $request->input('description') ? $request->input('description') : null;
        $model->rate = $request->input('rate') ? $request->input('rate') : null;

        if ($model->save()) {
            return response()->json(array('success' => true, 'message' => 'Testimonial is saved successfully.'));
        }
        return response()->json(array('success' => true, 'message' => 'Something went wrong!'));
    }

    public function delete(Request $request, $id) {
        $model = Testimonials::where('id', '=', $id)->first();
        if ($model) {
            $model->delete();
        }
        $request->session()->flash('message', 'Testimonial is deleted successfully');
        return redirect('/admin/testimonials');
    }

}
