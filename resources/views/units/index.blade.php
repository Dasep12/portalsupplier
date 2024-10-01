@extends('layouts.master')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Master Data</h4>
                <span class="breadcrumbs">
                </span>
                Units
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="height: 500px;">
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col-md-8">
                                    <button type="button" onclick="CrudUnit('create','*')" class="btn btn-primary btn-custom-primary"><i class="fa fa-plus"></i> Add New</button>
                                    <button onclick="reloadGridList()" class="btn btn-primary btn-custom-primary"><i class="fa fa-sync-alt"></i> Reload</button>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-icon">
                                        <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search for unit name ...">
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

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@include('units.partials.CrudUnits')
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
        url: "{{ url('jsonUnitsList') }}",
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
            label: 'Units',
            name: 'name_unit',
            // width: 75
        }, {
            label: 'Units',
            name: 'parent_id',
            hidden: true
            // width: 75
        }, {
            label: 'Units Code',
            name: 'code_unit',
            // width: 90
        }, {
            label: "Remarks",
            name: "remarks",
        }, {
            label: "Date",
            name: "created_at",
            formatter: "date",
            formatoptions: {
                srcformat: "ISO8601Long",
                newformat: "d M Y H:i:s"
            },
        }, {
            label: 'status',
            name: 'status_unit',
            hidden: true
            // width: 80,
        }, {
            label: 'status',
            name: 'act',
            align: 'center',
            formatter: function(cellvalue, options, rowObject) {
                var status = rowObject.status_unit == 1 ? 'Active' : 'Inactive';
                var badge = rowObject.status_unit == true ? 'badge-success' : 'badge-danger';
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
        subGrid: true,
        subGridRowExpanded: ChildUnits,
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
                showButton(ids[i], btnid, 'jqGrid');
            }
        },
    });

    function ChildUnits(subgrid_id, row_id) {
        var subgrid_table_id, pager_id;
        subgrid_table_id = subgrid_id + "_t";
        pager_id = "p_" + subgrid_table_id;
        $("#" + subgrid_id).html("<table id='" + subgrid_table_id + "' class='scroll'></table><div id='" + pager_id + "' class='scroll'></div>");
        $("#" + subgrid_table_id).jqGrid({
            url: "{{ url('jsonUnitsListDetail') }}",
            mtype: "GET",
            datatype: "json",
            postData: {
                id: row_id,
                "_token": "{{ csrf_token() }}",
                parent_id: row_id
            },
            page: 1,
            colModel: [{
                label: "id",
                name: "id",
                hidden: true,
                key: true
            }, {
                label: 'Units',
                name: 'name_unit',
                // width: 75
            }, {
                label: 'Units',
                name: 'parent_id',
                hidden: true
                // width: 75
            }, {
                label: 'Units Code',
                name: 'code_unit',
                // width: 90
            }, {
                label: "Remarks",
                name: "remarks",
            }, {
                label: "Date",
                name: "created_at",
                formatter: "date",
                formatoptions: {
                    srcformat: "ISO8601Long",
                    newformat: "d M Y H:i:s"
                },
            }, {
                label: 'status',
                name: 'status_unit',
                hidden: true
                // width: 80,
            }, {
                label: 'Status',
                name: 'status_unit',
                align: 'center',
                formatter: function(cellvalue, options, rowObject) {
                    var status = rowObject.status_unit == 1 ? 'Active' : 'Inactive';
                    var badge = rowObject.status_unit == 1 ? 'badge-success' : 'badge-danger';
                    return `<span class="badge ${badge}">${status}</span>`;
                },
            }, {
                label: 'Action',
                name: 'id',
                align: 'center',
                formatter: actionFormatter
            }],
            jsonReader: {
                repeatitems: false,
                root: "rows",
                page: "page",
                total: "total",
                records: "records"
            },
            loadonce: true,
            rownumbers: true,
            rownumWidth: 40,
            rowNum: 99999,
            width: '30%',
            height: 50,
            loadComplete: function(data) {
                $('[data-toggle="popover"]').popover();
                var $this = $(this),
                    ids = $this.jqGrid('getDataIDs'),
                    i, l = ids.length;
                for (i = 0; i < l; i++) {
                    $this.jqGrid('editRow', ids[i], true);
                    var newid = ids[i];
                    var btnid = 'btn-' + newid;
                    showButton(ids[i], btnid, subgrid_table_id);
                }
            }
        });
    }

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

    function showButton(RowId, id, GridTable) {
        var dataContent = "<div>";
        dataContent += "<a id='btn-update-" + RowId + "-" + GridTable + "' class='btn btn-sm btn-link text-success ml-2 btn-option' ><small><span class='fas fa-edit'></span> Edit</small></a>";
        dataContent += "<a  id='btn-delete-" + RowId + "-" + GridTable + "' class='btn btn-sm btn-link text-danger ml-2 btn-option ' ><small><span class='fas fa-trash'></span> Delete</small></a>";
        dataContent += "</div>";
        $('#' + id).attr('data-content', dataContent).popover();
    }

    $(document).on('click', '.btn-option', function() {
        var crud_data = (this.id).split('-');
        CrudUnit(crud_data[1], "" + crud_data[2] + "", "" + crud_data[3] + "");
    });

    $("#parent_id").change(function() {
        if (this.value === "*") {
            $("#unit_level").val(1)
        } else {
            $("#unit_level").val(2)
        }
    })

    function CrudUnit(act, id, GridTable) {
        document.getElementById("CrudUnitForm").reset();
        jsonParentList()
        $('#ErrorInfo').html('');
        $('#DeleteInfo').html('');
        $("#CrudActionUnit").val(act);
        $("#CrudUnitForm").find("label.error").remove(); // Remove any error labels
        $("#CrudUnitForm").find(".error").removeClass("error"); // Remove error class from inputs

        switch (act) {
            case 'create':
                disabledEnableForm(false)
                $("#unit_level").attr("disabled", true);
                $("#status_supplier").attr("checked", true)
                $(".modal-title").html(`<i class="fas fa-plus-square"></i> Add Unit`)
                $("#CrudUnitModal").modal('show');
                break;
            case 'delete':
                disabledEnableForm(true);
                getDataValues(id, GridTable);
                $(".modal-title").html(`<i class="fas fa-window-close"></i> Delete Unit`)
                $("#CrudUnitModal").modal('show');
                $('#DeleteInfo').html(`<div class="col-md-12"><div class="alert alert-custom-warning alert-warning alert-dismissible fade show" role="alert"><small><b> Warning !</b><br/>Data Will Be Delete Permanently</small></div></div>`);
                break;
            case 'update':
                disabledEnableForm(false);
                getDataValues(id, GridTable);
                $("#unit_level").attr("disabled", true);
                $(".modal-title").html(`<i class="fas fa-plus-square"></i> Edit Unit`)
                $("#CrudUnitModal").modal('show');
                break;
        }
    }

    function disabledEnableForm(act) {
        $("#CrudUnitForm :input").each(function() {
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

    function getDataValues(id, GridTable) {
        var Grid = $('#' + GridTable),
            selRowId = Grid.jqGrid('getGridParam', 'selrow'),
            name_unit = Grid.jqGrid('getCell', id, 'name_unit'),
            code_unit = Grid.jqGrid('getCell', id, 'code_unit'),
            unit_level = Grid.jqGrid('getCell', id, 'unit_level'),
            remarks = Grid.jqGrid('getCell', id, 'remarks'),
            parent_id = Grid.jqGrid('getCell', id, 'parent_id'),
            status_unit = Grid.jqGrid('getCell', id, 'status_unit');

        $("#id").val(id)
        $("#name_unit").val(name_unit)
        $("#code_unit").val(code_unit)
        $("#unit_level").val(unit_level)
        $("#remarks").val(remarks)

        setTimeout(() => {
            $("#parent_id").val(parent_id).trigger('change')
        }, 200);

        var stat = true;
        status_unit == 1 ? stat = true : stat = false;
        $("#status_unit").attr("checked", stat)
    }

    function jsonParentList() {
        $.ajax({
            url: "{{ url('jsonParent') }}",
            method: "GET",
            cache: false,
            success: function(data) {
                // Clear the current options
                $('#parent_id').empty();
                $('#parent_id').append('<option value="*">*</option>');
                // Loop through the data and append options
                $.each(data, function(index, item) {
                    $('#parent_id').append($('<option>', {
                        value: item.id, // assuming 'id' is the value to be sent
                        text: item.name_unit // assuming 'name' is the display text
                    }));
                });
            }
        })
    }
    jsonParentList()


    $("#CrudUnitForm").validate({
        ignore: ":hidden",
        submitHandler: function(form) {
            $.ajax({
                type: "POST",
                url: "{{ url('jsonCrudUnits') }}",
                beforeSend: function() {
                    $(".btn-submit").attr("disabled", true);
                    $('input:disabled').prop('disabled', false);
                },
                complete: function() {
                    $(".btn-submit").attr("disabled", false);
                    $('input:disabled').prop('disabled', true);
                },
                data: $(form).serialize(),
                success: function(res) {
                    if (res.success) {
                        $("#CrudUnitModal").modal('hide');
                        doSuccess(res.data, $("#CrudActionUnit").val())
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
            return false;
        }
    });

    function exportToExcel() {

    }
</script>
@endsection