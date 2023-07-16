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
    <title><?= getBackend("storename", $pdo) ?> - เติมเงิน</title>
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

</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <div class="container py-0">
        <div class="row ">
            <div class="col-lg-7 mx-auto marginshop bg-white shadow-lg fww p-3 py-4 animate__animated animate__fadeIn">
                <div class="card rounded-0">
                    <div class="card-header h4 text-white border-top border-bottom">TOPUP & REDEEM</div>
                    <div class="card-body">

                        <div class="alert alert-warning my-2 d-none" role="alert">
                            <i class="fas fa-bell"></i> เติมเงิน Truemoney Gift <span class="font-weight-bold">X2</span>
                        </div>


                        <div class="dropdown d-grid">
                            <button class="btn btn-gray rounded-0 p-2 text-left dropdown-toggle"
                                type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <div id="eventchangetopup text-left">
                                    <img id="topupimage" class="image-list-topup"
                                        src="/assets/image/payment/wallet_gift.png">
                                    <label class="text-dark" id="topuplabel" for="">Truemoney Gift</label>
                                    <small id="topupdesc"
                                        class="list-topup-desc">เติมเงินด้วยซองของขวัญทรูมันนี่วอเล็ท</small>
                                </div>
                            </button>

                            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" id="v-pills-tab"
                                role="tablist" aria-orientation="vertical">
                                <li><a class="dropdown-item active " onclick="changetopup('truemoney_gift')"
                                        id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"
                                        type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                        <img class="image-list-topup" src="/assets/image/payment/wallet_gift.png">
                                        <label for="">Truemoney Gift</label>
                                        <small class="list-topup-desc">เติมเงินด้วยซองของขวัญทรูมันนี่วอเล็ท</small>
                                    </a></li>
                                <li><a class="dropdown-item" onclick="changetopup('redeem')" id="v-pills-profile-tab"
                                        data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab"
                                        aria-controls="v-pills-profile" aria-selected="false">
                                        <img class="image-list-topup" src="/assets/image/payment/gift.png">
                                        <label for="">Redeem Code</label>
                                        <small class="list-topup-desc">รหัสโค้ด</small>
                                    </a></li>
                            </ul>
                        </div>

                        <div class="tab-content py-2" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab" tabindex="0">
                                <div
                                    class="kbank-box d-flex flex-row align-items-center justify-content-start p-0 text-center d-grid gap-2">
                                    <div class="">
                                        <img src="https://i.imgur.com/Y69Ov4u.jpg" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <form data-form="topupwallet" class="d-grid gap-2">
                                    <input type="text" name="ref"
                                        placeholder="https://gift.truemoney.com/campaign/?v=XXXX" class="form-control">
                                    <button type="submit" class="btn btn-yellow btn-block">เติมเงิน</button>
                                </form>

                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab" tabindex="0">
                                <form data-form="redeem" class="d-grid gap-2">
                                    <input type="text" name="ref" placeholder="รหัสโค้ด" class="form-control">
                                    <button class="btn btn-yellow btn-block">แลกของขวัญ</button>
                                </form>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changetopup(topup) {

            if (topup == "redeem") {
                $('img[id="topupimage"]').attr("src", "/assets/image/payment/gift.png");
                $('label[id="topuplabel"]').html("Redeem Code");
                $('small[id="topupdesc"]').html("รับเงินด้วยของขวัญ");
            } else if (topup == "truemoney_gift") {
                $('img[id="topupimage"]').attr("src", "/assets/image/payment/wallet_gift.png");
                $('label[id="topuplabel"]').html("Truemoney Gift");
                $('small[id="topupdesc"]').html("เติมเงินด้วยซองของขวัญทรูมันนี่วอเล็ท");
            }
        }
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