<?php
    $mysqli = new mysqli("coffee-shop.mysql.database.azure.com", "tuan", "Tohru14617", "ban_hang");
    if ($mysqli->connect_errno) {
        echo "Không kết nối được đến MySQL: " . $mysqli->connect_error;
        exit();
    }

    if(isset($_POST['btn_dangki'])){
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $ten = $_POST['ten'];
        $email = $_POST['email'];

        if($username == "" || $password == "" || $ten == "" || $email == ""){
            echo "Vui lòng nhập đúng thông tin";
        }
        else{
            $sql = "INSERT INTO users(username, password, tennsd, email) VALUES (
                    '$username',
                    '$password',
                    '$ten',
                    '$email')";
            if($mysqli->query($sql)){
                echo "Chúc mừng bạn đã đăng ký thành công";
                header('Location: login_SignUp.php');
            }else{
                echo "Không đăng ký được";
            }
        }
    }

    $mysqli->close();
?>
