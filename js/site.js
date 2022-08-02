var SITE_URL = "https://selcuksahintest.de/guzelsozler/";

$(function () {
    $(".header-nav-collapse-btn button").click(function () {
        if ($(".header-nav .nav").css("display") == "none") {
            $(".header-nav .nav").show();
        } else {
            $(".header-nav .nav").hide();
        }
    })
    //! Login
    $("#form-login").on("submit", function (e) {
        e.preventDefault();
        $("#btn-login").prop("disabled", true);
        $(".onload").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

        const userData = $(this).serialize();
        $.ajax({
            type: "post",
            url: SITE_URL + "/admin/backend/ajax.php?operation=login",
            data: userData,
            dataType: "json",
            success: function (data) {
                var returnUrl = "";
                if (typeof data.return !== 'undefined') {
                    returnUrl = data.return;
                }
                toastr[data.type](data.message);

                if (data.type != "success") {
                    $(".onload").html("");
                    $("#btn-login").prop("disabled", false);
                } else {
                    setTimeout(function () {
                        window.location.href = SITE_URL + returnUrl;
                    }, 2000);
                }
            }
        });

    })
    //! Register
    $("#form-register").on("submit", function (e) {
        e.preventDefault();
        $("#btn-register").prop("disabled", true);
        $(".onload").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

        const userData = $(this).serialize();
        $.ajax({
            type: "post",
            url: SITE_URL + "/admin/backend/ajax.php?operation=register",
            data: userData,
            dataType: "json",
            success: function (data) {

                toastr[data.type](data.message);

                if (data.type != "success") {
                    $(".onload").html("");
                    $("#btn-register").prop("disabled", false);
                } else {
                    setTimeout(function () {
                        window.location.href = SITE_URL + "/giris-yap";
                    }, 2000);
                }
            }
        });

    })
    //! Last added show more
    $(document).on("click", ".last-added-show_more_btn", function () {
        var lastItem = $(this).attr("last-item");
        $(".onload")
            .html(`<div class="bounce py-3">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>`);
        $(this).text("Yükleniyor...");
        $(this).prop("disabled", true);

        $.ajax({
            type: "post",
            url: SITE_URL + "admin/backend/ajax.php?operation=last-added-show_more",
            data: { "LastItem": lastItem },
            dataType: "json",
            success: (data) => {
                $(".onload").html("");
                $(this).text("Daha fazla göster");
                $(this).prop("disabled", false);

                if (data.error) {
                    $(".last-added-show_more").html("Hata");
                } else {
                    $(".last-added-row").append(data.card);
                    $(".last-added-show_more").html(data.button);
                }


            }
        });
    });
    //! Post like
    $("#like").click(function (e) {
        e.preventDefault();
        const likePrev = $("#like-prev");
        const likeCount = parseInt($("#like-prev span").text());
        const likeIcon = $("#like");
        const liked = likePrev.attr("liked");
        var like;
        if (liked == "true") {
            like = false;
        }
        if (liked == "false") {
            like = true;
        }
        if (liked != "true" && liked != "false") {
            alert("Geçersiz işlem");
        } else {
            const postId = $("#form-comment input[name='PostId']").val();
            const userId = $("#form-comment input[name='UserId']").val();
            $.ajax({
                type: "post",
                url: SITE_URL + "admin/backend/ajax.php?operation=post-like",
                data: { "PostId": postId, "UserId": userId, "Like": like },
                dataType: "json",
                success: (data) => {
                    toastr[data.type](data.message);
                    if (data.type == "success") {
                        if (liked == "true") {
                            likeIcon.text("Beğen");
                            likePrev.attr("liked", "false");
                            likePrev.html(`
                            <div class="rounded-circle  p-2">
                                <div class="d-flex justify-content-start align-items-center fs-3">
                                    <span class="me-1">${likeCount - 1}</span>
                                    <i class="fa-regular fa-heart"></i>
                                </div>
                            </div>
                        `);
                        }
                        if (liked == "false") {
                            likeIcon.text("Beğenme");
                            likePrev.attr("liked", "true");
                            likePrev.html(`
                            <div class="rounded-circle p-2">
                                <div class="d-flex justify-content-start align-items-center text-danger fs-3">
                                    <span class="me-1">${likeCount + 1}</span>
                                    <i class="fa-solid fa-heart"></i>
                                </div>
                            </div>
                        `);
                        }
                    }
                }
            });
        }
    })
})