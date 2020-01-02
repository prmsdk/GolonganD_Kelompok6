<?php
session_start();

$_SESSION['active_link'] = 'master';

include 'includes/config.php';
include 'includes/header.php';
if(!isset($_SESSION['admin_login'])){
  header("location:index.php");
}

if(isset($_GET['id_produk'])){
  $id_produk = $_GET['id_produk'];

  $result_produk = mysqli_query($con, "SELECT * FROM tampil_produk, kategori_produk
  WHERE tampil_produk.ID_KATEGORI = kategori_produk.ID_KATEGORI AND
  tampil_produk.ID_TAMPIL_PRODUK = '$id_produk'
  ");

  while($select_produk = mysqli_fetch_assoc($result_produk)){
    $nama_produk = $select_produk['NAMA_TAMPIL_PRODUK'];
    $desc_produk = $select_produk['DESC_TAMPIL_PRODUK'];
    $ket_produk = $select_produk['KET_TAMPIL_PRODUK'];
    $status_produk = $select_produk['STATUS_TAMPIL_PRODUK'];
    $isi_produk = $select_produk['STATUS_ISI'];
    $isi_custom = $select_produk['BATAS_ISI'];
    $min_pemesanan = $select_produk['MIN_JUMLAH'];
    $kat_produk = $select_produk['ID_KATEGORI'];
  }

}
?>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow mb-4">
        <div class="card-header py-2 text-center">
          <h3 class="mt-2 font-weight-bold text-primary">Ubah Data Produk</h3>
        </div>

<!-- INI SELECT TAMPIL PRODUK PRODUK PRODUK -->

        <div class="card-body">
          <form action="query/master_produk_query.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_produk" id="id_produk" value="<?=$id_produk?>">
          <div class="form-group">
            <label for="nama_produk" class="font-m-med">Nama produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" aria-describedby="usernameHelp" placeholder="Masukkan Nama produk" pattern="[^() /><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" value="<?=$nama_produk?>" required>
            <label for="nama_produk" class="small text-muted">Tulis nama produk tanpa Spasi</label>
          </div>
          <div class="form-group">
            <label for="desc_produk" class="font-m-med">Deskripsi produk</label>
            <textarea name="desc_produk" id="desc_produk" class="form-control" pattern="[^()/><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" minlenght="50" placeholder="Masukkan Deskripsi Produk . ." required><?=$desc_produk?></textarea>
          </div>
          <div class="form-group text-center">
            <div><label for="ket_produk" class="font-m-med">Keterangan Harga</label></div>
            <div class="mt-2 mb-3 overflow-auto"><?php include "../src/file/$ket_produk";?></div>
            <input accept=".htm" type="file" id="ket_produk" name="ket_produk">
          </div>

          <div id="select_isi" class="">
            <div class="form-group">
              <label for="kategori_produk">Isi Produk</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="isi_produk1" name="isi_produk" value="0" required <?php if($isi_produk==0){echo "checked";}?>>
                <label class="form-check-label" for="isi_produk1">
                  Tidak Butuh Isi
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="isi_produk2" name="isi_produk" value="1" required <?php if($isi_produk==1){echo "checked";}?>>
                <label class="form-check-label" for="isi_produk2">
                  Butuh Isi Custom
                </label>
              </div>
            </div>
            <div id="1" class="box_isi">
              <div class="form-group">
                <label for="isi_custom" class="font-m-med">Batas Isi produk</label>
                <input type="text" class="form-control w-75" id="isi_custom" name="isi_custom" placeholder="Isikan syarat pengisian pengguna terhadap isi produk" pattern="[^()><\][\\\x22,;|]+" title="Tidak boleh memasukkan simbol karakter" value="<?=$isi_custom?>">
                <label class="small text-muted">Contoh : 1/2/3/6/12</label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="min_pemesanan" class="font-m-med">Minimum Pemesanan</label>
            <input type="number" min="1" class="form-control w-75" id="min_pemesanan" name="min_pemesanan" value="<?=$min_pemesanan?>" placeholder="Masukkan minimum pemesanan produk" required>
          </div>

          <div class="form-group">
            <label for="kategori_produk">Kategori Produk</label>
            <select class="form-control w-50" id="kategori_produk" name="kategori_produk">
              <?php 
                $data = mysqli_query($con, "SELECT ID_KATEGORI, NAMA_KAT_PRODUK FROM kategori_produk");
                while($data_kat_produk = mysqli_fetch_assoc($data)){
                $id_kategori_produk = $data_kat_produk['ID_KATEGORI'];
                $nama_kategori_produk = $data_kat_produk['NAMA_KAT_PRODUK'];
              ?>
              <option value="<?=$id_kategori_produk?>" <?php if($id_kategori_produk==$kat_produk){echo "selected";}?>><?=$nama_kategori_produk?></option>
              <?php } ?>
            </select>
          </div>

<!-- INI SELECT WARNA WARNA WARNA WARNA -->

          <div class="form-group">
            <h5 class="pt-1" for="warna">Warna</h5>
            <hr>

            <?php
              $i=0; $j=0; $k=0;
              $result_warna = mysqli_query($con, "SELECT * FROM warna");
              while($data_warna = mysqli_fetch_assoc($result_warna)){
                $id_warna = $data_warna['ID_WARNA'];
                $jenis_warna = $data_warna['JENIS_WARNA'];
                $k = $i%2;
                if($k == 0){
            ?>
            <div class="row justify-content-arround px-5">
              <?php }?>

              <div class="custom-control custom-checkbox col-lg-6 px-0 mb-2">
                <input 
                <?php
                $ambil_warna = mysqli_query($con, "SELECT * FROM warna, tampil_warna, tampil_produk
                WHERE warna.ID_WARNA = tampil_warna.ID_WARNA AND
                tampil_warna.ID_TAMPIL_PRODUK = tampil_produk.ID_TAMPIL_PRODUK AND
                tampil_produk.ID_TAMPIL_PRODUK = '$id_produk' ");
                while($select_warna = mysqli_fetch_assoc($ambil_warna)){
                  $id_warna_select = $select_warna['ID_WARNA'];
                  if($id_warna == $id_warna_select){echo "checked";}
                }
                ?>
                type="checkbox" name="check_warna[]" value="<?=$id_warna?>" class="custom-control-input" id="check_warna_<?=$id_warna."_".$j?>">
                <label class="custom-control-label" for="check_warna_<?=$id_warna."_".$j?>"><?=$jenis_warna?></label>
              </div>

              <?php if($k == 1){?>
            </div>
            <?php }
              $i+=1;
              $j+=1;
              }
            ?>
          </div>

<!-- INI SELECT BAHAN BAHAN BAHAN BAHAN -->

          <div class="form-group">
            <h5 class="pt-1" for="bahan">Bahan</h5>
            <hr>

            <div>
              <select class="form-control w-50" id="select_bahan" name="select_bahan">
                <option>Pilih Kategori Bahan</option>
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

            <?php
            $data_bhn = mysqli_query($con, "SELECT * FROM kategori_bahan");
            while($data_kat_bhn = mysqli_fetch_assoc($data_bhn)){
            $id_kat_bhn = $data_kat_bhn['ID_KAT_BAHAN'];
            ?>

            <div id="<?=$id_kat_bhn?>" class="box_bahan py-3">
              <div class="row justify-content-arround px-5">
              <?php
                $result_bahan = mysqli_query($con, "SELECT * FROM bahan, kategori_bahan 
                WHERE bahan.ID_KAT_BAHAN = kategori_bahan.ID_KAT_BAHAN AND 
                bahan.ID_KAT_BAHAN = '$id_kat_bhn'");
                while($data_bahan = mysqli_fetch_assoc($result_bahan)){
                  $id_bahan = $data_bahan['ID_BAHAN'];
                  $nama_bahan = $data_bahan['NAMA_BAHAN'];
                  ?>
              
                <div class="custom-control custom-checkbox col-lg-5 px-4 mb-2">
                  <input 
                  <?php
                  $ambil_bahan = mysqli_query($con, "SELECT * FROM bahan, tampil_bahan, tampil_produk
                  WHERE bahan.ID_BAHAN = tampil_bahan.ID_BAHAN AND
                  tampil_bahan.ID_TAMPIL_PRODUK = tampil_produk.ID_TAMPIL_PRODUK AND
                  tampil_produk.ID_TAMPIL_PRODUK = '$id_produk' ");
                  while($select_bahan = mysqli_fetch_assoc($ambil_bahan)){
                    $id_bahan_select = $select_bahan['ID_BAHAN'];
                    if($id_bahan == $id_bahan_select){echo "checked";}
                  }
                  ?>
                  type="checkbox" name="check_bahan[]" value="<?=$id_bahan?>" class="custom-control-input" id="check_bahan_<?=$id_bahan."_".$j?>">
                  <label class="custom-control-label" for="check_bahan_<?=$id_bahan."_".$j?>"><?=$nama_bahan?></label>
                </div>

              <?php 
                }
              ?>
              </div>
            </div>
            <?php }?>
                
          </div> 

<!-- INI SELECT UKURAN UKURAN UKURAN -->
          
          <div class="form-group">
            <h5 class="pt-1" for="ukuran">Ukuran</h5>
            <hr>

            <div>
              <select class="form-control w-50" id="select_ukuran" name="select_ukuran">
                <option>Pilih Kategori ukuran</option>
                <?php 
                  $data = mysqli_query($con, "SELECT * FROM kategori_ukuran");
                  while($data_kat_ukuran = mysqli_fetch_assoc($data)){
                  $id_kategori_ukuran = $data_kat_ukuran['ID_KAT_UKURAN'];
                  $nama_kategori_ukuran = $data_kat_ukuran['NAMA_KAT_UKURAN'];
                ?>
                <option value="<?=$id_kategori_ukuran?>"><?=$nama_kategori_ukuran?></option>
                <?php } ?>
              </select>
            </div>

            <?php
            $data_bhn = mysqli_query($con, "SELECT * FROM kategori_ukuran");
            while($data_kat_bhn = mysqli_fetch_assoc($data_bhn)){
            $id_kat_bhn = $data_kat_bhn['ID_KAT_UKURAN'];
            ?>

            <div id="<?=$id_kat_bhn?>" class="box_ukuran py-3">
              <?php
                $result_ukuran = mysqli_query($con, "SELECT * FROM ukuran, kategori_ukuran 
                WHERE ukuran.ID_KAT_UKURAN = kategori_ukuran.ID_KAT_UKURAN AND 
                ukuran.ID_KAT_UKURAN = '$id_kat_bhn'");?>
                <div class="row justify-content-arround px-5">
                <?php
                while($data_ukuran = mysqli_fetch_assoc($result_ukuran)){
                  $id_ukuran = $data_ukuran['ID_UKURAN'];
                  $nama_ukuran = $data_ukuran['JENIS_UKURAN'];
                  ?>

                <div class="custom-control custom-checkbox col-lg-12 px-4 mb-2">
                  <input 
                  <?php
                  $ambil_ukuran = mysqli_query($con, "SELECT * FROM ukuran, tampil_ukuran, tampil_produk
                  WHERE ukuran.ID_UKURAN = tampil_ukuran.ID_UKURAN AND
                  tampil_ukuran.ID_TAMPIL_PRODUK = tampil_produk.ID_TAMPIL_PRODUK AND
                  tampil_produk.ID_TAMPIL_PRODUK = '$id_produk' ");
                  while($select_ukuran = mysqli_fetch_assoc($ambil_ukuran)){
                    $id_ukuran_select = $select_ukuran['ID_UKURAN'];
                    if($id_ukuran == $id_ukuran_select){echo "checked";}
                  }
                  ?>
                  type="checkbox" name="check_ukuran[]" value="<?=$id_ukuran?>" class="custom-control-input" id="check_ukuran_<?=$id_ukuran."_".$j?>">
                  <label class="custom-control-label" for="check_ukuran_<?=$id_ukuran."_".$j?>"><?=$nama_ukuran?></label>
                </div>

              <?php 
                }
              ?>
              </div>
            </div>
            <?php }?>
                
          </div> 
          
          <div class="form-group">
            <h5>Gambar Produk</h5>
            <div class="row">
            <?php
            $result_gambar = mysqli_query($con, "SELECT * FROM tampil_produk, gambar_produk
            WHERE tampil_produk.ID_TAMPIL_PRODUK = gambar_produk.ID_TAMPIL_PRODUK AND
            tampil_produk.ID_TAMPIL_PRODUK = '$id_produk'
            ");
          
            while($select_produk = mysqli_fetch_assoc($result_gambar)){
              $id_gambar = $select_produk['GBR_ID'];
              $gambar_produk = $select_produk['GBR_FILE_NAME'];
            ?>
            <div class="col-md-4">
              <img class="img-fluid my-2" src="../pictures/produk_thumb/<?=$gambar_produk?>" alt="gambar_<?=$id_gambar?>" srcset="">
            </div>
            <?php }?>
            </div>
            <div class=" mb-4 mt-2">
            <a href="master_produk_gambar.php" class="btn btn-primary">Ubah Gambar Produk</a>
            </div>
            <!-- <div class="my-2"><input accept=".jpg,.png,.jpeg" type="file" id="gambar_produk_1" name="gambar_produk[]"></div>
            <div class="my-2"><input accept=".jpg,.png,.jpeg" type="file" id="gambar_produk_2" name="gambar_produk[]"></div>
            <div class="my-2"><input accept=".jpg,.png,.jpeg" type="file" id="gambar_produk_3" name="gambar_produk[]"></div> -->
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="radio" id="status_radio1" name="status_produk" value="1" <?php if($status_produk==1){echo "checked";}?>>
              <label class="form-check-label" for="status_radio1">
                Produk Tersedia
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="status_radio2" name="status_produk" value="0" <?php if($status_produk==0){echo "checked";}?>>
              <label class="form-check-label" for="status_radio2">
                Produk Tidak Tersedia
              </label>
            </div>
          </div>
          <div class="form-group text-center">
            <a href="master_produk.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a>
            <input type="submit" name="edit_produk" class="btn btn-primary w-25" value="UBAH DATA">
          </div>
          </form>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require 'includes/footer.php';
?>