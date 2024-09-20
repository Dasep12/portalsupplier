<!-- Modal -->
<div class="modal fade" id="CrudUnitModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="CrudUnitModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CrudUnitModalLabel"><i class="fas fa-plus-square"></i> Add Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="CrudUnitForm">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col md-3">
              <div class="form-group ">
                <label for="parent_id" class="placeholder">Parent Unit* :</label>
                <select name="parent_id" class="form-control-sm input-border-bottom form-control" id="parent_id">
                  <option value="*">*</option>
                </select>
              </div>
            </div>
            <div class="col md-3">
              <div class="form-group ">
                <label for="unit_level" class="placeholder">Level Unit* :</label>
                <input id="unit_level" disabled value="1" name="unit_level" type="text" class="form-control form-control-sm input-border-bottom" required>
              </div>
            </div>
            <div class="col md-3">
              <div class="form-group ">
                <label for="name_unit" class="placeholder">Name Unit* :</label>
                <input id="name_unit" name="name_unit" type="text" class="form-control form-control-sm input-border-bottom" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col md-3">
              <div class="form-group ">
                <label for="code_unit" class="placeholder">Code Unit* :</label>
                <input id="code_unit" name="code_unit" type="text" class="form-control form-control-sm input-border-bottom" required>
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
                  <input class="form-check-input" name="status_unit" id="status_unit" type="checkbox">
                  <span class="form-check-sign">Status</span>
                </label>
              </div>
            </div>
          </div>


          <div class="row" id="ErrorInfo"></div>
          <div class="row" id="DeleteInfo"></div>
          <input type="text" hidden name="CrudActionUnit" id="CrudActionUnit">
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