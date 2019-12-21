<?php

//upload.php

if(!empty($_FILES))
{
	if(is_uploaded_file($_FILES['desain']['tmp_name']))
	{
		sleep(1);
		$source_path = $_FILES['desain']['tmp_name'];

		$nama = $_FILES['desain']['name']; //menunjukkan letak dan nama file yang akan di upload
    $ex = explode ('.',$nama); //explode berfungsi memecahkan/memisahkan string sesuai dengan tanda baca yang ditentukan
		$ekstensi = strtolower(end($ex)); //end = mengambil nilai terakhir dari ex, dtrtolower = memanipulasi string menjadi huruf kecil 
		$id = rand(0,100);
		$uniq = uniqid($id,true);
		$nama_upload = $uniq.'.'.$ekstensi;
		
		$target_path = 'pictures/produk_desain/' . $nama_upload;
		if(move_uploaded_file($source_path, $target_path))
		{	
			// echo '<img src="'.$target_path.'" class="img-thumbnail" width="300" height="250" />';
			echo '<input type="hidden" id="namadesain" name="namadesain" value="'.$nama_upload.'">';
			echo '<h5 class="text-success pt-0">Upload Berhasil!</h5>';
		}
	}
}

?>