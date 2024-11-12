<?php 
    session_start();
    include('config.php');
    if (isset($_POST['login'])) {
        //tk admin
        $taikhoan_admin = $_POST['username'];
        $password_admin = md5($_POST['password']);
        $sql_admin = "SELECT * FROM admin WHERE UserName = '$taikhoan_admin' AND Admin_PassWord = '$password_admin' LIMIT 1";
        $kq_admin = mysqli_query($conn, $sql_admin);
        $count_admin = mysqli_num_rows($kq_admin);
        //tk user
        $taikhoan_user = $_POST['username'];
        $password_user = md5($_POST['password']);
        $sql_user = "SELECT * FROM user WHERE Ten_User = '$taikhoan_user' AND User_Password = '$password_user' LIMIT 1";
        $kq_user = mysqli_query($conn, $sql_user);
        $count_user = mysqli_num_rows($kq_user);
        if ($count_user > 0) {
            $_SESSION['login'] = $taikhoan_user;
            header('Location: ../../../User/index.php');
        }
        elseif ($count_admin > 0) {
            $_SESSION['login'] = $taikhoan_admin;
            header('Location: ../../../Admin/index.php');
        }
        else {
            $_SESSION['error'] = "Đăng nhập thất bại! Vui lòng thử lại!";
            header("Location: login.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
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
        <h2>Đăng Nhập</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<div style='color: red;'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']); // Xóa thông báo sau khi hiển thị
        }
        ?>
        <form action="login.php" autocomplete="off" method="POST">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>

            <input type="submit" id="login" name="login" value="Đăng Nhập">
        </form>
        <div class="footer">
            <p><a href="forgot_password.php">Quên mật khẩu?</a>&ensp;Chưa có tài khoản? <a href="register.php">Đăng
                    ký</a></p>
        </div>
    </div>
</body>

</html>