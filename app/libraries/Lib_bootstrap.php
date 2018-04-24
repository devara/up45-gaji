<?php

/**
 * @author Zulfikar Adnan
 * @copyright 2016 Klinik Media
 */

class Lib_bootstrap{
  function alert_blue($pesan=false){
    return '<div class="alert alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$pesan.'</div>';
  }
  function alert_green($pesan=false){
    return '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$pesan.'</div>';
  }
  function alert_red($pesan=false){
    return '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$pesan.'</div>';
  }
  function alert_cyan($pesan=false){
    return '<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$pesan.'</div>';
  }
  function alert_orange($pesan=false){
    return '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$pesan.'</div>';
  }
}

?>