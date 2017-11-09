@extends('layouts.master')
@section('title', 'Admins')
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Admins</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Admins</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="list" class="table table-striped table-bordered table-hover"
                        	id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                        </table>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section("scripts")
<script src="{{asset('assets/plugins/dataTables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/dataTables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('assets/scripts/bootbox.js')}}"></script>
<script type="text/javascript">
$('#list').dataTable();
    $(function(){  
        datatable();

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        $('body').on('click', '.user-image', function () {
            var dialog = bootbox.dialog({
                message: '<img style="height:500px; width:100%" src="' + $(this).attr('src') + '"/>',
                closeButton: true
            });
        });
    });

    function datatable()
    {
        var url = "{{url('admins/datatable')}}";
        $('#list').dataTable().fnDestroy();
        $('#list').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "responsive": true,
            processing: false,
            serverSide: false,
            ajax: url,
            columns: [
                { data: 'id', name: 'id'},
                { data: 'name', name: 'name' },
                { data: 'phone', name: 'phone'},
                { data: 'email', name: 'email' },
            ]
        });
        $(".dataTables_paginate").css({'text-align':'right'});
        $(".dataTables_filter").css({'text-align':'right'});
    }
</script>
@endsection