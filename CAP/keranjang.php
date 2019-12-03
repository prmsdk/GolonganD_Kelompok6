<?php
    require 'includes/header.php';
    include 'includes/config.php';
?>
<div class="container container-fluid-md">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-9 pt-4 mb-5">
            <div class="card shadow p-5">
                      <div class="row px-3 py-2">
                        <div class="col-lg-12 col-sm-12 col-12 border-bottom text-center border-warning font-m-semi">
                          <h2>Keranjang Pesanan</h2>
                        </div>
                      </div>
                      <div class="col-lg-5 mb-3 text-left custom-control-inline">
                        <input class="my-auto" type="checkbox" id="ceksemua" aria-label="Checkbox for following text input">
                        <p class="ml-4 my-auto">Pilih Semua</p>
                        <a href="#" class="ml-5 my-auto text-danger">Hapus</a>
                      </div>
                      <div class="dropdown-divider mt-0"></div>
                      <div class="row px-3">
                        <div class="col-lg-3">
                          <div class="row">
                            <div class="col-lg-10 col-sm-12 text-left">
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
                            <div class="col-lg-2 text-center">
                              <strong>Hapus</strong>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      <div class="dropdown-divider"></div>
                      <div class="row px-3">
                        <div class="col-lg-2">
                          <div class="row">
                            <div class="col-lg-3 ml-auto my-auto">
                              <input type="checkbox" aria-label="Checkbox for following text input">
                            </div>
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
                              <input type="number" name="quantity" class="form-control input-number text-center" value="1" min="1" max="999999">
                            </div>
                            <div class="col-lg-2 col-sm-2 my-auto">
                              <a href="#" class="btn btn-danger btn-lg"><i class="fa fa-trash"></i></a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="custom-control-inline">
                        <div class="col-lg-6 my-auto text-right">
                          <strong>Sub Total : Rp. 820.000,00</strong>
                        </div>
                        <div class="ml-5 my-auto text-right">
                          <a href="pembayaran.php" class="btn mr-3 btn-primary"><strong>Check Out</strong></i></a>
                          <a class="btn btn-secondary" href="index.php">Kembali</a>
                        </div>
                      </div>
                      </div>
                      </div>
</div>
      </div>
            </div>
                  </div>

<script src="src/js/main.js"></script>

<?php

    require 'includes/footer.php';

?>