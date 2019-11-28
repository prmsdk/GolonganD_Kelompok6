<?php
  session_start();

  $_SESSION['active_link'] = 'master';
  include 'includes/config.php';
  include 'includes/header.php';
  if(!isset($_SESSION['admin_login'])){
    header("location:index.php");
  }

  //SELECT BAHAN
  $result = mysqli_query($con, "SELECT * FROM bahan, kategori_bahan, satuan_bahan 
  WHERE bahan.ID_KAT_bahan = kategori_bahan.ID_KAT_bahan AND
  bahan.ID_SATUAN = satuan_bahan.ID_SATUAN");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-2">
    <h3 class="mt-2 font-weight-bold float-left text-primary">Tabel Daftar Bahan</h3>
    <button class="mt-2 btn btn-primary float-right ml-auto" data-toggle="modal" data-target="#tambah_bahan">Tambah Data</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Bahan</th>
            <th>Satuan Bahan</th>
            <th>Jumlah Satuan</th>
            <th>Isi Perbahan</th>
            <th>Harga Bahan</th>
            <th>Kategori</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0;
            while($data_bahan = mysqli_fetch_assoc($result)){
            $id_bahan = $data_bahan['ID_BAHAN'];
            $nama_bahan = $data_bahan['NAMA_BAHAN']; 
            $satuan_bahan = $data_bahan['SATUAN'];
            $jumlah_satuan = $data_bahan['JUMLAH_SATUAN'];
            $isi_bahan = $data_bahan['ISI_PER_BAHAN'];
            $harga_bahan = $data_bahan['HARGA_BAHAN'];
            $kategori_bahan = $data_bahan['NAMA_KAT_BAHAN'];
            $i+=1;
          ?>
          <tr>
            <td class="text-center" style="width:50px"><?=$i?></td>
            <td><?=$nama_bahan?></td>
            <td><?=$satuan_bahan?></td>
            <td><?=$jumlah_satuan?></td>
            <td><?=$isi_bahan?></td>
            <td>Rp. <?=$harga_bahan?>,00</td>
            <td><?=$kategori_bahan?></td>
            <td style="width:67px;">
              <div class="block ml-auto">
                <a href="query/master_bahan_query.php?action=delete&id_bahan=<?=$id_bahan?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                  <i class="fas fa-trash"></i>
                </a>
                <a href="master_bahan_ubah.php?id_bahan=<?=$id_bahan?>" class="btn btn-primary btn-circle btn-sm">
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
        <div class="modal fade" id="tambah_bahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-biru-tua">
                    <h5 class="modal-title text-light font-m-bold ml-3" id="editLabel">Tambah Data Bahan</h5>
                    <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row justify-content-center">
                  <form class="font-m-light col-11 mt-3" action="query/master_bahan_query.php" method="post">
                    <div class="form-group">
                      <label for="nama_bahan" class="font-m-med">Nama bahan</label>
                      <input type="text" class="form-control" id="nama_bahan" name="nama_bahan" aria-describedby="usernameHelp" placeholder="Masukkan Nama Bahan" required>
                    </div>
                    <div class="form-group">
                      <label for="satuan_bahan" class="font-m-med">Satuan bahan</label>
                      <input type="text" class="form-control" id="satuan_bahan" name="satuan_bahan" aria-describedby="usernameHelp" placeholder="Masukkan Satuan Bahan" required>
                    </div>
                    <div class="form-group">
                      <label for="jumlah_satuan" class="font-m-med">Jumlah Satuan</label>
                      <input type="text" class="form-control" id="jumlah_satuan" name="jumlah_satuan" aria-describedby="usernameHelp" placeholder="Masukkan Jumlah Satuan" required>
                    </div>
                    <div class="form-group">
                      <label for="isi_per_bahan" class="font-m-med">Isi per Bahan</label>
                      <input type="text" class="form-control" id="isi_per_bahan" name="isi_per_bahan" aria-describedby="usernameHelp" placeholder="Masukkan Isi per Bahan" required>
                    </div>
                    <div class="form-group">
                      <label for="harga_bahan" class="font-m-med">Harga bahan</label>
                      <input type="text" class="form-control" id="harga_bahan" name="harga_bahan" aria-describedby="usernameHelp" placeholder="Masukkan Harga bahan" required>
                    </div>
                    <div class="form-group">
                      <label for="kategori_bahan">Kategori bahan</label>
                      <select class="form-control" id="kategori_bahan" name="kategori_bahan">
                        <?php 
                          $data = mysqli_query($con, "SELECT * FROM kategori_bahan");
                          while($data_kat_bahan = mysqli_fetch_assoc($data)){
                          $id_kategori_bahan = $data_kat_bahan['ID_KAT_BAHAN'];
                          $nama_kategori_bahan = $data_kat_bahan['NAMA_KAT_BAHAN'];
                        ?>
                        <option value="<?=$id_kategori_bahan?>"><?=$nama_kategori_bahan?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="tambah_bahan" value="Simpan">
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