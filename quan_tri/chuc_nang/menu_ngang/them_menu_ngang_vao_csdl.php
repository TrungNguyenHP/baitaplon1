<?php
if (!isset($bien_bao_mat)) {
    exit();
}
?>

<?php
session_start();
$ten_menu = trim($_POST['ten']);
$ten_menu = str_replace("'", "&#39;", $ten_menu);
$loai_menu = $_POST['loai_menu'];
$noi_dung = $_POST['noi_dung'];
$noi_dung = str_replace("'", "&#39;", $noi_dung);

if ($ten_menu != "") {
  $conn = new mysqli("coffee-shop.mysql.database.azure.com", "tuan", "Tohru14617", "ban_hang");

    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    $tv = "INSERT INTO menu_ngang (id, ten, noi_dung, loai_menu) VALUES (NULL, '$ten_menu', '$noi_dung', '$loai_menu')";

    if ($conn->query($tv) === TRUE) {
        $_SESSION['loai_menu_wr8'] = $loai_menu;
    } else {
        echo "Lỗi: " . $tv . "<br>" . $conn->error;
    }
    $conn->close();
} else {
    thong_bao_html("Tên menu chưa được điền vào");
}
?>
