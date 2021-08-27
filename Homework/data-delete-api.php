<?php include __DIR__ . '/phphtml/init.php';

$Order_Id = isset($_GET['Order_Id']) ? intval($_GET['Order_Id']) : 0;

$outputdata = [
    'success' => false,
    'error' => '沒有提供 Order_Id 的值',
    'Order_Id' => $Order_Id,
];
// 如果訂購單號為空值
if (empty($Order_Id)) {
    echo json_encode($outputdata, JSON_UNESCAPED_UNICODE);
}
// 如果存在訂購單號
else {
    $sqldelete = "DELETE FROM `order_list`WHERE Order_Id=$Order_Id";
    $sqldelete2 = "DELETE FROM `order_detail` WHERE Order_Number=$Order_Id";

    $stmt = $pdo->query($sqldelete);
    $stmt2 = $pdo->query($sqldelete2);

    if ($stmt->rowCount() == 1 or $stmt2->rowCount() == 1) {
        $outputdata['success'] = true;
        $outputdata['error'] = '';
    } else {
        $outputdata['error'] = '程式有誤，沒有刪除成功';
    }
}

echo json_encode($outputdata, JSON_UNESCAPED_UNICODE);
