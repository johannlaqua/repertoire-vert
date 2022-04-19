$(document).ready(function(){

    //on récupère la localisation du user
    navigator.geolocation.getCurrentPosition(function(position) {
        let userLat = position.coords.latitude
        let userLng = position.coords.longitude;

        //pour chaque div-entreprise de la liste
        $(".resultat-recherche").each(function() {

            let companyLat = $(this).data('lat')
            let companyLng = $(this).data('lng')

            //on calcule la distance de l'entreprise par rapport à notre position
            let distance = calculateDistance(userLat, userLng, companyLat, companyLng)
            //on l'ajoute à l'élément dans un nouveau data attribute
            $(this).data('distance', distance)
            console.log($(this).data('distance'))
        })
    });


    $(".check-proximite").click(function() {

            //on trie selon la proximité et on affiche les div dans l'ordre dans leur container
            $(".resultat-recherche").sort(function (a, b) {

                let niveauA = $(a).data('niveau')
                let niveauB = $(b).data('niveau')

                if(niveauA === niveauB) {
                    // Si le résultat <= -1, a passe avant b, si >= b passe avant a, et si = 0 on garde l'ordre initial
                    // Ici on trie par ordre croissant
                    return parseInt($(a).data('distance')) - parseInt($(b).data('distance'));
                } else{
                    // Si les niveaux sont différents, on garde l'ordre initial car on trie en priorité du plus haut au plus petit niveau (déjà fait par défaut)
                    return 0;
                }

            }).appendTo(".companies-list");

    });

    $(".check-alphabet").click(function() {
        console.log("alphabet")

        //on trie par ordre alphabétique et on affiche les div dans l'ordre dans leur container
        $(".resultat-recherche").sort(function (a, b) {

            let niveauA = $(a).data('niveau')
            let niveauB = $(b).data('niveau')

            if(niveauA === niveauB) {
                return String.prototype.localeCompare.call( $(a).data('name').toLowerCase() , $(b).data('name').toLowerCase() );
            } else{
                return 0;
            }

        }).appendTo(".companies-list");
    });


})


