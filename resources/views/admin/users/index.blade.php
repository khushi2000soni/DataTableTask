@extends('layouts.app')
@section('title')@lang('quickadmin.user-management.title')@endsection
@section('customCss')
<meta name="csrf-token" content="{{ csrf_token() }}" >
@endsection

@section('main-content')

<section class="section roles" style="z-index: unset">   
    <div class="section-body">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>@lang('quickadmin.user-management.title')</h4>                 
            </div>
            <div class="card-body">
                <div class="table-responsive">
                {{$dataTable->table(['class' => 'table dt-responsive', 'style' => 'width:100%;','id'=>'dataaTable'])}}
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>
@endsection


@section('customJS')
{!! $dataTable->scripts() !!}
  <script src="{{ asset('admintheme/assets/bundles/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('admintheme/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admintheme/assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>  
  <script src="{{ asset('admintheme/assets/js/page/datatables.js') }}"></script>


<script>
$(document).ready(function () {
    var DataaTable = $('#dataaTable').DataTable();
    $('.dataTable thead tr').first().addClass('headingRow');

    $(document).on('click','.custom-filter-submit',function(e){
        e.preventDefault();     
        var email =  $('#email').val();
        var username =  $('#username').val();
        var status =  $('#status').val();
        var type =  $('#type').val();
        var created_at =  $('#created_at').val();
        var params = {};

        if (email !== "") {
            params['email'] = email;
        }

        if (username !== "") {
            params['username'] = username;
        }

        if (status !== "") {
            params['status'] = status;
        }

        if (type !== "") {
            params['type'] = type;
        }

        if (created_at !== "") {
            params['created_at'] = created_at;
        }
        
        DataaTable.ajax.url("{{ route('user.index') }}?"+$.param(params)).load();   

    });

    $(document).on('click','.custom-filter-reset', function(e) {
        e.preventDefault();
        $('#email').val('');
        $('#username').val('');
        $('#status').val('');
        $('#type').val('');
        $('#created_at').val('');     
        DataaTable.ajax.url("{{ route('user.index') }}").load();
    });
});

</script>
@endsection
