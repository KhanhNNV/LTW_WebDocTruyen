<?php
session_start();
include("../QL_taikhoan/config.php");

// Kiểm tra người dùng là Admin
if (!isset($_SESSION['login'])) {
    header("Location: ../../../QL_taikhoan/login.php"); 
    exit();
}

$sql_ds = "SELECT * FROM category";
$result_ds = mysqli_query($conn, $sql_ds);
$count_ds = mysqli_num_rows($result_ds);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="../assets/js/jquery-3.7.1.min.js"></script>

    <style>
    body {
        background-color: #f4f4f4;

        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        margin: auto;
        overflow: hidden;
    }

    header {
        background: #35424a;
        color: #ffffff;
        padding: 20px 0;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    nav {
        margin: 20px 0;
        text-align: center;
    }

    nav a {
        margin: 0 15px;
        padding: 10px 20px;
        background: #35424a;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        transition: background 0.3s;
    }

    nav a:hover {
        background: #45a049;
    }

    .dropdown {
        display: inline-block;
        position: relative;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .content {
        background: #ffffff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    h2 {
        color: #35424a;
        margin-bottom: 10px;
    }

    .form-section {
        display: none;
        /* Ẩn các phần này mặc định */
        margin-top: 20px;
    }

    .form-section input[type="text"] {
        width: calc(100% - 22px);
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-section button {
        padding: 10px 15px;
        background: #35424a;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .form-section button:hover {
        background: #45a049;
    }

    .message {
        margin: 10px 0;
        padding: 10px;
        border-radius: 5px;
    }

    .message.error {
        color: red;
        background-color: #f8d7da;
    }

    .message.success {
        color: green;
        background-color: #d4edda;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th,
    table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    table th {
        background-color: #35424a;
        color: white;
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table tr:hover {
        background-color: #ddd;
    }
    </style>
    <script>
    function showSection(section) {
        // Ẩn tất cả các phần
        document.querySelectorAll('.form-section').forEach(function(el) {
            el.style.display = 'none';
        });
        // Hiện phần được chọn
        document.getElementById(section).style.display = 'block';
    }
    </script>
</head>

<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>

    <div class="container">
        <nav>
            <!-- <a href="manage_accounts.php">Quản lý tài khoản</a> -->
            <a href="/Admin/QL_truyen/bangchon.php">Quản lý truyện</a>
            <div class="dropdown">
                <a href="#">Quản lý thể loại truyện</a>
                <div class="dropdown-content">
                    <a onclick="showSection('addCategory')" href="#">Thêm Thể Loại</a>
                    <a onclick="showSection('deleteCategory')" href="#">Xóa Thể Loại</a>
                </div>
            </div>
            <a href="../QL_taikhoan/logout.php">Đăng xuất</a>
            
        </nav>

        <div class="content">
            <h2>Chào mừng, <?php echo $_SESSION['login']; ?>!</h2>
            <p>Chọn một trong các danh mục bên trên để quản lý nội dung.</p>
        </div>

        <div id="addCategory" class="form-section">
            <h4>Thêm Thể Loại</h4>
            <form action="QL_theloai/add_category.php" method="POST">
                <input type="text" name="name" placeholder="Tên thể loại" required>
                <button type="submit" name="add_category">Thêm Thể Loại</button>
            </form>
        </div>

        <?php
        if (isset($_SESSION['./QL_theloai/add_category.php[error_add'])) {
            echo "<div class='message error'>" . $_SESSION['./QL_theloai/add_category.php[error_add'] . "</div>";
            unset($_SESSION['./QL_theloai/add_category.php[error_add']); 
        }
        if (isset($_SESSION["./QL_theloai/add_category.php['success_add']"]))  {
            echo "<div class='message success'>".$_SESSION["./QL_theloai/add_category.php['success_add']"]." </div>";
            unset($_SESSION["./QL_theloai/add_category.php['success_add']"]);  
        }
        ?>

        <div id="deleteCategory" class="form-section">
            <h4>Xóa Thể Loại</h4>
            <form action="QL_theloai/dele_category.php" method="POST">
                <input type="text" name="Ten_TL" placeholder="Tên thể loại cần xóa" required>
                <button type="submit" name="delete_category">Xóa Thể Loại</button>
            </form>
            <h4>Danh sách thể loại</h4>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Tên Thể Loại</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result_ds)) {
                    echo "<tr>";
                    echo "<td>". $row['IDThe_loai']. "</td>";
                    echo "<td>". $row['Ten_TL']. "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <?php 
        if (isset($_SESSION['error_dele'])) {
            echo "<div class='message error'>" . $_SESSION['error_dele'] . "</div>";
            unset($_SESSION['error_dele']); 
        }
        if (isset($_SESSION['success_dele'])) {
            echo "<div class='message success'>" . $_SESSION['success_dele'] . "</div>";
            unset($_SESSION['success_dele']);  
        }
        ?>
    </div>
</body>

</html>