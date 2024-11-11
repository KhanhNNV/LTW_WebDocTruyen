<?php session_start(); 
include("../QL_taikhoan/config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web đọc truyện</title>
    <link rel="stylesheet" href="../assets/fontawesome-free-6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/header.css" />
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
</head>

<body>

    <!-- include header -->
    <div id="header">
        <div id="logo">
            <img src="../assets/picture/logo.png" alt="logo">
        </div>
        <ul id="nav">
            <li><a href="../index.php" class="">
                    <i class="fa-solid fa-house"></i>
                    Trang chủ
                </a></li>
            <li>
                <a href="#" class="">
                    <i class="fa-solid fa-tag"></i>
                    Thể loại
                    <i class="fa-solid fa-caret-down"></i>
                </a>
                <ul class="subnav">
                    <?php
                // Lấy dữ liệu từ CSDL để hiển thị menu thể loại
                $sql_TL = "SELECT * FROM category ORDER BY Ten_TL ASC";
                $result_TL = mysqli_query($conn, $sql_TL);
                while ($row_TL = mysqli_fetch_assoc($result_TL)) {
                    echo '<li><a href="#" class="">'. $row_TL['Ten_TL']. '</a></li>';
                }
                ?>
                </ul>

            </li>
            <li>
                <a href="#" class="">
                    <i class="fa-solid fa-heart"></i>
                    Yêu thích
                </a>
            </li>
            <li>
                <a href="#" class="">
                    <i class="fa-solid fa-eye"></i>
                    Xem nhiều
                </a>
            </li>
            <li>
                <a href="#" class="">
                    <i class="fa-solid fa-upload"></i>
                    Mới đăng
                </a>
            </li>
        </ul>

        <div class="search">
            <form>
                <input class="search-input" type="search" placeholder="Tìm kiếm..." />
                <i class="fa-solid fa-magnifying-glass"></i>
            </form>

        </div>
        <div id="login">
            <a href="../../QL_taikhoan/logout.php" class=""><?php echo $_SESSION['login'] ?><i
                    class="fa-solid fa-circle-user"></i></a>
        </div>
    </div>

    <div id="main">
        <!-- include leftmenu -->
        <?php include("../Pages/Home/left-menu.php") ?>

        <!-- Slide show -->
        <?php include("../Pages/Home/slideshow.php") ?>

        <script src="../assets/js/slideshow.js"></script>
        <!-- main-container -->
        <?php include("../Pages/Home/main_container.php") ?>
    </div>

    <!-- include footer -->
    <?php include("../Pages/Home/footer.php") ?>

</body>

</html>