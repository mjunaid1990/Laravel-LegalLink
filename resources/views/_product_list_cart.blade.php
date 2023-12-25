@if($models  && count($models) > 0)
@foreach($models as $product)

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


                <div class="list-style-grid ">
                    <h6>R{{number_format($product->sale_price)}} <strike>R{{number_format($product->regular_price)}}</strike></h6>

                    <button class="p-2 btn btn-primary px-4 remove-to-cart" type="button" data-id="{{$product->id}}">
                        <img class="me-3" src="/assets/img/legal/Vector.png" alt="cover" />
                        Remove
                    </button>



                </div>

            </div>

        </div>



    </div>
</div>
@endforeach

@endif