<?php
    $_SESSION['trang_chi_tiet_gio_hang'] = "co";
    $id = $_GET['id'];
    $conn = new mysqli("coffee-shop.mysql.database.azure.com", "tuan", "Tohru14617", "ban_hang"); // Thay thế thông tin kết nối
    $tv = "SELECT * FROM san_pham WHERE id='$id'";
    $tv_1 = mysqli_query($conn, $tv);
    $tv_2 = mysqli_fetch_array($tv_1);
    $link_anh = "hinh_anh/san_pham/" . $tv_2['hinh_anh'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $link_anh; ?>" class="img-fluid" alt="Hình ảnh sản phẩm">
            </div>
            <div class="col-md-6">
                <div class="product-details">
                    <h2><?php echo $tv_2['ten']; ?></h2>
                    <p class="price" style="font-size: 18px;"><?php echo number_format($tv_2['gia'], 0, ",", "."); ?> đ</p>
                    <form>
                        <input type="hidden" name="thamso" value="gio_hang">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <div class="form-group">
                            <label for="so_luong">Số lượng:</label>
                            <input type="text" name="so_luong" value="1" class="form-control" style="width: 100px;">
                        </div>
                        <input type="submit" value="Thêm vào giỏ" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
    <div class="col-md-12">
        <b><h3 style="color: GREEN; font-size: 18px; font-family: 'Roboto', sans-serif;">Giới Thiệu Sản Phẩm</h3></b>
        <p style="color: #000000; font-size: 18px; font-family: 'Roboto', sans-serif;"><?php echo $tv_2['noi_dung']; ?></p>
    </div>
</div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
    mysqli_close($conn);
?>
