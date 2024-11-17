<?php
// Kết nối cơ sở dữ liệu
include("../../QL_taikhoan/config.php");

// Kiểm tra nếu ID Chap được truyền vào để chỉnh sửa
if (isset($_GET['id'])) {
    $ChapID = $_GET['id'];
    // Lấy thông tin của chap cần sửa
    $sql = "SELECT * FROM chaptruyen WHERE ChapID = '$ChapID'";
    $result = mysqli_query($conn, $sql);
    $chap = mysqli_fetch_array($result);
}

// Cập nhật dữ liệu khi form được submit
if (isset($_POST['update'])) {
    $ChapID = $_POST['ChapID'];
    $Tieu_de = mysqli_real_escape_string($conn, $_POST['Tieu_de']);
    $STT = mysqli_real_escape_string($conn, $_POST['STT']);
    $Noi_dung = mysqli_real_escape_string($conn, $_POST['Noi_dung']);

    // Cập nhật thông tin chap
    $update_sql = "UPDATE chaptruyen SET 
                    Tieu_de = '$Tieu_de', 
                    STT = '$STT', 
                    Noi_dung = '$Noi_dung' 
                    WHERE ChapID = '$ChapID'";

    // Thực thi câu lệnh cập nhật
    if (mysqli_query($conn, $update_sql)) {
        header('Location: viewchap.php'); // Quay lại trang quản lý sau khi cập nhật thành công
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Chap Truyện</title>
    <style>
        /* CSS giống như trong file editcomic.php */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-size: 16px;
            margin-bottom: 8px;
            color: #555;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: #f9f9f9;
        }
        textarea { resize: vertical; }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button[type="submit"]:hover { background-color: #45a049; }
        .form-container { max-width: 800px; margin: 0 auto; }
        .message { color: green; text-align: center; font-weight: bold; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Sửa Chap Truyện</h2>
        <form method="post" action="editchap.php?ChapID=<?php echo $ChapID; ?>" enctype="multipart/form-data">
            <input type="hidden" name="ChapID" value="<?php echo htmlspecialchars($chap['ChapID']); ?>">

            <label for="Tieu_de">Tiêu đề</label>
            <input type="text" id="Tieu_de" name="Tieu_de" value="<?php echo htmlspecialchars($chap['Tieu_de']); ?>" required>

            <label for="STT">Số thứ tự chap</label>
            <input type="text" id="STT" name="STT" value="<?php echo htmlspecialchars($chap['STT']); ?>" required>

            <label for="Noi_dung">Nội dung</label>
            <textarea id="Noi_dung" name="Noi_dung" rows="5" required><?php echo htmlspecialchars($chap['Noi_dung']); ?></textarea>

            <button type="submit" name="update">Cập nhật</button>
        </form>
    </div>

    <script src="https://cdn.ckeditor.com/4.22.1/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('Noi_dung'); // Tích hợp CKEditor cho textarea
    </script>
</body>
</html>
