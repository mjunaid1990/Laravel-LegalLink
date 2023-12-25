@extends('layouts.app')

@section('title', 'Agreements')

@section('content')
<section class="product-lists">
    <div class="breadcrumb-wrap">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Agreements</li>
                </ol>
            </nav>
        </div>

    </div>
</section>

@include('layouts/front/hero-agreement')



<section class="agreements-sec py-4">
    <div class="container">
        
        <h4 class="heading-style-1 mb-4">Your agreements available</h4>
        
        @if(isset($products))
        <div class="product-lists products-loop-wrap mb-3">
            <div class="mode">
                @include('user/_product_list_purchased',['models'=>$products])
            </div>
        </div>
        @endif
    </div>
</section>


@include('_partials/_how_it_works')
@include('layouts/front/newsletter')

@endsection
