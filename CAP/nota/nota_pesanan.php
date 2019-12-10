<?php
  include '../includes/config.php';
  session_start();
  if(isset($_GET['id_pesanan'])){
    $id_pesanan = $_GET['id_pesanan'];

    $result_pesanan = mysqli_query($con, "SELECT
    user.USER_NAMA_LENGKAP,	
    cast(pesanan.TANGGAL_PESANAN as date) as TANGGAL_PESANAN, 
    pesanan.TOTAL_HARGA, 

    CASE 
    WHEN pesanan.STATUS_PESANAN = 1 THEN 'Sedang Menunggu Bukti Transfer' 
    WHEN pesanan.STATUS_PESANAN = 2 THEN 'Sedang Menunggu Antrian'
    WHEN pesanan.STATUS_PESANAN = 3 THEN 'Sedang Dalam Proses' 
    WHEN pesanan.STATUS_PESANAN = 4 THEN 'Telah Selesai Dikerjakan'
    WHEN pesanan.STATUS_PESANAN = 5 THEN 'Sedang Dalam Pengiriman' 
    WHEN pesanan.STATUS_PESANAN = 6 THEN 'Dibatalkan'
    END AS KET_STATUS,

    CASE 
    WHEN pesanan.KET_PEMBAYARAN = 2 THEN 'Uang Muka'
    WHEN pesanan.KET_PEMBAYARAN = 1 THEN 'Lunas'
    END AS KET_PEMBAYARAN

    FROM pesanan,user

    WHERE
    pesanan.USER_ID = user.USER_ID AND
    pesanan.ID_PESANAN = '$id_pesanan'");

    $data_pesanan = mysqli_fetch_assoc($result_pesanan);
    $nama_user = $data_pesanan['USER_NAMA_LENGKAP'];
    $tgl_psn = $data_pesanan['TANGGAL_PESANAN'];
    $total_harga = $data_pesanan['TOTAL_HARGA'];
    $ket_pembayaran = $data_pesanan['KET_PEMBAYARAN'];
    $ket_status = $data_pesanan['KET_STATUS'];
  }

  require '../fpdf/fpdf.php';

$pdf = new FPDF('P','mm','A4');
// membuat halaman baru
$pdf->AddPage();
$pdf->isFinished = false;
// setting jenis font yang akan digunakan
$pdf->SetFont('Times','B',16);
// mencetak string 
$pdf->Image('../src/img/icons/cap.png',20,10,22,22);
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
$pdf->Cell(190,12,'NOTA PEMESANAN',0,1,'C');

$pdf->SetFont('Times','',10);
$pdf->Cell(10,7,'',0,1);
// Menampilkan Header Tabel
$pdf->Cell(11,7,'',0,0,'C');
$pdf->Cell(170,7,'Atas Nama : '.$nama_user.'',0,1,'R');

$pdf->SetFont('Times','B',10);
$pdf->Cell(11,7,'',0,0,'C');
$pdf->Cell(90,7,'ID PESANAN : '.$id_pesanan.'','T',0,'L');
$pdf->Cell(80,7,$tgl_psn,'T',1,'R');

$pdf->SetFont('Times','',10);
$pdf->Cell(11,6,'',0,0,'C');
$pdf->Cell(10,6,'NO',1,0,'C');
$pdf->Cell(60,6,'DAFTAR PRODUK',1,0,'C');
$pdf->Cell(30,6,'DESAIN',1,0,'C');
$pdf->Cell(30,6,'QTY',1,0,'C');
$pdf->Cell(40,6,'SUB TOTAL',1,1,'C');

$result_detail = mysqli_query($con, "SELECT 
detail_pesanan.JUMLAH_PRODUK, 
detail_pesanan.SUB_TOTAL, 

CASE
WHEN detail_pesanan.STATUS_DESAIN = 1 THEN 'ADA'
WHEN detail_pesanan.STATUS_DESAIN = 0 THEN 'TIDAK ADA'
END AS STATUS_DESAIN,

produk.NAMA_PRODUK, 
warna.JENIS_WARNA, 
ukuran.JENIS_UKURAN, 
bahan.NAMA_BAHAN

FROM detail_pesanan, produk, warna, ukuran, bahan

WHERE
produk.ID_PRODUK = detail_pesanan.ID_PRODUK AND
produk.ID_UKURAN = ukuran.ID_UKURAN AND
produk.ID_BAHAN = bahan.ID_BAHAN AND
produk.ID_WARNA = warna.ID_WARNA AND
detail_pesanan.ID_PESANAN = '$id_pesanan'");

$i = 0;
while($data_detail = mysqli_fetch_assoc($result_detail)){
  $i+=1;
  $quantity = $data_detail['JUMLAH_PRODUK'];
  $sub_total = $data_detail['SUB_TOTAL'];
  $status_desain = $data_detail['STATUS_DESAIN'];
  $nama_produk = $data_detail['NAMA_PRODUK'];
  $jenis_warna = $data_detail['JENIS_WARNA'];
  $jenis_ukuran = $data_detail['JENIS_UKURAN'];
  $nama_bahan = $data_detail['NAMA_BAHAN'];
  $daftar_produk = "$nama_produk / $jenis_warna / $jenis_ukuran / $nama_bahan";

  $cellWidth=60; //lebar sel
	$cellHeight=6; //tinggi sel satu baris normal
	
	//periksa apakah teksnya melibihi kolom?
	if($pdf->GetStringWidth($daftar_produk) < $cellWidth){
		//jika tidak, maka tidak melakukan apa-apa
		$line=1;
	}else{
		//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
		//dengan memisahkan teks agar sesuai dengan lebar sel
		//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel
		
		$textLength=strlen($daftar_produk);	//total panjang teks
		$errMargin=5;		//margin kesalahan lebar sel, untuk jaga-jaga
		$startChar=0;		//posisi awal karakter untuk setiap baris
		$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
		$textArray=array();	//untuk menampung data untuk setiap baris
		$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)
		
		while($startChar < $textLength){ //perulangan sampai akhir teks
			//perulangan sampai karakter maksimum tercapai
			while( 
			$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
			($startChar+$maxChar) < $textLength ) {
				$maxChar++;
				$tmpString=substr($daftar_produk,$startChar,$maxChar);
			}
			//pindahkan ke baris berikutnya
			$startChar=$startChar+$maxChar;
			//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
			array_push($textArray,$tmpString);
			//reset variabel penampung
			$maxChar=0;
			$tmpString='';
			
		}
		//dapatkan jumlah baris
		$line=count($textArray);
	}

  $pdf->Cell(11,($line * $cellHeight),'',0,0,'C');
  $pdf->Cell(10,($line * $cellHeight),"$i.",1,0,'C');

  $xPos=$pdf->GetX();
  $yPos=$pdf->GetY();
  $pdf->MultiCell($cellWidth,$cellHeight,$daftar_produk,1,'C');

  $pdf->SetXY($xPos + $cellWidth , $yPos);
  $pdf->Cell(30,($line * $cellHeight),$status_desain,1,0,'C');
  $pdf->Cell(30,($line * $cellHeight),number_format($quantity, 0,".","."),1,0,'C');
  $pdf->Cell(40,($line * $cellHeight),'Rp. '.number_format($sub_total, 0,".",".").',-',1,1,'C');

}

$pdf->SetFont('Times','B',10);
$pdf->Cell(11,7,'',0,0,'C');
$pdf->Cell(100,7,'',0,0,'C');
$pdf->Cell(30,7,'Total Harga :','TB',0,'R');
$pdf->Cell(40,7,'Rp. '.number_format($total_harga, 0,".",".").',-','TB',1,'C');

$pdf->Cell(11,7,'',0,0,'C');
$pdf->Cell(100,7,'',0,0,'C');
$pdf->Cell(30,7,'Ket Bayar :','TB',0,'R');
$pdf->Cell(40,7,$ket_pembayaran,'TB',1,'C');

$pdf->Cell(10,7,'',0,1);
$pdf->Cell(10,7,'',0,1);



$pdf->SetFont('Times','',10);
$pdf->Cell(190,12,'--   Terimakasih telah memesan.   --',0,1,'C');


$pdf->Output();