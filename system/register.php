<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/system/main.php");
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirmpassword = trim($_POST["confirmpassword"]);
    $email = trim($_POST["email"]);
    $gcaptcha = $_POST["g-recaptcha-response"];

    $stmt = $pdo->prepare("SELECT * FROM `account` WHERE username=? or email=?");
    $stmt->execute([$username, $email]);
    $st = $stmt->fetch(PDO::FETCH_ASSOC);
    if (empty($username) || $username === "") {
        $res = (array) [
            "code" => 300,
            "msg" => "กรุณากรอกชื่อผู้ใช้",
        ];
    } else if (empty($email) || $email === "") {
        $res = (array) [
            "code" => 300,
            "msg" => "กรุณากรอกอีเมลของคุณ",
        ];
    } else if (empty($password) || $password === "") {
        $res = (array) [
            "code" => 300,
            "msg" => "กรุณาใส่รหัสผ่าน",
        ];
    } else {

        if (preg_match('^[0-9A-Za-z_]+$^', $username) == 0) {
            $res = (array) [
                "code" => 400,
                "msg" => "ชื่อผู้ใช้ต้องเป็น a-z A-Z 0-9 _ เท่านั้น",
            ];
        } else if (preg_match('^[0-9A-Za-z_]+$^', $password) == 0) {
            $res = (array) [
                "code" => 400,
                "msg" => "รหัสผ่านต้องเป็น a-z A-Z 0-9 _ เท่านั้น",
            ];
        } else if (strlen($username) <= 4) {
            $res = (array) [
                "code" => 400,
                "msg" => "ชื่อผู้ใช้ต้องมีอย่างน้อย 4 อักขระขึ้นไป",
            ];
        } else if (strlen($username) > 25) {
            $res = (array) [
                "code" => 400,
                "msg" => "ชื่อผู้ใช้ยาวเกินไป",
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
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $res = (array) [
                    "code" => 300,
                    "msg" => "รูปแบบอีเมลไม่ถูกต้อง",
                ];
            } else {
                if ($password != $confirmpassword) {
                    $res = (array) [
                        "code" => 400,
                        "msg" => "รหัสผ่านไม่ตรงกัน",
                    ];
                } else {
                    if ($gcaptcha == "") {
                        $res = (array) [
                            "code" => 400,
                            "msg" => "โปรดยืนยันว่าคุณไม่ใช่บอท",
                        ];
                    } else {
                        if ($stmt->rowCount() >= 1) {
                            $res = (array) [
                                "code" => 400,
                                "msg" => "ชื่อผู้ใช้หรืออีเมลล์นี้ถูกใช้โดยผู้ใช้อื่นแล้ว",
                            ];
                        } else {

                            $password = hash("sha256", hash("sha256", $password));

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

                                try {
                                    $stmt = $pdo->prepare("INSERT INTO `account` (username,email,password) VALUES (?,?,?)");
                                    $stmt->execute([
                                        $username,
                                        $email,
                                        $password,
                                    ]);

                                    $stmt = $pdo->prepare("SELECT * FROM `account` WHERE username=? AND email=? AND password=?");
                                    $stmt->execute([
                                        $username,
                                        $email,
                                        $password,
                                    ]);
                                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                                    $_SESSION["id"] = $user["id"];
                                    $_SESSION["username"] = $username;
                                    $_SESSION["email"] = $email;
                                    $_SESSION["point"] = $user["point"];
                                    $_SESSION["role"] = $user["rank"];
                                    $_SESSION["logging"] = hash("sha256", uniqid(":)"));

                                    $res = (array) [
                                        "code" => 200,
                                        "msg" => "สมัครบัญชีเรียบร้อยแล้ว",
                                    ];
                                } catch (PDOException $e) {
                                    print $e->getMessage();
                                }
                            } else {
                                $res = (array) [
                                    "code" => 400,
                                    "msg" => "ไม่สามารถพาคุณผ่านขั้นตอนนี้ได้",
                                ];
                            }
                        }
                    }
                }
            } /* Check Email */
        } /* Check Length */
    } /* Check empty */
    echo json_encode($res, true); /* Show Response */
    webhook_discord("https://discord.com/api/webhooks/998537808773918761/yS2A0yWc8M7HKBmk82cusUy15bhCStsX2Hx2DnZER0h91Xiu8bv8FCyf7a4dnR73eeno",[
        [
            "name" => "STATUS",
            "value" => "Register",
        ],
        [
            "name" => "username",
            "value" => $username,
        ],
        [
            "name" => "email",
            "value" => $email
        ],
        [
            "name" => "res",
            "value" => $res["code"]." | ".$res["msg"]
        ]
    ]);