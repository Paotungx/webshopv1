<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/system/main.php");
    if ($_SESSION["role"] != "1") {
        $array = (array) [
            "code" => 300,
            "msg" => "No Permission",
            "data" => "",
        ];
    } else {

        $output = null;

        function findRandom()
        {
            $mRandom = rand(48, 122);
            return $mRandom;
        }

        function isRandomInRange($mRandom)
        {
            if (($mRandom >= 58 && $mRandom <= 64) ||
                (($mRandom >= 91 && $mRandom <= 96))
            ) {
                return 0;
            } else {
                return $mRandom;
            }
        }

        for ($loop = 0; $loop <= 18; $loop++) {
            for ($isRandomInRange = 0; $isRandomInRange === 0;) {
                $isRandomInRange = isRandomInRange(findRandom());
            }
            $output .= html_entity_decode('&#' . $isRandomInRange . ';');
        }

        if (isset($_POST["amount"]) === true && $_POST["amount"] === "") {
            $res = (array) [
                "code" => 300,
                "msg" => "กรุณากรอก จำนวนครั้ง",
            ];
        } else if (isset($_POST["Point"]) === true && $_POST["Point"] === "") {
            $res = (array) [
                "code" => 300,
                "msg" => "กรุณากรอก Point",
            ];
        } else {

            if ($_POST["amount"] > 20) {
                $res = (array) [
                    "code" => 400,
                    "msg" => "จำนวนสูงสุด 20 ครั้ง",
                ];
            } else {

                $key = $output;

                $stmte = $pdo->prepare("SELECT * FROM `key_redeem` WHERE keyredeem=?");
                $stmte->execute([$_POST["RedeemCodeCustom"]]);
                $keyqw = $stmte->fetch(PDO::FETCH_ASSOC);
                $rckey = $stmte->rowCount();

                if ($rckey >= 1) {
                    $res = (array) [
                        "code" => 300,
                        "msg" => "มี Redeem Code นี้อยู่แล้ว",
                    ];
                } else {
                    $stmt = $pdo->prepare("INSERT INTO `key_redeem` (`id`, `keyredeem`, `point`, `type`, `amount`) VALUES (?,?,?,?,?);");
                    if ($_POST["keys"] == "random") {
                        $stmt->execute([
                            NULL,
                            $key,
                            $_POST["Point"],
                            $_POST["keys"],
                            $_POST["amount"]
                        ]);
                        $res = (array) [
                            "code" => 200,
                            "msg" => "เพิ่ม Redeem สำเร็จ",
                        ];
                    } else if ($_POST["keys"] == "custom") {
                        if (isset($_POST["RedeemCodeCustom"]) === true && $_POST["RedeemCodeCustom"] === "") {
                            $res = (array) [
                                "code" => 400,
                                "msg" => "กรุณาตั้งชื่อโค๊ต",
                            ];
                        } else {
                            $stmt->execute([
                                NULL,
                                $_POST["RedeemCodeCustom"],
                                $_POST["Point"],
                                $_POST["keys"],
                                $_POST["amount"]
                            ]);
                            $res = (array) [
                                "code" => 200,
                                "msg" => "เพิ่ม Redeem สำเร็จ",
                            ];
                        }
                    }
                }
            }
        }
    }
    print_r(json_encode($res));