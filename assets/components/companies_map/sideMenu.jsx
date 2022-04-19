import React, {useCallback, useState} from 'react';


class Category extends React.Component {


    render(){
        return <div className="categorie" onClick={this.props.customClickEvent}>
            <img src={`/images/Icones_Categories/${this.props.name}/${this.props.name}.png`} alt={this.props.name}/>
            <p>{this.props.name}</p>
        </div>

    }

}

function CompanyDetail({company,idx,userLocation}) {

    const [state, setState] = useState({
        click: false,
    })

    const calculateDistance = (userLat, userLng, companyLat, companyLng) => {
        var p = 0.017453292519943295;    // Math.PI / 180
        var c = Math.cos;
        var a = 0.5 - c((companyLat - userLat) * p)/2 +
            c(userLat * p) * c(companyLat * p) *
            (1 - c((companyLng - userLng) * p))/2;

        var d = Math.round( 12742 * Math.asin(Math.sqrt(a) ) * 10) / 10; // 2 * R; R = 6371 km
        console.log(12742 * Math.asin(Math.sqrt(a)))
        return d
    }

    const handleClick = useCallback(() => {
        let click = state.click ? false : true
        setState({click:click})
    })

    return <div className="companyContent">
        <div className="companyTitle" key={idx} onClick={handleClick}>
            <div className="iconName">
                <span className="puce"></span>
                <img src="/images/Subcategory/position.png" alt="icone position GPS"/>
                <h4>{company.name}</h4>
            </div>
            <p>{calculateDistance(userLocation.lat, userLocation.lng, company.latitude, company.longtitude)} km</p>
        </div>
        {state.click && <div className="companyDetail">
            <p className="pBorder">{company.address}</p>
            <p className="pBorder">{company.phone}</p>
            <p className="pBorder">{company.urlwebsite}</p>
            <div className="yAller">
                <p>Y aller</p>
                <div className="imgYAller">
                    <img src="/images/Subcategory/pieton.png" alt="pieton"/>
                    <img src="/images/Subcategory/velo.png" alt="velo"/>
                    <img src="/images/Subcategory/voiture.png" alt="voiture"/>
                </div>
            </div>
            <p className="pBorder pointer">Calculer votre empreinte écologique</p>
        </div>}
    </div>

}

function SubCategoryDetail(props) {

    return <div className="subcatDetail">
        <div className="subcatElement clicked">
            {props.name}
        </div>
        <div className="companyList">
            {props.companies.map((company,idx) => {
                return <CompanyDetail company={company} idx={idx} userLocation={props.userLocation}/>
            })}
        </div>
    </div>

}

function SubCategoryMenu(props) {

    const [state, setState] = useState({
        companies: [],
        click: false,
        name:''
    })

    const getCompanies = useCallback((id,catId) => {
        fetch(`/rest/category/${catId}/subcategory/${id}/companies`, {
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
            setState(s => (
                {...s, companies: data})
            )
        });
    }, [])

    const handleClick = useCallback((id, name) => {
        //console.log(id)
        getCompanies(id, props.catId)
        setState(s => ({...s, click: true, name: name}))
    },[])

    const retour = useCallback(() => {
        setState(s => ({...s, click: false}))
    })


    return <div className="subcategory_menu">
        {!state.click && <p className="pointer" onClick={props.onClick}> &lt; liste des catégories</p>}
        {state.click && <p className="pointer" onClick={retour}> &lt; {props.name}</p>}
        <div className="menu_title">
            <img src={`/images/Icones_Categories/${props.name}/${props.name}.png`} alt={props.name}/>
            <h3>{props.name}</h3>
        </div>
        <div className="subcats">
            {!state.click && props.subcats.map(subcat => {
                return <div className="subcatElement" key={subcat.id} onClick={() => handleClick(subcat.id, subcat.name)}>
                        {subcat.name}
                    </div>

            })}
        </div>
        {state.click && <SubCategoryDetail name={state.name} companies={state.companies} userLocation={props.userLocation}/>}

    </div>
}

export class SideMenu extends React.Component {


    constructor(props){
        super(props)
        this.state = {
            dataCategories:[],
        }

        this.getCategories = this.getCategories.bind(this)
        this.handleClick = this.handleClick.bind(this)
    }

    getCategories() {
        this.setState({
            dataCategories:[]
        });
        fetch('/get-categories/', {
            method: "get",
            header: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            credentials: 'same-origin'

        }).then(response => {
            return response.json()
        }).then(data => {
            this.setState({
                    dataCategories: data
                }
            )
        });
    }

    componentDidMount() {
        this.getCategories()
    }

    handleClick(id, name, subcat) {
        this.setState(
            {
                id: id,
                name: name,
                subcat: subcat,
                displaySubCats: true
            }
        )


        this.props.setParams({
            categories: [id]
        }, () => {
            this.props.filter(this.props.data,this.props.criterias, this.props.params)
        })

    }

    render(){
        if(!this.state.displaySubCats) {

            return (this.state.dataCategories.map( category => {
                return <Category id={category.id} name={category.name} key={category.id}
                                 customClickEvent={() => this.handleClick(category.id, category.name, category.subcategories)}/>
                })
            )
        }
        return (this.state.displaySubCats && <SubCategoryMenu catId={this.state.id} name={this.state.name} subcats={this.state.subcat} onClick={() => {this.props.init(); this.setState({displaySubCats: false})}} key={this.state.id} userLocation={this.props.userLocation}/>)
    }

}



