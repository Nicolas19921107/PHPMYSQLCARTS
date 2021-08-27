<?php include __DIR__ . '/phphtml/init.php';

header('Content-Type: application/json');

$sid = isset($_GET['sid']) ? strval($_GET['sid']) : '0';
$qty = isset($_GET['qty']) ? intval($_GET['qty']) : 0;

if (!empty($sid)) {
    // 判斷有沒有那個商品

    if (!empty($qty)) {
        // 新增或修改
        $_SESSION['order'][$sid] = $qty;
    } else {
        // 移除
        unset($_SESSION['order'][$sid]);
    }
} 
