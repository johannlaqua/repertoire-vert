$(function () {

    let passisvalid = false;
    let pass = document.querySelector('#mdp');


    pass.addEventListener('change', function () {
        verifyPassword(this);
    });

    let verifyPassword = function (password) {
        if (password.value.length < 8) {
            document.getElementById('validpassword').innerHTML = '<span style="color:red;">Votre mot de passe doit contenir au moins 8 caractères</span>';
        } else if (!/[A-Z]/.test(password.value)) {
            document.getElementById('validpassword').innerHTML = '<span style="color:red;">Votre mot de passe doit contenir au moins un caractère en majuscule</span>';
        } else if (!/[0-9]/.test(password.value)) {
            document.getElementById('validpassword').innerHTML = '<span style="color:red;">Votre mot de passe doit contenir au moins un chiffre</span>';
        } else if (!/[a-z]/.test(password.value)) {
            document.getElementById('validpassword').innerHTML = '<span style="color:red;">Votre mot de passe doit contenir au moins un caractère en minuscule</span>';
        } else {
            document.getElementById('validpassword').innerHTML = '';
            passisvalid = true;
        }
    }

    $("#button").on("click", function (){
        document.getElementById('champerreurs').innerHTML = '<span></span>';

        let password = md5($("#mdp").val());
        let confirmedpassword = md5($("#mdpconfirm").val());
        console.log(password, confirmedpassword)

        if(passisvalid){
            $.ajax({
                method: "PUT",
                url: "https://gaea21user.sustlivprogram.org/apictrl/resetpassword/"+token,
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify({
                    password: password,
                    newpassword: confirmedpassword
                }),
                /*error: function (xhr, status, error) {
                    console.log(xhr, status, error);
                    document.getElementById('champserreurs').innerHTML = '<span style="color:red;">Une erreur est survenue. Veuillez réessayer.</span>';
                    $("#load").removeClass('spinner-border');
                    $("#post").attr('disabled', false);
                    $('.div-msg-valid img').addClass('hidden');
                },*/
            }).done(function (response) {

                console.log(response);
                let code = response.status;
                let message = response.message;

                if (code != 201 && message != undefined) {
                    document.getElementById('champerreurs').innerHTML = '<span style="color:red;">'+message+'</span>';
                    //$("#load").removeClass('spinner-border');
                    //$('.div-msg-valid img').addClass('hidden');
                } if(code == 201) {
                    $('.success').removeClass('hidden');
                }

            })
        }


    })

})

