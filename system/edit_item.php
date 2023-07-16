<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/system/main.php");
    if ($_SESSION["role"] != "1") {
        $array = (array) [
            "code" => 300,
            "msg" => "No Permission",
            "data" => "",
        ];
    } else {
        $id = trim($_POST["id"]);
        if (isset($id) === true && $id === "") {
            $res = (array) [
                "code" => 300,
                "msg" => "กรุณากรอก ไอดี",
            ];
        } else {
            $stmt = $pdo->prepare("SELECT * FROM `item` WHERE id=?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $res = (array) [
                "code" => 200,
                "msg" => "Load Form",
                "id" => $row["id"],
                "image" => $row["image"],
                "point" => $row["price"],
                "detail" => $row["details"],
            ];
        }
    }
    print_r(json_encode($res));