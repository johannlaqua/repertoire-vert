
import React from 'react';
import imgVillesRegions from '../../styles/image/Groupe_de_masques_53.jpg'
import imgIndividus from '../../styles/image/Groupe_de_masques_52.jpg'
import imgEntreprises from '../../styles/image/Groupe_de_masques_51.jpg'
import imgQuiSommesNous from '../../styles/image/Groupe-de masques-49@2x.jpg'
import {login} from "../../../public/js/ui/login";



class BarreBlanche extends React.Component {
    constructor(props) {
        super(props);
        console.log("propriétés de la barre blanche:")
        console.log(props);
        this.rendContenu = this.rendContenu.bind(this);
    };


    rendContenu(contenuARendre) {
        console.log("contenu à rendre: ");
        console.log(contenuARendre);
        if (contenuARendre == "QuiSommesNous") {
            return (<div><NavBoxQuiSommesNous /><NavBoxEntreprises /><NavBoxIndividus /><NavBoxVilleRegion /></div>)
        } else if (contenuARendre == "Actualité") {
            return (<BoxNewsletter langue={this.props.contenuaRendre}/>)
        } else if (contenuARendre == "Nouveautés") {
            return (<div>News</div>)
        } else if (contenuARendre == "Communauté") {
            return (<div>Communauté</div>)
        }
        else if (contenuARendre == "Shop") {
            return (<div>Shop</div>)
        }
        else if (contenuARendre == "Nouveautés") {
         
            return (<BoxNewsletter langue={this.props.contenuaRendre}/>)
        }
        else if (contenuARendre == "MonCompte") {
            return (<div>Mon Compte</div>)
        }
        else if (contenuARendre == "Home") {
            return (<div><NavBoxQuiSommesNous /><NavBoxEntreprises /><NavBoxIndividus /><NavBoxVilleRegion /></div>)
        } else if (contenuARendre == "Login") {
            return (<BoxLogin langue={this.props.langue} />)
        }
    }

    render() {
        return (
            <div className="contenuBarreBlancheNavigation">
                {this.rendContenu(this.props.contenuARendre)}
            </div>
        );
    }
}
export default BarreBlanche;


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
        console.log(this.state)

        if(!this.state.loggedIn) {
        ///// SI ON EST PAS CONNECTE, ON AFFICHE LE FORMULAIRE D'INSCRIPTION A LA NEWSLETTER
            return (
                <div className='contenuNewsletter'>

                    <span className="titleboxNameNewslett">Inscription à la communauté et à la newsletter</span>

                    <div className='containerFormulaire'>

                        <div className='form'>
                            <label className="labelNameBoxNewsletter" htmlFor="Name">Nom</label>
                            <input className="inputNameBoxNewsletter" type="text" name="Nom" id="nom"></input>
                        </div>

                        <div className='form'>
                            <label className="labelFirstNameBoxNewsletter" htmlFor="firstname">Prénom</label>
                            <input className="inputFirstNameBoxNewsletter" type="text" name="prénom" id="prenom"></input>
                        </div>

                        <div className='form'>
                            <label className="labelMailBoxNewsletter" htmlFor="email">Mail</label>
                            <input className="inputMailBoxNewsletter " type="text" name="mail" id="mail" onChange={this.handleChange}></input>
                        </div>

                        <div className='form'>
                            <label className="labelPostalBoxNewsletter" htmlFor="Postal">Code Postal</label>
                            <input className="inputPostalBoxNewsletter" type="text" name="Postal" id="code_postal"></input>
                        </div>

                        <div className='form'>
                            <label className="labelCityBoxNewsletter" htmlFor="City">Ville</label>
                            <input className="inputCityBoxNewsletter" type="text" name="City" id="ville"></input>
                        </div>



                    </div>
                    <button className="inputSubmitBoxnewsletter" style={{cursor: "pointer"}} id="button" onClick={this.newsletterInscription}>Je m'inscris</button>
                    <label className="labelErrorLocationNewsletter" id="errorlocation">{this.state.error}</label>
                    { this.state.success && <div className="success">Inscription réussie</div> }
                </div>
            );
        } else if(this.state.loggedIn) {
        ////// SI ON EST CONNECTE, ON AFFICHE SEULEMENT LE BOUTON D'INSCRIPTION DANS LA NAVBAR //////
            return (
                <div className='contenuNewsletter'>

                    <button className="inputSubmitBoxnewsletter" style={{cursor: "pointer"}} id="button" onClick={this.newsletterInscription}>Je m'inscris à la newsletter</button>
                    <label className="labelErrorLocationNewsletter" id="errorlocation">{this.state.error}</label>
                    {this.state.success && <div className="success">Inscription réussie</div>}
                </div>

            )
        }
    }
}




class NavBoxQuiSommesNous extends React.Component {
    render() {
        return (
            <div className="navBoxContainer">
                <img className="imageQuiSommesNous" src={imgQuiSommesNous}></img>
                <span className="titreQuiSommesNous">Qui sommes-nous ?</span>
                <div className="NavBoxQuiSommesNous">
                    Le Répertoire Vert est un projet de l’association gaea21 qui œuvre à promouvoir
                    l’application des mesures de l’Agenda 21 et proposer des services liés au développement durable.
                </div>
            </div>
        );
    }
}

class NavBoxEntreprises extends React.Component {
    render() {
        return (

            <div className="navBoxContainer">
                <a href="/404">
                    <img className="navBoxEntrepriseImage" src={imgEntreprises}></img>
                    <span className="navBoxEntrepriseTitre">Entreprise</span>
                </a>
            </div>
        );
    }
}

class NavBoxIndividus extends React.Component {
    render() {
        return (
            <div className="navBoxContainer">
                <a href="/404">
                    <img className="navBoxIndividusImage" src={imgIndividus}></img>
                    <span className="navBoxIndividusTitre">Individus</span>
                </a>
            </div>
        );
    }
}

class NavBoxVilleRegion extends React.Component {
    render() {
        return (
            <div className="navBoxContainer">
                <a href="/404">
                    <img className="navBoxVilleRegionImage" src={imgVillesRegions}></img>
                    <span className="navBoxVilleRegionTitre">Ville/Region</span>
                </a>
            </div>
        );
    }
}

// Rajouts de sections et modifications, le but ici est de permettre le changement de langues pour certains texte, changer les titre de sections et changement d'icone de la souris 

class BoxLogin extends React.Component {
    constructor(props) {
        super(props);
        this.setState = this.setState.bind(this);
        console.log(props);
        if (this.props.langue == "FR") {
            this.state = {
                texteMotDePasse: "Mot de Passe",
                texteValider: "Valider",
            }
        } else {
            this.state = {
                texteMotDePasse: "Password",
                texteValider: "Confirm",
            }
        }
    };


    render() {
        console.log("objet boxLogin:")
        console.log(this.state);
        return (
            <>
                <img className="smallImageLoginForm" src='/images/clock-login.jpg'></img>
                <span className="titreQuiSommesNous">Log in</span>

                    <span className="titleBoxLogin">Login</span>
                    <label className="labelEmailBoxLogin" htmlFor="Email">Email</label>
                    <input className="inputEmailBoxLogin" type="text" name="Email" id="email"></input>
                    <label className="labelPasswordBoxLogin" htmlFor="MotDePasse">{this.state.texteMotDePasse}</label>
                    <input className="inputPasswordBoxLogin" type="password" name="MotDePasse" id="password"></input>
                    <label  className="labelErrorLocation" id="errorlocation"></label>
                    <button className="inputSubmitBoxLogin" style={{cursor: "pointer"}} id="btnn" onClick={login}>Valider</button>
                <a className = "redirectionInscriptionBoxLogin" href="/inscription-entreprise">Pas encore inscrit ?</a>

                <img className="imageLoginForm" src="/images/image-login.44b00b54.png"></img>
            </>
        );
    }
}

