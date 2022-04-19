///////////////////////////////////////////
//////// CHOIX DU DECOUPAGE //////////////
///////////////////////////////////////////
const lien_decoupage = $('.lien-decoupage')

lien_decoupage.click
(
    function (event)
    {

        var type_of_data = $('.lien-actif');
        var url = type_of_data.data('url');
        console.log(' url : ',url);
        var type = $('.lien-actif').data('type');
        var data2 = $(this).data('seq')
        $(lien_decoupage).removeClass('decoupage-actif')
        $(this).addClass('decoupage-actif')
        $.ajax({
            url: '/'+url+'/'+ data2,
            method: 'POST'
        }).then(function(response) {
            console.log(response);
            //console.log(response.Names);
            if (response.n > 1){
                chart.options.plugins.title.text = response.n + ' ' +type+ 's';
            } else{
                chart.options.plugins.title.text = response.n + ' ' +type;
            }
            chart.options.plugins.tooltip.callbacks.title = 
                function(ctx) {
                    const i = ctx[0].dataIndex;
                    //console.log(i);
                    if (response.Names[i]=="Rien") {
                        return(response.Date[i]);
                      } else {
                        return(response.Names[i]);
                      }
                    
                };
            chart.options.plugins.datalabels.formatter = function(value, context) {
                const k = context.dataIndex ;
                //console.log("k = ",k);
                if(response.Names[k]=="Rien"){
                    return(value);
                } else if(response.Names[k] == "Aucun produit"){
                    return('');
                } else {
                    return(response.Names[k]);
                }
                }
            chart.data.labels = response.Date;
            chart.data.datasets[0].data = response.Number; // or you can iterate for multiple datasets
            chart.update(); // finally update our chart
            //console.log('title ',chart.options.plugins.title.text)
        });

    }
);

////////////////////////////////////////////////////////////
/// CHOIX DES DONNEES ( VISITES / FAVORIS/ CLICKS ... ) ///
//////////////////////////////////////////////////////////
const lien_dash = $('.lien-dash')
//console.log(lien_dash);
lien_dash.click
(
    function (event)
    {
        var type = $(this).data('type');
        var type_of_data = $(this).data('url');
        // on garde en mémoire le decoupage actif
        const decoupage_actif = $('.decoupage-actif')
       // console.log(decoupage_actif)
        var data2 = $(decoupage_actif).data('seq')
       // console.log(type_of_data,data2)
        $(lien_dash).removeClass('lien-actif')
        $(this).addClass('lien-actif')
        $.ajax({
            url: '/'+type_of_data+'/'+ data2,
            method: 'POST'
        }).then(function(response) {
           //console.log("ouiiiiiiiiii");
           // console.log(response.Names);
            if (response.n > 1){
                chart.options.plugins.title.text = response.n + ' ' + type+ 's';
            } else{
                chart.options.plugins.title.text = response.n + ' ' + type;
            }
            chart.options.plugins.tooltip.callbacks.title = 
                function(ctx) {
                    const i = ctx[0].dataIndex;
                    //console.log(i);
                    if (response.Names[i]=="Rien") {
                        return(response.Date[i]);
                      } else {
                        return(response.Names[i]);
                      }
                };
           // console.log("type = ",type);
            chart.options.plugins.tooltip.callbacks.label = function(ctx) {
                    return(type+ 's : '+ctx.parsed.y);
                    },    
            chart.options.plugins.datalabels.formatter = function(value, context) {
                const k = context.dataIndex ;
                //console.log("k = ",k);
                if(response.Names[k]=="Rien"){
                    return(value);
                } else if(response.Names[k] == "Aucun produit"){
                    return('');
                } else {
                    return(response.Names[k]);
                }
                }
            chart.data.labels = response.Date;
            chart.data.datasets[0].data = response.Number; // or you can iterate for multiple datasets
            chart.update(); // finally update our chart

        });
        //console.log("test = ",test);
    }
);