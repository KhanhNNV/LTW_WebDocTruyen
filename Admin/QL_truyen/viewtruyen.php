<?php
include("../../QL_taikhoan/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_id = mysqli_real_escape_string($conn, $delete_id);
    $deleteQuery = "DELETE FROM truyen WHERE IDtruyen = '$delete_id'";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('Truyện đã được xóa thành công'); window.location.href='viewtruyen.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa truyện');</script>";
    }
}

$categoryQuery = "SELECT IDThe_loai, Ten_TL FROM category";
$categoryResult = mysqli_query($conn, $categoryQuery);
$selectedCategory = isset($_GET['theloai']) ? (int)$_GET['theloai'] : 0;
$sd = 5;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $sd;

if ($selectedCategory > 0) {
    $comicQuery = "SELECT * FROM truyen WHERE IDThe_loai = $selectedCategory LIMIT $start, $sd";
} else {
    $comicQuery = "SELECT * FROM truyen LIMIT $start, $sd";
}
$comicResult = mysqli_query($conn, $comicQuery);
$totalComicsQuery = $selectedCategory > 0
    ? "SELECT COUNT(*) FROM truyen WHERE IDThe_loai = $selectedCategory"
    : "SELECT COUNT(*) FROM truyen";
$totalComicsResult = mysqli_query($conn, $totalComicsQuery);
$totalComics = mysqli_fetch_row($totalComicsResult)[0];
$totalPages = ceil($totalComics / $sd);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Truyện</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef3f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .filter-form {
            text-align: center;
            margin-bottom: 20px;
        }

        #theloai {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f8f9fa;
            color: #333;
            width: 200px;
            appearance: none;
            background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="%23333"><polygon points="0,0 10,0 5,5"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
            cursor: pointer;
        }

        #theloai:hover {
            border-color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9f4ff;
        }

        img {
            width: 50px;
            height: 50px;
            border-radius: 4px;
        }

        .action-links {
            text-align: center;
            margin-top: 20px;
        }

        .add-link,
        .back-link,
        .btn-edit {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-link,
        .back-link {
            background-color: #007bff;
        }

        .add-link:hover,
        .back-link:hover {
            background-color: #0056b3;
        }

        .btn-edit {
            background-color: #28a745;
            font-size: 14px;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
        }

        .pagination .active {
            font-weight: bold;
            color: red;
        }

        .pagination .prev,
        .pagination .next {
            margin: 0 5px;
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #f8f9fa;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .pagination .prev:hover,
        .pagination .next:hover {
            background-color: #007bff;
            color: white;
        }

        .pagination .active {
            font-weight: bold;
            color: red;
            background-color: #e9f4ff;
        }

        .pagination .disabled {
            color: #ccc;
            cursor: not-allowed;
        }

        .pagination .prev.disabled,
        .pagination .next.disabled {
            background-color: #f8f9fa;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-delete:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        .btn-delete:focus {
            outline: none;
        }

        .btn-delete:active {
            background-color: #bd2130;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Danh sách truyện</h2>
        <form id="form_loc" name="form_loc" method="get" class="filter-form">
            <label for="theloai">Thể loại:</label>
            <select name="theloai" id="theloai" onChange="form_loc.submit()">
                <option value="0" <?php echo $selectedCategory == 0 ? 'selected' : ''; ?>>Tất cả</option>
                <?php while ($category = mysqli_fetch_array($categoryResult)) { ?>
                    <option value="<?php echo $category['IDThe_loai']; ?>" 
                        <?php if ($selectedCategory == $category['IDThe_loai']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($category['Ten_TL']); ?>
                    </option>
                <?php } ?>
            </select>
        </form>
        <table>
            <tr>
                <th>ID truyện</th>
                <th>Tên truyện</th>
                <th>Hình ảnh</th>
                <th>Thể loại</th>
                <th>Tác giả</th>
                <th>Tóm tắt</th>
                <th>Tình trạng</th>
                <th>Chỉnh sửa</th>
                <th>Xóa</th>
            </tr>
            <?php while ($comic = mysqli_fetch_array($comicResult)) { ?>
                <tr>
                    <td><?php echo $comic['IDtruyen']; ?></td>
                    <td><?php echo htmlspecialchars($comic['Ten_truyen']); ?></td>
                    <td><img src="../../assets/picture/<?php echo $comic['hinhanh']; ?>" alt="Hình ảnh truyện"></td>
                    <td><?php echo $comic['IDThe_loai']; ?></td>
                    <td><?php echo $comic['Tac_gia']; ?></td>
                    <td><?php echo $comic['Tom_tat']; ?></td>
                    <td><?php echo $comic['Tinh_trang']; ?></td>
                    <td><a href="edit.php?id=<?php echo $comic['IDtruyen']; ?>" class="btn-edit">Sửa</a></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="delete_id" value="<?php echo $comic['IDtruyen']; ?>">
                            <button type="submit" class="btn-delete">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <a href="?page=<?php echo $i; ?>&theloai=<?php echo $selectedCategory; ?>"
                   class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php } ?>
        </div>
        <div class="action-links">
            <a href="addtruyen.php" class="add-link">Thêm Truyện</a>
            <a href="../../admin.php" class="back-link">Quay lại</a>
        </div>
    </div>
</body>

</html>
