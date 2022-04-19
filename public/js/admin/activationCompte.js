function enableAccount(id) {
    var button = document.getElementById(id);
    var token = button.dataset.token;
    console.log(token)

    $.ajax({
        method: "POST",
        url: "https://gaea21user.sustlivprogram.org/apictrl/confirm/" + token,
        dataType: "json",
        contentType:"application/json",
        data: "",
        success: function (response) {
            console.log(response);
            location.href = "/listAccount";

        }
    });

}