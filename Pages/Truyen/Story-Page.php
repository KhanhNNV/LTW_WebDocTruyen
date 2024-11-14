<?php 
    include("../../QL_taikhoan/config.php");
    if(isset($_GET['id'])){
        $ChapID=$_GET['id'];
        $kq=mysqli_query($conn,"SELECT * FROM chaptruyen where ChapID=$ChapID");
        $row=mysqli_fetch_array($kq);
        $IDtruyen=$row['IDtruyen'];
        $kq2=mysqli_query($conn,"SELECT * FROM truyen where IDtruyen=$IDtruyen");
        $row2=mysqli_fetch_array($kq2);
        $kq3=mysqli_query($conn,"SELECT * FROM chaptruyen where IDtruyen=$IDtruyen");
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
                <li><?php echo $row['Tieu_de']; ?></li>
            </ul>
        </div>

        <div id="header1">
            <?php echo $row2['Ten_truyen']; ?>
            <br>
            <?php echo $row['Tieu_de']; ?>
        </div>
        <div class="nav-buttons">
            <button>Trang trước</button>
            <div class="menu">
                
                <i class="fa-solid fa-bars"></i>

                <select name="Chuong" onchange="window.location.href = '../Truyen/Story-Page.php?id=' + this.value;">
                    <?php while($row3=mysqli_fetch_array($kq3)){ ?>
                        <option value="<?php echo $row3['ChapID'] ?>"
                        <?php if(isset($_GET['id'])&&$_GET['id']==$row3['ChapID']) echo 'selected="selected"'; ?>>
                        <?php echo $row3['Tieu_de'] ;?></option>s
                    <?php } ?>
                </select>
            </div>
            <button>Trang sau</button>
        </div>
        <div class="content">
           <?php echo $row['Noi_dung']; ?>
        </div>
        <div class="nav-buttons">
            <button>Trang trước</button>
            <div class="menu">

                <i class="fa-solid fa-bars"></i>

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