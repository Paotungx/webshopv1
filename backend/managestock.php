<?php

if ($_SESSION["role"] != 1) {
    return header("?page=home");
}

include("{$_SERVER['DOCUMENT_ROOT']}/system/main.php");

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

function keyrandom()
{
    $output = "";
    for ($loop = 0; $loop <= 18; $loop++) {
        for ($isRandomInRange = 0; $isRandomInRange === 0;) {
            $isRandomInRange = isRandomInRange(findRandom());
        }
        $output .= html_entity_decode('&#' . $isRandomInRange . ';');
    }
    return $output;
}

$stmt = $pdo->prepare("SELECT * FROM `topup`");
$stmt->execute();

$money_today = 0;
$money_mon = 0;
$money_year = 0;

foreach ($stmt as $row) {
    if (date("d", time()) == date("d", $row["date"]) && date("m", time()) == date("m", $row["date"]) && date("y", time()) == date("y", $row["date"])) {
        $money_today += $row["topup"];
    }

    if (date("m", time()) == date("m", $row["date"]) && date("y", time()) == date("y", $row["date"])) {
        $money_mon += $row["topup"];
    }

    if (date("y", time()) == date("y", $row["date"])) {
        $money_year += $row["topup"];
    }
}

include ("{$_SERVER['DOCUMENT_ROOT']}/backend/header.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= getBackend("storename", $pdo) ?></title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- <link rel="stylesheet" href="assets/bst.css"> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="/app/css/mongkuyrai">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="/pace.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <meta name="title" content="Paotung Shop">
    <meta name="description" content="เว็บซ็อปตึง By REDz">
    <meta name="keywords"
        content="REDz, Redz, RedZ, redZ, redz, Paotung.me, truemoney.shop, Truemoney.shop, Truemoney, ทรูมันนี่, เติม Roblox, เติม robux, เติม R$, ซื้อ robux, R$, เติม Robux, Arc shop, Arcrobux, Robux, Roblox, เพชร FreeFire, เติมโรบัค, บัตรเติมเกม, โรบัค, minecraft, ไอดีเเท้, freefire, เติมเพชร, บัตรเติมเงิน, เติมเกม, สุดคุ้ม, steam wallet, ราคาถูก, Garena Shells, การีน่า, เติมเกมออนไลน์, ซื้อไนโตร, ไนโตรราคาถูก, Nitro, Nitro classic, Nitro Boost, Discord Nitro, Discord Nitro Classic, Discord Nitro Boost">
    <meta name="robots" content="index, follow">
    <meta name="author" content="REDz on the top">
    <link rel="shortcut icon"
        href="<?= getBackend("icon", $pdo) ?>"
        type="image/x-icon">
</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <div class="container py-0">

        <div class="row marginshop bg-white shadow-lg fww p-3 py-4 animate__animated animate__fadeIn">
            <div class="col-lg-12">
                <div class="card border-top border-bottom ">
                    <div class="card-body bg-transparent border-top border-bottom ">

                        <div class="row mx-0">
                            <div class="col-md-4 shadow-sm p-3 text-center border border-custom">
                                <span class="h3">รายได้ วันนี้</span>
                                <span class="h4 d-block">฿ <?= $money_today ?></span>
                            </div>

                            <div class="col-md-4 shadow-sm p-3 text-center border border-custom">
                                <span class="h3">รายได้ เดือนนี้</span>
                                <span class="h4 d-block">฿ <?= $money_mon ?></span>
                            </div>

                            <div class="col-md-4 shadow-sm p-3 text-center border border-custom">
                                <span class="h3">รายได้ ปีนี้</span>
                                <span class="h4 d-block">฿ <?= $money_year ?></span>
                            </div>
                        </div>

                        <div class="row mt-5 mb-5">
                            <div class="col">
                                <hr>
                            </div>
                            <div class="col-auto">เพิ่ม Stock</div>
                            <div class="col">
                                <hr>
                            </div>
                        </div>

                        <div class="col">
                            <div class="my-1">
                                <form data-form="stockadd">
                                    <div class="my-1">
                                        <select class="form-control" name="stockname">
                                            <?php
                                                $stmt = $pdo->prepare("SELECT * FROM `item` ORDER by id DESC");
                                                $stmt->execute();
                                                foreach ($stmt as $row) {
                                                ?>
                                            <option value="<?= $row["name"] ?>">สินค้า : <?= $row["name"] ?>
                                            </option>
                                            <?php
                                                }
                                                ?>
                                        </select>
                                    </div>

                                    <div class="my-1">

                                        <textarea name="stocklist" id="stocklist" class="form-control" cols="30"
                                            rows="10"></textarea>

                                        <!-- <input id="stockid" name="id" class="form-control float-left" type="text" placeholder="id" style="width:49.7%; margin-right:0.6%;"> -->
                                    </div>
                                    <!-- <div class="my-1">
                                            <input id="stockpass" name="pass" class="form-control" type="text" placeholder="pass" style="width:49.7%;">
                                        </div> -->
                                    <div class="d-grid">
                                        <button class="btn btn-yellow btn-block"><i class="fas fa-plus"></i> เพิ่ม
                                            Stock</button>
                                    </div>
                                </form>
                            </div>

                            <div class="row mt-5 mb-5">
                                <div class="col">
                                    <hr>
                                </div>
                                <div class="col-auto">จัดการ Stock</div>
                                <div class="col">
                                    <hr>
                                </div>
                            </div>

                            <div class="my-1">
                                <div class="list-item-backend bg-white border-top border-bottom">
                                    <div class="limit-500">
                                        <table class="table">
                                            <tr>
                                                <th>ประเภท</th>
                                                <th>ไอดี</th>
                                                <th>รหัส</th>
                                                <th>Manage</th>
                                            </tr>

                                            <?php
                                                $stmt = $pdo->prepare("SELECT * FROM `stock` WHERE type=? ORDER by id DESC");
                                                $stmt->execute(["none"]);
                                                foreach ($stmt as $row) {
                                                ?>
                                            <tr class="border-0">
                                                <td class="border-0"><?= $row["itemid"] ?></td>
                                                <td class="border-0"><?= $row["uid"] ?></td>
                                                <td class="border-0"><?= $row["password"] ?></td>
                                                <td class="border-0">
                                                    <button onClick="delstock('<?= $row["uid"] ?>', '<?= $row["password"] ?>')" class="btn btn-yellow "><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                                ?>

                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="container">
            Copyright &copy; 2022 <?= getBackend("storename", $pdo) ?>
            <div class="float-end">
                <a class="social-button bdiscord" href="<?= getBackend("discord", $pdo) ?>"><i
                        class="fa-1x fab fa-discord"></i></a>
                <a class="social-button bfacebook" href="<?= getBackend("facebook", $pdo) ?>"><i
                        class="fa-1x fab fa-facebook"></i></a>
            </div>
        </div>

        <script src="/backend/script_new.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
        </script>
</body>

</html>