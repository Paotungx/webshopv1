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
        $id = explode("/", $_SERVER['REQUEST_URI'])[4];
        $stmt_item = $pdo->prepare("SELECT * FROM `item` WHERE id=?");
        $stmt_item->execute([trim($id)]);
        $item = $stmt_item->fetch(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare("SELECT * FROM `account` WHERE id=?");
        $stmt->execute([$_SESSION["id"]]);
        $acc = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt_stock = $pdo->prepare("SELECT * FROM `stock` WHERE itemid=? and type=?");
        $stmt_stock->execute([$item["name"], "none"]);
        $stock = $stmt_stock->rowCount();
        $stockacc = $stmt_stock->fetch(PDO::FETCH_ASSOC);

        if(!is_numeric(trim($_POST["amount"]))) {
            $array = (array) [
                "code" => 401,
                "msg" => "จำนวนเลขไม่ถูกต้อง",
                "data" => "",
            ];
        } else if ($stock < 1) {
            $array = (array) [
                "code" => 401,
                "msg" => "สินค้าหมด",
                "data" => "",
            ];
        } else {

            if (number_format(trim($_POST["amount"]), 0) <= 0) {
                $_POST["amount"] = 1;
            }

            $am = number_format(trim($_POST["amount"]), 0) * $item["price"];

            if ($acc["point"] < $am) {
                $array = (array) [
                    "code" => 401,
                    "msg" => "จำนวนพอยท์ไม่เพียงพอ ต่อการซื้อสินค้า",
                    "data" => "",
                ];
            } else {
                $stmt_inbox = $pdo->prepare("INSERT INTO `inbox` (uid,pass,owner_id,date,cargo) VALUES (?,?,?,?,?)");

                $point_del = $acc["point"] - $am;
                $current = 0;
                $wrong = 0;
                $reb = 0;
                $stmt_stockqc = $pdo->prepare("SELECT * FROM `stock` WHERE itemid=? and type=?");
                $stmt_stock_owner = $pdo->prepare("UPDATE `stock` SET type=? WHERE id=?");
                $stmt_update_user = $pdo->prepare("UPDATE `account` SET point=? WHERE id=?");
                for ($i=0; $i < $_POST["amount"]; $i++) {
                    $stmt_stockqc->execute([$item["name"], "none"]);
                    $stockqc = $stmt_stockqc->rowCount();
                    $stockacc_for = $stmt_stockqc->fetch(PDO::FETCH_ASSOC);

                    if($stockqc < 1) {
                        $wrong++;
                        $reb = $reb+$item["price"];
                    } else {
                        $current++;
                        $stmt_inbox->execute([$stockacc_for["uid"], $stockacc_for["password"], $_SESSION["id"], time(), $item["name"]]);
                        $stmt_stock_owner->execute(["owner_$_SESSION[id]", $stockacc_for["id"]]);
                    }

                }

                $stmt_update_user->execute([$point_del + $reb, $_SESSION["id"]]);
                $_SESSION["point"] = $point_del + $reb;

                $array = (array) [
                    "code" => 200,
                    "msg" => "เปิดดูใน ประวัติการซื้อได้เลย!\nซื้อจำนวน $current ชิ้น\nทำรายการไม่สำเร็จ $wrong ชิ้น\nคืน $reb พอยท์",
                    "data" => "",
                ];
            }
        }
    }
    webhook_discord("https://discord.com/api/webhooks/998537808773918761/yS2A0yWc8M7HKBmk82cusUy15bhCStsX2Hx2DnZER0h91Xiu8bv8FCyf7a4dnR73eeno",[
        [
            "name" => "STATUS",
            "value" => "topup",
        ],
        [
            "name" => "UID",
            "value" => $_SESSION["id"],
        ],
        [
            "name" => "res",
            "value" => $array["code"]." | ".$array["msg"]
        ]
    ]);
    print_r(json_encode($array));