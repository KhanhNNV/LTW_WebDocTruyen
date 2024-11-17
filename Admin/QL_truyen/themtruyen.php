<?php
include("../../QL_taikhoan/config.php");
// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra dữ liệu từ form
if (isset($_POST['Ten_truyen']) && isset($_POST['IDThe_loai']) && isset($_POST['Tac_gia']) &&
    isset($_POST['Tinh_trang']) && isset($_POST['Tom_tat_ND']) && isset($_FILES['hinhanh'])) {

    // Lấy dữ liệu từ form và bảo vệ dữ liệu
    $Ten_truyen = $conn->real_escape_string($_POST['Ten_truyen']);
    $IDThe_loai = $conn->real_escape_string($_POST['IDThe_loai']);
    $Tac_gia = $conn->real_escape_string($_POST['Tac_gia']);
    $Tinh_trang = $conn->real_escape_string($_POST['Tinh_trang']);
    $Tom_tat_ND = $conn->real_escape_string($_POST['Tom_tat_ND']);
    
    // Xử lý ảnh
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $hinhanh_name = time() . '_' . $hinhanh; // Tạo tên file duy nhất
    $target_dir = "../../assets/picture/";
    $target_file = $target_dir . $hinhanh_name; // Đường dẫn lưu file

    if (move_uploaded_file($hinhanh_tmp, $target_file)) {
        // Chuẩn bị câu lệnh SQL để thêm dữ liệu vào cơ sở dữ liệu
        $sql = "INSERT INTO truyen (Ten_truyen, IDThe_loai, Tac_gia, Tinh_trang, Tom_tat_ND, hinhanh) 
                VALUES ('$Ten_truyen', '$IDThe_loai', '$Tac_gia', '$Tinh_trang', '$Tom_tat_ND', '$hinhanh_name')";

        // Thực thi câu lệnh SQL và kiểm tra kết quả
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
            echo "<p>Lỗi: " . $conn->error . "</p>";  // Hiển thị lỗi cụ thể
        }
    } else {
        echo "<p style='color: red;'>Không thể tải lên file ảnh. Vui lòng thử lại.</p>";
    }
} else {
    echo "<p style='color: red;'>Dữ liệu không hợp lệ. Vui lòng kiểm tra lại!</p>";
}

// Đóng kết nối
$conn->close();
?>