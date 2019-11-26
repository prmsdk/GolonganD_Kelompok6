<!-- Header -->
<?php
require 'includes/config.php';
require 'includes/header.php';

if(isset($_GET['id_user'])){
  $id_user = $_GET['id_user'];

  $result = mysqli_query($con, "SELECT * from user WHERE USER_ID = '$id_user'");

  $data_user = mysqli_fetch_assoc($result);

  $nama_user = $data_user['USER_NAMA_LENGKAP']; 
  $email_user = $data_user['USER_EMAIL'];
  $no_hp = $data_user['USER_NO_HP'];
  $alamat_user = $data_user['USER_ALAMAT'];
  $username_user = $data_user['USER_USERNAME'];
  $status_user = $data_user['USER_ACTIVE'];

  $profil_user = $data_user['USER_PROFIL'];
  $cover_user = $data_user['USER_COVER'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>CSS</title>
</head>

<body>
<div class="container container-fluid-md">
<!-- Cover -->
      <div class="cover">
          <form action="update_cover.php" method="POST" enctype="multipart/form-data">
              <img src="file_upload/<?=$cover_user?>" alt="background">
              <div class="btn-absolute">   
                  <a class="btn btn-primary px-2" data-toggle="modal" data-target="#Modal-Cover" role="button"><i class="fa fa-edit"></i></a>   
              </div> 
          </form>
      </div> 

      <!-- Foto -->
      <div class="foto position-relative ">
          <form action="update_fotoprofil.php" method="POST" enctype="multipart/form-data">
              <img src="file_upload/<?=$profil_user?>" class="img-fluid" alt="foto">
              <div class="btn-foto">   
                  <a class="btn btn-primary px-2" data-toggle="modal" data-target="#Modal-foto-profil" role="button"><i class="fa fa-edit"></i></a>   
              </div> 
          </form>
      </div>
      <form>
        <a href="select_profil2.php"><button type="button" class="btn btn-primary m-2">Edit Profil</button></a>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="user_nama">Nama Lengkap</label>
              <input type="text" class="form-control" id="user_nama" name="user_nama" value="<?=$nama_user?>" placeholder="Nama Lengkap">
            </div>
            <div class="form-group">
              <label for="user_email">Email</label>
              <input type="email" class="form-control" id="user_email" name="user_email" value="<?=$email_user?>" placeholder="xxxx@email.com">
            </div>
        </div>
        <div class="form-group">
            <label for="user_no_hp">Nomor HP</label>
            <input type="text" class="form-control" id="user_no_hp" name="user_no_hp" value="<?=$no_hp?>" placeholder="+68 ">
        </div>
        <div class="form-group">
            <label for="user_alamat">Alamat</label>
            <input type="text" class="form-control" id="user_alamat" name="user_alamat" value="<?=$alamat_user?>" placeholder="Apartment, studio, or floor">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="user_username">Username</label>
              <input type="text" class="form-control" id="user_username" user="user_username" value="<?=$username_user?>" >
            </div>
        </div>  
        <input type="submit" value="Save" class="btn btn-primary m-2">
    </form>
</div>


<!-- Footer -->
<?php
require 'includes/footer.php';
?>


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
        <img src="http://placehold.it/200x200" class="rounded mx-auto d-block m-3">
        <p>Format file .jpg/.png/.jpeg</p> <p>Ukuran Maksimum 3mb</p>
        
          <form action="update_fotoprofil.php" method="POST" enctype="multipart/form-data">
              <div class="input-group mb-3">
                  <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile02" name="file">
                  <label class="custom-file-label" for="inputGroupFile02"  aria-describedby="inputGroupFileAddon02" >Choose file</label>
                  <!-- <div class="modal-footer"> -->
                  </div>
              </div>
              <br>
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
        <img src="http://placehold.it/370x117" class="rounded mx-auto d-block m-3">
        <p>Format file .jpg/.png/.jpeg</p> <p>Ukuran Maksimum 3mb</p>
        
          <form action="update_cover.php" method="POST" enctype="multipart/form-data">
              <div class="input-group mb-3">
                  <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile02" name="file">
                  <label class="custom-file-label" for="inputGroupFile02"  aria-describedby="inputGroupFileAddon02" >Choose file</label>
                  <!-- <div class="modal-footer"> -->
                  </div>
              </div>
              <br>
              <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
              <input type="submit"  class="btn btn-primary" name="post_cover" value="Upload">
              </div>
          </form>    
        </div>  
        
    </div>
  </div>
</div>
</body>
</html>