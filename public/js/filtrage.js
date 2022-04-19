



export function filtrage(list, arrayCritere, arrayParameter){

    let newList = [];

    list.forEach(elem => {
        let respectCriteres = true;

        arrayCritere.forEach(critere => {
            //console.log(arrayParameter)

            arrayParameter[critere].forEach(param => {
                if(elem[critere][0].id != param){
                    respectCriteres = false;
                }
            })
        })
        if(respectCriteres){
            newList = [...newList, elem];
            console.log("ajout")
        }
    })
    return newList;
}
