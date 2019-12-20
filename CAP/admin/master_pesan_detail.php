<?php
  session_start();

  $_SESSION['active_link'] = 'master';
  include 'includes/config.php';
  include 'includes/header.php';
  if(!isset($_SESSION['admin_login'])){
    header("location:index.php");
  }

  if(isset($_GET['ID_MSG'])){
  $id_msg = $_GET['ID_MSG'];
  $result_msg = mysqli_query($con, "SELECT * FROM messages WHERE ID_MSG='$id_msg'");
  $data_msg = mysqli_fetch_assoc($result_msg);
  $nama_msg = $data_msg['MSG_NAMA'];
  $email_msg = $data_msg['MSG_EMAIL'];
  $no_hp_msg = $data_msg['MSG_NO_HP'];
  $subject_msg = $data_msg['MSG_SUBJECT'];
  $messages = $data_msg['MSG_MESSAGE'];
  $tgl_msg = $data_msg['MSG_TGL'];

  $update_msg = mysqli_query($con, "UPDATE messages SET MSG_STATUS = 1 WHERE ID_MSG='$id_msg'");
  }else{
    header("location:index.php");
  }
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card shadow mb-4">
        <div class="card-header py-2 text-center">
          <h3 class="mt-2 font-weight-bold text-primary">Pesan</h3>
        </div>
        <div class="card-body px-4">
          <label class="small"><?=$tgl_msg?></label>
          <dl class="row">
            <dt class="col-sm-2">Nama</dt>
            <dt class="col-sm-1 text-right">:</dt>
            <dd class="col-sm-9"><?=$nama_msg?></dd>

            <dt class="col-sm-2">Email</dt>
            <dt class="col-sm-1 text-right">:</dt>
            <dd class="col-sm-9"><?=$email_msg?></dd>

            <dt class="col-sm-2">Nomor HP</dt>
            <dt class="col-sm-1 text-right">:</dt>
            <dd class="col-sm-9"><?=$no_hp_msg?></dd>

            <dt class="col-sm-2">Subject</dt>
            <dt class="col-sm-1 text-right">:</dt>
            <dd class="col-sm-9"><?=$subject_msg?></dd>

            <dt class="col-sm-2">Message</dt>
            <dt class="col-sm-1 text-right">:</dt>
            <dd class="col-sm-9"><?=$messages?></dd>
            </dd>
          </dl>
          <div class="text-right">
          <a href="master_pesan.php" class="btn btn-secondary px-2">Tutup</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Page Content -->

<?php
include 'includes/footer.php';
?>