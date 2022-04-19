import React from "react";
import './../../node_modules/bootstrap/dist/css/bootstrap.min.css';
import ReactDOM from "react-dom";
import {
    BrowserRouter as Router,

} from "react-router-dom";

import Section from '../components/Section';

import Nav from "../components/header/Nav";




class App extends React.Component {
    render() {
        return (
            <Router>
                <Nav />
                <Section />
            </Router>
        );
    }
}

const root = document.querySelector('#root');
ReactDOM.render(<App />, root);

