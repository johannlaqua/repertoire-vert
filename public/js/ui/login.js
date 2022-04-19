

export function login() {

    console.log("login appelé")
    var password = $("#password").val();
    var email = $("#email").val();

    //$("#btnn").on("click",function () {
        console.log('Log in en cours')
        console.log($("#password").val(),$("#email").val() );
        if ($("#password").val() && $("#email").val() ) {
            password =  md5($("#password").val());
            // $("#load").addClass('spinner-border');
            // $("#load").css({
            //     'role':'status',
            //     'aria-hidden':'true'
            // });
            $("#btnn").attr('disabled',true);
            console.log('ok');

            $.ajax({
                method: "POST",
                url: "https://gaea21user.sustlivprogram.org/apictrl/login",
                dataType :"json",
                contentType:"application/json",
                data: JSON.stringify({
                    email : $("#email").val(),
                    password : password,
                }),
                error: function() {
                    //$("#load").removeClass('spinner-border');
                    $("#btnn").attr('disabled',false);
                    document.getElementById('errorlocation').innerHTML = '<span style="color:red;">Une erreur est survenue. Veillez à saisir des informations conformes à votre compte ou essayez ultérieurement.</span>';
                },

            }).done(function(response) {
                console.log(response)
                let {id, username, email, message} = response;
                if (id)
                {
                    $.ajax({
                        method: "POST",
                        url: "/company/active",
                        data: { id }
                    }).done((response) => {
                        if (response.activated) {
                            $.redirect('/profile/entreprise', {id,email,username});
                            //location.href = '/profile/entreprise'
                        } else {
                            document.getElementById('errorlocation').innerHTML = `<p>${response.message}</p>`;
                        }
                    });
                }
                else{
                    document.getElementById('errorlocation').innerHTML =  '<p>'+message+ '</p>';
                    //$("#load").removeClass('spinner-border');
                    $("#btnn").attr('disabled',false);
                }
            });

        }
        else{
            document.getElementById('error').innerHTML = '<span style="color:red;">Veuillez remplir les champs</span>';
            console.log('ok');
        }

}

