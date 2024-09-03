<?php
$id = $_GET['id'];

// Thực hiện kết nối tới cơ sở dữ liệu
$servername = "coffee-shop.mysql.database.azure.com";
$username = "tuan";
$password = "Tohru14617";
$dbname = "ban_hang";
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối tới cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Thực hiện truy vấn SQL
$sql = "SELECT * FROM menu_ngang WHERE id = '$id'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h1>" . $row['ten'] . "</h1>";
    echo $row['noi_dung'];
} else {
    echo "Không tìm thấy menu có ID: $id";
}

// Đóng kết nối
$conn->close();
?>
