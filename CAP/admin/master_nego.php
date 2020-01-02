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
    $result = mysqli_query($con, "SELECT * FROM nego ORDER BY NEGO_TGL DESC");
?>

<!-- Begin Page Content -->
<div class="container-fluid">
<?php
if(isset($_GET['pesan'])){
  if($_GET['pesan']=='sukses_delete'){
      echo '<div id="alert-login" class="alert alert-success text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
              Anda <strong>Berhasil!</strong> menghapus data!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  }else if($_GET['pesan']=='gagal_delete'){
    echo '<div id="alert-login" class="alert alert-danger text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
            Anda <strong>Gagal!</strong> menghapus data! 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
            
  }else if($_GET['pesan']=='sukses_insert'){
    echo '<div id="alert-login" class="alert alert-success text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
            Anda <strong>Berhasil!</strong> menambahkan data! 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  }else if($_GET['pesan']=='gagal_insert'){
    echo '<div id="alert-login" class="alert alert-danger text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
            Anda <strong>Gagal!</strong> menambahkan data! 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  }else if($_GET['pesan']=='gagal_edit'){
    echo '<div id="alert-login" class="alert alert-danger text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
            Anda <strong>Gagal!</strong> mengubah data!.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
  }else if($_GET['pesan']=='sukses_edit'){
    echo '<div id="alert-login" class="alert alert-success text-center alert-dismissible fade show position-absolute alert-login mx-auto" role="alert" style="left:35%; right:17%; z-index: 99;">
            Anda <strong>Berhasil!</strong> mengubah data!.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
  }
}
?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-2">
    <h3 class="mt-2 font-weight-bold float-left text-primary">Daftar Tabel Nego</h3>
  </div>
  <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Tgl Nego</th>
                    <th>Harga Awal</th>
                    <th>Harga Nego</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=0;
                while($data_nego = mysqli_fetch_assoc($result)){
                $i+=1;
                $id_nego = $data_nego['ID_NEGO'];
                $produk = $data_nego['NAMA_PRODUK'];
                $tgl_nego = $data_nego['NEGO_TGL'];
                $harga_produk = $data_nego['SUB_TOTAL'];
                $harga_nego = $data_nego['NEGO_HARGA'];
                $status_nego = $data_nego['NEGO_STATUS'];
                ?>
                <tr>
                    <td class="text-center" style="width:40px;"><?=$i?></td>
                    <td><?=$produk?></td>
                    <td><?=$tgl_nego?></td>
                    <td>Rp. <?=number_format($harga_produk, 0,".",".")?></td>
                    <td>Rp. <?=number_format($harga_nego, 0,".",".")?></td>
                    <td class="text-center">
                      <?php if($status_nego==1){
                        echo '<span class="badge badge-pill badge-danger px-3">Belum Terverifikasi</span>';
                      }else if($status_nego==2){
                        echo '<span class="badge badge-pill badge-success px-3">Terverifikasi</span>';
                      }else{
                        echo '<span class="badge badge-pill badge-secondary px-3">Kadaluarsa</span>';
                      }?>
                    </td>
                    <td style="width:67px">
                        <div class="block">
                            <a href="query/master_nego_query.php?action=delete&id_nego=<?=$id_nego?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href="master_nego_detail.php?id_nego=<?=$id_nego?>" class="btn btn-primary btn-circle btn-sm">
                              <i class="fas fa-info"></i>
                            </a>
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