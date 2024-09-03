<?php
if (!isset($bien_bao_mat)) {
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra và xử lý dữ liệu gửi từ biểu mẫu
    if (isset($_POST['ten']) && isset($_POST['danh_muc']) && isset($_POST['gia']) && isset($_FILES['hinh_anh']) && isset($_POST['trang_chu']) && isset($_POST['noi_bat']) && isset($_POST['noi_dung'])) {
        $ten = trim($_POST['ten']);
        $ten = str_replace("'", "&#39;", $ten);
        $danh_muc = $_POST['danh_muc'];
        $gia = trim($_POST['gia']);
        if ($gia == "") {
            $gia = 0;
        }
        $ten_file_anh = $_FILES['hinh_anh']['name'];
        $trang_chu = $_POST['trang_chu'];
        $noi_bat = $_POST['noi_bat'];
        $noi_dung = $_POST['noi_dung'];
        $noi_dung = str_replace("'", "&#39;", $noi_dung);
        
        if ($ten != "" && $ten_file_anh != "") {
            // Kết nối đến cơ sở dữ liệu
            $conn = mysqli_connect("coffee-shop.mysql.database.azure.com", "tuan", "Tohru14617", "ban_hang");
            if (!$conn) {
                die("Lỗi kết nối: " . mysqli_connect_error());
            }

            // Kiểm tra xem tên file ảnh đã tồn tại trong cơ sở dữ liệu chưa
            $tv_k = "SELECT COUNT(*) FROM san_pham WHERE hinh_anh = '$ten_file_anh'";
            $tv_k_1 = mysqli_query($conn, $tv_k);
            $tv_k_2 = mysqli_fetch_array($tv_k_1);
            if ($tv_k_2[0] == 0) {
                // Lấy giá trị lớn nhất của trường sap_xep_trang_chu từ bảng san_pham
                $tv_m = "SELECT MAX(sap_xep_trang_chu) FROM san_pham";
                $tv_m_1 = mysqli_query($conn, $tv_m);
                $tv_m_2 = mysqli_fetch_array($tv_m_1);
                $sap_xep_trang_chu = $tv_m_2[0] + 1;

                // Thực hiện truy vấn INSERT để chèn dữ liệu sản phẩm mới vào bảng san_pham
                $tv = "INSERT INTO san_pham (id, ten, gia, hinh_anh, noi_dung, thuoc_menu, noi_bat, trang_chu, sap_xep_trang_chu)
                    VALUES (NULL, '$ten', '$gia', '$ten_file_anh', '$noi_dung', '$danh_muc', '$noi_bat', '$trang_chu', '$sap_xep_trang_chu')";
                if (mysqli_query($conn, $tv)) {
                    // Di chuyển file ảnh tải lên vào thư mục ../hinh_anh/san_pham/
                    $duong_dan_anh = "../hinh_anh/san_pham/" . $ten_file_anh;
                    move_uploaded_file($_FILES['hinh_anh']['tmp_name'], $duong_dan_anh);

                    $_SESSION['danh_muc_menu'] = $danh_muc;
                    $_SESSION['tuy_chon_trang_chu'] = $trang_chu;
                    $_SESSION['tuy_chon_noi_bat'] = $noi_bat;
                } else {
                    echo "Lỗi: " . mysqli_error($conn);
                }
            } else {
                echo "Hình ảnh bị trùng tên";
            }

            // Đóng kết nối
            mysqli_close($conn);
        } else {
            echo "Chưa điền đầy đủ thông tin";
        }
    } else {
        echo "Thiếu thông tin gửi đến server";
    }
} else {
    echo "Yêu cầu không hợp lệ";
}
?>
