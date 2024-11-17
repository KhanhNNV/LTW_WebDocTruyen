<?php
include("../../QL_taikhoan/config.php");
session_start();

if (isset($_POST['favorite'])) {
    $story_id = $_SESSION['story_id'];
    $user_id = $_SESSION['user_id'];

    // Kiểm tra xem truyện đã có trong yêu thích chưa
    $result_check = mysqli_query($conn, "SELECT IDtruyen FROM yeuthich WHERE IDtruyen = '$story_id' AND Id_User = '$user_id'");

    if (mysqli_num_rows($result_check) > 0) {
        // Nếu đã yêu thích, xóa khỏi danh sách yêu thích
        $sql_delete = "DELETE FROM yeuthich WHERE IDtruyen = '$story_id' AND Id_User = '$user_id'";
        if (mysqli_query($conn, $sql_delete)) {
            $_SESSION['story'] = "Đã bỏ yêu thích truyện!";
        } else {
            $_SESSION['story'] = "Lỗi khi bỏ yêu thích truyện!";
        }
    } else {
        // Nếu chưa yêu thích, thêm vào danh sách yêu thích
        $sql_insert = "INSERT INTO yeuthich (IDtruyen, Id_User) VALUES ('$story_id', '$user_id')";
        if (mysqli_query($conn, $sql_insert)) {
            $_SESSION['story'] = "Thêm truyện vào yêu thích thành công!";
        } else {
            $_SESSION['story'] = "Lỗi khi thêm truyện vào yêu thích!";
        }
    }

    header("Location: intro.php?id=" . $story_id);
    exit();
}

$conn->close();
?>