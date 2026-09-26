<?php include "includes/header.php"; ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 세션 값 삭제 및 파기
session_unset();
session_destroy();

echo "<script>alert('로그아웃 되었습니다.'); location.href='index.php';</script>";
?>
<?php include "includes/footer.php"; ?>