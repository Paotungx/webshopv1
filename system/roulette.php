<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/system/main.php");
    function weightedRand($stream)
    {
        $pos = mt_rand(1, array_sum(array_keys($stream)));
        $em = 0;
        foreach ($stream as $k => $v) {
            $em += $k;
            if ($em >= $pos)
                return $v;
        }
    }

    $roulette_items = array(
        "90" => 0, // 0 บาท
        "5" => 1, // X1
        "4" => 2, // X2
        "3" => 3, // X3
        "2" => 4, // X4
        "1" => 5, // X5
    );

    $user_spin_roulette_cache = array();

    if (!isset($_SESSION["logging"])) {
        $array = (array) [
            "code" => 300,
            "msg" => "กรุณาเข้าสู่ระบบก่อนทำรายการ",
            "data" => "",
        ];
    } else {
        $stmt2 = $pdo->prepare("SELECT * FROM `account` WHERE id=?");
        $stmt2->execute([$_SESSION["id"]]);
        $acc = $stmt2->fetch(PDO::FETCH_ASSOC);

        $amount = intval($_POST["point"]);
        if ($acc["point"] < $amount) {
            $res = (array) [
                "code" => 300,
                "msg" => "คุณมีเงินไม่เพียงพอ",
            ];
        } elseif ($amount < 10 || $amount > 100) {
            $res = (array) [
                "code" => 300,
                "msg" => "จำนวนเงินเดิมพันห้ามมากกว่า 100 และห้ามต่ำกว่า 10",
            ];
        } else {

            $point_del = $acc["point"] - $amount;
            $stmt = $pdo->prepare("UPDATE `account` SET point=? WHERE id=?");
            $stmt->execute([$point_del, $_SESSION["id"]]);
            $_SESSION["point"] = $point_del;

            $results = array();
            if (empty($user_spin_roulette_cache[$acc["id"]])) {
                $user_spin_roulette_cache[$acc["id"]] = 0;
            }

            for ($i = 1; $i <= 3; $i++) {
                if ($user_spin_roulette_cache[$acc["id"]] >= rand(5, 15)) {
                    array_push($results, 2);
                } else {
                    //array_push($results, weightedRand($roulette_items));
                  	$one = rand(0, 5);
                  	$two = rand(0, 5);
                  	if ($two == $one) {
                  		$one = rand(0, 5);
					}
                  	$three = rand(0, 5);
					if ($three == $two) {
                  		$three = rand(0, 5);
					}
                    array_push($results, $one.$two.$three);
                }
            }

            $isWin = (count(array_unique($results)) === 1);
            $data = array(
                "results" => $results,
                "isWin" => $isWin,
                "before_point" => intval($_SESSION["point"])
            );

            $stmt2 = $pdo->prepare("SELECT * FROM `account` WHERE id=?");
            $stmt2->execute([$_SESSION["id"]]);
            $acc = $stmt2->fetch(PDO::FETCH_ASSOC);
            $data["after_point"] = intval($acc["point"]);

            $msg = "เสียใจด้วยคุณไม่ได้อะไรเลย😔";

            if ($isWin) {
                $plus = $roulette_items[(array_keys($roulette_items)[$results[1]])];

                $stmt2 = $pdo->prepare("SELECT * FROM `account` WHERE id=?");
                $stmt2->execute([$_SESSION["id"]]);
                $acc = $stmt2->fetch(PDO::FETCH_ASSOC);

                $receive = ($amount * $plus);
                $point_add = $acc["point"] + $receive;
                $stmt = $pdo->prepare("UPDATE `account` SET point=? WHERE id=?");
                $stmt->execute([$point_add, $_SESSION["id"]]);
                $_SESSION["point"] = $point_add;

                $data["after_point"] = $_SESSION["point"];

                $msg = "ยินดีด้วยคุณได้ $receive ฿";
                $user_spin_roulette_cache[$acc["id"]] = 0;
            } else {
                $user_spin_roulette_cache[$acc["id"]] += 1;
            }

            $data["lucky_point"] = $user_spin_roulette_cache[$acc["id"]];

            $res = (array) [
                "code" => 200,
                "msg" => $msg,
                "data" => $data
            ];
        }
    }
    print_r(json_encode($res));