<?php
  include '../includes/config.php';
  session_start();
  if(isset($_SESSION['id_admin'])){
    $day1 = $_GET['awal'];
    $day2 = $_GET['akhir'];
    $dayakhir = strtotime("+1 day", strtotime($day2));
    $dayakhir = date("Y-m-d", $dayakhir);

    $diff = abs(strtotime($day1) - strtotime($day2));
    $row_hari = floor($diff / (60*60*24) + 1); // 7
    // $dayhari = $day2 - $day1;

    $produk = array();
    $result_produk = array();
    $data_produk = array();
    $tahun = array();
    $bulan = array();
    $dayhari = $day1;

    $omset = array();
    $result_omset = array();
    $data_omset = array();

    for($i=1; $i<=$row_hari; $i++){
      $tahun[$i] = substr($dayhari,0,4);
      $bulan[$i] = substr($dayhari,5,2);
      $produk[$i] = substr($dayhari,8,2);

      $result_produk[$i] = mysqli_query($con, "SELECT COUNT(*) as TOT_PRODUK FROM pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND TANGGAL_PESANAN LIKE '%$dayhari%'");
      $data_produk[$i] = mysqli_fetch_assoc($result_produk[$i]);
      // var_dump($data_hari[$i]['TOT_OMSET']); echo "<br>";

      $result_omset[$i] = mysqli_query($con, "SELECT SUM(TOTAL_HARGA) as TOT_OMSET FROM pesanan WHERE (STATUS_PESANAN = 4 OR STATUS_PESANAN = 5) AND TANGGAL_PESANAN LIKE '%$dayhari%'");
      $data_omset[$i] = mysqli_fetch_assoc($result_omset[$i]);
      if($data_omset[$i]['TOT_OMSET'] == null){
        $data_omset[$i]['TOT_OMSET'] = 0;
      }
      // var_dump($data_omset[$i]['TOT_OMSET']);
      
      $dayhari = strtotime("+1 day", strtotime($dayhari));
      $dayhari = date("Y-m-d", $dayhari);
    }
    
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
$pdf->Cell(190,10,'LAPORAN DATA DARI '.date("d-m-Y", strtotime($day1)).' HINGGA '.date("d-m-Y", strtotime($day2)),0,1,'C');

$pdf->SetFont('Times','B',10);
// Menampilkan Header Tabel
$pdf->Cell(21,6,'',0,0,'C');
$pdf->Cell(10,6,'NO',1,0,'C');
$pdf->Cell(30,6,'TANGGAL',1,0,'C');
$pdf->Cell(40,6,'JUMLAH PESANAN',1,0,'C');
$pdf->Cell(40,6,'TOTAL OMSET (Rp.)',1,0,'C');
$pdf->Cell(30,6,'KET',1,1,'C');

$pdf->SetFont('Times','',10);
$j = 0;
for($i=1; $i<=$row_hari; $i++){
  $j+=1;
  $pdf->Cell(21,6,'',0,0,'C');
  $pdf->Cell(10,6,$i,1,0,'C');
  $pdf->Cell(30,6,$tahun[$i].'-'.$bulan[$i].'-'.$produk[$i],1,0,'C');
  if($data_produk[$i]['TOT_PRODUK'] == 0){
    $pesanan = '-';
  }else{
    $pesanan = $data_produk[$i]['TOT_PRODUK'].' pesanan';
  }
  $pdf->Cell(40,6,$pesanan,1,0,'C');
  $pdf->Cell(40,6,number_format($data_omset[$i]['TOT_OMSET'], 0,".",".").'  ',1,0,'R');
  $pdf->Cell(30,6,'',1,1,'C');
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