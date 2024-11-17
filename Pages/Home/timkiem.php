<link rel="stylesheet" href="../../assets/css/content.css">
<link rel="stylesheet" href="../../assets/css/timkiem.css">
<link rel="stylesheet" href="../../assets/fontawesome-free-6.6.0/css/all.min.css">
<script src="../../assets/js/jquery-3.7.1.min.js"></script>

<?php session_start(); 
include("../../QL_taikhoan/config.php");

if (isset($_GET['timkiem'])) {
    $timkiem = $_GET['timkiem'];

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
        <div class="khungtruyen">

            <div class="format-khungtruyen">
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
                    </div>
                <?php } ?>
                        
                </div>
            </div>
        </div>
    </div>

<!-- include footer -->
<?php include("../../Pages/Home/footer.php") ?>

<style>

.tenTruyen {
    font-size: 16px; /* Chỉnh font chữ */
    font-weight: bold;
    white-space: nowrap; /* Đảm bảo tên truyện không xuống dòng */
    overflow: hidden; /* Cắt bỏ phần tên truyện thừa */
    text-overflow: ellipsis; /* Thêm dấu ba chấm khi tên truyện quá dài */
    width: 200px; /* Điều chỉnh chiều rộng của phần tên truyện, có thể thay đổi tùy ý */
    display: block; /* Đảm bảo phần tử hiển thị như block để sử dụng các thuộc tính trên */
    text-align: center;
    margin: auto;
}
</style>