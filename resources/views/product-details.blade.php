@extends('layouts.app')
@section('title', 'Agreement - '.$agreement->name)
@section('content')

<!--- breadcrumb -->
<section class="product-lists">
    <div class="breadcrumb-wrap">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 pl-0">
                    <li class="breadcrumb-item">
                        <a href="/">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="/agreements?category_id={{$agreement->category_id}}">{{$agreement->getCategoryName($agreement->category_id)}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{$agreement->name}}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!--Agreement Name -->
<section class="agreement-name">
    <div class="container">
        <div class=" row flex-wrap py-5">
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="agreement-img-wrap">
                    @if($agreement->image)
                    <img class="img-fluid" src="{{asset('uploads/agreements/'.$agreement->id.'/'.$agreement->image)}}" alt="{{$agreement->name}}" />
                    @else
                    <img class="img-fluid" src="/assets/img/legal/cover.png" alt="{{$agreement->name}}" />
                    @endif
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 h-100">

                <div class="d-flex flex-column justify-content-between">
                    
                    <div class="agreement-detail-wrap">
                        <div class=" row flex-wrap agreement-name justify-content-between align-items-center">
                        <!-- Add justify-content-between class -->
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <h1>{{$agreement->name}}</h1>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                <div class="d-flex agreement-social-btn justify-content-end align-items-center">
                                    <a href="#" class="btn btn-facebook"><i class="bi bi-facebook"></i>Facebook</a>
                                    <a href="#" class="btn btn-twitter"><i class="bi bi-twitter"></i>Twitter</a>
                                    <a href="#" class="btn btn-whatsapp"><i class="bi bi-whatsapp"></i>Whatsapp</a>
                                    <a href="#" class="btn btn-email"><i class="bi bi-envelope"></i> Email</a>
                                </div>
                            </div>
                        </div>
                        <div class="agreement-pd">
                            {{$agreement->description}}
                        </div>
                    </div>
                    
                    
                    @php
                        $is_item_in_cart = check_if_product_in_session($agreement->id);
                        $is_item_in_wishlist = check_if_product_in_wishlist($agreement->id);
                    @endphp
                    
                    <div class="agreement-actions-wrap">
                        <div class=" row flex-wrap  justify-content-between align-items-center">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                <div class="price-strike">
                                    <h4> R{{number_format($agreement->sale_price)}} <strike>R{{number_format($agreement->regular_price)}}</strike> </h4>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="d-flex justify-content-end align-items-center m-0">

                                    @if($is_item_in_cart)
                                    <button class="p-2 btn btn-primary active with-shadow px-4 disabled" type="button">
                                        Added to cart
                                    </button>
                                    @else
                                    <button class="p-2 btn btn-primary active with-shadow px-4 add-to-cart" type="button" data-id="{{$agreement->id}}">
                                        <img class="me-3" src="/assets/img/legal/Vector.png" alt="cover" />
                                        Add to cart
                                    </button>
                                    @endif

                                    @if($is_item_in_wishlist)
                                    <div class=" heart-position selected">
                                        <i class="bi bi-suit-heart"></i>
                                    </div>
                                    @else
                                    <div class=" heart-position add-to-wishlist" data-id="{{$agreement->id}}">
                                        <i class="bi bi-suit-heart"></i>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>


        </div>
    </div>

</div>
</section>
<!---Agreement NAme section 4 -->

<section class="container agreement-table mt-4 py-4">
    <div class=" row flex-wrap  mt-4">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="py-3">
                <h2>Agreement Detail</h2>
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <td>Title</td>
                        <td>{{$agreement->name}}</td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>{{$agreement->getCategoryName($agreement->category_id)}}</td>
                    </tr>
                    <tr>
                        <td>Language</td>
                        <td>{{$agreement->language}}</td>
                    </tr>
                    <tr>
                        <td>Pages</td>
                        <td>{{$agreement->page_count}}</td>
                    </tr>
                    <tr>
                        <td>Date Published</td>
                        <td>{{date('F dS Y', strtotime($agreement->created_at))}}</td>
                    </tr>
                    @php
                    $tags = $agreement->tags;
                    if($tags) {
                        $tags = explode(',', $tags);
                    }
                    @endphp
                    <tr>
                        <td>Tags</td>
                        <td>
                            <div class="agreement-tag">
                                @if($tags)
                                    @foreach($tags as $tag)
                                    <span>{{trim($tag)}}</span>
                                    @endforeach
                                @endif
                                
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class='related-agreements'>
                <div class="py-3">
                    <h2>Related Agreements</h2>
                </div>
                @include('_related_product_list', ['products'=>$related_agreements])
                <div class="text-center view-more py-3">
                    <a href="/agreements?category_id={{$agreement->category_id}}" type="button" class="btn btn-primary"> Add to Cart</a>
                </div>
                
            </div>
        </div>
    </div>
</div>
</section>
<!---Agreement NAme section  service quick delivery-->
@include('_partials/_how_it_works_bg')

<!---Agreement NAme section 5 trusted by test -->
@include('_partials/_trusted')



@include('layouts/front/newsletter')

@endsection

