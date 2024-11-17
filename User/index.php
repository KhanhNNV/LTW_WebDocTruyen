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
    <?php include("../Pages/Home/header.php") ?>

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