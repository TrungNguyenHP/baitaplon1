<?php
    $id = $_GET['id'];

    $so_du_lieu = 15;
    $conn = new mysqli("coffee-shop.mysql.database.azure.com", "tuan", "Tohru14617", "ban_hang");
    if ($mysqli->connect_errno) {
        echo "Không kết nối được đến MySQL: " . $mysqli->connect_error;
        exit();
    }

    $tv = "SELECT COUNT(*) FROM san_pham WHERE thuoc_menu='$id';";
    $tv_1 = $mysqli->query($tv);
    $tv_2 = $tv_1->fetch_array();
    $so_trang = ceil($tv_2[0] / $so_du_lieu);

    if (!isset($_GET['trang'])) {
        $vtbd = 0;
    } else {
        $vtbd = ($_GET['trang'] - 1) * $so_du_lieu;
    }

    $tv = "SELECT id, ten, gia, hinh_anh, thuoc_menu FROM san_pham WHERE thuoc_menu='$id' ORDER BY id DESC LIMIT $vtbd, $so_du_lieu";
    $tv_1 = $mysqli->query($tv);
    echo "<table>";
    while ($tv_2 = $tv_1->fetch_array()) {
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
                echo " đ";
                echo "</div>";
                echo "<br>";
            } else {
                echo "&nbsp;";
            }
            echo "</td>";

            if ($i != 4) {
                $tv_2 = $tv_1->fetch_array();
            }
        }
        echo "</tr>";
    }

    $mysqli->close();
    echo "</table>";
?>
