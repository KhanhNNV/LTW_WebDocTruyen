<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Truyện Mới</title>
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
            margin-top: 20px;
            background-color: #fff;
            padding: 20px 30px;
            width: 400px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            color: #333;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
        }
        .form-group textarea {
            height: 80px;
        }
        #submit {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        #submit:hover {
            background-color: #0056b3;
        }
        .form-group #IDThe_loai {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: #fff;
            height: 36px;
        }
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: #fff;
            height: 36px;
        }
    </style>
</head>
<?php
include("../../QL_taikhoan/config.php");
?>
<body>
    <div class="form-container">
        <h2>Thêm Truyện Mới</h2>
        <form id="truyenForm" action="themtruyen.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Ten_truyen">Tên truyện</label>
                <input type="text" id="Ten_truyen" name="Ten_truyen">
            </div>
            <div class="form-group">
                <label for="IDThe_loai">Thể loại</label>
                <select name="IDThe_loai" id="IDThe_loai">
                    <?php
                        $sl1 = "select *from category";
                        $kq1 = mysqli_query($conn, $sl1);
                        while ($d1 = mysqli_fetch_array($kq1)) {
                    ?>
                    <option value="<?php echo $d1["IDThe_loai"]; ?>"><?php echo $d1["Ten_TL"]; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Tac_gia">Tác giả</label>
                <input type="text" id="Tac_gia" name="Tac_gia">
            </div>
            <div class="form-group">
                <label for="Tinh_trang">Tình trạng</label>
                <select name="Tinh_trang" id="Tinh_trang">
                    <option value="Đang cập nhật">Đang cập nhật</option>
                    <option value="Hoàn thành">Hoàn thành</option>
                    <option value="Tạm dừng">Tạm dừng</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Tom_tat_ND">Tóm tắt nội dung</label>
                <textarea id="Tom_tat_ND" name="Tom_tat_ND"></textarea>
            </div>
            <div class="form-group">
                <label for="hinhanh">Hình Ảnh</label>
                <input type="file" id="hinhanh" name="hinhanh">
            </div>
            <div class="form-group">
                <input type="submit" value="Thêm truyện" id="submit" name="themtruyen">
            </div>
        </form>
    </div>
</body>
</html>
