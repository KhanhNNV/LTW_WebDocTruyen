<?php 
    session_start();
    include('config.php');
    if(isset($_POST['register'])){
        
        //tk user
        $taikhoan_user = $_POST['username'];
        $password_user = md5($_POST['password']);
        $re_password_user = md5($_POST['confirmPassword']);
        $email_user = $_POST['email'];

        $sql_check_account_user = "SELECT * FROM user WHERE Ten_User = '$taikhoan_user' OR Email_User = '$email_user'";
        $result_check_account_user = mysqli_query($conn, $sql_check_account_user);
        $count_account_user = mysqli_num_rows($result_check_account_user);
        
        //Kiem tra tai khoan hoac email đã tồn tại
        if  ($count_account_user > 0 ){
            $_SESSION['error'] = "Tài khoản hoặc email đã tồn tại!";
            header('Location: register.php');
            exit();
        }
        
        // Kiểm tra mật khẩu đã nhập đúng
        if($password_user!= $re_password_user){
            $_SESSION['error'] = "Mật khẩu không trùng khớp!";
            header('Location: register.php');
            exit();
        }

        // Thực hiện đăng ký
        $sql_register = "INSERT INTO user (Ten_User, User_Password, Email_User) VALUES ('$taikhoan_user', '$password_user', '$email_user')";
        $result = mysqli_query($conn, $sql_register);

        // Kiểm tra trả về kết quả
        if($result){
            $_SESSION['register'] = "Đăng ký thành công!";
            header('Location: login.php');
        }
        mysqli_close($conn);
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản</title>
    <style>
    body {
        background-color: #f1f1f1;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 400px;
        margin: 100px auto;
        padding: 20px;
        background: #ffffff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #35424a;
    }

    label {
        display: block;
        margin: 10px 0 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 5px 0 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    input[type="submit"] {
        background-color: #33bbff;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        width: 100%;
    }

    input[type="submit"]:hover {
        background-color: #0099e6;
    }

    .footer {
        text-align: center;
        margin-top: 20px;
    }

    .footer a {
        color: #007BFF;
        text-decoration: none;
    }

    .footer a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Đăng Ký Tài Khoản</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<div style='color: red;'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']); // Xóa thông báo sau khi hiển thị
        }
        ?>
        <form action="register.php" method="POST">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Nhập email" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>

            <label for="confirmPassword">Xác nhận mật khẩu:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Xác nhận mật khẩu" required>

            <input type="submit" id="register" name="register" value="Đăng Ký">
        </form>
        <div class="footer">
            <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
        </div>
    </div>
</body>

</html>