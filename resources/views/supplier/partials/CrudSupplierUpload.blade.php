<!-- Modal -->
<div class="modal fade" id="CrudSupplierUploadModalUpload" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="CrudSupplierUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xlModal">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CrudSupplierUploadModalLabel"><i class="fas fa-plus-square"></i> Add Part</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row mb-0">
          <div class="col-md-7">
            <form action="{{ url('uploadFilesSupplier') }}" enctype="multipart/form-data" method="post" id="CrudSupplierUploadFormUpload">
              @csrf
              <div class="row">
                <div class="col-lg-3">
                  <div class="form-group form-group-sm">
                    <label for="">File Upload</label>
                    <div id="btn-upload" style="position: relative;overflow: hidden;cursor:pointer" class="btn btn-dark btn-sm btn-block">
                      <i class="fa fa-upload"></i> Select File
                      <input style="cursor:pointer" id="excel_file" name="excel_file" type="file" class="form-control-file" required>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="row mb-2 mt-1">
          <div class="col-lg-12 mb-1">
            <div class="progress" style="height: 35px; display: none;">
              <div id="errorText" class="progress-bar progress-bar-animated" role="progressbar" style="width: 0%;"></div>
            </div>
          </div>
        </div>
        <form action="#" enctype="multipart/form-data" method="post" id="CrudSupplierUploadFormUpload2">
          @csrf
          <div class="row">
            <div class="col md-12">
              <div class="table-responsive">
                <table id="JqGridTempUpload"></table>
                <div id="jqGridPager2"></div>
                <a href="" class="mt-2 mb-3 btn btn-primary btn-success-custom"><i class="fa fa-file-excel"></i> Download Template</a>
              </div>
            </div>
          </div>
          <div class="row mt-1" id="ErrorInfoUpload"></div>
          <input type="text" hidden name="CrudActionSupplierUpload" id="CrudActionSupplierUpload">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-submit btn-danger btn-danger-custom" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancel</button>
        <button type="submit" class="btn-upload-file btn btn-submit btn-success btn-success-custom"><i class="fas fa-check-double"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Initialize jqGrid
  $("#JqGridTempUpload").jqGrid({
    datatype: "local",
    data: [],
    colModel: [{
      label: 'Supplier Code',
      name: 'supplier_id',
      // width: 75
    }, {
      label: 'Supplier',
      name: 'supplier_name',
      // width: 75
    }, {
      label: 'Phone',
      name: 'phone',
      // width: 80,
    }, {
      label: 'Email',
      name: 'email',
      // width: 80,
    }, {
      label: 'Address',
      name: 'address',
      // width: 80,
    }],
    loadonce: false,
    viewrecords: true,
    rownumbers: true,
    rownumWidth: 30,
    autoresizeOnLoad: true,
    gridview: true,
    width: '100%',
    rowNum: 20,
    shrinkToFit: true,
    rowList: [10, 20],
    pager: "#jqGridPager2",
    loadComplete: function(data) {
      var modalWidth = $('.table-responsive').width(); // Get the modal width
      $("#JqGridTempUpload").setGridWidth(modalWidth * 1.09); // Set jqGrid width (95% of modal width)
    },
  });

  function partExists(idx) {
    return dataTemp.some(function(el) {
      return el.supplier_id == idx;
    });
  }

  // Trigger form submission when a file is selected
  $('#excel_file').on('change', function() {
    if ($(this).val()) {
      $('.progress').hide();
      // If file is selected, submit the form
      $('#CrudSupplierUploadFormUpload').submit();
    }
  });

  $('#CrudSupplierUploadFormUpload').on('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission
    var formData = new FormData(this);
    $.ajax({
      url: $(this).attr('action'),
      method: 'POST',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function() {
        dataTemp = [];
        // Show the progress bar and reset its state
        $('.progress').show();
        $('.progress-bar').css('width', '0%').addClass('progress-bar-animated');
      },
      xhr: function() {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener('progress', function(e) {
          if (e.lengthComputable) {
            var percentComplete = Math.round((e.loaded / e.total) * 100);
            // Update progress bar
            $('.progress-bar').css('width', percentComplete + '%');
            $('.progress-bar').html('Uploading');
            $('.progress-bar').attr('aria-valuenow', percentComplete);
          }
        }, false);

        return xhr;
      },
      success: function(response) {
        $('.progress-bar').css('width', '100%');
        $("#file-upload").val('');
        $("#errorText").removeClass('bg-danger');
        $("#errorText").addClass('bg-success');
        $('.progress-bar').html('<h5 class="mt-1"><i class="fa fa-check"></i> Upload Success</h5>');

        if (response.success) {
          var resp = response.data;
          for (let r = 0; r < resp.length; r++) {
            var params = {
              'supplier_id': resp[r].supplier_id,
              'supplier_name': resp[r].supplier_name,
              'phone': resp[r].phone,
              'email': resp[r].email,
              'address': resp[r].address,
            };
            if (partExists(resp[r].supplier_id)) {
              // console.log("data has been exist " + resp[r].uniq)
            } else {
              dataTemp.push(params);
            }
          }
          reloadgridItem(dataTemp);
          $(".btn-upload-file").attr("disabled", false);
          $('#ErrorInfoUpload').html('');
        } else {
          var error = response.errors;
          var errMsg = '<div class="col-md-12"><div class="alert alert-custom-warning alert-warning alert-dismissible fade show" role="alert"><small><b> Error !</b><br/><ul>';
          for (er = 0; er < error.length; er++) {
            errMsg += '<li>'
            errMsg += '<b>' + error[er] + '</b>'
            errMsg += '</li>'
          }
          errMsg += '</ul></small><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button></div></div>'
          $('#ErrorInfoUpload').html(errMsg);
          $(".btn-upload-file").attr("disabled", true);
          setTimeout(() => {
            $('.progress').hide();
          }, 1500);
        }
      },
      error: function(xhr, desc, err) {
        var respText = "";
        try {
          respText = eval(xhr.responseText);
        } catch {
          respText = xhr.responseJSON.message;
        }
        $("#errorText").removeClass('bg-success');
        $("#errorText").addClass('bg-danger');
        var errMsg = '<div class="col-md-12"><div class="alert alert-custom-warning alert-warning alert-dismissible fade show" role="alert"><small><b> Error ' + xhr.status + '!</b><br/>' + respText + '</small><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button></div></div>'
        $('#errorText').html(`Error ${xhr.status} ! ${respText} `);
        // $('#upload-result').html(errMsg);
        $(".btn-upload-file").attr("disabled", true);
      }
    });
  });

  $("#CrudSupplierUploadFormUpload2").submit(function(e) {

    e.preventDefault();
    var allData = $("#JqGridTempUpload").jqGrid('getRowData');
    if (allData.length > 0) {
      $.ajax({
        url: "{{ url('jsonCrudSupplier') }}",
        method: 'POST',
        cache: false,
        data: {
          "_token": "{{ csrf_token() }}",
          "CrudActionSupplier": $("#CrudActionSupplierUpload").val(),
          allData: allData,
        },
        success: function(response) {
          if (response.success) {
            reloadGridList()
            reloadgridItem(dataTemp)
            $("#CrudSupplierUploadModalUpload").modal('hide');
            doSuccess('supplier', "create")
            $('.progress').hide();
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
          $('#ErrorInfoUpload').html(errMsg);
        },
      });
    } else {
      showToast('file empty', "upload", ",check file again")
    }
  })
</script>