<?php
$conn = mysqli_connect("localhost", "root", "", "shop_db");

if (!$conn) {
    die("DB 연결 실패");
}
?>