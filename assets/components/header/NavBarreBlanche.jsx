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
            //Veut dire que l'utlisateur a cliqu?? au moins une fois -> anglais

            this.setState({
                langue: "EN"
            })
        }
        this.setState({ indiceLangue: this.state.indiceLangue + 1 })
    }


    //Affichage coonditionnels des boutons home, qui sommes nous, communaut??, shop, nouveaut?? et actualit??s
    determineElementsNavigationARendre(roleUtilisateur) {
        let dispositionDeLaNavigation = "accueil";
        //console.log("??l??ments de navigation ?? rendre:");
        //console.log(roleUtilisateur);

        if (roleUtilisateur == "USER" | roleUtilisateur == "COMPANY" | roleUtilisateur == "CITY") {
            dispositionDeLaNavigation = "interface";
        } else {
            dispositionDeLaNavigation = "accueil";
        }
        return (dispositionDeLaNavigation);
    }


    //Cette fonction est cr??e pour emp??cher les redirections vers les uatres pages via les ??l??ments a
    //Pour l'utiliser, ajouter comme par ex: <a onClick=this.empecheRedirection ></a>
    empecheRedirection = (event) => {
        //console.log("L'??v??nement r??cup??r?? est le suivant:");
        //console.log(event);
        event.preventDefault();
    };

    //R??cup??ration de l'??v??nement de changement
    //d??termination de l'action ?? suivre ?? l'aide de toggleClickState; c'est le thisClick, transform?? en lastClick, qui d??termine le style de NavBarreBlanche (display = none ou display), ?? condition que clicked soit true.
    //Pour les ??l??ments qui ne doivent pas afficher la barre pour l'instant, on appelle la fonction mais passe clicked ?? false.
    //Cela ??tant, pour par la suite changer le comportement, il suffit de passer clicked ?? true, puis ?? se rendre dans la fonction rendContenu du composant BarreBlanche.jsx
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


    //A chaque nouveau clique, on compare avec le pr??c??dent. Si il est diff??rent, on enregistre sa valeur sous lastClicked, qui d??termine par la suite le contenu de la barre blanche, et on remet le nombre de clicks similaires d'affil?? ?? 1. Si le nombre est paire, l'utilisateur a cliqu?? deux fois (ou 4/6/8...) et on consid??re qu'il veut fermer la fen??tre. Cf ligne
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

    // Affiche la barre blanche seulement si le user connect?? n'est pas encore inscrit ?? la newsletter
    actualitesClick(e) {
        if(this.state.registeredToNewsletter){
            this.handleClick("redirigerVersAutrePage", "Actualit??")
        } else {
            this.handleClick("afficherBarreBlanche", "Actualit??")
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

                        {/* Redirection impossible pour faire apparaitre la barre blanche, de plus, la souris change d'icone en mouse over, des sections ont ??t?? modifi??e et rajouter (log out / login) et d??placer, ??tant devenus des boutons unique. */}

                            <div className="div-menu" onClick={() => this.handleClick("redirigerVersAutrePage", "Services")}> 
                                <a href="/404" className="navBarServicesButton">Services</a>
                            </div> 
{/* crr?? un nouvelle fonction qui remlacera celle si afin d'afficher ou non le formulaire  */}
                            <div className="div-menu" onClick={this.actualitesClick}>
                                <a href="/404" className="navbarActualitesButton">Actualit??s</a>
                            </div>

                            <div className="div-menu" onClick={() =>  this.handleClick("redirigerVersAutrePage", "Nouveaut??s")} >
                               <a href="/404" className="navbarNouveautesButton">Nouveaut??s</a>
                            </div>

                            <div className="div-menu" onClick={() => this.handleClick("redirigerVersAutrePage", "Communaut??")}>
                               <a href="/404" className="navbarCommunauteButton">Communaut??</a>
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
                                <a href="/404" className="navbarActualitesButton">Actualit??s</a>
                            </div>

                            <div className="div-menu" onClick={() =>  this.handleClick("redirigerVersAutrePage", "Nouveaut??s")} >
                               <a href="/404" className="navbarNouveautesButton">Nouveaut??s</a>
                            </div>
                            <div className="div-menu" onClick={() => this.handleClick("redirigerVersAutrePage", "Communaut??")}>
                               <a href="/404" className="navbarCommunauteButton">Communaut??</a>
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

                    {/*  Barre de navigation qui n'appara??t qu'au clic d'un ??l??ment du menu sup??rieur  */}
                    <div className="navBarBlanche" style={
                        this.state. clickedToDisplayBarreBlanche && (this.state.numberOfSameClicksInARow % 2) != 0 ? //Cette op??ration fait en sorte que deux clics de suite sur le m??me bouton, la barre disparit, avec un de plus elle r??aparait un autre de plus disparait ect
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




