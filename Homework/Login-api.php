<?php

include __DIR__ . '/phphtml/init.php';

$p = '$2y$10$xWfIa0u6oKXHC9CHXOH/q.wqFo5JgFmAH2zomN0SCPXds9oL.8bGm';
$outputdata = [
    'success' => false,
    'Error' => '',
    'ErrorCode' => 0,

];

if (!isset($_POST['account']) or !isset($_POST['password'])) {
    $outputdata['Error'] = '沒有帳號或是沒有密碼，請重新輸入';
    $outputdata['ErrorCode'] = 400;
    echo json_encode($outputdata, JSON_UNESCAPED_UNICODE);
    exit; // 直接離開(中斷)程式
}

$sqlaccpass = "SELECT * FROM member WHERE email=?";
$stmt = $pdo->prepare($sqlaccpass);
$stmt->execute(
    [$_POST['account']],
);
$m = $stmt->fetch();


// 查看是否有此帳號
if (empty($m)) {
    $outputdata['Error'] = '沒有帳號資訊，請重新輸入';
    $outputdata['ErrorCode'] = 410;
    echo json_encode($outputdata, JSON_UNESCAPED_UNICODE);
    exit; // 直接離開(中斷)程式
}

if (!password_verify($_POST['password'], $m['password'])) {
    $outputdata['Error'] = '密碼錯誤，請重新輸入';
    $outputdata['ErrorCode'] = 420;
    echo json_encode($outputdata, JSON_UNESCAPED_UNICODE);
    exit; // 直接離開(中斷)程式
}

$outputdata['success'] = true;
$outputdata['code'] = 200;
$_SESSION['user'] = [
    'account' => $_POST['account'],
    'nickname' => $m['nickname'],
];

echo json_encode($outputdata, JSON_UNESCAPED_UNICODE);
