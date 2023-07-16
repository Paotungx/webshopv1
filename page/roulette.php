<?php
if (!isset($_SESSION["logging"])) return Header("Location: /member/login");
include("{$_SERVER['DOCUMENT_ROOT']}/system/main.php");
include ("header.php");
if (isset($_SESSION["logging"])) {
    $stmt = $pdo->prepare("SELECT * FROM `account` WHERE id=?");
    $stmt->execute([$_SESSION["id"]]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION["point"] = $user["point"];
    $_SESSION["role"] = $user["rank"];
    $_SESSION["username"] = $user["username"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= getBackend("storename", $pdo) ?> - สุ่มพอยท์</title>
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
    <script src="../pace.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <meta name="title" content="<?= getBackend("storename", $pdo) ?> By REDz">
    <meta name="description" content="เว็บซ็อปตึง By REDz">
    <meta name="keywords"
        content="REDz, Redz, RedZ, redZ, redz, Paotung.me, truemoney.shop, Truemoney.shop, Truemoney, ทรูมันนี่, เติม Roblox, เติม robux, เติม R$, ซื้อ robux, R$, เติม Robux, Arc shop, Arcrobux, Robux, Roblox, เพชร FreeFire, เติมโรบัค, บัตรเติมเกม, โรบัค, minecraft, ไอดีเเท้, freefire, เติมเพชร, บัตรเติมเงิน, เติมเกม, สุดคุ้ม, steam wallet, ราคาถูก, Garena Shells, การีน่า, เติมเกมออนไลน์, ซื้อไนโตร, ไนโตรราคาถูก, Nitro, Nitro classic, Nitro Boost, Discord Nitro, Discord Nitro Classic, Discord Nitro Boost">
    <meta name="robots" content="index, follow">
    <meta name="author" content="REDz on the top">
    <link  rel="icon" type="image/png" href="<?= getBackend("icon", $pdo) ?>">

    <style>
        .roulette img {
            width: 128px;
        }

        .roulette_container {
            background-color: #252525;
            padding: 25px 0;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>


    <div class="container py-0">
        <div class="row ">
            <div class="col-lg-7 mx-auto marginshop bg-white shadow-lg fww p-3 py-4 animate__animated animate__fadeIn">
                <div class="card rounded-0">
                    <div class="card-header h4 text-white border-top border-bottom">ROULETTE</div>
                    <div class="card-body">

                        <style>
                            .img_rlt {
                                max-height: 80px;
                                background-position: center;
                                background-size: contain;
                                background-repeat: no-repeat;
                            }
                        </style>

                        <div class="row justify-content-center roulette_container mb-4">
                            <div class="col-4">
                                <center>
                                    <div class="roulette roulette_left" style="display:none;">

                                        <img style="max-height:80px; object-fit:contain;"
                                            src="<?= getBackend("logo", $pdo) ?>" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/5fjEudP.png" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/RsDUBfl.png" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/CJyXPnO.png" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/dPzAWyX.png" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/vIrUwcz.png" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/TmxaxVx.png" />

                                    </div>
                                </center>
                            </div>
                            <div class="col-4">
                                <center>
                                    <div class="roulette roulette_center" style="display:none;">
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="<?= getBackend("logo", $pdo) ?>" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/5fjEudP.png" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/RsDUBfl.png" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/CJyXPnO.png" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/dPzAWyX.png" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/vIrUwcz.png" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/TmxaxVx.png" />
                                    </div>
                                </center>
                            </div>
                            <div class="col-4">
                                <center>
                                    <div class="roulette roulette_right" style="display:none;">
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="<?= getBackend("logo", $pdo) ?>" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/5fjEudP.png" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/RsDUBfl.png" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/CJyXPnO.png" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/dPzAWyX.png" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/vIrUwcz.png" />
                                        <img style="max-height:80px; object-fit:contain;"
                                            src="https://i.imgur.com/TmxaxVx.png" />
                                    </div>
                                </center>
                            </div>
                        </div>

                        <div>
                            <button id="bet" onClick='$("#roulette_amount").val(10); bet(); $(this).addClass("btn-yellow");' class="btn btn-outline-secondary">10</button>
                            <button id="bet" onClick='$("#roulette_amount").val(20); bet(); $(this).addClass("btn-yellow");' class="btn btn-outline-secondary">20</button>
                            <button id="bet" onClick='$("#roulette_amount").val(30); bet(); $(this).addClass("btn-yellow");' class="btn btn-outline-secondary">30</button>
                            <button id="bet" onClick='$("#roulette_amount").val(40); bet(); $(this).addClass("btn-yellow");' class="btn btn-outline-secondary">40</button>
                            <button id="bet" onClick='$("#roulette_amount").val(50); bet(); $(this).addClass("btn-yellow");' class="btn btn-outline-secondary">50</button>
                            <button id="bet" onClick='$("#roulette_amount").val(60); bet(); $(this).addClass("btn-yellow");' class="btn btn-outline-secondary">60</button>
                            <button id="bet" onClick='$("#roulette_amount").val(70); bet(); $(this).addClass("btn-yellow");' class="btn btn-outline-secondary">70</button>
                            <button id="bet" onClick='$("#roulette_amount").val(80); bet(); $(this).addClass("btn-yellow");' class="btn btn-outline-secondary">80</button>
                            <button id="bet" onClick='$("#roulette_amount").val(90); bet(); $(this).addClass("btn-yellow");' class="btn btn-outline-secondary">90</button>
                            <button id="bet" onClick='$("#roulette_amount").val(100); bet(); $(this).addClass("btn-yellow");' class="btn btn-outline-secondary">100</button>
                        </div>

                        <div class="row my-2">
                            <div class="col-sm-10">
                                <input class="d-none" type="number" id="roulette_amount" placeholder="เงินเดิมพัน" value="0"
                                    class="form-control d-block w-100 mb-2">
                            </div>
                        </div>
                        <button class="btn btn-yellow start d-block w-100"><i class="fa fa-play mr-1"></i>
                            เริ่ม
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/roulette.min.js"></script>
    <script>

        function bet() {
            $('[id="bet"]').removeClass("btn-yellow");
        }

        var request_response = {};
        var on_stop_count = 0;
        var option = {
            speed: 5,
            duration: 2,
            stopImageNumber: 0,
            startCallback: function () {
                $('.start').attr('disabled', 'true');
            },
            slowDownCallback: function () {},
            stopCallback: function ($stopElm) {
                on_stop_count++
                if (on_stop_count >= 3) {
                    $("#user_point").html(request_response["data"]["after_point"].toFixed(2))
                    swal("แจ้งเตือน", request_response["msg"], request_response["data"]["isWin"] ? "success" :
                        "warning").then(() => {});
                    $('.start').removeAttr('disabled');
                }
            }
        }

        function getRandomInt(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min) +
                min); //The maximum is exclusive and the minimum is inclusive
        }

        function setup_roulette(element) {
            var rouletter = element;
            rouletter.roulette(option);
            return rouletter
        }

        const rou_left = setup_roulette($('.roulette_left'))
        const rou_center = setup_roulette($('.roulette_center'))
        const rou_right = setup_roulette($('.roulette_right'))
        $('.start').click(function () {
            on_stop_count = 0


            var formData = new FormData();
            formData.append("point", $("#roulette_amount").val());
            $.ajax({
                url: "/api/v1/roulette",
                data: formData,
                method: 'POST',
                processData: false,
                contentType: false,
                success: (res) => {
                    $('button[type="submit"]').attr("disabled", false);

                    let data = $.parseJSON(res);
                    request_response = data

                    if (data["code"] == 300) {
                        swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                    } else if (data["code"] == 200) {
                        $("#user_point").html(data["data"]["before_point"].toFixed(2))
                        option["stopImageNumber"] = data["data"]["results"][0]
                        rou_left.roulette('option', option)
                        option["stopImageNumber"] = data["data"]["results"][1]
                        rou_center.roulette('option', option)
                        option["stopImageNumber"] = data["data"]["results"][2]
                        rou_right.roulette('option', option)
                        rou_left.roulette('start');
                        rou_center.roulette('start');
                        rou_right.roulette('start');
                    } else if (data["code"] == 400) {
                        swal("เกิดข้อผิดพลาด", data["msg"], "warning").then(() => {});
                    } else {
                        swal("เกิดข้อผิดพลาด", "An unknown error has occurred.", "warning").then(
                            () => {});
                    }
                }
            })
        });
    </script>

    <div class="container">
        Copyright &copy; 2022 <?= getBackend("storename", $pdo) ?>
        <div class="float-end">
            <a class="social-button bdiscord" href="<?= getBackend("discord", $pdo) ?>"><i
                    class="fa-1x fab fa-discord"></i></a>
            <a class="social-button bfacebook" href="<?= getBackend("facebook", $pdo) ?>"><i
                    class="fa-1x fab fa-facebook"></i></a>
            <a class="social-button bfacebook" href="https://pao.wtf/"><i class="fab fa-dev"></i></a>
        </div>
    </div>

    <script src="/script_new.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>