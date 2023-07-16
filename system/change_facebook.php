<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/system/main.php");
    if ($_SESSION["role"] != "1") {
        $array = (array) [
            "code" => 300,
            "msg" => "No Permission",
            "data" => "",
        ];
    } else {
        $text = trim($_POST["text"]);

        if (isset($text) === true && $text === "") {
            $array = (array) [
                "code" => 300,
                "msg" => "กรุณากรอก facebook",
                "data" => "",
            ];
        } else {

            $stmt = $pdo->prepare("SELECT * FROM `backend` WHERE Settings=?");
            $stmt->execute(["facebook"]);
            $count = $stmt->rowCount();
            if($count <= 0) {
                $stmt = $pdo->prepare("INSERT INTO `backend` (value1, Settings) VALUES (?, ?)");
                $stmt->execute([$text, "facebook"]);
            } else {
                $stmt = $pdo->prepare("UPDATE `backend` SET value1=? WHERE Settings=?");
                $stmt->execute([$text, "facebook"]);
            }
            $stmt = $pdo->prepare("INSERT INTO `logs` (action1, action4) VALUES (?, ?)");
            $stmt->execute([$text, "changefacebook"]);
            $array = (array) [
                "code" => 200,
                "msg" => "แก้ไข facebook $text สำเร็จ!",
                "data" => "",
            ];
        }
    }
    print_r(json_encode($array));