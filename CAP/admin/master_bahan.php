<?php
  session_start();

  $_SESSION['active_link'] = 'master';
  include 'includes/config.php';
  include 'includes/header.php';
  if(!isset($_SESSION['admin_login'])){
    header("location:index.php");
  }

  //SELECT BAHAN
  $result = mysqli_query($con, "SELECT * FROM bahan, kategori_bahan, satuan_bahan 
  WHERE bahan.ID_KAT_bahan = kategori_bahan.ID_KAT_bahan AND
  bahan.ID_SATUAN = satuan_bahan.ID_SATUAN");
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
    <h3 class="mt-2 font-weight-bold float-left text-primary">Tabel Daftar Bahan</h3>
    <button class="mt-2 btn btn-primary float-right ml-auto" data-toggle="modal" data-target="#tambah_bahan">Tambah Data</button>
    <a class="mt-2 mr-2 btn btn-biru float-right ml-auto" href="laporan/report_bahan.php"><i class="fas fa-fw fa-print"></i></a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Bahan</th>
            <th>Satuan Bahan</th>
            <th>Jumlah Satuan</th>
            <th>Harga Bahan</th>
            <th>Kategori</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0;
            while($data_bahan = mysqli_fetch_assoc($result)){
            $id_bahan = $data_bahan['ID_BAHAN'];
            $nama_bahan = $data_bahan['NAMA_BAHAN']; 
            $satuan_bahan = $data_bahan['SATUAN'];
            $jumlah_satuan = $data_bahan['JUMLAH_SATUAN'];
            $harga_bahan = $data_bahan['HARGA_BAHAN'];
            $kategori_bahan = $data_bahan['NAMA_KAT_BAHAN'];
            $i+=1;
          ?>
          <tr>
            <td class="text-center" style="width:50px"><?=$i?></td>
            <td><?=$nama_bahan?></td>
            <td><?=$satuan_bahan?></td>
            <td><?=$jumlah_satuan?></td>
            <td><?='Rp. '. number_format($harga_bahan, 0,".",".")?></td>
            <td><?=$kategori_bahan?></td>
            <td style="width:67px;">
              <div class="block ml-auto">
                <a href="query/master_bahan_query.php?action=delete&id_bahan=<?=$id_bahan?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                  <i class="fas fa-trash"></i>
                </a>
                <a href="master_bahan_ubah.php?id_bahan=<?=$id_bahan?>" class="btn btn-primary btn-circle btn-sm">
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
        <div class="modal fade" id="tambah_bahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-biru-tua">
                    <h5 class="modal-title text-light font-m-bold ml-3" id="editLabel">Tambah Data Bahan</h5>
                    <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row justify-content-center">
                  <form class="font-m-light col-11 mt-3" action="query/master_bahan_query.php" method="post">
                    <div class="form-group">
                      <label for="nama_bahan" class="font-m-med">Nama bahan</label>
                      <input type="text" class="form-control" id="nama_bahan" name="nama_bahan" aria-describedby="usernameHelp" pattern="[^()/><\][\\\x22,;|]+" title="Masukkan data yang valid" placeholder="Masukkan Nama Bahan" required>
                    </div>
                    <div class="form-group">
                      <label for="satuan_bahan">Satuan Bahan</label>
                      <select class="form-control" id="satuan_bahan" name="satuan_bahan">
                        <?php 
                          $data = mysqli_query($con, "SELECT * FROM satuan_bahan");
                          while($data_sat_bahan = mysqli_fetch_assoc($data)){
                          $id_sat_bahan = $data_sat_bahan['ID_SATUAN'];
                          $nama_sat_bahan = $data_sat_bahan['SATUAN'];
                        ?>
                        <option value="<?=$id_sat_bahan?>"><?=$nama_sat_bahan?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="harga_bahan" class="font-m-med">Harga bahan</label>
                      <input type="number" class="form-control" id="harga_bahan" name="harga_bahan" aria-describedby="usernameHelp" placeholder="Masukkan Harga bahan" required>
                    </div>
                    <div class="form-group">
                      <label for="kategori_bahan">Kategori bahan</label>
                      <select class="form-control" id="kategori_bahan" name="kategori_bahan">
                        <?php 
                          $data = mysqli_query($con, "SELECT * FROM kategori_bahan");
                          while($data_kat_bahan = mysqli_fetch_assoc($data)){
                          $id_kategori_bahan = $data_kat_bahan['ID_KAT_BAHAN'];
                          $nama_kategori_bahan = $data_kat_bahan['NAMA_KAT_BAHAN'];
                        ?>
                        <option value="<?=$id_kategori_bahan?>"><?=$nama_kategori_bahan?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="tambah_bahan" value="Simpan">
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