


var emailisvalid = false;

$(document).ready(function(){

    var inscriptionRV = false;
    var newsletter = false;

    var button = document.querySelector("#button");
    var formulaire =document.querySelector("#formulaire");

    const openModalButtons = document.querySelectorAll('[data-modal-target]')
    const closeModalButtons = document.querySelectorAll('[data-close-button]')
    const overlay = document.getElementById('overlay')

    openModalButtons.forEach(button => {
      button.addEventListener('click', () => {
        const modal = document.querySelector(button.dataset.modalTarget)
        openModal(modal)
      })
    })

    overlay.addEventListener('click', () => {
      const modals = document.querySelectorAll('.modal.active')
      modals.forEach(modal => {
        closeModal(modal)
      })
    })

    closeModalButtons.forEach(button => {
      button.addEventListener('click', () => {
        const modal = button.closest('.modal')
        closeModal(modal)
      })
    })

    function openModal(modal) {
      if (modal == null) return
      modal.classList.add('active')
      overlay.classList.add('active')
    }

    function closeModal(modal) {
      if (modal == null) return
      modal.classList.remove('active')
      overlay.classList.remove('active')
    }


    document.querySelector("#inscription").onchange = function (){

        console.log(newsletter)
        if(this.checked){

            inscriptionRV= true;
            button.classList.remove('hidden')
            formulaire.classList.add('hidden')

        } else{

            inscriptionRV= false;
            button.classList.add('hidden')

            if(newsletter) {

                button.classList.remove('hidden')
                formulaire.classList.remove('hidden')
            }
        }



    }

    document.querySelector("#newsletter").onchange = function (){

        $("#mail").on("change",function(){
            controlEmail(this)
        })

        if( this.checked){
            newsletter= true;

            if(!inscriptionRV){
                button.classList.remove('hidden')
                formulaire.classList.remove('hidden')
            }

        }else{
            newsletter= false;
            button.classList.add('hidden')
            formulaire.classList.add('hidden')
        }

        if(inscriptionRV){
            button.classList.remove('hidden')
            formulaire.classList.add('hidden')
        }

    }

    button.onclick = function () {
        if (inscriptionRV) {

            location.href = '/inscription-entreprise'
        } else {

            newsletterInscription()
        }
    }

});


const verifyEmail = function (Email) {
    //let emailRegExp = new RegExp('^[a-zA-Z0-9.-_]+[@]{1}[a-zA-Z0-9.-_]+[.]{1}[a-z]{2,10}$', 'g');
    let emailRegExp = new RegExp('^([\\S]+)@([\\S]+\\.)([a-zA-Z]{2,4})', 'i');
    console.log(emailRegExp)
    let testEmail = emailRegExp.test(Email.value);
    if (testEmail == false) {
        document.getElementById('validemail').innerHTML = '<span style="color:red;">Veuillez saisir une adresse email valide</span>';
        console.log(testEmail);
        emailisvalid = false;
    } else {
        document.getElementById('validemail').innerHTML = '';
        console.log(testEmail);
        emailisvalid = true;
        return true;
    }
    return false;
}

function controlEmail(champEmail){
    // email.addEventListener('change', function () {
    console.log(" controlle email appeller")
    verifyEmail(champEmail);

    //    });
}


function newsletterInscription (loggedIn = false) {

    document.getElementById('errorlocation').innerHTML = '';
    $("#button").prop('disabled', true)

    let toutrempli = false;

    if(
        $("#prenom").val()
        && $("#nom").val()
        && $("#ville").val()
        && $("#code_postal").val()
        && $("#mail").val()
    ) {
        toutrempli = true;
    }


    if ((emailisvalid && toutrempli) || loggedIn){

        console.log(emailisvalid)
        let objArr = {
            "prenom": $("#prenom").val(),
            "nom": $("#nom").val(),
            "ville": $("#ville").val(),
            "code_postal": $("#code_postal").val(),
            "mail": $("#mail").val(),
        };


        objArr= JSON.stringify(objArr);


        $.ajax({
            method: "POST",
            url: "/newsletter/inscription",
            dataType: "json",

            data : objArr,

            error: function (xhr, status, error) {

                console.log(xhr, status, error);
                $("#button").prop('disabled', false)
                document.getElementById('errorlocation').innerHTML = 'Une erreur est survenue. Veuillez réessayer.';


            },
        }).done(function(response){

            console.log(response)
            $("#button").prop('disabled', false)
            document.getElementById('successlocation').innerHTML = 'Inscription réussie'
        })

    }else if(!toutrempli){
        $("#button").prop('disabled', false)
        document.getElementById('errorlocation').innerHTML = "Veuillez remplir tous les champs.";

    }else if(!emailisvalid){
        $("#button").prop('disabled', false)
        //document.getElementById('errorlocation').innerHTML = "L'adresse mail est invalide.";
    }


}