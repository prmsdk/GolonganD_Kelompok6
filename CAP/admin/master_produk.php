<?php
  session_start();

  $_SESSION['active_link'] = 'master';
  include 'includes/config.php';
  include 'includes/header.php';
  if(!isset($_SESSION['admin_login'])){
    header("location:index.php");
  }

  //SELECT PRODUK
  $result = mysqli_query($con, "SELECT * FROM tampil_produk, kategori_produk 
  WHERE tampil_produk.ID_KATEGORI = kategori_produk.ID_KATEGORI");
?>

<!-- Begin Page Content -->
<div class="container-fluid">
<?php
if(isset($_GET['pesan'])){
  if($_GET['pesan']=='sukses_delete'){
      echo '<div id="alert-login" class="alert alert-success text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
              Anda <strong>Berhasil!</strong> menghapus data!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  }else if($_GET['pesan']=='gagal_delete'){
    echo '<div id="alert-login" class="alert alert-danger text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
            Anda <strong>Gagal!</strong> menghapus data! 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
            
  }else if($_GET['pesan']=='ukuran_besar'){
    echo '<div id="alert-login" class="alert alert-danger text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
              Ukuran Foto Anda <strong>Terlalu Besar!</strong> 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
            
  }else if($_GET['pesan']=='ekstensi_salah'){
    echo '<div id="alert-login" class="alert alert-danger text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
              Ekstensi File yang anda masukkan <strong>Salah!</strong> 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  }else if($_GET['pesan']=='sukses_insert'){
    echo '<div id="alert-login" class="alert alert-success text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
            Anda <strong>Berhasil!</strong> menambahkan data! 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  }else if($_GET['pesan']=='gagal_insert'){
    echo '<div id="alert-login" class="alert alert-danger text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
            Anda <strong>Gagal!</strong> menambahkan data! 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  }else if($_GET['pesan']=='gagal_edit'){
    echo '<div id="alert-login" class="alert alert-success text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
            Anda <strong>Gagal!</strong> mengubah data!.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
  }
}
?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-2">
    <h3 class="mt-2 font-weight-bold float-left text-primary">Tabel Daftar Produk</h3>
    <a class="mt-2 btn btn-primary float-right ml-auto" href="master_produk_tambah.php">Tambah Data</a>
    <a class="mt-2 mr-2 btn btn-biru float-right ml-auto" href="laporan/report_produk.php"><i class="fas fa-fw fa-print"></i></a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Produk</th>
            <th>Desc Produk</th>
            <th>Nama Kategori</th>
            <th>Detail</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0;
            while($data_produk = mysqli_fetch_assoc($result)){
            $id_produk = $data_produk['ID_TAMPIL_PRODUK'];
            $nama_produk = $data_produk['NAMA_TAMPIL_PRODUK']; 
            $desc_produk = $data_produk['DESC_TAMPIL_PRODUK'];
            $ket_produk = $data_produk['KET_TAMPIL_PRODUK'];
            $status_produk = $data_produk['STATUS_TAMPIL_PRODUK'];
            $kategori_produk = $data_produk['NAMA_KAT_PRODUK'];
            $i+=1;
          ?>
          <tr>
            <td class="text-center" style="width:50px"><?=$i?></td>
            <td><?=$nama_produk?></td>
            <td class="text-justify"><?=$desc_produk?></td>
            <td><?=$kategori_produk?></td>
            <td style="width: 67px;" class="text-center">
              <a href="master_produk_detail.php?id_produk=<?=$id_produk?>" class="btn btn-success btn-circle btn-sm">
                <i class="fas fa-info-circle"></i>
              </a>
              <?php if($status_produk == 1){ echo
              '<span href="" class="btn btn-success btn-circle btn-sm">
                <i class="fas fa-check"></i>
              </span>';
              }else if($status_produk == 0){ echo
                '<span href="" class="btn btn-danger btn-circle btn-sm">
                  <i class="fas fa-times"></i>
                </span>';
              } ?>
            </td>
            <td style="width:67px;">
              <div class="block ml-auto">
                <a href="query/master_produk_query.php?action=delete&id_produk=<?=$id_produk?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                  <i class="fas fa-trash"></i>
                </a>
                <a href="master_produk_ubah.php?id_produk=<?=$id_produk?>" class="btn btn-primary btn-circle btn-sm">
                  <i class="fas fa-pencil-alt"></i>
                </a>
              </div>
            </td>
          </tr>
          <?php } ?>
        </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php
  require 'includes/footer.php';
?>