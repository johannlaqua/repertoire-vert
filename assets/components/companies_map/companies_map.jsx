import React from 'react';
import ReactDOM from 'react-dom';
import {SideMenu} from "./sideMenu";
import '/assets/styles/company_map.scss';

let arrayMarkers = [];
let arrayInitMarkers = [];
let markersLayer;
let arrayParam = [];
let arrayCritere = ['categories'];

class MapPage extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            dataCompanies: [],
            criterias: ['categories'],
            param: [],
            userLocation:[]
        }


        this.initMap = this.initMap.bind(this)
        this.getCompaniesOnMap = this.getCompaniesOnMap.bind(this)
        this.filtrage = this.filtrage.bind(this)
        this.filterShowCompanies = this.filterShowCompanies.bind(this)
        this.placeInitMarkers = this.placeInitMarkers.bind(this)
        this.getUserLocation = this.getUserLocation.bind(this)
    }

    getCompaniesOnMap(){
        this.setState({
            dataCompanies:[]
        });
        fetch('/rest/company', {
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
                    dataCompanies: data
                }
            )
            //console.log('oui')
            this.placeInitMarkers()
            console.log(this.state.dataCompanies)

        });
    }




    reinitMap(){
        arrayMarkers = [];

        arrayInitMarkers.forEach(marker => {
            markersLayer.removeLayer(marker);
            markersLayer.addLayer(marker);
            arrayMarkers.push(marker);
        })

        console.log(arrayMarkers)
    }

    placeInitMarkers(){

        this.state.dataCompanies.forEach((company, i) => {
            var marker = L.marker([ company.latitude, company.longtitude ]);
            marker.bindPopup("<b>" + company.name + "</b>").openPopup();
            markersLayer.addLayer(marker);
            arrayMarkers.push(marker);
            arrayInitMarkers.push(marker);
        })
        console.log(arrayMarkers)
    }

    getUserLocation(e) {

        this.setState({
            userLocation: e.latlng
        })
    }

    initMap() {

        var mymap = new L.Map('map', {zoom: 11, center: new L.latLng(46.1974025,6.1350715) });	//set center from first location

        mymap.addLayer(new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'));	//base layer
        markersLayer = new L.LayerGroup();	//layer contain searched elements

        mymap.addLayer(markersLayer);

        var controlSearch = new L.Control.Search({
            position:'topright',
            layer: markersLayer,
            initial: false,
            zoom: 12,
            marker: false
        });

        mymap.addControl( controlSearch );
        mymap.locate();

        mymap.on('locationfound', this.getUserLocation);
    }


    filtrage(list, arrayCritere, arrayParameter){

        //Déclaration de la liste des éléments filtrés
        let newList = [];

        let respectCriteres;
        let respectParams;

        //Pour chaque élément à filtrer
        list.forEach(elem => {

            respectCriteres = true;

            //On parcourt chaque critère de filtrage (par exemple "categories")
            arrayCritere.forEach(critere => {

                //On parcourt chaque paramètre (=valeur) de ce critère, par exemple "administration"
                arrayParameter[critere].forEach(filterParam => {

                    respectParams = false;

                    //On parcourt chaque paramètre du critère de l'élément à filtrer
                    elem[critere].forEach(elemParam => {

                        //si l'élément possède une valeur correspondant au paramètre de filtre, il respecte le paramètre
                        if(elemParam.id === filterParam){
                            respectParams = true;
                        }
                    })

                })
                if(!respectParams){
                    respectCriteres = false;
                }
            })
            if(respectCriteres){
                newList = [...newList, elem];
                            }
        })
        return newList;
    }

    filterShowCompanies(data, arrayCritere, arrayParameter){

        const filteredData = this.filtrage(data,arrayCritere,arrayParameter);

        let markersToShow = []

        //On parcourt chaque marker de la carte
        arrayMarkers.forEach((marker, idx) => {

            let markerToShow = false;

            // on récupère le nom de l'entreprise ecrite sur le popup
            let popupContent = marker.getPopup().getContent()

            // On parcourt chaque élément devant etre affiché
            filteredData.forEach((company) =>{

                // Si le marqueur et l'entreprise filtrée ont les memes coordonnées GPS et le meme nom, on garde le marqueur
                if(company.latitude === marker.getLatLng().lat && company.longtitude === marker.getLatLng().lng && popupContent.includes(company.name)){
                    markerToShow = true;
                    markersToShow.push(marker)
                }
            })
            //sinon on le supprime
            if(!markerToShow){
                markersLayer.removeLayer(marker);
            }
        })
        // On met à jour le tableau de marqueurs pour les potentiels prochains filtrages => Toujours s'appuyer sur arrayMarkers pour filtrer les marqueurs
        arrayMarkers = markersToShow

        console.log(arrayMarkers)
    }

    componentDidMount() {

        this.initMap()
        this.getCompaniesOnMap()

    }


    render() {

        return <>
            <div className="filter-bar"></div>
            <div className="map-content">
                <div id="sidemenu">
                    <SideMenu data={this.state.dataCompanies}
                              criterias={this.state.criterias}
                              setParams={(newParam, callback) => this.setState({
                                param: newParam
                              }, callback)}
                              params={this.state.param}
                              filter={this.filterShowCompanies}
                              init={this.reinitMap}
                              userLocation={this.state.userLocation}/>
                </div>

                <div id="map"></div>
            </div>
        </>
    }
}













ReactDOM.render(<MapPage />, document.getElementById('wrap-map'));




