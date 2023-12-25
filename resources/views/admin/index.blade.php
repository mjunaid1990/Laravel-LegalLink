@extends('layouts.admin')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js?v='.time())}}"></script>
@endsection

@section('content')

<div class="row mb-5">
    <div class="d-flex justify-content-between align-items-center">
        <div class="m-title">
            Products Analytics
        </div>
        <div class="date-range">
            <div class="d-flex">
                <input class="form-control me-3" type="date" value="" id="date_from" data-date="" data-date-format="DD MMMM YYYY" />
                <input class="form-control" type="date" value="" id="date_to" />
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div class="left-flex btn-groug-with-radius">
<!--            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked="" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio1">Product</label>
                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio2">Customer</label>
            </div>-->
        </div>
        <div class="right-flex no-btn-shadow">
            <div class="add-button-group">
                <a href="javascript:void(0);" data-url="/admin/promotions/create" class="btn btn-primary sidebar-modal">
                    <i class="bx bx-plus"></i>
                    Add Promotion
                </a>
                <a href="javascript:void(0);" data-url="/admin/categories/create" class="btn btn-primary sidebar-modal">
                    <i class="bx bx-plus"></i>
                    Add Category
                </a>
                <a href="javascript:void(0);" data-url="/admin/agreements/create" class="btn btn-primary sidebar-modal">
                    <i class="bx bx-plus"></i>
                    Add Agreement
                </a>
            </div>
        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-lg-8 mb-4 order-0">
        <div class="row mb-4">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="info d-flex align-items-center px-3 pt-3">
                            <div class="p-icon">
                                <div class="icon-circle badge badge-center rounded-pill bg-label-primary">
                                    <i class="bx bx-package"></i>
                                </div>
                            </div>
                            <div class="p-title ms-3">
                                <h5>Total Product</h5>
                                <div class="price">{{$total_agreements?number_format($total_agreements):0}}</div>
                            </div>
                            <div class="p-count">
                                <span>+{{$today_agreements?$today_agreements:0}} new added</span>
                            </div>
                        </div>
                        <div class="content">
                            <div id="product-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="info d-flex align-items-center px-3 pt-3">
                            <div class="p-icon">
                                <div class="icon-circle badge badge-center rounded-pill bg-label-danger">
                                    <i class="bx bx-cart"></i>
                                </div>
                            </div>
                            <div class="p-title ms-3">
                                <h5>Total Sales</h5>
                                <div class="price">{{$total_sales?number_format($total_sales):0}}</div>
                            </div>
                            <div class="p-count">
                                <span>+{{$today_sales?$today_sales:0}} sales today</span>
                            </div>
                        </div>
                        <div class="content">
                            <div id="product-chart2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Top Selling Products</h5>
                        <a href="/admin/agreements" id="see-more">See More</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="agreement-table" class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th class="name-col">Name</th>
                                        <th>Price</th>
                                        <th>Total Order</th>
                                        <th>Total Sales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($topselling && $topselling->count())
                                        @foreach($topselling as $k=>$selling)
                                        <tr>
                                            <td>{{$k+1}}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="circle"></div>
                                                    <a href="#" class="name">{{$selling->agreement->name}}</a>
                                                </div>
                                            </td>
                                            <td>R{{$selling->agreement->sale_price}}</td>
                                            <td>{{number_format($selling->max)}}</td>
                                            <td class="total-price">R{{number_format($selling->totalSales($selling->agreement_id))}}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5">no data found</td>
                                    </tr>
                                    @endif
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-lg-4 col-md-4 order-1">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-0">Sales by month</h5>
                        <div id="sales-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-12">
                <div class="card dashboard-agreement-box">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-box">
                                <div class="icon">
                                    <i class="bx bx-note"></i>
                                </div>
                            </div>
                            <div class="text-heading d-flex flex-column">
                                <span>{{$total_agreements?$total_agreements:0}}+</span>
                                <span class="name">Agreements</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body dashboard-user-box">
                        <div class="d-flex align-items-center">
                            <div class="icon-box">
                                <div class="icon">
                                    <i class="bx bx-user"></i>
                                </div>
                            </div>
                            <div class="text-heading d-flex flex-column">
                                <span>{{$total_customers?$total_customers:0}}+</span>
                                <span class="name">Users</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>


@endsection
