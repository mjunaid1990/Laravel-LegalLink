@extends('layouts.app')
@section('title', 'Blog - '.$blog->name)
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.css"  />

<section class="blogs product-lists">
    <div class="breadcrumb-wrap">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 pl-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$blog->name}}</li>
                </ol>
            </nav>
        </div>

    </div>


    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 col-12">
                <h3>{{$blog->name}}</h3>
                <br />
                <p>{{$blog->description}}</p>
                <br />
                <div class="agreement-name">
                    <div class="d-flex agreement-social-btn justify-content-start align-items-center">
                        <a href="#" class="btn btn-facebook"><i class="bi bi-facebook"></i>Facebook</a>
                        <a href="#" class="btn btn-twitter"><i class="bi bi-twitter"></i>Twitter</a>
                        <a href="#" class="btn btn-whatsapp"><i class="bi bi-whatsapp"></i>Whatsapp</a>
                        <a href="#" class="btn btn-email"><i class="bi bi-envelope"></i> Email</a>
                    </div> 
                </div>
                               
            </div>
            <div class="col-md-6 col-12">
                <div class="card-img" style="width: 350px;margin-left: auto;">
                    @if($blog->image)
                        <img class="img-fluid" src="{{asset('uploads/blogs/'.$blog->id.'/'.$blog->image)}}" alt="{{$blog->name}}" />
                    @else
                        <img class="img-fluid" src="/assets/img/legal/cover.png" alt="{{$blog->name}}" />
                    @endif
                </div>
            </div>
        </div>
    </div>

</section>

@include('_partials/_how_it_works_bg')

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