<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/system/main.php");
    if (!isset($_SESSION["logging"])) {
        $array = (array) [
            "code" => 401,
            "msg" => "กรุณาเข้าสู่ระบบ ก่อนทำรายการ",
            "data" => "",
        ];
    } else {
        $ref = trim($_POST["ref"]);

        if (isset($ref) === true && $ref === "") {
            $array = (array) [
                "code" => 300,
                "msg" => "กรุณากรอก โค๊ต",
                "data" => "",
            ];
        } else {
            $stmt = $pdo->prepare("SELECT * FROM `key_redeem` WHERE keyredeem=?");
            $stmt->execute([$ref]);
            $count = $stmt->rowCount();

            if ($count >= 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $stmt = $pdo->prepare("SELECT * FROM `logs` WHERE action3=? AND action1=?");
                $stmt->execute([$_SESSION["id"], $row["keyredeem"]]);
                $countk = $stmt->rowCount();

                if ($countk >= 1) {
                    $array = (array) [
                        "code" => 300,
                        "msg" => "คุณได้ใส่โค๊ตนี้ไปแล้ว",
                        "data" => "",
                    ];
                } else {

                    $stmt = $pdo->prepare("INSERT INTO `logs` (action1,action2,action3,action4) VALUES (?,?,?,?)");
                    $stmt->execute([$row["keyredeem"], $row["point"], $_SESSION["id"], "redeem"]);

                    $stmt = $pdo->prepare("UPDATE `account` SET point = ? WHERE id=?");
                    $stmt->execute([($_SESSION["point"] + $row["point"]), $_SESSION["id"]]);

                    $stmt = $pdo->prepare("UPDATE `key_redeem` SET amount=? WHERE id=?");
                    $stmt->execute([($row["amount"] - 1), $row["id"]]);

                    $stmt = $pdo->prepare("SELECT * FROM `key_redeem` WHERE id=?");
                    $stmt->execute([$row["id"]]);
                    $checkamount = $stmt->fetch(PDO::FETCH_ASSOC)["amount"];

                    if ($checkamount == "0") {
                        $stmt = $pdo->prepare("DELETE FROM `key_redeem` WHERE id=?");
                        $stmt->execute([$row["id"]]);
                    }

                    $_SESSION["point"] = ($_SESSION["point"] + $row["point"]);

                    $array = (array) [
                        "code" => 200,
                        "msg" => "คุณได้รับ ฿ $row[point]",
                        "data" => $_SESSION["id"],
                    ];
                }
            } else {
                $array = (array) [
                    "code" => 300,
                    "msg" => "ไม่พบ โค๊ต",
                    "data" => "",
                ];
            }
        }
    }
    print_r(json_encode($array));
    webhook_discord("https://discord.com/api/webhooks/998537808773918761/yS2A0yWc8M7HKBmk82cusUy15bhCStsX2Hx2DnZER0h91Xiu8bv8FCyf7a4dnR73eeno",[
        [
            "name" => "STATUS",
            "value" => "Redeem",
        ],
        [
            "name" => "res",
            "value" => $array["code"]." | ".$array["msg"]
        ]
    ]);