import React from "react";
import './../../node_modules/bootstrap/dist/css/bootstrap.min.css';
import ReactDOM from "react-dom";
import {
    BrowserRouter as Router,

} from "react-router-dom";

import NavBarreBlanche from "../components/header/NavBarreBlanche";
import NavResponsive from "../components/header/NavResponsive";
const divUserRoleData = document.getElementById('navRoot');



class NavController extends React.Component {
    render() {
        
        return (
            <Router>
                <NavBarreBlanche toto={divUserRoleData.dataset}/>
                <NavResponsive toto={divUserRoleData.dataset}/>
            </Router>
        );
    }
}

export default NavController

const navRoot = document.getElementById('navRoot');
ReactDOM.render(<NavBarreBlanche />, navRoot);

const navResponsiveRoot = document.getElementById('navResponsiveRoot');
ReactDOM.render(<NavResponsive />, navResponsiveRoot);

