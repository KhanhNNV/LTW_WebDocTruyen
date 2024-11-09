<link rel="stylesheet" href="../../assets/css/comment.csss">

<script src="../../assets/js/jquery-3.7.1.min.js"></script>
<div id="comment-all">
    <form id="comment-form">
        <div class="comment-section">
            <div class="comment">
                <i class="fa-solid fa-user"></i>
            </div>
            <div id="write">
                <textarea id="comment-input" rows="5" cols="50" placeholder="Bình luận"></textarea>
            </div>
            <div id="actions">
                <button id="submit-button" type="submit"><i class="fa-solid fa-paper-plane"></i> Gửi</button>
                <!-- <button id="reset-button" type="reset">Reset</button> -->
            </div>
        </div>
    </form>
    <div id="comment-display">
        <h5> <i>Danh Sách Bình Luận</i></h5>

    </div>
    <script>
    document.getElementById("comment-form").addEventListener("submit", function(event) {
        event.preventDefault(); // Ngăn chặn hành động gửi mặc định của form

        // Lấy nội dung từ ô nhập liệu
        const commentInput = document.getElementById("comment-input");
        const commentText = commentInput.value.trim();

        // Kiểm tra nếu có nội dung mới hiển thị
        if (commentText) {
            // Tạo một phần tử mới để hiển thị bình luận
            const commentDisplay = document.getElementById("comment-display");
            const newComment = document.createElement("div");
            newComment.className = "comment-item";
            newComment.textContent = commentText;

            // Thêm bình luận mới vào khu vực hiển thị
            commentDisplay.appendChild(newComment);

            // Xóa nội dung trong ô nhập liệu sau khi gửi
            commentInput.value = "";
        }
    });
    </script>
</div>