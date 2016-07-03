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

<!-- jQuery 2.2.0 -->
<script src="<?=base_url()?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/dist/js/app.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?=base_url()?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
</body>
</html>
