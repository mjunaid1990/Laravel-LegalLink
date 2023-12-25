<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agreements;
use App\Models\Categories;
use App\Models\BlogCategories;
use App\Models\Blogs;
use App\Models\AssignCustomFields;
use App\Models\Testimonials;
use Illuminate\Support\Facades\DB;


class FrontController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $products = Agreements::limit(6)->get();
        $blogs = Blogs::limit(4)->get();
        $featured_agreemenst = Agreements::where('is_featured', 1)->limit(6)->get();

        $box1 = [];
        $box2 = [];
        $box1['title'] = get_setting_value_by_key('recommended_box_1_title');
        $box1['desc'] = get_setting_value_by_key('recommended_box_1_desc');
        $box1_cats = get_setting_value_by_key('recommended_box_1_agreements');
        if ($box1_cats) {
            $agreement_ids = explode(',', $box1_cats);
            $box1['agreements'] = Agreements::whereIn('id', $agreement_ids)->get();
        }

        $box2['title'] = get_setting_value_by_key('recommended_box_2_title');
        $box2['desc'] = get_setting_value_by_key('recommended_box_2_desc');
        $box2_cats = get_setting_value_by_key('recommended_box_2_agreements');
        if ($box2_cats) {
            $agreement2_ids = explode(',', $box2_cats);
            $box2['agreements'] = Agreements::whereIn('id', $agreement2_ids)->get();
        }
        $testimonials = Testimonials::limit(6)->get();

        return view('welcome', compact('products', 'blogs', 'box1', 'box2', 'featured_agreemenst', 'testimonials'));
    }
    
    public function products(Request $request) {
        
        $q = $request->get('q') ? $request->get('q') : '';
        $sort = $request->get('sort') ? $request->get('sort') : '';
        $cat = $request->get('category_id') ? $request->get('category_id') : '';
        $min_price = $request->get('min_price') ? $request->get('min_price') : '';
        $max_price = $request->get('max_price') ? $request->get('max_price') : '';
        $is_featured = $request->get('is_featured') ? $request->get('is_featured') : '';
        $date = $request->get('date') ? $request->get('date') : '';
        $best_sales = $request->get('best_sales') ? $request->get('best_sales') : '';
        
        

        $products = Agreements::where('status', 'published')
                ->when(!empty($q), function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%");
                    $query->orWhere('description', 'like', "%{$q}%");
                })
                ->when(!empty($cat), function ($query) use ($cat) {
                    $query->whereIn('category_id', explode(',', $cat));
                })
                ->where(function ($query) use ($min_price, $max_price) {
                    if($min_price && $max_price) {
                        $query->whereBetween('reqular_price', [$min_price, $max_price]);
                    }else if($min_price) {
                        $query->where('reqular_price', '>=', $min_price);
                    }else if($max_price) {
                        $query->where('reqular_price', '<=', $max_price);
                    }
                })
                ->when(!empty($is_featured), function ($query) use ($is_featured) {
                    $query->where('is_featured', $is_featured);
                })
                ->when(!empty($date), function ($query) use ($date) {
                    $today = date('Y-m-d');
                    if($date == 'today') {
                        $date = ('Y-m-d');
                        $query->where(DB::raw('DATE(created_at)'), $today);
                    }else if($date == 'week') {
                        $date = date('Y-m-d', strtotime('-7 days'));
                        $query->whereBetween(DB::raw('DATE(created_at)'), [$date, $today]);
                    }else if($date == 'month') {
                        $date = date('Y-m-d', strtotime('-1 month'));
                        $query->whereBetween(DB::raw('DATE(created_at)'), [$date, $today]);
                    }
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
        
        $categories = Categories::all();
        return view('products', compact('products','categories', 'q', 'cat', 'min_price', 'max_price', 'sort', 'date', 'is_featured', 'best_sales'));
    }
    
    public function productDetails($slug) {
        $agreement = Agreements::where('slug', $slug)->first();
        if(!$agreement) {
            return abort(404);
        }
        $related_agreements = Agreements::where('category_id', $agreement->category_id)->paginate(3);
        return view('product-details', compact('agreement','related_agreements'));
    }
    
    public function blogs(Request $request) {
        $cat = $request->get('category_id') ? $request->get('category_id') : '';
        $blogs = Blogs::when(!empty($cat), function ($query) use ($cat) {
                    $query->whereIn('category_id', explode(',', $cat));
                })
                ->orderBy('id', "desc")
                ->paginate(12);
        $categories = BlogCategories::all();
        return view('blogs', compact('blogs', 'categories', 'cat'));
    }
    
    public function blog($slug) {
        $blog = Blogs::where('slug', $slug)->first();
        if(!$blog) {
            return abort('404');
        }
        return view('blog', compact('blog'));
    }
    
    public function privacy() {
        return view('privacy');
    }
    
    public function terms() {
        return view('terms');
    }
    
    public function about() {
        return view('about');
    }
    
    public function contact() {
        return view('contact');
    }

}
