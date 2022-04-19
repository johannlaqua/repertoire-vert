//Vérification captcha
var captcha = false;
var onloadCallback = function() {
    widget = grecaptcha.render('g-recaptcha', {
    'sitekey' : '6LetXckaAAAAAGsjOUrzw8ikCzYbdtt-N9yhnivu',
    'callback' : verifyCallback
    });  
};
var verifyCallback = function(response) {
    captcha = true;
};
var adresse = $("#adresse").val();
var description = $("#description").val();
var name = $("#name").val();
$(function () {
    var adresse = $("#adresse").val();
    var description = $("#description").val();
    var name = $("#name").val();
    //Vérification de l'email et du mot de passe
    var passisvalid = false;
    var emailisvalid = false;
    var pass = document.querySelector('#mdp');
    let email = document.querySelector('#mail');
    email.addEventListener('change',function () {
        validemail = verifyEmail(this);
    });
    verifyEmail = function (Email) {
        let emailRegExp = new RegExp('^[a-zA-Z0-9.-_]+[@]{1}[a-zA-Z0-9.-_]+[.]{1}[a-z]{2,10}$','g');
        let testEmail = emailRegExp.test(Email.value); 
        if (testEmail == false) {
            document.getElementById('validemail').innerHTML = '<span style="color:red;">Veuillez saisir une adresse email valide</span>';
        }
        else{
            document.getElementById('validemail').innerHTML = '';
            emailisvalid = true;
            return true;
        }
        return false;
    }
    pass.addEventListener('change',function () {
        validpassword = verifyPassword(this);
    });
    var verifyPassword = function (password) {
        if (password.value.length < 8) {
            document.getElementById('validpassword').innerHTML = '<span style="color:red;">Votre mot de passe doit contenir au moins 8 caractères</span>';
        }
        else if (!/[A-Z]/.test(password.value)) {
                document.getElementById('validpassword').innerHTML = '<span style="color:red;">Votre mot de passe doit contenir au moins un caractère en majuscule</span>';  
        }
        else if (!/[0-9]/.test(password.value)) {
            document.getElementById('validpassword').innerHTML = '<span style="color:red;">Votre mot de passe doit contenir au moins un chiffre</span>';  
        }
        else if (!/[a-z]/.test(password.value)) {
            document.getElementById('validpassword').innerHTML = '<span style="color:red;">Votre mot de passe doit contenir au moins un caractère en minuscule</span>';  
        }
        else{
            document.getElementById('validpassword').innerHTML = '';
            passisvalid = true;
            return true;
        }
        return false;
    }

    
        $("#btnvalider").on("click",function () {     
            console.log("ta cliqué");
            var champsvalid = false; 
            if ($("#mdp").val() && $("#mdpconfirm").val() && $("#pseudo").val() && $("#mail").val() ) {
                champsvalid = true;
            };
            if (emailisvalid && passisvalid && captcha && champsvalid == true) {
                var password =  md5($("#mdp").val());
                var confirmedpassword = md5($("#mdpconfirm").val());
                if (captcha == true) {
                    $("#load").addClass('spinner-border');
                    $("#load").css({
                        'role':'status',
                        'aria-hidden':'true'
                    });
                    $("#post").attr('disabled',true);
                    $.ajax({
                        method: "POST",
                        url: "http://gaea21user.sustlivprogram.org/apictrl/add/gaeauser",
                        dataType :"json",
                        contentType:"application/json",
                        data: JSON.stringify({
                            url: "rv",
                            username : $("#pseudo").val(),
                            email : $("#mail").val(),
                            password : password,
                            newpassword : confirmedpassword
                            }),
                        error: function (xhr,status,error) {
                            console.log(xhr,status,error);
                            document.getElementById('form-error').innerHTML = '<span style="color:red;">Une erreur est survenue. Veuillez réessayer.</span>';
                            $("#load").removeClass('spinner-border');
                            $("#post").attr('disabled',false);
                        },
                    }).done(function(response) {
                        console.log(response);
                        id = response.id;
                        email = response.email;
                        code = response.status;
                        message = response.message;
                        
                        if (code != 201) {
                            document.getElementById('form-error').innerHTML = '<span style="color:red;">'+message+'</span>';
                            $("#load").removeClass('spinner-border');
                            $("#post").attr('disabled',false);
                        }
                        if (id) {
                            //$.redirect('http://127.0.0.1:8000/redirectRegister', {id});
                            $.ajax({
                                method: "POST",
                                url: "/redirectRegister",
                                dataType :"json",
                                contentType:"application/json",
                                data: JSON.stringify({
                                    "gaeaUserId": id,
                                    "name": $("#name").val(),
                                    "socialreason" : $("#socialreason").val(),
                                    "street" : $("#adresse").val(),
                                    "city": $("#ville").val(),
                                    "postcode": parseInt($("#postcode").val()), 
                                    "region": $("#canton").val(), 
                                    "country": $("#pays").val(),
                                    "phone": $("#tel").val(),
                                    "urlwebsite": $("#website").val(),
                                    "urllinkedin": $("#linkedin").val(),
                                    "urltwitter": $("#twitter").val(),
                                    "urlfacebook": $("#facebook").val(),
                                    "startingdate": $("#date").val(), 
                                    "certification": $("#certfications").val(),
                                    "description" : $("#description").val(),
                                    "category": [$("#activité").val()],
                                    "influencezone": 'ezez',
                                    "wantevaluation": true,
                                    "vision": $("#vision").val(),
                                    }),
                                error: function (xhr,status,error,response) {
                                    console.log("xhr,status,error : ", xhr,status,error);
                                    console.log("response = ",response);
                                    document.getElementById('form-error').innerHTML = '<span style="color:red;">Une erreur est survenue. Veuillez réessayer.</span>';
                                    $("#load").removeClass('spinner-border');
                                    $("#post").attr('disabled',false);
                                },
                            }).done(
                                function(response) {
                                    console.log(response);
                                }
                                //$.redirect('http://127.0.0.1:8000/redirectRegister')
                            )
                        }  
                    });   
                }
                else{
                    document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">Ce champs est requis.</span>';    
                }
                    
            }
            else{
                document.getElementById('form-error').innerHTML = '<span style="color:red;">Veuillez saisir des champs valables</span>';

            }
            
            
             
        });
    
    
});
 
    



