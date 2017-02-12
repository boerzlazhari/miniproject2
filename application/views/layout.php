<!DOCTYPE html>
<html>

<?php $this->load->view('page/head'); ?>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <?php $this->load->view('page/header') ?>
  
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('page/sidebar') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php if (isset($view) && $view != ''): ?>
        
      <section class="content-header">
        <h1>
          <?=isset($header) ? $header : '';?>
          <small><?=isset($header_child) ? $header_child : '';?></small>
        </h1>
        <!-- <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol> -->
      </section>

      <section class="content">
        <div class="row">
          <?php $this->load->view($view) ?>
        </div>
      </section>
    <?php else: ?>
      <section class="content-header">
        Halaman yang anda kunjungi belum tersedia.      
      </section>
    <?php endif ?>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('page/footer') ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

</body>
</html>
