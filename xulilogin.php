<?php
	session_start();
	if(isset($_SESSION['username'])){
		echo "Xin chao ".$_SESSION['username'];
		header("location:index.php");
	}
	else{
		$mysqli = new mysqli("coffee-shop.mysql.database.azure.com", "tuan", "Tohru14617", "ban_hang");
		if ($mysqli->connect_errno) {
			echo "Không kết nối được đến MySQL: " . $mysqli->connect_error;
			exit();
		}
		
		if(isset($_POST['btn_dangnhap'])){
			$user = $_POST['user'];
			$pass = $_POST['pass'];
			
			$sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
			$result = $mysqli->query($sql);
			$count = $result->num_rows;
			
			if($count > 0){
				echo "Đăng nhập thành công. Xin chào " . $user;
				$_SESSION['username'] = $user;
				header('Location: index.php');
			}
			else{
				echo "Đăng nhập thất bại.";
			}
		}
		
		$mysqli->close();
	}
?>
