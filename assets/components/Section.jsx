import React, { Component } from 'react'
import Home from './section/Home'
import About from './section/About'
import Actualite from './section/Actualite'
import Communaute from './section/Communaute'
import Nouveaute from './section/Nouveaute'
import Service from './section/Service'
import Shop from './section/Shop'
import { Route } from 'react-router-dom'



export class Section extends Component {
    render() {
        return (

            <section>
                <Route path='/b' component={Home} exact />
                <Route path='/a' component={About} />
                <Route path='/a' component={Actualite} />
                <Route path='/a' component={Communaute} />
                <Route path='/a' component={Nouveaute} />
                <Route path='/a' component={Service} />
                <Route path='/a' component={Shop} />
            </section>
        )
    }
}

export default Section
