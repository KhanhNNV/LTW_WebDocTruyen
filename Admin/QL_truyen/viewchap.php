<?php
include("../../QL_taikhoan/config.php");
// Xử lý yêu cầu xóa chương
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ChapID'])) {
    $ChapID = (int)$_POST['ChapID']; // Lấy ChapID từ form
    $deleteQuery = "DELETE FROM chaptruyen WHERE ChapID = $ChapID";

    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('Xóa chương thành công!'); window.location.href = 'viewchap.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa chương: " . mysqli_error($conn) . "');</script>";
    }
}

// Lấy giá trị của bộ lọc truyện và trang hiện tại
$selectedComic = isset($_GET['comic_filter']) ? (int)$_GET['comic_filter'] : 0;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// Số chương trên mỗi trang
$chaptersPerPage = 10;

// Đếm tổng số chương phù hợp
$chapterCountQuery = $selectedComic
    ? "SELECT COUNT(*) as total FROM chaptruyen WHERE IDtruyen = $selectedComic"
    : "SELECT COUNT(*) as total FROM chaptruyen";
$resultCount = mysqli_query($conn, $chapterCountQuery);
$totalChapters = mysqli_fetch_assoc($resultCount)['total'];

// Tính tổng số trang
$totalPages = ceil($totalChapters / $chaptersPerPage);
if ($page > $totalPages) $page = $totalPages;

// Tính vị trí bắt đầu
$offset = ($page - 1) * $chaptersPerPage;

// Lấy dữ liệu chương
$chapterQuery = $selectedComic
    ? "SELECT * FROM chaptruyen WHERE IDtruyen = $selectedComic ORDER BY Ngay_CN DESC LIMIT $offset, $chaptersPerPage"
    : "SELECT * FROM chaptruyen ORDER BY Ngay_CN DESC LIMIT $offset, $chaptersPerPage";
$result = mysqli_query($conn, $chapterQuery);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Chương</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-size: 14px;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            background-color: #fff;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
        }
        h2 {
            text-align: center;
            color: #333;
            font-size: 20px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #ddd;
            font-size: 12px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
            font-size: 14px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn-edit {
            padding: 4px 8px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 12px;
            transition: background-color 0.3s;
        }
        .btn-delete {
            padding: 4px 8px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 12px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        .btn-add, .btn-back {
            padding: 6px 12px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            margin: 10px;
            cursor: pointer;
        }
        .btn-add:hover, .btn-back:hover {
            background-color: #0056b3;
        }
        .filter-form {
            text-align: center;
            margin-bottom: 15px;
        }
        #comic_filter {
            padding: 8px;
            font-size: 14px;
            width: 180px;
        }
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s;
        }
        .pagination a:hover {
            color: #0056b3;
        }
        .pnow {
            font-size: 16px;
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Danh sách các chương</h2>

        <!-- Nút Thêm Chương và Quay Lại -->
        <div style="text-align: center; margin:20px;">
            <a href="newchap.php?comic_filter=<?php echo $selectedComic; ?>" class="btn-add">Thêm chap mới</a>
            <a href="bangchon.php" class="btn-back">Quay Lại</a>
            <a href="viewtruyen.php" class="btn-back">Quản lý truyện</a>
        </div>

        <!-- Filter Form -->
        <form id="form_loc" name="form_loc" method="get" class="filter-form">
            <label for="comic_filter">Chọn Truyện:</label>
            <select name="comic_filter" id="comic_filter" onChange="form_loc.submit()">
                <option value="0">Tất cả</option>
                <?php
                $comicsQuery = "SELECT IDtruyen, Ten_truyen FROM truyen";
                $comicsResult = mysqli_query($conn, $comicsQuery);

                while ($comic = mysqli_fetch_assoc($comicsResult)) { ?>
                    <option value="<?php echo $comic['IDtruyen']; ?>"
                        <?php if ($selectedComic == $comic['IDtruyen']) echo 'selected'; ?>>
                        <?php echo $comic['Ten_truyen']; ?>
                    </option>
                <?php } ?>
            </select>
        </form>

        <!-- Chapter Table -->
        <table>
            <thead>
                <tr>
                    <th>ID Truyện</th>
                    <th>ID Chap</th>
                    <th>Tiêu Đề</th>
                    <th>Nội Dung</th>
                    <th>Ngày Cập Nhật</th>
                    <th>Chỉnh Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['IDtruyen']; ?></td>
                            <td><?php echo $row['ChapID']; ?></td>
                            <td><?php echo htmlspecialchars($row['Tieu_de']); ?></td>
                            <td><?php echo htmlspecialchars(substr($row['Noi_dung'], 0, 50)) . '...'; ?></td>
                            <td><?php echo htmlspecialchars($row['Ngay_CN']); ?></td>
                            <td>
                                <a href="editchap.php?id=<?php echo $row['ChapID']; ?>" class="btn-edit">Sửa</a>
                            </td>
                            <td>
                                <form method="post" action="viewchap.php" style="display:inline;">
                                    <input type="hidden" name="ChapID" value="<?php echo $row['ChapID']; ?>">
                                    <input type="submit" value="Xóa" onclick="return confirm('Bạn có chắc muốn xóa chương này?');" class="btn-delete">
                                </form>
                            </td>
                        </tr>
                    <?php }
                } else {
                    echo "<tr><td colspan='7'>Không có chương nào.</td></tr>";
                } ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?comic_filter=<?php echo $selectedComic; ?>&page=<?php echo $page - 1; ?>">« Trước</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php if ($i == $page): ?>
                    <span class="pnow"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?comic_filter=<?php echo $selectedComic; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($page < $totalPages): ?>
                <a href="?comic_filter=<?php echo $selectedComic; ?>&page=<?php echo $page + 1; ?>">Sau »</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
