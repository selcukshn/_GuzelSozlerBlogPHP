$(function () {
    $(".comment-list").click(function (e) {
        if (e.target.classList.contains("btn-reply")) {
            let replyArea = $(".reply-area")
            if (replyArea != null) {
                replyArea.remove()
            }
            let html = `
            <div class="reply-area row row-cols-1 gx-0 bg-light p-2">
                <div class="col text-end">
                    <button type="button" class="btn btn-danger btn-sm btn-reply-remove"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="col my-2">
                    <textarea id="Reply" name="Reply" rows="5" class="form-control" placeholder="Cevabınız..."></textarea>
                </div>
                <div class="col">
                    <button id="addReply" type="button" class="btn btn-primary btn-sm">Gönder</button>
                </div>
            </div>
            `;
            e.target.parentElement.lastElementChild.innerHTML += html;
        }
        if (e.target.classList.contains("btn-reply-remove") || e.target.classList.contains("fa-xmark")) {
            $(".reply-area").remove()
        }
        if (e.target.id == "addReply") {
            const uid = $("#form-comment").find("#UserId").val();
            const ctoken = $("#form-comment").find("#comment-token").val();
            const cid = $(e.target).parents("#replyForm").children("#CommentId").val();
            const r = $("#Reply").val();
            $.ajax({
                method: "POST",
                url: "https://selcuksahintest.de/guzelsozler/admin/backend/ajax.php?operation=add-reply",
                data: {
                    comment_token: ctoken,
                    UserId: uid,
                    CommentId: cid,
                    Reply: r
                },
                dataType: "json",
                success: function (data) {
                    swal({
                        icon: data.type,
                        title: data.title,
                        text: data.message,
                        button: "Kapat"
                    })
                }
            })
        }
    })
})