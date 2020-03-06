<?php
  session_start();

  $_SESSION['active_link'] = 'master';
  include 'includes/config.php';
  include 'includes/header.php';
  if(!isset($_SESSION['admin_login'])){
    header("location:index.php");
  }

  //SELECT Ukuran
  $result = mysqli_query($con, "SELECT * FROM ukuran, kategori_ukuran WHERE ukuran.ID_KAT_UKURAN = kategori_ukuran.ID_KAT_UKURAN");
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
    <h3 class="mt-2 font-weight-bold float-left text-primary">Tabel Daftar Ukuran</h3>
    <button class="mt-2 btn btn-primary float-right ml-auto" data-toggle="modal" data-target="#tambah_ukuran">Tambah Data</button>
    <a class="mt-2 mr-2 btn btn-biru float-right ml-auto" href="laporan/report_ukuran.php"><i class="fas fa-fw fa-print"></i></a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Jenis Ukuran</th>
            <th>Harga Ukuran</th>
            <th>Kategori Ukuran</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0;
            while($data_ukuran = mysqli_fetch_assoc($result)){
            $id_ukuran = $data_ukuran['ID_UKURAN'];
            $jenis_ukuran = $data_ukuran['JENIS_UKURAN']; 
            $harga_ukuran = $data_ukuran['HARGA_UKURAN'];
            $kategori_ukuran = $data_ukuran['NAMA_KAT_UKURAN'];
            $i+=1;
          ?>
          <tr>
            <td class="text-center" style="width:50px"><?=$i?></td>
            <td><?=$jenis_ukuran?></td>
            <td>Rp. <?=$harga_ukuran?>,00</td>
            <td><?=$kategori_ukuran?></td>
            <td style="width:67px;">
              <div class="block ml-auto">
                <a href="query/master_ukuran_query.php?action=delete&id_ukuran=<?=$id_ukuran?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                  <i class="fas fa-trash"></i>
                </a>
                <a href="master_ukuran_ubah.php?id_ukuran=<?=$id_ukuran?>" class="btn btn-primary btn-circle btn-sm">
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

<!-- Modal Tambah -->
<div class="login-bg">
    <div class="row">
      <div class="col-5">
        <div class="modal fade" id="tambah_ukuran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-biru-tua">
                    <h5 class="modal-title text-light font-m-bold ml-3" id="editLabel">Tambah Data Ukuran</h5>
                    <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row justify-content-center">
                  <form class="font-m-light col-11 mt-3" action="query/master_ukuran_query.php" method="post">
                    <div class="form-group">
                      <label for="jenis_ukuran" class="font-m-med">Jenis Ukuran</label>
                      <input type="text" class="form-control" id="jenis_ukuran" name="jenis_ukuran" aria-describedby="usernameHelp" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" placeholder="Masukkan Jenis Ukuran" required>
                    </div>
                    <div class="form-group">
                      <label for="harga_ukuran" class="font-m-med">Harga Ukuran</label>
                      <input type="text" class="form-control" id="harga_ukuran" name="harga_ukuran" aria-describedby="usernameHelp" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" placeholder="Masukkan Harga Ukuran" required>
                    </div>
                    <div class="form-group">
                      <label for="kategori_ukuran">Kategori Ukuran</label>
                      <select class="form-control" id="kategori_ukuran" name="kategori_ukuran">
                        <?php 
                          $data = mysqli_query($con, "SELECT * FROM kategori_ukuran");
                          while($data_kat_ukuran = mysqli_fetch_assoc($data)){
                          $id_kategori_ukuran = $data_kat_ukuran['ID_KAT_UKURAN'];
                          $nama_kategori_ukuran = $data_kat_ukuran['NAMA_KAT_UKURAN'];
                        ?>
                        <option value="<?=$id_kategori_ukuran?>"><?=$nama_kategori_ukuran?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="tambah_ukuran" value="Simpan">
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