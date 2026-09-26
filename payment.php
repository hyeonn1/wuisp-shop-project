<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php
$user_id = $_SESSION['user_id'];

$query = "
SELECT products.name, products.price 
FROM cart 
JOIN products ON cart.product_id = products.id 
WHERE cart.user_id = $user_id
";

$result = mysqli_query($conn, $query);

$total_price = 0;
$products = [];
?>

<h2>결제 페이지</h2>

<ul>
<?php while ($row = mysqli_fetch_assoc($result)) { 
    $total_price += $row['price'];
    $products[] = $row['name'];
?>
    <li><?php echo $row['name']; ?> - <?php echo $row['price']; ?>원</li>
<?php } ?>
</ul>

<p>총 가격: <?php echo $total_price; ?>원</p>

<form action="order.php" method="POST">
    <input type="text" name="name" placeholder="이름 입력" required><br>
    <input type="text" name="address" placeholder="주소 입력" required><br>
    <input type="text" name="phone" placeholder="전화번호 입력" required><br>

    <select name="payment_method">
        <option value="card">카드</option>
        <option value="bank">무통장</option>
    </select><br>

    <button type="submit">결제하기</button>
</form>

<?php include "includes/footer.php"; ?>