<?php
if(!isset($_SESSION['user'])) {
    echo "로그인이 필요합니다.";
    exit;
}
?>