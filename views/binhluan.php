<?php
session_start();
require_once '../model/pdo.php';
require_once '../model/model_binhluan.php';

if (isset($_REQUEST["data"])) {
    $id = $_REQUEST["data"];
}

if (isset($_POST['btnSubmit'])) {
    $text      = $_POST["inputComment"];
    $userId    = $_SESSION["user"]["user_id"];
    $productId = $_POST["idsp"];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date      = date("Y-m-d H:i:s");
    insert_binhluan($text, $userId, $productId, $date);
    header('Location:'. $_SERVER['HTTP_REFERER']);
}

$listComments = select_binhluan($id);

foreach ($listComments as $item) {
    extract($item);
    echo '
        <div class="dialogbox col-10 has-comment">
            <div class="dialogbox-content shadow-sm">
                <div class="fw-bold text-primary">'.$user_name.'</div>
                <span class="fst-italic text-black-50">'.$comment_date.'</span>
                <span class="tip tip-left"></span>
                <div class="message mt-2">
                    <span>'.$comment_text.'</span>
                </div>
            </div>
        </div>
    ';
}
?>

<!-- Modal -->
<?php if (isset($_SESSION["user"]) && (is_array($_SESSION["user"]))) { ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold fs-5" id="exampleModalLabel">Viết bình luận 📝</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="modal-body">
                        <div class="form-floating">
                            <textarea name="inputComment" class="form-control fs-5" id="floatingTextarea2" placeholder="" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">
                                <span class="text-primary"><?= $_SESSION["user"]["user_name"] ?></span>
                                ơi, Bạn đang nghĩ gì thế?
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="btnSubmit" class="btn btn-primary">Đăng</button>
                    </div>
                    <input type="hidden" name="idsp" value="<?= $id ?>">
                </form>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Thông báo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fw-semibold">
                Vui lòng đăng nhập trước!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <a href="index.php" class="btn btn-primary">Đăng nhập ngay</a>
            </div>
            </div>
        </div>
    </div>
<?php } ?>