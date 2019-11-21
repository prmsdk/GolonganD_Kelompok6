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

  //SELECT ADMIN
  $result = mysqli_query($con, "SELECT * FROM admin");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-2">
    <h3 class="mt-2 font-weight-bold float-left text-primary">Tabel Daftar Admin</h3>
    <button class="mt-2 btn btn-primary float-right ml-auto" data-toggle="modal" data-target="#tambah_admin">Tambah Data</button>
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
            <th>No Telp</th>
            <th>Alamat</th>
            <th>Username</th>
            <th>Status</th>
            <th width="100px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0;
            while($data_admin = mysqli_fetch_assoc($result)){
            $id_admin = $data_admin['ADM_ID'];
            $nama_admin = $data_admin['ADM_NAMA_USAHA_ADM']; 
            $email_admin = $data_admin['ADM_EMAIL'];
            $no_hp = $data_admin['ADM_NO_HP'];
            $no_telp = $data_admin['ADM_NO_TELP'];
            $alamat_admin = $data_admin['ADM_ALAMAT'];
            $username_admin = $data_admin['ADM_USERNAME'];
            $status_admin = $data_admin['ADM_STATUS'];
            $i+=1;
          ?>
          <tr>
            <td class="text-center"><?=$i?></td>
            <td ><p style="width: 200px;"><?=$nama_admin?></p></td>
            <td><?=$email_admin?></td>
            <td><p style="width: 120px;"><?=$no_telp?></p></td>
            <td><p style="width: 120px;"><?=$no_hp?></p></td>
            <td><p style="width: 200px;"><?=$alamat_admin?></p></td>
            <td><?=$username_admin?></td>
            <td class="text-center"><?php if($status_admin==1){
              echo '<span class="badge badge-pill badge-primary px-3">Super</span>';
            }else{
              echo '<span class="badge badge-pill badge-success px-3">Admin</span>';
            }?></td>
            <td>
              <div class="block" style="width:65px;">
                <a href="query/master_admin_query.php?action=delete&id_admin=<?=$id_admin?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                  <i class="fas fa-trash"></i>
                </a>
                <a href="master_admin_ubah.php?id_admin=<?=$id_admin?>" class="btn btn-primary btn-circle btn-sm">
                  <i class="fas fa-pencil-alt"></i>
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

</div>
<!-- End of Main Content -->

<!-- Modal Tambah -->
<div class="login-bg">
    <div class="row">
      <div class="col-5">
        <div class="modal fade" id="tambah_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-biru-tua">
                    <h5 class="modal-title text-light font-m-bold ml-3" id="editLabel">Tambah Data Admin</h5>
                    <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row justify-content-center">
                  <form class="font-m-light col-11 mt-3" action="query/master_admin_query.php" method="post">
                    <div class="form-group">
                      <label for="nama_admin" class="font-m-med">Nama</label>
                      <input type="text" class="form-control" id="nama_admin" name="nama_admin" aria-describedby="usernameHelp" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                      <label for="email_admin" class="font-m-med">Email</label>
                      <input type="email" class="form-control" id="email_admin" name="email_admin" aria-describedby="usernameHelp" placeholder="Masukkan Email" required>
                    </div>
                    <div class="form-group">
                      <label for="no_telp_admin" class="font-m-med">Nomor Telepon</label>
                      <input type="text" class="form-control" id="no_telp_admin" name="no_telp_admin" aria-describedby="usernameHelp" placeholder="(0331) xxx">
                    </div>
                    <div class="form-group">
                      <label for="no_hp_admin" class="font-m-med">Nomor Handphone</label>
                      <input type="text" class="form-control" id="no_hp_admin" name="no_hp_admin" aria-describedby="usernameHelp" placeholder="08xx" onkeypress='validate(event)' required>
                    </div>
                    <div class="form-group">
                      <label for="alamat_admin" class="font-m-med">Alamat</label>
                      <textarea name="alamat_admin" id="alamat_admin" class="form-control" placeholder="Alamat..." required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="username_admin" class="font-m-med">Username</label>
                      <input type="text" class="form-control" id="username_admin" name="username_admin" aria-describedby="usernameHelp" placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-group">
                      <label for="password_admin" class="font-m-med">Password</label>
                      <input type="password" class="form-control" id="password_admin" name="password_admin" aria-describedby="usernameHelp" placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="status_radio1" name="status_admin" value="1" <?php if($status_admin==1){echo "checked";}?>>
                        <label class="form-check-label" for="status_radio1">
                          Super Admin
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="status_radio2" name="status_admin" value="2" <?php if($status_admin==2){echo "checked";}?>>
                        <label class="form-check-label" for="status_radio2">
                          Admin
                        </label>
                      </div>
                    </div>
                  </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="tambah_admin" value="Simpan">
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