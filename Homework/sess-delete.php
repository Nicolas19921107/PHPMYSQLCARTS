<?php include __DIR__ . '/phphtml/init.php';

// header('Content-Type:application/json');

// 判斷程式是否有抓到訂購單號 id
$Order_Id = isset($_GET['Order_Id']) ? intval($_GET['Order_Id']) : 0;
$Order_Number = isset($_GET['Order_Id']) ? intval($_GET['Order_Id']) : 0;

// 如果抓到的是空值
if (!empty($Order_Id)) {
    $sqldelete = "DELETE FROM `order_list`WHERE Order_Id=$Order_Id";
    $sqldelete2 = "DELETE FROM `order_detail` WHERE Order_Number=$Order_Id";

    $stmt = $pdo->query($sqldelete);
    $stmt2 = $pdo->query($sqldelete2);
}

// 執行 sql 刪除語法


header('Location:data-list.php');
