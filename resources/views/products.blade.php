@extends('layouts.app')
@section('title', 'Agreements')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.css"  />

<section class="product-lists">
    <div class="breadcrumb-wrap">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 pl-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Agreements</li>
                </ol>
            </nav>
        </div>

    </div>


    <div class="container">
        <div class=" row flex-wrap product-list-inner">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 left-filter-sidebar">
<!--                <div class="filter-wrap">
                    <h1>Filter Options</h1>

                    <div class="our-picks category-border mt-2">

                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Our Picks
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="category-link">
                                            <h2>-Best sales(105)
                                            </h2>
                                            <ul>
                                                <li><a class="link-offset-2 link-underline link-underline-opacity-0 " href="#">Agreement
                                                        Name</a></li>
                                                <li><a class="link-offset-2 link-underline link-underline-opacity-0 " href="#">Agreement
                                                        Name</a></li>
                                                <li><a class="link-offset-2 link-underline link-underline-opacity-0 " href="#">Agreement
                                                        Name</a></li>
                                                <li><a class="link-offset-2 link-underline link-underline-opacity-0 " href="#">Agreement
                                                        Name</a></li>
                                                <li><a class="link-offset-2 link-underline link-underline-opacity-0 " href="#">Agreement
                                                        Name</a></li>
                                                <li><a class="link-offset-2 link-underline link-underline-opacity-0 " href="#">Agreement
                                                        Name</a></li>
                                                <li><a class="link-offset-2 link-underline link-underline-opacity-0 " href="#">Agreement
                                                        Name</a></li>
                                                <li><a class="link-offset-2 link-underline link-underline-opacity-0 " href="#">Agreement
                                                        Name</a></li>
                                            </ul>
                                            <a href="#"> + Featured(129)</a>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>



                    </div>
                </div>-->
                <div class="shop-by-category category-border">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapsetwo" aria-expanded="false" aria-controls="flush-collapsetwo">
                                    Shop by Category
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
                <div class="price-range-filter category-border py-2">
                    <div class="pb-2">

                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button  collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#priceCollapse" aria-expanded="false" aria-controls="priceCollapse">
                                        Pricing Range
                                    </button>
                                </h2>
                                <div id="priceCollapse" class="accordion-collapse collapse" data-parent="#accordionFlushExample">

                                    <div id="slider-outer-div" class="text-center my-4">
                                        <div id="slider-max-label" class="slider-label"></div>
                                        <div id="slider-min-label" class="slider-label"></div>
                                        <div id="slider-div">
                                          <div>
                                            <input id="ex2" type="text" data-slider-min="0"
                                               data-slider-max="5000" data-slider-value="[0,5000]"
                                               data-slider-tooltip="show" />
                                          </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

                <div class="btn-groups">
                    <button class="btn btn-primary refine-search btn-block active" type="button">Refine Search</button>
                    <a href="/products" class="btn btn-primary reset-filter btn-block" type="button">Reset Filter</a>
                </div>
            </div>


            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 menu-card product-list-content">
                <div class="date-filter list-category">
                    <h1>Agreements</h1>

                    <nav class="navbar py-2 mt-2 mb-5 navbar-expand-lg navbar-light nav-bg horizontal-filter">
                        <div class="container">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link date-selection {{$date && $date == 'today'?'active':''}} {{$date == ''?'active':''}} " href="javascript:void(0);" data-date="today">Today</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link date-selection {{$date && $date == 'week'?'active':''}}" href="javascript:void(0);" data-date="week">This Week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link date-selection {{$date && $date == 'month'?'active':''}}" href="javascript:void(0);" data-date="month">This Month</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto toggle-product-design ">
                                <li class="nav-item">
                                    <a href="#" class="nav-link active" id="list"><i class="bi bi-list"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="flex-mode"><i class="bi bi-grid"></i></a>
                                </li>
                                
                                <li class="border-left mx-4"></li>

                                <li class="nav-item d-flex align-items-center me-1 justify-content-center">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M10.2932 16.2932L8.00016 18.5861V3.00015C8.00016 2.73494 7.89481 2.48058 7.70727 2.29305C7.51973 2.10551 7.26538 2.00015 7.00016 2.00015C6.73495 2.00015 6.48059 2.10551 6.29306 2.29305C6.10552 2.48058 6.00016 2.73494 6.00016 3.00015V18.5861L3.70716 16.2932C3.51856 16.111 3.26596 16.0102 3.00376 16.0125C2.74156 16.0148 2.49075 16.1199 2.30534 16.3053C2.11994 16.4907 2.01477 16.7416 2.01249 17.0038C2.01021 17.2659 2.111 17.5186 2.29316 17.7072L6.29316 21.7072C6.48086 21.8943 6.73513 21.9995 7.00021 21.9995C7.2653 21.9995 7.51956 21.8943 7.70726 21.7072L11.7073 17.7072C11.8901 17.5187 11.9914 17.2658 11.9894 17.0033C11.9874 16.7407 11.8822 16.4894 11.6965 16.3038C11.5109 16.1181 11.2596 16.0129 10.997 16.0109C10.7345 16.0089 10.4816 16.1103 10.2932 16.2932Z" fill="#AAAAAA"/>
                                            <path d="M11.0002 6.0003H21.0002C21.2655 6.0003 21.5198 5.89494 21.7074 5.70741C21.8949 5.51987 22.0002 5.26552 22.0002 5.0003C22.0002 4.73509 21.8949 4.48073 21.7074 4.2932C21.5198 4.10566 21.2655 4.00031 21.0002 4.00031H11.0002C10.735 4.00031 10.4807 4.10566 10.2931 4.2932C10.1056 4.48073 10.0002 4.73509 10.0002 5.0003C10.0002 5.26552 10.1056 5.51987 10.2931 5.70741C10.4807 5.89494 10.735 6.0003 11.0002 6.0003Z" fill="#AAAAAA"/>
                                            <path d="M21.0002 8.00015H11.0002C10.735 8.00015 10.4807 8.10551 10.2931 8.29305C10.1056 8.48058 10.0002 8.73493 10.0002 9.00015C10.0002 9.26537 10.1056 9.51972 10.2931 9.70726C10.4807 9.89479 10.735 10.0001 11.0002 10.0001H21.0002C21.2655 10.0001 21.5198 9.89479 21.7074 9.70726C21.8949 9.51972 22.0002 9.26537 22.0002 9.00015C22.0002 8.73493 21.8949 8.48058 21.7074 8.29305C21.5198 8.10551 21.2655 8.00015 21.0002 8.00015Z" fill="#AAAAAA"/>
                                            <path d="M18.0002 12H11.0002C10.735 12 10.4807 12.1054 10.2931 12.2929C10.1056 12.4804 10.0002 12.7348 10.0002 13C10.0002 13.2652 10.1056 13.5196 10.2931 13.7071C10.4807 13.8947 10.735 14 11.0002 14H18.0002C18.2655 14 18.5198 13.8947 18.7074 13.7071C18.8949 13.5196 19.0002 13.2652 19.0002 13C19.0002 12.7348 18.8949 12.4804 18.7074 12.2929C18.5198 12.1054 18.2655 12 18.0002 12Z" fill="#AAAAAA"/>
                                        </svg>
                                    </span>
                                </li>
                                <li class="nav-item dropdown">
                                    <select class="form-select" id="sort_options">
                                        <option value="desc" selected>Newest</option>
                                        <option value="asc">Oldest</option>
                                        <option value="is_featured">Featured</option>
                                        <option value="is_best_sales">Best Sales</option>
                                    </select>

                                </li>
                            </ul>

                        </div>
                    </nav>

                    <div class="products-loop-wrap">
                        <div class="mode {{isMobile()?'':'list'}}">
                            @include('_product_list',['models'=>$products])
                        </div>
                    </div>

                    <div class="text-right pagination-wrap">
                        
                        {{ $products->links('vendor.pagination.bootstrap-4-result-count') }}
                        
                    </div> 
                </div>
            </div>

        </div>
    </div>

</section>

<form method="get" action="/agreements" id="product-search">
    <input type="hidden" name="category_id" value="{{$cat}}" />
    <input type="hidden" name="min_price" value="{{$min_price}}" />
    <input type="hidden" name="max_price" value="{{$max_price}}" />
    <input type="hidden" name="sort" value="{{$sort}}" />
    <input type="hidden" name="is_featured" value="{{$is_featured}}" />
    <input type="hidden" name="best_sales" value="{{$best_sales}}" />
    <input type="hidden" name="date" value="{{$date}}" />
</form>

@include('layouts/front/newsletter')

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js"></script>
<script>
    $(document).ready(function () {
        
        $("#ex2").slider({});
        
        $("#ex2").on("slide", function(slideEvt) {
            var range = slideEvt.value;
            $('input[name="min_price"]').val(range[0]);
            $('input[name="max_price"]').val(range[1]);
        });
        $("#ex2").on("change", function(slideEvt) {
            var range = slideEvt.value;
            $('input[name="min_price"]').val(range[0]);
            $('input[name="max_price"]').val(range[1]);
        });

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
     
    $(document).on('click', '.date-selection', function() {
        $('.date-selection').removeClass('active');
        var v = $(this).data('date');
        $(this).addClass('active');
        $('input[name="date"]').val(v);
    });
    
    $(document).on('change', '#sort_options', function() {
        var v = $(this).val();
        $('input[name="is_featured"]').val('');
        $('input[name="best_sales"]').val('');
        $('input[name="sort"]').val('');
        if(v == 'is_featured') {
            $('input[name="is_featured"]').val(1);
        }else if(v == 'is_best_sales') {
            $('input[name="best_sales"]').val(1);
        }else {
            $('input[name="sort"]').val(v);
        }
    });
    
    $(document).on('click', '.refine-search', function() {
        submit_search();
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