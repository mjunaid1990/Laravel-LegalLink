<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\BlogCategories;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Auth;

class BlogsController extends Controller {

    public function index(Request $request) {
        
        $title = 'Blogs';
        
        $q = $request->get('q') ? $request->get('q') : '';
        $sort = $request->get('sort') ? $request->get('sort') : '';

        $lists = Blogs::when(!empty($q), function ($query) use ($q) {
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

        return view('admin/blogs/index', compact('title', 'lists', 'q', 'sort'))->render();
    }

    public function create() {
        $title = 'Add Blog';
        $categories = BlogCategories::all();
        $html = view('admin/blogs/form', compact('title', 'categories'))->render();
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

        $model = new Blogs();

        $file = $request->file('image');
        if ($file) {
            $fileName = time() . '.' . $request->image->extension();
        }
        $model->added_from = Auth::user()->id;
        $model->name = $request->input('name') ? $request->input('name') : null;
        $model->slug = $request->input('name') ? $model->createSlug($request->input('name')) : null;
        $model->category_id = $request->input('category_id') ? $request->input('category_id') : null;
        $model->description = $request->input('description') ? nl2br($request->input('description')) : null;
        $model->image = isset($fileName) ? $fileName : null;
        $model->status = $request->input('status') ? $request->input('status') : null;

        if ($model->save()) {
            if ($file) {
                $storage_path = public_path('uploads/blogs/'.$model->id.'/');
                if(!File::exists($storage_path)) {
                    File::makeDirectory($storage_path, 0775, true, true);
                }
                $request->image->move($storage_path, $fileName);
            }
            return response()->json(array('success' => true, 'message' => 'Blog is saved successfully.'));
        }

        return response()->json(array('success' => false, 'message' => 'Something went wrong!'));
    }

    public function edit($id) {
        $title = 'Edit Blog';
        $model = Blogs::where('id', '=', $id)->first();
        $categories = BlogCategories::all();
        $html = view('admin/blogs/form', compact('title', 'model', 'categories'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function update(Request $request, $id) {

        $model = Blogs::where('id', '=', $id)->first();

        $file = $request->file('image');
        if ($file) {
            $fileName = time() . '.' . $request->image->extension();
        }
        $model->name = $request->input('name') ? $request->input('name') : null;
        $model->description = $request->input('description') ? nl2br($request->input('description')) : null;
        $model->category_id = $request->input('category_id') ? $request->input('category_id') : null;
        $model->image = isset($fileName) ? $fileName : $model->image;
        $model->status = $request->input('status') ? $request->input('status') : null;

        if ($model->save()) {
            $storage_path = public_path('uploads/blogs/'.$model->id.'/');
            
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
            
            return response()->json(array('success' => true, 'message' => 'Blog is saved successfully.'));
        }
        return response()->json(array('success' => true, 'message' => 'Something went wrong!'));
    }

    public function delete(Request $request, $id) {
        $model = Blogs::where('id', '=', $id)->first();
        if ($model) {
            $storage_path = '/storage/blogs/' . $model->id . '/';
            if ($model->image) {
                $oldfile = $storage_path . $model->image;
                if (file_exists($oldfile)) {
                    unlink($oldfile);
                    unlink($storage_path);
                }
            }
            $model->delete();
        }
        $request->session()->flash('message', 'Blog is deleted successfully');
        return redirect('/admin/blogs');
    }

}
