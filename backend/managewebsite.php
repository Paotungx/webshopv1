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
    <link rel="shortcut icon" href="<?= getBackend("icon", $pdo) ?>" type="image/x-icon">
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

                        <div class="row">
                            <div>
                                <hr>
                            </div>
                        </div>

                        <div class="my-1">
                            <form data-form="discordchange">
                                <input class="form-control d-inline-block float-start" name="text" type="text"
                                    value="<?= getBackend("discord", $pdo) ?>" placeholder="แก้ไข discord"
                                    style="width:90%;"> <button class="btn btn-yellow-hover d-inline-block rounded-0"
                                    style="width:10%;"><span><i class="fas fa-check"></i></span></button>
                            </form>
                        </div>

                        <div class="my-1">
                            <form data-form="facebookchange">
                                <input class="form-control d-inline-block float-start" name="text" type="text"
                                    value="<?= getBackend("facebook", $pdo) ?>" placeholder="แก้ไข facebook"
                                    style="width:90%;"> <button class="btn btn-yellow-hover d-inline-block rounded-0"
                                    style="width:10%;"><span><i class="fas fa-check"></i></span></button>
                            </form>
                        </div>

                        <div class="my-1">
                            <form data-form="logochange">
                                <input class="form-control d-inline-block float-start" name="text" type="text"
                                    value="<?= getBackend("Logo", $pdo) ?>" placeholder="แก้ไข Logo" style="width:90%;">
                                <button class="btn btn-yellow-hover d-inline-block rounded-0"
                                    style="width:10%;"><span><i class="fas fa-check"></i></span></button>
                            </form>
                        </div>

                        <div class="my-1">
                            <form data-form="iconchange">
                                <input class="form-control d-inline-block float-start" name="text" type="text"
                                    value="<?= getBackend("icon", $pdo) ?>" placeholder="แก้ไข ICON" style="width:90%;">
                                <button class="btn btn-yellow-hover d-inline-block rounded-0"
                                    style="width:10%;"><span><i class="fas fa-check"></i></span></button>
                            </form>
                        </div>

                        <div class="my-1">
                            <form data-form="storenamechange">
                                <input class="form-control d-inline-block float-start" name="text" type="text"
                                    value="<?= getBackend("storename", $pdo) ?>" placeholder="แก้ไขซื่อร้าน"
                                    style="width:90%;"> <button class="btn btn-yellow-hover d-inline-block rounded-0"
                                    style="width:10%;"><span><i class="fas fa-check"></i></span></button>
                            </form>
                        </div>

                        <div class="my-1">
                            <form data-form="bannerchange">
                                <input class="form-control d-inline-block float-start rounded-0" name="text" type="text"
                                    value="<?= getBackend("banner", $pdo) ?>" placeholder="แก้ไขรูป Banner"
                                    style="width:90%;"> <button class="btn btn-yellow-hover d-inline-block rounded-0"
                                    style="width:10%;"><span><i class="fas fa-check"></i></span></button>
                            </form>
                        </div>

                        <div class="my-1">
                            <form data-form="colorchange">
                                <input class="form-control d-inline-block float-start rounded-0" type="color"
                                    name="text" value="<?= getBackend("colors", $pdo) ?>" placeholder="แก้ไข สีเว็บ"
                                    style="width:90%;"> <button class="btn btn-yellow-hover d-inline-block rounded-0"
                                    style="width:10%;"><span><i class="fas fa-check"></i></span></button>
                            </form>
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