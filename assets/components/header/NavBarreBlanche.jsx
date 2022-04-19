import React, { Component } from 'react'
import { Link } from 'react-router-dom'
import BarreBlanche from './BarreBlanche'
// import Search from './Search'
// import img1 from '../../styles/image/dropdown-entreprise.png'
// import img2 from '../../styles/image/dropdown-individu.png'
// import img3 from '../../styles/image/dropdown-ville.png'
import imgPetite from '../../styles/image/clock.jpg'
// import imgLittle from '../../styles/image/dropdown-petite.png'
import imgVillesRegions from '../../styles/image/Groupe_de_masques_53.jpg'
import imgIndividus from '../../styles/image/Groupe_de_masques_52.jpg'
import imgEntreprises from '../../styles/image/Groupe_de_masques_51.jpg'


// import imgOeil from '../../styles/image/oeil.png'
import ReactDOM from "react-dom";
const divUserRoleData = document.getElementById('navRoot');
let roleUtilisateur = divUserRoleData.dataset.eventRole;








export class NavBarreBlanche extends Component {

    constructor(props) {
        super(props);
        this.toggleClickState = this.toggleClickState.bind(this);
        this.changeLangue = this.changeLangue.bind(this);
        this.handleClick = this.handleClick.bind(this);
        this.empecheRedirection = this.empecheRedirection.bind(this);
        this.compareClicks = this.compareClicks.bind(this);
        this.determineElementsNavigationARendre = this.determineElementsNavigationARendre.bind(this);
        this.setState = this.setState.bind(this);
        this.actualitesClick = this.actualitesClick.bind(this)
        this.checkRegisteredToNewsletter = this.checkRegisteredToNewsletter.bind(this)

        this.state = {
            clickedToDisplayBarreBlanche: false,
            lastClicked: "",
            lastClickedSameAsThisClick: true,
            numberOfSameClicksInARow: 1,
            langue: "FR",
            indiceLangue: 1,
            registeredToNewsletter:''
        }


    }

    changeLangue = () => {
        //console.log("changement de langue")
        //console.log(this.state)
        if (this.state.indiceLangue % 2 == 0) {
            this.setState({
                langue: "FR"
            })
        } else {
            //Veut dire que l'utlisateur a cliqué au moins une fois -> anglais

            this.setState({
                langue: "EN"
            })
        }
        this.setState({ indiceLangue: this.state.indiceLangue + 1 })
    }


    //Affichage coonditionnels des boutons home, qui sommes nous, communauté, shop, nouveauté et actualités
    determineElementsNavigationARendre(roleUtilisateur) {
        let dispositionDeLaNavigation = "accueil";
        //console.log("éléments de navigation à rendre:");
        //console.log(roleUtilisateur);

        if (roleUtilisateur == "USER" | roleUtilisateur == "COMPANY" | roleUtilisateur == "CITY") {
            dispositionDeLaNavigation = "interface";
        } else {
            dispositionDeLaNavigation = "accueil";
        }
        return (dispositionDeLaNavigation);
    }


    //Cette fonction est crée pour empêcher les redirections vers les uatres pages via les éléments a
    //Pour l'utiliser, ajouter comme par ex: <a onClick=this.empecheRedirection ></a>
    empecheRedirection = (event) => {
        //console.log("L'évènement récupéré est le suivant:");
        //console.log(event);
        event.preventDefault();
    };

    //Récupération de l'évènement de changement
    //détermination de l'action à suivre à l'aide de toggleClickState; c'est le thisClick, transformé en lastClick, qui détermine le style de NavBarreBlanche (display = none ou display), à condition que clicked soit true.
    //Pour les éléments qui ne doivent pas afficher la barre pour l'instant, on appelle la fonction mais passe clicked à false.
    //Cela étant, pour par la suite changer le comportement, il suffit de passer clicked à true, puis à se rendre dans la fonction rendContenu du composant BarreBlanche.jsx
    handleClick (actionDuBouton, nomDuBouton) {
        //console.log("On pass par handle click et on veut: ");
        //console.log(actionDuBouton);
        if(actionDuBouton == 'afficherBarreBlanche'){
            //console.log("nom du bouton:")
            //console.log(nomDuBouton);
            this.toggleClickState({  clickedToDisplayBarreBlanche: true, thisClick: nomDuBouton });
        }else if(actionDuBouton == 'redirigerVersAutrePage'){
            this.toggleClickState({  clickedToDisplayBarreBlanche: false, thisClick: nomDuBouton });
        }
    };


    //A chaque nouveau clique, on compare avec le précédent. Si il est différent, on enregistre sa valeur sous lastClicked, qui détermine par la suite le contenu de la barre blanche, et on remet le nombre de clicks similaires d'affilé à 1. Si le nombre est paire, l'utilisateur a cliqué deux fois (ou 4/6/8...) et on considère qu'il veut fermer la fenêtre. Cf ligne
    compareClicks(ancientClick, newClick) {

        let similarClicks = false;

        if (ancientClick != newClick) {
            this.setState({ lastClicked: newClick });
            this.setState({ numberOfSameClicksInARow: 1 });
            similarClicks = false
        } else {
            similarClicks = true
            this.setState({ numberOfSameClicksInARow: this.state.numberOfSameClicksInARow + 1 });
        }
        //console.log("nombre de clicks similaires:");
        //console.log(similarClicks);
        return similarClicks;
    }

    toggleClickState = (data) => {
        this.setState({
            clickedToDisplayBarreBlanche: data.clickedToDisplayBarreBlanche,
            lastClickedSameAsThisClick: this.compareClicks(this.state.lastClicked, data.thisClick),
            lastClicked: data.thisClick,
        });

    }

    // Affiche la barre blanche seulement si le user connecté n'est pas encore inscrit à la newsletter
    actualitesClick(e) {
        if(this.state.registeredToNewsletter){
            this.handleClick("redirigerVersAutrePage", "Actualité")
        } else {
            this.handleClick("afficherBarreBlanche", "Actualité")
            this.empecheRedirection(e)
        }
    }

    checkRegisteredToNewsletter() {

        $.get('/newsletter/checkRegistered', data => {
            this.setState({
                    registeredToNewsletter: data['registered']
                }
            )
        })
    }

    closeMobileMenu = () => {
        this.setState({ clicked: false })
    }

    componentDidMount() {
        this.checkRegisteredToNewsletter();
    }


    render() {
        console.log(this.state);
        return (
            <nav>
                <div className="div-navbar">

                    <div className="div-logo-navbar-blanc" href="/" style = { this.determineElementsNavigationARendre(roleUtilisateur) == "accueil" ? {
                    } : {
                        display: 'none'
                    }
                    }>
                        
                        <div classname="logoRepertoireVert" href="/">
                            <a className="logoRepertoireVert" href="/home/COMPANY">
                                <img className="logoRepertoireVert" src="/css/img/logo-gaea21_1.png" href="/"/>
                            </a>
                        </div>
                    </div>

                    <div className="div-logo-navbar-noir" href= "/" style = { this.determineElementsNavigationARendre(roleUtilisateur) == "interface" ? {
                    } : {
                        display: 'none'
                    }
                    }>
                        <div classname="logoRepertoireVert" href="/">
                            <a className="logoRepertoireVert" href="/home/COMPANY">
                                <img className="logoRepertoireVert" src="/images/logo_repertoire_vert_noir.png"  href="/"/>
                            </a>
                       </div>
                    </div>


                    <div className="div-navbar-menus" >

                        <div className="container-login-language-menu" style={this.determineElementsNavigationARendre(roleUtilisateur) == "interface" ? {
                        } : {
                            display: 'none'
                        }
                        }>
                            <div onClick={() => this.handleClick("redirigerVersAutrePage", "Home")} className="div-menu ">
                                <a className="navbarHomeButton" href="/home/COMPANY">Home</a>
                            </div>

                            <div onClick={() => {this.handleClick("afficherBarreBlanche", "QuiSommesNous")}} className="div-menu " id="btn-qui-sommes-nous">
                                <a href="" onClick={this.empecheRedirection} className="navBarQuiSommesNousButton">Qui sommes-nous</a>
                            </div>

                        {/* Redirection impossible pour faire apparaitre la barre blanche, de plus, la souris change d'icone en mouse over, des sections ont été modifiée et rajouter (log out / login) et déplacer, étant devenus des boutons unique. */}

                            <div className="div-menu" onClick={() => this.handleClick("redirigerVersAutrePage", "Services")}> 
                                <a href="/404" className="navBarServicesButton">Services</a>
                            </div> 
{/* crré un nouvelle fonction qui remlacera celle si afin d'afficher ou non le formulaire  */}
                            <div className="div-menu" onClick={this.actualitesClick}>
                                <a href="/404" className="navbarActualitesButton">Actualités</a>
                            </div>

                            <div className="div-menu" onClick={() =>  this.handleClick("redirigerVersAutrePage", "Nouveautés")} >
                               <a href="/404" className="navbarNouveautesButton">Nouveautés</a>
                            </div>

                            <div className="div-menu" onClick={() => this.handleClick("redirigerVersAutrePage", "Communauté")}>
                               <a href="/404" className="navbarCommunauteButton">Communauté</a>
                            </div>

                            <div className="div-menu" onClick={() => this.handleClick("redirigerVersAutrePage", "Shop")}>
                               <a href="/404" className="navbarShopButton">Shop</a>
                            </div>

                            <div className="div-menu" onClick={() => this.handleClick("redirigerVersAutrePage", "MonCompte")}>
                                <a href="/profile/entreprise" className="navbarAccountButton">Mon Compte</a>
                            </div>

                            <div className="div-menu">
                                <a className="navbarLoginButton" href="/logout">Log out</a>
                            </div>
                            <div className="div-menu" onClick={() => this.changeLangue()}>
                                <span className="navbarLangueButton">FR|EN</span>
                            </div>
                        </div>
                        <div className="container-login-language-menu" style={this.determineElementsNavigationARendre(roleUtilisateur) == "accueil" ? {
                        } : {
                            display: 'none'
                        }
                        }>
                            <div onClick={() => this.handleClick("redirigerVersAutrePage", "Home")} className="div-menu ">
                                <a className="navbarHomeButton" href="/home/COMPANY">Home</a>
                            </div>

                            <div onClick={() => {this.handleClick("afficherBarreBlanche", "QuiSommesNous")}} className="div-menu " id="btn-qui-sommes-nous">
                                <a href="" onClick={this.empecheRedirection} className="navBarQuiSommesNousButton">Qui sommes-nous</a>
                            </div>

                            <div className="div-menu" onClick={() => this.handleClick("redirigerVersAutrePage", "Services")}>
                                <a href="/404" className="navBarServicesButton">Services</a>
                            </div> 


                            <div className="div-menu" onClick={this.actualitesClick}>
                                <a href="/404" className="navbarActualitesButton">Actualités</a>
                            </div>

                            <div className="div-menu" onClick={() =>  this.handleClick("redirigerVersAutrePage", "Nouveautés")} >
                               <a href="/404" className="navbarNouveautesButton">Nouveautés</a>
                            </div>
                            <div className="div-menu" onClick={() => this.handleClick("redirigerVersAutrePage", "Communauté")}>
                               <a href="/404" className="navbarCommunauteButton">Communauté</a>
                            </div>

                            <div className="div-menu" onClick={() => this.handleClick("redirigerVersAutrePage", "Shop")}>
                               <a href="/404" className="navbarShopButton">Shop</a>
                            </div>

                            <div onClick={() => this.handleClick("redirigerVersAutrePage", "S'inscrire")} className="div-menu ">
                                <a className="navbarInscriptionButton" href="/inscription-entreprise/">S'inscrire</a>
                            </div>

                            <div className="div-menu" onClick={() => this.toggleClickState({ clickedToDisplayBarreBlanche: true, thisClick: "Login" })}>
                                <a className="navbarLoginButton">login</a>
                            </div>
                            <div className="div-menu" onClick={() => this.changeLangue()}>
                                <span className="navbarLangueButton">FR|EN</span>
                            </div>

                        </div>


                    </div>

                    {/*  Barre de navigation qui n'apparaît qu'au clic d'un élément du menu supérieur  */}
                    <div className="navBarBlanche" style={
                        this.state. clickedToDisplayBarreBlanche && (this.state.numberOfSameClicksInARow % 2) != 0 ? //Cette opération fait en sorte que deux clics de suite sur le même bouton, la barre disparit, avec un de plus elle réaparait un autre de plus disparait ect
                            {
                                display: "flex"
                            } : {
                                display: "none"
                            }
                    }>
                        <BarreBlanche contenuARendre={this.state.lastClicked} langue={this.state.langue} />
                    </div>

                </div>
            </nav>
        )
    }

}

export default NavBarreBlanche




