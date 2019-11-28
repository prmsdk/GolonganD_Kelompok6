<?php
session_start();
require 'includes/config.php';
require 'includes/header.php';

<<<<<<< HEAD:CAP/admin_profil.php
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
=======
>>>>>>> a0ec809b93ade203809fa4f0a0087a582c1653ce:CAP/admin/admin_profil.php

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

<body>
<div class="container container-fluid-md pb-4">
<!-- Cover -->
      <div class="cover">
          <form action="update_cover_admin.php" method="POST" enctype="multipart/form-data">
<<<<<<< HEAD:CAP/admin_profil.php
              <img src="file_upload/<?=$adm_cover?>" alt="background" height="600">
=======
              <img src="img/profil/<?=$adm_cover?>" alt="background" class="w-100" style="height: 450px;">
>>>>>>> a0ec809b93ade203809fa4f0a0087a582c1653ce:CAP/admin/admin_profil.php
              <div class="btn-absolute">   
                  <a class="btn btn-light text-dark px-2" data-toggle="modal" data-target="#Modal-Cover" role="button"><i class="fa fa-edit"></i></a>   
              </div> 
          </form>
      </div> 

      <!-- Foto -->
      <div class="foto position-relative ">
          <form action="update_fotoprofil_admin.php" method="POST" enctype="multipart/form-data">
              <img src="img/profil/<?=$adm_profil?>" class="img-fluid" alt="foto">
              <div class="btn-foto">   
                  <a class="btn btn-light text-dark px-1" data-toggle="modal" data-target="#Modal-foto-profil" role="button"><i class="fa fa-edit"></i></a>   
              </div> 
          </form>
      </div>

<!-- form untuk edit -->
<<<<<<< HEAD:CAP/admin_profil.php
    <form action="admin_profil.php" method="post"> 
        <div class="form-row">
          <input type="hidden" name="id_admin" id="id_admin" value="<?=$id_admin?>">
            <div class="form-group col-md-6">
              <label for="inputName">Nama Usaha</label>
              <input type="text" name="nama_admin" class="form-control" id="inputName" placeholder="Nama Usaha" value="<?= $nama_admin?>">
=======
<form action="update_admin.php" method="POST">
        <div class="form-row mt-3">
          <input type="hidden" name="id_admin" id="id_admin" value="<?= $id_admin?>">
            <div class="form-group col-md-6">
              <label for="inputName">Nama Usaha</label>
              <input type="text" name="nama_admin" class="form-control" id="inputName" placeholder="Nama Lengkap" value="<?= $nama_admin?>" required pattern="^[A-Za-z -.]+$" title="Mohon masukkan hanya huruf">
>>>>>>> a0ec809b93ade203809fa4f0a0087a582c1653ce:CAP/admin/admin_profil.php
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Email</label>
              <input type="email" name="email_admin" class="form-control" id="inputEmail4" placeholder="xxxx@email.com" value="<?= $email_admin?>" required title="Mohon masukkan Email Valid">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Nomor HP</label>
<<<<<<< HEAD:CAP/admin_profil.php
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
=======
            <input type="text" name="no_hp" class="form-control" id="inputAddress" placeholder="+68" value="<?= $no_hp?>" required pattern="[0-9]{9,13}" title="Mohon masukkan hanya angka, 9 - 13 digit">
        </div>
        <div class="form-group">
            <label for="inputAddress">Nomor Telephone</label>
            <input type="text" name="no_hp" class="form-control" id="inputAddress" placeholder="(0331)" value="<?= $no_telp?>" required pattern="[0-9 ()]{12,13}" title="Mohon masukkan hanya angka dan ( ), 12 - 13 digit">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Alamat</label>
            <textarea name="alamat" class="form-control" id="inputAddress2" minlength=20 title="Mohon masukkan lebih dari 20 character" value="<?= $alamat?>" required></textarea>
        </div>
        <div class="form-group">
          <label for="inputCity">Deskripsi</label>
          <textarea name="adm_desc" class="form-control" id="inputCity" value="<?=$desc?>" minlength=100 title="Mohon masukkan lebih dari 100 character" required></textarea>
        </div>
        <div class="form-group">
          <label for="inputCity">Username</label>
          <input type="text" name="adminname" class="form-control w-50" id="inputCity" value="<?=$username?>" required pattern="^[A-Za-z0-9 @_.]+$" title="Username Format: huruf, angka, ._@">
        </div>
          <div class="form-group">
          <span class="badge badge-<?php if($adm_status == 1 ){echo "success";}else{echo "primary";}?> p-2"><?php if($adm_status == 1 ){echo "Super Admin";}else{echo "Admin";}?></span>
>>>>>>> a0ec809b93ade203809fa4f0a0087a582c1653ce:CAP/admin/admin_profil.php
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
        <img src="img/profil/<?=$adm_cover?>" width="460" height="200" class="rounded mx-auto d-block m-3">
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
        <img src="img/profil/<?=$adm_profil?>" width="200" class="rounded mx-auto d-block m-3">
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