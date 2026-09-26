<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // db에서 중복 아이디 검사
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('이미 존재하는 아이디입니다.');</script>";
    } else {
        // users 테이블에 INSERT
        $insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $insert_query)) {
            echo "<script>alert('회원가입 성공!'); location.href='login.php';</script>";
        } else {
            echo "<script>alert('회원가입 실패.');</script>";
        }
    }
}
?>

<h2>회원가입</h2>
<form method="POST" action="">
    <input type="text" name="username" placeholder="아이디를 입력하세요" required>
    <input type="password" name="password" placeholder="비밀번호를 입력하세요" required>
    <button type="submit">회원가입</button>
</form>

<?php include "includes/footer.php"; ?>