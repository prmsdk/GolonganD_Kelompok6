<?php
  session_start();
  if($_SESSION['admin_status']==2){
    header("location:index.php");
  }

  $_SESSION['active_link'] = 'master';
  include 'includes/config.php';
  include 'includes/header.php';
  if(!isset($_SESSION['admin_login'])){
    header_remove();
    header("location:index.php");
  }

  //SELECT USER
  $result = mysqli_query($con, "SELECT * FROM user");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-2">
    <h3 class="mt-2 font-weight-bold float-left text-primary">Tabel Daftar User</h3>
    <button class="mt-2 btn btn-primary float-right ml-auto" data-toggle="modal" data-target="#tambah_user">Tambah Data</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Username</th>
            <th>Status</th>
            <th width="100px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0;
            while($data_user = mysqli_fetch_assoc($result)){
            $id_user = $data_user['USER_ID'];
            $nama_user = $data_user['USER_NAMA_LENGKAP']; 
            $email_user = $data_user['USER_EMAIL'];
            $no_hp = $data_user['USER_NO_HP'];
            $alamat_user = $data_user['USER_ALAMAT'];
            $username_user = $data_user['USER_USERNAME'];
            $status_user = $data_user['USER_ACTIVE'];
            $i+=1;
          ?>
          <tr>
            <td class="text-center"><?=$i?></td>
            <td ><p style="width: 200px;"><?=$nama_user?></p></td>
            <td><?=$email_user?></td>
            <td><p style="width: 120px;"><?=$no_hp?></p></td>
            <td><p style="width: 200px;"><?=$alamat_user?></p></td>
            <td><?=$username_user?></td>
            <td class="text-center"><?php if($status_user==0){
              echo '<span class="badge badge-pill badge-danger px-3">Tidak Aktif</span>';
            }else{
              echo '<span class="badge badge-pill badge-success px-3">Aktif</span>';
            }?></td>
            <td>
              <div class="block" style="width:65px;">
                <a href="master_user_ubah.php?id_user=<?=$id_user?>" class="btn btn-primary btn-circle btn-sm">
                  <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="query/master_user_query.php?action=delete&id_user=<?=$id_user?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                  <i class="fas fa-trash"></i>
                </a>
              </div>
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

<div class="login-bg">
    <div class="row">
      <div class="col-5">
        <div class="modal fade" id="tambah_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-biru-tua">
                    <h5 class="modal-title text-light font-m-bold ml-3" id="editLabel">Tambah Data User</h5>
                    <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row justify-content-center">
                  <form class="font-m-light col-11 mt-3" action="query/master_user_query.php" method="post">
                    <div class="form-group">
                      <label for="nama_user" class="font-m-med">Nama</label>
                      <input type="text" class="form-control" id="nama_user" name="nama_user" aria-describedby="usernameHelp" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                      <label for="email_user" class="font-m-med">Email</label>
                      <input type="email" class="form-control" id="email_user" name="email_user" aria-describedby="usernameHelp" placeholder="Masukkan Email" required>
                    </div>
                    <div class="form-group">
                      <label for="no_hp_user" class="font-m-med">Nomor Handphone</label>
                      <input type="text" class="form-control" id="no_hp_user" name="no_hp_user" aria-describedby="usernameHelp" placeholder="08xx" onkeypress='validate(event)' required>
                    </div>
                    <div class="form-group">
                      <label for="alamat_user" class="font-m-med">Alamat</label>
                      <textarea name="alamat_user" id="alamat_user" class="form-control" placeholder="Alamat..." required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="username_user" class="font-m-semi">Username</label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">@</div>
                        </div>
                        <input type="text" class="form-control" id="username_user" name="username_user" placeholder="Isikan Username" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password_user" class="font-m-med">Password</label>
                      <input type="password" class="form-control" id="password_user" name="password_user" aria-describedby="usernameHelp" placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="status_radio1" name="status_user" value="1">
                        <label class="form-check-label" for="status_radio1">
                          Aktif
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="status_radio2" name="status_user" value="0">
                        <label class="form-check-label" for="status_radio2">
                          Tidak Aktif
                        </label>
                      </div>
                    </div>
                  </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="tambah_user" value="Simpan">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
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