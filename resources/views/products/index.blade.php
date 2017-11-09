@extends('layouts.master')
@section('title', 'Users Ads')

@section('styles')

@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Products</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Products
                </div>
                <div class="panel-body">
                    <div class="flash"></div>
                    <div class="table-responsive">
                        <table id="list" class="table table-striped table-bordered table-hover"
                        	id="dataTables-example">
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
                                    <th>Status</th>
                                    <th>Operations</th>
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
        var url = "{{url('products/datatable')}}";
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
                { data: 'user', name: 'user' },
                { data: 'status', name: 'status',
                    render: function ( data, type, row, meta )
                    {
                        var status = 'Pending';
                        switch(data)
                        {
                            case "{{config('constants.product_statuses.pending')}}": status = "Pending";
                                break;
                            case "{{config('constants.product_statuses.approved')}}": status = "Approved";
                                break;
                            case "{{config('constants.product_statuses.rejected')}}": status = "Rejected";
                                break;
                        }         
                        return status;
                    }
                },
                { data: 'operations', name: 'operations',
                    render: function ( data, type, row, meta )
                    {
                        
                        var rejected = "{{config('constants.product_statuses.rejected')}}";
                        var approved = "{{config('constants.product_statuses.approved')}}";
                        var status = row.status;
                        var id = row.id;
                        var menu = '<div class="actions" status="'+ status +'">'+
                                    '<button type="button" class="btn btn-danger btn-sm '+id+'" id='+id+ 
                                    ' style="margin-right:3px">'+
                                    '<span class="glyphicon glyphicon-trash glyphicon glyphicon-thumbs-down"></span>'+
                                '</button>' +
                                '<button type="button" class="btn btn-primary btn-sm '+id+'" id='+id+
                                    ' style="margin-right:3px">'+
                                    '<span class="glyphicon glyphicon-thumbs-up"></span></button></div>' ;

                        if(status == "{{config('constants.product_statuses.approved')}}")
                        {
                            $('.btn-primary.'+id).attr('disabled','disabled');
                        }
                        if(status == "{{config('constants.product_statuses.rejected')}}")
                        {
                            $(".btn-danger."+id).attr('disabled','disabled');
                        }
                        return menu;                           
                    }
                }
            ]
        });
        $(".dataTables_paginate").css({'text-align':'right'});
        $(".dataTables_filter").css({'text-align':'right'});
    }

    $("body").on("click", '.btn-sm', function(){
        var id = $(this).attr('id');
        var btn = $(this);
        var actions_div = $(this).closest(".actions");
        var status;
        if(btn.hasClass('btn-danger'))
             status = "{{config('constants.product_statuses.rejected')}}";
        else if(btn.hasClass('btn-primary'))
             status = "{{config('constants.product_statuses.approved')}}";

        bootbox.confirm("Are you sure want to change this ad status?", function (result) {
            if (result == true) {
                var data = {id: id, status:status, _token: "{{ csrf_token() }}"};
                $.ajax({
                    method: 'POST',
                    url: "{{url('products/change_status')}}",
                    data: data,
                    async: false,
                    success: function(response){
                        // status >> old status
                        if(response.new_status == "{{config('constants.product_statuses.approved')}}")
                        {
                            $('.btn-danger#'+id).removeAttr('disabled');
                            $('.btn-danger#'+id).next().attr("disabled", "disabled");
                            btn.closest("td").prev().html("Approved");
                        }
                        else if(response.new_status == "{{config('constants.product_statuses.rejected')}}")
                        {
                            $('.btn-danger#'+id).next().removeAttr("disabled");
                            $('.btn-danger#'+id).attr('disabled', 'disabled');
                            btn.closest("td").prev().html("Rejeted");
                        }
                        actions_div.attr('status', response.new_status);
                        $(".flash").html(response.html);
                        setTimeout(function(){$(".close").click();}, 10000);

                    },
                    error: function(){
                       alert("not changed");
                    }
                });
            };
        });
    });
</script>
@endsection