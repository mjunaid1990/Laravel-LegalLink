@extends('layouts.user')

@section('title', $title)

@section('content')

<div class="profile-page-wrap">
    <div class="container">
        <div class="breadcrumb-wrap">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>

        </div>

        <br />


        <h2 class="profile-title">Dashboard</h2>
        
        <div class="row">
            <div class="col-md-7 col-12 mb-3">
                <div class="profile-avatar-box h-100">
                    <div class="avatar-bg">
                        <img src="/assets/img/legal/profile-avatar-bg.png" class="img-fluid" alt="avatar-bg" />
                    </div>
                    <div class="avatar-profile-info">
                        <div class="avatar-profile">
                            <img src="/assets/img/legal/cover.png" alt="profile" />
                        </div>
                        <div class="avatar-info-position">
                            <h2 class="avatar-title">{{Auth::user()->firstname.' '.Auth::user()->lastname}}</h2>
                            <div class="d-flex flex-column">
                                
                                <div class="d-flex company">
                                    <div class="company-name text-center">
                                        <h6> {{Auth::user()->email}} </h6>
                                    </div>
                                    <div class="action">
                                        <a href="/user/profile" type="button"><i
                                                class="bi bi-pencil-fill"></i></a>
                                    </div>
                                </div>
                                @if(Auth::user()->phone)
                                <div class="d-flex company">
                                    <div class="company-name">
                                        <h6> {{Auth::user()->phone}} </h6>
                                    </div>
                                    <div class="action">
                                        <a href="/user/profile" type="button"><i
                                                class="bi bi-pencil-fill"></i></a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-5 col-12 mb-3">
                <div class="profile-drag-box h-100">
                    <div class="d-flex drag-gap h-100">
                        <div class="upload-agreement-box flex-1 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 80 80" fill="none">
                                <g clip-path="url(#clip0_138_8196)">
                                <path d="M33.3333 53.3333H46.6666C48.5 53.3333 50 51.8333 50 50V33.3333H55.3C58.2666 33.3333 59.7666 29.7333 57.6666 27.6333L42.3666 12.3333C41.0666 11.0333 38.9666 11.0333 37.6666 12.3333L22.3666 27.6333C20.2666 29.7333 21.7333 33.3333 24.7 33.3333H30V50C30 51.8333 31.5 53.3333 33.3333 53.3333ZM20 60H60C61.8333 60 63.3333 61.5 63.3333 63.3333C63.3333 65.1667 61.8333 66.6667 60 66.6667H20C18.1666 66.6667 16.6666 65.1667 16.6666 63.3333C16.6666 61.5 18.1666 60 20 60Z" fill="#6C5DD3"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_138_8196">
                                <rect width="80" height="80" fill="white"/>
                                </clipPath>
                                </defs>
                            </svg>
                            <h4>Upload Files</h4>
                            <p>PNG, JPG and GIF files are not allowed</p>
                        </div>
                        <div class="d-flex flex-column align-items-center flex-1">
                            <div class="drag-info">
                                <h2 class="drag-title">Submit your agreement</h2>
                                <p class="drag-desc">Have a template that we need? Want to get paid for it, submit your document here.</p>
                            </div>
                            <div class="action">
                                <button type="button" value="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <div class="row">
            <div class="col-md-9">
                <div class="profile-agreement-box h-100">
                    <div class="d-flex justify-content-between mb-5 align-items-center">
                        <div class="profile-agreement-info">
                            <h2 class="agreement-title">Your agreements</h2>
                            <p class="agreement-desc">Here you can find your 5 most recent agreements</p>
                        </div>
                        <div class="action">
                            <a href="/user/agreements" type="button" value="submit">View All</a>
                        </div>
                    </div>
                    <div class="profile-download-files">
                        @if($purchased_agreements && count($purchased_agreements) > 0)
                            @foreach($purchased_agreements as $purchase)
                            <div class="d-flex justify-content-between align-items-center profile-download-info">
                                <div class="download-info">
                                    <h2 class="download-title">{{$purchase->agreement->name}}</h2>
                                    <p class="download-desc">{{$purchase->agreement->getCategoryName($purchase->agreement->category_id)}}</p>
                                </div>
                                @if($purchase->status == 'completed')
                                <div class="profile-download-img">
                                    <div class="d-flex">
                                        <div class="download-icon" data-id="{{$purchase->id}}" data-type="word">
                                            <i class="bi bi-file-earmark-word"></i>
                                        </div>
                                        <div class="download-icon" data-id="{{$purchase->id}}" data-type="pdf">
                                            <i class="bi bi-filetype-pdf"></i>
                                        </div>
                                        <div class="download-icon" data-id="{{$purchase->id}}" data-type="mail">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <form id="download-form" method="post" action="{{ route('download.agreement', $purchase->id)}}" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="type" />
                                </form>
                                
                                @else
                                <div class="profile-download-img">
                                    <a href="/user/generate-agreement/{{$purchase->agreement_id}}" class="btn btn-primary active">Generate</a>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        @else
                        <div class="d-flex justify-content-between align-items-center profile-download-info">
                                <div class="download-info">
                                    <p class="download-desc">no data found</p>
                                </div>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="profile-notification-box h-100">
                    <div class="d-flex justify-content-between">
                        <div class="profile-notification-info">
                            <h2 class="notification-title">Notification</h2>
                        </div>
                        <div class="notification-icon">
                            <i class="bi bi-three-dots"></i>
                        </div>
                    </div>
                    <div class="notification-switch">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" checked
                                   id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Expiry Date of
                                agreement</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch2">
                            <label class="custom-control-label" for="customSwitch2">Disabled switch
                                element</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


    </div>
</div>





@endsection

@section('scripts')

<script>
$(document).on('click', '.download-icon', function() {
    var type = $(this).data('type');
    $('input[name="type"]').val(type);
    $('#download-form').submit();
});
</script>
@stop
