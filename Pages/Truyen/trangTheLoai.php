<link rel="stylesheet" href="../../assets/css/content.css">
<link rel="stylesheet" href="../../assets/css/timkiem.css">
<link rel="stylesheet" href="../../assets/fontawesome-free-6.6.0/css/all.min.css">
<script src="../../assets/js/jquery-3.7.1.min.js"></script>

<?php session_start(); 
include("../../QL_taikhoan/config.php");

if (isset($_GET['idTL'])) {
    $theloai = $_GET['idTL'];
    $kq = mysqli_query($conn,  "SELECT * FROM category WHERE IDThe_loai =$theloai ");
    $row = mysqli_fetch_array($kq);
}
?>
<?php include("../../Pages/Home/header.php") ?>

<?php include("../../Pages/Home/left-menu.php") ?>

<script src="assets/js/slideshow.js"></script>

<div class="main-container">
    <div class="khungtruyen">
        <div class="format-khungtruyen">
            <div class="head">
                <p class="title"><?php echo $row['Ten_TL'] ?></p>
            </div>
            <div class="truyen">
                <?php  
                $kqTruyen = mysqli_query($conn, "SELECT * FROM truyen WHERE IDThe_loai = $theloai"); 
                while ($row2 = mysqli_fetch_array($kqTruyen)) { ?>
                    <div class="khung">
                        <img src="../../assets/picture/<?php echo $row2['hinhanh']; ?>" />
                        <div class="tentruyen">
                            <a href="../../Pages/Truyen/intro.php?id=<?php echo $row2['IDtruyen']; ?>"><?php echo $row2['Ten_truyen']; ?></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include("../../Pages/Home/footer.php") ?>

<style>
.tenTruyen {
    font-size: 16px; 
    font-weight: bold;
    white-space: nowrap; 
    overflow: hidden; 
    text-overflow: ellipsis; 
    width: 200px; 
    display: block; 
    text-align: center;
    margin: auto;
}
</style>
