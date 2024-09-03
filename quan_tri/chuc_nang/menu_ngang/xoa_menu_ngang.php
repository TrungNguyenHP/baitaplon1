<?php
session_start();

if (!isset($bien_bao_mat)) {
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Thực hiện tạo kết nối MySQLi và thực thi truy vấn DELETE tại đây
  $conn = new mysqli("coffee-shop.mysql.database.azure.com", "tuan", "Tohru14617", "ban_hang");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    // Xây dựng truy vấn DELETE
    $tv = "DELETE FROM menu_ngang WHERE id = $id";

    // Thực thi truy vấn
    if ($conn->query($tv) === TRUE) {
        // Thực hiện hành động tiếp theo sau khi xóa thành công
        header("Location: index.php"); // Thay đổi index.php thành trang mà bạn muốn chuyển hướng đến
        exit();
    } else {
        echo "Lỗi: " . $tv . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
