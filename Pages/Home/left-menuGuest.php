<link rel="stylesheet" href="../../assets/css/left-menu.css">
<script src="../../assets/js/left-menu.js"></script>
<div id="hamburger">
    <button id="toggle-menu" class="toggle-button">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div id="left-menu">
        <ul>
            <li><a href="../../index.php" class="">
                    <i class="fa-solid fa-house"></i>
                    Trang chủ
                </a></li>
            <li>
                <a href="#" class="dropdown-toggle">
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
        
    </div>
</div>