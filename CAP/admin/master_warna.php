<?php
    session_start();
    if($_SESSION['admin_status']==2){
        header("location:index.php");
    }

    $_SESSION['active_link']= 'master';
    include 'includes/config.php';
    include 'includes/header.php';
    if(!isset($_SESSION['admin_login'])){
        header_remove();
        header("location:index.php");
    }

    //SELECT WARNA
    $result = mysqli_query($con, "SELECT * FROM user");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-2">
    <h3 class="mt-2 font-weight-bold float-left text-primary">Warna</h3>
    <button class="mt-2 btn btn-primary float-right ml-auto" data-toggle="modal" data-target="#tambah_user">Tambah Data</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Jenis Warna</th>
            <th width="100px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0;
            while($data_warna = mysqli_fetch_assoc($result)){
            $id_warna = $data_warna['warna_ID'];
            $i+=1;
          ?>
          <tr>
            <td class="text-center"><?=$i?></td>
            <td ><p style="width: 200px;"><?=$jenis_warna?></p></td>
              echo '<span class="badge badge-pill badge-danger px-3">Tidak Aktif</span>';
            }else{
              echo '<span class="badge badge-pill badge-success px-3">Aktif</span>';
            }?></td>
            <td>
              <div class="block" style="width:65px;">
                <a href="master_warna_ubah.php?id_warna=<?=$id_warna?>" class="btn btn-primary btn-circle btn-sm">
                  <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="query/master_warna_query.php?action=delete&id_warna=<?=$id_warna?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
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
        <div class="modal fade" id="tambah_warna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-biru-tua">
                    <h5 class="modal-title text-light font-m-bold ml-3" id="editLabel">Tambah Data warna</h5>
                    <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row justify-content-center">
                  <form class="font-m-light col-11 mt-3" action="query/master_warna_query.php" method="post">
                    <div class="form-group">
                      <label for="nama_warna" class="font-m-med">Nama</label>
                      <input type="text" class="form-control" id="nama_warna" name="nama_warna" aria-describedby="warnanameHelp" placeholder="Masukkan Nama" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="warnaname_warna" class="font-m-semi">warnaname</label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">@</div>
                        </div>
                        <input type="text" class="form-control" id="warnaname_warna" name="warnaname_warna" placeholder="Isikan warnaname" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password_warna" class="font-m-med">Password</label>
                      <input type="password" class="form-control" id="password_warna" name="password_warna" aria-describedby="warnanameHelp" placeholder="Masukkan warnaname" required>
                    </div>
                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="status_radio1" name="status_warna" value="1">
                        <label class="form-check-label" for="status_radio1">
                          Aktif
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="status_radio2" name="status_warna" value="0">
                        <label class="form-check-label" for="status_radio2">
                          Tidak Aktif
                        </label>
                      </div>
                    </div>
                  </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="tambah_warna" value="Simpan">
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