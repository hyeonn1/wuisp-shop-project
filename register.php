<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 선택 입력 (없으면 빈값)
    $name    = $_POST['name']    ?? "";
    $address = $_POST['address'] ?? "";
    $phone   = $_POST['phone']   ?? "";

    // 아이디 중복 체크
    $check_query  = "SELECT * FROM users WHERE username='$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('이미 존재하는 아이디입니다.');</script>";
    } else {
        // 회원가입 INSERT (선택값 포함)
        $insert_query = "
            INSERT INTO users (username, password, name, address, phone)
            VALUES ('$username', '$password', '$name', '$address', '$phone')
        ";

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
    아이디: <input type="text" name="username" placeholder="아이디를 입력하세요" required><br>
    비밀번호: <input type="password" name="password" placeholder="비밀번호를 입력하세요" required><br><br>

    <b>추가 정보 (선택 입력)</b><br>
    이름: <input type="text" name="name" placeholder="선택 입력"><br>
    주소: <input type="text" name="address" placeholder="선택 입력"><br>
    전화번호: <input type="text" name="phone" placeholder="선택 입력"><br><br>

    <button type="submit">회원가입</button>
</form>

<?php include "includes/footer.php"; ?>