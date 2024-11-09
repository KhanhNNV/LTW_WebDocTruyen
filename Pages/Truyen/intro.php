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
            <div><img src="/assets/picture/images.jfif" alt="Ảnh truyện" class="image-placeholder"></div>
            <div class="story-info">
                <p>-<i class="fa-sharp-duotone fa-solid fa-pen-to-square"></i>Tên khác: Bản hùng ca của trượng và kiếm
                </p>
                <p>-<i class="fa-sharp-duotone fa-solid fa-user"></i>Tác giả: Đang cập nhật</p>
                <p>-<i class="fa-sharp-duotone fa-solid fa-star"></i>Thể loại: Action-Comedy-Drama-Fantasy-Manga</p>
                <p>-<i class="fa-sharp-duotone fa-solid fa-bookmark"></i>Nhóm dịch: Đang cập nhật</p>
                <p>-<i class="fa-sharp-duotone fa-solid fa-earth-americas"></i>Tình trạng: Đang chập nhật</p>
            </div>
        </div>

        <!-- Center Content -->
        <div class="center-content">
            <div class="title">
                <h1>Wistoria: Wand and Sword</h1>
            </div>
            <div class="buttons">
                <button><i class="fa-sharp-duotone fa-solid fa-list"></i><a href="#danhsach"> Danh sách
                        truyện</a></button>
                <button style="background-color: red;"><i class="fa-sharp-duotone fa-solid fa-heart"></i> Yêu
                    thích</button>
                <button style="background-color: green;"> Đọc từ đầu</button>
            </div>
            <div class="summary">
                <p style="border-bottom: 1px solid black;"><b>Tóm tắt nội dung:</b></p>
                <p align="justify">
                    Will Serfort thề ước với bạn thuở nhỏ là sẽ trở thành Magia Vander,
                    là danh hiệu mạnh nhất đứng trên đỉnh của các pháp sư. Nhưng cậu lại
                    không hề sử dụng được phép thuật dù phép có đơn giản đến đâu.
                    Với kĩ năng sở trường là kiếm thuật,
                    cậu sẽ đối đầu pháp sư để đặt được danh hiệu đó.
                </p>

            </div>
        </div>
    </div>
    <!-- Chapter List -->
    <div class="chapter-list">
        <p size="14"><i class="fa-sharp-duotone fa-solid fa-list"></i><b><a name="danhsach">DANH SÁCH CHƯƠNG
                    TRUYỆN</a></b></p>
        <a href="Story-Page.php">
            <div>Chap truyện 1</div>
        </a>
        <a href="Story-Page.php">
            <div>Chap truyện 2</div>
        </a>
        <a href="Story-Page.php">
            <div>Chap truyện 3</div>
        </a>
        <a href="Story-Page.php">
            <div>Chap truyện 4</div>
        </a>
        <a href="Story-Page.php">
            <div>Chap truyện 5</div>
        </a>
    </div>

    <!-- include comment -->
    <?php include("comment.php")?>
    <!-- include footer -->
    <?php include("../Home/footer.php")?>
</body>

</html>