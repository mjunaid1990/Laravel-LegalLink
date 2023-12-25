@extends('layouts.app')

@section('title', 'Home')

@section('content')

@include('layouts/front/hero')


<!---section 3 quick delievry -->

@include('_partials/_how_it_works')

<!---section 4 freelancers-->

<section class="container disable">
    <div class="row py-5">
        <div class="col-12 col-md-6 col-lg-6 mb-3 ">
            <div class="banner-1">
                <div>
                    <h2>{{$box1['title']}}</h2>
                    <p>{{$box1['desc']}}</p>
                </div>
                
                <div class="position-relative">
                    @if($box1['agreements'])
                    <div class="popuplar-slider">
                        @foreach($box1['agreements'] as $box1_agreement)
                        <div class="carousel-wrap">
                            <a href="/agreement/{{$box1_agreement->slug}}">
                                @if($box1_agreement->image)
                                <img class="img-fluid" src="{{asset('uploads/agreements/'.$box1_agreement->id.'/'.$box1_agreement->image)}}" alt="{{$box1_agreement->name}}" />
                                @else
                                <img class="img-fluid" src="/assets/img/legal/placeholder-1.png" alt="{{$box1_agreement->name}}" />
                                @endif
                            </a>
                        </div>
                        @endforeach
                        
                    </div>
                    @endif
                </div>
                
            </div>

        </div>
        <div class="col-12 col-md-6 col-lg-6 mb-3 ">
            <div class="banner-2">
                <div>
                    <h2>{{$box2['title']}}</h2>
                    <p>{{$box2['desc']}}</p>
                </div>
                
                <div class="position-relative">
                    @if($box2['agreements'])
                    <div class="popuplar-slider">
                        @foreach($box2['agreements'] as $box2_agreement)
                        <div class="carousel-wrap">
                            <a href="/agreement/{{$box2_agreement->slug}}">
                                @if($box2_agreement->image)
                                <img class="img-fluid" src="{{asset('uploads/agreements/'.$box2_agreement->id.'/'.$box2_agreement->image)}}" alt="{{$box2_agreement->name}}" />
                                @else
                                <img class="img-fluid" src="/assets/img/legal/placeholder-1.png" alt="{{$box2_agreement->name}}" />
                                @endif
                            </a>
                        </div>
                        @endforeach
                        
                    </div>
                    @endif
                </div>
                
            </div>
            
            

        </div>
    </div>
</section>

<!--section 5 special offers -->

<section class="container disable pb-5">
    <div class="special-offers-title pb-5">
        <h1>
            Special Offers
        </h1>
        <p> Unlock savings. Explore our savings!</p>

    </div>


    <div class="position-relative py-4">
        @if($products)
        <div class="product-slider ">
            
            @foreach($products as $product)
                <div class="special-offers">
                    <div class="special-offers-img">
                        <a href="/agreement/{{$product->slug}}">
                            @if($product->image)
                            <img class="img-fluid" src="{{asset('uploads/agreements/'.$product->id.'/'.$product->image)}}" alt="{{$product->name}}" />
                            @else
                            <img class="img-fluid" src="/assets/img/legal/cover.png" alt="{{$product->name}}" />
                            @endif
                        </a>
                    </div>
                    <div class="offers-heading">
                        <a href="/agreement/{{$product->slug}}" class="h4">{{$product->name}}</a>
                        <h6>{{$product->getCategoryName($product->category_id)}}</h6>
                        <p>{{Str::limit($product->description, 250)}}</p>
                        <div class=" special-offers-btn ">
                            <button class="btn btn-primary px-4 add-to-cart" type="button" data-id="{{$product->id}}">
                                <img class="me-3" src="/assets/img/legal/Vector.png" alt="cover" />
                                Add to cart
                            </button>
                            <span>
                                R{{number_format($product->sale_price)}} <strike>R{{number_format($product->regular_price)}}</strike>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
            
            

        </div>
        
        @endif
        
    </div>




</section>

<!--section 6 Featured Agreement-->

<section class=" featured-banner">
    <div class="container py-4">
        <div class="row flex-wrap align-items-end featured-banner-row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="featured-heading mb-5">
                    <h1> Featured Agreements</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit veniam <br />
                        totam nihil qui dignissimos error, cumque dolorem.</p>
                </div>

                <div class="featured-debt">
                    <div class="row">
                        <div class="col-5 ">
                            <div class="featured-imgs">
                                <img class="img-fluid" src="/assets/img/legal/placeholder-1.png" alt="cover" />
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="row align-items-center  justify-content-center align-items-center">
                                <div class="col-3">
                                    <div class="featured-debt-img">
                                        <img src="/assets/img/legal/bookmark1.png" alt="Quick Delivery" />
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="featured-heading ms-1">
                                        <h4>Acknowledgment of Debt</h4>
                                        <h6>Finance & Debt
                                        </h6>
                                    </div>
                                </div>

                            </div>
                            <div class="ms-3 featured-heading">
                                <h3>What it is for?</h3>
                                <p class="mb-3">
                                    Lorem ipsum dolor sit,
                                    amet consectetur adipisicing elit. Quae odit, nulla eum
                                    repellat aperiam aliquam perferendis esse fuga velit in,
                                    obcaecati doloremque voluptatibus perspiciatis unde
                                    , quibusdam quasi minima.
                                </p>
                                <div class=" special-offers-btn d-flex align-items-center justify-content-between ">

                                    <span class="span-left">
                                        R18,78 <strike>R25</strike>
                                    </span>
                                    <button class=" ms-5 btn btn-primary " type="button">
                                        <img class="me-1" src="/assets/img/legal/Vector.png" width="100%" height="100%" alt="cover" />
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="col-12 col-md-6 col-lg-6 featured-grid">
                @if($featured_agreemenst)
                    <div class="grid grid-template-3">
                        @foreach($featured_agreemenst as $feagr)
                        <div class=" featured-right-img">
                            <a href="/agreement/{{$feagr->slug}}">
                                @if($product->image)
                                <img class="img-fluid" src="{{asset('uploads/agreements/'.$feagr->id.'/'.$feagr->image)}}" alt="{{$feagr->name}}" />
                                @else
                                <img class="img-fluid" src="/assets/img/legal/placeholder-1.png" alt="{{$feagr->name}}" />
                                @endif
                                
                            </a>
                            
                        </div>
                        @endforeach
                        
                        
                    </div>
                @endif
                


            </div>

        </div>

    </div>
    <div class="d-flex flex-row justify-content-between for-lg-screen ">
        <div class="col">
            <div class="d-flex justify-content-center flex-column align-items-center">
                <div class="card-img d-flex justify-content-center align-items-center ">
                    <div class="featured-phone-img">
                        <img src="/assets/img/legal/background (1).png" alt="Featured"/>
                    </div>
                </div>
                <div class="special-offers-btn text-center my-4">
                    <button class="btn btn-primary"><i class=" bi bi-cart3"> Add</i></button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="d-flex justify-content-center flex-column align-items-center">
                <div class="card-img d-flex justify-content-center align-items-center ">
                    <div class="featured-phone-img">
                        <img src="/assets/img/legal/background (1).png" alt="Featured"/>
                    </div>
                </div>
                <div class="special-offers-btn text-center my-4">
                    <button class="btn btn-primary"><i class=" bi bi-cart3"> Add</i></button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="d-flex justify-content-center flex-column align-items-center">
                <div class="card-img d-flex justify-content-center align-items-center ">
                    <div class="featured-phone-img">
                        <img src="/assets/img/legal/background (1).png" alt="Featured"/>
                    </div>
                </div>
                <div class="special-offers-btn text-center my-4">
                    <button class="btn btn-primary"><i class=" bi bi-cart3"> Add</i></button>
                </div>
            </div>
        </div>
    </div>


</div>
</section>

<!---section 7 testimonial  -->
@if($testimonials)
<section class="py-5">
    
    <div class="container">
        <div class="special-offers-title testimonals">
            <h1>
                Testimonials
            </h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, reprehenderit.
                <br />Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </p>
            <div class=" d-flex flex-row justify-content-center align-items-center py-3">
                
                <div class="testimonial-img">
                    <span>
                        <img src="/assets/img/legal/placeholder.png" alt="cover" />
                    </span>
                </div>
                <div class="testimonial-img">
                    <span>
                        <img src="/assets/img/legal/placeholder.png" alt="cover" />
                    </span>
                </div>
                <div class="testimonial-img">
                    <span>
                        <img src="/assets/img/legal/placeholder.png" alt="cover" />
                    </span>
                </div>
                <div class="testimonial-img">
                    <span>
                        <img src="/assets/img/legal/placeholder.png" alt="cover" />
                    </span>
                </div>
                <div class="testimonial-img">
                    <span>
                        <img src="/assets/img/legal/others.png" alt="cover" />
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <!--review-->

    <div class="position-relative">
        <div class="testimonial-slider">
            @foreach($testimonials as $testi)
            <div class="testimonal-review ">
                <div>
                    <p class="text-center">{{$testi->description}}</p>
                </div>
                <div class="row align-items-center  justify-content-between order">
                    
                    <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6 order-two ">
                        <div class="d-flex flex-row align-items-center justify-content-start testimonals">
                            <div class=" ">
                                <div class="review-img">
                                    <img src="/assets/img/legal/placeholder.png" alt="cover" />
                                </div>
                            </div>
                            <div class=" ">
                                <div class="p-2">
                                    <h5>{{$testi->name}}</h5>
                                    <h6 >{{$testi->company}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6 order-one ">
                        <div class="review-star-img text-end">
                            <img src="/assets/img/legal/stars.png" alt="cover" />
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>



</section>
@endif

<!---section 8 latest news  -->

<section class="container pb-5">
    <div class="special-offers-title text-start pb-3">
        <h1 class="text-left">
            Latest News
        </h1>
        <p class="text-left mb-3">Insight: Unrevealing different topics
            with legal ink.
        </p>
        <div class="special-offers-btn text-right">
            <a href="/blogs" class="btn btn-primary active">
                View more
                <i class="ml-2 bi bi-arrow-right " style="line-height: 1;"></i>
            </a>
        </div>

    </div>
    
    <div class="position-relative">
        @if($blogs)
        <div class="latest-news-wrap">
            <div class="row">
            @foreach($blogs as $blog)
            <div class="col-12 col-md-3 col-lg-3 mb-3">
                    <div class="carusel-wrap">
                        <a href="/blog/{{$blog->slug}}">
                            @if($blog->image)
                            <img class="img-fluid" src="{{asset('uploads/blogs/'.$blog->id.'/'.$blog->image)}}" alt="{{$blog->name}}" />
                            @else
                            <img class="img-fluid" src="/assets/img/legal/placeholder-1.png" alt="{{$blog->name}}" />
                            @endif
                            
                        </a>
                    </div>
                    <div class="offers-heading">
                        <a href="/blog/{{$blog->slug}}" class="h4">{{$blog->name}}</a>
                        <p class="pb-0 m-0"> {{Str::limit($blog->description, 150)}}</p>
                        <a href="/blog/{{$blog->slug}}" class="">continue reading</a>
                    </div>
                </div>
            @endforeach
            </div>
            
        </div>
        @endif
        
    </div>
    
    
</section>

<!---section 9 happy-customers  -->

<section class="container py-5 disable happy-customers">
    <div class="row align-items-center">
        <div class="col-12 col-md-3 col-lg-3 text-center storenumber">
            <div class="mb-4 storenumber-img">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" fill="none">
                    <path d="M78.125 25C74.3219 25 70.9531 26.7438 68.6594 29.4313C68.7156 30.0281 68.75 30.6375 68.75 31.25C68.75 34.7312 67.7781 37.9844 66.1156 40.7844C67.5688 46.0781 72.375 50 78.125 50C85.0188 50 90.625 44.3938 90.625 37.5C90.625 30.6062 85.0188 25 78.125 25Z" fill="#6C5DD3"/>
                    <path d="M31.25 31.25C31.25 30.6375 31.2844 30.0281 31.3406 29.4313C29.0469 26.7438 25.6781 25 21.875 25C14.9812 25 9.375 30.6062 9.375 37.5C9.375 44.3938 14.9812 50 21.875 50C27.625 50 32.4281 46.0781 33.8812 40.7844C32.2219 37.9844 31.25 34.7312 31.25 31.25Z" fill="#6C5DD3"/>
                    <path d="M50 46.875C41.3844 46.875 34.375 39.8656 34.375 31.25C34.375 22.6344 41.3844 15.625 50 15.625C58.6156 15.625 65.625 22.6344 65.625 31.25C65.625 39.8656 58.6156 46.875 50 46.875Z" fill="#6C5DD3"/>
                    <path d="M20.4875 56.25H12.5C7.33125 56.25 3.125 60.4562 3.125 65.625V78.125C3.125 79.8531 4.525 81.25 6.25 81.25H18.75V62.5C18.75 60.2156 19.4125 58.0969 20.4875 56.25Z" fill="#6C5DD3"/>
                    <path d="M87.5 56.25H79.5094C80.5875 58.0969 81.25 60.2156 81.25 62.5V81.25H93.75C95.4781 81.25 96.875 79.8531 96.875 78.125V65.625C96.875 60.4562 92.6687 56.25 87.5 56.25Z" fill="#6C5DD3"/>
                    <path d="M75 84.375H25C23.275 84.375 21.875 82.9781 21.875 81.25V62.5C21.875 57.3312 26.0812 53.125 31.25 53.125H68.75C73.9188 53.125 78.125 57.3312 78.125 62.5V81.25C78.125 82.9781 76.7281 84.375 75 84.375Z" fill="#6C5DD3"/>
                </svg>
            </div>
            <h3>5,663</h3>
            <p>Happy Customers</p>
        </div>
        <div class="col-12 col-md-3 col-lg-3 text-center storenumber">
            <div class="mb-4 storenumber-img">
                <img src="/assets/img/legal/contract.png" alt="Customers">
            </div>
            <h3>250+</h3>
            <p>Agreements</p>
        </div>
        <div class="col-12 col-md-3 col-lg-3 text-center storenumber">
            <div class="mb-4 storenumber-img">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" fill="none">
                    <path d="M87.0188 25L93.75 40.625C93.75 45.8031 88.8531 50 82.8125 50C77.0031 50 72.25 46.1156 71.8969 41.2125C71.8938 41.1562 71.8594 41.1562 71.8531 41.2125C71.5 46.1156 66.7469 50 60.9375 50C55.1281 50 50.375 46.1156 50.0219 41.2125C50.0187 41.1562 49.9844 41.1562 49.9781 41.2125C49.625 46.1156 44.8719 50 39.0625 50C33.2531 50 28.5 46.1156 28.1469 41.2125C28.1437 41.1562 28.1094 41.1562 28.1031 41.2125C27.75 46.1156 22.9969 50 17.1875 50C11.1469 50 6.25 45.8031 6.25 40.625L12.9812 25H87.0188Z" fill="#6C5DD3"/>
                    <path d="M87.5 18.75H12.5V9.375C12.5 7.65 13.9 6.25 15.625 6.25H84.375C86.1 6.25 87.5 7.65 87.5 9.375V18.75Z" fill="#6C5DD3"/>
                    <path d="M87.5 55.6436V93.7498H12.5V55.6436C13.9937 56.0311 15.5594 56.2498 17.1875 56.2498C18.8156 56.2498 20.375 55.9873 21.875 55.5967V79.6873C21.875 80.5498 22.575 81.2498 23.4375 81.2498H76.5625C77.425 81.2498 78.125 80.5498 78.125 79.6873V55.5967C79.625 55.9873 81.1844 56.2498 82.8125 56.2498C84.4406 56.2498 86.0062 56.0311 87.5 55.6436Z" fill="#6C5DD3"/>
                </svg>
            </div>
            <h3>80,562</h3>
            <p>Purchase</p>
        </div>
        <div class="col-12 col-md-3 col-lg-3 text-center storenumber">
            <div class="mb-4 storenumber-img">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" fill="none">
                    <g clip-path="url(#clip0_88_1587)">
                    <path d="M99.524 0.237793C35.2557 4.41275 24.6808 44.1124 16.5248 79.4739L0 99.7618H8.55597L23.1808 80.962C57.4865 73.024 75.6303 55.3683 75.6303 55.3683L61.2685 47.5744C61.2685 47.5744 82.2873 41.1934 88.2493 42.6114C92.5302 39.1183 102.255 26.6875 99.524 0.237793ZM24.8437 73.8929L24.4377 73.6869C28.8816 66.3809 55.7493 24.0493 89.806 8.79357C71.6932 19.9376 32.7497 64.693 24.8437 73.8929Z" fill="#6C5DD3"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_88_1587">
                    <rect width="100" height="100" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
            </div>
            <h3>4</h3>
            <p>Legal Professionals</p>
        </div>
    </div>

</section>

@include('layouts/front/newsletter')

@endsection