<?php
    session_start();
    if($_SESSION['admin_status']==2){
      header("location:index.php");
    }

    $_SESSION['active_link'] = 'setting';
    include 'includes/config.php';
    include 'includes/header.php';

    if(!isset($_SESSION['admin_login'])){
        header("location:index.php");
    }

    //SELECT KATEGORI BAHAN
    $result = mysqli_query($con, "SELECT * FROM slider");
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
    <h3 class="mt-2 font-weight-bold float-left text-primary">Daftar Tabel Slider</h3>
    <button class="mt-2 btn btn-primary float-right" data-toggle="modal" data-target="#tambah_slider">Tambah Data</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tombol</th>
                    <th>Link</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i =0;
                while($data_slider = mysqli_fetch_assoc($result)){
                $id_slider = $data_slider['ID_SLIDER'];
                $tombol = $data_slider['TOMBOL'];
                $link = $data_slider['LINK'];
                $desc = $data_slider['DESKRIPSI'];
                $gambar = $data_slider['GAMBAR'];
                $i+=1;
                ?>
                <tr>
                    <td class="text-center" style="width:30px;"><?=$i?></td>
                    <td><p><?=$tombol?></p></td>
                    <td><p><?=$link?></p></td>
                    <td><p><?=$desc?></p></td>
                    <td><p><img src="../src/img/slider/<?=$gambar?>" class="img-fluid" alt="Gambar <?=$id_slider?>"></p></td>
                    <td style="width:67px">
                        <div class="block">
                            <a href="query/master_slider_query.php?action=delete&id_slider=<?=$id_slider?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href="master_slider_ubah.php?id_slider=<?=$id_slider?>" class="btn btn-primary btn-circle btn-sm">
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
      <div class="modal fade" id="tambah_slider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-biru-tua">
                <h5 class="modal-title text-light font-m-bold ml-3" id="editLabel">Tambah Data Slider</h5>
                <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body justify-content-center">
              <form action="query/master_slider_query.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Tombol</label>
                  <input type="text" name="tombol" class="form-control" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" placeholder="Masukkan Tombol" required>
                </div>
                <div class="form-group">
                  <label>Link</label>
                  <input type="text" name="link" class="form-control" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" placeholder="Masukkan link" required>
                </div>
                <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea type="text" name="deskripsi" class="form-control" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" minlenght="10" placeholder="Masukkan deskripsi" required></textarea>
                  <label>Tuliskan &lt;br&gt; untuk Enter</label>
                </div>
                <div class="form-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="gambar" name="gambar" accept=".jpeg, .jpg, .png" required>
                    <label class="custom-file-label" for="inputGroupFile01">Pilih file</label>
                    <label for="uploadfile">Unggah file anda dalam format .jpg .jpeg .png <br> (max ukuran file 3mb)</label>
                  </div>
                </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="tambah_slider" value="Simpan">
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