<link rel="stylesheet" href="../../assets/css/header.css" />
<div id="header">
    <div id="logo">
        <img src="../../assets/picture/logo.png" alt="logo">
    </div>
    <ul id="nav">
        <li><a href="../../index.php" class="">
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
        <form >
            <input class="search-input" type="text" placeholder="Tìm kiếm..." />
            <i class="fa-solid fa-magnifying-glass"></i>
            
        </form>

    </div>
    <div id="login">
        <a href="../../QL_taikhoan/login.php" class="">Đăng ký/Đăng nhập<i class="fa-solid fa-circle-user"></i></a>
    </div>
</div>