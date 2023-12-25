@extends('layouts.admin')

@section('title', 'Dashboard - Agreements')

@section('content')

<div class="row mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div class="m-title">
            Agreements
        </div>
        <div class="btn-grp-actions">
            <div class="d-flex">
                <a href="javascript:void(0);" data-url="/admin/agreements/create" class="btn btn-primary sidebar-modal">
                    <i class="bx bx-plus"></i>
                    Add Agreement
                </a>
            </div>
        </div>
    </div>
</div>

@include('_partials.flash')

<div class="row justify-content-end mb-3">
    <div class="col-12 col-md-3">
        <form method="get" id="search-form">
            <div class="input-group input-group-merge">
              <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
              <input type="text" class="form-control" name="q" placeholder="Search..." value="{{$q}}">
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-4">
        <div class="table-listing">
            <div class="table-responsive">
                <table id="agreement-table" class="table table-white-rows">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th></th>
                            <th><i class="bx bx-trash d-none"></i></th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(!empty($lists) && $lists->count())
                        @foreach($lists as $key => $model)
                        <tr>
                            <td>#{{$model->id}}</td>
                            <td>{{$model->name}}</td>
                            <td class="text-primary">{{$model->category_id?$model->getCategoryName($model->category_id):''}}</td>
                            <td><i class="bx bx-calendar text-green me-1 position-relative" style="top: 1px;"></i>{{$model->date}}</td>
                            <td>
                                @if($model->status == 'hidden')
                                    <span class="badge rounded-pill bg-label-danger py-2 px-4">Hidden</span>
                                @elseif($model->status == 'draft')
                                    <span class="badge rounded-pill bg-label-primary py-2 px-4">Draft</span>
                                @elseif($model->status == 'published')
                                    <span class="badge rounded-pill bg-label-success py-2 px-4">Published</span>
                                @endif
                            </td>
                            <td><i class="bx bx-star"></i></td>
                            <td class="action">
                                <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                                    <div class="bg-white dark__bg-1000 rounded-2">

                                        <a class="dropdown-item sidebar-modal" href="javascript:void(0);" data-url="/admin/agreements/edit/{{$model->id}}">
                                            Edit
                                        </a>
                                        
                                        <a class="dropdown-item sidebar-modal" href="javascript:void(0);" data-url="/admin/agreements/inputs/{{$model->id}}">
                                            Add / Remove Inputs
                                        </a>

                                        <a class="dropdown-item text-danger" data-method="DELETE" href="javascript:void(0)" 
                                           onclick="if(!confirm('Are you sure you want to delete?')){return false;} event.preventDefault();
                                               document.getElementById('delete-form-{{$model->id}}').submit();">
                                            Delete

                                            <form method="post" id="delete-form-{{$model->id}}" action="{{ route('admin.agreement.delete', $model->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                @method('delete')


                                            </form>

                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                        @else
                        <tr>
                            <td colspan="7">There are no data.</td>
                        </tr>
                        @endif


                    </tbody>
                </table>

            </div>
            {{ $lists->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>


@endsection
