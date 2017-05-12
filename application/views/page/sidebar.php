<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url()?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$this->session->userdata('user_name')?></p>
          <a href="#"><?=$this->session->userdata('user_level_name')?></a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN MENU</li>
        <li class="<?=($menu == 1) ? 'active' : ''?>"><a href="<?=base_url()?>home"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
        <li class="treeview <?=($menu == 2) ? 'active' : ''?>">
          <a href="#">
            <i class="fa fa-suitcase"></i> <span>Kerja Praktek</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?=($menu == 2 && $menu_child == 1) ? 'active' : ''?>"><a href="<?=base_url()?>kerja_praktek/pengajuan_kp"><i class="fa fa-circle-o"></i>Pengajuan</a></li>
            <li class="<?=($menu == 2 && $menu_child == 2) ? 'active' : ''?>"><a href="<?=base_url()?>kerja_praktek/bimbingan_kp"><i class="fa fa-circle-o"></i>Bimbingan</a></li>
            <li class="<?=($menu == 2 && $menu_child == 3) ? 'active' : ''?>"><a href="<?=base_url()?>kerja_praktek/daftar_sidang_kp"><i class="fa fa-circle-o"></i>Pendaftaran Sidang</a></li>
            <li class="<?=($menu == 2 && $menu_child == 4) ? 'active' : ''?> <?=($this->session->userdata('user_level') < 7) ? '' : 'hidden' ?>"><a href="<?=base_url()?>kerja_praktek/penilaian_kp"><i class="fa fa-circle-o"></i>Penilaian</a></li>
          </ul>
        </li>
        <li class="treeview <?=($menu == 3) ? 'active' : ''?>">
          <a href="#">
            <i class="fa fa-mortar-board"></i>
            <span>Skripsi</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php 
              $hidden = '';
              if ($this->session->userdata('user_level') == 7){
                $hidden = 'hidden';
              }
            ?>
            <li class="<?=($menu == 3 && $menu_child == 1) ? 'active' : ''?> <?=($this->session->userdata('user_level') != 7) ? 'hidden' : '' ?>"><a href="<?=base_url()?>skripsi/pengajuan_sk"><i class="fa fa-circle-o"></i> Pengajuan</a></li>
            <li class="<?=($menu == 3 && $menu_child == 2) ? 'active' : ''?> <?=($this->session->userdata('user_level') == 7) ? 'hidden' : '' ?>"><a href="<?=base_url()?>skripsi/daftar_pengajuan_sk"><i class="fa fa-circle-o"></i> Daftar Pengajuan</a></li>
            <li class="<?=($menu == 3 && $menu_child == 3) ? 'active' : ''?> <?=($this->session->userdata('user_level') != 7) ? 'hidden' : '' ?>"><a href="<?=base_url()?>skripsi/pengajuan_prasidang"><i class="fa fa-circle-o"></i> Pendaftaran Pra Sidang</a></li>
            <li class="<?=($menu == 3 && $menu_child == 4) ? 'active' : ''?> <?=($this->session->userdata('user_level') == 7) ? 'hidden' : '' ?>"><a href="<?=base_url()?>skripsi/daftar_pengajuan_prasidang"><i class="fa fa-circle-o"></i> Daftar Pengajuan P.Sidang</a></li>
            <li class="<?=($menu == 3 && $menu_child == 5) ? 'active' : ''?> <?=($this->session->userdata('user_level') != 7) ? 'hidden' : '' ?>"><a href="<?=base_url()?>skripsi/pengajuan_sidang"><i class="fa fa-circle-o"></i> Pendaftaran Sidang</a></li>
            <li class="<?=($menu == 3 && $menu_child == 6) ? 'active' : ''?> <?=($this->session->userdata('user_level') == 7) ? 'hidden' : '' ?>"><a href="<?=base_url()?>skripsi/daftar_pengajuan_sidang"><i class="fa fa-circle-o"></i> Daftar Pengajuan Sidang</a></li>
          </ul>
        </li>
        <!-- <li class="treeview <?=($menu == 4) ? 'active' : ''?>">
          <a href="#">
            <i class="fa fa-gears"></i>
            <span>Master</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?=($menu == 4 && $menu_child == 1) ? 'active' : ''?>"><a href="<?=base_url()?>master/prodi"><i class="fa fa-circle-o"></i> Program Studi</a></li>
            <li class="<?=($menu == 4 && $menu_child == 2) ? 'active' : ''?>"><a href="<?=base_url()?>master/mahasiswa"><i class="fa fa-circle-o"></i> Mahasiswa</a></li>
            <li class="<?=($menu == 4 && $menu_child == 3) ? 'active' : ''?>"><a href="<?=base_url()?>master/dosen"><i class="fa fa-circle-o"></i> Dosen</a></li>
            <li class="<?=($menu == 4 && $menu_child == 4) ? 'active' : ''?>"><a href="<?=base_url()?>master/kategori_nilai"><i class="fa fa-circle-o"></i> Kategori Penilaian</a></li>
          </ul>
        </li> -->
        <li class="header">KELUAR</li>
        <li><a href="<?=base_url()?>home/logout"><i class="fa fa-power-off"></i> <span>Keluar</span></a></li>
        <!-- <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>