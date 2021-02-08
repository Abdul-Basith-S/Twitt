<?php
    $dsn  = 'mysql:host=localhost; dbname=twit';
    $user = 'root';
    $pass = '';

    try{
        $pdo = new PDO($dsn, $user, $pass);
    }catch(PDOException $err){
        echo 'Not Connected! ' . $err->getMessage();
    }
?>