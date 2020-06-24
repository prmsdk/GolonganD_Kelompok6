<?php
include 'api_key.php';
require 'C:\xampp\sendgrid\vendor\autoload.php';
include 'includes/config.php';
require 'includes/header.php';

if(isset($_POST['pemesanan_produk'])){

    $id_user = $_POST['id_user'];
    $id_produk = $_POST['id_produk'];

    $id_warna = $_POST['pilihwarnaa'];
    $id_bahan = $_POST['pilihbahan'];
    $id_ukuran = $_POST['pilihukuran'];
    $nama_produk = $_POST['nama_produk'];
    $status_desain = $_POST['pilihdesain'];
    $jumlah_produk = $_POST['jumlah_produk'];
    $namadesain = $_POST['namadesain'];

    $isi_produk = $_POST['isibahan'];
    $ket_pembayaran = $_POST['ket_pembayaran'];
    $sub_total = $_POST['sub_total'];
    $total = $_POST['total'];
    $id_bank = $_POST['pilihbank'];

    $catatan = $_POST['catatan'];

    
    $number = count($_POST["id_produk"]);

    // ============ PESANAN =================

    $data = mysqli_query($con, "select ID_PESANAN from pesanan ORDER BY ID_PESANAN DESC LIMIT 1");
        while($pesanan_data = mysqli_fetch_array($data))
        {
            $psn_id = $pesanan_data['ID_PESANAN'];
        }

        $row = mysqli_num_rows($data);
        if($row>0){
          $id_pesanan = autonumber($psn_id, 3, 6);
        }else{
          $id_pesanan = 'PSN000001';
        }

        // SET WAKTU JAKARTA GMT +7
        ini_set('date.timezone', 'Asia/Jakarta');

        // FORMAT TANGGAL -> TAHUN, BULAN, HARI
        $date = date("Y-m-d");
        // FORMAT JAM -> JAM 24, MENIT, DETIK
        $time = date("H:i:s");

    $pesanan = mysqli_query($con, "INSERT INTO pesanan 

    VALUES('$id_pesanan','ADM000001','$id_user','$id_bank','$date $time','$total','1',NULL,0,0,0)");

    if($pesanan){
      echo"berhasil menambah pesanan <br>";
    }else{
      echo"gagal menambah pesanan <br>";
    }

    // PENGULANGAN PRODUK DAN DETAIL ===============

    if ($number >= 1){
      for ($i = 0; $i < $number; $i++){

        $data = mysqli_query($con, "select ID_PRODUK from produk ORDER BY ID_PRODUK DESC LIMIT 1");
        while($produk_data = mysqli_fetch_array($data))
        {
            $prd_id = $produk_data['ID_PRODUK'];
        }

        $row = mysqli_num_rows($data);
        if($row>0){
          $id_produk = autonumber($prd_id, 3, 6);
        }else{
          $id_produk = 'PRD000001';
        }

        $id_ukn = $id_ukuran[$i];
        $id_bhn = $id_bahan[$i];
        $id_wrn = $id_warna[$i];
        $nama_prd = $nama_produk[$i];
        
        $produk = mysqli_query($con, "INSERT INTO produk 
        VALUES('$id_produk','$id_ukn','$id_bhn','$id_wrn','$nama_prd')");

        if($produk){
          echo"berhasil menambah produk <br>";
        }else{
          echo"gagal menambah produk <br>";
        }

        // DETAIL PESANAN ============================ DETAIL PESANAN

        $jml_prd = $jumlah_produk[$i];
        $nama_dsn = $namadesain[$i];
        $sub_ttl = $sub_total[$i];
        $stts_dsn = $status_desain[$i];
        $ket_byr = $ket_pembayaran[$i];
        $isi_prd = $isi_produk[$i];
        $ctt = $catatan[$i];

        $detail_pesanan = mysqli_query($con, "INSERT INTO detail_pesanan 
        VALUES('$id_produk','$id_pesanan','$jml_prd','$sub_ttl','$nama_dsn','$stts_dsn','$isi_prd','$ket_byr','$ctt')");

        if($detail_pesanan){
          echo"berhasil menambah detail pesanan <br>";
        }else{
          echo"gagal menambah detail pesanan <br>";
        }
        
      }
    }

    $our_email = 'dickayunia1@gmail.com';

    $result_user = mysqli_query($con, "SELECT * FROM user WHERE USER_ID = '$id_user'");
    $data_user = mysqli_fetch_assoc($result_user);
    $user_email = $data_user['USER_EMAIL'];
    $user_nama = $data_user['USER_NAMA_LENGKAP'];

    $result_bank = mysqli_query($con, "SELECT * FROM rekening_bank WHERE ID_REKENING = '$id_bank'");
    $data_bank = mysqli_fetch_assoc($result_bank);
    $nama_bank = $data_bank['NAMA_REKENING'];
    $nomor_bank = $data_bank['NOMOR_REKENING'];
    $atas_nama = $data_bank['ATAS_NAMA'];

    date_default_timezone_set('Asia/Jakarta');
    ini_set('date.timezone', 'Asia/Jakarta');

    // $dotenv = new Dotenv\Dotenv(__DIR__);
    // $dotenv->load();
    $for = '';
    
    // PERULANGAN DETAIL PESANAN
    for($j = 0; $j < $number; $j++){
      $for.= '<tr>
          <td style="padding: 10px 0 0 0; border-top: 1px dashed #aaaaaa;">
              <!-- TWO COLUMNS -->
              <table cellspacing="0" cellpadding="0" border="0" width="100%">
                  <tr>
                      <td valign="top" class="mobile-wrapper">
                          <!-- LEFT COLUMN -->
                          <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="left">
                              <tr>
                                  <td style="padding: 0 0 10px 0;">
                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                          <tr>
                                              <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">'.$nama_produk[$j].' ('.$jumlah_produk[$j].')</td>
                                          </tr>
                                      </table>
                                  </td>
                              </tr>
                          </table>
                          <!-- RIGHT COLUMN -->
                          <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="right">
                              <tr>
                                  <td style="padding: 0 0 10px 0;">
                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                          <tr>
                                              <td align="right" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">Rp. '.number_format($sub_total[$j], 0,".",".").'</td>
                                          </tr>
                                      </table>
                                  </td>
                              </tr>
                          </table>
                      </td>
                  </tr>
              </table>
          </td>
      </tr>';
      }
                      // END PERULANGAN


    date_default_timezone_set('Asia/Jakarta');
    ini_set('date.timezone', 'Asia/Jakarta');

    // $dotenv = new Dotenv\Dotenv(__DIR__);
    // $dotenv->load();
    $for = '';
    
    // PERULANGAN DETAIL PESANAN
    for($j = 0; $j < $number; $j++){
      $for.= '<tr>
          <td style="padding: 10px 0 0 0; border-top: 1px dashed #aaaaaa;">
              <!-- TWO COLUMNS -->
              <table cellspacing="0" cellpadding="0" border="0" width="100%">
                  <tr>
                      <td valign="top" class="mobile-wrapper">
                          <!-- LEFT COLUMN -->
                          <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="left">
                              <tr>
                                  <td style="padding: 0 0 10px 0;">
                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                          <tr>
                                              <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">'.$nama_produk[$j].' ('.$jumlah_produk[$j].')</td>
                                          </tr>
                                      </table>
                                  </td>
                              </tr>
                          </table>
                          <!-- RIGHT COLUMN -->
                          <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="right">
                              <tr>
                                  <td style="padding: 0 0 10px 0;">
                                      <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                          <tr>
                                              <td align="right" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">Rp. '.number_format($sub_total[$j], 0,".",".").'</td>
                                          </tr>
                                      </table>
                                  </td>
                              </tr>
                          </table>
                      </td>
                  </tr>
              </table>
          </td>
      </tr>';
      }
                      // END PERULANGAN

    $message = '
    <!DOCTYPE html>
        <html>
        <head>
        <title>A Responsive Email Template</title>
        <!--

            An email present from your friends at Litmus (@litmusapp)

            Email is surprisingly hard. While this has been thoroughly tested, your mileage may vary.
            Its highly recommended that you test using a service like Litmus (http://litmus.com) and your own devices.

            Enjoy!

        -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <style type="text/css">
            /* CLIENT-SPECIFIC STYLES */
            body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
            table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
            img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

            /* RESET STYLES */
            img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
            table{border-collapse: collapse !important;}
            body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}

            /* iOS BLUE LINKS */
            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }

            /* MOBILE STYLES */
            @media screen and (max-width: 525px) {

                /* ALLOWS FOR FLUID TABLES */
                .wrapper {
                  width: 100% !important;
                    max-width: 100% !important;
                }

                /* ADJUSTS LAYOUT OF LOGO IMAGE */
                .logo img {
                  margin: 0 auto !important;
                }

                /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
                .mobile-hide {
                  display: none !important;
                }

                .img-max {
                  max-width: 100% !important;
                  width: 100% !important;
                  height: auto !important;
                }

                /* FULL-WIDTH TABLES */
                .responsive-table {
                  width: 100% !important;
                }

                /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
                .padding {
                  padding: 10px 5% 15px 5% !important;
                }

                .padding-meta {
                  padding: 30px 5% 0px 5% !important;
                  text-align: center;
                }

                .padding-copy {
                    padding: 10px 5% 10px 5% !important;
                  text-align: center;
                }

                .no-padding {
                  padding: 0 !important;
                }

                .section-padding {
                  padding: 50px 15px 50px 15px !important;
                }

                /* ADJUST BUTTONS ON MOBILE */
                .mobile-button-container {
                    margin: 0 auto;
                    width: 100% !important;
                }

                .mobile-button {
                    padding: 15px !important;
                    border: 0 !important;
                    font-size: 16px !important;
                    display: block !important;
                }

            }

            /* ANDROID CENTER FIX */
            div[style*="margin: 16px 0;"] { margin: 0 !important; }
        </style>
        </head>
        <body style="margin: 0 !important; padding: 0 !important;">

        <!-- HIDDEN PREHEADER TEXT -->
        <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
            Pesanan Anda diterima! Silahkan verifikasi pembayaran dan unggah bukti pembayaran Anda..
        </div>

        <!-- HEADER -->
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td bgcolor="#F69322" align="center" style="padding: 8px; font-size:9pt; color: #fff; font-family: Helvetica, Arial, sans-serif;">Cahaya Abadi Perkasa</td>
            </tr>
            <tr>
                <td bgcolor="#ffffff" align="center">
                    <!--[if (gte mso 9)|(IE)]>
                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                    <tr>
                    <td align="center" valign="top" width="500">
                    <![endif]-->
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="wrapper">
                        <tr>
                            <td align="center" valign="top" style="padding: 40px 0 15px;" class="logo">
                                <a href="#" target="_blank">
                                    <img alt="Logo" src="https://lh3.googleusercontent.com/5riLPgwysWPuWJSDGBXfVrhsM_7E0ezC5BLWf2sY6O7TaianZU9pIftPsg5ylvl32kgYJhPLaPTHzg-NC0S4tbi07lP6G-Iya_rIkdN70vaErvxijVD1WkC4A0nG-MkLF9k1MeY-fofRB5rdyT8_m4MBiE58vCVYaHqRr757hXwhgqQc3kkejaxNBY-dN0u0D8YJVTA2X3xUvRMSLyAn3XgtB5hr3o_Z_1q6fXcamcoGdBub1z_QdcdzQ0FIZsEqbkPML1dYRzvUp7-8_vAYSiIhfVYy3Fq2IH4znx-RP_G1vl8i0Mhh16e6_3r70fk0ixy8kxGOwWbJZI_UkshJevajVqLwf7yJOk5G62Uc9JDGmnMU5vxQe6L_gFocAKEltbP9gmfeb_DwXgjskK5koXIVmSayCI0TVCcZLrR-gCImU6gtSnetVsBAWxxLdKvEwryLZXZlNfg750XzQpDa1bjeeIE4d1qNNx-iQDlWbCKhoHbWMAgHy9LW92i8NHGTywJ5DuiNDWimX29rSVxvNcHCb9xDEhW9e5mAhVHjq5HN7hj39_TSIaRMN2UPVDN5X2RahBfJsMYU5zPSOC4I372c6POQm02zfskdvHahE1Z4_zfow2zMFhkeMFXHvZW7Ug5xVOfZW5TLxwhfzx9yudojWpM3aGy5Vd0QdDC8O5oRj53VvC4tFm9XaRBBrn5fj88sp9AYnF9RYvDuQNKQWmYHhmiVQGqr2JMF655fFw=w299-h296-no" width="60" height="60" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;" border="0">
                                </a>
                            </td>
                        </tr>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            <tr>
                <td bgcolor="#ffffff" align="center" style="padding: 15px;">
                    <!--[if (gte mso 9)|(IE)]>
                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                    <tr>
                    <td align="center" valign="top" width="500">
                    <![endif]-->
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                        <tr>
                            <td>
                                <!-- COPY -->
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="center" style="font-size: 32px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 10px;" class="padding-copy">Pesanan Anda Kami Terima!</td>
                                    </tr>
                                    <tr>
                                        <td align="justify" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">Hai '.$user_nama.',<br><br> Pesanan anda akan kami proses setelah anda melakukan pembayaran terlebih dahulu dan mengirim bukti pembayaran kepada link dibawah untuk verifikasi.<br><br>Berikut detail pesanan anda :</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            <tr>
                <td bgcolor="#ffffff" align="center" style="padding: 15px;" class="padding">
                    <!--[if (gte mso 9)|(IE)]>
                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                    <tr>
                    <td align="center" valign="top" width="500">
                    <![endif]-->
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">'.$for.'<tr>
                            <td style="padding: 10px 0 0px 0; border-top: 2px solid #eaeaea; border-bottom: 1px dashed #aaaaaa;">
                                <!-- TWO COLUMNS -->
                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td valign="top" class="mobile-wrapper">
                                            <!-- LEFT COLUMN -->
                                            <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="left">
                                                <tr>
                                                    <td style="padding: 0 0 10px 0;">
                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            <tr>
                                                                <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px; font-weight: bold;">Total</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!-- RIGHT COLUMN -->
                                            <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="right">
                                                <tr>
                                                    <td>
                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            <tr>
                                                                <td align="right" style="font-family: Arial, sans-serif; color: #25A8E0; font-size: 16px; font-weight: bold;">Rp. '.number_format($total, 0,".",".").'</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            <tr>
                <td bgcolor="#ffffff" align="center" style="padding: 15px;">
                    <!--[if (gte mso 9)|(IE)]>
                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                    <tr>
                    <td align="center" valign="top" width="500">
                    <![endif]-->
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            <!-- COPY -->
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td align="left" style="padding: 0 0 0 0; font-size: 14px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color: #aaaaaa; font-style: italic;" class="padding-copy">Pesanan dapat dibatalkan dan dana akan dikembalikan dengan syarat status pesanan anda masih belum diproses. Pengunggahan bukti transfer haruslah dilakukan pada web kami, dan tidak dapat melalui balas pesan ini.</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            <tr>
                <td bgcolor="#ffffff" align="center" style="padding: 15px;">
                    <!--[if (gte mso 9)|(IE)]>
                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                    <tr>
                    <td align="center" valign="top" width="500">
                    <![endif]-->
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                        <tr>
                            <td>
                                <!-- COPY -->
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="center" style="font-size: 32px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 10px;" class="padding-copy">Lakukan Pembayaran</td>
                                    </tr>
                                    <tr>
                                        <td align="justify" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">Lakukan Pembayaran sesuai tagihan pesanan diatas kepada rekening bank dibawah ini :</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>

            <tr>
                <td bgcolor="#ffffff" align="center" style="padding: 15px;" class="padding">
                    <!--[if (gte mso 9)|(IE)]>
                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                    <tr>
                    <td align="center" valign="top" width="500">
                    <![endif]-->
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                        <tr>
                            <td style="padding: 10px 0 0 0; border-top: 1px dashed #aaaaaa;">
                                <!-- TWO COLUMNS -->
                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td valign="top" class="mobile-wrapper">
                                            <!-- LEFT COLUMN -->
                                            <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="left">
                                                <tr>
                                                    <td style="padding: 0 0 10px 0;">
                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            <tr>
                                                                <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">Nama Bank</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!-- RIGHT COLUMN -->
                                            <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="right">
                                                <tr>
                                                    <td style="padding: 0 0 10px 0;">
                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            <tr>
                                                                <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">: '.$nama_bank.'</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" class="mobile-wrapper">
                                            <!-- LEFT COLUMN -->
                                            <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="left">
                                                <tr>
                                                    <td style="padding: 0 0 10px 0;">
                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            <tr>
                                                                <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">Nomor Rekening</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!-- RIGHT COLUMN -->
                                            <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="right">
                                                <tr>
                                                    <td style="padding: 0 0 10px 0;">
                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            <tr>
                                                                <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">: '.$nomor_bank.'</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" class="mobile-wrapper">
                                            <!-- LEFT COLUMN -->
                                            <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="left">
                                                <tr>
                                                    <td style="padding: 0 0 10px 0;">
                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            <tr>
                                                                <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">Atas Nama</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!-- RIGHT COLUMN -->
                                            <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 47%;" align="right">
                                                <tr>
                                                    <td style="padding: 0 0 10px 0;">
                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            <tr>
                                                                <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">: '.$atas_nama.'</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            <tr>
                <td bgcolor="#ffffff" align="center" style="padding: 0px;">
                    <!--[if (gte mso 9)|(IE)]>
                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                    <tr>
                    <td align="center" valign="top" width="500">
                    <![endif]-->
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                        <tr>
                            <td>
                                <!-- COPY -->
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="justify" style="padding: 0px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">Setelah melakukan pembayaran, harap kirim bukti pembayaran ke link atau tombol dibawah ini.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            <tr>
                <td bgcolor="#ffffff" align="center" style="padding: 15px 0 30px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="500" class="responsive-table">
                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <!-- COPY -->
                                        <td align="center" style="font-size: 32px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;" class="padding-copy">Bagaimana cara unggah bukti pembayaran?</td>
                                    </tr>
                                    <tr>
                                        <td align="center" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">Anda dapat mengunggah bukti pembayaran anda dengan mengunjungi link ini <a href="http://localhost/GolonganD_Kelompok6/CAP/verif_pembayaran.php?id_pesanan='.$id_pesanan.'&id_bank='.$id_bank.'">Link Unggah</a> atau klik tombol dibawah ini.</td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <!-- BULLETPROOF BUTTON -->
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td align="center" style="padding-top: 25px;" class="padding">
                                                        <table border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
                                                            <tr>
                                                                <td align="center" style="border-radius: 3px;" bgcolor="#F69322"><a href="http://localhost/GolonganD_Kelompok6/CAP/verif_pembayaran.php?id_pesanan='.$id_pesanan.'&id_bank='.$id_bank.'" target="_blank" style="font-size: 16px; font-weight: 600; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #F69322; display: inline-block;" class="mobile-button">Unggah</a></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            <tr>
                <td bgcolor="#25A8E0" align="center" style="padding: 20px 0px;">
                    <!--[if (gte mso 9)|(IE)]>
                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                    <tr>
                    <td align="center" valign="top" width="500">
                    <![endif]-->
                    <!-- UNSUBSCRIBE COPY -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width: 500px;" class="responsive-table">
                        <tr>
                            <td align="center" style="font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#fff;">
                                Karang Miuwo, Mangli, Kec. Kaliwates, Kabupaten Jember, Jawa Timur
                                <br>
                                +62 81 249 882 52 (Hp) &nbsp;&nbsp;|&nbsp;&nbsp; (0331) 412990 (Telp) 
                                <br>
                                <span style="color: #fff; text-decoration: none;">Cahaya Abadi Perkasa</span>
                                <span style="font-family: Arial, sans-serif; font-size: 12px; color: #fff;">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                <span style="color: #fff; text-decoration: none;">&copy; 2020</span>
                            </td>
                        </tr>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
        </table>

        </body>
        </html>
    ';

    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom($our_email, 'Cahaya Abadi Perkasa');
    $email->setSubject('Pesanan Diterima');
    $email->addTo($user_email, $user_nama);
    // $email->addContent("text/plain", "$message");
    $email->addContent(
        "text/html", $message
    );
    // $sendgrid = new \SendGrid(getenv(SENDGRID_API_KEY));
    // $apiKey = getenv('SENDGRID_API_KEY');
    // $sendgrid = new \SendGrid($apiKey);
    $apiKey = SENDGRID_API_KEY;
    $sendgrid = new \SendGrid($apiKey);
    try {
        $response = $sendgrid->send($email);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }


    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom($our_email, 'Cahaya Abadi Perkasa');
    $email->setSubject('Pesanan Diterima');
    $email->addTo($user_email, $user_nama);
    // $email->addContent("text/plain", "$message");
    $message = '';
    include 'verif_pembayaran_email.php';
    $email->addContent(
        "text/html", $message
    );
    // $sendgrid = new \SendGrid(getenv(SENDGRID_API_KEY));
    // $apiKey = getenv('SENDGRID_API_KEY');
    // $sendgrid = new \SendGrid($apiKey);
    $apiKey = SENDGRID_API_KEY;
    $sendgrid = new \SendGrid($apiKey);
    try {
        $response = $sendgrid->send($email);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }

    

  echo "<button type='button' id='clear-cart' class='clear-cart'></button>";
  echo '<button onclick="window.location.href = '."'http://localhost/GolonganD_Kelompok6/CAP/verif_pembayaran.php?id_pesanan=$id_pesanan&id_bank=$id_bank'".';" id="verif_pembayaran">Home</button>';
  // header("location:verif_pembayaran.php?id_pesanan=$id_pesana&id_bank=$id_bank");

    // $ekstensi_boleh = array('zip','rar','pdf'); //ekstensi file yang boleh diupload
    // $desain = $_FILES['desain']['name']; //menunjukkan letak dan desain file yang akan di upload
    // $ex = explode ('.',$desain); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
    // $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
    // $ukuran = $_FILES['desain']['size']; //untuk mendapatkan ukuran file yang diupload
    // $file_temporary = $_FILES['desain']['tmp_name']; //untuk mendapatkan temporary file yang di upload
    //     if(in_array($ekstensi, $ekstensi_boleh)===true){
    //         if($ukuran < 31322100){ 
    //             move_uploaded_file($file_temporary, 'pictures/desain_pesanan/'.$desain); //untuk upload file
    //             // $query = mysqli_query ($koneksi, "SELECT * FROM user");
    //                 $detail_pesanan = mysqli_query($con, "INSERT INTO detail_pesanan 
    //                 VALUES('$id_produk','$id_pesanan','$jumlah_produk','$sub_total','$desain','$status_desain')");
    //                 if($detail_pesanan){
    //                     // header("location:keranjang.php");
    //                 }else{
    //                     echo "MAAF...., UPLOAD GAGAL";
    //                 }
    //         }else{
    //             echo "UKURAN FILE TERLALU BESAR";
    //         }
    //     }else{
    //         echo "FILE TIDAK SESUAI DENGAN EKSTENSI YANG DIBERIKAN";
    //     }



    require 'includes/footer.php';
}
?>