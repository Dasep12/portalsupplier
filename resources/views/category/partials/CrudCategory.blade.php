<!-- Modal -->
<div class="modal fade" id="CrudCategoryModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="CrudCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CrudCategoryModalLabel"><i class="fas fa-plus-square"></i> Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="CrudCategoryForm">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col md-3">
              <div class="form-group ">
                <label for="name_category" class="placeholder">Name Category</label>
                <input id="name_category" name="name_category" type="text" class="form-control form-control-sm input-border-bottom" required>
              </div>
            </div>
            <div class="col md-3">
              <div class="form-group ">
                <label for="remarks" class="placeholder">Remarks</label>
                <input id="remarks" name="remarks" type="text" class="form-control form-control-sm input-border-bottom" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col md-3">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" name="status_category" id="status_category" type="checkbox">
                  <span class="form-check-sign">Status</span>
                </label>
              </div>
            </div>
          </div>



          <div class="row" id="ErrorInfo"></div>
          <div class="row" id="DeleteInfo"></div>
          <input type="text" hidden name="CrudActionCategory" id="CrudActionCategory">
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