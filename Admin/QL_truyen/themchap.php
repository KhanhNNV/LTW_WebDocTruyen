<?php
include("../../QL_taikhoan/config.php");

// Thiết lập múi giờ Việt Nam
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (!empty($_POST['ID_truyen']) && !empty($_POST['Tieu_de']) && !empty($_POST['STT']) && !empty($_POST['Noi_dung'])) {
    $ID_truyen = $conn->real_escape_string($_POST['ID_truyen']);
    $Tieu_de = $conn->real_escape_string($_POST['Tieu_de']);
    $STT = $conn->real_escape_string($_POST['STT']);
    $Noi_dung = $conn->real_escape_string($_POST['Noi_dung']);
    $Ngay_CN = date("Y-m-d H:i:s");

    $sql = "INSERT INTO chaptruyen (IDtruyen, Tieu_de, Noi_dung, Ngay_CN, STT) 
            VALUES ('$ID_truyen', '$Tieu_de', '$Noi_dung', '$Ngay_CN', '$STT')";

   
// Thực thi câu lệnh SQL và kiểm tra kết quả
if ($conn->query($sql) === TRUE) {
    echo "<div style='font-family: Arial, sans-serif; text-align: center; padding: 20px;'>";
    echo "<p style='color: #28a745; font-size: 18px;'>Thêm chap thành công!</p>";
    echo "<p style='color: #333; font-size: 16px;'>Muốn thêm chap? Nhấn vào nút dưới đây:</p>";

    // Form Thêm chap
    echo "<form action='newchap.php' method='get' style='display: inline-block; margin-top: 10px; margin-right: 10px;'>";
    echo "<input type='submit' value='Thêm chap' id='nut' class='button-style'>";
    echo "</form>";

    // Form Quay lại
    echo "<form action='bangchon.php' method='get' style='display: inline-block; margin-top: 10px;'>";
    echo "<input type='submit' value='Quay lại' id='nut' class='button-style'>";
    echo "</form>";

    echo "</div>";
} else {
    echo "Lỗi: " . $conn->error;  // Hiển thị lỗi cụ thể
}
} else {
echo "<div style='font-family: Arial, sans-serif; text-align: center; padding: 20px;'>";
echo "<p style='color: red; font-size: 16px;'>Dữ liệu không hợp lệ. Vui lòng kiểm tra lại!</p>";
echo "</div>";
}

// Đóng kết nối
$conn->close();
?>

<style>
    .button-style {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease; /* Thêm hiệu ứng chuyển màu nền khi hover */
    }

    .button-style:hover {
        background-color: #0056b3; /* Màu nền khi hover */
    }
</style>
