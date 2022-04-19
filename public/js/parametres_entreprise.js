var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

$('.supprimer-logo').click(function () {
    $(".div-erreur-image").html("");
    $('#logo-file').val('');
    console.log($('#logo').val())
    $('.emplacement-upload').text('Aucun fichier');
    document.querySelector('[type=file]').value = "";
    console.log(document.querySelector('[type=file]').files[0])
});

$('.upload-logo').change(function () {

    var logo = $('#logo-file').val();
    console.log('logo = ', logo)
    $('.emplacement-upload').text(logo);

    verifyImage();

    if(logo == ""){
        $('.emplacement-upload').text('Aucun fichier');
        console.log(document.querySelector('[type=file]').value)
        document.querySelector('[type=file]').value = null;
    }

});


$('.label-btn-maj-data').click(function ()
{
    $('.div-msg-valid img').removeClass('hidden')
    $( ".div-msg-data" ).addClass('hidden');
    document.getElementById('form-error').innerHTML = '<span style="color:red;"></span>';

    console.log(fileAllowed)
    verifyImage();
    console.log(fileAllowed)

    let wantEvalYes = document.getElementById("evaluationYes");
    let wantEval = wantEvalYes.checked ? true : false;

    let formData = new FormData();
    var address = $("#new_adress").val() + " " + $("#new_town").val() + " " + $("#new_country").val();

    var date = $("#date_day").val() + '-' + $("#date_month").val() + '-' + $("#date_year").val()

    /*let categories = [];
    $.get('/rest/category', function(dataCategories) {
        dataCategories.forEach(category => {
            let checkbox = document.getElementById(category.name)
            if(checkbox.checked){
                categories.push(category)
            }
        })*/

        $.get(location.protocol + '//nominatim.openstreetmap.org/search?format=json&q=' + address, function (data) {

            if(data[0] && fileAllowed){

                let objArr = {
                    //"nickname" :    $("#new_nickname").val(),
                    "company" :    $("#new_name").val(),
                    "departement" :    $("#new_street").val(),
                    //"email" :   $("#new_email").val(),
                    //"email_conf" :    $("#new_email_comf").val(),
                    "name" :    $("#new_company_name").val(),
                    "socialreason" :    $("#new_social").val(),
                    "street" :    $("#new_adress").val(),
                    "city" :    $("#new_town").val(),
                    "postcode" :    $("#new_postal").val(),
                    "country" :    $("#new_country").val(),
                    "phone" :    $("#new_phone").val(),
                    "urlwebsite" :    $("#new_urlweb").val(),
                    "urllinkedin" :    $("#new_linkedin").val(),
                    "urlfacebook" :    $("#new_fburl").val(),
                    "urltwitter" :    $("#new_twitter").val(),
                    "startingdate" : date,
                    //"categories": categories,
                    "certification" :    $("#new_certif").val(),
                    "influencezone" :    $("#influenceZone").val(),
                    "wantevaluation": wantEval,
                    "description" : $("#new_desc").val(),
                    "vision" : $("#new_vision").val(),
                    "latitude": parseFloat(data[0].lat),
                    "longtitude": parseFloat(data[0].lon),
                    "niveau": wantEval ? 'N.1' : 'N.0',
                    "nom": $("#new_lastname").val(),
                    "prenom": $("#new_firstname").val(),
                };

                formData.append('objArr',JSON.stringify(objArr));
                console.log(file)
                formData.append("file", file);


                $.ajax({
                    method: "POST",
                    url: "/redirectModify/",
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    data: formData,

                    //error: function (xhr, status, error) {
                    //     document.getElementById('form-error').innerHTML = '<span style="color:red;">Une erreur est survenue. Veuillez réessayer.</span>';
                    //     $("#load").removeClass('spinner-border');
                    //     $("#post").attr('disabled', false);
                    // },

                }).done(
                    function(response2) {
                        console.log(response2);
                        $('.div-msg-valid img').addClass('hidden');
                        $( ".div-msg-data" ).removeClass('hidden');
                    }
                )
            } else {
                $('.div-msg-valid img').addClass('hidden');
                if (!data[0]) {
                    document.getElementById('form-error').innerHTML = '<span style="color:red;">Veuillez entrer une adresse existante</span>';
                }
            }


        })


    //});
});

/////////////////////////////////////////////////
// CHANGER LE MDP //////////////////////////////
const title_mdp = $('.title-mdp')
console.log(title_mdp)
const form_mdp = $('.div-modif-mdp')
const mdp_obligatoire = $('.legende-astérix-mdp')
const mdp_submit = $('.label-btn-maj-mdp')
/*form_mdp.hide()
mdp_obligatoire.hide()
mdp_submit.hide()
console.log(title_mdp)
title_mdp.click(function () {
    form_mdp.toggle()
    mdp_obligatoire.toggle()
    mdp_submit.toggle()
})*/




// bouton "mettre a jour"

$(function () {

    let passisvalid = false;
    let pass = document.querySelector('#newpass');


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

    mdp_submit.click(function () {
        var actualpass = $("#actualpass").val()
        var newpass = $("#newpass").val()
        var confirmnewpass = $("#confirmnewpass").val()
        var email = $("#actualpass").data('email')
        console.log(actualpass,newpass,confirmnewpass,email)

        if ($("#actualpass").val() && passisvalid && $("#confirmnewpass").val()) {
            if(newpass==confirmnewpass){
            password =  md5(actualpass);
            newpassword = md5(newpass);
            newpasswordconfirmed = md5(newpass);
            mdp_submit.attr('disabled',true);
            console.log('Toutes les conditions de remplissages sont bonnes, on verifie si le mot de passe est celui du compte');

            $.ajax({
                method: "PUT",
                url: "https://gaea21user.sustlivprogram.org/apictrl/changepassword",
                dataType :"json",
                contentType:"application/json",
                data: JSON.stringify({
                    email : email, // il faudra recuperer lemail de l'user connecté mais je sais pas le faire
                    password : password,
                    newpassword : newpassword,
                    newpasswordconfirmed : newpasswordconfirmed,
                    }),
                error: function() {
                    console.log("Erreur api")
                    //mdp_submit.attr('disabled',false);
                    //document.getElementById('error').innerHTML = '<span style="color:red;">Une erreur est survenue. Veillez à saisir des informations conformes à votre compte ou essayez ultérieurement.</span>';
                    },

            }).done(function(response) {
                console.log(response);
                var id = response.id ;
                var message = response.message;
                if (id) {
                    console.log("Le mot de passe a bien été modifié");
                    document.getElementById('msgmodifmdp').innerHTML = 'Votre mot de passe a bien été modifié, ne l\'oubliez surtout pas !' ;
                }
                else{
                    console.log(message)
                    document.getElementById('msgmodifmdp').innerHTML = message;
                }
            });
            }
            else{
                console.log('Les nouveaux mots de passes ne sont pas les mêmes');
                document.getElementById('msgmodifmdp').innerHTML = 'Les nouveaux mots de passes ne sont pas les mêmes' ;
            }
        }
        else{
            console.log('Les champs ne sont pas tous remplis');
            document.getElementById('msgmodifmdp').innerHTML = 'Les champs ne sont pas remplis correctement' ;
        }
    })

})
