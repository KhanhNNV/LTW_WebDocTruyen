<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Story Page</title>
    <link rel="stylesheet" href="../../assets/fontawesome-free-6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style-storypage.css">
    <script src="../../assets/js/jquery-3.7.1.min.js"></script>
</head>

<body>
    <!-- include header -->
    <?php include("../Home/header.php") ?>
    <div id="includedLeftMenu"></div>
    <!-- include leftmenu -->
    <?php include("../Home/left-menu.php")?>
    <div class="container">
        <div>
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/truyen/ten-truyen">Tên truyện</a></li>
                <li>Chap 1</li>
            </ul>
        </div>

        <div id="header1">
            Tiên Ngich<br>
            Chương 1 : dsfdsb
        </div>
        <div class="nav-buttons">
            <button>Trang trước</button>
            <div class="menu">
                <a href="#">
                    <i class="fa-solid fa-bars"></i>
                </a>
                <select name="Chuong">
                    <option>Chương 1</option>
                    <option>Chương 2</option>
                    <option>Chương 3</option>
                    <option>Chương 4</option>
                </select>
            </div>
            <button>Trang sau</button>
        </div>
        <div class="content">
            Nội dung truyện
        </div>
        <div class="nav-buttons">
            <button>Trang trước</button>
            <div class="menu">
                <a href="#">
                    <i class="fa-solid fa-bars"></i>
                </a>
                <select name="Chuong">
                    <option>Chương 1</option>
                    <option>Chương 2</option>
                    <option>Chương 3</option>
                    <option>Chương 4</option>
                </select>
            </div>
            <button>Trang sau</button>
        </div>

        <div class="clear"></div>


    </div>
    <!-- include comment -->
    <?php include("comment.php")?>
    <!-- include footer -->
    <?php include("../Home/footer.php")?>
</body>

</html>