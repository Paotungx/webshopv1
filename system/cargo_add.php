<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/system/main.php");
    if ($_SESSION["role"] != "1") {
        $array = (array) [
            "code" => 300,
            "msg" => "No Permission",
            "data" => "",
        ];
    } else {
        $image = trim($_POST["imageid"]);
        $name = trim($_POST["nameid"]);
        $point = trim($_POST["pointid"]);
        $details = trim($_POST["detailid"]);

        if (isset($name) === true && $name === "") {
            $res = (array) [
                "code" => 300,
                "msg" => "กรุณาตั้งชื่อสินค้า",
            ];
        } else if (isset($point) === true && $point === "") {
            $res = (array) [
                "code" => 300,
                "msg" => "กรุณากำหนด Point",
            ];
        } else if (is_numeric($point) != true) {
            $res = (array) [
                "code" => 300,
                "msg" => "กรุณาใช้ตัวเลขเป็นพอยท์",
            ];
        } else {

            $stmt = $pdo->prepare("SELECT * FROM `item` WHERE name=?");
            $stmt->execute([$name]);
            $namefetch = $stmt->rowCount();

            if ($namefetch >= 1) {
                $res = (array) [
                    "code" => 300,
                    "msg" => "มีสินค้านี้อยู่แล้ว",
                ];
            } else {
                $stmt = $pdo->prepare("INSERT INTO `item` (name,price,image,details) VALUES (?,?,?,?)");
                $stmt->execute([$name, $point, $image, $details]);

                $res = (array) [
                    "code" => 200,
                    "msg" => "เพิ่มสินค้าสำเร็จ!",
                ];
            }
        }
    }
    print_r(json_encode($res));