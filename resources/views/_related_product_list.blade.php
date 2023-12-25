@if($products)
@foreach($products as $product)
@php
$is_item_in_cart = check_if_product_in_session($product->id);
$is_item_in_wishlist = check_if_product_in_wishlist($product->id);
@endphp
<div class="related-product-loop">
    <div class="related-product">
        <a class="related-agreement-img mr-3" href="/agreement/{{$product->slug}}">
            @if($product->image)
            <img class="img-fluid" src="{{asset('uploads/agreements/'.$product->id.'/'.$product->image)}}" alt="{{$product->name}}" />
            @else
            <img class="img-fluid" src="/assets/img/legal/cover.png" alt="{{$product->name}}" />
            @endif
        </a>

        <div class="product-details d-flex flex-column justify-content-between">
            <div class="name-detail">
                <a href="/agreement/{{$product->slug}}" class="h3">{{$product->name}}</a>
                <h6>{{$product->getCategoryName($product->category_id)}}</h6>
            </div>
            <div class="cart-with-price">
                <div>
                    <p> R{{number_format($product->sale_price)}} <strike>R{{number_format($product->regular_price)}}</strike></p>
                </div>
                @if($is_item_in_cart)
                <button class="p-2 btn btn-primary px-4 disabled" type="button">
                    Added to cart
                </button>
                @else
                <button class="p-2 btn btn-primary px-4 add-to-cart" type="button" data-id="{{$product->id}}">
                    <img class="me-3" src="/assets/img/legal/Vector.png" alt="cover" />
                    Add to cart
                </button>
                @endif
            </div>

            
        </div>
    </div>
</div>
@endforeach()
@endif

