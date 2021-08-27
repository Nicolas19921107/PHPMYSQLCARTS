<?php include __DIR__ . '/phphtml/init.php';

$FoodKeys = array_keys($_SESSION['order']);
// echo json_encode($_SESSION['order'], JSON_UNESCAPED_UNICODE);
// exit;
$rows = []; // 預設值
$data_ar = []; // dict

// 有登入才能更新資料
if (!isset($_SESSION['user'])) {
    header('Location: index-home.php');
    exit;
}

if (!empty($FoodKeys)) {
    // $sql = sprintf("SELECT * FROM `products_food` WHERE product_id IN('%s')", implode("','", $FoodKeys));
    $sql = sprintf("SELECT od.*,ol.* FROM `order_detail` od LEFT JOIN `order_list` ol ON ol.Carts_id=od.Order_Sid WHERE od.Sid='%s'", implode(",", $FoodKeys));
    $rows = $pdo->query($sql)->fetchAll();
    // echo json_encode($rows, JSON_UNESCAPED_UNICODE);
    // exit;
    $total = 0;
    foreach ($rows as $r) {
        $r['quantity'] = $_SESSION['order'][$r['Sid']];
        $data_ar[$r['Sid']] = $r;
        $total += $r['quantity'] * $r['price'];
    }
    // echo json_encode($data_ar, JSON_UNESCAPED_UNICODE);
    // exit;

} else {
    header('Location: product-list.php');
    exit;
}
$o_sql = "UPDATE `order_list` SET `Order_Total`=?, `order_date`=NOW() WHERE `Carts_Id`=?";
$o_stmt = $pdo->prepare($o_sql);
$o_stmt->execute([
    // $_SESSION['user']['account'],
    $total,
    $data_ar[$FoodKeys[0]]['Carts_Id'],

]);
// echo json_encode($data_ar[$FoodKeys[0]]['Carts_Id'], JSON_UNESCAPED_UNICODE);
// exit;
// $order_sid = $pdo->lastInsertId(); // 最近新增資料的 PK

$od_sql = "UPDATE `order_detail` SET `Order_Amount`=? WHERE `Sid`=? ";
$od_stmt = $pdo->prepare($od_sql);
$od_stmt->execute([
    // $order_sid,
    // $p_sid,
    // $data_ar[$p_sid]['price'],
    $_SESSION['order'][$FoodKeys[0]],
    $data_ar[$FoodKeys[0]]['Carts_Id'],
]);


unset($_SESSION['order']); // 清除購物車內容

?>

<?php include __DIR__ . '/phphtml/head.php'; ?>
<?php include __DIR__ . '/phphtml/navbar.php'; ?>

<div class="container">
    <div class="alert alert-success" role="alert">
        已更改訂單資訊
    </div>

    <?php include __DIR__ . '/phphtml/footer.php'; ?>
    <?php include __DIR__ . '/phphtml/script.php'; ?>