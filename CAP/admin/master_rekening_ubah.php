<?php
session_start();
$_SESSION['active_link'] = 'master';

include 'includes/config.php';
include 'includes/header.php';
if(!isset($_SESSION['admin_login'])){
  header("location:index.php");
}

if(isset($_GET['id_rekening'])){
  $id_rekening = $_GET['id_rekening'];

  $data = mysqli_query($con, "SELECT * FROM rekening_bank WHERE ID_REKENING='$id_rekening'");
  $data_rekening = mysqli_fetch_assoc($data);
  $id_rekening = $data_rekening['ID_REKENING'];
  $nama_rek = $data_rekening['NAMA_REKENING'];
  $no_rek = $data_rekening['NOMOR_REKENING'];
  $stat_rek = $data_rekening['STATUS_REKENING'];
  $atas_nama = $data_rekening['ATAS_NAMA'];
}

?>

<div class="container my-4">
    <div class="title text-center">
    <h2>Ubah Data Rekening Bank</h2>
    </div>
    <div class="row justify-content-center">
      <div class="col-6">
        <form class="font-m-light" action="query/master_rekening_query.php" method="post">
          <input type="hidden" name="id_rekening" id="id" value="<?=$id_rekening?>">
          <div class="form-group">
            <label for="nama_rek">Nama Rekening</label>
            <input type="text" name="nama_rek" class="form-control" placeholder="Masukkan Nama Rekening" value="<?=$nama_rek?>" required>
          </div>
          <div class="form-group">
            <label for="no_rek">Nomor Rekening</label>
            <input type="text" name="no_rek" class="form-control" placeholder="Masukkan Nomor Rekening" value="<?=$no_rek?>" required>
          </div>
          <div class="form-group">
            <label for="atas_nama">Atas Nama</label>
            <input type="text" name="atas_nama" class="form-control" placeholder="Masukkan Nama Rekening" value="<?=$atas_nama?>" required>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="radio" id="status_radio1" name="stat_rek" value="1" <?php if($stat_rek==1){echo "checked";}?>>
              <label class="form-check-label" for="status_radio1">
                Aktif
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="status_radio2" name="stat_rek" value="0" <?php if($stat_rek==0){echo "checked";}?>>
              <label class="form-check-label" for="status_radio2">
                Tidak Aktif
              </label>
            </div>
          </div>
          <div class="text-left">
            <input type="submit" class="btn btn-primary" name="edit_rekening" value="Simpan">
            <a href="master_rekening.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
          </div>
        </div>
      </form>
    </div>
  </div>

<?php
  require 'includes/footer.php';
?>
