@extends('layouts.admin')

@section('title', 'Dashboard - Settings')

@section('content')

<div class="row mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div class="m-title">
            Settings
        </div>
    </div>
</div>

@include('_partials.flash')

<form class="setting-form" enctype="multipart/form-data" method="post" action="{{ route('admin.setting.store')}}">
    @csrf
    <h5>Recommendation Boxes</h5>
    
    <div class="row mb-4">
        <div class="col-12 col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Box 1</div>
                </div>
                <div class="card-body">
                    <div class="form-group mt-3">
                        <label for="recommended_box_1_title" class="control-label">Title</label>
                        <input type="text" id="recommended_box_1_title" name="recommended_box_1_title" class="form-control" placeholder="Title" value="{{get_setting_value_by_key('recommended_box_1_title')}}" />
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="recommended_box_1_desc" class="control-label">Description</label>
                        <textarea id="recommended_box_1_desc" name="recommended_box_1_desc" class="form-control" placeholder="Title" rows="3">{{get_setting_value_by_key('recommended_box_1_desc')}}</textarea>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="recommended_box_1_agreements" class="control-label">Agreements</label>
                        <select id="recommended_box_1_agreements" name="recommended_box_1_agreements[]" class="form-control selectpicker" multiple="true">
                            <option value="" disabled>Select</option>
                            @if($agreements)
                                @foreach($agreements as $agree)
                                    @php
                                        $sel_ = '';
                                        $agree_sel_ = get_setting_value_by_key('recommended_box_1_agreements');
                                        if($agree_sel_) {
                                            $agree_arr_ = explode(',',$agree_sel_);
                                            if(in_array($agree->id, $agree_arr_)) {
                                                $sel_ = 'selected';
                                            }
                                        }
                                    @endphp
                                    <option value="{{$agree->id}}" {{$sel_}}>{{$agree->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Box 2</div>
                </div>
                <div class="card-body">
                    <div class="form-group mt-3">
                        <label for="recommended_box_2_title" class="control-label">Title</label>
                        <input type="text" id="recommended_box_2_title" name="recommended_box_2_title" class="form-control" placeholder="Title" value="{{get_setting_value_by_key('recommended_box_2_title')}}" />
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="recommended_box_2_desc" class="control-label">Description</label>
                        <textarea id="recommended_box_2_desc" name="recommended_box_2_desc" class="form-control" placeholder="Title" rows="3">{{get_setting_value_by_key('recommended_box_2_desc')}}</textarea>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="recommended_box_2_agreements" class="control-label">Agreements</label>
                        <select id="recommended_box_2_agreements" name="recommended_box_2_agreements[]" class="form-control selectpicker" multiple="true">
                            <option value="" disabled>Select</option>
                            @if($agreements)
                                @foreach($agreements as $agree)
                                    @php
                                        $sel = '';
                                        $agree_sel = get_setting_value_by_key('recommended_box_2_agreements');
                                        if($agree_sel) {
                                            $agree_arr = explode(',',$agree_sel);
                                            if(in_array($agree->id, $agree_arr)) {
                                                $sel = 'selected';
                                            }
                                        }
                                    @endphp
                                    <option value="{{$agree->id}}" {{$sel}} >{{$agree->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <h5>Yoco Api Keys</h5>
    <div class="row mb-4">
        <div class="col-12 col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Yoco Api Keys</div>
                </div>
                <div class="card-body">
                    
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group mt-3">
                                <label for="yoco_test_public_key" class="control-label">Test Public Key:</label>
                                <input type="text" id="yoco_test_public_key" name="yoco_test_public_key" class="form-control" placeholder="" value="{{get_setting_value_by_key('yoco_test_public_key')}}" />
                            </div>
                            
                            <div class="form-group mt-3">
                                <label for="yoco_test_secret_key" class="control-label">Test Secret Key:</label>
                                <input type="text" id="yoco_test_secret_key" name="yoco_test_secret_key" class="form-control" placeholder="" value="{{get_setting_value_by_key('yoco_test_secret_key')}}" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mt-3">
                                <label for="yoco_live_public_key" class="control-label">Live Public Key:</label>
                                <input type="text" id="yoco_live_public_key" name="yoco_live_public_key" class="form-control" placeholder="" value="{{get_setting_value_by_key('yoco_live_public_key')}}" />
                            </div>

                            <div class="form-group mt-3">
                                <label for="yoco_live_secret_key" class="control-label">Live Secret Key:</label>
                                <input type="text" id="yoco_live_secret_key" name="yoco_live_secret_key" class="form-control" placeholder="" value="{{get_setting_value_by_key('yoco_live_secret_key')}}" />
                            </div>
                        </div>
                    </div>
                    @php
                    $is_yoco_live = get_setting_value_by_key('yoco_live_mode')
                    @endphp
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" name="yoco_live_mode" value="1" id="defaultCheck1" {{$is_yoco_live == 1?'checked':''}}>
                        <label class="form-check-label" for="defaultCheck1">
                          Live mode
                        </label>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    
    
    <div class="w-100 text-end">
        <button type="submit" class="btn btn-primary">
            <i class="bx bx-save"></i> 
            Save Settings
        </button>
    </div>
    
</form>

@endsection
