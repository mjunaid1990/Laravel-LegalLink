@extends('layouts.admin')

@section('title', 'Dashboard - Transactions')

@section('content')

<div class="row mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div class="m-title">
            Transactions
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
                            <th>Customer</th>
                            <th>Txn ID</th>
                            <th>amount</th>
                            <th>Currency</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(!empty($lists) && $lists->count())
                        @foreach($lists as $key => $model)

                        
                        <tr>
                            <td>#{{$model->id}}</td>
                            <td>{{$model->customer->firstname.' '.$model->customer->lastname}}</td>
                            <td>{{$model->txn_id}}</td>
                            <td>{{number_format($model->amount, 2)}}</td>
                            <td>{{$model->currency}}</td>
                            
<!--                            <td class="action">
                                <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                                    <div class="bg-white dark__bg-1000 rounded-2">

                                        <a class="dropdown-item sidebar-modal" href="javascript:void(0);" data-url="/admin/customers/view/{{$model->id}}">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </td>-->
                        </tr>
                        @endforeach

                        @else
                        <tr>
                            <td colspan="6">There are no data.</td>
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
