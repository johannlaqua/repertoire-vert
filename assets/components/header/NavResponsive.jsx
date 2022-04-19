import React, { Component } from 'react';
import {login} from "../../../public/js/ui/login";


const divUserRoleData = document.getElementById('navResponsiveRoot');
let roleUtilisateur = divUserRoleData.dataset.eventRole;

class QuiSommesNous extends Component{

    render() {

        return (<>
            <a onClick={this.props.onclick} className={`div-menu ${this.props.isActive ? "selected" : ""}`} id="btn-qui-sommes-nous">
                <span>Qui sommes-nous</span>
                <img className='interrogation img-verte' src="/images/menu_responsive/qui-sommes-nous-vert.svg" alt="point d'interrogation"/>
                <img className='interrogation img-blanche' src="/images/menu_responsive/qui-sommes-nous.svg" alt="point d'interrogation"/>
            </a>
            {this.props.isActive &&
                <div className="subMenu">
                    <a className="underline" href='/404'>Entreprise</a>
                    <a className="underline" href='/404'>Individu</a>
                    <a href='/404'>Ville/Région</a>
                </div>
            }
        </>

        )

    }

}

class Services extends Component{

    render() {
        return (<>
            <a onClick={this.props.onclick} className={`div-menu ${this.props.isActive ? "selected" : ""}`}>
                <span>Services</span>
                <img className='img-verte' src="/images/menu_responsive/services-vert.svg" alt="services"/>
                <img className='img-blanche' src="/images/menu_responsive/services.svg" alt="services"/>
            </a>
            {this.props.isActive &&
                <div className="subMenu">
                    <a className="underline" href='/404'>Voulez vous partager vos actualités ? Devenez membre</a>
                    <a className="underline" href='/404'>Programme d'accompagnement</a>
                    <a className="underline" href='/404'>Mise en relation RV</a>
                    <a className="underline" href='/404'>Programme de coaching entreprises RV</a>
                    <a href='/404'>Page pub pour entreprises</a>
                </div>
            }
        </>)

    }
}

class Login extends Component{
    constructor(props) {
        super(props);
        this.state = {
            texteMotDePasse: "Mot de Passe",
            texteValider: "Valider",
        }
    }


    changeTextLanguageEN(){

        this.setState({
            texteMotDePasse: "Password",
            texteValider: "Confirm",
        })

    }

    changeTextLanguageFR(){

        this.setState({
            texteMotDePasse: "Mot de Passe",
            texteValider: "Valider",
        })

    }

    render() {

        return (
            <>
                <a onClick={this.props.onclick} className={`div-menu ${this.props.isActive ? "selected" : ""}`}>
                    <span>login</span>
                    <img className='img-verte' src="/images/menu_responsive/login-vert.svg" alt="profil"/>
                    <img className='img-blanche' src="/images/menu_responsive/login.svg" alt="profil"/>
                </a>
                {this.props.isActive &&
                    <div className="subMenu login">
                        <div>
                            <label htmlFor="Email">Email</label>
                            <input type="text" name="Email" id="email"></input>
                        </div>
                        <div>
                            <label htmlFor="MotDePasse">{this.state.texteMotDePasse}</label>
                            <input type="password" name="MotDePasse" id="password"></input>
                        </div>

                        <label className="labelErrorLocation" id="errorlocation"></label>
                        <button style={{cursor: "pointer"}} id="btnn" onClick={login}>{this.state.texteValider}</button>
                    </div>
                }
            </>
        )

    }

}

class BurgerMenuAndLogo extends Component{

    constructor(props) {
        super(props);
    }

    render(){
        console.log('PROPS : ', this.props)
        return (<>
            <div className="img"
                 style={this.props.role == "déconnecté" ? {} : {
                     display: 'none'
                 }
                 }>
                <a href="/home/COMPANY">
                    <img className="logoRepertoireVert" src="/css/img/logo-gaea21_1.png"/>
                </a>
            </div>

            <div className="img" style={this.props.role == "connecté" ? {} : {
                     display: 'none'
            }}>
                <a href="/home/COMPANY">
                    <img className="logoRepertoireVert" src="/images/logo_repertoire_vert_noir.png"/>
                </a>

            </div>
            <div className="burgerMenu" onClick={this.props.onclick}>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </>)
    }

}

class BoxNewsletter extends React.Component {
    constructor(props) {
        super(props);
        this.setState = this.setState.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.verifyEmail = this.verifyEmail.bind(this);
        this.newsletterInscription = this.newsletterInscription.bind(this);
        this.checkLogin = this.checkLogin.bind(this);


        this.state = {
            emailvalid: false,
            success:false,
            error :'',
            loggedIn: '',
        }
    };

    handleChange(event) {

        this.setState({emailvalid:this.verifyEmail(event.target.value)});
    }

    verifyEmail(mail) {

        let emailRegExp = new RegExp('^([\\S]+)@([\\S]+\\.)([a-zA-Z]{2,4})', 'i');

        let testEmail = emailRegExp.test(mail);
        console.log(testEmail)
        if (testEmail == false) {
            return false;
        } else {
            //emailisvalid = true;
            return true;
        }
    }

    newsletterInscription () {

        $("#button").prop('disabled', true)

        let toutrempli = false;

        if(
            $("#prenom").val()
            && $("#nom").val()
            && $("#ville").val()
            && $("#code_postal").val()
            && $("#mail").val()
        ) {
            toutrempli = true;
        }

        if ((this.state.emailvalid && toutrempli) || this.state.loggedIn){
            let objArr = {
                "prenom": $("#prenom").val(),
                "nom": $("#nom").val(),
                "ville": $("#ville").val(),
                "code_postal": $("#code_postal").val(),
                "mail": $("#mail").val(),
            };

            objArr= JSON.stringify(objArr);

            $.ajax({
                method: "POST",
                url: "/newsletter/inscription",
                dataType: "json",
                data : objArr,

                error: (xhr, status, error) => {

                    console.log(xhr, status, error);
                    this.setState({
                        error:'Une erreur est survenue. Veuillez réessayer.',
                        success: false
                    })
                },
            }).done(response => {

                console.log(response)
                this.setState({
                    success:true,
                    error: ''
                })
                $("#button").prop('disabled', false)
            })

        } else if(!this.state.emailvalid) {
            $("#button").prop('disabled', false)
            this.setState({
                error:'L\'adresse mail est invalide',
                success: false
            })
        } else {
            $("#button").prop('disabled', false)
            this.setState({
                error:'Veuillez remplir tous les champs',
                success: false
            })
        }

    }

    checkLogin() {

        $.get('/checklogin', data => {
            this.setState({
                    loggedIn: data['loggedIn']
                }
            )
        })
    }

    componentDidMount() {
        this.checkLogin()
    }

    render() {

        let newsletterContent;
        if (this.props.isActive && !this.props.registered) {

            if (!this.state.loggedIn) {
                ///// SI ON EST PAS CONNECTE, ON AFFICHE LE FORMULAIRE D'INSCRIPTION A LA NEWSLETTER
                newsletterContent =
                    <div className='subMenu login'>

                        <span>Inscription à la communauté et à la newsletter</span>

                        <div className='form'>
                            <label htmlFor="Name">Nom</label>
                            <input type="text" name="Nom" id="nom"></input>
                        </div>

                        <div className='form'>
                            <label htmlFor="firstname">Prénom</label>
                            <input type="text" name="prénom" id="prenom"></input>
                        </div>

                        <div className='form'>
                            <label htmlFor="email">Mail</label>
                            <input type="text" name="mail" id="mail"
                                   onChange={this.handleChange}></input>
                        </div>

                        <div className='form'>
                            <label htmlFor="Postal">Code Postal</label>
                            <input type="text" name="Postal"
                                   id="code_postal"></input>
                        </div>

                        <div className='form'>
                            <label htmlFor="City">Ville</label>
                            <input type="text" name="City" id="ville"></input>
                        </div>

                        <button style={{cursor: "pointer"}} id="button"
                                onClick={this.newsletterInscription}>Je m'inscris
                        </button>
                        <label className="labelErrorLocationNewsletter" id="errorlocation">{this.state.error}</label>
                        {this.state.success && <div className="success">Inscription réussie</div>}
                    </div>

            } else if (this.state.loggedIn) {
                ////// SI ON EST CONNECTE, ON AFFICHE SEULEMENT LE BOUTON D'INSCRIPTION DANS LA NAVBAR //////
                newsletterContent =
                    <div className='subMenu login'>

                        <button style={{cursor: "pointer"}} id="button"
                                onClick={this.newsletterInscription}>Je m'inscris à la newsletter
                        </button>
                        <label id="errorlocation">{this.state.error}</label>
                        {this.state.success && <div className="success">Inscription réussie</div>}
                    </div>
            }
        } else newsletterContent = null;


        return <>
            <a href="/404" onClick={this.props.onclick} className={`div-menu ${this.props.isActive ? "selected" : ""}`}>
                <span>Actualités</span>
                <img className="img-verte" src="/images/menu_responsive/actualites-vert.svg" alt="news"/>
                <img className="img-blanche" src="/images/menu_responsive/actualites.svg" alt="news"/>
            </a>
            {newsletterContent}
        </>
    }
}


export class NavResponsive extends Component {

    constructor(props) {
        super(props);
        this.determineElementsNavigationARendre = this.determineElementsNavigationARendre.bind(this);
        this.toggleClick = this.toggleClick.bind(this)
        this.changeLanguageEN = this.changeLanguageEN.bind(this)
        this.changeLanguageFR = this.changeLanguageFR.bind(this)
        this.toggleActive = this.toggleActive.bind(this)
        this.checkRegisteredToNewsletter = this.checkRegisteredToNewsletter.bind(this)

        this.state = {
            langue: "FR",
            activeId: null
        }

        this.loginComponent = React.createRef()


    }

    checkRegisteredToNewsletter() {

        $.get('/newsletter/checkRegistered', data => {
            this.setState({
                    registeredToNewsletter: data['registered']
                }
            )
        })
    }

    // Permet de fermer les onglets ouverts sauf celui sur lequel on vient de cliquer
    toggleActive = id => {

        return e => {
            this.setState(({ activeId }) => ({
                activeId: activeId === id ? null : id, // toggle same id off, or set new
            }))

            if(id === 'actualites' && !this.state.registeredToNewsletter){
                e.preventDefault()
            }
        }


    };

    changeLanguageEN = () => {

        this.setState({
            langue: "EN"
        }, this.loginComponent.current.changeTextLanguageEN())


    }

    changeLanguageFR = () => {

        this.setState({
            langue: "FR"
        },this.loginComponent.current.changeTextLanguageFR())


    }


    //Affichage coonditionnels des boutons home, qui sommes nous, communauté, shop, nouveauté et actualités
    determineElementsNavigationARendre(roleUtilisateur) {
        let dispositionDeLaNavigation = "accueil";
        console.log("éléments de navigation à rendre:");
        console.log(roleUtilisateur);

        if (roleUtilisateur == "USER" | roleUtilisateur == "COMPANY" | roleUtilisateur == "CITY") {
            dispositionDeLaNavigation = "connecté";
        } else {
            dispositionDeLaNavigation = "déconnecté";
        }
        this.setState({
            role: dispositionDeLaNavigation
        })
    }

    toggleClick() {
        if(this.state.open){
            this.setState({
                open : false
            })
        } else {
            this.setState({
                open : true
            })
        }
    }

    componentDidMount() {

        this.determineElementsNavigationARendre(roleUtilisateur)
        this.checkRegisteredToNewsletter()
    }

    render() {
        console.log("Etat du composant");
        console.log(this.state);
        if (this.state.open){
            return <>
                <BurgerMenuAndLogo role={this.state.role} onclick={this.toggleClick}/>
                <div className='responsive-menu-container'>
                    <div className='responsive-menu-content'>
                        <div className="option-menu">
                            <a href="/home/COMPANY" className="div-menu " onClick={this.toggleActive('home')}>
                                <span>Home</span>
                                <img className="img-verte" src="/images/menu_responsive/home-vert.svg" alt="maison"/>
                                <img className="img-blanche" src="/images/menu_responsive/home.svg" alt="maison"/>
                            </a>
                        </div>

                        <div className="option-menu">
                            <QuiSommesNous onclick={this.toggleActive('quiSommesNous')} isActive={this.state.activeId == 'quiSommesNous'}/>
                        </div>
                        <div className="option-menu">
                            <Services onclick={this.toggleActive('services')} isActive={this.state.activeId == 'services'}/>
                        </div>

                        <div className="option-menu" >
                            <BoxNewsletter onclick={this.toggleActive('actualites')} isActive={this.state.activeId == 'actualites'} registered={this.state.registeredToNewsletter}/>
                        </div>

                        <div className="option-menu">
                            <a href="/404" className="div-menu" onClick={this.toggleActive('nouveautes')}>
                                <span>Nouveautés</span>
                                <img className="img-verte" src="/images/menu_responsive/ampoule-verte.svg" alt="ampoule"/>
                                <img className="img-blanche" src="/images/menu_responsive/ampoule.svg" alt="ampoule"/>
                            </a>
                        </div>

                        <div className="option-menu">
                            <a href="/404" className="div-menu" onClick={this.toggleActive('communaute')}>
                                <span>Communauté</span>
                                <img className="img-verte" src="/images/menu_responsive/communauté-vert.svg" alt="groupe"/>
                                <img className="img-blanche" src="/images/menu_responsive/communauté.svg" alt="groupe"/>
                            </a>
                        </div>

                        <div className="option-menu">
                            <a href="/404" className="div-menu" onClick={this.toggleActive('shop')}>
                                <span >Shop</span>
                                <img className="img-verte" src="/images/menu_responsive/shop-vert.svg" alt="shopping"/>
                                <img className="img-blanche" src="/images/menu_responsive/shop.svg" alt="shopping"/>
                            </a>
                        </div>

                        <div className='container-ligne'>
                            <span className='ligne-verte'></span>
                        </div>

                        {this.state.role == 'connecté' &&
                            <>
                                <div className="option-menu">
                                    <a href="/Dashboard/" className="div-menu monCompte" onClick={this.toggleActive('compte')}>
                                        <span>Mon Compte</span>
                                        <img className="img-verte" src="/images/menu_responsive/login-vert.svg" alt="profil"/>
                                        <img className="img-blanche" src="/images/menu_responsive/login.svg" alt="profil"/>
                                    </a>
                                </div>
                                <div className="option-menu">
                                    <a href="/logout" className="div-menu" onClick={this.toggleActive('logout')}>
                                        <span>Log out</span>
                                    </a>
                                </div>
                            </>
                        }
                        {this.state.role == 'déconnecté' &&
                            <>
                                <div className="option-menu monCompte">
                                    <a href="/inscription-entreprise/" className="div-menu" onClick={this.toggleActive('inscrire')}>
                                        <span>S'inscrire</span>
                                    </a>
                                </div>

                                <div className="option-menu">
                                    <Login ref={this.loginComponent} langue={this.state.langue} onclick={this.toggleActive('login')} isActive={this.state.activeId == 'login'}/>
                                </div>
                            </>
                        }

                        <div className="langues">
                            <div className="div-menu">
                                Langues
                                <div>
                                    <span onClick={() => this.changeLanguageFR()}>FR</span>
                                    <span onClick={() => this.changeLanguageEN()}>EN</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </>
        } else{
            return <BurgerMenuAndLogo role={this.state.role} onclick={this.toggleClick}/>
        }

    }

}

export default NavResponsive




