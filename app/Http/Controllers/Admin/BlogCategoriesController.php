<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategories;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Auth;

class BlogCategoriesController extends Controller {

    public function index(Request $request) {
        
        $title = 'Categories';
        
        $q = $request->get('q') ? $request->get('q') : '';
        $sort = $request->get('sort') ? $request->get('sort') : '';

        $lists = BlogCategories::when(!empty($q), function ($query) use ($q) {
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

        return view('admin/blog-categories/index', compact('title', 'lists', 'q', 'sort'))->render();
    }

    public function create() {
        $title = 'Add Category';

        $html = view('admin/blog-categories/form', compact('title'))->render();
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

        $model = new BlogCategories();

//        $file = $request->file('image');
//        if ($file) {
//            $fileName = time() . '.' . $request->image->extension();
//        }
        $model->added_from = Auth::user()->id;
        $model->name = $request->input('name') ? $request->input('name') : null;
        $model->slug = $request->input('name') ? $model->createSlug($request->input('name')) : null;
        $model->description = $request->input('description') ? nl2br($request->input('description')) : null;
//        $model->image = isset($fileName) ? $fileName : null;
        $model->status = $request->input('status') ? $request->input('status') : null;

        if ($model->save()) {
//            if ($file) {
//                $storage_path = public_path('uploads/categories/'.$model->id.'/');
//                if(!File::exists($storage_path)) {
//                    File::makeDirectory($storage_path, 0775, true, true);
//                }
//                $request->image->move($storage_path, $fileName);
//            }

            return response()->json(array('success' => true, 'message' => 'Category is saved successfully.', 'categories'=> $this->categories_options()));
        }

        return response()->json(array('success' => false, 'message' => 'Something went wrong!'));
    }

    public function edit($id) {
        $title = 'Edit Category';
        $model = BlogCategories::where('id', '=', $id)->first();
        $html = view('admin/blog-categories/form', compact('title', 'model'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function update(Request $request, $id) {

        $model = BlogCategories::where('id', '=', $id)->first();

//        $file = $request->file('image');
//        if ($file) {
//            $fileName = time() . '.' . $request->image->extension();
//        }
        $model->name = $request->input('name') ? $request->input('name') : null;
        $model->description = $request->input('description') ? nl2br($request->input('description')) : null;
//        $model->tag_color = $request->input('tag_color') ? $request->input('tag_color') : null;
//        $model->image = isset($fileName) ? $fileName : $model->image;
        $model->status = $request->input('status') ? $request->input('status') : null;

        if ($model->save()) {
//            $storage_path = public_path('uploads/categories/'.$model->id.'/');
            
//            if ($file && $model->image) {
//                $oldfile = $storage_path . $model->image;
//                if (file_exists($oldfile)) {
//                    unlink($oldfile);
//                    unlink($storage_path);
//                }
//            }
//            if ($file) {
//                if(!File::exists($storage_path)) {
//                    File::makeDirectory($storage_path, 0775, true, true);
//                }
//                $request->image->move($storage_path, $fileName);
//            }

            return response()->json(array('success' => true, 'message' => 'Category is saved successfully.', 'categories'=> $this->categories_options()));
        }
        return response()->json(array('success' => true, 'message' => 'Something went wrong!'));
    }

    public function delete(Request $request, $id) {
        $model = BlogCategories::where('id', '=', $id)->first();
        if ($model) {
//            $storage_path = '/storage/categories/' . $model->id . '/';
//            if ($model->image) {
//                $oldfile = $storage_path . $model->image;
//                if (file_exists($oldfile)) {
//                    unlink($oldfile);
//                    unlink($storage_path);
//                }
//            }
            $model->delete();
        }
        $request->session()->flash('message', 'Category is deleted successfully');
        return redirect('/admin/blog-categories');
    }
    
    protected function categories_options() {
        $html = '<option value="">Select Category</option>';
        $categories = BlogCategories::all();
        if($categories) {
            foreach ($categories as $cat) {
                $html .= '<option value="'.$cat->id.'">'.$cat->name.'</option>';
            }
        }
        return $html;
    }

}
