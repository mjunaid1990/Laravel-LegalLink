@if($models  && count($models) > 0)
@foreach($models as $product)

@php
    $is_item_in_cart = check_if_product_in_session($product->id);
    $is_item_in_wishlist = check_if_product_in_wishlist($product->id);
@endphp
<div class="item grid-list">
    <div class="card">
        <a class="card-img mb-2" href="/agreement/{{$product->slug}}">
            @if($product->image)
            <img class="img-fluid" src="{{asset('uploads/agreements/'.$product->id.'/'.$product->image)}}" alt="{{$product->name}}" />
            @else
            <img class="img-fluid" src="/assets/img/legal/cover.png" alt="{{$product->name}}" />
            @endif
        </a>

        <div class="card-body">
            <a href="/agreement/{{$product->slug}}" class="product-title">{{$product->name}}</a>
            <div class="toggle-content">
                <div class="category-name">{{$product->getCategoryName($product->category_id)}}</div>
                <p class="desc">{{Str::limit($product->description, 350)}}</p>
                <div class="d-flex grid-content align-items-center">
                    <div>
                        <h4>R{{number_format($product->sale_price)}} <strike>R{{number_format($product->regular_price)}}</strike></h4>
                    </div>
                    @if($product->promotion_id)
                    <div>
                        <h5>{{$product->getPromotionName($product->promotion_id)}}</h5>
                    </div>
                    @endif
                </div>

                
                <div class="list-style-grid ">
                    <h6>R{{number_format($product->sale_price)}} <strike>R{{number_format($product->regular_price)}}</strike></h6>
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

                    @if($is_item_in_wishlist)
                    <div class=" heart-position selected">
                        <i class="bi bi-suit-heart"></i>
                    </div>
                    @else
                    <div class=" heart-position add-to-wishlist" data-id="{{$product->id}}">
                        <i class="bi bi-suit-heart"></i>
                    </div>
                    @endif
                    
                </div>

            </div>

        </div>
        
        

    </div>
</div>
@endforeach
@else
<p>No data found.</p>
@endif