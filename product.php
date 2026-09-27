<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>

<?php

if (!isset($_GET['id']) || $_GET['id'] === '') {
    exit('잘못된 접근입니다. 상품 id가 없습니다.')
}

$product_id = $_GET['id'];

$host = 'localhost';
$dbname = 'shop_db';
$user = 'root';     # DB 계정
$pass = '';     # DB 비밀번호
$charset = 'utf8mb4';

$sql = "SELECT id, name, price, FROM products WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id => $product_id']);
$product = $stmt->fetch();

if (!$product) {
    exit('해당 상품을 찾을 수 없습니다.');
}
?>

<!-- 화면에 상품 정보 출력 -->
<h1><?php echo htmlspecialchars($product['name']); ?></h1>
<p>가격: <?php echo number_format($product['price']); ?>원</p>

<!-- 장바구니 추가 버튼 -->
<form action="cart_add.php" method="post">
    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>
    <button type="submit">장바구니 추가</button>
</form>

<?php include "includes/footer.php"; ?>