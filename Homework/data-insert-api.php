<?php include __DIR__ . '/phphtml/init.php';

$_SESSION['num']++;

$outputdata = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'rowCount' => 0,
    'postData' => $_POST,
];



$sqlinsert = "INSERT INTO `order_list` (`Carts_Id`, `Order_Id`, `Member_Id`, `Order_Amount`) VALUES (NULL, '011', 'st880517@gmail.com', ?)";

$sqlinsert2 = "INSERT INTO `order_detail` (`Order_Sid`, `Order_Number`, `Member_Id`, `Product_Sid`, `Order_Status`) VALUES (NULL, '011', 'st880517@gmail.com',?, 'Wait')";
// $sql = "INSERT INTO `taipeimrt`(`營運日`, `星期`, `總運量`) VALUES (?,?,?)";

$callinfo = $pdo->prepare($sqlinsert2);
$callinfo2 = $pdo->prepare($sqlinsert);

// 執行插入資料到資料庫，且文字使用跳脫方式
$callinfo->execute([
    $_POST['flavor']
]);
$callinfo2->execute([
    $_POST['order']
]);

$outputdata['rowCount'] = $callinfo->rowCount(); //新增的筆數
if ($callinfo->rowCount() == 1) {
    $outputdata['success'] = true; //新增的筆數
}
$outputdata['rowCount'] = $callinfo2->rowCount(); //新增的筆數
if ($callinfo2->rowCount() == 1) {
    $outputdata['success'] = true; //新增的筆數
}
echo json_encode($outputdata);
