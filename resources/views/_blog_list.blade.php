@if($models  && count($models) > 0)
@foreach($models as $product)


<div class="item grid-list">
    <div class="card">
        <a class="card-img mb-2" href="/blog/{{$product->slug}}">
            @if($product->image)
            <img class="img-fluid" src="{{asset('uploads/blogs/'.$product->id.'/'.$product->image)}}" alt="{{$product->name}}" />
            @else
            <img class="img-fluid" src="/assets/img/legal/cover.png" alt="{{$product->name}}" />
            @endif
        </a>

        <div class="card-body" style="height: 300px; max-height: 100%;">
            <a href="/blog/{{$product->slug}}" class="product-title">{{$product->name}}</a>
            <div class="toggle-content" style="height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;">
                <div class="category-name">{{$product->getCategoryName($product->category_id)}}</div>
                <p class="desc">{{Str::limit($product->description, 350)}}</p>



                <div class="list-style-grid">
                    <a href="/blog/{{$product->slug}}" class="btn btn-primary active" type="button">
                        View more
                    </a>

                </div>

            </div>

        </div>



    </div>
</div>
@endforeach
@else
<p>No data found.</p>
@endif