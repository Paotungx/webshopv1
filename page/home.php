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
    <title><?= getBackend("storename", $pdo) ?> - หน้าหลัก</title>
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
    <meta name="title" content="Paotung Shop">
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
            <div class="col-lg-12 marginshop bg-white shadow-lg fww p-3 py-4 animate__animated animate__fadeIn">
                <div class="item-load"></div>
            </div>

        </div>

        <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content b10p">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title-cargo"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-0 border-0">
                            <img id="image-cargo" class="img-fluid modal-img" src="">
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <p id="stock-cargo" class="mt-2 m-0 p-0">สินค้าคงเหลือ: <span
                                        class="badge bg-dark">0</span>
                                    ชิ้น</p>
                                <p id="sold-cargo" class="m-0 p-0">ขายไปแล้ว: <span class="badge bg-dark">0</span> ชิ้น
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <hr>
                            </div>
                            <div class="col-auto">รายละเอียด</div>
                            <div class="col">
                                <hr>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <div id="details-cargo" style="white-space: pre-wrap;"></div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <hr>
                            </div>
                            <div class="col-auto">จำนวนสินค้าที่จะซื้อ</div>
                            <div class="col">
                                <hr>
                            </div>
                        </div>
                        <div class="d-grid mt-2">
                            <div class="input-group">
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                    class="minus input-group-text rounded-start rounded-0">-</button>
                                <input class="form-control text-center quantity" id="amount_item" min="0"
                                    name="quantity" value="1" type="number">
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                    class="plus input-group-text rounded-end rounded-0">+</button>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer" id="cargo-buy">
                        <button id="cargo-buy" onclick="" class="btn btn-yellow">ซื้อสินค้า</button>
                    </div>
                </div>
            </div>
        </div>


        <script>
            // swal("ปิดปรับปรุงชั่วคราว", "หากท่านซื้อสินค้าตอนนี้ทีมงานจะไม่คืนเงินทุกกรณี", "error");

            function linkify(inputText) {
                var replacedText, replacePattern1, replacePattern2, replacePattern3;

                replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
                replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');

                replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
                replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');

                replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
                replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

                return replacedText;
            }

            function buy_cargo(id) {
                var formData = new FormData();
                formData.append("amount", $("#amount_item").val());
                $.ajax({
                    url: "/api/v1/buy/" + id,
                    data: formData,
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    success: (res) => {
                        let data = $.parseJSON(res);
                        if (data["code"] == "200") {
                            swal("สำเร็จ", data["msg"], "success").then(() => {
                                $('[name="ref"]').val("");
                                location.reload();
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 3000);

                            $("#myModal").modal('hide');
                        } else if (data["code"] == "401") {
                            swal("เกิดข้อผิดพลาด", data["msg"], "warning").then(() => {});
                        } else {
                            swal("เกิดข้อผิดพลาด", "An unknown error has occurred.", "warning").then(
                                () => {});
                            // $('[class="msg-alert"]').text("An unknown error has occurred.");
                        }

                    }
                })
            }

            function viewcargo(id) {

                var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
                    keyboard: false
                })
                myModal.show()
                // $("#myModal").modal();
                $('h5[id="title-cargo"]').html('กำลังโหลดข้อมูล');
                $('img[id="image-cargo"]').attr("src", '')
                $('div[id="details-cargo"]').html('<i class="fad fa-spinner fa-spin"></i> กำลังโหลด')
                $('p[id="stock-cargo"]').html(`สินค้าคงเหลือ: <span class="badge bg-dark">-</span> ชิ้น`)
                $('p[id="sold-cargo"]').html(`ขายไปแล้ว: <span class="badge bg-dark">-</span> ชิ้น`)
                $('div[id="cargo-buy"]').html(
                    `<button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fad fa-spinner fa-spin"></i> กำลังโหลด</button>`
                )

                var formData = new FormData();

                $.ajax({
                    url: "/api/v1/getitems/" + id,
                    data: formData,
                    method: 'GET',
                    processData: false,
                    contentType: false,
                    success: (res) => {
                        let data = $.parseJSON(res);

                        if (data["code"] == "200") {
                            $('h5[id="title-cargo"]').html(data["data"]["name"]);
                            $('img[id="image-cargo"]').attr("src", data["data"][`image`])
                            $('div[id="details-cargo"]').html(linkify(data["data"][`details`]))
                            $('div[id="cargo-buy"]').html(data["button"])
                            $('p[id="stock-cargo"]').html(
                                `สินค้าคงเหลือ: <span class="badge bg-dark">${data["data"]["stock"]}</span> ชิ้น`
                            )
                            $('p[id="sold-cargo"]').html(
                                `ขายไปแล้ว: <span class="badge bg-dark">${data["data"]["sold"]}</span> ชิ้น`
                            )
                        }
                    }
                })

            }

            // let DataForm = $('form[data-form="Register"]').serializeArray();
            var formData = new FormData();
            $.ajax({
                url: "/api/v1/getitems",
                data: formData,
                method: 'GET',
                processData: false,
                contentType: false,
                success: (res) => {
                    let data = $.parseJSON(res);
                    if (data["code"] == "200") {
                        $('div[class="item-load"]').append('<div id="item-list"></div>');

                        $('button[onclick="NextItem()"]').attr("onclick", "NextItem(0,2)");
                        $('button[onclick="BackItem()"]').attr("onclick", "BackItem(0,2)");

                        var array = $.parseJSON(res);
                        array["data"].forEach(function (object) {
                            $('div[id="item-list"]').append(`
                            <div class="d-inline store-item shadow-sm border-top border-bottom">
                            ${object.stock <= 5 ? `<p class="redzno1label" style="
position: absolute;
color: #fff;
padding: 4px 15px;
border-bottom-right-radius:10px;
border-top-left-radius:10px;
">${object.stock <= 0 ? "หมดแล้ว" : `${object.stock} ชิ้นสุดท้าย!`}</p>` : ""}
                                <img src="${object.image}" class="border-top" alt="">  
                                <div class="p-2">
                                    <span" style="font-size:16.5px;">${object.name}</span>
                                    <button class="product-btn btn-yellow" onclick="viewcargo(${object.id})">ซื้อสินค้า (${object.price} Point)</button>
                                </div>
                            </div>
                    `);
                        });

                    } else {
                        $('div[class="item-load"]').append(`
                        <div class="alert alert-warning" role="alert">
                        <i class='fa fa-question'></i> ไม่พบสินค้า
                        </div>
                        `)
                    }
                }
            })
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