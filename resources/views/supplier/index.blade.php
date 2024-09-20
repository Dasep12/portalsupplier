@extends('layouts.master')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Master Data</h4>
                <span class="breadcrumbs">
                </span>
                Supplier
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="height: 500px;">
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col-md-8">
                                    <button type="button" onclick="CrudSupplier('create','*')" class="btn btn-primary btn-custom-primary"><i class="fa fa-plus"></i> Add New</button>
                                    <button onclick="reloadGridList()" class="btn btn-primary btn-custom-primary"><i class="fa fa-sync-alt"></i> Reload</button>
                                    <button class="btn btn-primary btn-custom-primary"><i class="fas fa-cloud-upload-alt"></i> Upload</button>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-icon">
                                        <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search for supplier name ...">
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





@include('supplier.partials.CrudSupplier')
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
        url: "{{ url('jsonSupplierList') }}",
        datatype: "json",
        mtype: "GET",
        postData: {
            "_token": "{{ csrf_token() }}",
        },
        colModel: [{
            label: '<span class="fas fa-cog"></span>',
            name: 'Action',
            align: 'center',
            fixed: true,
            width: 40,
            formatter: actionFormatter
        }, {
            label: 'Code Supplier',
            name: 'supplier_id',
            // width: 75
        }, {
            label: 'Supplier Name',
            name: 'supplier_name',
            // width: 90
        }, {
            label: 'Phone',
            name: 'phone',
            // width: 100
        }, {
            label: 'Email',
            name: 'email',
            // width: 80,
        }, {
            label: 'Address',
            name: 'address',
            // width: 80,
        }, {
            label: 'status',
            name: 'status_supplier',
            hidden: true
            // width: 80,
        }, {
            label: 'status',
            name: 'act',
            align: 'center',
            formatter: function(cellvalue, options, rowObject) {
                var status = rowObject.status_supplier == 1 ? 'Active' : 'Inactive';
                var badge = rowObject.status_supplier == true ? 'badge-success' : 'badge-danger';
                return `<span class="badge ${badge}">${status}</span>`;
            },
            width: 80,
        }],
        viewrecords: true, // show the current page, data rang and total records on the toolbar
        rowNum: 15,
        loadonce: false,
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
            $('[data-toggle="popover"]').popover(); // Initialize the popover
            // Adjust grid width on window resize to make it responsive
            $(window).on('resize', function() {
                var gridWidth = $('.table-responsive').width(); // Get the width of the container
                $('#jqGrid').setGridWidth(gridWidth - 5); // Adjust the grid width
            }).trigger('resize'); // Trigger resize on page load

            var $this = $(this),
                ids = $this.jqGrid('getDataIDs'),
                i, l = ids.length;
            for (i = 0; i < l; i++) {
                $this.jqGrid('editRow', ids[i], true);
                var newid = ids[i];
                var btnid = 'btn-' + newid;
                showButton(ids[i], btnid);
            }
        },
    });

    function actionFormatter(cellvalue, options, rowObject) {

        var btnid = 'btn-' + options.rowId;
        var btn = "<div class='table-link'>";
        btn += "<a id='" + btnid + "' tabindex='0' class='btn btn-sm btn-default-custom btn-outline-primary ' role='button' ";
        btn += "data-container='body' data-toggle='popover' data-placement='right' data-trigger='focus' data-timeout='2000' data-html='true' data-content='-'>";
        btn += "<span class='fa fa-cog'></span></span>";
        btn += "</a>";
        btn += "</div>";
        return btn;
    }

    function showButton(supplierId, id) {
        var dataContent = "<div>";
        dataContent += "<a id='btn-update-" + supplierId + "' class='btn btn-sm btn-link text-success ml-2 btn-option' ><small><span class='fas fa-edit'></span> Edit</small></a>";
        dataContent += "<a  id='btn-delete-" + supplierId + "' class='btn btn-sm btn-link text-danger ml-2 btn-option ' ><small><span class='fas fa-trash'></span> Delete</small></a>";
        dataContent += "</div>";
        $('#' + id).attr('data-content', dataContent).popover();
    }

    $(document).on('click', '.btn-option', function() {
        var crud_data = (this.id).split('-');
        CrudSupplier(crud_data[1], "" + crud_data[2] + "");
    });

    function CrudSupplier(act, id) {
        document.getElementById("CrudSupplierForm").reset();
        $('#ErrorInfo').html('');
        $("#CrudActionSupplier").val(act);
        $("#CrudSupplierForm").find("label.error").remove(); // Remove any error labels
        $("#CrudSupplierForm").find(".error").removeClass("error"); // Remove error class from inputs

        switch (act) {
            case 'create':
                disabledEnableForm(false)
                $("#status_supplier").attr("checked", true)
                $(".modal-title").html(`<i class="fas fa-plus-square"></i> Add Supplier`)
                $("#CrudSupplierModal").modal('show');
                break;
            case 'delete':
                disabledEnableForm(true);
                getDataValues(id);
                $(".modal-title").html(`<i class="fas fa-window-close"></i> Delete Supplier`)
                $("#CrudSupplierModal").modal('show');
                break;
            case 'update':
                disabledEnableForm(false);
                getDataValues(id);
                $(".modal-title").html(`<i class="fas fa-plus-square"></i> Edit Supplier`)
                $("#CrudSupplierModal").modal('show');
                break;
        }
    }

    function disabledEnableForm(act) {
        $("#CrudSupplierForm :input").each(function() {
            var typeOfObject = $(this).prop('tagName');
            switch (typeOfObject) {
                case "SELECT":
                    $(this).attr("disabled", act);
                    break;
                case "INPUT":
                    $(this).attr("readonly", act);
                    break;
                case "TEXTAREA":
                    $(this).attr("readonly", act);
                    break;
            }
        });
    }

    function doSuccess(data, action) {
        switch (action) {
            case "create":
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

    function getDataValues(id) {
        var Grid = $('#jqGrid'),
            selRowId = Grid.jqGrid('getGridParam', 'selrow'),
            supplier_id = Grid.jqGrid('getCell', id, 'supplier_id'),
            supplier_name = Grid.jqGrid('getCell', id, 'supplier_name'),
            address = Grid.jqGrid('getCell', id, 'address'),
            phone = Grid.jqGrid('getCell', id, 'phone'),
            email = Grid.jqGrid('getCell', id, 'email'),
            status_supplier = Grid.jqGrid('getCell', id, 'status_supplier');

        $("#id").val(id)
        $("#supplier_id").val(supplier_id)
        $("#supplier_name").val(supplier_name)
        $("#phone").val(phone)
        $("#email").val(email)
        $("#address").val(address)

        var stat = true;
        status_supplier == 1 ? stat = true : stat = false;
        $("#status_supplier").attr("checked", stat)
    }



    $("#CrudSupplierForm").validate({
        ignore: ":hidden",
        submitHandler: function(form) {
            $.ajax({
                type: "POST",
                url: "{{ url('jsonCrudSupplier') }}",
                beforeSend: function() {
                    $(".btn-submit").attr("disabled", true);
                },
                complete: function() {
                    $(".btn-submit").attr("disabled", false);
                },
                data: $(form).serialize(),
                success: function(res) {
                    if (res.success) {
                        $("#CrudSupplierModal").modal('hide');
                        doSuccess(res.data, $("#CrudActionSupplier").val())
                    } else {
                        var errMsg = '<div class="col-md-12"><div class="alert alert-custom-warning alert-warning alert-dismissible fade show" role="alert"><small><b> Error !</b><br/>' + res.msg + '</small><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button></div></div>'
                        $('#ErrorInfo').html(errMsg);
                    }
                },
                error: function(xhr, desc, err) {
                    var respText = "";
                    try {
                        respText = eval(xhr.responseText);
                    } catch {
                        respText = xhr.responseText;
                    }

                    respText = unescape(respText).replaceAll("_n_", "<br/>")
                    var errMsg = '<div class="col-md-12"><div class="alert alert-custom-warning alert-warning alert-dismissible fade show" role="alert"><small><b> Error ' + xhr.status + '!</b><br/>' + respText + '</small><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button></div></div>'
                    $('#ErrorInfo').html(errMsg);
                },
            });
            return false; /* required to block normal submit since you used ajax */
        }
    });

    function exportToExcel() {

    }
</script>
@endsection