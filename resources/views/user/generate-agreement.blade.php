@extends('layouts.app')

@section('title', 'Generate Agreement')

@section('content')

<div class="generate-page">

    <div class="breadcrumb-wrap">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Generate Document</li>
                </ol>
            </nav>
        </div>

    </div>

    <div class="container py-5">
        <div class="stepper-wrap">
            <ul id="progressbar">
                <li class="active" id="account" style="width: 50%"><strong>Generate document</strong></li>
                <li id="personal" style="width: 50%"><strong>Download</strong></li>
            </ul>
        </div>
    </div>



    <div class="clear" style="clear: both;"></div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="customfields-crud-box">
                    @include('_partials/_inputs_fill', ['fields'=>$fields, 'model'=>$agreement])
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="agreement-preview-wrap text-center">
                    <button type="button" class="btn btn-primary" id="agreement-preview-btn">
                        <i class="bx bx-bullseye"></i> 
                        Preview Doc
                    </button>

                    <div class="agreement-preview-box">
                        @include('_partials/_agreement_file_preview', ['model'=>$agreement])
                    </div>

                </div>

            </div>
        </div>
    </div>


</div>

@endsection