<?php
if (!isset($bien_bao_mat)) {
    exit();
}

$id = $_GET['id'];

// Thực hiện truy vấn SQL để xóa dữ liệu
// Sử dụng PDO hoặc MySQLi để thực hiện truy vấn, dưới đây là ví dụ sử dụng MySQLi:

$servername = "coffee-shop.mysql.database.azure.com";
$username = "tuan";
$password = "Tohru14617";
$dbname = "ban_hang";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối tới cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Thực hiện truy vấn SQL để xóa dữ liệu
$sql = "DELETE FROM hoa_don WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Hóa đơn có ID $id đã được xóa thành công";
} else {
    echo "Lỗi khi xóa hóa đơn: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?><?php
if (!isset($bien_bao_mat)) {
    exit();
}

$id = $_GET['id'];

// Thực hiện truy vấn SQL để xóa dữ liệu
// Sử dụng PDO hoặc MySQLi để thực hiện truy vấn, dưới đây là ví dụ sử dụng MySQLi:

$servername = "xoaserver.mysql.database.azure.com";
$username = "sqladmin";
$password = "#Nqthlr123";
$dbname = "ban_hang";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối tới cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Thực hiện truy vấn SQL để xóa dữ liệu
$sql = "DELETE FROM hoa_don WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Hóa đơn có ID $id đã được xóa thành công";
} else {
    echo "Lỗi khi xóa hóa đơn: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
