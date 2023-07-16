<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/system/main.php");
    if ($_SESSION["role"] != "1") {
        $array = (array) [
            "code" => 300,
            "msg" => "No Permission",
            "data" => "",
        ];
    } else {
        $stockname = trim($_POST["stockname"]);
        $stocklist = trim($_POST["stocklist"]);

        $list = explode("\n", $stocklist);

        if (isset($stockname) === true && $stockname === "") {
            $res = (array) [
                "code" => 300,
                "msg" => "กรุณากรอกชื่อสินค้า",
            ];
        } else if ($list[0] == null || $list[0] == null || $list[0] == "") {

            $res = (array) [
                "code" => 300,
                "msg" => "ข้อมูลไม่ถูกต้อง",
            ];

        } else {
            $clist= count($list);
            $i=0;
            $current=0;
            $wrong=0;
            $stmt = $pdo->prepare("INSERT INTO `stock` (itemid,uid,password) VALUES (?,?,?)");
            $stmt_acc = $pdo->prepare("SELECT * FROM `stock` WHERE uid=?");
            foreach ($list as $key => $value) {
                $i++;
                $split = explode(":", $value);

                if(!$split[1]) {
                    $res = (array) [
                        "code" => 300,
                        "msg" => "ข้อมูลไม่ถูกต้อง",
                    ];
                    print_r(json_encode($res));
                    return;
                }

                if($split[0] == "https" || $split[0] == "http") {
                    $current++;
                    $stmt->execute([$stockname, "-", $split[0].":".$split[1]]);
                } else {
                    $stmt_acc->execute([$split[0]]);
                    $stockacc = $stmt_acc->rowCount();
                    if ($stockacc >= 1) {
                        $wrong++;
                    } else {
                        $current++;
                        $stmt->execute([$stockname, $split[0], $split[1]]);
                    }
                }
                
                if($i==$clist) {
                    $res = (array) [
                        "code" => 200,
                        "msg" => "เพิ่มสินค้าจำนวน $current รายการ! \nไม่สามารถทำรายการได้ $wrong",
                    ];
                }
            
            }
        }
    }
    print_r(json_encode($res));