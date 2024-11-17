<link rel="stylesheet" href="../../assets/css/comment.css">
<script src="../../assets/js/jquery-3.7.1.min.js"></script>
<?php 
    include("../../QL_taikhoan/config.php");
    if(isset($_GET['id'])){
        $IDtruyen=$_GET['id'];
        $kq=mysqli_query($conn,"SELECT * FROM comment 
        WHERE IDtruyen =$IDtruyen ORDER BY IDComment DESC" );
        
        
        
    }
?>




    <div id="comment-display">
        <h5> Danh Sách Bình Luận</h5>
        <div>
            <?php 
            while($row=mysqli_fetch_array($kq)){ ?>
                <div class="khungComment">
                    <?php 
                        $idUser = $row['Id_User'];
                        $userQuery = mysqli_query($conn, "SELECT Ten_User FROM user WHERE Id_User = $idUser");
                        $user = mysqli_fetch_array($userQuery);
                        echo "<strong>" . $user['Ten_User'] . ":</strong> " . $row['TextComment'] . "<br/>";
                    ?>
                </div>
            <?php } ?>
        </div>

    </div>

