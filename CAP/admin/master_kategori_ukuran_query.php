<?php
include '../includes/config.php';
if(isset($_GET['id_kategori_ukuran'])){
  $id_kategori_ukuran = $_GET['id_kategori_ukuran'];
  
  if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
      $result = mysqli_query($con, "DELETE FROM kategori_ukuran WHERE ID_KATEGORI='$id_kategori_ukuran'");
      header("location:../kategori_ukuran.php?pesan=hapus_done");
    }
  }
}

if(isset($_POST['edit_kategori_ukuran'])){
  $id_kategori_ukuran = $_POST['id_kategori_ukuran'];
  $nama_kategori_ukuran = $_POST['nama_kategori_ukuran'];

  $result = mysqli_query($con, "UPDATE kategori_ukuran SET 
    NAMA_KAT_UKURAN= '$nama_kategori_ukuran'
    WHERE
    ID_KATEGORI = '$id_kategori_ukuran'
  ");

header("location:../kategori_ukuran.php?pesan=update_done_$nama_admin");
}

if(isset($_POST['tambah_kategori_ukuran
'])){
  $nama_kategori = $_POST['nama_kategori'];
  
  // UNTUK MENGAMBIL ID TERAKHIR
  $data = mysqli_query($con, "select ID_KATEGORI from kategori_ukuran
   ORDER BY ID_KATEGORI DESC LIMIT 1");
    while($kategori_data = mysqli_fetch_array($data))
    {
        $kat_id = $kategori_data['ID_KATEGORI'];
    }

    $row = mysqli_num_rows($data);
    if($row>0){
      $id_kategori = autonumber($kat_id, 3, 6);
    }else{
      $id_kategori = 'KPD000001';
    }

    $result = mysqli_query($con, "INSERT INTO 
    kategori_ukuran
    (ID_KATEGORI, NAMA_KAT_UKURAN
    )
    VALUES('$id_kategori', '$nama_kategori')
    ");

    header("location:../kategori_ukuran
    .php?pesan=Anda berhasil mendaftar!&status=success");
}

