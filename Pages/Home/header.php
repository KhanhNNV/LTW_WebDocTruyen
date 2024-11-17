<link rel="stylesheet" href="../../assets/css/header.css" />
<?php 
    if(!isset($_SESSION['login'])){
        header("Location: ../../QL_taikhoan/login.php ");
    }
?>
 <style>
    #login {
        display: block;
        z-index: 3;
    }

    #login a {
        border-radius: 0;
    }

    #login a:hover {
        background-color: #80d4ff;
    }
    </style>

<div id="header">
        <div id="logo">
            <img src="../../assets/picture/logo.png" alt="logo">
        </div>
        <ul id="nav">
            <li><a href="../../User/index.php" class="">
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
                while ($row_TL = mysqli_fetch_assoc($result_TL)) { ?>
                    <li><a href="/Pages/Truyen/trangTheLoai.php?idTL=<?php echo $row_TL['IDThe_loai'] ?>"> <?php echo $row_TL['Ten_TL'];?> </a></li>
                <?php }
                ?>
                </ul>

            </li>
            <li>
                <a href="/Pages/Truyen/favorite.php" class="toggle">
                    <i class="fa-solid fa-heart"></i>
                    Yêu thích
                </a>
            </li>
            
        </ul>

        <div class="search">
            <form action="/Pages/Home/timkiem.php" method="get">
                <input name="timkiem" class="search-input" type="search" placeholder="Tìm kiếm..." />
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

        </div>
        <div id="login">
            <a href="#"><?php echo $_SESSION['login'] ?><i class="fa-solid fa-circle-user"></i></a>
            <a href="../../QL_taikhoan/logout.php" id="logout" class="toggle" style="display: none;">Đăng xuất</a>
        </div>

        <script>
        $(document).ready(function() {
            $("#login a:first").click(function(event) {
                event.preventDefault();
                $(".toggle").toggle();
            });
        });
        </script>
    </div>