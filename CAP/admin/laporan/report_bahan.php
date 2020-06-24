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
// setting jenis font yang akan digunakan
$pdf->isFinished = false;
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
$pdf->Cell(190,10,'LAPORAN DATA BAHAN',0,1,'C');

$pdf->SetFont('Times','B',10);
// Menampilkan Header Tabel
$pdf->Cell(11,6,'',0,0,'C');
$pdf->Cell(10,6,'NO',1,0,'C');
$pdf->Cell(25,6,'ID BAHAN',1,0,'C');
$pdf->Cell(40,6,'NAMA BAHAN',1,0,'C');
$pdf->Cell(20,6,'SATUAN',1,0,'C');
$pdf->Cell(30,6,'HARGA BAHAN',1,0,'C');
$pdf->Cell(25,6,'KATEGORI',1,1,'C');

$pdf->SetFont('Times','',10);
$result_bahan = mysqli_query($con, "SELECT * FROM bahan, kategori_bahan, satuan_bahan 
WHERE bahan.ID_KAT_bahan = kategori_bahan.ID_KAT_bahan AND
bahan.ID_SATUAN = satuan_bahan.ID_SATUAN");
$i = 0;
while($data_bahan = mysqli_fetch_assoc($result_bahan)){
  $i+=1;
  $pdf->Cell(11,6,'',0,0,'C');
  $pdf->Cell(10,6,$i,1,0,'C');
  $pdf->Cell(25,6,$data_bahan['ID_BAHAN'],1,0,'C');
  $pdf->Cell(40,6,$data_bahan['NAMA_BAHAN'],1,0,'C');
  $pdf->Cell(20,6,$data_bahan['SATUAN'],1,0,'C');
  $pdf->Cell(30,6,'Rp. '. number_format($data_bahan['HARGA_BAHAN'], 0,".","."),1,0,'C');
  $pdf->Cell(25,6,$data_bahan['NAMA_KAT_BAHAN'],1,1,'C');
}

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