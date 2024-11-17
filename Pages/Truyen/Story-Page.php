<?php session_start(); 
    include("../../QL_taikhoan/config.php");
    if(isset($_GET['id'])){
        $ChapID=$_GET['id'];
        $kq=mysqli_query($conn,"SELECT * FROM chaptruyen where ChapID=$ChapID");
        $row=mysqli_fetch_array($kq);
        $IDtruyen=$row['IDtruyen'];
        $kq2=mysqli_query($conn,"SELECT * FROM truyen where IDtruyen=$IDtruyen");
        $row2=mysqli_fetch_array($kq2);

        // Tìm chương trước
        $previousQuery = mysqli_query($conn, "SELECT ChapID FROM chaptruyen WHERE IDtruyen = $IDtruyen AND ChapID < $ChapID ORDER BY ChapID DESC LIMIT 1");
        $previousRow = mysqli_fetch_array($previousQuery);
        $previousChapID = $previousRow ? $previousRow['ChapID'] : null;

        // Tìm chương sau
        $nextQuery = mysqli_query($conn, "SELECT ChapID FROM chaptruyen WHERE IDtruyen = $IDtruyen AND ChapID > $ChapID ORDER BY ChapID ASC LIMIT 1");
        $nextRow = mysqli_fetch_array($nextQuery);
        $nextChapID = $nextRow ? $nextRow['ChapID'] : null;


        $kq3=mysqli_query($conn,"SELECT * FROM chaptruyen where IDtruyen=$IDtruyen");
    }else {
            echo "Không tìm thấy chương truyện.";
            exit;  // Ngừng thực thi nếu không có dữ liệu
    }
?>
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
                <li><a href="../../User/index.php">Home</a></li>
                <li><a href="../Truyen/intro.php?id=<?php echo $row2['IDtruyen']; ?>"><?php echo $row2['Ten_truyen'] ?></a></li>
                <li>Chương <?php echo $row['STT']; ?></li>
            </ul>
        </div>

        <div id="header1">
            <?php echo $row2['Ten_truyen']; ?>
            <br>
            <?php echo $row['Tieu_de']; ?>
        </div>
        <div class="nav-buttons">
        <?php if ($previousChapID) { ?>
            <button class="next" onclick="window.location.href = '../Truyen/Story-Page.php?id=<?php echo $previousChapID; ?>'">Trang
                trước</button>
            <?php } else { ?>
            <button class="disabledNext" disabled>Trang trước</button>
            <?php } ?>
            <div class="menu">
                
                <i class="fa-solid fa-bars"></i>

                <select name="Chuong" onchange="window.location.href = '../Truyen/Story-Page.php?id=' + this.value;">
                    <?php 
                     mysqli_data_seek($kq3, 0);
                     while ($row3 = mysqli_fetch_array($kq3)) { ?>
                        <option value="<?php echo $row3['ChapID']; ?>"
                            <?php if ($ChapID == $row3['ChapID']) echo 'selected="selected"'; ?>>
                            Chương <?php echo $row3['STT']; ?>:
                            <?php echo $row3['Tieu_de']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <?php if ($nextChapID) { ?>
            <button class="next" onclick="window.location.href = '../Truyen/Story-Page.php?id=<?php echo $nextChapID; ?>'">Trang
                sau</button>
            <?php } else { ?>
            <button class="disabledNext" disabled>Trang sau</button>
            <?php } ?>
        </div>
        <div class="content">
           <?php echo $row['Noi_dung']; ?>
        </div>
        <div class="nav-buttons">
        <?php if ($previousChapID) { ?>
            <button class="next" onclick="window.location.href = '../Truyen/Story-Page.php?id=<?php echo $previousChapID; ?>'">Trang
                trước</button>
            <?php } else { ?>
            <button class="disabledNext" disabled>Trang trước</button>
            <?php } ?>

            <div class="menu">
                <i class="fa-solid fa-bars"></i>
                <select name="Chuong" onchange="window.location.href = '../Truyen/Story-Page.php?id=' + this.value;">
                    <?php 
            mysqli_data_seek($kq3, 0);
            while ($row3 = mysqli_fetch_array($kq3)) { ?>
                    <option value="<?php echo $row3['ChapID']; ?>"
                        <?php if ($ChapID == $row3['ChapID']) echo 'selected="selected"'; ?>>
                        Chương <?php echo $row3['STT']; ?>:
                        <?php echo $row3['Tieu_de']; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>

            <?php if ($nextChapID) { ?>
            <button class="next" onclick="window.location.href = '../Truyen/Story-Page.php?id=<?php echo $nextChapID; ?>'">Trang
                sau</button>
            <?php } else { ?>
            <button class="disabledNext" disabled>Trang sau</button>
            <?php } ?>
        </div>

        <div class="clear"></div>


    </div>

    <!-- include footer -->
    <?php include("../Home/footer.php")?>
</body>

</html>