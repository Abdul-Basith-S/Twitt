<?php
    include 'database/connection.php';
    include 'classes/user.php';
    include 'classes/twit.php';
    global $pdo;
    session_start();
    $getFromU = new User($pdo);
    $getFromT = new Twit($pdo);
    define("BASE_URL", "http://localhost/twit/");
?>