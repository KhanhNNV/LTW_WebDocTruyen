<?php 
    //session_start();
    include("../../QL_taikhoan/config.php"); // Kết nối đến cơ sở dữ liệu
    if (isset($_POST['add_category'])) {
        $Ten_TL = $_POST['name'];
        $sql_check = "SELECT Ten_TL FROM category WHERE Ten_TL = '$Ten_TL'";
        $result_check = mysqli_query($conn, $sql_check);
        $count_check = mysqli_num_rows($result_check);
        
        // Kiểm tra tên thể loại đã tồn tại
      if ($count_check > 0) {
        $_SESSION['error_add'] = "Tên thể loại đã tồn tại!";
        header('Location: ../index.php');
        exit();
      }
        $sql_insert = "INSERT INTO category (Ten_TL) VALUES ('$Ten_TL')";
        $result = mysqli_query($conn, $sql_insert);
        $_SESSION['success_add'] = "Thêm thể loại thành công!";
        header('Location:../index.php');
        exit();
      
    }

?>