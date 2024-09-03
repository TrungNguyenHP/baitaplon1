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
$tv = "SELECT id, ten, gia, hinh_anh, thuoc_menu FROM san_pham WHERE trang_chu='co' ORDER BY sap_xep_trang_chu DESC LIMIT 0,15";
$tv_1 = mysqli_query($conn, $tv);

echo "<table>";
while ($tv_2 = mysqli_fetch_array($tv_1, MYSQLI_ASSOC)) {
    echo "<tr>";
    for ($i = 1; $i <= 4; $i++) {
        echo "<td align='center' width='215px' valign='top' >";
        if ($tv_2 != false) {
            $link_anh = "hinh_anh/san_pham/" . $tv_2['hinh_anh'];
            $link_chi_tiet = "?thamso=chi_tiet_san_pham&id=" . $tv_2['id'];
            $gia = $tv_2['gia'];
            $gia = number_format($gia, 0, ",", ".");
            echo "<a href='$link_chi_tiet' >";
            echo "<img src='$link_anh' width='150px' >";
            echo "</a>";
            echo "<br>";
            echo "<br>";
            echo "<a href='$link_chi_tiet' >";
            echo $tv_2['ten'];
            echo "</a>";
            echo "<div style='margin-top:5px' >";
            echo $gia;
            echo" đ";
            echo "</div>";
            echo "<br>";
        } else {
            echo "&nbsp;";
        }
        echo "</td>";
        if ($i != 4) {
            $tv_2 = mysqli_fetch_array($tv_1, MYSQLI_ASSOC);
        }
    }
    echo "</tr>";
}
echo "</table>";

// Đóng kết nối
mysqli_close($conn);
?>
