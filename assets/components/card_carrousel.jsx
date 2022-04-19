import React, {Component} from 'react';
import ReactDOM from "react-dom";
import Flickity from 'react-flickity-component';
import "../styles/flickity.css";
import "../styles/carousel.scss";
import Card_product from './card_product';

//let firstClicked = false;

class Card_carrousel extends Component {

    constructor(props) {

        super(props);
        this.state = {
            categories: [],
            activeCats: []
        };

        this.setState = this.setState.bind(this)
        this.toggleActive = this.toggleActive.bind(this)
    }

    componentDidMount() {
        this.getCategoriesByCompanyId(companyId)

        /*this.flkty.on('staticClick', function (event, pointer, cellElement, cellIndex) {
            // dismiss if cell was not clicked
            if (!cellElement) {
                return;
            }
            // change cell background with .is-clicked
            $(cellElement.children).toggleClass('hidden');
            console.log(cellElement)
            this.setState({
                //categories:
            })

        });*/

    }

    toggleActive = cat => e => {

        //On récupère l'état actuel de la propriété activeCats
        this.setState(({activeCats}) => ({
            // Si le tableau de la propriété activeCats contient deja la categorie sur laquelle on clique (càd si on clique une 2eme fois dessus), on la supprime du tableau, sinon on l'ajoute
            activeCats: activeCats.includes(cat) ?
                this.state.activeCats.filter(val => {
                    return val !== cat;
                })
                : [...activeCats, cat], // toggle same id off, or set new
        }))


    };


    getCategoriesByCompanyId(companyId) {
        this.setState({
            categories:[]
        });
        fetch(`/rest/categoriesByCompany/`+companyId, {
            method: "get",
            header: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            credentials: 'same-origin'

        }).then(response => {
            return response.json()
        }).then(data => {
            //console.log(data)
            this.setState({
                    categories: data
                }

            )

        });
    }

    render() {
        const flickityOptions = {
            //cellAlign: 'center',
            contain: true
        }


        console.log(this.state)
        return (
            <>
                <Flickity
                    className="main-carousel"
                    //flickityRef = { c  => this.flkty = c }
                    options={flickityOptions}
                >
                    { this.state.categories.map(cat => {
                        return <div className="carousel-cell" key={cat.id} onClick={this.toggleActive(cat)}>
                            <img className={!this.state.activeCats.includes(cat) /*|| !firstClicked*/ ? '' : 'hidden'}
                                 src={`/images/Icones_Categories/${cat.name}/${cat.name}_noir.png`}
                                 alt={cat.name}/>
                            <img className={this.state.activeCats.includes(cat) /*&& firstClicked*/ ? '' : 'hidden'}
                                 src={`/images/Icones_Categories/${cat.name}/${cat.name}_bleu.png`}
                                 alt={cat.name}/>
                        </div>
                    })}
                </Flickity>
                <Card_product categories={this.state.activeCats}/>

            </>

        )
    }
}
export default Card_carrousel;

ReactDOM.render(<Card_carrousel />, document.getElementById('cards-carrousel'));
//ReactDOM.render(<Card_product tabCategories={}/>, document.getElementById('products-cards'));
