<link rel="stylesheet" href="../../assets/css/content.css">
<link rel="stylesheet" href="../../assets/css/wraper.css">

<div class="main-container">
    <?php 
        

        // Số lượng truyện trên mỗi trang
        $sd = 8;

        // Truy vấn tổng số truyện
        $sl = "SELECT * FROM chaptruyen";
        $kq = mysqli_query($conn, $sl);
        $tsp = mysqli_num_rows($kq);

        // Tính tổng số trang
        $tst = ceil($tsp / $sd);

        // Tính trang hiện tại
        if (isset($_GET['page'])) $page = $_GET['page']; else $page = 1;

        // Tính vị trí lấy truyện
        $vt = ($page - 1) * $sd;

        // Truy vấn lấy các truyện theo trang
        $sl2 = "SELECT * FROM chaptruyen ORDER BY Ngay_CN DESC LIMIT $vt, $sd";
        $new = mysqli_query($conn, $sl2);

        // Kiểm tra kết quả truy vấn
        if (!$new) {
            die("Query failed: " . mysqli_error($conn));
        }


        $toptuan=mysqli_query($conn,"SELECT IDtruyen, Ten_truyen, view 
                                        FROM truyen 
                                        ORDER BY view DESC 
                                        LIMIT 10;
                                        ")
    ?>

    <div class="content">
        <div class="format-khungtruyen">
            <div class="head">
                <p class="title">Truyện mới cập nhật</p>
            </div>
            <div class="truyen">
                <?php while ($d = mysqli_fetch_array($new)) { 
                    $idtruyen = $d['IDtruyen'];
                    // Truy vấn kiểm tra chap mới nhất
                    $slhinhanh = "SELECT Ten_truyen, hinhanh FROM truyen WHERE IDtruyen = $idtruyen";
                    $hinhanh = mysqli_query($conn, $slhinhanh);
                    $c = mysqli_fetch_array($hinhanh);
                ?>
                    <div class="khung">
                        <img src="../../assets/picture/<?php echo htmlspecialchars($c['hinhanh']); ?>" alt="Hình ảnh"/>
                        <div class="tentruyen">
                            <a href="../../Pages/Truyen/intro.php?id=<?php echo $d['IDtruyen']; ?>" class="tenTruyen">
                                <?php echo htmlspecialchars($c['Ten_truyen']); ?>
                            </a>
                        </div>
                        <div class="tenChuong">
                            <a href="../../Pages/Truyen/Story-Page.php?id=<?php echo $d['ChapID']; ?>" class="tenChuong">
                                Chap <?php echo htmlspecialchars($d['STT']); ?>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div id="wraper">
        <div id="top-wraper">
            Truyện top tuần
            <i class="fa-solid fa-fire"></i>
        </div>
        <div class="data-wraper">
            <ul>
                <?php 
                $dem=1;
                while($top=mysqli_fetch_array($toptuan)){?>
                    <li>
                    <span class="radius" ><?php echo $dem++; ?></span>
                    <a href="../../Pages/Truyen/intro.php?id=<?php echo $top['IDtruyen']; ?>" ><?php echo $top['Ten_truyen']; ?></a>
                </li>
                <?php } ?>
                
            
            </ul>
        </div>
    </div>
</div>
<div class="pagination">
    <p>
        <!-- Nút Trang trước -->
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">Trang trước</a>
        <?php else: ?>
            <span class="disabled">Trang trước</span>
        <?php endif; ?>

        <!-- Hiển thị các số trang -->
        <?php 
            for ($i = 1; $i <= $tst; $i++) {
                if ($page == $i) {
                    echo "<span class='pnow'>$i</span> ";
                } else {
                    echo "<a href='?page=$i'>$i</a> ";
                }
            }
        ?>

        <!-- Nút Trang tiếp theo -->
        <?php if ($page < $tst): ?>
            <a href="?page=<?php echo $page + 1; ?>">Trang tiếp theo</a>
        <?php else: ?>
            <span class="disabled">Trang tiếp theo</span>
        <?php endif; ?>
    </p>
</div>

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
    /* Phân trang chính */
.pagination {
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
}

/* Nút phân trang (Trang trước, Trang tiếp theo, và các số trang) */
.pagination a {
    font-size: 16px;
    color: black; 
    background-color: white;
    padding: 8px 12px;
    margin: 0 5px;
    text-decoration: none;
    border: 1px solid #007bff; /* Viền của nút */
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

/* Khi di chuột qua các nút phân trang */
.pagination a:hover {
    background-color: #0056b3; /* Màu nền khi hover (xanh đậm hơn) */
    color: #fff; /* Màu chữ khi hover */
}

/* Kiểu cho trang hiện tại */
.pnow {
    font-size: 18px;
    font-weight: bold;
    color: #fff;
    background-color: #28a745; /* Màu nền khi chọn trang (xanh lá) */
    padding: 8px 12px;
    border-radius: 5px;
}

/* Kiểu cho nút Trang trước và Trang tiếp theo khi vô hiệu (disabled) */
.pagination .disabled {
    color: #ccc;
    background-color: #f0f0f0; /* Màu nền khi vô hiệu */
    border: 1px solid #ddd; /* Viền mờ */
    padding: 8px 12px;
    border-radius: 5px;
}

/* Thêm khoảng cách giữa các nút */
.pagination a, .pagination .pnow, .pagination .disabled {
    margin: 0 5px;
}
</style>