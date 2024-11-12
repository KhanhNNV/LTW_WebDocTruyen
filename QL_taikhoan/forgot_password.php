<?php 
session_start(); // Khởi động session
include("config.php");

if(isset($_POST['forgot_password'])) {
    $username = $_POST['username']; // Lấy tên người dùng từ form
    $email = $_POST['email'];   //Lây email người dùng từ form
    $new_password = md5($_POST['new_password']); // Mã hóa mật khẩu mới

    // Kiểm tra tên người dùng và email
    $sql = mysqli_query($conn, "SELECT User_Password FROM user WHERE Ten_User = '$username' AND Email_User = '$email'");
    
    if(mysqli_num_rows($sql) > 0) {
        // Lấy mật khẩu cũ từ cơ sở dữ liệu
        $row_password = mysqli_fetch_assoc($sql);
        $old_password = $row_password['User_Password'];

        // So sánh mật khẩu mới với mật khẩu cũ
        if ($new_password === $old_password) {
            $_SESSION['error'] = "Mật khẩu mới trùng với mật khẩu cũ!";
        } else {
            // Cập nhật mật khẩu mới
            $sql_update_password = mysqli_query($conn, "UPDATE user SET User_Password = '$new_password' WHERE Ten_User = '$username'");
            if($sql_update_password){
                echo "Mật khẩu mới đã được thay đổi thành công!";
                header("Location: login.php");
                exit();
            } else {
                echo "Đã xảy ra lỗi khi thay đổi mật khẩu!";
            }
        }
    } else {
        $_SESSION['error'] = "Tên đăng nhập hoặc email không đúng!";
    }
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay Đổi Mật Khẩu</title>
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
        <h2>Thay Đổi Mật Khẩu</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<div style='color: red;'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']); // Xóa thông báo sau khi hiển thị
        }
        ?>
        <form action="forgot_password.php" autocomplete="off" method="POST">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Nhập email" required>

            <label for="new_password">Mật khẩu mới:</label>
            <input type="password" id="new_password" name="new_password" placeholder="Nhập mật khẩu mới" required>

            <input type="submit" id="forgot_password" name="forgot_password" value="Thay đổi mật khẩu">
        </form>
    </div>
</body>

</html>