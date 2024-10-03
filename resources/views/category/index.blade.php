@extends('layouts.master')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Master Data</h4>
                <span class="breadcrumbs">
                </span>
                Category
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if (CrudMenuPermission($MenuUrl, $user_id, 'view'))
                    <div class="card" style="height: 500px;">
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col-md-8">
                                    @if(CrudMenuPermission($MenuUrl, $user_id, 'add'))
                                    <button type="button" onclick="CrudCategory('create','*')" class="btn btn-primary btn-custom-primary"><i class="fa fa-plus"></i> Add New</button>
                                    @endif
                                    <button onclick="reloadGridList()" class="btn btn-primary btn-custom-primary"><i class="fa fa-sync-alt"></i> Reload</button>
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
</div>





@include('category.partials.CrudCategory')
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
        url: "{{ url('jsonCategoryList') }}",
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
            label: 'Name Category',
            name: 'name_category',
            // width: 75
        }, {
            label: 'Remarks',
            name: 'remarks',
            // width: 90
        }, {
            label: 'status',
            name: 'status_category',
            hidden: true
            // width: 80,
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
            name: 'act',
            align: 'center',
            formatter: function(cellvalue, options, rowObject) {
                var status = rowObject.status_category == 1 ? 'Active' : 'Inactive';
                var badge = rowObject.status_category == true ? 'badge-success' : 'badge-danger';
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
        <?php if (CrudMenuPermission($MenuUrl, $user_id, 'edit')) { ?>
            dataContent += "<a id='btn-update-" + supplierId + "' class='btn btn-sm btn-link text-success ml-2 btn-option' ><small><span class='fas fa-edit'></span> Edit</small></a>";
        <?php } else { ?>
            dataContent += "-";
        <?php } ?>
        <?php if (CrudMenuPermission($MenuUrl, $user_id, 'delete')) { ?>
            dataContent += "<a  id='btn-delete-" + supplierId + "' class='btn btn-sm btn-link text-danger ml-2 btn-option ' ><small><span class='fas fa-trash'></span> Delete</small></a>";
        <?php } else { ?>
            dataContent += "-";
        <?php } ?>
        dataContent += "</div>";
        $('#' + id).attr('data-content', dataContent).popover();
    }

    $(document).on('click', '.btn-option', function() {
        var crud_data = (this.id).split('-');
        CrudCategory(crud_data[1], "" + crud_data[2] + "");
    });

    function CrudCategory(act, id) {
        document.getElementById("CrudCategoryForm").reset();
        $('#ErrorInfo').html('');
        $('#DeleteInfo').html('');
        $("#CrudActionCategory").val(act);
        $("#CrudCategoryForm").find("label.error").remove(); // Remove any error labels
        $("#CrudCategoryForm").find(".error").removeClass("error"); // Remove error class from inputs

        switch (act) {
            case 'create':
                disabledEnableForm(false)
                $("#status_category").attr("checked", true)
                $(".modal-title").html(`<i class="fas fa-plus-square"></i> Add Category`)
                $("#CrudCategoryModal").modal('show');
                break;
            case 'delete':
                disabledEnableForm(true);
                getDataValues(id);
                $(".modal-title").html(`<i class="fas fa-window-close"></i> Delete Category`);
                $('#DeleteInfo').html(`<div class="col-md-12"><div class="alert alert-custom-warning alert-warning alert-dismissible fade show" role="alert"><small><b> Warning !</b><br/>Data Will Be Delete Permanently</small></div></div>`);
                $("#CrudCategoryModal").modal('show');
                break;
            case 'update':
                disabledEnableForm(false);
                getDataValues(id);
                $(".modal-title").html(`<i class="fas fa-plus-square"></i> Edit Category`)
                $("#CrudCategoryModal").modal('show');
                break;
        }
    }

    function disabledEnableForm(act) {
        $("#CrudCategoryForm :input").each(function() {
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
            name_category = Grid.jqGrid('getCell', id, 'name_category'),
            remarks = Grid.jqGrid('getCell', id, 'remarks'),
            status_category = Grid.jqGrid('getCell', id, 'status_category');

        $("#id").val(id)
        $("#name_category").val(name_category)
        $("#remarks").val(remarks)

        var stat = true;
        status_category == 1 ? stat = true : stat = false;
        $("#status_category").attr("checked", stat)
    }



    $("#CrudCategoryForm").validate({
        ignore: ":hidden",
        submitHandler: function(form) {
            $.ajax({
                type: "POST",
                url: "{{ url('jsonCrudCategory') }}",
                beforeSend: function() {
                    $(".btn-submit").attr("disabled", true);
                },
                complete: function() {
                    $(".btn-submit").attr("disabled", false);
                },
                data: $(form).serialize(),
                success: function(res) {
                    if (res.success) {
                        $("#CrudCategoryModal").modal('hide');
                        doSuccess(res.data, $("#CrudActionCategory").val())
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