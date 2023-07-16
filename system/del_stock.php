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
        $pass = trim($_POST["pass"]);

        if (isset($id) === true && $id === "") {
            $res = (array) [
                "code" => 300,
                "msg" => "กรุณากรอก ไอดี",
            ];
        } else if (isset($pass) === true && $pass === "") {
            $res = (array) [
                "code" => 300,
                "msg" => "กรุณากรอก รหัส",
            ];
        } else {
            $stmt = $pdo->prepare("SELECT * FROM `stock` WHERE uid=?");
            $stmt->execute([$id]);
            $stockacc = $stmt->rowCount();
            if ($stockacc <= 0) {
                $res = (array) [
                    "code" => 300,
                    "msg" => "ไม่พบ Account นี้ > $id:$pass",
                ];
            } else {
                $stmt = $pdo->prepare("DELETE FROM `stock` WHERE uid=? AND password=?");
                $stmt->execute([$id, $pass]);

                $res = (array) [
                    "code" => 200,
                    "msg" => "ลบสินค้าสำเร็จ! $id:$pass",
                ];
            }
        }
    }
    print_r(json_encode($res));