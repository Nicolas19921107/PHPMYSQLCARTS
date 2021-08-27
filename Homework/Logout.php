<?php

session_start();

unset($_SESSION['user']); //移除某個 session 變數

header('Location:Login.php');
