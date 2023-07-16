$(document).ready(function () {
    console.log("ready!");

    setTimeout(() => {
        $("body").css("opacity", 1);
    }, 500);
    
    toastr.options.escapeHtml = true;
    toastr.options.preventDuplicates = true;

    function logout(e) {
        $.ajax({
            url: "/api/v1/logout",
            data: {},
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                swal("สำเร็จ", "ออกจากระบบแล้ว!", "success").then(() => {
                    location.reload();
                });

                setTimeout(() => {
                    location.reload();
                }, 3000);
            }
        })
    }

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }


    $('[data-form="changepassword"]').on("submit", (e) => {
        e.preventDefault();
        $('button[type="submit"]').prop("disabled", true);
        let DataForm = $('form[data-form="changepassword"]').serializeArray();
        var formData = new FormData();
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/changepassword",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {

                $('button[type="submit"]').attr("disabled", false);

                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });
                    // $('[class="msg-alert"]').text("");
                } else if (data["code"] == 400) {
                    swal("เกิดข้อผิดพลาด", data["msg"], "warning").then(() => {});
                    // $('[class="msg-alert"]').text(data["msg"]);
                } else {
                    swal("เกิดข้อผิดพลาด", "An unknown error has occurred.", "warning").then(() => {});
                    // $('[class="msg-alert"]').text("An unknown error has occurred.");
                }
            }
        })
    });

    $('[data-form="redeem"]').on("submit", (e) => {
        e.preventDefault();
        $('button[type="submit"]').prop("disabled", true);
        let DataForm = $('form[data-form="redeem"]').serializeArray();
        var formData = new FormData();
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/topup/redeem",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {

                $('button[type="submit"]').attr("disabled", false);

                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        $('[name="ref"]').val("");
                        location.reload();
                    });
                    // $('[class="msg-alert"]').text("");
                } else if (data["code"] == 400) {
                    swal("เกิดข้อผิดพลาด", data["msg"], "warning").then(() => {});
                    // $('[class="msg-alert"]').text(data["msg"]);
                } else {
                    swal("เกิดข้อผิดพลาด", "An unknown error has occurred.", "warning").then(() => {});
                    // $('[class="msg-alert"]').text("An unknown error has occurred.");
                }
            }
        })
    });

    $('[data-form="topupwallet"]').on("submit", (e) => {
        e.preventDefault();
        $('button[type="submit"]').prop("disabled", true);
        let DataForm = $('form[data-form="topupwallet"]').serializeArray();
        var formData = new FormData();
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/topup/wallet",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {

                $('button[type="submit"]').attr("disabled", false);

                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        $('[name="ref"]').val("");
                        location.reload();
                    });
                    // $('[class="msg-alert"]').text("");
                } else if (data["code"] == 400) {
                    swal("เกิดข้อผิดพลาด", data["msg"], "warning").then(() => {});
                    // $('[class="msg-alert"]').text(data["msg"]);
                } else {
                    swal("เกิดข้อผิดพลาด", "An unknown error has occurred.", "warning").then(() => {});
                    // $('[class="msg-alert"]').text("An unknown error has occurred.");
                }
            }
        })
    });

    $('[data-form="Login"]').on("submit", (e) => {
        e.preventDefault();
        $('button[type="submit"]').prop("disabled", true);
        let DataForm = $('form[data-form="Login"]').serializeArray();
        var formData = new FormData();
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/login",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                toastr.options.escapeHtml = true;
                toastr.options.preventDuplicates = true;
                $('button[type="submit"]').attr("disabled", false);

                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {
                        grecaptcha.reset();
                    });
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });
                    // $('[class="msg-alert"]').text("");
                } else if (data["code"] == 400) {
                    swal("เกิดข้อผิดพลาด", data["msg"], "warning").then(() => {
                        grecaptcha.reset();
                    });
                    // $('[class="msg-alert"]').text(data["msg"]);
                } else {
                    swal("เกิดข้อผิดพลาด", "An unknown error has occurred.", "warning").then(() => {
                        grecaptcha.reset();
                    });
                    // $('[class="msg-alert"]').text("An unknown error has occurred.");
                }
            }
        })
    });

    $('[data-form="Register"]').on("submit", (e) => {
        e.preventDefault();
        $('[class="login-button"]').prop("disabled", true);
        let DataForm = $('form[data-form="Register"]').serializeArray();
        var formData = new FormData();
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/register",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                toastr.options.escapeHtml = true;
                toastr.options.preventDuplicates = true;
                $('[class="login-button"]').attr("disabled", false);

                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {
                        grecaptcha.reset();
                    });
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });
                    // $('[class="msg-alert"]').text("");
                } else if (data["code"] == 400) {
                    swal("เกิดข้อผิดพลาด", data["msg"], "warning").then(() => {
                        grecaptcha.reset();
                    });
                    // $('[class="msg-alert"]').text(data["msg"]);
                } else {
                    swal("เกิดข้อผิดพลาด", "An unknown error has occurred.", "warning").then(() => {
                        grecaptcha.reset();
                    });
                    // $('[class="msg-alert"]').text("An unknown error has occurred.");
                }
            }
        })
    });
});