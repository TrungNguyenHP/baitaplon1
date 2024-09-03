<?php 
$loi="";
if (isset($_POST['nutguiyeucau'])==true){
    $email = $_POST['email'];
    $conn=new PDO("mysql:host=coffee-shop.mysql.database.azure.com;dbname=ban_hang;charset=utf8","tuan","Tohru14617");
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql="SELECT * FROM users WHERE email = ?";
    $stmt=$conn->prepare($sql);
    $stmt->execute( [$email] );
    $count = $stmt->rowCount();
    if($count==0){
        $loi="Email khong khop voi bat ki tai khoan nao";
    }else{
        $matkhaumoi= substr(md5(rand(0,999999)),0,8);
        $sql="UPDATE users SET password =? WHERE email =?" ;
        $stmt=$conn->prepare($sql);
        $stmt->execute([$matkhaumoi,$email ]);
         "Da thay doi mat khau thanh cong";
        //ok
        Guimatkhaimoi($email,$matkhaumoi);
        echo '<script type="text/javascript">
                alert("Thong bao: Da gui thong tin thay doi mat khau. Vui long kiem tra tin nhan");
                window.location.href = "login_SignUp.php";
              </script>';
        exit(); 
    }
}

?>
<?php  
function Guimatkhaimoi($email,$matkhaumoi){
    require "PHPMailer-6.9.1/src/PHPMailer.php"; 
    require "PHPMailer-6.9.1/src/SMTP.php"; 
    require 'PHPMailer-6.9.1/src/Exception.php'; 
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->SMTPDebug = 0; 
        $mail->isSMTP();  
        $mail->CharSet  = "utf-8";
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true; 
        $mail->Username = 'thien86087@st.vimaru.edu.vn'; 
        $mail->Password = '3538309Aa1';  
        $mail->SMTPSecure = 'ssl';   
        $mail->Port = 465;               
        $mail->setFrom('thien86087@st.vimaru.edu.vn', 'AdminThanThien' ); 
        $mail->addAddress($email); 
        $mail->isHTML(true); 
        $mail->Subject = 'Thong bao cap lai mat khau';
        $noidungthu = "<p>Cap lai mat khau</p>
            MAT KHAU CUA BAN LA {$matkhaumoi}
        "; 
        $mail->Body = $noidungthu;
        $mail->smtpConnect( array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));
        $mail->send();
        'Đã gửi mail xong';
    } catch (Exception $e) {
        echo 'Error: ', $mail->ErrorInfo;
    }
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<form method="post">
    <?php if($loi!="") { ?>
        <div class="alert alert-danger"><?= $loi?></div>
    <?php } ?>
    <div class="mb-3">
        <label for="email" class="form-label">Nhap email</label>
        <input value="<?php if (isset($email)==true) echo $email ?>" type="email" class="form-control" id="email"name="email">
    </div>
    <button type="submit" name="nutguiyeucau"value="nutgui" class="btn btn-primary">Gui yeu cau</button>
</form>
