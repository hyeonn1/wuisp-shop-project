<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>

<h2>전체 상품 목록</h2>
<ul>
<?php
// db에서 roducts 전체 조회
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // 반복문으로 출력
    while ($row = mysqli_fetch_assoc($result)) {
        // 각 상품마다 product.php?id=상품id 형태 링크 포함
        echo "<li><a href='product.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</a></li>";
    }
} else {
    echo "<li>등록된 상품이 없습니다.</li>";
}
?>
</ul>

<?php include "includes/footer.php"; ?>