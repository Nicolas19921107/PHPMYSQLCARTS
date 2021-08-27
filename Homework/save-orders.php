<?php include __DIR__ . '/phphtml/init.php';

$pKeys = array_keys($_SESSION['cart']);

$rows = []; // 預設值
$data_ar = []; // dict

// 有登入才能結帳
if (!isset($_SESSION['user'])) {
    header('Location: product-list.php');
    exit;
}

// echo json_encode($_SESSION['user']['account'], JSON_UNESCAPED_UNICODE);
// exit;

if (!empty($pKeys)) {
    $sql = sprintf("SELECT * FROM `products_food` WHERE product_id IN('%s')", implode("','", $pKeys));
    $rows = $pdo->query($sql)->fetchAll();
    $total = 0;
    foreach ($rows as $r) {
        $r['quantity'] = $_SESSION['cart'][$r['product_id']];
        $data_ar[$r['product_id']] = $r;
        $total += $r['quantity'] * $r['price'];
    }
} else {
    header('Location: product-list.php');
    exit;
}

$o_sql = "INSERT INTO `order_list`(`Customer_Id`, `Order_Total`, `order_date`) VALUES (?, ?, NOW())";
$o_stmt = $pdo->prepare($o_sql);
$o_stmt->execute([
    $_SESSION['user']['account'],
    $total,
]);

$order_sid = $pdo->lastInsertId(); // 最近新增資料的 PK

$od_sql = "INSERT INTO `order_detail`(`Order_Sid`, `Product_Sid`, `price`, `Order_Amount`) VALUES (?, ?, ?, ?)";
$od_stmt = $pdo->prepare($od_sql);

foreach ($_SESSION['cart'] as $p_sid => $qty) {
    $od_stmt->execute([
        $order_sid,
        $p_sid,
        $data_ar[$p_sid]['price'],
        $qty,
    ]);
}

unset($_SESSION['cart']); // 清除購物車內容

?>

<?php include __DIR__ . '/phphtml/head.php'; ?>
<?php include __DIR__ . '/phphtml/navbar.php'; ?>

<div class="container">
    <div class="alert alert-success" role="alert">
        感謝訂購 <?= $order_sid ?>
    </div>

    <?php include __DIR__ . '/phphtml/footer.php'; ?>
    <?php include __DIR__ . '/phphtml/script.php'; ?>