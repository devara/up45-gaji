function loader_blue(){
  return '<div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>';
}
function loader_green(){
  return '<div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>';
}
function loader_red(){
  return '<div class="progress"><div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>';
}
function loader_cyan(){
  return '<div class="progress"><div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>';
}
function loader_orange(){
  return '<div class="progress"><div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>';
}
function alert_blue(pesan){
  return '<div class="alert alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+pesan+'</div>';
}
function alert_green(pesan){
  return '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+pesan+'</div>';
}
function alert_red(pesan){
  return '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+pesan+'</div>';
}
function alert_cyan(pesan){
  return '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+pesan+'</div>';
}
function alert_orange(pesan){
  return '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+pesan+'</div>';
}
function get_formdata($form){
  var unindexed_array = $form.serializeArray();
  var indexed_array = {};
  $.map(unindexed_array, function(n, i){
    indexed_array[n['name']] = n['value'];
  });
  return indexed_array;
}
var showSpinningProgressLoading=function(e){
  $.blockUI({
    message: '<img src="http://localhost/up45-gaji/assets/admin/loader/gears.svg"/><br><h4 style="color:#ecf0f1;">Tunggu sebentar...</h4>',
    css: {
      border: 'none',
      padding: '15px',
      backgroundColor: 'none',
      opacity: 1,
      zIndex: 20000,
    }
  });
};
var hideSpinningProgressLoading=function(e){
  setTimeout($.unblockUI, 500);
};
