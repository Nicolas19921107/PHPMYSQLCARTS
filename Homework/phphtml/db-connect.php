<?php

// 連線的主機名稱
$db_host = 'localhost';

// 連線的資料庫名稱
$db_name = 'test';

// 連線的資料庫使用者帳號(如果沒設定就是空字串 or root)
$db_user = 'st880517';

// 連線的資料庫使用者密碼(如果沒設定就是空字串 or root)
$db_pass = 'nicolas123';

// 連線的資料庫編碼格式
$db_charset = 'utf8';

// Data Source Name(資料庫來源名稱)
$dsn = "mysql:host={$db_host};dbname={$db_name};charset={$db_charset}";


// PDO 連線設定
$pdo_options = [
    //::=>常數定義為類別
    // 定義錯誤時的處理方式 
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

    // 取資料時，每一筆資料都會成為關聯式陣列
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

    // 初始連線時執行的內容，後面為 SQL 語法，設定全部的編碼都屬於 utf8
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
];



// 若需要處理錯誤，則建立 try and catch
try {
    // 建立呼叫資料庫的變數( 資料庫來源, 資料庫帳號, 資料庫密碼, 資料庫連線設定 )
    $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
} catch (PDOException $ex) {
    echo 'Connection-failed, 連線失敗:' . $ex->getMessage();
}
