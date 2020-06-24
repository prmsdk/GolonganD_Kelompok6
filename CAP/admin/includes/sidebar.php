    
    <!-- Sidebar -->
    <ul class="navbar-nav bg-biru-tua sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="../src/img/icons/cap.png" alt="" width="40px" class="img-fluid">
        </div>
        <div class="sidebar-brand-text mx-3">Admin ACP</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <?php
        if(isset($_SESSION['admin_login'])){
      ?>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?php if($_SESSION['active_link']==='dashboard'){echo "active";}?>">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      
      <?php 
      if(isset($_SESSION['admin_status'])){
        if($_SESSION['admin_status']==1){?>
      <!-- Heading -->
      <div class="sidebar-heading">
        Transaksi & Profile
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php if($_SESSION['active_link']==='pemesanan'){echo "active";}?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Pemesanan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Transaksi Pemesanan :</h6>
            <a class="collapse-item" href="trs_antrian.php">Antrian</a>
            <a class="collapse-item" href="trs_history_admin.php">History</a>
            <a class="collapse-item" href="trs_notifikasi_admin.php">Notifikasi</a>
            <a class="collapse-item" href="master_nego.php">Nego</a>
          </div>
        </div>
      </li>
      <?php } } ?>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item <?php if($_SESSION['active_link']==='setting'){echo "active";}?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-cog"></i>
          <span>Setting</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Setting Profile:</h6>
            <a class="collapse-item" href="admin_profil.php">Profile</a>
            <?php
            if(isset($_SESSION['admin_status'])){
            if($_SESSION['admin_status']==1){?>
            <a class="collapse-item" href="master_slider.php">Promo / Slider</a>
            <a class="collapse-item" href="master_pesan.php">Pesan</a>
            <a class="collapse-item" href="master_portfolio.php">Portofolio</a>
            <a class="collapse-item" href="master_testimonial.php">Testimonial</a>
            <?php } } ?>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Master & Laporan
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php if($_SESSION['active_link']==='master'){echo "active";}?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Master</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Form Master:</h6>
            <a class="collapse-item" href="master_produk.php">Produk</a>
            <a class="collapse-item" href="master_bahan.php">Bahan</a>
            <a class="collapse-item" href="master_ukuran.php">Ukuran</a>
            <a class="collapse-item" href="master_warna.php">Warna</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Form Detail:</h6>
            <a class="collapse-item" href="master_produk_gambar.php">Gambar Produk</a>
            <a class="collapse-item" href="master_satuan.php">Satuan Bahan</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Form Kategori:</h6>
            <a class="collapse-item" href="kategori_produk.php">Kategori Produk</a>
            <a class="collapse-item" href="kategori_bahan.php">Kategori Bahan</a>
            <a class="collapse-item" href="kategori_ukuran.php">Kategori Ukuran</a>
            <?php 
            if(isset($_SESSION['admin_status'])){
              if($_SESSION['admin_status']==1){?>
              <h6 class="collapse-header">Form Akun:</h6>
              <a class="collapse-item" href="master_user.php">User</a>
              <a class="collapse-item" href="master_admin.php">Admin</a>
              <a class="collapse-item" href="master_rekening.php">Rekening</a>
            <?php
              }
            }
            ?>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item <?php if($_SESSION['active_link']==='laporan'){echo "active";}?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan">
          <i class="fas fa-fw fa-print"></i>
          <span>Laporan</span>
        </a>
        <div id="collapseLaporan" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Laporan:</h6>
            <a class="collapse-item" href="transaksi_bulanan.php">Transaksi per Bulan</a>
            <a class="collapse-item" href="transaksi_tahunan.php">Transaksi per Tahun</a>
            <a class="collapse-item" href="transaksi_rentang.php">Transaksi Rentang Hari</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Tables -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li> -->

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
      <?php }?>      
    </ul>
    <!-- End of Sidebar -->