<!-- Modal -->
<div class="modal fade" id="CrudPartModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="CrudPartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CrudPartModalLabel"><i class="fas fa-plus-square"></i> Add Part</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="CrudPartForm">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col md-3">
              <div class="form-group ">
                <label for="supplier_id" class="placeholder">Supplier </label>
                <select required name="supplier_id" class="form-control-sm form-control input-border-bottom-custom" id="supplier_id">
                  <option value="*">*</option>
                </select>
              </div>
            </div>
            <div class="col md-3">
              <div class="form-group ">
                <label for="category_id" class="placeholder">Category</label>
                <select required name="category_id" class="form-control-sm form-control input-border-bottom-custom" id="category_id">
                  <option value="*">*</option>
                </select>
              </div>
            </div>
            <div class="col md-3">
              <div class="form-group ">
                <label for="model" class="placeholder">Model</label>
                <input id="model" placeholder="Model" name="model" type="text" class="form-control form-control-sm input-border-bottom input-border-bottom-custom" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col md-3">
              <div class="form-group ">
                <label for="uniq" class="placeholder">Unique</label>
                <input id="uniq" name="uniq" placeholder="Unique" type="text" class="form-control form-control-sm input-border-bottom input-border-bottom-custom" required>
              </div>
            </div>
            <div class="col md-3">
              <div class="form-group ">
                <label for="part_name" class="placeholder">Part Name</label>
                <input id="part_name" placeholder="Part Name" name="part_name" type="text" class="form-control form-control-sm input-border-bottom input-border-bottom-custom" required>
              </div>
            </div>
            <div class="col md-3">
              <div class="form-group ">
                <label for="part_number" class="placeholder">Part Number</label>
                <input id="part_number" placeholder="Part Number" name="part_number" type="text" class="form-control form-control-sm input-border-bottom input-border-bottom-custom" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col md-3">
              <div class="form-group ">
                <label for="unit_id" class="placeholder">Package</label>
                <select required name="unit_id" class="form-control-sm  form-control input-border-bottom-custom" id="unit_id">
                  <option value="*">*</option>
                </select>
              </div>
            </div>
            <div class="col md-3">
              <div class="form-group ">
                <label for="units_id" class="placeholder">Unit</label>
                <select required name="units_id" class="form-control-sm  form-control input-border-bottom-custom" id="units_id">
                  <option value="*">*</option>
                </select>
              </div>
            </div>
            <div class="col md-3">
              <div class="form-group ">
                <label for="qtyPerUnit" class="placeholder">Qty/Unit</label>
                <input id="qtyPerUnit" placeholder="Qty / Unit" name="qtyPerUnit" type="text" class="form-control form-control-sm input-border-bottom input-border-bottom-custom" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col md-3">
              <div class="form-group ">
                <label for="volumePerDays" class="placeholder">Volume/Days</label>
                <input id="volumePerDays" placeholder="Volume/Days" name="volumePerDays" type="text" class="form-control form-control-sm input-border-bottom input-border-bottom-custom" required>
              </div>
            </div>
            <div class="col md-3">
              <div class="form-group ">
                <label for="qtySafety" class="placeholder">Qty Safety</label>
                <input id="qtySafety" placeholder="Qty Safety" name="qtySafety" type="text" class="form-control form-control-sm input-border-bottom input-border-bottom-custom" required>
              </div>
            </div>
            <div class="col md-3">
              <div class="form-group ">
                <label for="safetyForDays" class="placeholder">Day</label>
                <input id="safetyForDays" placeholder="Safety For Days" name="safetyForDays" type="number" class="form-control form-control-sm input-border-bottom input-border-bottom-custom" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col md-3">
              <div class="form-group ">
                <label for="forecast" class="placeholder">Forecast</label>
                <input id="forecast" placeholder="Forecast" name="forecast" type="text" class="form-control form-control-sm input-border-bottom input-border-bottom-custom" required>
              </div>
            </div>
            <div class="col md-3">
              <div class="form-group ">
                <label for="remarks" class="placeholder">Remarks</label>
                <input id="remarks" placeholder="Remarks" name="remarks" type="text" class="form-control form-control-sm input-border-bottom input-border-bottom-custom" required>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col md-3">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" name="status_part" id="status_part" type="checkbox">
                  <span class="form-check-sign">Status</span>
                </label>
              </div>
            </div>
          </div>


          <div class="row" id="ErrorInfo"></div>
          <div class="row" id="DeleteInfo"></div>
          <input type="text" hidden name="CrudActionPart" id="CrudActionPart">
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