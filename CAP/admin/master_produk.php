<?php
  session_start();

  $_SESSION['active_link'] = 'master';
  include 'includes/config.php';
  include 'includes/header.php';
  if(!isset($_SESSION['admin_login'])){
    header("location:index.php");
  }

  //SELECT PRODUK
  $result = mysqli_query($con, "SELECT * FROM tampil_produk, kategori_produk 
  WHERE tampil_produk.ID_KATEGORI = kategori_produk.ID_KATEGORI");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-2">
    <h3 class="mt-2 font-weight-bold float-left text-primary">Tabel Daftar Produk</h3>
    <a class="mt-2 btn btn-primary float-right ml-auto" href="master_produk_tambah.php">Tambah Data</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Produk</th>
            <th>Desc Produk</th>
            <th>Ket Harga</th>
            <th>Nama Kategori</th>
            <th>Detail</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0;
            while($data_produk = mysqli_fetch_assoc($result)){
            $id_produk = $data_produk['ID_TAMPIL_PRODUK'];
            $nama_produk = $data_produk['NAMA_TAMPIL_PRODUK']; 
            $desc_produk = $data_produk['DESC_TAMPIL_PRODUK'];
            $ket_produk = $data_produk['KET_TAMPIL_PRODUK'];
            $status_produk = $data_produk['STATUS_TAMPIL_PRODUK'];
            $kategori_produk = $data_produk['NAMA_KAT_PRODUK'];
            $i+=1;
          ?>
          <tr>
            <td class="text-center" style="width:50px"><?=$i?></td>
            <td><?=$nama_produk?></td>
            <td class="text-justify"><?=$desc_produk?></td>
            <td><?=$ket_produk?></td>
            <td><?=$kategori_produk?></td>
            <td class="text-center">
              <a href="master_produk_detail.php?id_produk=<?=$id_produk?>" class="btn btn-success btn-circle btn-sm">
                <i class="fas fa-info-circle"></i>
              </a>
              <?php if($status_produk == 1){ echo
              '<span href="" class="btn btn-success btn-circle btn-sm">
                <i class="fas fa-check"></i>
              </span>';
              }else if($status_produk == 0){ echo
                '<span href="" class="btn btn-danger btn-circle btn-sm">
                  <i class="fas fa-times"></i>
                </span>';
              } ?>
            </td>
            <td style="width:67px;">
              <div class="block ml-auto">
                <a href="query/master_produk_query.php?action=delete&id_produk=<?=$id_produk?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">
                  <i class="fas fa-trash"></i>
                </a>
                <a href="master_produk_ubah.php?id_produk=<?=$id_produk?>" class="btn btn-primary btn-circle btn-sm">
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
        <div class="modal fade" id="tambah_produk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-biru-tua">
                    <h5 class="modal-title text-light font-m-bold ml-3" id="editLabel">Tambah Data produk</h5>
                    <button type="button" class="close btn bg-biru-tua" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row justify-content-center">
                  <form class="font-m-light col-11 mt-3" action="query/master_produk_query.php" method="post">
                    <div class="form-group">
                      <label for="nama_produk" class="font-m-med">Nama produk</label>
                      <input type="text" class="form-control" id="nama_produk" name="nama_produk" aria-describedby="usernameHelp" placeholder="Masukkan Nama produk" required>
                    </div>
                    <div class="form-group">
                      <label for="desc_produk" class="font-m-med">Deskripsi produk</label>
                      <textarea name="alamat_admin" id="alamat_admin" class="form-control" placeholder="Masukkan Deskripsi Produk . ." required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="ket_produk" class="font-m-med">Keterangan Harga</label>
                      <input type="text" class="form-control" id="ket_produk" name="ket_produk" aria-describedby="usernameHelp" placeholder="Masukkan Ket produk" required>
                    </div>
                    <div class="form-group">
                      <label for="kategori_produk">Kategori Produk</label>
                      <select class="form-control" id="kategori_produk" name="kategori_produk">
                        <?php 
                          $data = mysqli_query($con, "SELECT * FROM kategori_produk");
                          while($data_kat_produk = mysqli_fetch_assoc($data)){
                          $id_kategori_produk = $data_kat_produk['ID_KATEGORI'];
                          $nama_kategori_produk = $data_kat_produk['NAMA_KAT_PRODUK'];
                        ?>
                        <option value="<?=$id_kategori_produk?>"><?=$nama_kategori_produk?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-primary" name="tambah_produk" value="Simpan">
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