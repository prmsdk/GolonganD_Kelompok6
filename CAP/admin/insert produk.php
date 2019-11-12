<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">


    <title>Form Produk</title>
  </head>
  <body>
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
       

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>