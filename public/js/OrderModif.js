console.log("OrderModif.js")

var moins = $(".moins")
console.log(moins)

moins.click(function(event){
    event.preventDefault();
    console.log('jai cliqué sur :',$(this))
    var id = $(this).attr('id')
    console.log('Id du btn',id);
    var container_cartline = $('#cart-content_'+id)
    var container_price = $('.price-total')
    var container_quantite = $('#quantity_'+id)
    
    console.log(container_quantite)
    console.log(container_price)

    var data = $(this).data('direction')
    console.log(' + ou  - ??',data)

    $.ajax({
        url: '/decreaseQte/'+data,
        method: 'POST'
    }).then(function(response) {
        console.log("items ",response.items)
        console.log("quantity ",response.quantity)
        console.log("total ",response.total)
        if(response.quantity != 0 ){container_quantite.text(response.quantity);}
        else{
            container_cartline.remove()
            }    
        container_price.text(response.total+" €")
    });
});

var plus = $(".plus")

console.log(plus)

plus.click(function(event){
    event.preventDefault();
    console.log('jai cliqué sur :',$(this))
    var id = $(this).attr('id')
    console.log('Id du btn : ',id);
    var container_quantite = $('.quantity_'+id)
    var container_price = $('.price-total')
    console.log("container quantite : ",container_quantite)

    var data = $(this).data('direction')

    $.ajax({
        url: '/increaseQte/'+data,
        method: 'POST'
    }).then(function(response) {
        console.log("quantity ",response.quantity)
        console.log("total ",response.total)
        container_quantite.text(response.quantity);
        container_price.text(response.total+" €")
    });
});

var supprimer = $(".supprimer-cart")

console.log("supprimer ?",supprimer)

supprimer.click(function(event){

    event.preventDefault();

    console.log('jai cliqué sur :',$(this))

    var id = $(this).attr('id')
    console.log('Id du btn',id);

    var container_cartline = $('.cart-content_'+id)
    var container_price = $('.price-total')
    

    var data = $(this).data('direction')
    console.log('supprimer',data)
    console.log('cartline ?',container_cartline)
    
    $.ajax({
        url: '/removeFromCart/'+data,
        method: 'POST'
    }).then(function(response) {
        container_cartline.remove()
        container_price.text(response.total+" €")
    });
    
});
