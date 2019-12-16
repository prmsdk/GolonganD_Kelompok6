<?php
    session_start();

    $_SESSION['active_link'] = 'master';
    include 'includes/config.php';
    include 'includes/header.php';

    if(!isset($_SESSION['admin_login'])){
        header_remove();
        header("location:index.php");
    }

    //SELECT KATEGORI UKURAN
    $result = mysqli_query($con, "SELECT * FROM gambar_produk, tampil_produk WHERE gambar_produk.ID_TAMPIL_PRODUK = tampil_produk.ID_TAMPIL_PRODUK");
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
    <h3 class="mt-2 font-weight-bold float-left text-primary">Daftar Gambar Produk</h3>
    <button class="mt-2 btn btn-primary float-right" data-toggle="modal" data-target="#tambah_gambar_produk">Tambah Data</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Gambar Produk</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i =0;
                while($data_gambar = mysqli_fetch_assoc($result)){
                $id_gambar = $data_gambar['GBR_ID'];
                $nama_gambar =$data_gambar['GBR_FILE_NAME'];
                $nama_produk =$data_gambar['NAMA_TAMPIL_PRODUK'];
                $i+=1;
                ?>
                <tr>
                    <td class="text-center" style="width:100px;"><?=$i?></td>
                    <td class="text-center"><p><?=$nama_produk?></p></td>
                    <td class="text-center"><img width="250" class="img-fluid" src="../pictures/produk_thumb/<?=$nama_gambar?>" alt="<?=$nama_gambar?>"></td>
                    <td style="width:100px">
                        <div class="block">
                            <a href="query/master_produk_gambar_query.php?action=delete&id_produk_gambar=<?=$id_gambar?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href="master_produk_gambar_ubah.php?id_produk_gambar=<?=$id_gambar?>" class="btn btn-primary btn-circle btn-sm">
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
        <div class="modal fade" id="tambah_gambar_produk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-biru-tua">
                    <h5 class="modal-title text-light font-m-bold ml-3" id="editLabel">Tambah Gambar Produk</h5>
                    <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body justify-content-center">
                <form class="font-m-light" action="query/master_produk_gambar_query.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="id_produk">Pilih Produk</label>
                    <select class="form-control w-75" id="id_produk" name="id_produk">
                      <?php 
                        $data = mysqli_query($con, "SELECT * FROM tampil_produk");
                        while($data_produk = mysqli_fetch_assoc($data)){
                        $id_prd = $data_produk['ID_TAMPIL_PRODUK'];
                        $nama_prd = $data_produk['NAMA_TAMPIL_PRODUK'];
                      ?>
                      <option value="<?=$id_prd?>"><?=$nama_prd?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="gambar_produk" class="font-m-med">Gambar</label>
                    <br>
                    <input type="file" name="gambar_produk" id="gambar_produk" accept=".jpg, .png, .jpeg" required>
                  </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="tambah_gambar_produk" value="Simpan">
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