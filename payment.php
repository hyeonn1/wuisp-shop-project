<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php
$user_id = $_SESSION['user_id'];

// 내 정보 가져오기 (버튼용)
$user_query = "SELECT * FROM users WHERE id = $user_id";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);

// 장바구니 조회
$query = "
SELECT products.name, products.price 
FROM cart 
JOIN products ON cart.product_id = products.id 
WHERE cart.user_id = $user_id
";

$result = mysqli_query($conn, $query);

$total_price = 0;
$product_names = [];
?>

<h2>결제 페이지</h2>

<ul>
<?php while ($row = mysqli_fetch_assoc($result)) { 
    $total_price += $row['price'];
    $product_names[] = $row['name'];
?>
    <li><?php echo $row['name']; ?> - <?php echo $row['price']; ?>원</li>
<?php } ?>
</ul>

<p>총 가격: <?php echo $total_price; ?>원</p>

<form action="order.php" method="POST">
    <input type="text" name="name" placeholder="이름 입력" required><br>
    <input type="text" name="address" placeholder="주소 입력" required><br>
    <input type="text" name="phone" placeholder="전화번호 입력" required><br>

    <button type="button" onclick="fillUserInfo()">내 정보 불러오기</button><br><br>

    <select name="payment_method">
        <option value="card">카드</option>
        <option value="bank">무통장</option>
    </select><br>

    <button type="submit">결제하기</button>
</form>

<script>
function fillUserInfo() {
    document.querySelector("input[name='name']").value = "<?php echo $user['name']; ?>";
    document.querySelector("input[name='address']").value = "<?php echo $user['address']; ?>";
    document.querySelector("input[name='phone']").value = "<?php echo $user['phone']; ?>";
}
</script>

<?php include "includes/footer.php"; ?>