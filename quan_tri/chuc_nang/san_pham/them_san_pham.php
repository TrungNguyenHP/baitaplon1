<?php
$servername = "coffee-shop.mysql.database.azure.com";
$username = "tuan";
$password = "Tohru14617";
$dbname = "ban_hang";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Kết nối không thành công: " . mysqli_connect_error());
}
?>

<?php
if (!isset($bien_bao_mat)) {
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Thêm Sản Phẩm</title>
</head>

<body>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">Thêm Sản Phẩm</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="ten" class="col-sm-3 col-form-label">Tên:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="ten" name="ten" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="danh_muc" class="col-sm-3 col-form-label">Danh Mục:</label>
                                <div class="col-sm-9">
                                    <?php
                                    if (!isset($_SESSION['danh_muc_menu'])) {
                                        $_SESSION['danh_muc_menu'] = "";
                                    }
                                    ?>
                                    <select name="danh_muc" class="form-control" style="margin-top:3px;margin-bottom:3px;">
                                        <?php
                                        $tv = "select * from menu_doc order by id ";
                                        $tv_1 = mysqli_query($conn, $tv);
                                        $a = "";
                                        while ($tv_2 = mysqli_fetch_array($tv_1)) {
                                            $ten = $tv_2['ten'];
                                            $id_menu = $tv_2['id'];
                                            if ($_SESSION['danh_muc_menu'] == $id_menu) {
                                                $a = "selected";
                                            }
                                            echo "<option value='$id_menu' $a >";
                                            echo $ten;
                                            echo "</option>";
                                            $a = "";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hinh_anh" class="col-sm-3 col-form-label">Hình ảnh:</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control-file" name="hinh_anh">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gia" class="col-sm-3 col-form-label">Giá:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="gia" name="gia" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="trang_chu" class="col-sm-3 col-form-label">Trang Chủ:</label>
                                <div class="col-sm-9">
                                    <?php
                                    $a_1 = "";
                                    $a_2 = "";
                                    if (isset($_SESSION['tuy_chon_trang_chu'])) {
                                        if ($_SESSION['tuy_chon_trang_chu'] == "co") {
                                            $a_2 = "selected";
                                        }
                                    }
                                    ?>
                                    <select name="trang_chu" class="form-control" style="margin-top:3px;margin-bottom:3px;">
                                        <option value="" <?php echo $a_1; ?>>Không</option>
                                        <option value="co" <?php echo $a_2; ?>>Có</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="noi_bat" class="col-sm-3 col-form-label">Nổi Bật:</label>
                                <div class="col-sm-9">
                                    <?php
                                    $a_1 = "";
                                    $a_2 = "";
                                    if (isset($_SESSION['tuy_chon_noi_bat'])) {
                                        if ($_SESSION['tuy_chon_noi_bat'] == "co") {
                                            $a_2 = "selected";
                                        }
                                    }
                                    ?>
                                    <select name="noi_bat" class="form-control" style="margin-top:3px;margin-bottom:3px;">
                                        <option value="" <?php echo $a_1; ?>>Không</option>
                                        <option value="co" <?php echo $a_2; ?>>Có</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="noi_dung" class="col-sm-3 col-form-label">Nội Dung:</label>
                                <div class="col-sm-9">
                                    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
                                    <script type="text/javascript">
                                        tinymce.init({
                                            selector: '#noi_dung',
                                            plugins: [
                                                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                                                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                                                'save table contextmenu directionality emoticons template paste textcolor jbimages'
                                            ],
                                            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons jbimages',
                                            relative_urls: false
                                        });
                                    </script>
                                    <textarea id="noi_dung" name="noi_dung" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-9 offset-sm-3">
                                    <br>
                                    <input type="submit" name="bieu_mau_them_san_pham" value="Thêm Sản Phẩm" class="btn btn-primary btn-lg">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
