<!DOCTYPE html>
<html lang="id">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Sistem Informasi Penggajian </title>

    <link href="<?php echo base_url()?>assets/admin/css/app.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/admin/css/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/admin/css/form.css" rel="stylesheet">
    <?php
    if (isset($datatables) and $datatables) { ?>
      <link href="<?php echo base_url()?>assets/admin/css/tables.css" rel="stylesheet">
    <?php } ?>
</head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <!-- sidebar menu -->
      <div class="col-md-3 left_col menu_fixed">
          <!-- sidebar menu -->
          <?php require_once('sidebar.php');?>
          <!-- sidebar menu -->
      </div>
      <!-- sidebar menu -->

      <!-- top navigation -->
      <div class="top_nav">
        <?php require_once('topnav.php');?>
      </div>
      <!-- /top navigation -->

      <!-- content -->
      <!-- content -->