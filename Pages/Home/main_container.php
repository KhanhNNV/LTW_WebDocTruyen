<link rel="stylesheet" href="../../assets/css/content.css">
<link rel="stylesheet" href="../../assets/css/wraper.css">

<div class="main-container">
    <?php 
        $sd = 8;
        $sl = "SELECT * FROM chaptruyen";
        $kq = mysqli_query($conn, $sl);
        $tsp = mysqli_num_rows($kq);
        $tst = ceil($tsp / $sd);
        if (isset($_GET['page'])) $page = $_GET['page']; else $page = 1;
        $vt = ($page - 1) * $sd;
        $sl2 = "SELECT * FROM chaptruyen ORDER BY Ngay_CN DESC LIMIT $vt, $sd";
        $new = mysqli_query($conn, $sl2);
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
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">Trang trước</a>
        <?php else: ?>
            <span class="disabled">Trang trước</span>
        <?php endif; ?>

        <?php 
            for ($i = 1; $i <= $tst; $i++) {
                if ($page == $i) {
                    echo "<span class='pnow'>$i</span> ";
                } else {
                    echo "<a href='?page=$i'>$i</a> ";
                }
            }
        ?>

        <?php if ($page < $tst): ?>
            <a href="?page=<?php echo $page + 1; ?>">Trang tiếp theo</a>
        <?php else: ?>
            <span class="disabled">Trang tiếp theo</span>
        <?php endif; ?>
    </p>
</div>

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
.pagination {
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
}

.pagination a {
    font-size: 16px;
    color: black; 
    background-color: white;
    padding: 8px 12px;
    margin: 0 5px;
    text-decoration: none;
    border: 1px solid #007bff;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.pagination a:hover {
    background-color: #0056b3;
    color: #fff;
}

.pnow {
    font-size: 18px;
    font-weight: bold;
    color: #fff;
    background-color: #28a745;
    padding: 8px 12px;
    border-radius: 5px;
}

.pagination .disabled {
    color: #ccc;
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    padding: 8px 12px;
    border-radius: 5px;
}

.pagination a, .pagination .pnow, .pagination .disabled {
    margin: 0 5px;
}
</style>
