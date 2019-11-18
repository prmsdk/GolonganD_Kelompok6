<?php
    session_start();

    $_SESSION['active_link'] = 'master';
    include 'includes/config.php';
    include 'includes/header.php';

    if(!isset($_SESSION['admin_login'])){
        header_remove();
        header("location:index.php");
    }

    //SELECT KATEGORI UKURAN
    $result = mysqli_query($con, "SELECT * FROM kategori_ukuran");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-2">
    <h3 class="mt-2 font-weight-bold float-left text-primary">Daftar Tabel Kategori Ukuran</h3>
    <button class="mt-2 btn btn-primary float-right" data-toggle="modal" data-target="#tambah_kategori_ukuran">Tambah Data</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori Ukuran</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i =0;
                while($data_kategori_ukuran = mysqli_fect_assoc($result)){
                $id_kategori_ukuran = $data_kategori_ukuran['ID_KATEGORI'];
                $nama_kategori_ukuran =$data_kategori_ukuran['NAMA_KAT_UKURAN'];
                $i+=1;
                ?>
                <tr>
                    <td class="text-center" style="width:100px;"><?=$i?></td>
                    <td><p><?=$nama_kategori_ukuran?></p></td>
                    <td style="width:100px">
                        <div class="block">
                            <a href="query/master_kategori_ukuran.php?action=delete&id_kategori_ukuran=<?=id_kategori_ukuran?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                                <i class="fas fas-trash"></i>
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

<!-- Modal Tambah -->
<div class="login-bg">
    <div class="row">
      <div class="col-5">
        <div class="modal fade" id="tambah_kategori_ukuran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-biru-tua">
                    <h5 class="modal-title text-light font-m-bold ml-3" id="editLabel">Tambah Data Admin</h5>
                    <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row justify-content-center">
                  <form action="query/master_kategori_ukuran_query.php" method="POST">
                    <div class="form-group">
                      <label>Nama Kategori</label>
                      <input type="text" name="nama_kategori" class="form-control" placeholder="Masukkan Nama Kategori" required>
                    </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="tambah_kategori_ukuran" value="Upload">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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