<?php
  include '../includes/config.php';
  session_start();
  if(isset($_SESSION['id_admin'])){
    $id_admin = $_SESSION['id_admin'];
    $result_admin = mysqli_query($con, "SELECT * FROM admin WHERE ADM_ID = '$id_admin'");
    $data_admin = mysqli_fetch_assoc($result_admin);
  }

// memanggil library FPDF
require '../../fpdf/fpdf.php';
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P','mm','A4');
// membuat halaman baru
$pdf->AddPage();
$pdf->isFinished = false;
// setting jenis font yang akan digunakan
$pdf->SetFont('Times','B',16);
// mencetak string 
$pdf->Image('../../src/img/icons/cap.png',20,10,22,22);
$pdf->Cell(190,12,'Cahaya Abadi Perkasa',0,1,'C');
$pdf->SetFont('Times','',10);
$pdf->Cell(190,7,'Jl. Kauman 312 RT 04, Mangli, Kecamatan Kaliwates',0,1,'C');
$pdf->Cell(190,4,'Kabupaten Jember - (0331)412990',0,1,'C');
$pdf->Cell(190,4,'','B',1);
$pdf->Cell(190,1,'','B',1);

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Times','B',14);
$pdf->Cell(190,12,'LAPORAN DATA UKURAN',0,1,'C');

$pdf->SetFont('Times','B',10);
// Menampilkan Header Tabel
$pdf->Cell(11,6,'',0,0,'C');
$pdf->Cell(10,6,'NO',1,0,'C');
$pdf->Cell(30,6,'ID PRODUK',1,0,'C');
$pdf->Cell(50,6,'NAMA PRODUK',1,0,'C');
$pdf->Cell(40,6,'HARGA MIN',1,0,'C');
$pdf->Cell(40,6,'KATEGORI PRODUK',1,1,'C');


// select seluruh data pada tabel ukuran
$pdf->SetFont('Times','',10);
$result_produk = mysqli_query($con, "SELECT * FROM tampil_produk, kategori_produk 
WHERE tampil_produk.ID_KATEGORI = kategori_produk.ID_KATEGORI");
$i = 0;
while($data_produk = mysqli_fetch_assoc($result_produk)){
  $i+=1;
  $pdf->Cell(11,6,'',0,0,'C');
  $pdf->Cell(10,6,$i,1,0,'C');
  $pdf->Cell(30,6,$data_produk['ID_TAMPIL_PRODUK'],1,0,'C');
  $pdf->Cell(50,6,$data_produk['NAMA_TAMPIL_PRODUK'],1,0,'C');
  $produk_id = $data_produk['ID_TAMPIL_PRODUK'];
  $result = mysqli_query($con, "SELECT tampil_produk.NAMA_TAMPIL_PRODUK, tampil_produk.ID_TAMPIL_PRODUK,
  (warna.HARGA_WARNA + ukuran.HARGA_UKURAN) + 1 * (bahan.HARGA_BAHAN * (1 / satuan_bahan.JUMLAH_SATUAN)) AS HARGA_MIN
  FROM
  tampil_produk, warna, bahan, ukuran, tampil_warna, tampil_ukuran, tampil_bahan, satuan_bahan
  WHERE
  tampil_produk.ID_TAMPIL_PRODUK = tampil_warna.ID_TAMPIL_PRODUK AND
  tampil_produk.ID_TAMPIL_PRODUK = tampil_ukuran.ID_TAMPIL_PRODUK AND
  tampil_produk.ID_TAMPIL_PRODUK = tampil_bahan.ID_TAMPIL_PRODUK AND
  tampil_warna.ID_WARNA = warna.ID_WARNA AND
  tampil_ukuran.ID_UKURAN = ukuran.ID_UKURAN AND
  tampil_bahan.ID_BAHAN = bahan.ID_BAHAN AND
  satuan_bahan.ID_SATUAN = bahan.ID_SATUAN AND
  tampil_produk.ID_TAMPIL_PRODUK = '$produk_id'
  
  ORDER BY 
  HARGA_MIN
  ASC
  LIMIT 1");

  $data_harga = mysqli_fetch_assoc($result);
  $produk_harga = $data_harga['HARGA_MIN'];
  $produk_harga_awal = substr($produk_harga, 0, -5);

  $pdf->Cell(40,6,'Rp. '. number_format($produk_harga_awal, 0,".","."),1,0,'C');
  $pdf->Cell(40,6,$data_produk['NAMA_KAT_PRODUK'],1,1,'C');
}


// tampilkan footer ketika dokumen telah selesai
$pdf->isFinished = true;
if($pdf->isFinished){
  $pdf->setY(-60);
  $pdf->SetFont('Times','',12);
  $pdf->Cell(130);
  date_default_timezone_set('Asia/Jakarta');
  $date = date("d")." ".month(date("n"))." ".date("Y");
  $pdf->Cell(30,6,'Jember, '. $date,0,1,'C');
  $pdf->Cell(130);
  $pdf->Cell(30,6,"Penanggung Jawab,",0,1,'C');
  $pdf->Cell(10,7,'',0,1);
  $pdf->Cell(10,7,'',0,1);
  $pdf->Cell(10,7,'',0,1);
  $pdf->Cell(130);
  $pdf->Cell(30,6,$data_admin['ADM_NAMA_USAHA_ADM'],0,1,'C');
}


$pdf->Output();


    

?>