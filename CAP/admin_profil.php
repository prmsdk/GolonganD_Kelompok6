<?php
require 'includes/header.php';
require 'includes/config.php';

  if (isset($_GET['id_admin'])){
  $id_admin = $_GET['id_admin'];
  $query = mysqli_query ($con, "SELECT * FROM admin WHERE ADM_ID = '$id_admin'");
  // var_dump($query);
  $result = mysqli_fetch_assoc($query);
  $nama_admin = $result['ADM_NAMA_USAHA_ADM'];
  $email_admin = $result['ADM_EMAIL'];
  $adm_no_hp = $result['ADM_NO_HP'];
  $adm_no_telp = $result['ADM_NO_TELP'];
  $adm_alamat = $result['ADM_ALAMAT'];
  $adm_profil = $result['ADM_PROFIL'];
  $adm_cover = $result['ADM_COVER'];
  $adm_desc = $result['ADM_DESC'];
  $adminname = $result['ADM_USERNAME'];
  $adm_status = $result["ADM_STATUS"];
}
?>

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
<div class="container container-fluid-md pb-4">
<!-- Cover -->
      <div class="cover">
          <form action="update_cover_admin.php" method="POST" enctype="multipart/form-data">
              <img src="file_upload/<?=$adm_cover?>" alt="background" height="600">
              <div class="btn-absolute">   
                  <a class="btn btn-primary px-2" data-toggle="modal" data-target="#Modal-Cover" role="button"><i class="fa fa-edit"></i></a>   
              </div> 
          </form>
      </div> 

      <!-- Foto -->
      <div class="foto position-relative ">
          <form action="update_fotoprofil_admin.php" method="POST" enctype="multipart/form-data">
              <img src="file_upload/<?=$adm_profil?>" class="img-fluid" alt="foto">
              <div class="btn-foto">   
                  <a class="btn btn-primary px-2" data-toggle="modal" data-target="#Modal-foto-profil" role="button"><i class="fa fa-edit"></i></a>   
              </div> 
          </form>
      </div>

<!-- form untuk edit -->
    <form action="admin_profil.php" method="post"> 
        <div class="form-row">
          <input type="hidden" name="id_admin" id="id_admin" value="<?=$id_admin?>">
            <div class="form-group col-md-6">
              <label for="inputName">Nama Usaha</label>
              <input type="text" name="nama_admin" class="form-control" id="inputName" placeholder="Nama Usaha" value="<?= $nama_admin?>">
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Email</label>
              <input type="email" name="email_admin" class="form-control" id="inputEmail4" placeholder="xxxx@email.com" value="<?= $email_admin?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Nomor HP</label>
            <input type="text" name="no_hp" class="form-control" id="inputAddress" placeholder="+68" value="<?= $adm_no_hp?>">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Alamat</label>
            <input type="text" name="alamat" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" value="<?= $adm_alamat?>">
        </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity">Deskripsi</label>
              <input type="text" name="adm_desc" class="form-control" id="inputCity" value="<?= $adm_desc?>">
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity">Admin Name</label>
              <input type="text" name="adminname" class="form-control" id="inputCity" value="<?= $adminname?>">
            </div>
        </div> 
        <div class="form-group">
          <span class="badge badge-<?php if($active == 1 ){echo "success";}else{echo "primary";}?> p-2"><?php if($active == 1 ){echo "Admin";}else{echo "Super Admin";}?></span>
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
        <img src="file_upload/<?=$adm_cover?>" width="460" height="200" class="rounded mx-auto d-block m-3">
        <p>Format file .jpg/.png/.jpeg</p> <p>Ukuran Maksimum 3mb</p>
        
          <form action="update_cover_admin.php" method="POST" enctype="multipart/form-data">
              <div class="input-group mb-3">
              <input type="hidden" name="id_admin" value="<?=$id_admin?>">
                  <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile02" name="file">
                  <label class="custom-file-label" for="inputGroupFile02"  aria-describedby="inputGroupFileAddon02" >Choose file</label>
                  <!-- <div class="modal-footer"> -->
                  </div>
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
        <img src="file_upload/<?=$adm_profil?>" width="200" class="rounded mx-auto d-block m-3">
        <p>Format file .jpg/.png/.jpeg</p> <p>Ukuran Maksimum 3mb</p>
        
          <form action="update_fotoprofil_admin.php" method="POST" enctype="multipart/form-data">
              <div class="input-group mb-3">
                  <input type="hidden" name="id_admin" value="<?=$id_admin?>">
                  <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile02" name="file">
                  <label class="custom-file-label" for="inputGroupFile02"  aria-describedby="inputGroupFileAddon02" >Choose file</label>
                  <!-- <div class="modal-footer"> -->
                  </div>
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

<?php require 'includes/footer.php'; ?>