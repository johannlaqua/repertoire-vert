
//Vérification captcha
var captcha = false;

function onloadCallback() {
    let widget = grecaptcha.render('g-recaptcha', {
    'sitekey' : '6LeapVUcAAAAAE7xl5oLW2rDHls1f7AqTZpQFLhX',
    'callback' : verifyCallback
    });
};
const verifyCallback = function(response) {
    captcha = true;
    document.getElementById('g-recaptcha-error').innerHTML = '<span></span>'
};

$(document).ready(function () {
    // Taille du captcha responsive
    var width = $('.champ-data').width();
    console.log(width)

    if(width < 100){
        var scale = width/80;
        $('#g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
        $('#g-recaptcha').css('-webkit-transform-origin', '0 0');
    }


})

$(function () {

    //Vérification de l'email et du mot de passe
    var passisvalid = false;
    var emailisvalid = false;
    var pass = document.querySelector('#mdp');
    let email = document.querySelector('#mail');
    email.addEventListener('change', function () {
        let validemail = verifyEmail(this);
    });
    const verifyEmail = function (Email) {
        //let emailRegExp = new RegExp('^[a-zA-Z0-9.-_]+[@]{1}[a-zA-Z0-9.-_]+[.]{1}[a-z]{2,10}$', 'g');
        let emailRegExp = new RegExp('^([\\S]+)@([\\S]+\\.)([a-zA-Z]{2,4})', 'i');
        console.log(emailRegExp)
        let testEmail = emailRegExp.test(Email.value);
        if (testEmail == false) {
            document.getElementById('validemail').innerHTML = '<span style="color:red;">Veuillez saisir une adresse email valide</span>';
        } else {
            document.getElementById('validemail').innerHTML = '';
            emailisvalid = true;
            return true;
        }
        return false;
    }
    pass.addEventListener('change', function () {
        let validpassword = verifyPassword(this);
    });
    var verifyPassword = function (password) {
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
            return true;
        }
        return false;
    }

    console.log($("#bouton").is(':disabled'))


    $("#bouton").on("click", function () {

        // ON DESACTIVE LE BOUTON POUR QU'UN DEUXIEME CLIC N'AIT AUCUN EFFET
        $("#bouton").prop('disabled', true)

        console.log($("#postcode").val())
        //montrer le loader
        $('.div-msg-valid img').removeClass('hidden')

        //cacher les éventuels messages d'erreur précédents
        $('.container-erreur-champs').addClass('hidden');
        document.getElementById('champserreurs').innerHTML = '<span></span>';

        //Récupération des valeurs de boutons radio
        let wantEvalYes = document.getElementById("evaluationYes")
        let wantEvalNo = document.getElementById("evaluationNo")
        let wantEval = wantEvalYes.checked ? true : wantEvalNo.checked ? false : null;

        var date = $("#année").val() + '-' + $("#mois").val() + '-' + $("#jour").val();

        var address = $("#adresse").val() + " " + $("#ville").val() + ", " + $("#pays").val();
        var champsvalid = false;

        let emailIsIdentical =  $("#mail").val() == $("#mailconfirm").val() ? true : false;

        let newsletter = $('#newsletter').is(':checked');

        $.get(location.protocol + '//nominatim.openstreetmap.org/search?format=json&q=' + address, function (data) {
            console.log(data);

            let categories = [];
            $.get('/rest/category', function(dataCategories) {
                dataCategories.forEach(category => {
                    let checkbox = document.getElementById(category.name)
                    if(checkbox.checked){
                        categories.push(category.name)
                    }
                })

                if ($("#mdp").val()
                    && $("#mdpconfirm").val()
                    && $("#pseudo").val()
                    && $("#mail").val()
                    && $("#mailconfirm").val()
                    && $("#name").val()
                    && $("#socialreason").val()
                    && $("#adresse").val()
                    && $("#ville").val()
                    && $("#postcode").val()
                    && $("#canton").val()
                    && $("#pays").val()
                    && $("#nom").val()
                    && $("#prenom").val()
                    && $('#influenceZone').val()
                    && categories.length > 0
                    && wantEval != null) {
                        champsvalid = true;
                    };

                verifyImage();
                console.log(fileAllowed)
                if (emailisvalid && passisvalid && champsvalid && data[0] && fileAllowed && emailIsIdentical) {
                    console.log("je fais l'inscription")
                    var password = md5($("#mdp").val());
                    var confirmedpassword = md5($("#mdpconfirm").val());
                    if (captcha == true) {
                        $("#load").addClass('spinner-border');
                        $("#load").css({
                            'role': 'status',
                            'aria-hidden': 'true'
                        });

                        $("#post").attr('disabled', false);
                        $.ajax({
                            method: "POST",
                            url: "https://gaea21user.sustlivprogram.org/apictrl/add/gaeauser",
                            //url: "https://127.0.0.1:8001/apictrl/add/gaeauser",
                            dataType: "json",
                            contentType: "application/json",
                            data: JSON.stringify({
                                url: "https://www.repertoirevert.org",
                                username: $("#pseudo").val(),
                                email: $("#mail").val(),
                                password: password,
                                newpassword: confirmedpassword
                            }),
                            /*beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                                $('.div-msg-valid img').removeClass('hidden')
                            },*/
                            error: function (xhr, status, error) {
                                console.log(xhr, status, error);
                                document.getElementById('champserreurs').innerHTML = '<span style="color:red;">Une erreur est survenue. Veuillez réessayer.</span>';
                                $("#load").removeClass('spinner-border');
                                $("#post").attr('disabled', false);
                                $('.div-msg-valid img').addClass('hidden');
                                $("#bouton").prop('disabled', false)
                            },
                        }).done(function (response) {
                            console.log(response);
                            let id = response.id;
                            let code = response.status;
                            let message = response.message;

                            if (code != 201 && message != undefined) {
                                document.getElementById('champserreurs').innerHTML = '<span style="color:red;">'+message+'</span>';
                                $("#load").removeClass('spinner-border');
                                $("#post").attr('disabled',false);
                                $('.div-msg-valid img').addClass('hidden');
                                $("#bouton").prop('disabled', false)
                            }

                            if (id) {

                                let formData = new FormData();

                                    let objArr = {
                                        "gaeaUserId": id,
                                        "name": $("#name").val(),
                                        "socialreason": $("#socialreason").val(),
                                        "street": $("#adresse").val(),
                                        "city": $("#ville").val(),
                                        "postcode": $("#postcode").val(),
                                        "region": $("#canton").val(),
                                        "country": $("#pays").val(),
                                        "latitude": parseFloat(data[0].lat),
                                        "longtitude": parseFloat(data[0].lon),
                                        "phone": $("#tel").val(),
                                        "urlwebsite": $("#site").val(),
                                        "urllinkedin": $("#linkedin").val(),
                                        "urltwitter": $("#twitter").val(),
                                        "urlfacebook": $("#facebook").val(),
                                        "startingdate": date,
                                        "certification": $("#certifications").val(),
                                        "description": $("#description").val(),
                                        "categories": categories,
                                        "influencezone": $("#influenceZone").val(),
                                        "wantevaluation": wantEval,
                                        "vision": $("#vision").val(),
                                        "niveau": wantEval ? 'N.1' : 'N.0',
                                        "nom": $("#nom").val(),
                                        "prenom": $("#prenom").val(),
                                        "newsletter": newsletter,
                                        "mail": $('#mail').val(),
                                    };
                                    formData.append('objArr',JSON.stringify(objArr))
                                    //if(fileUpload){
                                    formData.append("file", file);
                                    //}


                                    $.ajax({
                                        method: "POST",
                                        url: "/redirectRegister/",
                                        dataType: "json",
                                        processData: false,
                                        contentType: false,
                                        data: formData,
                                        error: function (xhr, status, error) {

                                            console.log("response avec erreur = ", response);
                                            document.getElementById('champserreurs').innerHTML = '<span style="color:red;">Une erreur est survenue. Veuillez réessayer.</span>';
                                            $("#load").removeClass('spinner-border');
                                            $("#post").attr('disabled', false);
                                            $("#bouton").prop('disabled', false)
                                        },
                                    }).done(
                                        function (response2) {
                                            $("#bouton").prop('disabled', false)
                                            console.log(response2);
                                            $('.div-msg-valid img').addClass('hidden')
                                            /*$( ".div-msg-valid" ).html( "<div class=\"container-msg-valid\">\n" +
                                                    "                        <div class=\"msg-valid-text\">\n" +
                                                    "                            Votre compte a bien été créé !<br>\n" +
                                                    "                            Vous allez recevoir un e-mail de confirmation.<br>\n" +
                                                    "                            Si l’e-mail n’apparaît pas dans la boîte de<br>\n" +
                                                    "                            réception, pensez à vérifier votre boîte Spam.<br>\n" +
                                                    "                            Selon les boîtes de messagerie, il peut arriver<br>\n" +
                                                    "                            qu’il y soit directement redirigé.\n" +
                                                    "                        </div>\n" +
                                                    "                    </div>" );*/
                                            $( ".div-msg-valid" ).html( "<div class=\"container-msg-valid\">\n" +
                                                "                        <div class=\"msg-valid-text\">\n" +
                                                "                            Votre compte a bien été créé !<br>\n" +
                                                "                            Il sera activé manuellement.<br>\n"+
                                                "                    </div>" );
                                        }
                                    )
                            }
                        })
                    } else {
                        $('.div-msg-valid img').addClass('hidden')
                        document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">Ce champs est requis.</span>';
                        console.log("captcha erreur")
                        $("#bouton").prop('disabled', false)
                    }

                } else {
                    $('.div-msg-valid img').addClass('hidden')
                    $("#bouton").prop('disabled', false)
                    if(!champsvalid){
                        console.log("champs invalides")
                        $('.container-erreur-champs').removeClass('hidden')
                    }
                    else if(!passisvalid || !emailisvalid){
                        document.getElementById('champserreurs').innerHTML = '<span style="color:red;">Veuillez saisir un email ou mot de passe valable</span>';
                    }
                    else if (!emailIsIdentical) {
                        document.getElementById('champserreurs').innerHTML = '<span style="color:red;">Confirmation d\'adresse mail non identique</span>';
                    }
                    else if (!data[0]) {
                        document.getElementById('champserreurs').innerHTML = '<span style="color:red;">Veuillez entrer une adresse existante</span>';
                    }
                }
            })
        });


    });



    $('.supprimer-logo').click(function () {
        $(".div-erreur-image").html("");
        $('#logo-file').val('');
        console.log($('#logo').val())
        $('.emplacement-upload').text('Aucun fichier');
        document.querySelector('[type=file]').value = null;
        console.log(document.querySelector('[type=file]').files[0])
    });

    $('.upload-logo').change(function () {

        var logo = $('#logo').val();
        console.log('logo = ', logo)
        $('.emplacement-upload').text(logo);

        verifyImage();

        if(logo == ""){
            $('.emplacement-upload').text('Aucun fichier');
            console.log(document.querySelector('[type=file]').value)
            document.querySelector('[type=file]').value = null;
        }



    });

})

