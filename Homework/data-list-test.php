<?php include __DIR__ . '/phphtml/init.php'; ?>
<?php include __DIR__ . '/phphtml/head.php'; ?>
<?php include __DIR__ . '/phphtml/navbar.php'; ?>

<?php
// 操作資料的物件，從 DB 取資料(裡面使用 SQL 語法)
$callinfo = $pdo->query("SELECT * FROM food_list");

// 取得查詢結果，fetch 一次只取一筆資料
// echo json_encode($callinfo->fetch(PDO::FETCH_ASSOC),JSON_UNESCAPED_UNICODE);

// 取得查詢結果，fetchAll 一次取所有資料
// 筆數過多可能會有加載上的問題
// echo json_encode($callinfo->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);


// 透過 while 逐筆讀取 DB 內的資料，不需另外計算 DB 資料的數量
while ($read = $callinfo->fetch()) {
    echo "<p>{$read['sid']}:{$read['introduction']}</p>";
} ?>

<?php include __DIR__ . '/phphtml/footer.php'; ?>