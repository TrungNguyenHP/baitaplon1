<?php
$servername = "thumottiserver.mysql.database.azure.com";
$username = "sqladmin";
$password = "#";
$dbname = "ban_hang";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

echo "";
?>
