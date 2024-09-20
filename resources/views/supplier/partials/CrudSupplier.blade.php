<!-- Modal -->
<div class="modal fade" id="CrudSupplierModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="CrudSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CrudSupplierModalLabel"><i class="fas fa-plus-square"></i> Add Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="CrudSupplierForm">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col md-3">
              <div class="form-group ">
                <label for="supplier_id" class="placeholder">Supplier Id</label>
                <input id="supplier_id" name="supplier_id" type="text" class="form-control form-control-sm input-border-bottom" required>
              </div>
            </div>
            <div class="col md-3">
              <div class="form-group ">
                <label for="supplier_name" class="placeholder">Supplier Name</label>
                <input id="supplier_name" name="supplier_name" type="text" class="form-control form-control-sm input-border-bottom" required>
              </div>
            </div>
            <div class="col md-3">
              <div class="form-group ">
                <label for="email" class="placeholder">Email</label>
                <input id="email" name="email" type="text" class="form-control form-control-sm input-border-bottom" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col md-3">
              <div class="form-group ">
                <label for="phone" class="placeholder">Phone</label>
                <input id="phone" name="phone" type="text" class="form-control form-control-sm input-border-bottom" required>
              </div>
            </div>
            <div class="col md-3">
              <div class="form-group ">
                <label for="address" class="placeholder">Address</label>
                <input id="address" name="address" type="text" class="form-control form-control-sm input-border-bottom" required>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col md-3">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" name="status_supplier" id="status_supplier" type="checkbox">
                  <span class="form-check-sign">Status</span>
                </label>
              </div>
            </div>
          </div>


          <div class="row" id="ErrorInfo"></div>
          <input type="text" hidden name="CrudActionSupplier" id="CrudActionSupplier">
          <input type="text" hidden name="id" id="id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-submit btn-danger btn-danger-custom" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancel</button>
          <button type="submit" class="btn btn-submit btn-success btn-success-custom"><i class="fas fa-check-double"></i> Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>