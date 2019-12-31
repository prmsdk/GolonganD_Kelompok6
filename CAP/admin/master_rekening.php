<?php
    session_start();

    $_SESSION['active_link'] = 'master';
    include 'includes/config.php';
    include 'includes/header.php';

    if(!isset($_SESSION['admin_login'])){
        header("location:index.php");
    }

    //SELECT KATEGORI BAHAN
    $result = mysqli_query($con, "SELECT * FROM rekening_bank");
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
    <h3 class="mt-2 font-weight-bold float-left text-primary">Daftar Tabel Rekening Bank</h3>
    <button class="mt-2 btn btn-primary float-right" data-toggle="modal" data-target="#tambah_rekening_bank">Tambah Data</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Rekening</th>
                    <th>Nomor Rekening</th>
                    <th>Atas Nama</th>
                    <th>Status Rekening</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i =0;
                while($data_rekening_bank = mysqli_fetch_assoc($result)){
                $id_rekening = $data_rekening_bank['ID_REKENING'];
                $nama_rek = $data_rekening_bank['NAMA_REKENING'];
                $no_rek = $data_rekening_bank['NOMOR_REKENING'];
                $atas_nama = $data_rekening_bank['ATAS_NAMA'];
                $stat_rek = $data_rekening_bank['STATUS_REKENING'];
                $i+=1;
                ?>
                <tr>
                    <td class="text-center" style="width:30px;"><?=$i?></td>
                    <td><?=$nama_rek?></td>
                    <td><?=$no_rek?></td>
                    <td><?=$atas_nama?></td>
                    <td><?php if($stat_rek == 1){ echo
                    '<span href="" class="btn btn-success btn-circle btn-sm">
                      <i class="fas fa-check"></i>
                    </span>';
                    }else if($stat_rek == 0){ echo
                      '<span href="" class="btn btn-danger btn-circle btn-sm">
                        <i class="fas fa-times"></i>
                      </span>';
                    } ?></td>
                    <td style="width:67px">
                        <div class="block">
                            <a href="query/master_rekening_query.php?action=delete&id_rekening=<?=$id_rekening?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href="master_rekening_ubah.php?id_rekening=<?=$id_rekening?>" class="btn btn-primary btn-circle btn-sm">
                              <i class="fas fa-pencil-alt"></i>
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
      <div class="modal fade" id="tambah_rekening_bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-biru-tua">
                <h5 class="modal-title text-light font-m-bold ml-3" id="editLabel">Tambah Data Rekening Bank</h5>
                <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body justify-content-center">
              <form action="query/master_rekening_query.php" method="POST">
                <div class="form-group">
                  <label for="nama_rek">Nama Rekening</label>
                  <input type="text" name="nama_rek" class="form-control" placeholder="Masukkan Nama Rekening" required>
                </div>
                <div class="form-group">
                  <label for="no_rek">Nomor Rekening</label>
                  <input type="text" name="no_rek" class="form-control" placeholder="Masukkan Nomor Rekening" required>
                </div>
                <div class="form-group">
                  <label for="atas_nama">Atas Nama</label>
                  <input type="text" name="atas_nama" class="form-control" placeholder="Masukkan Atas Nama" required>
                </div>
                <div class="form-group">
                  <label for="status_rekening">Kategori Produk</label>
                  <select class="form-control w-50" id="status_rekening" name="status_rekening" required>
                    <option value="">Pilih Status Rekening</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                  </select>
                </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="tambah_rekening" value="Simpan">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Tambah -->


<?php
  require 'includes/footer.php';
?>