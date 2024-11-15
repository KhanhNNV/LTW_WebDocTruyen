<?php 
    session_start();
    include("../../QL_taikhoan/config.php");

    if(isset($_SESSION['login']) && isset($_GET['id']) && isset($_POST['noidung'])) {
        $IDtruyen = $_GET['id'];
        $noidung = $_POST['noidung'];
        $Ten_User = $_SESSION['login'];

        // Sử dụng dấu nháy đơn bao quanh giá trị của Ten_User
        $kq = mysqli_query($conn, "SELECT Id_User, Ten_User FROM user WHERE Ten_User = '$Ten_User'");
        
        // Kiểm tra kết quả truy vấn
        if ($row = mysqli_fetch_array($kq)) {
            $idUser = $row['Id_User'];
            
            // Câu lệnh INSERT không có dấu ',' thừa
            $sql = "INSERT INTO comments (ID, Id_User, IDtruyen, Ten_User, content) 
                    VALUES (NULL, '$idUser', '$IDtruyen', '$Ten_User', '$noidung')";
            mysqli_query($conn, $sql);
            
            // Chuyển hướng sau khi thêm bình luận thành công
            header("Location: intro.php?id=$IDtruyen");
        } else {
            echo "Không tìm thấy người dùng.";
        }
    } else {
        echo "Có lỗi xảy ra hoặc người dùng chưa đăng nhập.";
    }
?>
