<!DOCTYPE html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require "db.php";
require "get.php";

if (isset($_SESSION["logging"])) {
    $stmt = $pdo->prepare("SELECT * FROM `account` WHERE id=?");
    $stmt->execute([$_SESSION["id"]]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION["point"] = $user["point"];
    $_SESSION["role"] = $user["rank"];
    $_SESSION["username"] = $user["username"];
}



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= getBackend("storename", $pdo) ?> - <?= $_GET["page"] ?></title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- <link rel="stylesheet" href="assets/bst.css"> -->

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="app.css.php">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="pace.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <meta name="title" content="Paotung Shop">
    <meta name="description" content="เว็บซ็อปตึง By REDz">
    <meta name="keywords" content="REDz, Redz, RedZ, redZ, redz, Paotung.me, truemoney.shop, Truemoney.shop, Truemoney, ทรูมันนี่, เติม Roblox, เติม robux, เติม R$, ซื้อ robux, R$, เติม Robux, Arc shop, Arcrobux, Robux, Roblox, เพชร FreeFire, เติมโรบัค, บัตรเติมเกม, โรบัค, minecraft, ไอดีเเท้, freefire, เติมเพชร, บัตรเติมเงิน, เติมเกม, สุดคุ้ม, steam wallet, ราคาถูก, Garena Shells, การีน่า, เติมเกมออนไลน์, ซื้อไนโตร, ไนโตรราคาถูก, Nitro, Nitro classic, Nitro Boost, Discord Nitro, Discord Nitro Classic, Discord Nitro Boost">
    <meta name="robots" content="index, follow">
    <meta name="author" content="REDz on the top">
    <link rel="shortcut icon" href="https://media.discordapp.net/attachments/857229079065788419/977731818939895848/Jirapon_Boonlum-2.png" type="image/x-icon">
</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>


    <?php
    print($_GET["page"]);
    return;
    if ($_GET["page"]) {
        if (!file_exists("template_page/{$_GET["page"]}.php")) {
    ?>
            <link rel="stylesheet" href="404.css">
            <div class="content">
                <div class="browser-bar">
                    <span class="close button"></span>
                    <span class="min button"></span>
                    <span class="max button"></span>
                </div>
                <div class="text"></div>
            </div>
            <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="typescript.js"></script>
    <?php
            return;
        } else {
            include("template_page/{$_GET["page"]}.php");
        }
    } else {
        Header("Location: ?page=index");
    }
    ?>

    <div class="container">
        Copyright &copy; 2022 Paotung.me
        <div class="float-end">
            <a class="social-button bdiscord" href="https://fb.com/Paotung.me/"><i class="fa-1x fab fa-discord"></i></a>
            <a class="social-button bfacebook" href="https://fb.com/Paotung.me/"><i class="fa-1x fab fa-facebook"></i></a>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


</body>

</html>