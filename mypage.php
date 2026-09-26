<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php
$user_id = $_SESSION['user_id'];

// 회원정보 가져오기
$user_query = "SELECT * FROM users WHERE id = $user_id";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);

// 수정 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $update = "
    UPDATE users 
    SET name='$name', address='$address', phone='$phone'
    WHERE id=$user_id
    ";

    mysqli_query($conn, $update);

    echo "<script>alert('회원정보 수정 완료'); location.href='mypage.php';</script>";
}
?>

<h2>마이페이지</h2>

<h3>회원정보 수정</h3>
<form method="POST">
    <input type="text" name="name" value="<?php echo $user['name']; ?>" placeholder="이름"><br>
    <input type="text" name="address" value="<?php echo $user['address']; ?>" placeholder="주소"><br>
    <input type="text" name="phone" value="<?php echo $user['phone']; ?>" placeholder="전화번호"><br>
    <button type="submit">수정하기</button>
</form>

<hr>

<h3>주문 내역</h3>

<?php
$order_query = "SELECT * FROM orders WHERE user_id = $user_id";
$order_result = mysqli_query($conn, $order_query);

if (mysqli_num_rows($order_result) > 0) {
    while ($row = mysqli_fetch_assoc($order_result)) {
        echo "<div>";
        echo "주문번호: {$row['id']}<br>";
        echo "상품: {$row['product_names']}<br>";
        echo "총 가격: {$row['total_price']}원<br>";
        echo "이름: {$row['name']}<br>";
        echo "주소: {$row['address']}<br>";
        echo "전화번호: {$row['phone']}<br>";
        echo "<hr>";
        echo "</div>";
    }
} else {
    echo "주문 내역이 없습니다.";
}
?>

<?php include "includes/footer.php"; ?>