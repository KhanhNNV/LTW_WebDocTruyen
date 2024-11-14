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
            <a href="#" class="">Đăng ký/Đăng nhập<i class="fa-solid fa-circle-user"></i></a>
        </div>
    </div>
</div>