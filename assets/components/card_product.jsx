import React, {Component} from 'react';
import ReactDOM from "react-dom";
import Etoile_vide_cons from './etoiles_produits/Etoile_vide_cons';
import Etoile_pleine_cons from "./etoiles_produits/Etoile_pleine_cons";
import Etoile_vide_ent from "./etoiles_produits/Etoile_vide_ent";
import Etoile_pleine_ent from "./etoiles_produits/Etoile_pleine_ent";
class Card_product extends Component {

    constructor(props) {
        super(props);
        this.state = {
            products: []
        };

        this.filteredProducts = this.filteredProducts.bind(this)
        this.productsWithTitles = this.productsWithTitles.bind(this)

    }

    componentDidMount() {
        this.getAllProductsFromCompanyByName(companyName);
        //console.log(userconnected)

    }


    getAllProductsFromCompanyByName(companyName) {
        this.setState({
            products:[]
        });
        fetch(`/rest/product/fromcompany/name/`+companyName, {
            method: "get",
            header: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            credentials: 'same-origin'

        }).then(response => {
            return response.json()
        }).then(data => {
            console.log(data)
            this.setState({
                products: data
                }

            )

        });
    }


    filteredProducts(){ // Filtre et trie les produits selon leur catégorie
        let filteredProducts = []

        let filteredProductsWithTitles = []
        let catName = ''
        let catObj = {}

        this.state.products.forEach((product) => {

            product.subcategories.forEach(subcat => {

                subcat.categories.forEach(cat => {
                    console.log(product.name, cat.name)

                    // si la catégorie du produit courant est égale à l'une des catégories cliquées (et que le produit n'est pas dejà dans la liste
                    if (this.props.categories.filter(catSelected => catSelected.id === cat.id).length > 0
                        && !filteredProducts.includes(product)) {

                        catName = cat.name
                        console.log(catObj)
                        // Si aucun produit de cette categorie n'avait été ajouté, on crée un nouvel objet avec cette clé et on y ajoute le produit
                        if(!filteredProductsWithTitles.some(obj => obj.hasOwnProperty(catName))) {
                            console.log('ne contient pas la clé')
                            catObj = {[catName] : []}
                            filteredProductsWithTitles.push(catObj)
                            catObj[catName].push(product)

                        } else{ // Sinon on ajoute le produit à l'objet à la clé correspondante
                            filteredProductsWithTitles.forEach(obj => {
                                if(obj.hasOwnProperty(catName)){
                                    obj[catName].push(product)
                                }

                            })
                        }

                        filteredProducts = [...filteredProducts, product]
                    }


                })
            })
        })
        console.log(filteredProductsWithTitles)
        return filteredProductsWithTitles
    }

    productsWithTitles(){ // Trie les produits selon leur catégorie
        let filteredProducts = []

        let filteredProductsWithTitles = []
        let catName = ''
        let catObj = {}

        this.state.products.forEach((product) => {

            product.subcategories.forEach(subcat => {

                subcat.categories.forEach(cat => {
                    console.log(product.name, cat.name)

                    if (!filteredProducts.includes(product)) {

                        catName = cat.name
                        console.log(catObj)

                        // Si aucun produit de cette categorie n'avait été ajouté, on crée un nouvel objet avec cette clé et on y ajoute le produit
                        if(!filteredProductsWithTitles.some(obj => obj.hasOwnProperty(catName))) {
                            console.log('ne contient pas la clé')
                            catObj = {[catName] : []}
                            filteredProductsWithTitles.push(catObj)
                            catObj[catName].push(product)

                        } else{ // Sinon on ajoute le produit à l'objet à la clé correspondante
                            filteredProductsWithTitles.forEach(obj => {
                                if(obj.hasOwnProperty(catName)){
                                    obj[catName].push(product)
                                }

                            })
                        }

                        filteredProducts = [...filteredProducts, product]
                    }


                })
            })
        })
        console.log(filteredProductsWithTitles)
        return filteredProductsWithTitles
    }

    render() {

        const nombreEtoiles = 3;
        let etoiles_cons = [];
        for (let i = 0; i < nombreEtoiles; i++) { // Use whatever looping you need here
            etoiles_cons.push(<Etoile_pleine_cons key={`etoile_pleine_cons_${i}`}/>); // Edit your images here
        }
        for (let i = 0; i < 5- nombreEtoiles; i++) { // Use whatever looping you need here
            etoiles_cons.push(<Etoile_vide_cons key={`etoile_vide_cons_${i}`}/>); // Edit your images here
        }
        let etoiles_ent = [];
        for (let i = 0; i < nombreEtoiles; i++) { // Use whatever looping you need here
            etoiles_ent.push(<Etoile_pleine_ent key={`etoile_pleine_ent_${i}`}/>); // Edit your images here
        }
        for (let i = 0; i < 5- nombreEtoiles; i++) { // Use whatever looping you need here
            etoiles_ent.push(<Etoile_vide_ent key={`etoile_vide_ent_${i}`}/>); // Edit your images here
        }

         if (this.props.categories.length === 0) {

             return (

                 this.productsWithTitles().map(productObj => {
                     // On récupère le nom de la catégorie pour l'afficher en titre
                     var keys = Object.keys(productObj);
                     return <>
                         <div className="card-products-icones" key={keys[0]}>
                             <img src={`/images/Icones_Categories/${keys[0]}/${keys[0]}.svg`}
                                  className={`img-cats${keys[0]}`}/>
                             <h1>{keys[0]}</h1>
                         </div>
                         {/*On boucle dans chaque produit de la catégorie courante*/}
                         {productObj[keys[0]].map(product => (
                             <div className="bloc-card"  key={product.id}>
                                 <div className="grid-card">
                                 <div className="grid-photo">
                                     { product.image &&
                                     <img src={`/uploads/products/${product.image}`} alt={product.image}
                                          className="img-card"/>
                                     }
                                     { !product.image &&
                                     <div className="logo-produits">Aucune image sélectionnée</div>
                                     }
                                 </div>
                                 <div className="grid-infos">
                                     <div>
                                         <div className="div-titre">
                                             Nom
                                         </div>
                                         <div className="nom-produit">
                                            {userconnected === false && 
                                                <a href={`/ficheProduitNonConnecte/${categoryId}/${subcategoryId}/${companyId}/${product.id}`} title={product.name}
                                                className="lien-ficheProduit">
                                                {product.name}
                                                </a>
                                            }
                                            {userconnected === true && 
                                                <a href={`/produit/${product.id}`} title={product.name}
                                                className="lien-ficheProduit">
                                                {product.name}
                                                </a>
                                            }
                                         </div>
                                         <div className="div-titre">
                                             Descriptif
                                         </div>
                                         <div className="div-td">
                                             {product.description}
                                         </div>
                                         <div className="div-titre">
                                             Niveau
                                         </div>
                                         <div className="container-niveau-produit div-td">

                                             <div className={`niveau-produit${product.niveau}`}>
                                                 {product.niveau}
                                             </div>
                                         </div>
                                         <div className="div-titre">
                                             Certification
                                         </div>
                                         <div className="div-td">
                                             {product.certification}
                                         </div>
                                         {/*modif et supp*/}
                                     </div>
                                 </div>
                                 <div className="grid-infos">
                                     <div>
                                         <div className="div-titre">
                                             Origine du produit
                                         </div>
                                         <div className="div-td">
                                             {product.origin}
                                         </div>

                                         <div className="div-titre">
                                             Prix
                                         </div>
                                         <div className="div-td">
                                             {product.price}
                                             {product.currency === "Euro" ? '€' : product.currency}

                                             {product.type === "service" &&
                                             <>/ {product.serviceduration}</>
                                             }
                                         </div>
                                         {/*/////////certif+niveau////////*/}
                                     </div>
                                 </div>
                                 <div className="grid-infos">
                                     <div className="avis-produit">
                                         <div className="div-avis">
                                             <div className="data-avis">
                                                 <div className="avis-title">
                                                     Avis consommateur
                                                 </div>
                                                 <div className="avis-etoile">

                                                     <svg xmlns="http://www.w3.org/2000/svg" width="14.695"
                                                          height="13.976"
                                                          viewBox="0 0 14.695 13.976">
                                                         <defs>
                                                         </defs>
                                                         <path className="avis-conso"
                                                               d="M134.365,65.828l2.271,4.6,5.077.738-3.674,3.581.867,5.056-4.541-2.387L129.824,79.8l.867-5.056-3.674-3.581,5.077-.738Z"
                                                               transform="translate(-127.017 -65.828)"/>
                                                     </svg>

                                                 </div>
                                             </div>
                                             <div className="data-avis">
                                                 <div className="avis-title">
                                                     Avis entreprise
                                                 </div>
                                                 <div className="avis-etoile">
                                                     <svg xmlns="http://www.w3.org/2000/svg" width="14.695"
                                                          height="13.976"
                                                          viewBox="0 0 14.695 13.976">
                                                         <defs>
                                                             <style></style>
                                                         </defs>
                                                         <path className="avis-entreprise"
                                                               d="M134.365,65.828l2.271,4.6,5.077.738-3.674,3.581.867,5.056-4.541-2.387L129.824,79.8l.867-5.056-3.674-3.581,5.077-.738Z"
                                                               transform="translate(-127.017 -65.828)"/>
                                                     </svg>
                                                 </div>
                                             </div>
                                         </div>
                                         <div className="avis-produit-consomm">
                                             <div className="avis-etoiles">
                                                 <div className="container-star cons1">
                                                     {etoiles_cons}
                                                 </div>

                                             </div>
                                             <div className="avis-nb">
                                                 {product.id} avis
                                             </div>
                                         </div>
                                         <div className="avis-produit-entreprise">
                                             <div className="avis-etoiles">
                                                 <div className="container-star ent">
                                                     {etoiles_ent}
                                                 </div>


                                             </div>

                                             <div className="avis-nb">
                                                 {product.id} avis
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                             </div>

                         {userconnected === true &&
                         <div className="div-btn">

                             {product.type === "marchandise" &&
                             <><a href={`/produit/modifier/${product.id}`} id={product.id}
                                  className="btn-edit">Modifier</a>
                                 <a href={`/produit/supprimer/${product.id}`} id={product.id}
                                    className="btn-delete">Supprimer</a></>
                             }

                             {product.type === "service" &&
                             <><a href={`/services/modifier/${product.id}`} id={product.id}
                                  className="btn-edit">Modifier</a>
                                 <a href={`/services/supprimer/${product.id}`} id={product.id}
                                    className="btn-delete">Supprimer</a></>
                             }

                         </div>
                         }
                     </div>
                 ))}
                     </>
                 })
            )
        } else {

            return(

                this.filteredProducts().map(productObj => {
                    var keys = Object.keys(productObj);
                    //console.log(product)
                    return <>
                        <div className="card-products-icones" key={keys[0]}>
                            <img src={`/images/Icones_Categories/${keys[0]}/${keys[0]}.svg`}
                                 className={`img-cats${keys[0]}`}/>
                            <h1>{keys[0]}</h1>
                        </div>
                    {productObj[keys[0]].map(product => (
                        <div className="bloc-card" key={product.id}>
                            <div className="grid-card">
                            <div className="grid-photo">
                                { product.image &&
                                    <img src={`/uploads/products/${product.image}`} alt={product.image}
                                         className="img-card"/>
                                }
                                { !product.image &&
                                <div className="logo-produits">Aucune image sélectionnée</div>
                                }
                            </div>
                            <div className="grid-infos">
                                <div>
                                    <div className="div-titre">
                                        Nom
                                    </div>
                                    <div className="nom-produit">
                                    {userconnected === false && 
                                        <a href={`/ficheProduitNonConnecte/${categoryId}/${subcategoryId}/${companyId}/${product.id}`} title={product.name}
                                        className="lien-ficheProduit">
                                         {product.name}
                                     </a>
                                    }
                                      {userconnected === true && 
                                        <a href={`/produit/${product.id}`} title={product.name}
                                        className="lien-ficheProduit">
                                         {product.name}
                                     </a>
                                    }
                                     
                                    </div>
                                    <div className="div-titre">
                                        Descriptif
                                    </div>
                                    <div className="div-td">
                                        {product.description}
                                    </div>
                                    <div className="div-titre">
                                        Niveau
                                    </div>
                                    <div className="container-niveau-produit div-td">

                                        <div className={`niveau-produit${product.niveau}`}>
                                            {product.niveau}
                                        </div>
                                    </div>
                                    <div className="div-titre">
                                        Certification
                                    </div>
                                    <div className="div-td">
                                        {product.certification}
                                    </div>
                                    {/*modif et supp*/}
                                </div>
                            </div>
                            <div className="grid-infos">
                                <div>
                                    <div className="div-titre">
                                        Origine du produit
                                    </div>
                                    <div className="div-td">
                                        {product.origin}
                                    </div>

                                    <div className="div-titre">
                                        Prix
                                    </div>
                                    <div className="div-td">
                                        {product.price}
                                        {product.currency === "Euro" ? '€' : product.currency}

                                        {product.type === "service" &&
                                        <>/ {product.serviceduration}</>
                                        }
                                    </div>
                                    {/*/////////certif+niveau////////*/}
                                </div>
                            </div>
                            <div className="grid-infos">
                                <div className="avis-produit">
                                    <div className="div-avis">
                                        <div className="data-avis">
                                            <div className="avis-title">
                                                Avis consommateur
                                            </div>
                                            <div className="avis-etoile">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="14.695" height="13.976"
                                                     viewBox="0 0 14.695 13.976">
                                                    <defs>
                                                    </defs>
                                                    <path className="avis-conso"
                                                          d="M134.365,65.828l2.271,4.6,5.077.738-3.674,3.581.867,5.056-4.541-2.387L129.824,79.8l.867-5.056-3.674-3.581,5.077-.738Z"
                                                          transform="translate(-127.017 -65.828)"/>
                                                </svg>

                                            </div>
                                        </div>
                                        <div className="data-avis">
                                            <div className="avis-title">
                                                Avis entreprise
                                            </div>
                                            <div className="avis-etoile">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14.695" height="13.976"
                                                     viewBox="0 0 14.695 13.976">
                                                    <defs>
                                                        <style></style>
                                                    </defs>
                                                    <path className="avis-entreprise"
                                                          d="M134.365,65.828l2.271,4.6,5.077.738-3.674,3.581.867,5.056-4.541-2.387L129.824,79.8l.867-5.056-3.674-3.581,5.077-.738Z"
                                                          transform="translate(-127.017 -65.828)"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="avis-produit-consomm">
                                        <div className="avis-etoiles">
                                            <div className="container-star cons1">
                                                {etoiles_cons}
                                            </div>

                                        </div>
                                        <div className="avis-nb">
                                            {product.id} avis
                                        </div>
                                    </div>
                                    <div className="avis-produit-entreprise">
                                        <div className="avis-etoiles">
                                            <div className="container-star ent">
                                                {etoiles_ent}
                                            </div>


                                        </div>

                                        <div className="avis-nb">
                                            {product.id} avis
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {userconnected === true &&
                        <div className="div-btn">

                            {product.type === "marchandise" &&
                            <><a href={`/produit/modifier/${product.id}`} id={product.id}
                                 className="btn-edit">Modifier</a>
                                <a href={`/produit/supprimer/${product.id}`} id={product.id}
                                   className="btn-delete">Supprimer</a></>
                            }

                            {product.type === "service" &&
                            <><a href={`/services/modifier/${product.id}`} id={product.id}
                                 className="btn-edit">Modifier</a>
                                <a href={`/services/supprimer/${product.id}`} id={product.id}
                                   className="btn-delete">Supprimer</a></>
                            }

                        </div>
                        }
                        </div>
                    ))}
                    </>

                })
            )
        }
    }
}
export default Card_product;
