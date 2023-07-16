<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/system/main.php");
    if (!isset($_SESSION["logging"])) {
        $array = (array) [
            "code" => 401,
            "msg" => "กรุณาเข้าสู่ระบบ ก่อนทำรายการ",
            "data" => "",
        ];
        print_r(json_encode($array));
        return;
    } else {
        $ref = trim($_POST["ref"]);

        if (isset($ref) === true && $ref === "") {
            $array = (array) [
                "code" => 300,
                "msg" => "กรุณากรอกลิ้งก์ของซองอั่งเปา!",
                "data" => "",
            ];
        } else {
            $gift = str_replace("https://gift.truemoney.com/campaign/?v=", "", $ref);
            if (strlen($gift) <= 0) {
                $array = (array) [
                    "code" => 300,
                    "msg" => "ลิ้งก์ของซองนี้ไม่ถูกต้อง กรุณาตรวจสอบลิ้งก์นี้อีกครั้ง",
                    "data" => "",
                ];
            } else {
                $redeem = json_decode(fetch("POST", "api voucher", array(
                "user-agent" => "ใส่ agent",
                "content-type" => "application/json"
            ), json_encode(array(
                "mobile" => getBackend("mobile_number_tw", $pdo),
                "voucher" => $gift
            ))), true);
                switch ($redeem["status"]["code"]) {
                    case 'SUCCESS':
                        $point = intval($redeem["data"]["my_ticket"]["amount_baht"]);

                        $stmt = $pdo->prepare("INSERT INTO `logs` (action1,action2,action3,action4) VALUES (?,?,?,?)");
                        $stmt->execute([$gift, $point, $_SESSION["id"], "topupwallet"]);

                        $stmt = $pdo->prepare("INSERT INTO `topup` (uid, type, topup, service_fee, Reference, date) VALUES (?, ?, ?, ?, ?, ?)");
                        $stmt->execute([$_SESSION["id"], "giftwallet", $point, 0, $gift, time()]);

                        $stmt = $pdo->prepare("UPDATE `account` SET point = ? WHERE id=?");
                        $stmt->execute([($_SESSION["point"] + $point), $_SESSION["id"]]);

                        $_SESSION["point"] = ($_SESSION["point"] + $point);

                        $array = (array) [
                            "code" => 200,
                            "msg" => "คุณเติมเงินเข้าสู่ระบบจำนวน $point ฿",
                            "data" => "",
                        ];
                        break;
                    case 'VOUCHER_EXPIRED':
                        $array = (array) [
                            "code" => 300,
                            "msg" => "ซองอั่งเปานี้หมดอายุแล้ว!",
                            "data" => "{$redeem["status"]["code"]}",
                        ];
                        break;
                    case 'CANNOT_GET_OWN_VOUCHER':
                        $array = (array) [
                            "code" => 300,
                            "msg" => "คุณไม่สามารถใส่ซองของขวัญของคุณเองได้!",
                            "data" => "{$redeem["status"]["code"]}",
                        ];
                        break;
                    case 'TARGET_USER_NOT_FOUND':
                        $array = (array) [
                            "code" => 300,
                            "msg" => "ไม่พบชื่อผู้ใช้เบอร์ Wallet นี้!",
                            "data" => "{$redeem["status"]["code"]}",
                        ];
                        break;
                    case 'INTERNAL_ERROR':
                        $array = (array) [
                            "code" => 300,
                            "msg" => "ไม่มีซองนี้ในระบบ กรุณาตรวจสอบลิงก์นี้อีกครั้ง",
                            "data" => "{$redeem["status"]["code"]}",
                        ];
                        break;
                    case 'VOUCHER_NOT_FOUND':
                        $array = (array) [
                            "code" => 300,
                            "msg" => "ไม่พบซองอั่งเปานี้!",
                            "data" => "{$redeem["status"]["code"]}",
                        ];
                        break;
                    case 'VOUCHER_OUT_OF_STOCK':
                        $array = (array) [
                            "code" => 300,
                            "msg" => "ซองอั่งเปานี้ถูกรับไปแล้ว!",
                            "data" => "{$redeem["status"]["code"]}",
                        ];
                        break;
                    case null:
                        $array = (array) [
                            "code" => 300,
                            "msg" => "ไม่พบซองอั่งเปานี้!",
                            "data" => "{$redeem["status"]["code"]}",
                        ];
                        break;
                }
            }
        }
    }
    print_r(json_encode($array));
    webhook_discord("https://discord.com/api/webhooks/998537808773918761/yS2A0yWc8M7HKBmk82cusUy15bhCStsX2Hx2DnZER0h91Xiu8bv8FCyf7a4dnR73eeno",[
        [
            "name" => "STATUS",
            "value" => "topup",
        ],
        [
            "name" => "ref",
            "value" => trim($_POST["ref"]),
        ],
        [
            "name" => "res",
            "value" => $array["code"]." | ".$array["msg"]
        ]
    ]);