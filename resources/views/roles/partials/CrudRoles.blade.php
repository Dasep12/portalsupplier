<style>
    .ui-jqgrid-disablePointerEvents {
        pointer-events: none;
    }

    .jqgrow {
        cursor: pointer;
        /* Set pointer cursor for all rows */
    }
</style>
<div class="modal fade" id="modalCrudRoles" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-lg modal-dialog modal-dialog-slideout" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="titleModal"></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="CrudRolesForm">
                @csrf()
                <input type="text" hidden name="action" id="CrudRolesAction" />
                <input type="text" hidden value="" name="id" id="id" />
                <input type="text" hidden required name="selectedMenu" placeholder="menu list" id="selectedMenu">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="roleName">Name Role * :</label>
                                <input type="text" id="roleName" class="form-control form-control-sm" name="roleName" required />
                            </div>
                            <div class="form-group">
                                <label for="code_role">ID Role * :</label>
                                <input type="text" id="code_role" class="form-control form-control-sm" name="code_role" required />
                            </div>

                            <div class="form-group">
                                <input type="checkbox" value="" id="status_role" name="status_role" class="checkeds" checked="checked" /> <label for="status_role"> Status *</label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="">List Menu</label>
                            <table id="jqGridMainModal"></table>
                            <div id="jqGridPager2"></div>
                        </div>
                    </div>

                    <div id="ErrorInfo"></div>
                    <div id="CrudRolesAlertDelete"></div>
                    <hr />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-submit btn-danger btn-danger-custom" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancel</button>
                        <button type="submit" class="btn-submit-menu btn btn-submit btn-success btn-success-custom"><i class="fas fa-check-double"></i> Submit</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>

<style>

</style>
<script>
    var selectedMenus = [];

    $("#jqGridMainModal").jqGrid({
        url: "{{ url('jsonDetailListMenu') }}",
        datatype: "json",
        mtype: "GET",
        postData: {
            id_role: '',
            "_token": "{{ csrf_token() }}",
        },
        colModel: [{
            label: 'ID',
            name: 'Menu_id',
            key: true,
            hidden: true,
        }, {
            label: 'ID',
            name: 'enable_menu',
            hidden: true,
        }, {
            label: 'Menu',
            name: 'MenuName',
            align: 'left',
            width: 100,
            formatter: function(value, opt, row) {
                if (row.LevelNumber == 2) {
                    return `<span style="margin-left:25px !important;"><i class="fas fa-dot"></i> ${row.MenuName}</span>`;
                }
                return `<span style="font-size:12.5px !important;margin-left:8px !important;"><i class="${ row.MenuIcon }"></i> ${row.MenuName}</span>`;
            },
        }],
        viewrecords: true,
        rownumbers: false,
        rownumWidth: 30,
        multiselect: true,
        autoresizeOnLoad: true,
        gridview: true,
        height: 350,
        width: 500,
        rowNum: 50,
        // rowList: [10, 30, 50],
        pager: "#jqGridPager2",
        loadComplete: function() {
            selectedMenus = [];
            var datafromgrid = $('#jqGridMainModal').jqGrid('getRowData');
            //alert(datafromgrid);
            $.each(datafromgrid, function(x, y) {
                var _val = y.enable_menu;
                if (_val == 1) {
                    $("#jqg_jqGridMainModal_" + y.Menu_id).attr("checked", true);
                    jQuery('#jqGridMainModal').jqGrid('setSelection', y.Menu_id);
                }
            });

        },
        rowattr: function(item) {
            if ($("#CrudRolesAction").val() == "delete") {
                return {
                    "class": "ui-state-disabled ui-jqgrid-disablePointerEvents"
                };
            }
        },
        beforeSelectRow: function(rowid, e) {
            if ($(e.target).closest("tr.jqgrow").hasClass("ui-state-disabled")) {
                return false; // not allow select the row
            }
            return true; // allow select the row
        }
    });

    $('#jqGridMainModal').on('jqGridSelectRow jqGridSelectAll', function() {
        var selectedRows = $("#jqGridMainModal").jqGrid('getGridParam', 'selarrrow');
        const myKey = "menuItems";
        const myMenu = {
            [myKey]: selectedRows
        };
        $("#selectedMenu").val(JSON.stringify(myMenu))

        if (selectedRows.length > 0) {
            $(".btn-submit-menu").attr("disabled", false)
        } else {
            $(".btn-submit-menu").attr("disabled", true)
        }
    })
</script>