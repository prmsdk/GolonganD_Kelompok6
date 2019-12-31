<?php
    session_start();

    $_SESSION['active_link'] = 'master';
    include 'includes/config.php';
    include 'includes/header.php';

    if(!isset($_SESSION['admin_login'])){
        header("location:index.php");
    }

    //SELECT KATEGORI BAHAN
    $result = mysqli_query($con, "SELECT * FROM satuan_bahan");
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
    <h3 class="mt-2 font-weight-bold float-left text-primary">Daftar Tabel Satuan Bahan</h3>
    <button class="mt-2 btn btn-primary float-right" data-toggle="modal" data-target="#tambah_satuan_bahan">Tambah Data</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Satuan Bahan</th>
                    <th>Jumlah Satuan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i =0;
                while($data_satuan_bahan = mysqli_fetch_assoc($result)){
                $id_satuan_bahan = $data_satuan_bahan['ID_SATUAN'];
                $nama_satuan_bahan =$data_satuan_bahan['SATUAN'];
                $jumlah_satuan_bahan = $data_satuan_bahan['JUMLAH_SATUAN'];
                $i+=1;
                ?>
                <tr>
                    <td class="text-center" style="width:100px;"><?=$i?></td>
                    <td><?=$nama_satuan_bahan?></td>
                    <td><?=number_format($jumlah_satuan_bahan, 0,".",".")?></td>
                    <td style="width:100px">
                        <div class="block">
                            <a href="query/master_satuan_query.php?action=delete&id_satuan_bahan=<?=$id_satuan_bahan?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href="master_satuan_ubah.php?id_satuan_bahan=<?=$id_satuan_bahan?>" class="btn btn-primary btn-circle btn-sm">
                              <i class="fas fa-pencil-alt"></i>
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
      <div class="modal fade" id="tambah_satuan_bahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-biru-tua">
                <h5 class="modal-title text-light font-m-bold ml-3" id="editLabel">Tambah Data Satuan Bahan</h5>
                <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body justify-content-center">
              <form action="query/master_satuan_query.php" method="POST">
                <div class="form-group">
                  <label>Nama Satuan</label>
                  <input type="text" name="nama_satuan" class="form-control" placeholder="Masukkan Nama Satuan" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" required>
                </div>
                <div class="form-group">
                  <label>Jumlah Satuan</label>
                  <input type="number" min="1" name="jumlah_satuan" class="form-control" placeholder="Masukkan Jumlah Satuan" required>
                </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="tambah_satuan" value="Simpan">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Tambah -->


<?php
  require 'includes/footer.php';
?>