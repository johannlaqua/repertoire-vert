console.log('Hello produits')
const close = $('.close-cross')
close.hide();
const btn_products = $('.masquer-tous-produits');

btn_products.click(function ()
{
    //console.log('jai clique sur masquer product')
    $(this).toggleClass('voir-tous-produits')
    $(this).toggleClass('masquer-tous-produits')
    $('.masquer-tous-produits').html('<div class="voir-text">\n' +
        '                    Masquer les produits\n' +
        '                </div>')
    $('.voir-tous-produits').html('<div class="voir-text">\n' +
        '                    Voir tous les produits\n' +
        '                </div>')

    $('.grid-card').toggle();
});
//////////////////////////////////////
// BTN chercher UN PRODUIT //////////
const modif_product = $('.btn-recherche-produit')
let activ = 0;
modif_product.click(function (){
   // console.log('tclique sur recherche')
        if (activ == 0){
            const container = $('.btn-modif-produits')
            container.addClass('container_activ')
            close.show();
            console.log(modif_product)
            modif_product.html('<input class="input-search-product" type="text"/>')
            modif_product.css('width','80%')
            activ = 1;
            console.log('activ ',activ)
        }

})


close.click(function (){
    //console.log('test croix',activ)
        if (activ == 1){
        const container = $('.btn-modif-produits')
        container.removeClass('container_activ')
        close.hide();
            modif_product.css('width','100%')
        modif_product.html('<div class="btn-recherche-produit">Rechercher un produit</div>')
        activ = 0;
    }
})

const input = $('.search-input-product');

input.on('input', function() {
   const length = input.val().length;
   console.log(length);
   const produits = $('.tr_produit')
    if (length >=2)
    {
        produits.hide();
        const search = input.val();
        $.ajax({
            url: '/produit/recherche/'+ search,
            method: 'POST'
        }).then(function(response) {
            const tab_produits = response.produits;
            tab_produits.forEach(
                produit => {
                    const res = $('.tr_produit_'+produit)
                    console.log(res)
                    res.show()
                });
        });

    }else{
        produits.show();
    }

});
////////////////////////////////////////////////////////////