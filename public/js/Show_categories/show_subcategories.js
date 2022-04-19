const img_hidden = $('.subcat_bleu ')
img_hidden.hide()
const div_img = $('.card-subcategories');

// div_img.mouseenter(function() {
//     console.log($(this))
//     const background = $(this).find('.subcategories-icones')
//     background.css('background-color','#5770AD')
//     const id = $(this).attr('id')
//     console.log(id)
//     const img = $('.'+ id)
//     console.log('img = ',img)
//     const img2 = $('.'+id+'_bleu')
//     img2.show()
//     img.hide()


// });
// div_img.mouseleave(function() {
//     const background = $(this).find('.subcategories-icones')
//     background.css('background-color','white')
//     const id = $(this).attr('id')
//     console.log(id)
//     const img = $('.'+ id)
//     console.log('img = ',img)
//     const img2 = $('.'+id+'_bleu')
//     img2.hide()
//     img.show()


// });
////////////////////////////////////////
////// ACHAT PRODUIT //////////////////

const div_login = $('.div-login-achat ')
div_login.hide()
const btn_achat = $('.acheter-entreprise')
btn_achat.click(function () {
    const id  = $(this).attr('id')
    $('.'+id).toggle()
})
///////////////////////////////
/////// afficher connexion ///
const all_forms_login =$('.form-login')
console.log(all_forms_login)
all_forms_login.hide()
const btn_login = $('.btn-login')
    btn_login.click(function ()
    {
        const id = $(this).attr('id')
        const form = $('.'+id)
        console.log(id,form)
        form.toggle()
    })

////// bouton valider

const btn_valider = $('.validerlogin')
btn_valider.click(function ()
{

    if ($(".passwordlogin").val() && $(".emaillogin").val() ) {
        password =  md5($(".passwordlogin").val());
        $(".validerlogin").attr('disabled',true);
        console.log('Ok, on va verifier les informations');
    
        $.ajax({
            method: "POST",
            url: "https://gaea21user.sustlivprogram.org/apictrl/login",
            dataType :"json",
            contentType:"application/json",
            data: JSON.stringify({
                email : $(".emaillogin").val(),
                password : password,
                }),
            error: function() {
                $(".validerlogin").attr('disabled',false);
                document.getElementById('error').innerHTML = '<span style="color:red;">Une erreur est survenue. Veillez à saisir des informations conformes à votre compte ou essayez ultérieurement.</span>';
                },
        
        }).done(function(response) {
            console.log(response);
            var id = response.id;
            var username = response.username;
            var message = response.message;
            if (id) {
                console.log("Il reste plus qu'à rediriger vers la page produit d'une entreprise");
                //$.redirect('/Dashboard/', {'gaeaUserId': id,username});   
            }
            else{
                console.log(message);
            }
        });
        
    }
    else{
        console.log('Les champs ne sont pas tous remplis');
    }

})


function createArray(length) {
    var arr = new Array(length || 0),
        i = length;

    if (arguments.length > 1) {
        var args = Array.prototype.slice.call(arguments, 1);
        while(i--) arr[length-1 - i] = createArray.apply(this, args);
    }

    return arr;
}

const search_valid = $('.search-btn')
document.getElementById('search-btn').onclick = function() { // Ici, c'est la recherche

    var itArr = document.getElementsByClassName('div-fiche-entreprise');

    var prodt_nm = [];
    var prodt_id = [];


    function sort_it(prodt_nm, prodt_id, data, itArr) {
        var posStarter = data.search("@");
        var buffer = "";
        var d_arr = []
        var tmp_str = "";
        for(var i = 1; data[posStarter+i] != '~'; i++) { 
            buffer += data[posStarter+i]
        }

        for (var i = 1; i < buffer.length; i++) {
            if (buffer[i] != " " && buffer[i] != '\n') {
                tmp_str += buffer[i];
            }
            if (buffer[i] == '\n') {
                d_arr.push(tmp_str);
                tmp_str = "";
            }
        }
        for (var i = 0; i < d_arr.length; i+= 2) {
            prodt_nm.push(d_arr[i]);
        }
        for(var i = 1; i < d_arr.length; i+= 2) {
            prodt_id.push(d_arr[i]);
        }


        
    var zcode = document.getElementById('search-data-zipcode').value;
    var cty = document.getElementById('search-data-city').value;
    var prodt = document.getElementById('search-data-name').value;

    var id_list = []; // whereFindID 
    var zipcode_list = []; // whereFindLoc
    var country_list = []; // whereFindCount
    var name_list = []; // whereFindName
    var product_list = prodt_nm
    
    var invalid_index = [];
    var id_badprdt = [];

    var name_validated = 0;

    var pos = 0;
    var pos2 = 0;
    var pos3 = 0;
    var pos4 = 0;

    var buffer = "";

    var new_badprdt = [];


    for (var i = 0; i < itArr.length; i++) { 

        /*
        Les positions ici sont destinées à récupérer, respectivement dans l'ordre:
        Country
        Zipcode
        ID de l'entreprise
        
        */

        pos = itArr[i].innerHTML.search("wherefindcount");
        pos2 = itArr[i].innerHTML.search("wherefindloc");
        pos3 = itArr[i].innerHTML.search("wherefindid");
        pos4 = itArr[i].innerHTML.search("wherefindname");
        
        pos += 16;
        pos2 += 14;
        pos3 += 13;
        pos4 += 15;

        // Ici on additionne de la longueur du string qu'on cherche + 2 afin de directement commencer après le premier guillemet

        function partial_match(str, src) {
            for (var i = 0; i < str.length; i++) {
                if (str[i] != src[i]) {
                    return (-1);
                }
            }
            return (1);
        }


        for (var j = 0; itArr[i].innerHTML[pos+j] != "\"";j++) { 
            buffer += itArr[i].innerHTML[pos+j];
        }

        country_list.push(buffer);
        buffer = "";

        for (var j = 0; itArr[i].innerHTML[pos2+j] != "\"";j++) {
            buffer += itArr[i].innerHTML[pos2+j];
        }
        zipcode_list.push(buffer);
        buffer = "";
    
        for (var j = 0; itArr[i].innerHTML[pos3+j] != "\"";j++) {
            buffer += itArr[i].innerHTML[pos3+j];
        }
        id_list.push(buffer);
        buffer = "";

        for (var j = 0; itArr[i].innerHTML[pos4+j] != "\"" ;j++) { 
            buffer += itArr[i].innerHTML[pos4+j];
        }
        name_list.push(buffer);
        buffer = "";

    }

    name_validated = name_list.length;

    for (var i = 0; i < id_list.length; i++) {
        if (zcode != "" && partial_match(zcode, zipcode_list[i]) == -1) {
            invalid_index.push(i);
            console.log("bad zcode");
        }
        if (cty != "" && partial_match(cty, country_list[i]) == -1) {
            invalid_index.push(i);
            console.log("bad country");
        }
        if (prodt != "" && partial_match(prodt, name_list[i]) == -1) {
            name_validated -= 1;
            console.log("bad prod");
        }
    }

    if (name_validated > 0) {
        for(var i = 0; i < name_list.length; i++) {
            if (prodt != "" && partial_match(prodt, name_list[i]) == -1) {
                invalid_index.push(i);
            }
        }
    } else {
        for (var i = 0; i < product_list.length; i++) { 
            if (prodt != "" && partial_match(prodt, product_list[i]) == -1) {
                id_badprdt.push(prodt_id[i]);
            }
            if (prodt != "" && partial_match(prodt, product_list[i]) == 1) {
               for (var j = 0; j < id_badprdt.length; j++) {
                   if (id_badprdt[i] != prodt_id[i]) {
                    new_badprdt.push(id_badprdt[i]); 
                   }
               }
               id_badprdt = new_badprdt;
            }
        }


    }
    
    function hide (elements) {
        elements.style.display = 'none';
        // Cacher autrement car on les voit quand même prendre de l'espace
        // Origine du produit le changer pour "pays d'entreprise" au lieu de ville
    }

    function show(elements) {
        elements.style.display = 'flex';
    }

    for (var i = 0; i < id_list.length; i++) {
        show(document.getElementById(id_list[i]));
    }


    for(var i = 0; i < invalid_index.length; i++) {
        hide(document.getElementById(id_list[invalid_index[i]]));
    }

    for (var i = 0; i < id_badprdt.length; i++) { 
        if (id_list.includes(id_badprdt[i])) {
            hide(document.getElementById(id_badprdt[i]));
        }
    }


    }

    $.ajax({ url: '/rechercheProduit', success: function(data) { sort_it(prodt_nm, prodt_id, data, itArr); } });

}
