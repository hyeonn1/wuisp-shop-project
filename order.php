<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php
$user_id = $_SESSION['user_id'];

$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];

// 장바구니 상품 가져오기
$query = "
SELECT products.name, products.price 
FROM cart 
JOIN products ON cart.product_id = products.id 
WHERE cart.user_id = $user_id
";

$result = mysqli_query($conn, $query);

$total_price = 0;
$product_names = [];

while ($row = mysqli_fetch_assoc($result)) {
    $total_price += $row['price'];
    $product_names[] = $row['name'];
}

// 상품 이름 문자열로 변환
$product_names_str = implode(", ", $product_names);

// 주문 저장
$insert = "
INSERT INTO orders (user_id, total_price, product_names, name, address, phone)
VALUES ($user_id, $total_price, '$product_names_str', '$name', '$address', '$phone')
";

mysqli_query($conn, $insert);

// 장바구니 삭제
$delete = "DELETE FROM cart WHERE user_id = $user_id";
mysqli_query($conn, $delete);

echo "<script>alert('결제 완료!'); location.href='mypage.php';</script>";
?>