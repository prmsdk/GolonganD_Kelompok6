<?php
    session_start();

    $_SESSION['active_link']= 'master';
    include 'includes/config.php';
    include 'includes/header.php';
    if(!isset($_SESSION['admin_login'])){
        header("location:index.php");
    }

    //SELECT WARNA
    $result = mysqli_query($con, "SELECT * FROM warna");
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
    <h3 class="mt-2 font-weight-bold float-left text-primary">Daftar Tabel Warna</h3>
    <button class="mt-2 btn btn-primary float-right ml-auto" data-toggle="modal" data-target="#tambah_warna">Tambah Data</button>
    <a class="mt-2 mr-2 btn btn-biru float-right ml-auto" href="laporan/report_warna.php"><i class="fas fa-fw fa-print"></i></a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>No.</th>
            <th>Jenis Warna</th>
            <th>Deskripsi Warna</th>
            <th>Harga Warna</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0;
            while($data_warna = mysqli_fetch_assoc($result)){
            $id_warna = $data_warna['ID_WARNA'];
            $jenis_warna = $data_warna['JENIS_WARNA']; 
            $desc_warna = $data_warna['WARNA_DESC'];
            $harga_warna = $data_warna['HARGA_WARNA'];
            $i+=1;
          ?>
          <tr>
            <td class="text-center" style="width:50px"><?=$i?></td>
            <td style="width:200px;"><?=$jenis_warna?></td>
            <td class="text-justify"><?=$desc_warna?></td>
            <td style="width:110px;">Rp. <?=$harga_warna?>,00</td>
            <td style="width:67px;">
              <div class="block ml-auto">
                <a href="query/master_warna_query.php?action=delete&id_warna=<?=$id_warna?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                  <i class="fas fa-trash"></i>
                </a>
                <a href="master_warna_ubah.php?id_warna=<?=$id_warna?>" class="btn btn-primary btn-circle btn-sm">
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

<div class="login-bg">
    <div class="row">
      <div class="col-5">
        <div class="modal fade" id="tambah_warna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-biru-tua">
                    <h5 class="modal-title text-light font-m-bold ml-3" id="editLabel">Tambah Data Warna</h5>
                    <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row justify-content-center">
                  <form class="font-m-light col-11 mt-3" action="query/master_warna_query.php" method="post">
                    <div class="form-group">
                      <label for="jenis_warna" class="font-m-med">Jenis Warna</label>
                      <input type="text" class="form-control" id="jenis_warna" name="jenis_warna" aria-describedby="usernameHelp" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" placeholder="Masukkan Jenis warna" required>
                    </div>
                    <div class="form-group">
                      <label for="harga_warna" class="font-m-med">Deskripsi Warna</label>
                      <textarea name="desc_warna" id="desc_warna" class="form-control" placeholder="Masukkan Deskripsi Warna . ." pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" minlenght="5" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="harga_warna" class="font-m-med">Harga Warna</label>
                      <input type="number" class="form-control" id="harga_warna" name="harga_warna" aria-describedby="usernameHelp" placeholder="Masukkan Harga Warna" required>
                    </div>
                  </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="tambah_warna" value="Simpan">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
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