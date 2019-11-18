<?php
    session_start();
    
    include 'includes/config.php';
    require 'includes/header.php';
    if(!isset($_SESSION['admin_login'])){
        header("location:index.php");
    }
?>
    <div class="continer">
        <h2 class="alert alert-primary text-center mt-3">PRODUK</h2>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="add_produk.php" method="POST">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="" class="form-control" placeholder="Masukkan Nama Produk Anda">
                    </div>
                
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control">
                            <option>1. Full color 4/4</option>
                            <option>2. Full Color 1/1</option>
                            <option>3. Full Color 4/1</option>
                            <option>4. Full Color 1</option>
                            <option>5. Full Color 4</option>
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label>Pilih Bahan :</label>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="radio1" id="radio2" checked>
                            <label>AP 120 gram</label>
                        </div>

                    <div class="form-check-inline">
                        <input type="radio" class="form-check-input" name="radio1" id="radio2" checked>
                        <label>AP 150 gram</label>
                    </div>

                    <div class="form-check-inline">
                        <input type="radio" class="form-check-input" name="radio1" id="radio2" checked>
                        <label>AP 210 gram</label>
                    </div>
                </div>
                
                    <div class="form-group">
                        <label>Pilih kertas :</label>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="radio1" id="radio2" checked>
                            <label>Jenis Kertas 1</label>
                        </div>

                    <div class="form-check-inline">
                        <input type="radio" class="form-check-input" name="radio1" id="radio2" checked>
                        <label>Jenis kertas 2</label>
                    </div>
                
                    <div class="form-check-inline">
                        <input type="radio" class="form-check-input" name="radio1" id="radio2" checked>
                        <label>Jenis Kertas 3</label>
                    </div>
                            
                    <div class="form-check-inline">
                        <input type="radio" class="form-check-input" name="radio1" id="radio2" checked>
                        <label>Jenis Kertas 4</label>
                    </div>
                            
            <div class="form-group">
                    <label>Pilih Ukuran :</label>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="radio1" id="radio2" checked>
                            <label> 32x48 cm</label>
                        </div>
                    <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="radio1" id="radio2" checked>
                            <label> 38x53 cm</label>
                        </div>
                            
                    <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="radio1" id="radio2" checked>
                            <label> 46x64 cm</label>
                        </div>   
                </div>

                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="JumlahRentangAwal">Jumlah Rentang Awal</label>
                                <input type="number" name="" class="form-control" placeholder="" id="">
                            </div>
                        </div>
                
                        <div class="col-md-6">
                            <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="" class="form-control">
                                </div>    
                            </div>
                            </div>
                
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="JumlahRentangAkhir">Jumlah Rentang Akhir</label>
                                    <input type="number" name="" class="form-control" placeholder="" id="">
                                </div>
                            </div>
                                
                        <div class="col-md-6">
                            <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="" class="form-control">
                                </div>    
                            </div>
                        </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="BedaRenatng">Beda Rentang</label>
                            <input type="number" name="" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
                
                
                
                <a class="btn btn-primary" href="#" role="button">SIMPAN</a>
                    <!-- <button class="btn btn-primary" type="submit">BAYAR</button>
                    <a class="btn btn-primary" href="#" role="button">
                    <i class="fa fa-shopping-cart fa-1x"></i>
                    </a> -->
                    

                
            </form>
                    </div>
                    </form>
                    </div>
            </div>
        </div>

<?php
    require 'includes/footer.php';
?>