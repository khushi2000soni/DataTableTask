@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('title')@lang('quickadmin.qa_dashboard')@endsection
@section('customCss')
<meta name="csrf-token" content="{{ csrf_token() }}" >
@endsection

@section('main-content')

<section class="section roles" style="z-index: unset">
    <div class="section-header ">
      <h1> @lang('quickadmin.qa_dashboard')</h1>
      <div class="section-header-breadcrumb ">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">@lang('quickadmin.qa_dashboard')</a></div>
      </div>
    </div>
    <div class="section-body">
          <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="card card-info shadow">
                                    <div class="card-header">
                                        <div class="card-square l-bg-cyan text-white rounded">
                                            <i class="fas fa-rupee-sign p-2"></i>
                                        </div>
                                        <h4 class="mx-2">@lang('quickadmin.dashboard.todaySaleAmount')</h4>
                                    </div>
                                    <div class="card-body">
                                        <h4>{{ $todaySaleAmount }}</h4>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="card card-info shadow" >
                                    <div class="card-header">
                                        <div class="card-square l-bg-cyan text-white rounded">
                                            <i class="fas fa-rupee-sign p-2"></i>
                                        </div>
                                        <h4 class="mx-2">@lang('quickadmin.dashboard.last7DaysSaleAmount')</h4>
                                    </div>
                                    <div class="card-body">
                                        <h4>{{ $last7DaysSaleAmount }}</h4>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="card card-info shadow">
                                    <div class="card-header">
                                        <div class="card-square l-bg-cyan text-white rounded">
                                            <i class="fas fa-rupee-sign p-2"></i>
                                        </div>
                                        <h4 class="mx-2">@lang('quickadmin.dashboard.last30DaysSaleAmount')</h4>
                                    </div>
                                    <div class="card-body">
                                        <h4>{{ $last30DaysSaleAmount }}</h4>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="card card-info shadow">
                                    <div class="card-header">
                                        <div class="card-square l-bg-cyan text-white rounded">
                                            <i class="fas fa-rupee-sign p-2"></i>
                                        </div>
                                        <h4 class="mx-2 me-0">@lang('quickadmin.dashboard.allSaleAmount')</h4>
                                    </div>
                                    <div class="card-body">
                                        <h4>{{ $allSaleAmount }}</h4>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="card card-info shadow">
                                    <div class="card-header">
                                        <div class="card-square l-bg-cyan text-white rounded">
                                            <i class="fas fa-shopping-cart p-2"></i>
                                        </div>
                                        <h4 class="mx-2 me-0">@lang('quickadmin.dashboard.todayTotalOrder')</h4>
                                    </div>
                                    <div class="card-body">
                                        <h4>{{ $todayTotalOrder }}</h4>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="card card-info shadow">
                                    <div class="card-header">
                                        <div class="card-square l-bg-cyan text-white rounded">
                                            <i class="far fa-credit-card p-2"></i>
                                        </div>
                                        <h4 class="mx-2 me-0">@lang('quickadmin.dashboard.totalProductInStock')</h4>
                                    </div>
                                    <div class="card-body">
                                        <h4>{{ $totalProductInStock }}</h4>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="card card-info shadow">
                                    <div class="card-header">
                                        <div class="card-square l-bg-cyan text-white rounded">
                                            <i class="far fa-credit-card p-2"></i>
                                        </div>
                                        <h4 class="mx-2 me-0">@lang('quickadmin.dashboard.totalCategory')</h4>
                                    </div>
                                    <div class="card-body">
                                        <h4>{{ $totalCategory }}</h4>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="card card-info shadow">
                                    <div class="card-header">
                                        <div class="card-square l-bg-cyan text-white rounded">
                                            <i class="fas fa-user-plus p-2"></i>
                                        </div>
                                        <h4 class="mx-2 me-0">@lang('quickadmin.dashboard.totalCustomer')</h4>
                                    </div>
                                    <div class="card-body">
                                        <h4>{{ $totalCustomer }}</h4>
                                    </div>
                                    </div>
                                </div>
                            </div>

                </div>
                <div class="col-md-12 col-12 col-sm-12">
                    <div class="card overflow-hidden h-100">
                      <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="mt-1 mb-1">@lang('quickadmin.dashboard.order')</h5>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-1">
                                    <select id="timeFrameOrderSelectTable" class="form-select">
                                        <option value="today">@lang('quickadmin.dashboard.today')</option>
                                        <option value="7days">@lang('quickadmin.dashboard.7days')</option>
                                        <option value="30days">@lang('quickadmin.dashboard.30days')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="card-body" style="max-height: 430px;  overflow-y: auto;">
                        <div class="table-responsive">
                          <table class="table" id="order-table-body">
                            <thead>
                            <tr>
                              <th class="py-0">@lang('quickadmin.dashboard.customer')</th>
                              <th class="py-0 text-center">@lang('quickadmin.dashboard.amount')</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

                          </table>
                        </div>
                      </div>
                    </div>
                </div>
          </div>
    </div>
  </section>
@endsection


@section('customJS')
<script src="{{ asset('admintheme/assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
$(document).ready(function() {

    // Function to update the table data
    function updateTableData(timeFrame) {
        var data = { timeFrame: timeFrame };
        $.ajax({
            type: 'GET',
            url: "{{ route('fetchReportData') }}",
            data: data,
            success: function(response) {
                var newData = response.data;
                console.log('newData', newData);

                // Update the table content
                var tableBody = $('#order-table-body tbody');
                tableBody.empty();
                newData.forEach(function(order) {
                    var row = '<tr><td><div class="media-body"><div class="media-tab-title font-weight-bold">' + order.customer.name + '</div>' +
                              '<div class="text-job text-muted">#' + order.invoice_number + '</div></div></td><td>' + order.grand_total  + '</td></tr>';
                    tableBody.append(row);
                });
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    // Handle the time frame select change for the table
    $('#timeFrameOrderSelectTable').on('change', function(e) {
        e.preventDefault();
        var selectedTimeFrame = this.value;
        updateTableData(selectedTimeFrame);
    });

    // Load the default data when the page loads
    updateTableData('today');
});
</script>


@endsection
