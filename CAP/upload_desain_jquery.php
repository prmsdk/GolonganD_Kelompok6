<?php

//upload.php

if(!empty($_FILES))
{
	if(is_uploaded_file($_FILES['desain']['tmp_name']))
	{
		sleep(1);

		$ekstensi_boleh = array('zip','rar','pdf'); //ekstensi file yang boleh diupload
    $nama = $_FILES['desain']['name']; //menunjukkan letak dan nama file yang akan di upload
    $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
    $ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
    $ukuran = $_FILES['desain']['size']; //untuk mendapatkan ukuran file yang diupload
    $file_temporary = $_FILES['desain']['tmp_name']; //untuk mendapatkan temporary file yang di upload
        if(in_array($ekstensi,$ekstensi_boleh)===true){
            if($ukuran < 31322100 && $ukuran != 0){ 
                $id = rand(0,100);
								$uniq = uniqid($id,true);
								$nama_upload = $uniq.'.'.$ekstensi;
                move_uploaded_file($file_temporary, 'pictures/produk_desain/'.$uniq.'.'.$ekstensi); //untuk upload file
                // $query = mysqli_query ($con, "SELECT * FROM user");
                echo '<input type="hidden" id="namadesain" name="namadesain" value="'.$nama_upload.'">';
								echo '<input type="hidden" id="statusdesain" name="statusdesain" value="0">';
								echo '<h5 class="text-success pt-0">Upload Berhasil!</h5>';
								echo '<script>$("#pilihdesain2").prop("disabled","true");</script>';
								echo '<script>$("#uploadSubmit").attr("disabled", "disabled");</script>';
            }else{
							echo '<h5 class="text-danger pt-0">Upload Gagal! Mohon muat ulang halaman</h5>';
							echo '<script>$("#pilihdesain2").prop("checked", "true");</script>';
							echo '<script>$("#uploadfile").attr("disabled", "disabled");</script>';
							echo '<script>$("#uploadSubmit").attr("disabled", "disabled");</script>';
            }
        }else{
					echo '<h5 class="text-danger pt-0">Upload Gagal! </h5>';
					echo '<script>$("#pilihdesain2").prop("checked", "true");</script>';
					echo '<script>$("#uploadfile").attr("disabled", "disabled");</script>';
					echo '<script>$("#uploadSubmit").attr("disabled", "disabled");</script>';
        }

	// 	$source_path = $_FILES['desain']['tmp_name'];
	// 	$nama = $_FILES['desain']['name']; //menunjukkan letak dan nama file yang akan di upload
  //   $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
	// 	$ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
	// 	$id = rand(0,100);
	// 	$uniq = uniqid($id,true);
	// 	$nama_upload = $uniq.'.'.$ekstensi;
		
	// 	$target_path = 'pictures/produk_esain/' . $nama_upload;
	// 	if(move_uploaded_file($source_path, $target_path))
	// 	{	
	// 		// echo '<img src="'.$target_path.'" class="img-thumbnail" width="300" height="250" />';
	// 		echo '<input type="hidden" id="namadesain" name="namadesain" value="'.$nama_upload.'">';
	// 		echo '<input type="hidden" id="statusdesain" name="statusdesain" value="0">';
	// 		echo '<h5 class="text-success pt-0">Upload Berhasil!</h5>';
	// 	}else{
	// 		echo '<h5 class="text-danger pt-0">Upload Gagal!</h5>';
	// 	}
	// }else{
	// 	return false;
	// }
	}
}

?>