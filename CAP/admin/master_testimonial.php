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
    $result = mysqli_query($con, "SELECT * FROM testimonial");
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
    echo '<div id="alert-login" class="alert alert-danger text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
            Anda <strong>Gagal!</strong> mengubah data!.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
  }else if($_GET['pesan']=='sukses_edit'){
    echo '<div id="alert-login" class="alert alert-success text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
            Anda <strong>Sukses!</strong> mengubah data!.
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
    <h3 class="mt-2 font-weight-bold float-left text-primary">Daftar Tabel Testimonial</h3>
    <button class="mt-2 btn btn-primary float-right" data-toggle="modal" data-target="#tambah_testimonial">Tambah Data</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Profesi</th>
                    <th style="width: 200px;">Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i =0;
                while($data_testimonial = mysqli_fetch_assoc($result)){
                $id_testimonial = $data_testimonial['ID_TESTI'];
                $nama = $data_testimonial['TESTI_NAMA'];
                $profesi = $data_testimonial['TESTI_PROFESI'];
                $deskripsi = $data_testimonial['TESTI_DESC'];
                $gambar = $data_testimonial['TESTI_FOTO'];
                $i+=1;
                ?>
                <tr>
                    <td class="text-center" style="width:40px;"><?=$i?>.</td>
                    <td><?=$nama?></td>
                    <td><?=$profesi?></td>
                    <td><p><?=$deskripsi?></p></td>
                    <td><img class="img-fluid rounded" src="../src/img/testimonial/<?=$gambar?>" alt=""></td>
                    <td style="width:67px">
                        <div class="block">
                            <a href="query/master_testimonial_query.php?action=delete&id_testimonial=<?=$id_testimonial?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href="master_testimonial_ubah.php?id_testimonial=<?=$id_testimonial?>" class="btn btn-primary btn-circle btn-sm">
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
    <div class="col-12">
      <div class="modal fade" id="tambah_testimonial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-biru-tua">
                <h5 class="modal-title text-light font-m-bold ml-3" id="editLabel">Tambah Data testimonial</h5>
                <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body justify-content-center">
              <form action="query/master_testimonial_query.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="nama" class="font-m-med">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" pattern="[^0-9()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" placeholder="Masukkan Nama" required>
                </div>
                <div class="form-group">
                  <label for="profesi" class="font-m-med">Profesi</label>
                  <input type="text" class="form-control" id="profesi" name="profesi" placeholder="Masukkan Profesi" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" required>
                </div>
                <div class="form-group">
                  <label for="deskripsi" class="font-m-med">Deskripsi</label>
                  <textarea type="text" class="form-control" id="deskripsi" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" minlenght="10" name="deskripsi" placeholder="Masukkan Deskripsi" required></textarea>
                </div>
                <div class="form-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="gambar" name="gambar" accept=".jpg, .png, .jpeg" required>
                    <label class="custom-file-label" for="inputGroupFile01">Ukuran gambar minimal 1170x500px</label>
                    <label for="uploadfile">Unggah file anda dalam format .jpg .jpeg .png <br> (max ukuran file 3 MB)</label>
                  </div>
                </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="tambah_testimonial" value="Simpan">
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