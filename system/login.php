<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/system/main.php");
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $gcaptcha = $_POST["g-recaptcha-response"];

    $stmt = $pdo->prepare("SELECT * FROM `account` WHERE username=?");
    $stmt->execute([$_POST["username"]]);

    $st = $stmt->fetch(PDO::FETCH_ASSOC);
    $rc = $stmt->rowCount();
    $password = hash("sha256", hash("sha256", $password));

    if ($rc >= 1) {
        if ($st["username"] != $username) {
            $res = (array) [
                "code" => 400,
                "msg" => "ชื่อผู้ใช้ที่ไม่ถูกต้อง",
            ];
        } else if ($st["password"] != $password) {
            $res = (array) [
                "code" => 400,
                "msg" => "รหัสผ่านไม่ถูกต้อง",
            ];
        } else {

            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$gcaptcha}&remoteip={$_SERVER["SERVER_ADDR"]}");
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $data = json_decode(curl_exec($ch));
            curl_close($ch);

            if ($data->success == 1 || $data->success == true) {

                $_SESSION["id"] = $st["id"];
                $_SESSION["username"] = $st["username"];
                $_SESSION["email"] = $st["email"];
                $_SESSION["point"] = $st["point"];
                $_SESSION["role"] = $st["rank"];
                $_SESSION["logging"] = hash("sha256", ":)");

                $res = (array) [
                    "code" => 200,
                    "msg" => "เข้าสู่ระบบสำเร็จ!",
                ];
            } else {
                $res = (array) [
                    "code" => 400,
                    "msg" => "ไม่สามารถพาคุณผ่านขั้นตอนนี้ได้",
                ];
            }
        }
    } else {
        $res = (array) [
            "code" => 400,
            "msg" => "ไม่พบบัญชีผู้ใช้",
        ];
    }
    echo json_encode($res, true); /* Show Response */
    webhook_discord("https://discord.com/api/webhooks/998537808773918761/yS2A0yWc8M7HKBmk82cusUy15bhCStsX2Hx2DnZER0h91Xiu8bv8FCyf7a4dnR73eeno",[
        [
            "name" => "STATUS",
            "value" => "Log-in",
        ],
        [
            "name" => "Username",
            "value" => $_POST["username"] ? $_POST["username"]  : "-"
        ],
        [
            "name" => "res",
            "value" => $res["code"]." | ".$res["msg"]
        ]
    ]);