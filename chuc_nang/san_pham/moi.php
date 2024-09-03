<br />
<center>
	<?php 
	     $conn = new mysqli("coffee-shop.mysql.database.azure.com", "tuan", "Tohru14617", "ban_hang");
		$tv="SELECT id, ten, hinh_anh FROM san_pham ORDER BY id DESC LIMIT 0,3";
		$tv_1=mysqli_query($conn, $tv); // Thay $connection bằng biến kết nối cơ sở dữ liệu của bạn
		while($tv_2=mysqli_fetch_array($tv_1))
		{
			$link_anh="hinh_anh/san_pham/".$tv_2['hinh_anh'];
			$link_chi_tiet="?thamso=chi_tiet_san_pham&id=".$tv_2['id'];
			echo "<a href='$link_chi_tiet' >";
				echo "<img src='$link_anh' width='100px' >";
			echo "</a>";
			echo "<br><br>";
			echo $tv_2['ten'];
			echo "<br>";
			echo "<br>";
		}
	?>
</center>
