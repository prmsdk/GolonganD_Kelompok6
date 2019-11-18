<?php
    session_start();
    
    include 'includes/config.php';
    require 'includes/header.php';
    if(!isset($_SESSION['admin_login'])){
        header("location:index.php");
    }
?>
    <div class="container">
        <h2 class="alert alert-primary text-center mt-3">KATEGORI BAHAN</h2>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="add_master.php" method="POST">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="" class="form-control" placeholder="Masukkan Nama Kategori">
                    </div>

                    ​
                    
                        <input type="submit" name="add_master" class="btn btn-primary" value="SIMPAN">
                        
                      </div>
                    </div>
                  
                </form>
            </div>
        </div>
    </div>

<?php
    require 'includes/footer.php';
?>