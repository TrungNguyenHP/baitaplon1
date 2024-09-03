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

// Truy vấn SQL
$sql = "SELECT * FROM menu_doc ORDER BY id";
$result = $conn->query($sql);

// Kiểm tra và xử lý kết quả
if ($result->num_rows > 0) {
    echo "<div class='menu_doc'>";
    while ($row = $result->fetch_assoc()) {
        $link = "?thamso=xuat_san_pham&id=" . $row['id'];
        echo "<a href='$link'>";
        echo $row['ten'];
        echo "</a>";
    }
    echo "</div>";
} else {
    echo "Không có dữ liệu";
}

// Đóng kết nối
$conn->close();
?>
