var mois = [1,2,3,4,5,6,7,8,9,10,11,12];
var jours = [31,30,31,30,30,30,30,30,30,30,30,30,30];
var ok = 0;

function myFunction() {
    var entrer = document.getElementById("inputPassword").value;
    var num = parseInt(entrer);
    nombre = jours[num];
    if (num < jours[0]) {
        var indexmois = 0;
        var date = num+'/'+mois[indexmois];
        console.log(date);  
    }
    else{
        indexmois = 1;
        console.log(num);
        console.log(indexmois);
        if (num < jours[indexmois]+jours[indexmois+1]) {
            console.log(num);
        }
    }
}