@extends('layouts.master')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Master Data</h4>
                <span class="breadcrumbs">
                </span>
                Part
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="height: 500px;">
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col-md-8">
                                    <button type="button" onclick="CrudPart('create','*')" class="btn btn-primary btn-custom-primary"><i class="fa fa-plus"></i> Add New</button>
                                    <button onclick="reloadGridList()" class="btn btn-primary btn-custom-primary"><i class="fa fa-sync-alt"></i> Reload</button>
                                    <button type="button" onclick="CrudPart('upload','*')" class="btn btn-primary btn-custom-primary"><i class="fas fa-cloud-upload-alt"></i> Upload</button>
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


@include('part.partials.CrudPart')
<script>
    var dataTemp = [];

    function reloadgridItem(data) {
        // Clear existing data
        // Clear existing data
        $("#JqGridTempUpload").jqGrid('clearGridData', true);
        $("#JqGridTempUpload").jqGrid('setGridParam', {
            data: data
        });
        // Refresh the grid
        $("#JqGridTempUpload").trigger('reloadGrid');
    }

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
        url: "{{ url('jsonPartList') }}",
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
            label: 'Supplier',
            name: 'supplier_name',
            // width: 75
        }, {
            label: 'unit_id',
            name: 'unit_id',
            hidden: true
            // width: 75
        }, {
            label: 'units_id',
            name: 'units_id',
            hidden: true
            // width: 75
        }, {
            label: 'supplier_id',
            name: 'supplier_id',
            hidden: true
            // width: 75
        }, {
            label: 'category_id',
            name: 'category_id',
            hidden: true
            // width: 75
        }, {
            label: 'remarks',
            name: 'remarks',
            hidden: true
            // width: 75
        }, {
            label: 'forecast',
            name: 'forecast',
            hidden: true
            // width: 75
        }, {
            label: 'Category',
            name: 'name_category',
            width: 90,
            align: 'center'
        }, {
            label: 'Model',
            name: 'model',
            align: 'center',
            width: 80
        }, {
            label: 'Uniq',
            name: 'uniq',
            align: 'center',
            width: 80,
        }, {
            label: 'Part Name',
            name: 'part_name',
            align: 'center'
            // width: 80,
        }, {
            label: 'Part Number',
            name: 'part_number',
            align: 'center'
            // width: 80,
        }, {
            label: 'Package',
            name: 'unit_code',
            align: 'center',
            width: 80,
        }, {
            label: 'Units',
            name: 'units_code',
            align: 'center',
            width: 80,
        }, {
            label: 'Qty/Units',
            name: 'qtyPerUnit',
            align: 'center',
            width: 80,
        }, {
            label: 'Volume/Day',
            name: 'volumePerDays',
            align: 'center',
            width: 80,
        }, {
            label: 'Qty',
            name: 'qtySafety',
            align: 'center',
            width: 40,
        }, {
            label: 'Day',
            name: 'safetyForDays',
            align: 'center',
            width: 40,
        }, {
            label: 'status',
            name: 'status_part',
            hidden: true,
            width: 80,
        }, {
            label: 'status',
            name: 'act',
            align: 'center',
            formatter: function(cellvalue, options, rowObject) {
                var status = rowObject.status_part == 1 ? 'Active' : 'Inactive';
                var badge = rowObject.status_part == true ? 'badge-success' : 'badge-danger';
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
        shrinkToFit: false,
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

    jQuery("#jqGrid").jqGrid('setGroupHeaders', {
        useColSpanStyle: true,
        groupHeaders: [{
            startColumnName: 'qtySafety',
            numberOfColumns: 2,
            titleText: 'Safety Stock'
        }, {
            startColumnName: 'unit_code',
            numberOfColumns: 3,
            titleText: 'Detail'
        }]
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

    function showButton(RowId, id) {
        var dataContent = "<div>";
        dataContent += "<a id='btn-update-" + RowId + "' class='btn btn-sm btn-link text-success ml-2 btn-option' ><small><span class='fas fa-edit'></span> Edit</small></a>";
        dataContent += "<a  id='btn-delete-" + RowId + "' class='btn btn-sm btn-link text-danger ml-2 btn-option ' ><small><span class='fas fa-trash'></span> Delete</small></a>";
        dataContent += "</div>";
        $('#' + id).attr('data-content', dataContent).popover();
    }

    $(document).on('click', '.btn-option', function() {
        var crud_data = (this.id).split('-');
        CrudPart(crud_data[1], "" + crud_data[2] + "");
    });

    function CrudPart(act, id) {
        document.getElementById("CrudPartForm").reset();
        jsonListCategory()
        jsonListPackage()
        jsonListSupplier()
        $('#ErrorInfo').html('');
        $('#ErrorInfoUpload').html('');
        $("#CrudActionPart").val(act);
        $("#CrudPartForm").find("label.error").remove(); // Remove any error labels
        $("#CrudPartForm").find(".error").removeClass("error"); // Remove error class from inputs
        switch (act) {
            case 'create':
                disabledEnableForm(false)
                $("#status_part").attr("checked", true)
                $(".modal-title").html(`<i class="fas fa-plus-square"></i> Add Part`)
                $("#CrudPartModal").modal('show');
                break;
            case 'delete':
                disabledEnableForm(true);
                getDataValues(id);
                $(".modal-title").html(`<i class="fas fa-window-close"></i> Delete Part`)
                $("#CrudPartModal").modal('show');
                break;
            case 'update':
                disabledEnableForm(false);
                getDataValues(id);
                $(".modal-title").html(`<i class="fas fa-plus-square"></i> Edit Part`)
                $("#CrudPartModal").modal('show');
                break;
            case 'upload':
                dataTemp = [];
                reloadgridItem(dataTemp)
                $(".btn-upload-file").attr("disabled", true)
                $("#excel_file").val('')
                document.getElementById("CrudActionPartUpload").value = act;
                $(".modal-title").html(`<i class="fas fa-plus-square"></i> Upload Part`)
                $("#CrudPartModalUpload").modal('show');
                break;
        }
    }

    function disabledEnableForm(act) {
        $("#CrudPartForm :input").each(function() {
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
            case "upload":
                showToast(data, action, " has been succesfully")
                reloadGridList();
                break;
        }
    }

    function getDataValues(id) {
        var Grid = $('#jqGrid'),
            selRowId = Grid.jqGrid('getGridParam', 'selrow'),
            supplier_id = Grid.jqGrid('getCell', id, 'supplier_id'),
            category_id = Grid.jqGrid('getCell', id, 'category_id'),
            model = Grid.jqGrid('getCell', id, 'model'),
            uniq = Grid.jqGrid('getCell', id, 'uniq'),
            part_name = Grid.jqGrid('getCell', id, 'part_name'),
            part_number = Grid.jqGrid('getCell', id, 'part_number'),
            unit_id = Grid.jqGrid('getCell', id, 'unit_id'),
            units_id = Grid.jqGrid('getCell', id, 'units_id'),
            qtyPerUnit = Grid.jqGrid('getCell', id, 'qtyPerUnit'),
            volumePerDays = Grid.jqGrid('getCell', id, 'volumePerDays'),
            qtySafety = Grid.jqGrid('getCell', id, 'qtySafety'),
            safetyForDays = Grid.jqGrid('getCell', id, 'safetyForDays'),
            remarks = Grid.jqGrid('getCell', id, 'remarks'),
            forecast = Grid.jqGrid('getCell', id, 'forecast'),
            status_part = Grid.jqGrid('getCell', id, 'status_part');

        $("#id").val(id);
        setTimeout(() => {
            $("#unit_id").val(unit_id).trigger('change');
            $("#category_id").val(category_id).trigger('change');
            setTimeout(() => {
                $("#supplier_id").val(supplier_id).trigger('change');
                $("#units_id").val(units_id).trigger('change');
            }, 400);
        }, 400);
        $("#model").val(model)
        $("#uniq").val(uniq)
        $("#part_name").val(part_name)
        $("#part_number").val(part_number)
        $("#qtyPerUnit").val(qtyPerUnit)
        $("#volumePerDays").val(volumePerDays)
        $("#qtySafety").val(qtySafety)
        $("#safetyForDays").val(safetyForDays)
        $("#remarks").val(remarks)
        $("#forecast").val(forecast)

        var stat = true;
        status_part == 1 ? stat = true : stat = false;
        $("#status_part").attr("checked", stat)
    }


    function jsonListSupplier() {
        $.ajax({
            url: "{{ url('jsonListSupplier') }}",
            method: "GET",
            cache: false,
            success: function(data) {
                // Clear the current options
                $('#supplier_id').empty();
                $('#supplier_id').append('<option value="">Choose</option>');
                // Loop through the data and append options
                $.each(data, function(index, item) {
                    $('#supplier_id').append($('<option>', {
                        value: item.id, // assuming 'id' is the value to be sent
                        text: item.supplier_name // assuming 'name' is the display text
                    }));
                });
            }
        })
    }


    function jsonListCategory() {
        $.ajax({
            url: "{{ url('jsonListCategory') }}",
            method: "GET",
            cache: false,
            success: function(data) {
                // Clear the current options
                $('#category_id').empty();
                $('#category_id').append('<option value="">Choose</option>');
                // Loop through the data and append options
                $.each(data, function(index, item) {
                    $('#category_id').append($('<option>', {
                        value: item.id, // assuming 'id' is the value to be sent
                        text: item.name_category // assuming 'name' is the display text
                    }));
                });
            }
        })
    }

    function jsonListPackage() {
        $.ajax({
            url: "{{ url('jsonListPackage') }}",
            method: "GET",
            cache: false,
            success: function(data) {
                // Clear the current options
                $('#unit_id').empty();
                $('#unit_id').append('<option value="">Choose</option>');
                // Loop through the data and append options
                $.each(data, function(index, item) {
                    $('#unit_id').append($('<option>', {
                        value: item.id, // assuming 'id' is the value to be sent
                        text: item.name_unit // assuming 'name' is the display text
                    }));
                });
            }
        })
    }


    function jsonListUnits(parent_id) {
        $.ajax({
            url: "{{ url('jsonListUnits') }}",
            method: "GET",
            cache: false,
            data: {
                parent_id: parent_id
            },
            success: function(data) {
                // Clear the current options
                $('#units_id').empty();
                $('#units_id').append('<option value="">*</option>');
                // Loop through the data and append options
                $.each(data, function(index, item) {
                    $('#units_id').append($('<option>', {
                        value: item.id, // assuming 'id' is the value to be sent
                        text: item.code_unit // assuming 'name' is the display text
                    }));
                });
            }
        })
    }

    $("#unit_id").change(function() {
        jsonListUnits($("#unit_id").val())
    })

    $("#CrudPartForm").validate({
        ignore: ":hidden",
        submitHandler: function(form) {
            $.ajax({
                type: "POST",
                url: "{{ url('jsonCrudPart') }}",
                beforeSend: function() {
                    $(".btn-submit").attr("disabled", true);
                },
                complete: function() {
                    $(".btn-submit").attr("disabled", false);
                },
                data: $(form).serialize(),
                success: function(res) {
                    if (res.success) {
                        $("#CrudPartModal").modal('hide');
                        doSuccess(res.data, $("#CrudActionPart").val())
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




@include('part.partials.CrudPartUpload')
@endsection