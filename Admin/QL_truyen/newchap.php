<?php
include("../../QL_taikhoan/config.php");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Chap Mới</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f0f0f5;
        height: 100vh;
        margin: 0;
    }
    .form-container {
        background-color: #ffffff;
        padding: 20px 30px;
        width: 100vw; /* Giữ chiều rộng toàn màn hình */
        height: 100vh; /* Giữ chiều cao toàn màn hình */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        border-radius: 0;
        box-sizing: border-box;
        overflow-y: auto; /* Đảm bảo cuộn dọc khi cần */
    }
    .form-container h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        color: #333;
        font-weight: bold;
        margin-bottom: 10px; /* Khoảng cách đồng đều */
        font-size: 14px;
    }
    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 10px; /* Đệm trong lớn hơn một chút */
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        box-sizing: border-box;
        transition: border-color 0.3s;
    }
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
    .form-group textarea {
        height: 120px; /* Chiều cao cố định cho các textarea */
        resize: none; /* Không cho phép thay đổi kích thước */
    }
    
    #submit {
    width: 50%; /* Giảm chiều ngang, chỉ chiếm 50% của container */
    padding: 8px; /* Giữ đệm trong */
    background-color: #007bff;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px; /* Kích thước chữ vừa phải */
    font-weight: bold;
    transition: background-color 0.3s, transform 0.2s;
    margin: 0 auto; /* Căn giữa nút trong container */
    display: block; /* Đảm bảo nút là khối để căn giữa */
    }
    #submit:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }
    #submit:active {
        background-color: #004085;
        transform: translateY(0);
    }

    /* Đảm bảo tất cả select có cùng kích thước */
    .form-container .form-group select {
        height: 42px;
    }
</style>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/basic/ckeditor.js"></script>
</head>
<body>
    <div class="form-container">
        <h2>Thêm Chap Mới</h2>
        <form id="truyenForm" action="themchap.php" method="post">
            <div class="form-group">
                <label for="ID_truyen">ID Truyện</label>
                <select name="ID_truyen" id="ID_truyen">
                <?php
                $sl1 = "SELECT IDtruyen, Ten_truyen FROM truyen";
                $kq1 = mysqli_query($conn, $sl1);
                if ($kq1) {
                    while ($d1 = mysqli_fetch_array($kq1)) {
                        echo "<option value='{$d1['IDtruyen']}'>{$d1['Ten_truyen']}</option>";
                    }
                } else {
                    echo "<option disabled>Lỗi khi tải danh sách truyện</option>";
                }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Tieu_de">Tiêu đề</label>
                <input type="text" id="Tieu_de" name="Tieu_de" required>
            </div>
            <div class="form-group">
                <label for="STT">Số thứ tự chap</label>
                <input type="text" id="STT" name="STT" required>
            </div>
            <div class="form-group">
                <label for="Noi_dung">Nội dung</label>
                <textarea id="Noi_dung" name="Noi_dung" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Thêm Chap" id="submit" name="themtruyen">
            </div>
        </form>
    </div>
    <script>
        CKEDITOR.replace('Noi_dung'); // Tích hợp CKEditor cho textarea
    </script>
</body>
</html>
