@extends('layouts.app')
@section('title', 'Blogs')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.css"  />

<section class="blogs product-lists">
    <div class="breadcrumb-wrap">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 pl-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                </ol>
            </nav>
        </div>

    </div>


    <div class="container">
        <div class=" row flex-wrap product-list-inner">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 left-filter-sidebar">

                <div class="shop-by-category category-border">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapsetwo" aria-expanded="false" aria-controls="flush-collapsetwo">
                                    Category
                                </button>
                            </h2>
                            <div id="flush-collapsetwo" class="accordion-collapse collapse show" data-parent="#accordionFlushExample">
                                <div class="category-checkbox">
                                    
                                    @if($categories)
                                    @foreach($categories as $category)
                                        @php
                                        $selected_cat = $cat;
                                        $checked = '';
                                        if($selected_cat) {
                                            $selected_cat = explode(',', $selected_cat);
                                            if(in_array($category->id, $selected_cat)) {
                                                $checked = 'checked';
                                            }
                                        }
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{$category->id}}" name="category[]" id="category-{{$category->id}}" {{$checked}}>
                                            <label class="form-check-label" for="category-{{$category->id}}">
                                                {{$category->name}}
                                            </label>
                                        </div>
                                    @endforeach()
                                    @else
                                    <div>no categories found</div>
                                    @endif
                                    
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                
            </div>


            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 menu-card product-list-content">
                <div class="date-filter list-category">
                    <h1>All the news</h1>

                    

                    <div class="products-loop-wrap">
                        <div class="mode {{isMobile()?'':'list'}}">
                            @include('_blog_list',['models'=>$blogs])
                        </div>
                    </div>

                    <div class="text-right pagination-wrap">
                        
                        {{ $blogs->links('vendor.pagination.bootstrap-4-result-count') }}
                        
                    </div> 
                </div>
            </div>

        </div>
    </div>

</section>

<form method="get" action="/blogs" id="product-search">
    <input type="hidden" name="category_id" value="{{$cat}}" />
</form>

@include('_partials/_how_it_works')

@include('layouts/front/newsletter')

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js"></script>
<script>
    $(document).ready(function () {
        
        

        $("#flex-mode").click(function (e) {
            e.preventDefault();
            $('.toggle-product-design a').removeClass('active');
            $(".products-loop-wrap .mode").removeClass("list");
            $(this).addClass('active');
        });

        $("#list").click(function (e) {
            e.preventDefault();
            $('.toggle-product-design a').removeClass('active');
            $(".products-loop-wrap .mode").addClass("list");
            $(this).addClass('active');
        });
    });
     

    $(document).on('click', '.form-check-label', function() {
        setTimeout(function() {
            submit_search();
        },1000);
        
    });
    
    function submit_search() {
        var categories = cats();
        $('input[name="category_id"]').val(categories);
        $('#product-search').submit();
    }
    
    function cats() {
        var catids = new Array(); 
        $("input[name='category[]']:checked").each(function () {
           catids.push($(this).val());
        });
        return catids;
    }
    
</script>
@stop