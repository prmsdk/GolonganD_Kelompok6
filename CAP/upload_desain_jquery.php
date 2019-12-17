<?php

//upload.php

if(!empty($_FILES))
{
	if(is_uploaded_file($_FILES['desain']['tmp_name']))
	{
		sleep(1);
		$source_path = $_FILES['desain']['tmp_name'];
		$target_path = 'pictures/produk_desain/' . $_FILES['desain']['name'];
		if(move_uploaded_file($source_path, $target_path))
		{
			// echo '<img src="'.$target_path.'" class="img-thumbnail" width="300" height="250" />';
			echo '<h5 class="text-success pt-0">Upload Berhasil!</h5>';
		}
	}
}

?>