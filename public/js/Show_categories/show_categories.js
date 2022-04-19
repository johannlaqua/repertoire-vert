const img_hidden = $('.subcat_bleu ')
img_hidden.hide()
const div_img = $('.card-subcategories');

div_img.mouseenter(function() {
    console.log($(this))
    const background = $(this).find('.subcategories-icones')
    // background.css('background-color','#5770AD')
    const id = $(this).attr('id')
    console.log(id)
    const img = $('.'+ id)
    console.log('img = ',img)
    const img2 = $('.'+id+'_bleu')
    img2.show()
    img.hide()


});
div_img.mouseleave(function() {
    /*const background = $(this).find('.subcategories-icones')
    background.css('background-color','white')*/
    const id = $(this).attr('id')
    console.log(id)
    const img = $('.'+ id)
    console.log('img = ',img)
    const img2 = $('.'+id+'_bleu')
    img2.hide()
    img.show()


});