<?php
    require 'includes/header.php';
    include 'includes/config.php';  
?>

<div class="container container-fluid-md">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-9 pt-4">
            <div class="card shadow p-5">           
                      <div class="row px-4">
                        <div class="col-lg-3">
                          <div class="row">
                            <div class="col-lg-12 col-sm-12 text-left" >
                              <strong>Detail Produk</strong>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-9">
                          <div class="row">
                            <div class="col-lg-8"></div>
                            <div class="col-lg-2 text-left">
                              <strong>Jumlah</strong>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-divider"></div>
                      <div class="row px-3">
                        <div class="col-lg-2">
                          <div class="row">
                            <div class="col-lg-9 col-sm-3 text-center my-auto">
                              <img src="http://placehold.it/80x80" class="rounded">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-10">
                          <div class="row">
                            <div class="col-lg-8 col-sm-5 text-left justify-content-start">
                              <a href="#"><strong class="text-info">Kalender Duduk A5 7 Lembar ART CARTON 250gr</strong></a>
                              <div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                              </div>
                              <strong>Harga : Rp. 16.400</strong>
                            </div>  
                            <div class="col-lg-2 col-sm-2 text-center my-auto">
                              <input type="text" name="quantity" class="form-control input-number text-center" value="1" disabled>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-divider mb-0"></div>
                      <div class="dropdown-divider my-0"></div>
                      <div class="row px-3 py-2">
                        <div class="col-lg-9 col-sm-9 text-right">
                          <strong>Sub Total :</strong>
                        </div>
                        <div class="col-lg-3 text-right">
                          <strong>Rp. 820.000,00</strong>
                        </div>
                      </div>
                      <p class="pt-3 font-m-semi">Pilih Bank :</p>
                      <div id="select_bank" class="">
                      <?php
                          $i = 1;
                          $result = mysqli_query($con, "select * from rekening_bank");
                              while($data_rekening = mysqli_fetch_assoc($result)){
                                  $id_rekening = $data_rekening['ID_REKENING'];
                                  $nama_rekening = $data_rekening['NAMA_REKENING'];
                                  $nomer_rekening = $data_rekening['NOMER_REKENING'];
                                  echo '<div class="custom-control custom-radio custom-control-inline mb-3 pl-5">
                                  <input type="radio" aria-describedby="'.$nomer_rekening.'" id="pilihbank'.$i.'" name="pilihwarna" value="'.$id_rekening.'" class="custom-control-input" required>
                                  <label class="custom-control-label" for="pilihbank'.$i.'">'.$nama_rekening.'</label>
                                  <input type="hidden" id="">
                                  </div>';
                                  $i+=1;
                          }   
                      ?>
                      </div>
                      </div>
            <div class="pt-5 mb-4">
                <div class="card shadow col-lg p-5 bg-light text-dark">
                    <div class="font-m-semi">
                        <h6>Langkah-Langkah Pembayaran Secara Online</h6>
                    </div>
                <p>1. Cek kembali pesanan<br>- Silahkan lengkapi data di atas, dengan memilih salah satu warna, bahan, dan ukuran. kemudian upload desain kamu jika ada. input jumlah cetak yang diinginkan.</br></p>
                <p>2. Pilih bank<br>- Pastikan data yang telah dipilih sudah benar, dan cek kembali desain yang telah anda upload.</br></p>
                <p>3. Transfer ke nomer rekening yang tertera<br>- Silahkan pilih salah metode pembayaran Uang muka atau Lunas, jika masih ingin ada yang ingin dicetak silahkan klik tombol "Keranjang", jika ingin langsung membayar silahkan klik "Bayar".</br></p>
                <p>4. Upload bukti pembayaran<br>- Tunggu notifikasi dari kami jika ada kesalahan atau pemberitahuan tentang pesanan anda.</br></p>
                <p>5. Diambil atau Dikirim<br>- Setelah selesai pembayaran produksi barang akan diproses jika sudah selesai bisa diambil langsung ke percetakan atau bisa juga kita kirim melalui beberapa kurir yang sudah bekerja sama dengan kami diantaranya.</br></p>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="src/js/main.js"></script>

<?php

    require 'includes/footer.php';

?>