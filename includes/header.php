<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>쇼핑몰</title>
</head>
<body>

<h1><a href="index.php">쇼핑몰</a></h1>

<?php if(isset($_SESSION['user'])) { ?>
    <a href="mypage.php">마이페이지</a>
    <a href="logout.php">로그아웃</a>
<?php } else { ?>
    <a href="login.php">로그인</a>
<?php } ?>

<hr>