<?php
$servername = "coffee-shop.mysql.database.azure.com";
$username = "tuan";
$password = "Tohru14617";
$dbname = "ban_hang";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

echo "";
?>
