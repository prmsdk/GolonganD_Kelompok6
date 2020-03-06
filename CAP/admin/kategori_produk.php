<?php
  session_start();

  $_SESSION['active_link'] = 'master';
  include 'includes/config.php';
  include 'includes/header.php';

  if(!isset($_SESSION['admin_login'])){
    header_remove();
    header("location:index.php");
  }

  //SELECT KATEGORI
  $result = mysqli_query($con, "SELECT * FROM kategori_produk");
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
    echo '<div id="alert-login" class="alert alert-danger text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
            Anda <strong>Gagal!</strong> mengubah data!.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
  }else if($_GET['pesan']=='sukses_edit'){
    echo '<div id="alert-login" class="alert alert-success text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
            Anda <strong>Berhasil!</strong> mengubah data!.
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
    <h3 class="mt-2 font-weight-bold float-left text-primary">Tabel Daftar Kategori Produk</h3>
    <button class="mt-2 btn btn-primary float-right" data-toggle="modal" data-target="#tambah_kategori_produk">Tambah Data</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Kategori Produk</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0;
            while($data_kategori_produk = mysqli_fetch_assoc($result)){
            $id_kategori_produk = $data_kategori_produk['ID_KATEGORI'];
            $nama_kategori_produk = $data_kategori_produk['NAMA_KAT_PRODUK']; 
            $i+=1;
          ?>
          <tr>
            <td class="text-center" style="width:100px;"><?=$i?></td>
            <td ><p><?=$nama_kategori_produk?></p></td>
            <td style="width:100px;">
              <div class="block">
                <a href="query/master_kategori_produk_query.php?action=delete&id_kategori_produk=<?=$id_kategori_produk?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                  <i class="fas fa-trash"></i>
                </a>
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

<!-- Modal Tambah -->
<div class="login-bg">
    <div class="row">
      <div class="col-5">
        <div class="modal fade" id="tambah_kategori_produk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-biru-tua">
                    <h5 class="modal-title text-light font-m-bold ml-3" id="editLabel">Tambah Data Admin</h5>
                    <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row justify-content-center">
                  <form action="query/master_kategori_produk_query.php" method="POST">
                    <div class="form-group">
                      <label>Nama Kategori</label>
                      <input type="text" name="nama_kategori" class="form-control" pattern="[^()/><\][\\\x22,;|]+" title="Masukkan data yang valid" placeholder="Masukkan Nama Kategori" required>
                    </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="tambah_kategori_produk" value="Upload">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </form>
        </div>
    </div>
    </div>
  </div>
</div>
<!-- End Modal Tambah -->


<?php
  require 'includes/footer.php';
?>