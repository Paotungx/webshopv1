<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/system/main.php");
    if (!isset($_SESSION["logging"])) {
        $array = (array) [
            "code" => 300,
            "msg" => "กรุณาเข้าสู่ระบบก่อนทำรายการ",
            "data" => "",
        ];
    } else {
        $password = trim($_POST["password"]);
        if (isset($password) === true && $password === "") {
            $res = (array) [
                "code" => 300,
                "msg" => "กรุณากรอกรหัสผ่าน",
                "data" => "",
            ];
        } else if (strlen($password) <= 4) {
            $res = (array) [
                "code" => 400,
                "msg" => "รหัสผ่านต้องมีอย่างน้อย 4 ตัวอักษรขึ้นไป",
            ];
        } else if (strlen($password) > 20) {
            $res = (array) [
                "code" => 400,
                "msg" => "รหัสผ่านของคุณยาวเกินไป",
            ];
        } else {
            $password = hash("sha256", hash("sha256", $password));
            $stmt = $pdo->prepare("UPDATE `account` SET password=? WHERE id=?");
            $stmt->execute([$password, $_SESSION["id"]]);
            $res = (array) [
                "code" => 200,
                "msg" => "เปลี่ยนรหัสผ่านสำเร็จ",
            ];
        }
    }
    print_r(json_encode($res));