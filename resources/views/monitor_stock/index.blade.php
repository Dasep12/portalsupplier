@extends('layouts.master')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Stock</h4>
                <span class="breadcrumbs">
                </span>
                Monitor Stock
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="height: 500px;">
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col-md-8">
                                    <button onclick="reloadGridList()" class="btn btn-primary btn-custom-primary"><i class="fa fa-sync-alt"></i> Reload</button>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-icon">
                                        <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search for part name ...">
                                        <span id="searchButton" style="cursor: pointer;" class="input-icon-addon">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="jqGrid"></table>
                                <div id="jqGridPager"></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-3 mt-2">
                                    <div class="input-group input-group-sm">
                                        <input type="text" readonly value="Export Data" class="form-control field-export" aria-label="Text input with dropdown button">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btn-custom-primary  dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Choose Format</button>
                                            <div class="dropdown-menu">
                                                <a onclick="exportToExcel()" class="dropdown-item" href="#"><i class="fa fa-file-excel"></i> Excel</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-file-pdf"></i> Pdf</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function reloadGridList() {
        $("#jqGrid").jqGrid('setGridParam', {
            datatype: 'json',
            mtype: 'GET',
            postData: {
                search: $("#searchInput").val()
            }
        }).trigger('reloadGrid');
    }
    $(document).ready(function() {
        // Attach click event handler to the search icon
        $("#searchButton").click(function() {
            // Get the value from the search input
            var searchTerm = $("#searchInput").val();
            reloadGridList()
            $("#searchInput").val('');
        });

        // Optional: Bind Enter key press to trigger search
        $("#searchInput").keypress(function(e) {
            if (e.which == 13) { // Enter key
                $("#searchButton").click();
            }
        });
    });

    $("#jqGrid").jqGrid({
        url: "{{ url('jsonMonitorList') }}",
        datatype: "json",
        mtype: "GET",
        postData: {

        },
        colModel: [{
            label: 'Supplier',
            name: 'supplier_name',
            // width: 75
        }, {
            label: 'Part Number',
            name: 'part_number',
            // width: 75
        }, {
            label: 'Part Name',
            name: 'part_name',
            // width: 140
        }, {
            label: 'Unit',
            name: 'code_unit',
            // width: 65,
            align: 'center'
        }, {
            label: 'Volume/Day',
            name: 'volumePerDay',
            // width: 85,
            align: 'center'
        }, {
            label: 'Qty',
            name: 'qtySafety',
            align: 'center',
            // width: 95
        }, {
            label: 'Days',
            name: 'safetyForDays',
            align: 'center',
            // width: 95
        }, {
            label: 'Qty',
            name: 'stockSupplier',
            align: 'center',
            formatter: function(value, option, row) {
                var color = (row.stockStatus === "SAFETY") ? "text-success" :
                    (row.stockStatus === "SHORTAGE") ? "text-danger" :
                    "text-warning";
                return `<span class="fw-bold text-uppercase ">${value}</span>`
            }
            // width: 95
        }, {
            label: 'Day',
            name: 'stockUntilDay',
            align: 'center',
            formatter: function(value, option, row) {
                var color = (row.stockStatus === "SAFETY") ? "text-success" :
                    (row.stockStatus === "SHORTAGE") ? "text-danger" :
                    "text-warning";
                return `<span class="fw-bold text-uppercase ${color}">${value}</span>`
            }
            // width: 95
        }, {
            label: 'Status',
            name: 'stockStatus',
            align: 'center',
            formatter: function(val, opt, row) {
                var badges = (val === "SAFETY") ? "badge-success" :
                    (val === "SHORTAGE") ? "badge-danger" :
                    "badge-warning";
                return `<span class="mon-badge badge ${badges}">${ val }</span>`
            },
            // width: 95
        }],
        rownumbers: true,
        rownumWidth: 30,
        viewrecords: true,
        width: '100%',
        height: 300,
        rowNum: 20,
        loadonce: false,
        rowNum: 20,
        autoresizeOnLoad: true,
        autowidth: true,
        shrinkToFit: true,
        pager: "#jqGridPager",
        rowList: [15, 30, 50],
        loadComplete: function(data) {
            // Adjust grid width on window resize to make it responsive
            $(window).on('resize', function() {
                var gridWidth = $('.table-responsive').width(); // Get the width of the container
                $('#jqGrid').setGridWidth(gridWidth - 5); // Adjust the grid width
            }).trigger('resize'); // Trigger resize on page load
        },
    });

    jQuery("#jqGrid").jqGrid('setGroupHeaders', {
        useColSpanStyle: true,
        groupHeaders: [{
            startColumnName: 'qtySafety',
            numberOfColumns: 2,
            titleText: 'Safety Stock'
        }, {
            startColumnName: 'stockSupplier',
            numberOfColumns: 2,
            titleText: 'Qty Stock Supplier'
        }]
    });
</script>
@endsection