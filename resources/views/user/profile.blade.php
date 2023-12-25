@extends('layouts.user')

@section('title', 'Profile - '.Auth::user()->firstname)

@section('content')

<div class="profile-page-wrap">
    <div class="container">
        <div class="breadcrumb-wrap">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>

        </div>

        <br />


        <h2 class="profile-title">Profile</h2>
        
        <div class="row">
            <div class="col-12 col-md-6">
                
                <div class="card">
                    <div class="card-body">
                        <form id="ajax-form" class="sub-form" enctype="multipart/form-data" method="post" action="{{ route('user.profile')}}">
                            @csrf
                            <div class="form-group">
                                <label for="firstname" class="col-form-label">First Name</label>
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ $model->firstname }}" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="lastname" class="col-form-label">Last Name</label>
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ $model->lastname }}">
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-form-label">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ $model->email }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-form-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" value="">
                                <p><small>Note: Leave it blank if you do not want to change password!</small></p>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-form-label">Phone</label>
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ $model->phone }}">
                            </div>
                            
                            <button type="submit" class="btn btn-primary active">
                                Save
                            </button>

                        </form>
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
