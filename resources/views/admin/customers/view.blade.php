
<style>
    .customer-details {
        padding: 60px 15px;
    }
    .customer-avatar {
        text-align: center;
    }
    .customer-avatar h5 {
        font-family: 'DM Sans';
        font-weight: bold;
        font-size: 18px;
        color: #06152B;
    }
    .customer-avatar img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-bottom: 10px;
    }
    .customer-details i {
        color: #aeb2b9;
        margin-right: 10px;
    }
    .contact-info-detail .d-flex {
        padding: 10px 0;
    }
    .contact-info-detail .d-flex .text {
        color: #06152B;
        font-size: 14px;
        font-family: 'DM Sans';
    }
    .contact-info-detail .d-flex+.d-flex {
        border-top: 1px solid #e6e6e6;
    }
</style>


<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">

<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>


<div class="modal right fade sidebar-modal-style" id="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
<!--            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">{{$title}}</h5>
                <button type="button" class="btn-transparent" data-bs-dismiss="modal">
                    <i class="bx bx-chevron-left"></i>
                </button>
            </div>-->
            <div class="customer-details">
                <div class="customer-avatar username">
                    <img src="/assets/img/legal/cover.png" /> 
                    <h5>{{$model->firstname.' '.$model->lastname}}</h5>
                </div>
                <hr />
                <div class="contact-info-detail">
                    <h5>Contact Info</h5>
                    @if($model->email)
                    <div class="d-flex align-content-center justify-content-start">
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="text">
                            {{$model->email}}
                        </div>
                    </div>
                    @endif
                    @if($model->phone)
                    <div class="d-flex align-content-center justify-content-start">
                        <div class="icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="text">
                            {{$model->phone}}
                        </div>
                    </div>
                    @endif
                    @if($model->address)
                    <div class="d-flex align-content-center justify-content-start">
                        <div class="icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <div class="text">
                            {{$model->address}} {{$model->city}} {{$model->state}} {{$model->zip}} {{$model->country}}
                        </div>
                    </div>
                    @endif
                </div>
                
                <div id="purchase-bar-graph"></div>
                
            </div>
        </div>
    </div>
</div>



