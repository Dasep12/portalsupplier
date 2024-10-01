<!-- Modal -->
<div class="modal fade" id="CrudPartModalUpload" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="CrudPartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xlModal">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CrudPartModalLabel"><i class="fas fa-plus-square"></i> Add Part</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <form action="#" enctype="multipart/form-data" method="post" id="CrudPartFormUpload">
            @csrf
            <div class="col md-3">
              <div class="form-group ">
                <label for="">File Upload</label>
                <div id="btn-upload" style="position: relative;overflow: hidden;cursor:pointer" class="btn btn-dark btn-sm btn-block">
                  <i class="fa fa-upload"></i> Select File
                  <input style="cursor:pointer" id="excel_file" name="excel_file" type="file" class="form-control-file" required>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="row mb-2 mt-1">
          <div class="col-lg-12 mb-1">
            <div class="progress" style="height: 35px; display: none;">
              <div id="errorText" class="progress-bar progress-bar-animated" role="progressbar" style="width: 0%;"></div>
            </div>
          </div>
        </div>
        <form action="#" enctype="multipart/form-data" method="post" id="CrudPartForm2">
          @csrf
          <div class="row">
            <div class="col md-12">
              <div class="table-responsive">
                <table id="JqGridTempUpload"></table>
                <div id="jqGridPager2"></div>
              </div>
            </div>
          </div>
          <div class="row mt-1" id="ErrorInfoUpload"></div>
          <input type="text" hidden name="CrudActionPartUpload" id="CrudActionPartUpload">
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
      label: 'Supplier',
      name: 'supplier_name',
      // width: 75
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
      label: 'Part Number',
      name: 'part_number',
      // width: 80,
    }, {
      label: 'Part Name',
      name: 'part_name',
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
      label: 'Forecast',
      name: 'forecast',
      // width: 75
    }, {
      label: 'Vol/Day',
      name: 'volumePerDays',
      align: 'center',
      width: 80,
    }, {
      label: 'Qty',
      name: 'qtySafety',
      align: 'center',
      width: 60,
    }, {
      label: 'Day',
      name: 'safetyForDays',
      align: 'center',
      width: 60,
    }, {
      label: 'Category',
      name: 'name_category',
      width: 90,
      align: 'center'
    }, {
      label: 'Remarks',
      name: 'remarks',
      // width: 75
    }],
    height: 'auto',
    rowNum: 10,
    pager: "#jqGridPager2",
    viewrecords: true,
    width: '100%',
    autowidth: true,
    height: 'auto',
    // caption: " ",
    loadComplete: function(data) {
      var modalWidth = $('.table-responsive').width(); // Get the modal width
      $("#JqGridTempUpload").setGridWidth(modalWidth * 1.1); // Set jqGrid width (95% of modal width)
    },
  });

  function partExists(idx) {
    return dataTemp.some(function(el) {
      return el.uniq == idx;
    });
  }

  jQuery("#JqGridTempUpload").jqGrid('setGroupHeaders', {
    useColSpanStyle: true,
    groupHeaders: [{
      startColumnName: 'qtySafety',
      numberOfColumns: 2,
      titleText: 'Safety Stock'
    }]
  });


  // Trigger form submission when a file is selected
  $('#excel_file').on('change', function() {
    if ($(this).val()) {
      $('.progress').hide();
      // If file is selected, submit the form
      $('#CrudPartFormUpload').submit();
    }
  });


  $("#CrudPartFormUpload").validate({
    ignore: ":hidden",
    submitHandler: function(form) {
      $.ajax({
        url: "{{ url('loadPart') }}",
        method: 'POST',
        data: new FormData(form),
        contentType: false,
        processData: false,
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
          $("#excel_file").val('');
          $('.progress-bar').css('width', '100%');
          $("#file-upload").val('');
          $("#errorText").removeClass('bg-danger');
          $("#errorText").addClass('bg-success');
          $('.progress-bar').html('<h5 class="mt-1"><i class="fa fa-check"></i> Upload Success</h5>');
          dataTemp = [];
          if (response.success) {
            var resp = response.data;
            var error = response.error;
            for (let r = 0; r < resp.length; r++) {

              var params = {
                'supplier_name': resp[r].supplier_name,
                'model': resp[r].model,
                'uniq': resp[r].uniq,
                'part_number': resp[r].part_number,
                'part_name': resp[r].part_name,
                'unit_code': resp[r].unit_code,
                'units_code': resp[r].units_code,
                'qtyPerUnit': resp[r].qtyPerUnit,
                'forecast': resp[r].forecast,
                'volumePerDays': resp[r].volumePerDays,
                'qtySafety': resp[r].qtySafety,
                'safetyForDays': resp[r].safetyForDays,
                'name_category': resp[r].name_category,
                'remarks': resp[r].remarks,
              };
              if (partExists(resp[r].uniq)) {
                // console.log("data has been exist " + resp[r].uniq)
              } else {
                dataTemp.push(params)
              }
            }
            reloadgridItem(dataTemp)
            if (error.length > 0) {
              var errMsg = '<div class="col-md-12"><div class="alert alert-custom-warning alert-warning alert-dismissible fade show" role="alert"><small><b> Error !</b><br/><ul>';
              for (er = 0; er < error.length; er++) {
                errMsg += '<li>'
                errMsg += '<b>' + error[er] + '</b>'
                errMsg += '</li>'
              }
              errMsg += '</ul></small><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button></div></div>'
              $('#ErrorInfoUpload').html(errMsg);
              $(".btn-upload-file").attr("disabled", true);
            } else {
              $(".btn-upload-file").attr("disabled", false);
              $('#ErrorInfoUpload').html('');
            }
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
      return false;
    }
  })

  $("#CrudPartForm2").validate({
    ignore: ":hidden",
    submitHandler: function(form) {
      var allData = $("#JqGridTempUpload").jqGrid('getRowData');
      $.ajax({
        url: "{{ url('uploadPart') }}",
        method: 'POST',
        cache: false,
        data: {
          "_token": "{{ csrf_token() }}",
          allData: allData
        },
        success: function(response) {
          console.log(response.success)
          if (response.success) {
            reloadgridItem(dataTemp)
            $("#CrudPartModalUpload").modal('hide');
            doSuccess('part', $("#CrudActionPartUpload").val())
          }
          // if (error.length > 0) {
          //   var errMsg = '<div class="col-md-12"><div class="alert alert-custom-warning alert-warning alert-dismissible fade show" role="alert"><small><b> Error !</b><br/><ul>';
          //   for (er = 0; er < error.length; er++) {
          //     errMsg += '<li>'
          //     errMsg += '<b>' + error[er] + '</b>'
          //     errMsg += '</li>'
          //   }
          //   errMsg += '</ul></small><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button></div></div>'
          //   $('#ErrorInfoUpload').html(errMsg);
          // }
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
      return false;
    }
  })
</script>