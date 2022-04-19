var collectionHolder;

var addSubLink= $('<a href="#" class="add_subcategory_link">Ajouter une sous-catégorie</a>');
var newLinkLink= $('<li></li>').append(addSubLink);

$(document).ready(function()
{
    collectionHolder=$('ul.subcategories');
    collectionHolder.append(newLinkLink);
    collectionHolder.data('index',collectionHolder.find(':input').length);
    addSubLink.on('click',function (e) {
        e.preventDefault();
        addTagForm(collectionHolder,newLinkLink);
    });
    collectionHolder.find('div.subcategory').each(function () {
        addTagFormDeleteLink($(this));
    });


});
function addTagForm(collectionHolder,newLink) {
    var prototype= collectionHolder.data('prototype');
    var newForm = prototype;
    var index = collectionHolder.data('index');
    newForm=newForm.replace(/__name__/g,index);
    collectionHolder.data('index',index+1);
    var newFormLi=$('<li></li>').append(newForm);
    newLinkLink.before(newFormLi);
    addTagFormDeleteLink(newFormLi);
}
function addTagFormDeleteLink(tagFormLi) {
    var removeFormA=$('<a href="#">Supprimer</a>');
    tagFormLi.append(removeFormA);
    removeFormA.on('click',function (e) {
        e.preventDefault();
        tagFormLi.remove();
    })

}
function toggleSubscription(event) {
    var subscriptionBlock = $(".header-inscription");
    subscriptionBlock.toggleClass("opened");
    subscriptionBlock.toggleClass("closed");

    if (subscriptionBlock.hasClass("opened"))
    {
        subscriptionBlock.click(function(event) {
            event.stopPropagation();
        });
        $("body").click(toggleSubscription);
    }
    else
    {
        subscriptionBlock.unbind("click");
        $("body").unbind("click");
    }
    event.stopPropagation();
}
function toggleLoginForm(event) {
    var loginBlock = $(".header-login");
    loginBlock.toggleClass("opened");
    loginBlock.toggleClass("closed");

    if (loginBlock.hasClass("opened"))
    {
        loginBlock.click(function(event) {
            event.stopPropagation();
        });
        $("body").click(toggleLoginForm);
    }
    else
    {
        loginBlock.unbind("click");
        $("body").unbind("click");
    }
    event.stopPropagation();

}
function searchProduct(){
    var dataToSearch = $('.search-data').val();
    $(location).attr('href', '/produit/recherche/'+dataToSearch);
}

function searchProduct(){
    var dataToSearch = $('.search-data').val();
    $(location).attr('href', '/produit/recherche/'+dataToSearch);
}
function searchProduct(){
    var dataToSearch = $('.search-data').val();
    $(location).attr('href', '/produit/recherche/'+dataToSearch);
}
function searchCompany(){
    var dataToSearch = $('.search-data').val();
    $(location).attr('href', '/entreprise/recherche/'+dataToSearch);
}
function search(){

    console.log("test");
    var dataToSearch = $('.search-data').val();
    var chkArray = [];
    console.log(dataToSearch);

    /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
    $(".search-chk:checked").each(function() {
        chkArray.push($(this).val());
        console.log(chkArray[0]);
    });
    if(chkArray.length==0 || chkArray.length==2){
        chkArray=[];
        if(dataToSearch != "")
            $(location).attr('href', '/recherche/'+dataToSearch);
    }
    if(dataToSearch != ""){
      console.log('/recherche/'+chkArray[0]+'/'+dataToSearch);
      $(location).attr('href', '/recherche/'+chkArray[0]+'/'+dataToSearch);

      console.log("test4");
    }

}

function removeFlash(){
  $( ".flash" ).remove();
}

function addProductRemovalDialogBox(){
  $('div').prepend("");
  var operation = "product_removal";
}

function removeJsDialog(){
  $( ".jsdialog" ).remove();
}

function addServiceRemovalDialogBox(){
  var operation = "service_removal";
}

function addDialogBox(){
  if(operation == "product_removal"){

  }
}
