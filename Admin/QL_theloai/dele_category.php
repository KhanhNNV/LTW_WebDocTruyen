<?php 
    //session_start();
    include("../../QL_taikhoan/config.php");
    if (isset($_POST['delete_category'])) {
        $Ten_TL = $_POST['Ten_TL'];
        $sql_check = "SELECT Ten_TL FROM category WHERE Ten_TL = '$Ten_TL'";
        $result_check = mysqli_query($conn, $sql_check);
        $count_check = mysqli_num_rows($result_check);
        if ($count_check > 0) {
            $sql_delete = "DELETE FROM category WHERE Ten_TL = '$Ten_TL'";
            mysqli_query($conn, $sql_delete);
            $_SESSION['success_dele'] = "Thể loại đã được xóa thành công!";
            header("Location: ../index.php");
            exit();
        }else{
            $_SESSION['error_dele'] = "Vui lòng chọn thể loại để xóa!";
            header("Location: ../index.php");
            exit();
        }
   }
?>