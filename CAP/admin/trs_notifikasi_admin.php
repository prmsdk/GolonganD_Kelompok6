<?php
    session_start();
    if($_SESSION['admin_status']==2){
      header("location:index.php");
    }

    $_SESSION['active_link'] = 'pemesanan';
    include 'includes/config.php';
    include 'includes/header.php';

    if(!isset($_SESSION['admin_login'])){
        header("location:index.php");
    }

    //SELECT KATEGORI BAHAN
    $result = mysqli_query($con, "SELECT DISTINCT user.USER_NAMA_LENGKAP, pesanan.ID_PESANAN, pesanan.TANGGAL_PESANAN, produk.NAMA_PRODUK, pesanan.ADMIN_NOTIF FROM user, pesanan, detail_pesanan, produk WHERE
    pesanan.USER_ID = user.USER_ID AND
    pesanan.ID_PESANAN = detail_pesanan.ID_PESANAN AND
    detail_pesanan.ID_PRODUK = produk.ID_PRODUK
    GROUP BY ID_PESANAN
    ORDER BY pesanan.TANGGAL_PESANAN DESC");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-2">
    <h3 class="mt-2 font-weight-bold float-left text-primary">Notifikasi Anda</h3>
    <a class="mt-2 mr-2 btn btn-biru float-right ml-auto" href="query/mark_all_notif.php">Tandai Semua Sudah Dibaca</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Nama User</th>
                    <th>Nama Produk</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i =0;
                while($data_notif = mysqli_fetch_assoc($result)){
                $id_psn = $data_notif['ID_PESANAN'];
                $tgl_psn = $data_notif['TANGGAL_PESANAN'];
                $nama_user = $data_notif['USER_NAMA_LENGKAP'];
                $nama_produk = $data_notif['NAMA_PRODUK'];
                $status_notif = $data_notif['ADMIN_NOTIF'];
                $i+=1;
                ?>
                <tr>
                    <td class="text-center" style="width:100px;"><?=$i?></td>
                    <td><?=$id_psn?></td>
                    <td><?=$tgl_psn?></td>
                    <td><?=$nama_user?></td>
                    <td><?=$nama_produk?></td>
                    <td class="text-center"><?php if($status_notif==0){
                      echo '<span class="badge badge-pill badge-primary px-3">Belum Dibaca</span>';
                    }else{
                      echo '<span class="badge badge-pill badge-success px-3">Sudah Dibaca</span>';
                    }?></td>
                    <td style="width:80px">
                        <div class="block">
                          <a href="trs_detail_pesanan_admin.php?id_pesanan=<?=$id_psn?>" class="btn btn-info btn-rounded w-50 btn-sm">
                            <i class="fas fa-info"></i>
                          </a>
                          <?php
                          if($status_notif==0){
                          ?>
                            <a href="query/mark_all_notif.php?id_pesanan=<?=$id_psn?>&action=sudah" class="btn btn-biru btn-rounded  btn-sm" onclick="return confirm('Tandai sudah dibaca?');">
                                <i class="fas fa-check"></i>
                            </a>
                          <?php
                          }else{
                          ?>
                            <a href="query/mark_all_notif.php?id_pesanan=<?=$id_psn?>&action=belum" class="btn btn-danger btn-rounded  btn-sm" onclick="return confirm('Tandai belum dibaca?');">
                                <i class="fas fa-check"></i>
                            </a>
                          <?php
                          }
                          ?>
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

<?php
  require 'includes/footer.php';
?>