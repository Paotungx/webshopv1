<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/system/main.php");
    if ($_SESSION["role"] != "1") {
        $array = (array) [
            "code" => 300,
            "msg" => "No Permission",
            "data" => "",
        ];
    } else {
        $id = trim($_POST["idq"]);
        $detail = trim($_POST["detailq"]);
        $image = trim($_POST["imageq"]);
        $point = trim($_POST["pointq"]);
        if (isset($id) === true && $id === "") {
            $res = (array) [
                "code" => 300,
                "msg" => "กรุณากรอก ไอดี",
            ];
        } else if (isset($point) === true && $point === "") {
            $res = (array) [
                "code" => 300,
                "msg" => "กรุณากรอก พอยท์",
            ];
        } else if (isset($detail) === true && $detail === "") {
            $res = (array) [
                "code" => 300,
                "msg" => "กรุณากรอก ไอดี",
            ];
        } else if (isset($image) === true && $image === "") {
            $res = (array) [
                "code" => 300,
                "msg" => "กรุณากรอก URL Image",
            ];
        } else {
            $stmt = $pdo->prepare("UPDATE `item` SET price=?, image=? , details=? WHERE id=?");
            $stmt->execute([$point, $image, $detail, $id]);
            $res = (array) [
                "code" => 200,
                "msg" => "แก้ไขสำเร็จ",
            ];
        }
    }
    print_r(json_encode($res));