<?php 
    include("../../QL_taikhoan/config.php");
    session_start();
    if(isset($_GET['id'])){
        $IDtruyen=$_GET['id'];
        $kq=mysqli_query($conn,"SELECT * FROM truyen where IDtruyen=$IDtruyen");
        $row=mysqli_fetch_array($kq);  
        $_SESSION['story_id'] = $IDtruyen;
        $user_id = $_SESSION['user_id'];
        $category_id = $row['IDThe_loai'];
        $kq2 = mysqli_query($conn,"SELECT Ten_TL FROM category WHERE IDThe_loai = $category_id");
        $row2 = mysqli_fetch_array($kq2);

        
        $kq4=mysqli_query($conn,"SELECT ChapID,Tieu_de,STT FROM chaptruyen WHERE IDtruyen=$IDtruyen");
        

         // Tăng lượt xem
         $updateViewQuery = "UPDATE truyen SET view = view + 1 WHERE IDtruyen = $IDtruyen";
         mysqli_query($conn, $updateViewQuery);
  
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../assets/fontawesome-free-6.6.0/css/all.min.css">
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truyện</title>
    <link rel="stylesheet" href="../../assets/css/intro.css">
    <script src="../../assets/js/jquery-3.7.1.min.js"></script>

</head>

<body>

    <!-- include header -->
    <?php include("../Home/header.php")?>
    <!-- Main Content -->
    <!-- include leftmenu -->
    <?php include("../Home/left-menu.php") ?>
    <div class="main-content">
        <!-- Left Column -->
        <div class="left-column">
            <div><img src="../../assets/picture/<?php echo $row['hinhanh']; ?>" alt="Ảnh truyện" class="image-placeholder"></div>
            <div class="story-info">
                <p>-<i class="fa-sharp-duotone fa-solid fa-user"></i>Tác giả: <?php echo $row['Tac_gia'] ?></p>
                <p>-<i class="fa-sharp-duotone fa-solid fa-star"></i>Thể loại: <?php echo $row2['Ten_TL'] ?></p>
                <p>-<i class="fa-sharp-duotone fa-solid fa-earth-americas"></i>Tình trạng:<?php echo $row['Tinh_trang'] ?></p>
                <p>-<i class="fa-solid fa-eye"></i>Lượt xem:<?php echo $row['view'] ?></p>
            </div>
            
        </div>

        <!-- Center Content -->
        <div class="center-content">
            <div class="title">
                <h1><?php echo $row['Ten_truyen']; ?></h1>
            </div>
            <div class="buttons">
                <button id="ds"><i class="fa-sharp-duotone fa-solid fa-list"></i><a href="#danhsach"> Danh sách
                        truyện</a></button>

                        <form action="./add_favorite.php" method="POST">
                            <button id="like" type="submit" name="favorite">
                                <i class="fa-sharp-duotone fa-solid fa-heart"></i>
                                <?php 
                                    // Kiểm tra xem truyện đã yêu thích hay chưa để hiển thị văn bản phù hợp
                                    $result_check = mysqli_query($conn, "SELECT IDtruyen FROM yeuthich WHERE IDtruyen = '$IDtruyen' AND Id_User = '$user_id'");
                                    if (mysqli_num_rows($result_check) > 0) {
                                        echo "Bỏ yêu thích";
                                    } else {
                                        echo "Yêu thích";
                                    }
                                ?>
                            </button>
                        </form>

                <button id="chap1" >
                    <?php  $kq5=mysqli_query($conn,"SELECT ChapID,Tieu_de,STT FROM chaptruyen WHERE IDtruyen=$IDtruyen");
                            $row5=mysqli_fetch_array($kq5) ?>
                    <a href="../Truyen/Story-Page.php?id=<?php echo $row5['ChapID']; ?> " >
                        Đọc từ đầu
                    </a>
                </button>
            </div>
            <div class="summary">
                <p style="border-bottom: 1px solid black;"><b>Tóm tắt nội dung:</b></p>
                <p align="justify">
                    <?php echo $row['Tom_tat_ND']; ?>
                </p>

            </div>
        </div>
    </div>
    <!-- Chapter List -->
    <div class="chapter-list">
        <p size="14"><i class="fa-sharp-duotone fa-solid fa-list"></i><b><a name="danhsach">DANH SÁCH CHƯƠNG
                    TRUYỆN</a></b></p>
        <?php while($row4=mysqli_fetch_array($kq4)){ ?>
            <a href="../Truyen/Story-Page.php?id=<?php echo $row4['ChapID']; ?>">
                <div>Chương <?php echo $row4['STT'];?>: <?php echo $row4['Tieu_de']?></div>
            </a>
        <?php } ?>
        
    </div>

    <!-- include comment -->
     <div id="comment-all">
        <form id="comment-form" action="add_comment.php?id=<?php echo $IDtruyen; ?>" method="post">
            <div class="comment-section">
                <div class="comment">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div id="write">
                <input type="text" name="noidung" placeholder="Nhập bình luận" id="write">
                </div>
                <div id="actions">
                    <button id="submit-button" type="submit"><i class="fa-solid fa-paper-plane"></i> Gửi</button>
                    <!-- <button id="reset-button" type="reset">Reset</button> -->
                </div>
            </div>
        </form>
        <?php 
            include("comment.php");
        ?>
     </div>
    
    <!-- include footer -->
    <?php include("../Home/footer.php")?>
</body>

</html>