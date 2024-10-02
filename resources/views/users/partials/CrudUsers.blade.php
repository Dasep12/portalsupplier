<style>
    .ui-jqgrid-disablePointerEvents {
        pointer-events: none;
    }

    .jqgrow {
        cursor: pointer;
        /* Set pointer cursor for all rows */
    }
</style>
<div class="modal fade" id="modalCrudUser" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-lg modal-dialog modal-dialog-slideout" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="titleModal"></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="CrudUserForm">
                @csrf()
                <input type="text" hidden name="action" id="CrudUserAction" />
                <input type="text" hidden name="id" id="id" />
                <textarea type="text" hidden name="UserAccess" placeholder="menu list" id="UserAccess"></textarea>
                <input type="text" hidden name="selectedMenu" placeholder="menu list" id="selectedMenu">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="username" class="placeholder">Username</label>
                                <input id="username" name="username" type="text" class="form-control form-control-sm input-border-bottom" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password * :</label>
                                <div class="input-group mb-3">
                                    <input type="password" name="password" class="form-control form-control-sm input-border-bottom" placeholder="" aria-label="" aria-describedby="basic-addon2">
                                    <div style="cursor:pointer" class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-eye"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email * :</label>
                                <input type="text" id="email" class="form-control form-control-sm input-border-bottom" name="email" required />
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone * :</label>
                                <input type="text" id="phone" class="form-control form-control-sm input-border-bottom" name="phone" required />
                            </div>
                            <div class="form-group">
                                <label for="role_id">Role * :</label>
                                <select name="role_id" class="form-control-sm input-border-bottom form-control" id="role_id">
                                    <option value="*">*</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="supplier_id">Supplier * :</label>
                                <select name="supplier_id" class="form-control-sm input-border-bottom form-control" id="supplier_id">
                                    <option value="*">All Supplier</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="checkbox" value="" id="lock_user" name="lock_user" class="checkeds" checked="checked" /> <label for="lock_user"> Status *</label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="">List Menu</label>
                            <table id="jqGridMainModal"></table>
                            <div id="jqGridPager2"></div>
                        </div>
                    </div>

                    <div id="ErrorInfo"></div>
                    <div id="CrudUserAlertDelete"></div>
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
        url: "{{ url('jsonDetailListUserMenu') }}",
        datatype: "json",
        mtype: "GET",
        postData: {
            role_id: '',
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
            label: 'id_accessMenu',
            name: 'id_accessMenu',
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
        }, {
            label: 'C',
            hidden: false,
            name: 'CanCreate',
            align: 'center',
            fixed: true,
            width: 45,
            formatter: checkCrudFormatter
        }, {
            label: 'R',
            hidden: false,
            name: 'CanSee',
            align: 'center',
            fixed: true,
            width: 45,
            formatter: checkCrudFormatter
        }, {
            label: 'U',
            hidden: false,
            name: 'CanUpdate',
            align: 'center',
            fixed: true,
            width: 45,
            formatter: checkCrudFormatter
        }, {
            label: 'D',
            hidden: false,
            name: 'CanDelete',
            align: 'center',
            fixed: true,
            width: 45,
            formatter: checkCrudFormatter
        }],
        viewrecords: true,
        rownumbers: true,
        rownumWidth: 30,
        autoresizeOnLoad: true,
        gridview: false,
        height: 350,
        width: 500,
        rowNum: 50,
        multiselect: true,
        // rowList: [10, 30, 50],
        pager: "#jqGridPager2",
        loadComplete: function() {
            var datafromgrid = $('#jqGridMainModal').jqGrid('getRowData');
            //alert(datafromgrid);
            $.each(datafromgrid, function(x, y) {
                var _val = y.enable_menu;
                if (_val == 1) {
                    jQuery('#jqGridMainModal').jqGrid('setSelection', y.Menu_id);
                } else {
                    $(`#${y.Menu_id}`).addClass('ui-state-disabled');
                }
            });
        },
        rowattr: function(item) {
            if ($("#CrudUserAction").val() == "delete") {
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

    function setGridData(rowid, colname) {
        $("#UserAccess").val(getGridData());
    }

    function getGridData() {
        var data = $("#jqGridMainModal").jqGrid('getRowData');
        var jsdata = [];
        for (var i = 0; i < data.length; i++) {
            if (data[i].enable_menu == 1) {
                id = data[i].Menu_id;
                var idsee = "#" + id + "_CanSee";
                var idcreate = "#" + id + "_CanCreate";
                var idupdate = "#" + id + "_CanUpdate";
                var iddelete = "#" + id + "_CanDelete";
                jsdata.push({
                    MenuId: data[i].Menu_id,
                    CanSee: $(idsee).is(':checked'),
                    CanCreate: $(idcreate).is(':checked'),
                    CanUpdate: $(idupdate).is(':checked'),
                    CanDelete: $(iddelete).is(':checked'),
                    idRoles: data[i].id_accessMenu
                });
            }
        }
        return JSON.stringify(jsdata);
    }

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

    function checkCrudFormatter(cellvalue, options, rowObject) {
        idrow = options.rowId;
        colname = options.colModel.name;
        var isActive = rowObject.enable_menu;
        var isdisabled = "";
        if (isActive == false) {
            isdisabled = "disabled";
        }

        var checked = "";
        // var roleIdx = "";
        if ($("#role_id").val() != "" && $("#id").val() != "") {
            if (rowObject.id_accessMenu != null && cellvalue == true) {
                checked = "checked='checked'";
            }
        } else if ($("#role_id").val() != "" && $("#id").val() == "" && isActive == true) {
            checked = "checked='checked'";
        }
        setTimeout(() => {
            setGridData(idrow, colname);
        }, 300);

        return `<input type='checkbox' id='${idrow}_${colname}' ${checked} value='${cellvalue}' onchange="setGridData('${idrow}','${colname}')" ${isdisabled} />`
    }
</script>