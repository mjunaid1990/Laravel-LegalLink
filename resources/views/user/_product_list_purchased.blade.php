@if($models  && count($models) > 0)
@foreach($models as $product)

<div class="item grid-list">
    <div class="card">
        <a class="card-img mb-2" href="/agreement/{{$product->agreement->slug}}">
            @if($product->agreement->image)
            <img class="img-fluid" src="{{asset('uploads/agreements/'.$product->agreement->id.'/'.$product->agreement->image)}}" alt="{{$product->agreement->name}}" />
            @else
            <img class="img-fluid" src="/assets/img/legal/cover.png" alt="{{$product->agreement->name}}" />
            @endif
        </a>

        <div class="card-body">
            <a href="/agreement/{{$product->agreement->slug}}" class="product-title">{{$product->agreement->name}}</a>
            <div class="toggle-content">
                <div class="category-name">{{$product->agreement->getCategoryName($product->agreement->category_id)}}</div>


                <div class="list-style-grid ">
                    <h6>R{{number_format($product->agreement->sale_price)}} <strike>R{{number_format($product->agreement->regular_price)}}</strike></h6>

                    
                    @if($product->status == 'pending')
                    
                    <a class="p-2 btn btn-primary active px-4" href="/user/generate-agreement/{{$product->agreement_id}}">
                        Generate Agreement
                    </a>
                    
                    @else
                    <a class="p-2 btn btn-primary active px-4" href="/user/agreement-view/{{$product->agreement_id}}">
                        View Agreement
                    </a>
                    @endif



                </div>

            </div>

        </div>



    </div>
</div>
@endforeach

@endif