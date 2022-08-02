$(function () {
    $("#form-comment").on("submit", function (e) {
        e.preventDefault();
        const data = $(this).serialize();
        $.ajax({
            method: "POST",
            url: "https://selcuksahintest.de/guzelsozler/admin/backend/ajax.php?operation=add-comment",
            data: data,
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
    })
})