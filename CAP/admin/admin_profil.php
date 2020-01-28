<?php
session_start();
if($_SESSION['admin_status']==2){
  header("location:index.php");
}
$_SESSION['active_link'] = 'setting';
require 'includes/config.php';
require 'includes/header.php';


$id_admin = $data_admin['ADM_ID'];
$nama_admin = $data_admin['ADM_NAMA_USAHA_ADM'];
$email_admin = $data_admin['ADM_EMAIL'];
$no_hp = $data_admin['ADM_NO_HP'];
$no_telp = $data_admin['ADM_NO_TELP'];
$alamat = $data_admin['ADM_ALAMAT'];
$adm_profil = $data_admin['ADM_PROFIL'];
$adm_cover = $data_admin['ADM_COVER'];
$desc = $data_admin['ADM_DESC'];
$adm_status = $data_admin['ADM_STATUS'];


?>


<div class="container container-fluid-md pb-4">
<div class="w-100 justify-content-center">
<?php
if(isset($_GET['pesan'])){
  if($_GET['pesan']=='gagal_upload'){
      echo '<div id="alert-login" class="alert alert-danger text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
              Upload Foto Anda <strong>Gagal!</strong> 
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
  }else if($_GET['pesan']=='gagal_update'){
    echo '<div id="alert-login" class="alert alert-danger text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
              Ekstensi File yang anda masukkan <strong>Salah!</strong> 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  }else if($_GET['pesan']=='sukses_upload'){
      echo '<div id="alert-login" class="alert alert-success text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
              Anda <strong>Berhasil!</strong> mengunggah foto!.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  }else if($_GET['pesan']=='sukses_update'){
    echo '<div id="alert-login" class="alert alert-success text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
            Anda <strong>Berhasil!</strong> mengunggah foto!.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
  }
}
?>
</div>

<!-- Cover -->
      <div class="cover">
          <form action="update_cover_admin.php" method="POST" enctype="multipart/form-data">
              <img src="../pictures/admin_cover/<?=$adm_cover?>" alt="background" class="w-100 img-fluid bg-dark" style="height: 450px;">
              
              <div class="btn-absolute">   
                  <a class="btn btn-light text-dark px-2" data-toggle="modal" data-target="#Modal-Cover" role="button"><i class="fa fa-edit"></i></a>   
              </div> 
          </form>
      </div> 

      <!-- Foto -->
      <div class="foto position-relative ">
          <form action="update_fotoprofil_admin.php" method="POST" enctype="multipart/form-data">
              <img src="../pictures/admin_profile/<?=$adm_profil?>" class="img-fluid bg-dark shadow" alt="foto">
              <div class="btn-foto">   
                  <a class="btn btn-light text-dark px-1" data-toggle="modal" data-target="#Modal-foto-profil" role="button"><i class="fa fa-edit"></i></a>   
              </div> 
          </form>
      </div>

<!-- form untuk edit -->
<form action="update_admin.php" method="POST">
        <div class="form-row mt-3">
          <input type="hidden" name="id_admin" id="id_admin" value="<?= $id_admin?>">
            <div class="form-group col-md-6">
              <label for="inputName">Nama Usaha</label>
              <input type="text" name="nama_admin" class="form-control" id="inputName" placeholder="Nama Lengkap" value="<?= $nama_admin?>" required pattern="^[A-Za-z -.]+$" title="Mohon masukkan hanya huruf">
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Email</label>
              <input type="email" name="email_admin" class="form-control" id="inputEmail4" placeholder="xxxx@email.com" value="<?= $email_admin?>" required title="Mohon masukkan Email Valid">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Nomor HP</label>
            <input type="text" name="no_hp" class="form-control" id="inputAddress" placeholder="+68" value="<?= $no_hp?>" required pattern="[0-9]{9,13}" title="Mohon masukkan hanya angka, 9 - 13 digit">
        </div>
        <div class="form-group">
            <label for="inputAddress">Nomor Telephone</label>
            <input type="text" name="no_telp" class="form-control" id="inputAddress" placeholder="(0331)" value="<?= $no_telp?>" required pattern="[0-9 ()]{12,13}" title="Mohon masukkan hanya angka dan ( ), 12 - 13 digit">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Alamat</label>
            <textarea name="alamat" class="form-control" id="inputAddress2" minlength=20 title="Mohon masukkan lebih dari 20 character" required><?= $alamat?></textarea>
        </div>
        <div class="form-group">
          <label for="inputCity">Deskripsi</label>
          <textarea name="adm_desc" class="form-control" id="inputCity" value="<?=$desc?>" minlength=100 title="Mohon masukkan lebih dari 100 character" required><?=$desc?></textarea>
        </div>
        <div class="form-group">
          <label for="inputCity">Username</label>
          <input type="text" name="adminname" class="form-control w-50" id="inputCity" value="<?=$username?>" required pattern="^[A-Za-z0-9 @_.]+$" title="Username Format: huruf, angka, ._@">
        </div>
          <div class="form-group">
          <span class="badge badge-<?php if($adm_status == 1 ){echo "success";}else{echo "primary";}?> p-2"><?php if($adm_status == 1 ){echo "Super Admin";}else{echo "Admin";}?></span>
        </div>
        <div class="text-right">
        <input type="submit" value="Simpan" name="edit_profil_admin" class="btn btn-primary w-25">
        </div>
      </form>

<!-- Modal Cover -->
<div class="modal fade" id="Modal-Cover" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Cover</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
        <img src="../pictures/admin_cover/<?=$adm_cover?>" width="460" height="200" class="rounded mx-auto d-block m-3">
        <p>Format file .jpg/.png/.jpeg</p> <p>Ukuran Maksimum 3mb</p>
        
          <form action="update_cover_admin.php" method="POST" enctype="multipart/form-data">
              <div class="input-group mb-3">
              <input type="hidden" name="id_admin" value="<?=$id_admin?>">
                  <input type="file" id="inputGroupFile02" name="file">
              </div>
              <br>
              <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
              <input type="submit"  class="btn btn-primary" name="post_cover_admin" value="Upload">
              </div>
          </form>    
        </div>  
        
    </div>
  </div>
</div>

<!-- Modal Foto -->
<div class="modal fade" id="Modal-foto-profil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
        <img src="../pictures/admin_profile/<?=$adm_profil?>" width="200" class="rounded mx-auto d-block m-3">
        <p>Format file .jpg/.png/.jpeg</p> <p>Ukuran Maksimum 3mb</p>
        
          <form action="update_fotoprofil_admin.php" method="POST" enctype="multipart/form-data">
              <div class="input-group mb-3">
                  <input type="hidden" name="id_admin" value="<?=$id_admin?>">
                  <input type="file" id="inputGroupFile02" name="file">
              </div>
              <br>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                <input type="submit"  class="btn btn-primary" name="post_foto_admin" value="Upload">
              </div>
          </form>    
        </div>  
    </div>
  </div>
</div>
</div>

<?php require 'includes/footer.php'; ?>