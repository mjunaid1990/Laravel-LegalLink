@extends('layouts.app')
@section('title', 'Cart')
@section('content')

<section class="product-lists">
    <div class="breadcrumb-wrap">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 pl-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Your Basket</li>
                </ol>
            </nav>
        </div>

    </div>
</section>
<section class="container basket-overview py-4">
    <div class="py-3">
        <h2>Review Your Basket</h2>
        <p>Have a look what agreement are in your basket before we move onto the next step.</p>
    </div>
</section>

<div class="container">
    @if(isset($products))
    <div class="cart-table mb-4">
        <table class="table">
            <tr>
                <th>Agreement Name</th>
                <th class="text-right">Price</th>
            </tr>
            
            @foreach($products as $product)
            <tr>
                <td>
                    <a href="/agreement/{{$product->slug}}">{{$product->name}}</a>
                </td>
                <td class="text-right">R{{number_format($product->sale_price)}}</td>
            </tr>
            @endforeach
            
        </table>
    </div>

    <div class="d-flex basket-total justify-content-end flex-column justify-content-end align-items-end mb-3">
        <div class="d-flex align-items-center">
            <div class="mr-3 total-text">Total</div>
            <div><input type="text" id="text" class="form-control" value="{{number_format($total,2)}}"></div>
        </div>
        <div class="list-style-grid mt-4">
            <a href="/checkout" class="btn btn-primary active" type="button">
                <i class="me-3 bi bi-cart3"></i>
                Proceed to payment
            </a>
        </div>
    </div>
    @else 
    <div class="alert alert-primary">
        <p>Cart is empty</p>
    </div>
    
    @endif

    @if(isset($products))
    <div class="product-lists products-loop-wrap mb-3">
        <div class="mode">
            @include('_product_list_cart',['models'=>$products])
        </div>
    </div>
    @endif
</div>

<div class="mt-5">
    @include('_partials/_how_it_works')
</div>



@include('layouts/front/newsletter')



@endsection
