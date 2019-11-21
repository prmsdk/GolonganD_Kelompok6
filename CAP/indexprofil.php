<!-- Header -->
<?php
require 'includes/config.php';
require 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>CSS</title>
</head>

<body>
<div class="container container-fluid-md">
<!-- Cover -->
      <div class="cover">
          <form action="update_cover.php" method="POST" enctype="multipart/form-data">
              <img src="betak.jpg" alt="background">
              <div class="btn-absolute">   
                  <a class="btn btn-primary px-2" data-toggle="modal" data-target="#Modal-Cover" role="button"><i class="fa fa-edit"></i></a>   
              </div> 
          </form>
      </div> 

      <!-- Foto -->
      <div class="foto position-relative ">
          <form action="update_fotoprofil.php" method="POST" enctype="multipart/form-data">
              <img src="foto.jpg" class="img-fluid" alt="foto">
              <div class="btn-foto">   
                  <a class="btn btn-primary px-2" data-toggle="modal" data-target="#Modal-foto-profil" role="button"><i class="fa fa-edit"></i></a>   
              </div> 
          </form>
      </div>
      <form>
        <a href="select_profil2.php"><button type="button" class="btn btn-primary m-2">Edit Profil</button></a>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputName">Nama Lengkap</label>
              <input type="text" class="form-control" id="inputName" placeholder="Nama Lengkap">
            </div>
            <div class="form-group">
              <label for="inputEmail4">Email</label>
              <input type="email" class="form-control" id="inputEmail4" placeholder="xxxx@email.com">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Nomor HP</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="+68 ">
        </div>
         <div class="form-group">
            <label for="inputAddress">Nomor Telepon</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="+68 ">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Alamat</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity">Username</label>
              <input type="text" class="form-control" id="inputCity">
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