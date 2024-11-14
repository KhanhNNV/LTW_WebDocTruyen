<link rel="stylesheet" href="../../assets/css/content.css">
<link rel="stylesheet" href="../../assets/fontawesome-free-6.6.0/css/all.min.css">
<script src="../../assets/js/jquery-3.7.1.min.js"></script>

<?php
include("../../QL_taikhoan/config.php");

if (isset($_GET['timkiem'])) {
    $timkiem = $_GET['timkiem'];
    
    // Bảo vệ chống SQL Injection
    $timkiem = mysqli_real_escape_string($conn, $timkiem);
    
    // Truy vấn tìm kiếm
    $sql_timkiem = "SELECT * FROM truyen WHERE Ten_truyen LIKE '%$timkiem%'";
    $query_timkiem = mysqli_query($conn, $sql_timkiem);
}
?>
 <?php include("../../Pages/Home/header.php") ?>


    <!-- include leftmenu -->
    <?php include("../../Pages/Home/left-menu.php") ?>

    <script src="assets/js/slideshow.js"></script>
    <!-- main-container -->
    <div class="main-container">
        <div class="content">

            <div class="truyenmoi">
                <div class="head">
                    <p class="title">Truyện tìm kiếm:</p>
                </div>
                <div class="truyen">
                <?php while ($row = mysqli_fetch_array($query_timkiem)) { ?>
                    <div class="khung">
                         
                        <img src="../../assets/picture/<?php echo $row['hinhanh']; ?>" />
                        <div class="tentruyen">
                            <a href="../../Pages/Truyen/intro.php?id=<?php echo $row['IDtruyen']; ?>" class="tenTruyen"><?php echo $row['Ten_truyen']; ?></a>
                        </div>
                        <div class="tenChuong">
                        <a href="#" class="tenChuong">Chương 1</a>
                        
                        </div>
                    </div>
                <?php } ?>
                        
                </div>
            </div>
        </div>
    </div>

<!-- include footer -->
<?php include("../../Pages/Home/footer.php") ?>

