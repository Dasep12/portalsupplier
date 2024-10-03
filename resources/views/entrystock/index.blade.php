@extends('layouts.master')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Stock</h4>
                <span class="breadcrumbs">
                </span>
                Upload Safety Stock
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if (CrudMenuPermission($MenuUrl, $user_id, 'view'))
                    <div class="card" style="height: 500px;">
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col-md-8">
                                    <!-- kosong dulu -->

                                </div>
                                <div class="col-md-4 d-flex justify-content-end">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-custom-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="fa fa-filter"></span> Filter
                                        </button>
                                        <form id="form-filter" class="mr-5 dropdown-menu p-4 bg-light" style="width:320px">
                                            <h6>Filter Safety Stock</h6>
                                            <div class="form-group form-group-sm">
                                                <div class="input-group input-group-sm">
                                                    <select id="supplier_id" name="supplier_id" style="font-size: 0.85rem !important;" class="form-control form-control-sm custom-select select2">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" placeholder="Search Part Name" class="form-control form-control-sm" name="part_name" id="part_name">
                                                </div>
                                            </div>

                                            <div class="form-group form-group-sm">
                                                <div class="input-group input-group-sm">
                                                    <input id="date_upload" name="date_upload" value="<?= date('Y-m-d') ?>" type="date" class="form-control date" placeholder="End Date">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <div class="input-group input-group-sm">
                                                    <button type="button" id="filterBtn" class="btn btn-dark btn-sm"><span class="fa fa-search"></span> Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="jqGrid"></table>
                                <div id="jqGridPager"></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-12 mt-2">
                                    @if(CrudMenuPermission($MenuUrl, $user_id, 'add'))
                                    <button type="button" onclick="CrudUnit('upload','*')" class="btn btn-primary btn-custom-primary"><i class="fas fa-cloud-upload-alt"></i> Upload Stock</button>
                                    @endif
                                    <button onclick="reloadGridList()" class="btn btn-primary btn-custom-primary"><i class="fa fa-sync-alt"></i> Reload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="card" style="height: 500px;">
                        <div class="card-body card-body d-flex justify-content-center align-items-center">
                            <div class="row">
                                <h1 class="fw-bold">Oops ! </h1><br>
                                <h1> Sorry,module can't be access</h1>
                            </div>
                            <div class="row">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        var dataTemp = [];

        function jsonListSupplier() {
            $.ajax({
                url: "{{ url('jsonListSupplier') }}",
                method: "GET",
                cache: false,
                success: function(data) {
                    var supplier_id = "{{ session()->get('supplier_id') }}"
                    // Clear the current options
                    $('#supplier_id').empty();
                    $('#suppliers_id').empty();
                    if (supplier_id == "*") {
                        $('#supplier_id').append('<option value="">All Supplier</option>');
                        $('#suppliers_id').append('<option value="">All Supplier</option>');
                    }
                    // Loop through the data and append options
                    $.each(data, function(index, item) {
                        if (supplier_id == item.id) {
                            $('#supplier_id').append($('<option>', {
                                value: item.id, // assuming 'id' is the value to be sent
                                text: item.supplier_name // assuming 'name' is the display text
                            }));

                            $('#suppliers_id').append($('<option>', {
                                value: item.id, // assuming 'id' is the value to be sent
                                text: item.supplier_name // assuming 'name' is the display text
                            }));
                            return false;
                        }

                        if (supplier_id == "*") {
                            $('#supplier_id').append($('<option>', {
                                value: item.id, // assuming 'id' is the value to be sent
                                text: item.supplier_name // assuming 'name' is the display text
                            }));

                            $('#suppliers_id').append($('<option>', {
                                value: item.id, // assuming 'id' is the value to be sent
                                text: item.supplier_name // assuming 'name' is the display text
                            }));
                        }
                    });
                }
            })
        }

        jsonListSupplier()

        function reloadGridList() {
            $("#jqGrid").jqGrid('setGridParam', {
                datatype: 'json',
                mtype: 'GET',
                postData: {
                    search: $("#searchInput").val(),
                    date_stock: $("#date_upload").val(),
                    supplier_id: $("#supplier_id").val(),
                    part_name: $("#part_name").val()
                }
            }).trigger('reloadGrid');
        }

        function reloadgridItem(data) {
            // Clear existing data
            $("#JqGridTempUpload").jqGrid('clearGridData', true);
            $("#JqGridTempUpload").jqGrid('setGridParam', {
                data: data
            });
            // Refresh the grid
            $("#JqGridTempUpload").trigger('reloadGrid');
        }


        $("#jqGrid").jqGrid({
            url: "{{ url('jsonStockList') }}",
            datatype: "json",
            mtype: "GET",
            postData: {
                "_token": "{{ csrf_token() }}",
                date_stock: $("#date_upload").val(),
                supplier_id: $("#supplier_id").val()
            },
            colModel: [{
                label: 'Supplier Name',
                name: 'supplier_name',
                // width: 75
            }, {
                label: 'Part Name',
                name: 'part_name',
                // width: 75
            }, {
                label: 'Part Number',
                name: 'part_number',
                // width: 90
            }, {
                label: "Qty Safety Stock",
                name: "safetyStock",
                align: 'center',
                formatter: function(value, option, row) {
                    var color = value == 'not set' ? 'text-danger' : ''
                    return `<span class="${color} fw-bold">${value}</span>`
                }
            }, {
                label: "Date",
                name: "date_stock",
                align: 'center'
                // formatter: "date",
                // formatoptions: {
                //     srcformat: "ISO8601Long",
                //     newformat: "d M Y"
                // },
            }],
            viewrecords: true,
            rowNum: 15,
            rownumbers: true,
            rownumWidth: 30,
            width: '100%',
            height: 300,
            autoresizeOnLoad: true,
            autowidth: true,
            pager: "#jqGridPager",
            rowList: [15, 30, 50],
            jsonReader: {
                repeatitems: false,
                root: "rows",
                page: "page",
                total: "total",
                records: "records"
            },
            loadComplete: function(data) {
                $(window).on('resize', function() {
                    var gridWidth = $('.table-responsive').width(); // Get the width of the container
                    $('#jqGrid').setGridWidth(gridWidth - 5); // Adjust the grid width
                }).trigger('resize'); // Trigger resize on page load

            },
        });


        function CrudUnit(act, id) {
            document.getElementById("CrudEntryStockFormUpload").reset();
            $('#ErrorInfoUpload').html('');
            $("#CrudActionStockUpload").val(act);
            $("#CrudEntryStockFormUpload").find("label.error").remove(); // Remove any error labels
            $("#CrudEntryStockFormUpload").find(".error").removeClass("error"); // Remove error class from inputs
            dataTemp = [];
            reloadgridItem(dataTemp)
            $('.progress').hide();
            switch (act) {
                case 'upload':
                    $(".btn-upload-file").attr("disabled", true)
                    $(".modal-title").html(`<i class="fas fa-plus-square"></i> Upload Safety Stock`)
                    $("#CrudEntryStockModalUpload").modal('show');
                    break;
            }
        }

        function doSuccess(data, action) {
            switch (action) {
                case "upload":
                    showToast(data, action, "has been saved succesfully")
                    reloadGridList();
                    break;
                case "update":
                    showToast(data, action, "has been saved succesfully")
                    reloadGridList();
                    break;
                case "delete":
                    showToast(data, action, " has been removed succesfully")
                    reloadGridList();
                    break;
            }
        }



        $("#filterBtn").click(function() {
            reloadGridList()
        })
    </script>
    @include('entrystock.partials.CrudStockUpload')
    @endsection