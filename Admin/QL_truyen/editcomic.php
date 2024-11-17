<?php
include("../../QL_taikhoan/config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sl = "SELECT * FROM truyen WHERE IDtruyen = $id";
    $result = mysqli_query($conn, $sl);
    $d1 = mysqli_fetch_array($result);
}

// Cập nhật dữ liệu khi form được submit
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $ten_truyen = mysqli_real_escape_string($conn, $_POST['Ten_truyen']);
    $tac_gia = mysqli_real_escape_string($conn, $_POST['Tac_gia']);
    $the_loai = mysqli_real_escape_string($conn, $_POST['IDThe_loai']);
    $tom_tat = mysqli_real_escape_string($conn, $_POST['Tom_tat_ND']);
    $tinh_trang = mysqli_real_escape_string($conn, $_POST['Tinh_trang']);

    // Kiểm tra nếu người dùng tải lên một hình ảnh mới
    if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == 0) {
        // Xử lý ảnh mới
        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $hinhanh_name = time() . '_' . $hinhanh;
        $target_dir = "../../assets/picture/"; 
        $target_file = $target_dir . $hinhanh_name;
        
        
        // Di chuyển ảnh mới vào thư mục 'uploads'
        if (move_uploaded_file($hinhanh_tmp, $target_file)) {
            // Cập nhật thông tin truyện cùng với ảnh mới
            $update_sl = "UPDATE truyen SET 
                Ten_truyen = '$ten_truyen', 
                Tac_gia = '$tac_gia', 
                IDThe_loai = '$the_loai', 
                Tom_tat_ND = '$tom_tat', 
                hinhanh = '$hinhanh_name',
                Tinh_trang='$tinh_trang'
                WHERE IDtruyen = $id";
        }
    } else {
        // Cập nhật thông tin truyện mà không thay đổi ảnh
        $update_sl = "UPDATE truyen SET 
            Ten_truyen = '$ten_truyen', 
            Tac_gia = '$tac_gia', 
            IDThe_loai = '$the_loai', 
            Tom_tat_ND = '$tom_tat',
            Tinh_trang='$tinh_trang'
            WHERE IDtruyen = $id";
    }

    // Thực thi câu lệnh cập nhật
    if (mysqli_query($conn, $update_sl)) {
        header('Location: viewtruyen.php'); // Quay lại trang quản lý sau khi cập nhật thành công
        exit;
    } else {
        echo "Lỗi cập nhật: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa thông tin truyện</title>
    <style>
        /* Resetting some default styles */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; padding: 20px; max-width: 1200px; margin: 0 auto; }
        form { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; color: #4CAF50; margin-bottom: 20px; }
        label { display: block; font-size: 16px; margin-bottom: 8px; color: #555; margin-top: 10px;}
        input[type="text"], input[type="file"], textarea { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px; background-color: #f9f9f9; }
        textarea { resize: vertical; }
        button[type="submit"] { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; width: 100%; }
        button[type="submit"]:hover { background-color: #45a049; }
        img { max-width: 100%; height: auto; border-radius: 8px; margin-bottom: 15px; }
        @media screen and (min-width: 768px) { form { width: 50%; margin: 0 auto; } }
        select[name="Tinh_trang"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f9f9f9;
    color: #333;
    cursor: pointer;
    appearance: none;
    background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="%23333"><polygon points="0,0 10,0 5,5"/></svg>');
    background-repeat: no-repeat;
    background-position: right 10px center;
}

select[name="Tinh_trang"]:hover {
    border-color: #4CAF50;
}

select[name="Tinh_trang"]:focus {
    border-color: #4CAF50;
    outline: none;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
}

    </style>
</head>
<body>
    <h2>Sửa thông tin truyện</h2>
    <form method="post" action="editcomic.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($d1['IDtruyen']); ?>">

        <label>Tên truyện:</label>
        <input type="text" name="Ten_truyen" value="<?php echo htmlspecialchars($d1['Ten_truyen']); ?>">

        <label>Hình ảnh hiện tại:</label>
        <img src="../../assets/picture/<?php echo htmlspecialchars($d1['hinhanh']); ?>" alt="Hình ảnh" style="width: 100px; height: 100px;">

        <label>Chọn hình ảnh mới (nếu muốn thay đổi):</label>
        <input type="file" name="hinhanh">

        <label>Thể loại:</label>
        <input type="text" name="IDThe_loai" value="<?php echo htmlspecialchars($d1['IDThe_loai']); ?>">

        <label>Tác giả:</label>
        <input type="text" name="Tac_gia" value="<?php echo htmlspecialchars($d1['Tac_gia']); ?>">
        <label>Tình trạng:</label>
        <select name="Tinh_trang">
            <option value="Đang cập nhật" <?php if ($d1['Tinh_trang'] == 'Đang cập nhật') echo 'selected'; ?>>Đang cập nhật</option>
            <option value="Hoàn thành" <?php if ($d1['Tinh_trang'] == 'Hoàn thành') echo 'selected'; ?>>Hoàn thành</option>
            <option value="Tạm dừng" <?php if ($d1['Tinh_trang'] == 'Tạm dừng') echo 'selected'; ?>>Tạm dừng</option>
        </select>
        <label>Tóm tắt nội dung:</label>
        <textarea name="Tom_tat_ND" rows="5" cols="40"><?php echo htmlspecialchars($d1['Tom_tat_ND']); ?></textarea>

        <button type="submit" name="update">Cập nhật</button>
    </form>
</body>
</html>
