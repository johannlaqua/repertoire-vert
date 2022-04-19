var password = $("#password").val();
var email = $("#email").val();

$("#btn").on("click",function () {
    console.log($("#password").val(),$("#email").val() );
    if ($("#password").val() && $("#email").val() ) {
        password =  md5($("#password").val());
        // $("#load").addClass('spinner-border');
        // $("#load").css({
        //     'role':'status',
        //     'aria-hidden':'true'
        // });
        $("#btn").attr('disabled',true);
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
                $("#btn").attr('disabled',false);
                document.getElementById('error').innerHTML = '<span style="color:red;">Une erreur est survenue. Veillez à saisir des informations conformes à votre compte ou essayez ultérieurement.</span>';
                },
        
        }).done(function(response) {
            console.log(response);
            var id = response.id;
            var username = response.username;
            var message = response.message;
            if (id) {
                console.log("mdr on va rediriger");
                $.redirect('/Dashboard/', {'gaeaUserId': id,username});   
            }
            else{
                document.getElementById('error').innerHTML = '<span style="color:red;">'+message+'</span>';
                //$("#load").removeClass('spinner-border');
                $("#btn").attr('disabled',false);
            }
        });
        
    }
    else{
        document.getElementById('error').innerHTML = '<span style="color:red;">Veuillez remplir les champs</span>';
        console.log('ok');
    }
    

    
});
