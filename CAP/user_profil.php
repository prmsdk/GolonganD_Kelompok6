<!-- Header -->
<?php
require 'includes/config.php';
require 'includes/header.php';

if (isset($_SESSION['id_user'])){
  $id_user = $_SESSION['id_user'];
  $query = mysqli_query ($con, "SELECT * FROM user  WHERE USER_ID = '$id_user'");
  // var_dump($query);
  $result = mysqli_fetch_assoc($query);
  $nama_user = $result['USER_NAMA_LENGKAP'];
  $email_user = $result['USER_EMAIL'];
  $no_hp = $result['USER_NO_HP'];
  $alamat = $result['USER_ALAMAT'];
  $profil = $result['USER_PROFIL'];
  $cover = $result['USER_COVER'];
  $username = $result['USER_USERNAME'];
  $active = $result["USER_ACTIVE"];
}
?>

<div class="container container-fluid-md pb-4">
<div class="w-100 justify-content-center">
<?php
if(isset($_GET['pesan'])){
  if($_GET['pesan']=='gagal_upload'){
      echo '<div id="alert-login" class="alert alert-danger text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert">
              Upload Foto Anda <strong>Gagal!</strong> 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  }else if($_GET['pesan']=='ukuran_besar'){
    echo '<div id="alert-login" class="alert alert-danger text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert">
              Ukuran Foto Anda <strong>Terlalu Besar!</strong> 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
            
  }else if($_GET['pesan']=='ekstensi_salah'){
    echo '<div id="alert-login" class="alert alert-danger text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert">
              Ekstensi File yang anda masukkan <strong>Salah!</strong> 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  }else if($_GET['pesan']=='gagal_update'){
    echo '<div id="alert-login" class="alert alert-danger text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert">
              Ekstensi File yang anda masukkan <strong>Salah!</strong> 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  }else if($_GET['pesan']=='sukses_upload'){
      echo '<div id="alert-login" class="alert alert-success text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert">
              Anda <strong>Berhasil!</strong> mengunggah foto!.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  }else if($_GET['pesan']=='sukses_update'){
    echo '<div id="alert-login" class="alert alert-success text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert">
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
          <form action="update_cover_user.php" method="POST" enctype="multipart/form-data">
              <img src="pictures/user_cover/<?=$cover?>" alt="background" class="w-100" style="height: 450px;">
              <div class="btn-absolute">   
                  <a class="btn btn-light px-2" data-toggle="modal" data-target="#Modal-Cover" role="button"><i class="fa fa-edit"></i></a>   
              </div> 
          </form>
      </div> 

      <!-- Foto -->
      <div class="foto position-relative ">
          <form action="update_fotoprofil_user.php" method="POST" enctype="multipart/form-data">
              <img src="pictures/user_profile/<?=$profil?>" class="img-fluid" alt="foto">
              <div class="btn-foto">   
                  <a class="btn btn-light px-1" data-toggle="modal" data-target="#Modal-foto-profil" role="button"><i class="fa fa-edit"></i></a>   
              </div> 
          </form>
      </div>

      <!-- Form untuk Edit -->
      <form action="update_profil.php" method="post"> 
        <div class="form-row mt-4">
          <input type="hidden" name="id_user" id="id_user" value="<?=$id_user?>">
            <div class="form-group col-md-6">
              <label for="inputName">Nama Lengkap</label>
              <input type="text" name="nama_user" class="form-control" id="inputName" placeholder="Nama Lengkap" value="<?= $nama_user?>" required pattern="^[A-Za-z -.]+$" title="Mohon masukkan hanya huruf">
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Email</label>
              <input type="email" name="email_user" class="form-control" id="inputEmail4" placeholder="xxxx@email.com" value="<?= $email_user?>" required title="Mohon masukkan Email Valid">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Nomor HP</label>
            <input type="text" name="no_hp" class="form-control" id="inputAddress" placeholder="+68" value="<?= $no_hp?>" required pattern="[0-9]{9,13}" title="Mohon masukkan hanya angka, 9 - 13 digit">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Alamat</label>
            <textarea name="alamat" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" required minlength=20 title="Mohon masukkan lebih dari 20 character"><?= $alamat?></textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity">Username</label>
              <input type="text" name="username" class="form-control" id="inputCity" value="<?=$username?>" required pattern="^(?=.*[@])[A-Za-z0-9 @_.]+$" title="Username Format: huruf, angka, ._ dan harus menyertakan @">
            </div>
        </div> 
        <div class="form-group d-inline">
          <span class="badge badge-<?php if($active == 1 ){echo "success";}else{echo "danger";}?> p-2"><?php if($active == 1 ){echo "Active";}else{echo "Not Active";}?></span>
        </div>
        <?php if($active == 0){ ?>
          <a href="register_activation.php" class="btn btn-primary btn-sm py-1 px-3">Aktikasi akun</a>
        <?php } ?>
        <div class="text-right">
        <input type="submit" value="Simpan" name="edit_profil_user" class="btn btn-primary w-25">
        </div>
      </form>
</div>





<!-- Modal untuk Foto Profil -->
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
        <img src="pictures/user_profile/<?=$profil?>" width="200" accept=".jpg, .png, .jpeg" class="rounded mx-auto d-block m-3">
        <p>Format file .jpg/.png/.jpeg</p> <p>Ukuran Maksimum 3mb</p>
        
          <form action="update_fotoprofil_user.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" class="mb-3" name="id_user" value="<?=$id_user?>">
              <input type="file" class="mb-3" id="inputGroupFile02" name="file">
              <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
              <input type="submit"  class="btn btn-primary" name="post_profile" value="Upload">
              </div>
          </form>    
        </div>  
    </div>
  </div>
</div>

<!-- Modal untuk Cover -->
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
        <img src="pictures/user_cover/<?=$cover?>" width="450" height="200" accept=".jpg, .jpeg, .png" class="rounded mx-auto d-block m-3">
        <p>Format file .jpg/.png/.jpeg</p> <p>Ukuran Maksimum 3mb</p>
        
          <form action="update_cover_user.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id_user" value="<?=$id_user?>">
                  
                  <input type="file" class="mb-3" id="inputGroupFile02" name="file">
                  <!-- <div class="modal-footer">
                  </div> -->
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                <input type="submit"  class="btn btn-primary" name="post_cover" value="Upload">
              </div>
          </form>    
        </div>          
    </div>
  </div>
</div>

<!-- Footer -->
<?php
require 'includes/footer.php';
?>