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
$tv = "SELECT id, ten, hinh_anh FROM san_pham WHERE noi_bat='co' ORDER BY id DESC LIMIT 0,3";
$tv_1 = mysqli_query($conn, $tv);

while ($tv_2 = mysqli_fetch_array($tv_1, MYSQLI_ASSOC)) {
    $link_anh = "hinh_anh/san_pham/" . $tv_2['hinh_anh'];
    $link_chi_tiet = "?thamso=chi_tiet_san_pham&id=" . $tv_2['id'];

    echo "<a href='$link_chi_tiet' >";
    echo "<img src='$link_anh' width='100px' >";
    echo "</a>";
    echo "<br><br>";
    echo $tv_2['ten'];
    echo "<br><br>";
}

// Đóng kết nối
mysqli_close($conn);
?>
