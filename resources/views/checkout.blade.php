@extends('layouts.app')
@section('title', 'Checkout')
@section('content')

<div class="checkout-page">

    <div class="container py-5">
        <div class="stepper-wrap">
            <ul id="progressbar">
                <li class="active" id="account"><strong>Shop</strong></li>
                <li class="active" id="personal"><strong>Checkout</strong></li>
                <li id="payment"><strong>Payment</strong></li>
                <li id="confirm"><strong>Generate</strong></li>
            </ul>
        </div>
    </div>
    
    
    
    <div class="clear" style="clear: both;"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7 mb-3">
                <div class="order-heading ">
                    <h2>Buyer Info</h2>
                </div>
                <form class="order-form px-4" method="POST" action="{{ route('process.checkout') }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="inputFirstName">First Name</label>
                            <input type="text" name="firstname" class="form-control" id="inputFirstName" placeholder="First Name" value="{{Auth::user()->firstname}}" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputLastName">Last Name</label>
                            <input type="text" name="lastname" class="form-control" id="inputLastName" placeholder="Last Name" value="{{Auth::user()->lastname}}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email Address</label>
                            <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email" value="{{Auth::user()->email}}" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputnumber">Mobile phone number</label>
                            <input type="tel" name="phone" class="form-control" id="inputnumber" placeholder="Mobile Phone" value="{{Auth::user()->phone}}" />
                        </div>
                    </div>
                    <!-- Address Line 1 - Row 2 -->
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" name="address" class="form-control" id="inputAddress" placeholder="Address" value="{{Auth::user()->address}}" required />
                    </div>



                    <!-- City, State, and Zip - Row 4 -->
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="state">State</label>
                            <input type="text" name="state" class="form-control" id="state" placeholder="State" value="{{Auth::user()->state}}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputZip">postcode/Zip</label>
                            <input type="text" name="zip" placeholder="Zip" class="form-control" id="inputZip" value="{{Auth::user()->zip}}" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputcity">Town/city</label>
                        <input type="text" name="city" class="form-control" id="inputcity" placeholder="Town/city" value="{{Auth::user()->city}}" required />
                    </div>
                    <!-- Check Me Out - Row 5 -->
                    <div class="form-group">
                        <label for="inputNote">Note</label>
                        <textarea class="form-control" name="note" id="inputNote" rows="3" placeholder="Enter your note here"></textarea>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-5">
                <div class="order-heading ">
                    <h2>Payment</h2>
                </div>
                
                @if(isset($products))
                    <div class="cart-table mb-4">
                        <table class="table">
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
                @endif
                
                <div class="d-flex basket-total justify-content-end flex-column justify-content-end align-items-end mb-3">
                    <div class="d-flex align-items-center">
                        <div class="mr-3 total-text">Total</div>
                        <div><input type="text" id="text" class="form-control" value="{{number_format($total,2)}}"></div>
                    </div>
                    <div class="list-style-grid w-100 mt-4">
                        <a href="javascript:void(0)" class="btn btn-primary w-100 active process-checkout" type="button">
                            <i class="me-3 bi bi-cart3"></i>
                            Pay Now
                        </a>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>


</div>

@endsection
@section('scripts')
<script type="text/javascript">

$(document).on('click', '.process-checkout', function(e) {
    e.preventDefault();
    $('form.order-form').submit();
    if($('form.order-form').valid()) {
        $(this).prop('disabled', true);
    }
})

</script>
@stop