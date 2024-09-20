

function showToast(data,act ,msg) {
    var content = {};
    content.icon = 'fa fa-bell';
    content.message = act + " " + data + " " + msg;
    content.title = 'Notification';
    $.notify(content, {
       type: 'success',
       placement: {
          from: 'top',
          align: 'center'
       },
       time: 400,
       delay:800,
       allow_dismiss: true, 
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        },
        onShown: function() {
            // Handle jqGrid pagination here, or make sure it's functional
        }
    });
}