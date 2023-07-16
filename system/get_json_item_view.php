<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/system/main.php");
    if (!isset($_SESSION["logging"])) {
        $array = (array) [
            "code" => 300,
            "msg" => "กรุณาเข้าสู่ระบบก่อนทำรายการ",
            "data" => "",
        ];
        print_r(json_encode($array));
        return;
    } else {
        $id = explode("/", $_SERVER['REQUEST_URI'])[4];

        $stmt1 = $pdo->prepare("SELECT * FROM `item` WHERE id=?");
        $stmt1->execute([$id]);
        $count = $stmt1->rowCount();
        $item = $stmt1->fetch(PDO::FETCH_ASSOC);

        $stmt2 = $pdo->prepare("SELECT * FROM `account` WHERE id=?");
        $stmt2->execute([$_SESSION["id"]]);
        $acc = $stmt2->fetch(PDO::FETCH_ASSOC);

        $stmt3 = $pdo->prepare('SELECT * FROM `stock` WHERE `type` = "none" AND `itemid` = ?');
        $stmt3->execute([$item["name"]]);
        $stock = $stmt3->rowCount();

        $stmt = $pdo->prepare('SELECT * FROM `stock` WHERE NOT `type` = "none" AND `itemid` = ?');
        $stmt->execute([$item["name"]]);
        $sold = $stmt->rowCount();

        if ($stock < 1) {
            $buttons = "<button class=\"btn btn-danger\" data-bs-dismiss=\"modal\" aria-label=\"Close\">ยกเลิก</button> <button class=\"btn btn-yellow\" disabled>สินค้าหมด</button>";
        } else if ($acc["point"] < $item["price"]) {
            $topup = $item["price"] - $acc["point"];
            $buttons = "<button class=\"btn btn-danger\" data-bs-dismiss=\"modal\" aria-label=\"Close\">ยกเลิก</button> <button class=\"btn btn-yellow\" disabled>พอยท์ของคุณไม่เพียงพอ</button>";
        } else {
            $buttons = "<button class=\"btn btn-danger\" data-bs-dismiss=\"modal\" aria-label=\"Close\">ยกเลิก</button> <button onclick=\"buy_cargo(" . $item["id"] . ")\" class=\"btn btn-yellow\">ยืนยันการสั่งซื้อ</button>";
        }

        $item["stock"] = $stock;
        $item["sold"] = $sold;

        if ($count <= 0) {
            $array = (array) [
                "code" => 404,
                "msg" => "ไม่พบข้อมูลสินค้า",
                "data" => "",
            ];
        } else {
            $array = (array) [
                "code" => 200,
                "data" => $item,
                "button" => $buttons,
            ];
        }
    }
    print_r(json_encode($array));
/**
    webhook_discord("",[
        [
            "name" => "STATUS",
            "value" => "get_json_item_view",
        ],
        [
            "name" => "UID",
            "value" => $_SESSION["id"]
        ],
        [
            "name" => "Username",
            "value" => $_SESSION["username"]
        ],
        [
            "name" => "ITEM VIEW",
            "value" => $id
        ]
    ]); **/