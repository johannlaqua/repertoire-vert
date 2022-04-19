console.log('Focus_product.js')
let Active = false;
///////////////////////////////////
$(".close").click(function(){

    var id = $(this).attr('id')

    //$(this).toggleClass("fa-heart fa-heart-o");
    var zoom = $('#zoom_'+id)

    $(zoom).css('display','none')
    Active = false;
});
///////////////////////////////////
$(".product-card").click(function(event){
    event.preventDefault()

    console.log('active',Active)
    console.log('cart est actif ?',$('.Cart').css('display'))
    if ( Active === false)
    {
        $('.zoom-product').css('display','none')
        var id = $(this).attr('id')
        console.log(id)

        var data = $(this).data('direction')
        console.log('id produit : ',data)

        $('.' + id).css('display','block')
        $('html,body').animate({
            scrollTop: $("." + id).offset().top -100
        }, 100);
        //Active = true; // Si on veut empecher le click sur un autre produits quand le zoom est deja ouvert

        
    }
});
///////////////////////////////////
$(".link-cart").click(function(event){
    event.preventDefault();
    console.log('jai cliqué sur cart')
    Active = true;
    $('.Cart').css('display','block')
    $('.container-searchbar').toggleClass('searchbar-if-cart-is-activ')
    $('.list-products').toggleClass('list-products-if-cart-is-activ')
    $('.affichage-products').toggleClass('background-if-cart-is-activ')
    //console.log($('.background-Cart'))
});
///////////////////////////////////
$(".poursuivre-achat").click(function(){

    console.log('jai cliqué sur continuer achat')
    Active = false;
    $('.Cart').css('display','none')
    $('.container-searchbar').toggleClass('searchbar-if-cart-is-activ')
    $('.list-products').toggleClass('list-products-if-cart-is-activ')
    $('.affichage-products').toggleClass('background-if-cart-is-activ')
});

