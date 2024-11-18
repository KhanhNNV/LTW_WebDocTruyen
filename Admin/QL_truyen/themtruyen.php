<?php
include("../../QL_taikhoan/config.php");

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_POST['Ten_truyen']) && isset($_POST['IDThe_loai']) && isset($_POST['Tac_gia']) &&
    isset($_POST['Tinh_trang']) && isset($_POST['Tom_tat_ND']) && isset($_FILES['hinhanh'])) {

    $Ten_truyen = $conn->real_escape_string($_POST['Ten_truyen']);
    $IDThe_loai = $conn->real_escape_string($_POST['IDThe_loai']);
    $Tac_gia = $conn->real_escape_string($_POST['Tac_gia']);
    $Tinh_trang = $conn->real_escape_string($_POST['Tinh_trang']);
    $Tom_tat_ND = $conn->real_escape_string($_POST['Tom_tat_ND']);

    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $hinhanh_name = time() . '_' . $hinhanh;
    $target_dir = "../../assets/picture/";
    $target_file = $target_dir . $hinhanh_name;

    if (move_uploaded_file($hinhanh_tmp, $target_file)) {
        $sql = "INSERT INTO truyen (Ten_truyen, IDThe_loai, Tac_gia, Tinh_trang, Tom_tat_ND, hinhanh) 
                VALUES ('$Ten_truyen', '$IDThe_loai', '$Tac_gia', '$Tinh_trang', '$Tom_tat_ND', '$hinhanh_name')";

        if ($conn->query($sql) === TRUE) {
            echo "<div style='font-family: Arial, sans-serif; text-align: center; padding: 20px;'>";
            echo "<p style='color: #28a745; font-size: 18px;'>Thêm truyện thành công!</p>";
            echo "<p style='color: #333; font-size: 16px;'>Muốn thêm chap? Nhấn vào nút dưới đây:</p>";
            echo "<form action='newchap.php' method='get' style='display: inline-block; margin-top: 10px;'>";
            echo "<input type='submit' value='Thêm chap' id='nut' style='padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;'>";
            echo "</form>";
            echo "<form action='bangchon.php' method='get' style='display: inline-block; margin-top: 10px;'>";
            echo "<input type='submit' value='Về trang chủ' id='homeButton' style='padding: 10px 20px; background-color: #28a745; color: #fff; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; margin-left: 10px;'>";
            echo "</form>";
            echo "</div>";
        } else {
            echo "<p>Lỗi: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Không thể tải lên file ảnh. Vui lòng thử lại.</p>";
    }
} else {
    echo "<p style='color: red;'>Dữ liệu không hợp lệ. Vui lòng kiểm tra lại!</p>";
}

$conn->close();
?>
