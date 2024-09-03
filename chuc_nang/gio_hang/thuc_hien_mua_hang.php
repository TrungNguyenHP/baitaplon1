3<?php
session_start();

if (isset($_SESSION['id_them_vao_gio'])) {
    $ten_nguoi_mua = trim($_POST['ten_nguoi_mua']);
    $email = trim($_POST['email']);
    $dien_thoai = trim($_POST['dien_thoai']);
    $dia_chi = trim(nl2br($_POST['dia_chi']));
    $noi_dung = nl2br($_POST['noi_dung']);

    if ($ten_nguoi_mua != "" && $dien_thoai != "" && $dia_chi != "") {
        $hang_duoc_mua = "";
        for ($i = 0; $i < count($_SESSION['id_them_vao_gio']); $i++) {
            $hang_duoc_mua .= $_SESSION['id_them_vao_gio'][$i] . "[|||]" . $_SESSION['sl_them_vao_gio'][$i] . "[|||||]";
        }

       $servername = "coffee-shop.mysql.database.azure.com";
    $username = "tuan";
    $password = "Tohru14617";
    $dbname = "ban_hang";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối tới cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }

        $tv = "INSERT INTO hoa_don (
            id,
            ten_nguoi_mua,
            email,
            dia_chi,
            dien_thoai,
            noi_dung,
            hang_duoc_mua
        )
        VALUES (
            NULL,
            '$ten_nguoi_mua',
            '$email',
            '$dia_chi',
            '$dien_thoai',
            '$noi_dung',
            '$hang_duoc_mua'
        );";

        if ($conn->query($tv) === TRUE) {
            unset($_SESSION['id_them_vao_gio']);
            unset($_SESSION['sl_them_vao_gio']);
            thong_bao_html_roi_chuyen_trang("Cảm ơn bạn đã mua hàng tại website của chúng tôi", "index.php");
        } else {
            echo "Lỗi khi lưu đơn hàng vào cơ sở dữ liệu: " . $conn->error;
        }

        // Đóng kết nối
        $conn->close();
    } else {
        thong_bao_html("Không được bỏ trống tên người mua, điện thoại, địa chỉ");
        trang_truoc();
        exit();
    }
}
?>
