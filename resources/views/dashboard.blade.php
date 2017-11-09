@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div id="page-wrapper">
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <!--quick info section -->
                <div class="col-lg-3">
                    <div class="alert alert-danger text-center">
                        <i class="fa fa-calendar fa-3x"></i>&nbsp;<b>{{$statistics['today_ads']}} </b>Today Ads

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="alert alert-success text-center">
                        <i class="fa  fa-beer fa-3x"></i>&nbsp;<b>{{$statistics['month_ads']}} </b>Month Ads 
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="alert alert-info text-center">
                        <i class="fa fa-rss fa-3x"></i>&nbsp;<b>{{$statistics['today_customers']}} </b> Today Customers

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="alert alert-warning text-center">
                        <i class="fa  fa-pencil fa-3x"></i>&nbsp;<b>{{$statistics['month_customers']}} </b>Month Customers
                    </div>
                </div>
                <!--end quick info section -->
            </div>

            <div class="row">
                <div class="col-lg-10">
                    <!--End area chart example -->
                    <!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>Latest Ads
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="list" class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Category</th>
                                                    <th>Image</th>
                                                    <th>Price</th>
                                                    <th>User</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>

                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!--End simple table example -->
                </div>

                <div class="col-lg-2">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body yellow">
                            <i class="fa fa-bar-chart-o fa-3x"></i>
                            <h3>{{$statistics['admins']}} </h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Number of Admins
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection
@section('scripts')
<script src="{{asset('assets/plugins/dataTables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/dataTables/dataTables.bootstrap.js')}}"></script>
    <!-- <script src="{{asset('assets/plugins/morris/raphael-2.1.0.min.js')}}"></script> -->
<!--     <script src="{{asset('assets/plugins/morris/morris.js')}}"></script>
    <script src="{{asset('assets/scripts/dashboard-demo.js')}}"></script> -->

    <script type="text/javascript">
    $(function(){  
        datatable();
        // Get the image and insert it inside the modal - use its "alt" text as a caption
        $('body').on('click', '.product-image', function () {
            var dialog = bootbox.dialog({
                message: '<img style="height:500px; width:100%" src="' + $(this).attr('src') + '"/>',
                closeButton: true
            });
        });
    });

    function datatable()
    {
        var url = "{{url('products/datatable?date=today')}}";
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
                { data: 'date', name: 'date'},
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description'},
                { data: 'category', name: 'category' },
                { data: 'image', name: 'image',
                    render: function ( data, type, row, meta )
                    {
                        return '<img class="product-image" src="'+data+'" height="42" width="42">';
                    }
                },
                { data: 'price', name: 'price' },
                { data: 'user', name: 'user' }
            ]
        });
        $(".dataTables_paginate").css({'text-align':'right'});
        $(".dataTables_filter").css({'text-align':'right'});
    }
</script>
@endsection