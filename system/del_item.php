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
            $stmt = $pdo->prepare("DELETE FROM `item` WHERE id=?");
            $stmt->execute([$id]);
            $res = (array) [
                "code" => 200,
                "msg" => "ลบ สินค้า แล้ว",
            ];
        }
    }
    print_r(json_encode($res));