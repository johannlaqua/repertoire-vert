
import React, { Component } from 'react'
import { Link } from 'react-router-dom'
// import Search from './Search'
// import img1 from '../../styles/image/dropdown-entreprise.png'
// import img2 from '../../styles/image/dropdown-individu.png'
// import img3 from '../../styles/image/dropdown-ville.png'
import imgPetite from '../../styles/image/clock.jpg'
// import imgLittle from '../../styles/image/dropdown-petite.png'
import imgLogin from '../../styles/image/image-login.png'
// import imgOeil from '../../styles/image/oeil.png'







export class Nav extends Component {

    state = { clicked: false }

    handleClick = () => {
        this.setState({ clicked: !this.state.clicked })
    }

    closeMobileMenu = () => {
        this.setState({ clicked: false })
    }


    render() {


        return (

            <nav className='navbar'>
                <div className="logo" onClick={this.closeMobileMenu}></div>


                <div className="menu-icon" onClick={this.handleClick}>
                    <i className={this.state.clicked ? 'fas fa-times' : 'fas fa-bars'}></i>
                </div>

                <ul className={this.state.clicked ? 'nav-menu active' : 'nav-menu'} >

                    <div className="container-home">
                        <li className="nav_item">
                            <a href="/" className="nav_links" >Home</a>
                        </li>
                    </div>

                    <div className="container-about">
                        <li className="nav_item">
                            <a href="/" className="nav_links">Qui sommes nous</a>
                            {/* <div className="sub_menu">
                                <div className="col-image-petite">
                                    <img id="img-petite" src={imgLittle} />
                                </div>
                                <div className="col-about">
                                    <h4>Qui sommes nous</h4>
                                    <p id="para-petit">fzefhfifnfjfqljfmOJF<br />EOIMJFZO</p>
                                </div>
                                <div className="col-entreprise">
                                    <img src={img1} />
                                    <p className="gras">Entreprise</p>
                                </div>
                                <div className="col-individu">
                                    <img src={img2} />
                                    <p className="gras">Individu</p>
                                </div>
                                <div className="col-ville">
                                    <img src={img3} />
                                    <p className="gras">Ville / Région</p>
                                </div>
                            </div> */}
                        </li>
                    </div>

                    <div className="container-service">
                        <li className="nav_item">
                            <a href="/" className="nav_links">Services</a>
                            {/* <div className="sub_menu">
                                <div className="col-image-petite">
                                    <img id="img-petite" src={imgLittle} />
                                </div>
                                <div className="col-about">
                                    <h4>Services</h4>
                                    <p id="para-petit">fzefhfifnfjfqljfmOJF<br />EOIMJFZO</p>
                                </div>
                                <div className="col-entreprise">
                                    <img src={img1} />
                                    <p className="gras">Entreprise</p>
                                </div>
                                <div className="col-individu">
                                    <img src={img2} />
                                    <p className="gras">Individu</p>
                                </div>
                                <div className="col-ville">
                                    <img src={img3} />
                                    <p className="gras">Ville / Région</p>
                                </div>
                            </div> */}
                        </li>
                    </div>

                    <div className="container-actualite">
                        <li className="nav_item">
                            <a href="/actualites" className="nav_links">Actualités</a>
                            {/* <div className="sub_menu">
                                <div className="col-image-petite">
                                    <img id="img-petite" src={imgLittle} />
                                </div>
                                <div className="col-about">
                                    <h4>Actualités</h4>
                                    <p id="para-petit">fzefhfifnfjfqljfmOJF<br />EOIMJFZO</p>
                                </div>
                                <div className="col-entreprise">
                                    <img src={img1} />
                                    <p className="gras">Entreprise</p>
                                </div>
                                <div className="col-individu">
                                    <img src={img2} />
                                    <p className="gras">Individu</p>
                                </div>
                                <div className="col-ville">
                                    <img src={img3} />
                                    <p className="gras">Ville / Région</p>
                                </div>
                            </div> */}
                        </li>
                    </div>

                    <div className="container-nouveaute">
                        <li className="nav_item">
                            <a href="/nouveautes" className="nav_links">Nouveautés</a>
                            {/* <div className="sub_menu">
                                <div className="col-image-petite">
                                    <img id="img-petite" src={imgLittle} />
                                </div>
                                <div className="col-about">
                                    <h4>Nouveautés</h4>
                                    <p id="para-petit">fzefhfifnfjfqljfmOJF<br />EOIMJFZO</p>
                                </div>
                                <div className="col-entreprise">
                                    <img src={img1} />
                                    <p className="gras">Entreprise</p>
                                </div>
                                <div className="col-individu">
                                    <img src={img2} />
                                    <p className="gras">Individu</p>
                                </div>
                                <div className="col-ville">
                                    <img src={img3} />
                                    <p className="gras">Ville / Région</p>
                                </div>
                            </div> */}
                        </li>
                    </div>

                    <div className="container-communaute">
                        <li className="nav_item">
                            <a href="/forums" className="nav_links">Communauté</a>
                            {/* <div className="sub_menu">
                                <div className="col-image-petite">
                                    <img id="img-petite" src={imgLittle} />
                                </div>
                                <div className="col-about">
                                    <h4>Communauté</h4>
                                    <p id="para-petit">fzefhfifnfjfqljfmOJF<br />EOIMJFZO</p>
                                </div>
                                <div className="col-entreprise">
                                    <img src={img1} />
                                    <p className="gras">Entreprise</p>
                                </div>
                                <div className="col-individu">
                                    <img src={img2} />
                                    <p className="gras">Individu</p>
                                </div>
                                <div className="col-ville">
                                    <img src={img3} />
                                    <p className="gras">Ville / Région</p>
                                </div>
                            </div> */}
                        </li>
                    </div>

                    <div className="container-shop">
                        <li className="nav_item">
                            <a href="/shop/products" className="nav_links">Shop</a>
                        </li>
                    </div>

                    <div className="container-search">
                        <li className="nav_item">
                            <Link to="/" className="nav_links">
                                <i className="fas fa-search"></i>
                            </Link>
                            {/* <div className="sub_menu search">

                                <div className="col-image-petite">
                                    <img id="img-petite" src={imgOeil} />

                                </div>

                                <div className="col-about">
                                    <h4>Recherche</h4>
                                    <p id="para-petit">fzefhfifnfjfqljfmOJF<br />EOIMJFZO</p>
                                    <Search />
                                </div>

                            </div> */}

                        </li>
                    </div>

                    <div className="container-login">
                        <li className="nav_item">
                            <a href="/login" className="nav_links">log in</a>
                            {/* <div className="sub_menu">
                                <div className="col-image-petite">
                                    <img id="img-petite" src={imgPetite} />
                                </div>
                                <div className="titre-login">
                                    <h4>Log in</h4>
                                </div>
                                <form className="form-container">
                                    <div className="field-top">
                                        <div className="label-email">
                                            email
                                        </div>
                                        <input type="text" className="input-email" />
                                    </div>
                                    <div className="field-top">
                                        <div className="label-mdp">
                                            Mot de passe
                                        </div>
                                        <input type="text" className="input-mdp" />
                                    </div>
                                    <div className="field-btn">
                                        <button className="btn-login">Valider</button>
                                    </div>
                                </form>
                                <div className="image_login">
                                    <img id="img-login" src={imgLogin} />
                                </div>
                            </div> */}
                        </li>
                    </div>

                    {/* <div className="container-fr">
                        <li className="nav_item">
                            <Link to="/" className="nav_links">FR</Link>
                        </li>
                    </div> */}

                </ul>
            </nav>
        )
    }

}

export default Nav
