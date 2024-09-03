<?php 
	if(!isset($bien_bao_mat)){exit();}
?>
<?php 
	$ten=trim($_POST['ten']);
	$ten=str_replace("'","&#39;",$ten);
	$gia=trim($_POST['gia']);
	$trang_chu=$_POST['trang_chu'];
	$noi_bat=$_POST['noi_bat'];
	$noi_dung=$_POST['noi_dung'];
	$noi_dung=str_replace("'","&#39;",$noi_dung);
	$ten_file_anh_tai_len=$_FILES['hinh_anh']['name'];
	if($ten_file_anh_tai_len!="")
	{
		$ten_file_anh=$ten_file_anh_tai_len;
	}
	else 
	{
		$ten_file_anh=$_POST['ten_anh'];
	}
	$id=$_GET['id'];
	if($ten!="")
	{

		//try {
			// Kết nối tới cơ sở dữ liệu bằng PDO
			//$db = new PDO("mysql:host=localhost;dbname=database_name", "username", "password");
			// Thiết lập chế độ báo lỗi
			//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



		$mysqli = new mysqli("coffee-shop.mysql.database.azure.com", "tuan", "Tohru14617", "ban_hang");
		if ($mysqli->connect_error) {
			die("Kết nối tới cơ sở dữ liệu thất bại: " . $mysqli->connect_error);
		}
		
		$tv_k="select count(*) from san_pham where hinh_anh='$ten_file_anh' ";
		$tv_k_1=$mysqli->query($tv_k);
		$tv_k_2=$tv_k_1->fetch_array();
		if($tv_k_2[0]==0 or $ten_file_anh_tai_len=="")
		{
			$tv="
			UPDATE san_pham SET 
			ten = '$ten',
			gia = '$gia',
			hinh_anh = '$ten_file_anh',
			noi_dung = '$noi_dung',
			trang_chu = '$trang_chu',
			noi_bat = '$noi_bat' 
			WHERE id =$id;
			";
			$mysqli->query($tv);
			
			if($ten_file_anh_tai_len!="")
			{				
				$duong_dan_anh="../hinh_anh/san_pham/".$ten_file_anh_tai_len;
				move_uploaded_file($_FILES['hinh_anh']['tmp_name'],$duong_dan_anh);
				$duong_dan_anh_cu="../hinh_anh/san_pham/".$_POST['ten_anh'];
				unlink($duong_dan_anh_cu);
			}
				
		}
		else 
		{
			thong_bao_html("Hình ảnh bị trùng tên");
		}

		$mysqli->close();
	}
	else 
	{
		thong_bao_html("Tên sản phẩm chưa được điền vào");
	}
?>
