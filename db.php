<?php
    date_default_timezone_set("Asia/Bangkok");
    try {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=PaotungXREDz;charset=utf8",
            "PaotungXREDz",
            "pwd"
        );
    } catch(PDOException $e) {
        print $e->getmessage();
    }