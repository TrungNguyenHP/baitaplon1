    <?php
    // Thêm đoạn mã khởi tạo kết nối MySQLi vào đây
    $servername = "coffee-shop.mysql.database.azure.com";
    $username = "tuan";
    $password = "Tohru14617";
    $dbname = "ban_hang";


    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Không thể kết nối đến MySQL: " . mysqli_connect_error());
    }
    // Kết thúc đoạn mã khởi tạo kết nối MySQLi

    if (isset($_GET['id']) && $_SESSION['trang_chi_tiet_gio_hang'] == "co") {
        $_SESSION['trang_chi_tiet_gio_hang'] = "huy_bo";
        if (isset($_SESSION['id_them_vao_gio'])) {
            $so = count($_SESSION['id_them_vao_gio']);
            $trung_lap = "khong";
            for ($i = 0; $i < count($_SESSION['id_them_vao_gio']); $i++) {
                if ($_SESSION['id_them_vao_gio'][$i] == $_GET['id']) {
                    $trung_lap = "co";
                    $vi_tri_trung_lap = $i;
                    break;
                }
            }
            if ($trung_lap == "khong") {
                $_SESSION['id_them_vao_gio'][$so] = $_GET['id'];
                $_SESSION['sl_them_vao_gio'][$so] = $_GET['so_luong'];
            }
            if ($trung_lap == "co") {
                $_SESSION['sl_them_vao_gio'][$vi_tri_trung_lap] = $_SESSION['sl_them_vao_gio'][$vi_tri_trung_lap] + $_GET['so_luong'];
            }
        } else {
            $_SESSION['id_them_vao_gio'][0] = $_GET['id'];
            $_SESSION['sl_them_vao_gio'][0] = $_GET['so_luong'];
        }
    }

    $gio_hang = "khong";
    if (isset($_SESSION['id_them_vao_gio'])) {
        $so_luong = 0;
        for ($i = 0; $i < count($_SESSION['id_them_vao_gio']); $i++) {
            $so_luong = $so_luong + $_SESSION['sl_them_vao_gio'][$i];
        }
        if ($so_luong != 0) {
            $gio_hang = "co";
        }
    }

    ?>

    <!DOCTYPE html>
    <html lang="vi">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Giỏ hàng</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <body>

        <div class="container mt-5">
            <h2>Giỏ hàng</h2>
            <hr>
            <?php
            if ($gio_hang == "khong") {
                echo "<p>Không có sản phẩm trong giỏ hàng</p>";
            } else {
                echo "<form action='' method='post'>";
                echo "<input type='hidden' name='cap_nhat_gio_hang' value='co' > ";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-bordered'>";
                echo "<thead class='thead-light'>";
                echo "<tr>";
                echo "<th scope='col' style='width:200px;'>Tên</th>";
                echo "<th scope='col' style='width:150px;'>Số lượng</th>";
                echo "<th scope='col' style='width:150px;'>Đơn giá</th>";
                echo "<th scope='col' style='width:170px;'>Thành tiền</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                $tong_cong = 0;
                for ($i = 0; $i < count($_SESSION['id_them_vao_gio']); $i++) {
                    $tv = "SELECT id, ten, gia FROM san_pham WHERE id='" . $_SESSION['id_them_vao_gio'][$i] . "'";
                    $tv_1 = mysqli_query($conn, $tv);
                    $tv_2 = mysqli_fetch_array($tv_1);

                    $tien = $tv_2['gia'] * $_SESSION['sl_them_vao_gio'][$i];
                    $tong_cong = $tong_cong + $tien;
                    $name_id = "id_" . $i;
                    $name_sl = "sl_" . $i;

                    if ($_SESSION['sl_them_vao_gio'][$i] != 0) {
                        echo "<tr>";
                        echo "<td>" . $tv_2['ten'] . "</td>";
                        echo "<td>";
                        echo "<input type='hidden' name='" . $name_id . "' value='" . $_SESSION['id_them_vao_gio'][$i] . "' >";
                        echo "<input type='text' class='form-control' style='width:50px' name='" . $name_sl . "' value='" . $_SESSION['sl_them_vao_gio'][$i] . "' > ";
                        echo "</td>";
                        echo "<td>" . $tv_2['gia'] . "</td>";
                        echo "<td>" . $tien . "</td>";
                        echo "</tr>";
                    }
                }

                echo "</tbody>";
                echo "</table>";
                echo "<div class='text-right'>";
                echo "<p>Tổng giá trị đơn hàng là: " . $tong_cong . " VNĐ</p>";
                echo "<input type='submit' class='btn btn-primary' value='Cập nhật'>";
                echo "</div>";
                echo "</div>";
                echo "</form>";

                include("chuc_nang/gio_hang/bieu_mau_mua_hang.php");
            }
            ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>
