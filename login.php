<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // DB에서 사용자 조회 (아이디 + 비밀번호)
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];
        echo "<script>alert('로그인 성공!'); location.href='index.php';</script>";
    } else {
        echo "<script>alert('로그인 실패. 아이디 또는 비밀번호를 확인하세요.');</script>";
    }
}
?>

<h2>로그인</h2>
<form method="POST" action="">
    <input type="text" name="username" placeholder="아이디" required>
    <input type="password" name="password" placeholder="비밀번호" required>
    <button type="submit">로그인</button>
</form>

<?php include "includes/footer.php"; ?>