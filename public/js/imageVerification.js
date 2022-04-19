let fileAllowed;
let fileInput = document.querySelector('[type=file]')
let file;

const verifyImage = (preview=false) => {

    fileAllowed = true;
    $(".div-erreur-image").html("");

    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    //let fileInput = document.querySelector('[type=file]')
    file = fileInput.files[0];
    //console.log(file)
    let filePath = fileInput.value;
    $(".erreur").html("");
    $('.preview').attr('src', null)

    if(file) {

        //// vérif extension ////
        if (!allowedExtensions.exec(filePath)) {
            $(".div-erreur-image").html("Seuls les fichiers image sont autorisés");
            fileAllowed = false;
            $('.preview').attr('src', null)
        }

        //// vérif poids image ////
        else if (file.size > 8000000) {
            $(".div-erreur-image").html("La taille de l'image ne doit pas dépasser 8Mo (taille : "+ Math.round(file.size/100000)/10 + "Mo)");
            fileAllowed = false;
        }

        //////////////// Affichage preview ajout/modif produit/service //////////////
        var reader = new FileReader();
        //Read the contents of Image File.
        reader.readAsDataURL(document.querySelector('[type=file]').files[0]);

        reader.onload = function (e) {

            //Initiate the JavaScript Image object.
            var image = new Image();
            //Set the Base64 string return from FileReader as source.
            image.src = e.target.result;

            image.onload = function () {

                /*var height = this.height;
                var width = this.width;
                if (height > 900 || width > 900) {

                    //show width and height to user
                    console.log(width, height)
                    $(".div-erreur-image").html("Les dimensions de l'image ne doivent pas excéder 900px ");
                    fileAllowed = false;
                }*/

                //image preview
                if(preview && fileAllowed){
                    $('.preview').attr('src', e.target.result)
                } else {
                    $('.preview').attr('src', null)
                }

            };

        }

    }

}
