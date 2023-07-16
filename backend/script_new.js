$(document).ready(function () {
    console.log("ready!");

    setTimeout(() => {
        $("body").css("opacity", 1);
    }, 500);
});
    $('input[name="RedeemCodeCustom"]').hide();
    $('select[name="keys"]').change(function () {
        if ($('select[name="keys"]').val() == "custom") {
            $('input[name="RedeemCodeCustom"]').show();
        } else {
            $('input[name="RedeemCodeCustom"]').hide();
        }
    });

    async function delitem(id) {
        if (!await swal("??", {
                icon: "info",
                buttons: ["cancel", true],
            })) return;
        var formData = new FormData();
        formData.append("id", id);
        $.ajax({
            url: "/api/v1/deleteitem",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });

                    setTimeout(() => {
                        location.reload();
                    }, 3000);
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
    }

    async function delstock(id, pass) {
        if (!await swal("??", {
                icon: "info",
                buttons: ["cancel", true],
            })) return;
        var formData = new FormData();
        formData.append("id", id);
        formData.append("pass", pass);
        $.ajax({
            url: "/api/v1/deletestock",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });

                    setTimeout(() => {
                        location.reload();
                    }, 3000);
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
    }

    async function delredeem(id) {
        if (!await swal("??", {
                type: "info",
                buttons: ["cancel", true],
            })) return;
        var formData = new FormData();
        formData.append("id", id);
        $.ajax({
            url: "/api/v1/deleteredeem",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });

                    setTimeout(() => {
                        location.reload();
                    }, 3000);
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
    }

    function EditItem(id) {
        var formData = new FormData();
        formData.append("id", id);
        $.ajax({
            url: "/api/v1/edititem",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    const myModal = new bootstrap.Modal('#editItemModal', {
                        keyboard: false
                    })
                    myModal.show();
                    $('[name="idq"]').attr("value", data["id"]);
                    $('[name="imageq"]').attr("value", data["image"]);
                    $('[name="pointq"]').attr("value", data["point"]);
                    $('[name="detailq"]').html(data["detail"]);
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
    }

    $('form[data-form="wallet-gift"]').on("submit", (e) => {
        e.preventDefault();
        let DataForm = $('form[data-form="wallet-gift"]').serializeArray();
        var formData = new FormData();
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/changewallet",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });

                    setTimeout(() => {
                        location.reload();
                    }, 3000);
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

    $('form[data-form="facebookchange"]').on("submit", (e) => {
        e.preventDefault();
        let DataForm = $('form[data-form="facebookchange"]').serializeArray();
        var formData = new FormData();
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/changefacebook",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });

                    setTimeout(() => {
                        location.reload();
                    }, 3000);
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

    $('form[data-form="discordchange"]').on("submit", (e) => {
        e.preventDefault();
        let DataForm = $('form[data-form="discordchange"]').serializeArray();
        var formData = new FormData();
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/changediscord",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });

                    setTimeout(() => {
                        location.reload();
                    }, 3000);
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

    $('form[data-form="logochange"]').on("submit", (e) => {
        e.preventDefault();
        let DataForm = $('form[data-form="logochange"]').serializeArray();
        var formData = new FormData();
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/changelogo",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });

                    setTimeout(() => {
                        location.reload();
                    }, 3000);
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

    $('form[data-form="iconchange"]').on("submit", (e) => {
        e.preventDefault();
        let DataForm = $('form[data-form="iconchange"]').serializeArray();
        var formData = new FormData();
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/changeicon",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });

                    setTimeout(() => {
                        location.reload();
                    }, 3000);
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

    $('form[data-form="colorchange"]').on("submit", (e) => {
        e.preventDefault();
        let DataForm = $('form[data-form="colorchange"]').serializeArray();
        var formData = new FormData();
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/changecolor",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });

                    setTimeout(() => {
                        location.reload();
                    }, 3000);
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

    $('form[data-form="bannerchange"]').on("submit", (e) => {
        e.preventDefault();
        var formData = new FormData();
        formData.append("action", "bannerchange");
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/changebanner",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
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


    $('form[data-form="storenamechange"]').on("submit", (e) => {
        e.preventDefault();
        let DataForm = $('form[data-form="storenamechange"]').serializeArray();
        var formData = new FormData();
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/changenamestore",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
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

    $('form[data-form="edititemqq"]').on("submit", (e) => {
        e.preventDefault();
        let DataForm = $('form[data-form="edititemqq"]').serializeArray();
        var formData = new FormData();
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/editstock",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });
                    $('[name="idq"]').attr("value", "");
                    $('[name="imageq"]').attr("value", "");
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
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

    $('form[data-form="Cargo_Add"]').on("submit", (e) => {
        e.preventDefault();
        let DataForm = $('form[data-form="Cargo_Add"]').serializeArray();
        var formData = new FormData();
        formData.append("action", "Cargo_Add");
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/addproduct",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
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


    $('form[data-form="stockadd"]').on("submit", (e) => {
        e.preventDefault();
        let DataForm = $('form[data-form="stockadd"]').serializeArray();
        var formData = new FormData();
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/addstock",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);

                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        $('input[id="stocklist"]').val("");
                        // $('input[id="stockid"]').val("");
                        // $('input[id="stockpass"]').val("");
                        location.reload();
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
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

    $('form[data-form="key_point"]').on("submit", (e) => {
        e.preventDefault();
        let DataForm = $('form[data-form="key_point"]').serializeArray();
        var formData = new FormData();
        if (typeof formData == "object") {
            for (let k in DataForm) {
                formData.append(DataForm[k].name, DataForm[k].value);
            }
        } else if (typeof formData == "function") {
            callback = formData;
        }
        $.ajax({
            url: "/api/v1/addredeem",
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res) => {
                let data = $.parseJSON(res);
                if (data["code"] == 300) {
                    // $('[class="msg-alert"]').text(data["msg"]);
                    swal("แจ้งเตือน", data["msg"], "warning").then(() => {});
                } else if (data["code"] == 200) {
                    swal("สำเร็จ", data["msg"], "success").then(() => {
                        location.reload();
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
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