<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Bảng chọn</title>
    <style>
        /* Tổng thể */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Phần container chính */
        #main {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Tiêu đề */
        p {
            font-size: 24px;
            text-align: center;
            font-weight: bold;
            color: #333;
        }

        /* Các form */
        form {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Nút bấm */
        input[type="submit"] {
            padding: 10px 18px;  /* Giảm padding để làm nút nhỏ hơn */
            font-size: 14px;  /* Giảm font-size */
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%; /* Đảm bảo các nút bấm có chiều rộng bằng nhau */
            box-sizing: border-box; /* Đảm bảo padding và border không làm thay đổi chiều rộng */
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Cải thiện khoảng cách giữa các form */
        form:not(:last-child) {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div id="main">
        <p>Bảng chọn</p>
        <form action="viewtruyen.php">
            <input type="submit" value="Quản lý truyện">
        </form>
        <form action="viewchap.php">
            <input type="submit" value="Quản lý chap">
        </form>
        <form action="../index.php">
            <input type="submit" value="Về trang quản lý">
        </form>
    </div>
</body>
</html>
