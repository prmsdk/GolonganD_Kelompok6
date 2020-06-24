<?php

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
    Aktivasi Akun anda dengan cara mengunjungi link ini...
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
                                <td align="center" style="font-size: 32px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 10px;" class="padding-copy">'.$subject.'</td>
                            </tr>
                            <tr>
                                <td align="justify" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">Hai '.$nama_user.',<br>'.$pesan.' :</td>
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
                                    <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 30%;" align="left">
                                        <tr>
                                            <td style="padding: 0 0 10px 0;">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tr>
                                                        <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">Nama</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- RIGHT COLUMN -->
                                    <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 70%;" align="left">
                                        <tr>
                                            <td style="padding: 0 0 10px 0;">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tr>
                                                        <td align="justify" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">: '.$nama_user.'</td>
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
                <tr>
                    <td style="padding: 10px 0 0 0; border-top: 1px dashed #aaaaaa;">
                        <!-- TWO COLUMNS -->
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td valign="top" class="mobile-wrapper">
                                    <!-- LEFT COLUMN -->
                                    <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 30%;" align="left">
                                        <tr>
                                            <td style="padding: 0 0 10px 0;">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tr>
                                                        <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">Username</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- RIGHT COLUMN -->
                                    <table cellpadding="0" cellspacing="0" border="0" width="47%" style="width: 70%;" align="left">
                                        <tr>
                                            <td style="padding: 0 0 10px 0;">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tr>
                                                        <td align="justify" style="font-family: Arial, sans-serif; color: #333333; font-size: 16px;">: '.$username_user.'</td>
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
                                            <td align="left" style="padding: 0 0 0 0; font-size: 14px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color: #aaaaaa; font-style: italic;" class="padding-copy">Jika data yang tertera diatas tidak cocok dengan data yang anda daftarkan, Mohon hubungi kami melalui Telepon/WhatsApp.</td>
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
        <td bgcolor="#ffffff" align="center" style="padding: 15px 0 30px;">
            <table border="0" cellpadding="0" cellspacing="0" width="500" class="responsive-table">
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <!-- COPY -->
                                <td align="center" style="font-size: 24px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;" class="padding-copy">Bagaimana cara mengaktifkan akun saya?</td>
                            </tr>
                            <tr>
                                <td align="center" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">Anda dapat mengaktifkan akun anda dengan cara mengunjungi link ini <a href="'.$link.'">Link Aktivasi</a> atau klik tombol dibawah ini.</td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <!-- BULLETPROOF BUTTON -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" style="padding-top: 25px;" class="padding">
                                                <table border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
                                                    <tr>
                                                        <td align="center" style="border-radius: 3px;" bgcolor="#F69322"><a href="'.$link.'" target="_blank" style="font-size: 16px; font-weight: 600; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #F69322; display: inline-block;" class="mobile-button">Aktivasi Akun</a></td>
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
                        <span style="font-family: Arial, sans-serif; font-size: 12px; color:#fff;">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                        <span href="http://litmus.com" target="_blank" style="color: #fff; text-decoration: none;">&copy; 2020</span>
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