(self["webpackChunk"] = self["webpackChunk"] || []).push([["companies_map"],{

/***/ "./assets/components/companies_map/companies_map.jsx":
/*!***********************************************************!*\
  !*** ./assets/components/companies_map/companies_map.jsx ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.function.bind.js */ "./node_modules/core-js/modules/es.function.bind.js");
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.promise.js */ "./node_modules/core-js/modules/es.promise.js");
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.array.concat.js */ "./node_modules/core-js/modules/es.array.concat.js");
/* harmony import */ var core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_array_includes_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.array.includes.js */ "./node_modules/core-js/modules/es.array.includes.js");
/* harmony import */ var core_js_modules_es_array_includes_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_includes_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_string_includes_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.string.includes.js */ "./node_modules/core-js/modules/es.string.includes.js");
/* harmony import */ var core_js_modules_es_string_includes_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_includes_js__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of.js */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of.js */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/es.reflect.construct.js */ "./node_modules/core-js/modules/es.reflect.construct.js");
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! core-js/modules/es.object.create.js */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! core-js/modules/es.object.define-property.js */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var core_js_modules_es_array_is_array_js__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! core-js/modules/es.array.is-array.js */ "./node_modules/core-js/modules/es.array.is-array.js");
/* harmony import */ var core_js_modules_es_array_is_array_js__WEBPACK_IMPORTED_MODULE_14___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_is_array_js__WEBPACK_IMPORTED_MODULE_14__);
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_15___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_15__);
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_16___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_16__);
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_17___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_17__);
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_18___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_18__);
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_19___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_19__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_20___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_20__);
/* harmony import */ var core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! core-js/modules/es.array.from.js */ "./node_modules/core-js/modules/es.array.from.js");
/* harmony import */ var core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_21___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_21__);
/* harmony import */ var core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(/*! core-js/modules/es.array.slice.js */ "./node_modules/core-js/modules/es.array.slice.js");
/* harmony import */ var core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_22___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_22__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var _sideMenu__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(/*! ./sideMenu */ "./assets/components/companies_map/sideMenu.jsx");
/* harmony import */ var _assets_styles_company_map_scss__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(/*! ../../../../assets/styles/company_map.scss */ "./assets/styles/company_map.scss");
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

























function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }





var arrayMarkers = [];
var arrayInitMarkers = [];
var markersLayer;
var arrayParam = [];
var arrayCritere = ['categories'];

var MapPage = /*#__PURE__*/function (_React$Component) {
  _inherits(MapPage, _React$Component);

  var _super = _createSuper(MapPage);

  function MapPage(props) {
    var _this;

    _classCallCheck(this, MapPage);

    _this = _super.call(this, props);
    _this.state = {
      dataCompanies: [],
      criterias: ['categories'],
      param: [],
      userLocation: []
    };
    _this.initMap = _this.initMap.bind(_assertThisInitialized(_this));
    _this.getCompaniesOnMap = _this.getCompaniesOnMap.bind(_assertThisInitialized(_this));
    _this.filtrage = _this.filtrage.bind(_assertThisInitialized(_this));
    _this.filterShowCompanies = _this.filterShowCompanies.bind(_assertThisInitialized(_this));
    _this.placeInitMarkers = _this.placeInitMarkers.bind(_assertThisInitialized(_this));
    _this.getUserLocation = _this.getUserLocation.bind(_assertThisInitialized(_this));
    return _this;
  }

  _createClass(MapPage, [{
    key: "getCompaniesOnMap",
    value: function getCompaniesOnMap() {
      var _this2 = this;

      this.setState({
        dataCompanies: []
      });
      fetch('/rest/company', {
        method: "get",
        header: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        credentials: 'same-origin'
      }).then(function (response) {
        return response.json();
      }).then(function (data) {
        _this2.setState({
          dataCompanies: data
        }); //console.log('oui')


        _this2.placeInitMarkers();

        console.log(_this2.state.dataCompanies);
      });
    }
  }, {
    key: "reinitMap",
    value: function reinitMap() {
      arrayMarkers = [];
      arrayInitMarkers.forEach(function (marker) {
        markersLayer.removeLayer(marker);
        markersLayer.addLayer(marker);
        arrayMarkers.push(marker);
      });
      console.log(arrayMarkers);
    }
  }, {
    key: "placeInitMarkers",
    value: function placeInitMarkers() {
      this.state.dataCompanies.forEach(function (company, i) {
        var marker = L.marker([company.latitude, company.longtitude]);
        marker.bindPopup("<b>" + company.name + "</b>").openPopup();
        markersLayer.addLayer(marker);
        arrayMarkers.push(marker);
        arrayInitMarkers.push(marker);
      });
      console.log(arrayMarkers);
    }
  }, {
    key: "getUserLocation",
    value: function getUserLocation(e) {
      this.setState({
        userLocation: e.latlng
      });
    }
  }, {
    key: "initMap",
    value: function initMap() {
      var mymap = new L.Map('map', {
        zoom: 11,
        center: new L.latLng(46.1974025, 6.1350715)
      }); //set center from first location

      mymap.addLayer(new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')); //base layer

      markersLayer = new L.LayerGroup(); //layer contain searched elements

      mymap.addLayer(markersLayer);
      var controlSearch = new L.Control.Search({
        position: 'topright',
        layer: markersLayer,
        initial: false,
        zoom: 12,
        marker: false
      });
      mymap.addControl(controlSearch);
      mymap.locate();
      mymap.on('locationfound', this.getUserLocation);
    }
  }, {
    key: "filtrage",
    value: function filtrage(list, arrayCritere, arrayParameter) {
      //Déclaration de la liste des éléments filtrés
      var newList = [];
      var respectCriteres;
      var respectParams; //Pour chaque élément à filtrer

      list.forEach(function (elem) {
        respectCriteres = true; //On parcourt chaque critère de filtrage (par exemple "categories")

        arrayCritere.forEach(function (critere) {
          //On parcourt chaque paramètre (=valeur) de ce critère, par exemple "administration"
          arrayParameter[critere].forEach(function (filterParam) {
            respectParams = false; //On parcourt chaque paramètre du critère de l'élément à filtrer

            elem[critere].forEach(function (elemParam) {
              //si l'élément possède une valeur correspondant au paramètre de filtre, il respecte le paramètre
              if (elemParam.id === filterParam) {
                respectParams = true;
              }
            });
          });

          if (!respectParams) {
            respectCriteres = false;
          }
        });

        if (respectCriteres) {
          newList = [].concat(_toConsumableArray(newList), [elem]);
        }
      });
      return newList;
    }
  }, {
    key: "filterShowCompanies",
    value: function filterShowCompanies(data, arrayCritere, arrayParameter) {
      var filteredData = this.filtrage(data, arrayCritere, arrayParameter);
      var markersToShow = []; //On parcourt chaque marker de la carte

      arrayMarkers.forEach(function (marker, idx) {
        var markerToShow = false; // on récupère le nom de l'entreprise ecrite sur le popup

        var popupContent = marker.getPopup().getContent(); // On parcourt chaque élément devant etre affiché

        filteredData.forEach(function (company) {
          // Si le marqueur et l'entreprise filtrée ont les memes coordonnées GPS et le meme nom, on garde le marqueur
          if (company.latitude === marker.getLatLng().lat && company.longtitude === marker.getLatLng().lng && popupContent.includes(company.name)) {
            markerToShow = true;
            markersToShow.push(marker);
          }
        }); //sinon on le supprime

        if (!markerToShow) {
          markersLayer.removeLayer(marker);
        }
      }); // On met à jour le tableau de marqueurs pour les potentiels prochains filtrages => Toujours s'appuyer sur arrayMarkers pour filtrer les marqueurs

      arrayMarkers = markersToShow;
      console.log(arrayMarkers);
    }
  }, {
    key: "componentDidMount",
    value: function componentDidMount() {
      this.initMap();
      this.getCompaniesOnMap();
    }
  }, {
    key: "render",
    value: function render() {
      var _this3 = this;

      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_23__.createElement(react__WEBPACK_IMPORTED_MODULE_23__.Fragment, null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_23__.createElement("div", {
        className: "filter-bar"
      }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_23__.createElement("div", {
        className: "map-content"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_23__.createElement("div", {
        id: "sidemenu"
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_23__.createElement(_sideMenu__WEBPACK_IMPORTED_MODULE_25__.SideMenu, {
        data: this.state.dataCompanies,
        criterias: this.state.criterias,
        setParams: function setParams(newParam, callback) {
          return _this3.setState({
            param: newParam
          }, callback);
        },
        params: this.state.param,
        filter: this.filterShowCompanies,
        init: this.reinitMap,
        userLocation: this.state.userLocation
      })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_23__.createElement("div", {
        id: "map"
      })));
    }
  }]);

  return MapPage;
}(react__WEBPACK_IMPORTED_MODULE_23__.Component);

react_dom__WEBPACK_IMPORTED_MODULE_24__.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_23__.createElement(MapPage, null), document.getElementById('wrap-map'));

/***/ }),

/***/ "./assets/components/companies_map/sideMenu.jsx":
/*!******************************************************!*\
  !*** ./assets/components/companies_map/sideMenu.jsx ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "SideMenu": () => (/* binding */ SideMenu)
/* harmony export */ });
/* harmony import */ var core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.concat.js */ "./node_modules/core-js/modules/es.array.concat.js");
/* harmony import */ var core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of.js */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of.js */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_array_map_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.array.map.js */ "./node_modules/core-js/modules/es.array.map.js");
/* harmony import */ var core_js_modules_es_array_map_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_map_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.promise.js */ "./node_modules/core-js/modules/es.promise.js");
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.function.bind.js */ "./node_modules/core-js/modules/es.function.bind.js");
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_array_filter_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.array.filter.js */ "./node_modules/core-js/modules/es.array.filter.js");
/* harmony import */ var core_js_modules_es_array_filter_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_filter_js__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.reflect.construct.js */ "./node_modules/core-js/modules/es.reflect.construct.js");
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.object.create.js */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/es.object.define-property.js */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var core_js_modules_es_array_is_array_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! core-js/modules/es.array.is-array.js */ "./node_modules/core-js/modules/es.array.is-array.js");
/* harmony import */ var core_js_modules_es_array_is_array_js__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_is_array_js__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_14___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_14__);
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_15___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_15__);
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_16___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_16__);
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_17___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_17__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_18___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_18__);
/* harmony import */ var core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! core-js/modules/es.array.slice.js */ "./node_modules/core-js/modules/es.array.slice.js");
/* harmony import */ var core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_19___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_19__);
/* harmony import */ var core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! core-js/modules/es.array.from.js */ "./node_modules/core-js/modules/es.array.from.js");
/* harmony import */ var core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_20___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_20__);
/* harmony import */ var core_js_modules_es_object_keys_js__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! core-js/modules/es.object.keys.js */ "./node_modules/core-js/modules/es.object.keys.js");
/* harmony import */ var core_js_modules_es_object_keys_js__WEBPACK_IMPORTED_MODULE_21___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_keys_js__WEBPACK_IMPORTED_MODULE_21__);
/* harmony import */ var core_js_modules_es_object_get_own_property_descriptor_js__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(/*! core-js/modules/es.object.get-own-property-descriptor.js */ "./node_modules/core-js/modules/es.object.get-own-property-descriptor.js");
/* harmony import */ var core_js_modules_es_object_get_own_property_descriptor_js__WEBPACK_IMPORTED_MODULE_22___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_own_property_descriptor_js__WEBPACK_IMPORTED_MODULE_22__);
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_23___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_23__);
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_24___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_24__);
/* harmony import */ var core_js_modules_es_object_get_own_property_descriptors_js__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(/*! core-js/modules/es.object.get-own-property-descriptors.js */ "./node_modules/core-js/modules/es.object.get-own-property-descriptors.js");
/* harmony import */ var core_js_modules_es_object_get_own_property_descriptors_js__WEBPACK_IMPORTED_MODULE_25___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_own_property_descriptors_js__WEBPACK_IMPORTED_MODULE_25__);
/* harmony import */ var core_js_modules_es_object_define_properties_js__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(/*! core-js/modules/es.object.define-properties.js */ "./node_modules/core-js/modules/es.object.define-properties.js");
/* harmony import */ var core_js_modules_es_object_define_properties_js__WEBPACK_IMPORTED_MODULE_26___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_properties_js__WEBPACK_IMPORTED_MODULE_26__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_27__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) { symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); } keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }





























function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }



var Category = /*#__PURE__*/function (_React$Component) {
  _inherits(Category, _React$Component);

  var _super = _createSuper(Category);

  function Category() {
    _classCallCheck(this, Category);

    return _super.apply(this, arguments);
  }

  _createClass(Category, [{
    key: "render",
    value: function render() {
      return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("div", {
        className: "categorie",
        onClick: this.props.customClickEvent
      }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("img", {
        src: "/images/Icones_Categories/".concat(this.props.name, "/").concat(this.props.name, ".png"),
        alt: this.props.name
      }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("p", null, this.props.name));
    }
  }]);

  return Category;
}(react__WEBPACK_IMPORTED_MODULE_27__.Component);

function CompanyDetail(_ref) {
  var company = _ref.company,
      idx = _ref.idx,
      userLocation = _ref.userLocation;

  var _useState = (0,react__WEBPACK_IMPORTED_MODULE_27__.useState)({
    click: false
  }),
      _useState2 = _slicedToArray(_useState, 2),
      state = _useState2[0],
      setState = _useState2[1];

  var calculateDistance = function calculateDistance(userLat, userLng, companyLat, companyLng) {
    var p = 0.017453292519943295; // Math.PI / 180

    var c = Math.cos;
    var a = 0.5 - c((companyLat - userLat) * p) / 2 + c(userLat * p) * c(companyLat * p) * (1 - c((companyLng - userLng) * p)) / 2;
    var d = Math.round(12742 * Math.asin(Math.sqrt(a)) * 10) / 10; // 2 * R; R = 6371 km

    console.log(12742 * Math.asin(Math.sqrt(a)));
    return d;
  };

  var handleClick = (0,react__WEBPACK_IMPORTED_MODULE_27__.useCallback)(function () {
    var click = state.click ? false : true;
    setState({
      click: click
    });
  });
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("div", {
    className: "companyContent"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("div", {
    className: "companyTitle",
    key: idx,
    onClick: handleClick
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("div", {
    className: "iconName"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("span", {
    className: "puce"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("img", {
    src: "/images/Subcategory/position.png",
    alt: "icone position GPS"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("h4", null, company.name)), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("p", null, calculateDistance(userLocation.lat, userLocation.lng, company.latitude, company.longtitude), " km")), state.click && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("div", {
    className: "companyDetail"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("p", {
    className: "pBorder"
  }, company.address), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("p", {
    className: "pBorder"
  }, company.phone), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("p", {
    className: "pBorder"
  }, company.urlwebsite), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("div", {
    className: "yAller"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("p", null, "Y aller"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("div", {
    className: "imgYAller"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("img", {
    src: "/images/Subcategory/pieton.png",
    alt: "pieton"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("img", {
    src: "/images/Subcategory/velo.png",
    alt: "velo"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("img", {
    src: "/images/Subcategory/voiture.png",
    alt: "voiture"
  }))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("p", {
    className: "pBorder pointer"
  }, "Calculer votre empreinte \xE9cologique")));
}

function SubCategoryDetail(props) {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("div", {
    className: "subcatDetail"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("div", {
    className: "subcatElement clicked"
  }, props.name), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("div", {
    className: "companyList"
  }, props.companies.map(function (company, idx) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement(CompanyDetail, {
      company: company,
      idx: idx,
      userLocation: props.userLocation
    });
  })));
}

function SubCategoryMenu(props) {
  var _useState3 = (0,react__WEBPACK_IMPORTED_MODULE_27__.useState)({
    companies: [],
    click: false,
    name: ''
  }),
      _useState4 = _slicedToArray(_useState3, 2),
      state = _useState4[0],
      setState = _useState4[1];

  var getCompanies = (0,react__WEBPACK_IMPORTED_MODULE_27__.useCallback)(function (id, catId) {
    fetch("/rest/category/".concat(catId, "/subcategory/").concat(id, "/companies"), {
      method: "get",
      header: {
        "Content-Type": "application/json",
        "Accept": "application/json"
      },
      credentials: 'same-origin'
    }).then(function (response) {
      return response.json();
    }).then(function (data) {
      //console.log(data)
      setState(function (s) {
        return _objectSpread(_objectSpread({}, s), {}, {
          companies: data
        });
      });
    });
  }, []);
  var handleClick = (0,react__WEBPACK_IMPORTED_MODULE_27__.useCallback)(function (id, name) {
    //console.log(id)
    getCompanies(id, props.catId);
    setState(function (s) {
      return _objectSpread(_objectSpread({}, s), {}, {
        click: true,
        name: name
      });
    });
  }, []);
  var retour = (0,react__WEBPACK_IMPORTED_MODULE_27__.useCallback)(function () {
    setState(function (s) {
      return _objectSpread(_objectSpread({}, s), {}, {
        click: false
      });
    });
  });
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("div", {
    className: "subcategory_menu"
  }, !state.click && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("p", {
    className: "pointer",
    onClick: props.onClick
  }, " < liste des cat\xE9gories"), state.click && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("p", {
    className: "pointer",
    onClick: retour
  }, " < ", props.name), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("div", {
    className: "menu_title"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("img", {
    src: "/images/Icones_Categories/".concat(props.name, "/").concat(props.name, ".png"),
    alt: props.name
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("h3", null, props.name)), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("div", {
    className: "subcats"
  }, !state.click && props.subcats.map(function (subcat) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement("div", {
      className: "subcatElement",
      key: subcat.id,
      onClick: function onClick() {
        return handleClick(subcat.id, subcat.name);
      }
    }, subcat.name);
  })), state.click && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement(SubCategoryDetail, {
    name: state.name,
    companies: state.companies,
    userLocation: props.userLocation
  }));
}

var SideMenu = /*#__PURE__*/function (_React$Component2) {
  _inherits(SideMenu, _React$Component2);

  var _super2 = _createSuper(SideMenu);

  function SideMenu(props) {
    var _this;

    _classCallCheck(this, SideMenu);

    _this = _super2.call(this, props);
    _this.state = {
      dataCategories: []
    };
    _this.getCategories = _this.getCategories.bind(_assertThisInitialized(_this));
    _this.handleClick = _this.handleClick.bind(_assertThisInitialized(_this));
    return _this;
  }

  _createClass(SideMenu, [{
    key: "getCategories",
    value: function getCategories() {
      var _this2 = this;

      this.setState({
        dataCategories: []
      });
      fetch('/get-categories/', {
        method: "get",
        header: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        credentials: 'same-origin'
      }).then(function (response) {
        return response.json();
      }).then(function (data) {
        _this2.setState({
          dataCategories: data
        });
      });
    }
  }, {
    key: "componentDidMount",
    value: function componentDidMount() {
      this.getCategories();
    }
  }, {
    key: "handleClick",
    value: function handleClick(id, name, subcat) {
      var _this3 = this;

      this.setState({
        id: id,
        name: name,
        subcat: subcat,
        displaySubCats: true
      });
      this.props.setParams({
        categories: [id]
      }, function () {
        _this3.props.filter(_this3.props.data, _this3.props.criterias, _this3.props.params);
      });
    }
  }, {
    key: "render",
    value: function render() {
      var _this4 = this;

      if (!this.state.displaySubCats) {
        return this.state.dataCategories.map(function (category) {
          return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement(Category, {
            id: category.id,
            name: category.name,
            key: category.id,
            customClickEvent: function customClickEvent() {
              return _this4.handleClick(category.id, category.name, category.subcategories);
            }
          });
        });
      }

      return this.state.displaySubCats && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_27__.createElement(SubCategoryMenu, {
        catId: this.state.id,
        name: this.state.name,
        subcats: this.state.subcat,
        onClick: function onClick() {
          _this4.props.init();

          _this4.setState({
            displaySubCats: false
          });
        },
        key: this.state.id,
        userLocation: this.props.userLocation
      });
    }
  }]);

  return SideMenu;
}(react__WEBPACK_IMPORTED_MODULE_27__.Component);

/***/ }),

/***/ "./node_modules/core-js/internals/create-property.js":
/*!***********************************************************!*\
  !*** ./node_modules/core-js/internals/create-property.js ***!
  \***********************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";

var toPrimitive = __webpack_require__(/*! ../internals/to-primitive */ "./node_modules/core-js/internals/to-primitive.js");
var definePropertyModule = __webpack_require__(/*! ../internals/object-define-property */ "./node_modules/core-js/internals/object-define-property.js");
var createPropertyDescriptor = __webpack_require__(/*! ../internals/create-property-descriptor */ "./node_modules/core-js/internals/create-property-descriptor.js");

module.exports = function (object, key, value) {
  var propertyKey = toPrimitive(key);
  if (propertyKey in object) definePropertyModule.f(object, propertyKey, createPropertyDescriptor(0, value));
  else object[propertyKey] = value;
};


/***/ }),

/***/ "./node_modules/core-js/internals/is-regexp.js":
/*!*****************************************************!*\
  !*** ./node_modules/core-js/internals/is-regexp.js ***!
  \*****************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var isObject = __webpack_require__(/*! ../internals/is-object */ "./node_modules/core-js/internals/is-object.js");
var classof = __webpack_require__(/*! ../internals/classof-raw */ "./node_modules/core-js/internals/classof-raw.js");
var wellKnownSymbol = __webpack_require__(/*! ../internals/well-known-symbol */ "./node_modules/core-js/internals/well-known-symbol.js");

var MATCH = wellKnownSymbol('match');

// `IsRegExp` abstract operation
// https://tc39.es/ecma262/#sec-isregexp
module.exports = function (it) {
  var isRegExp;
  return isObject(it) && ((isRegExp = it[MATCH]) !== undefined ? !!isRegExp : classof(it) == 'RegExp');
};


/***/ }),

/***/ "./node_modules/core-js/internals/set-species.js":
/*!*******************************************************!*\
  !*** ./node_modules/core-js/internals/set-species.js ***!
  \*******************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";

var getBuiltIn = __webpack_require__(/*! ../internals/get-built-in */ "./node_modules/core-js/internals/get-built-in.js");
var definePropertyModule = __webpack_require__(/*! ../internals/object-define-property */ "./node_modules/core-js/internals/object-define-property.js");
var wellKnownSymbol = __webpack_require__(/*! ../internals/well-known-symbol */ "./node_modules/core-js/internals/well-known-symbol.js");
var DESCRIPTORS = __webpack_require__(/*! ../internals/descriptors */ "./node_modules/core-js/internals/descriptors.js");

var SPECIES = wellKnownSymbol('species');

module.exports = function (CONSTRUCTOR_NAME) {
  var Constructor = getBuiltIn(CONSTRUCTOR_NAME);
  var defineProperty = definePropertyModule.f;

  if (DESCRIPTORS && Constructor && !Constructor[SPECIES]) {
    defineProperty(Constructor, SPECIES, {
      configurable: true,
      get: function () { return this; }
    });
  }
};


/***/ }),

/***/ "./node_modules/core-js/modules/es.array.concat.js":
/*!*********************************************************!*\
  !*** ./node_modules/core-js/modules/es.array.concat.js ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

"use strict";

var $ = __webpack_require__(/*! ../internals/export */ "./node_modules/core-js/internals/export.js");
var fails = __webpack_require__(/*! ../internals/fails */ "./node_modules/core-js/internals/fails.js");
var isArray = __webpack_require__(/*! ../internals/is-array */ "./node_modules/core-js/internals/is-array.js");
var isObject = __webpack_require__(/*! ../internals/is-object */ "./node_modules/core-js/internals/is-object.js");
var toObject = __webpack_require__(/*! ../internals/to-object */ "./node_modules/core-js/internals/to-object.js");
var toLength = __webpack_require__(/*! ../internals/to-length */ "./node_modules/core-js/internals/to-length.js");
var createProperty = __webpack_require__(/*! ../internals/create-property */ "./node_modules/core-js/internals/create-property.js");
var arraySpeciesCreate = __webpack_require__(/*! ../internals/array-species-create */ "./node_modules/core-js/internals/array-species-create.js");
var arrayMethodHasSpeciesSupport = __webpack_require__(/*! ../internals/array-method-has-species-support */ "./node_modules/core-js/internals/array-method-has-species-support.js");
var wellKnownSymbol = __webpack_require__(/*! ../internals/well-known-symbol */ "./node_modules/core-js/internals/well-known-symbol.js");
var V8_VERSION = __webpack_require__(/*! ../internals/engine-v8-version */ "./node_modules/core-js/internals/engine-v8-version.js");

var IS_CONCAT_SPREADABLE = wellKnownSymbol('isConcatSpreadable');
var MAX_SAFE_INTEGER = 0x1FFFFFFFFFFFFF;
var MAXIMUM_ALLOWED_INDEX_EXCEEDED = 'Maximum allowed index exceeded';

// We can't use this feature detection in V8 since it causes
// deoptimization and serious performance degradation
// https://github.com/zloirock/core-js/issues/679
var IS_CONCAT_SPREADABLE_SUPPORT = V8_VERSION >= 51 || !fails(function () {
  var array = [];
  array[IS_CONCAT_SPREADABLE] = false;
  return array.concat()[0] !== array;
});

var SPECIES_SUPPORT = arrayMethodHasSpeciesSupport('concat');

var isConcatSpreadable = function (O) {
  if (!isObject(O)) return false;
  var spreadable = O[IS_CONCAT_SPREADABLE];
  return spreadable !== undefined ? !!spreadable : isArray(O);
};

var FORCED = !IS_CONCAT_SPREADABLE_SUPPORT || !SPECIES_SUPPORT;

// `Array.prototype.concat` method
// https://tc39.es/ecma262/#sec-array.prototype.concat
// with adding support of @@isConcatSpreadable and @@species
$({ target: 'Array', proto: true, forced: FORCED }, {
  // eslint-disable-next-line no-unused-vars -- required for `.length`
  concat: function concat(arg) {
    var O = toObject(this);
    var A = arraySpeciesCreate(O, 0);
    var n = 0;
    var i, k, length, len, E;
    for (i = -1, length = arguments.length; i < length; i++) {
      E = i === -1 ? O : arguments[i];
      if (isConcatSpreadable(E)) {
        len = toLength(E.length);
        if (n + len > MAX_SAFE_INTEGER) throw TypeError(MAXIMUM_ALLOWED_INDEX_EXCEEDED);
        for (k = 0; k < len; k++, n++) if (k in E) createProperty(A, n, E[k]);
      } else {
        if (n >= MAX_SAFE_INTEGER) throw TypeError(MAXIMUM_ALLOWED_INDEX_EXCEEDED);
        createProperty(A, n++, E);
      }
    }
    A.length = n;
    return A;
  }
});


/***/ }),

/***/ "./node_modules/core-js/modules/es.function.bind.js":
/*!**********************************************************!*\
  !*** ./node_modules/core-js/modules/es.function.bind.js ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

var $ = __webpack_require__(/*! ../internals/export */ "./node_modules/core-js/internals/export.js");
var bind = __webpack_require__(/*! ../internals/function-bind */ "./node_modules/core-js/internals/function-bind.js");

// `Function.prototype.bind` method
// https://tc39.es/ecma262/#sec-function.prototype.bind
$({ target: 'Function', proto: true }, {
  bind: bind
});


/***/ }),

/***/ "./node_modules/core-js/modules/es.object.define-properties.js":
/*!*********************************************************************!*\
  !*** ./node_modules/core-js/modules/es.object.define-properties.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

var $ = __webpack_require__(/*! ../internals/export */ "./node_modules/core-js/internals/export.js");
var DESCRIPTORS = __webpack_require__(/*! ../internals/descriptors */ "./node_modules/core-js/internals/descriptors.js");
var defineProperties = __webpack_require__(/*! ../internals/object-define-properties */ "./node_modules/core-js/internals/object-define-properties.js");

// `Object.defineProperties` method
// https://tc39.es/ecma262/#sec-object.defineproperties
$({ target: 'Object', stat: true, forced: !DESCRIPTORS, sham: !DESCRIPTORS }, {
  defineProperties: defineProperties
});


/***/ }),

/***/ "./node_modules/core-js/modules/es.object.get-own-property-descriptor.js":
/*!*******************************************************************************!*\
  !*** ./node_modules/core-js/modules/es.object.get-own-property-descriptor.js ***!
  \*******************************************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

var $ = __webpack_require__(/*! ../internals/export */ "./node_modules/core-js/internals/export.js");
var fails = __webpack_require__(/*! ../internals/fails */ "./node_modules/core-js/internals/fails.js");
var toIndexedObject = __webpack_require__(/*! ../internals/to-indexed-object */ "./node_modules/core-js/internals/to-indexed-object.js");
var nativeGetOwnPropertyDescriptor = __webpack_require__(/*! ../internals/object-get-own-property-descriptor */ "./node_modules/core-js/internals/object-get-own-property-descriptor.js").f;
var DESCRIPTORS = __webpack_require__(/*! ../internals/descriptors */ "./node_modules/core-js/internals/descriptors.js");

var FAILS_ON_PRIMITIVES = fails(function () { nativeGetOwnPropertyDescriptor(1); });
var FORCED = !DESCRIPTORS || FAILS_ON_PRIMITIVES;

// `Object.getOwnPropertyDescriptor` method
// https://tc39.es/ecma262/#sec-object.getownpropertydescriptor
$({ target: 'Object', stat: true, forced: FORCED, sham: !DESCRIPTORS }, {
  getOwnPropertyDescriptor: function getOwnPropertyDescriptor(it, key) {
    return nativeGetOwnPropertyDescriptor(toIndexedObject(it), key);
  }
});


/***/ }),

/***/ "./node_modules/core-js/modules/es.object.get-own-property-descriptors.js":
/*!********************************************************************************!*\
  !*** ./node_modules/core-js/modules/es.object.get-own-property-descriptors.js ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

var $ = __webpack_require__(/*! ../internals/export */ "./node_modules/core-js/internals/export.js");
var DESCRIPTORS = __webpack_require__(/*! ../internals/descriptors */ "./node_modules/core-js/internals/descriptors.js");
var ownKeys = __webpack_require__(/*! ../internals/own-keys */ "./node_modules/core-js/internals/own-keys.js");
var toIndexedObject = __webpack_require__(/*! ../internals/to-indexed-object */ "./node_modules/core-js/internals/to-indexed-object.js");
var getOwnPropertyDescriptorModule = __webpack_require__(/*! ../internals/object-get-own-property-descriptor */ "./node_modules/core-js/internals/object-get-own-property-descriptor.js");
var createProperty = __webpack_require__(/*! ../internals/create-property */ "./node_modules/core-js/internals/create-property.js");

// `Object.getOwnPropertyDescriptors` method
// https://tc39.es/ecma262/#sec-object.getownpropertydescriptors
$({ target: 'Object', stat: true, sham: !DESCRIPTORS }, {
  getOwnPropertyDescriptors: function getOwnPropertyDescriptors(object) {
    var O = toIndexedObject(object);
    var getOwnPropertyDescriptor = getOwnPropertyDescriptorModule.f;
    var keys = ownKeys(O);
    var result = {};
    var index = 0;
    var key, descriptor;
    while (keys.length > index) {
      descriptor = getOwnPropertyDescriptor(O, key = keys[index++]);
      if (descriptor !== undefined) createProperty(result, key, descriptor);
    }
    return result;
  }
});


/***/ }),

/***/ "./assets/styles/company_map.scss":
/*!****************************************!*\
  !*** ./assets/styles/company_map.scss ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ "use strict";
/******/ 
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_internals_array-method-has-species-support_js-node_modules_core--0382ef","vendors-node_modules_core-js_modules_es_array_filter_js-node_modules_core-js_modules_es_array-8f29b7"], () => (__webpack_exec__("./assets/components/companies_map/companies_map.jsx")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY29tcG9uZW50cy9jb21wYW5pZXNfbWFwL2NvbXBhbmllc19tYXAuanN4Iiwid2VicGFjazovLy8uL2Fzc2V0cy9jb21wb25lbnRzL2NvbXBhbmllc19tYXAvc2lkZU1lbnUuanN4Iiwid2VicGFjazovLy8uL25vZGVfbW9kdWxlcy9jb3JlLWpzL2ludGVybmFscy9jcmVhdGUtcHJvcGVydHkuanMiLCJ3ZWJwYWNrOi8vLy4vbm9kZV9tb2R1bGVzL2NvcmUtanMvaW50ZXJuYWxzL2lzLXJlZ2V4cC5qcyIsIndlYnBhY2s6Ly8vLi9ub2RlX21vZHVsZXMvY29yZS1qcy9pbnRlcm5hbHMvc2V0LXNwZWNpZXMuanMiLCJ3ZWJwYWNrOi8vLy4vbm9kZV9tb2R1bGVzL2NvcmUtanMvbW9kdWxlcy9lcy5hcnJheS5jb25jYXQuanMiLCJ3ZWJwYWNrOi8vLy4vbm9kZV9tb2R1bGVzL2NvcmUtanMvbW9kdWxlcy9lcy5mdW5jdGlvbi5iaW5kLmpzIiwid2VicGFjazovLy8uL25vZGVfbW9kdWxlcy9jb3JlLWpzL21vZHVsZXMvZXMub2JqZWN0LmRlZmluZS1wcm9wZXJ0aWVzLmpzIiwid2VicGFjazovLy8uL25vZGVfbW9kdWxlcy9jb3JlLWpzL21vZHVsZXMvZXMub2JqZWN0LmdldC1vd24tcHJvcGVydHktZGVzY3JpcHRvci5qcyIsIndlYnBhY2s6Ly8vLi9ub2RlX21vZHVsZXMvY29yZS1qcy9tb2R1bGVzL2VzLm9iamVjdC5nZXQtb3duLXByb3BlcnR5LWRlc2NyaXB0b3JzLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zdHlsZXMvY29tcGFueV9tYXAuc2NzcyJdLCJuYW1lcyI6WyJhcnJheU1hcmtlcnMiLCJhcnJheUluaXRNYXJrZXJzIiwibWFya2Vyc0xheWVyIiwiYXJyYXlQYXJhbSIsImFycmF5Q3JpdGVyZSIsIk1hcFBhZ2UiLCJwcm9wcyIsInN0YXRlIiwiZGF0YUNvbXBhbmllcyIsImNyaXRlcmlhcyIsInBhcmFtIiwidXNlckxvY2F0aW9uIiwiaW5pdE1hcCIsImJpbmQiLCJnZXRDb21wYW5pZXNPbk1hcCIsImZpbHRyYWdlIiwiZmlsdGVyU2hvd0NvbXBhbmllcyIsInBsYWNlSW5pdE1hcmtlcnMiLCJnZXRVc2VyTG9jYXRpb24iLCJzZXRTdGF0ZSIsImZldGNoIiwibWV0aG9kIiwiaGVhZGVyIiwiY3JlZGVudGlhbHMiLCJ0aGVuIiwicmVzcG9uc2UiLCJqc29uIiwiZGF0YSIsImNvbnNvbGUiLCJsb2ciLCJmb3JFYWNoIiwibWFya2VyIiwicmVtb3ZlTGF5ZXIiLCJhZGRMYXllciIsInB1c2giLCJjb21wYW55IiwiaSIsIkwiLCJsYXRpdHVkZSIsImxvbmd0aXR1ZGUiLCJiaW5kUG9wdXAiLCJuYW1lIiwib3BlblBvcHVwIiwiZSIsImxhdGxuZyIsIm15bWFwIiwiTWFwIiwiem9vbSIsImNlbnRlciIsImxhdExuZyIsIlRpbGVMYXllciIsIkxheWVyR3JvdXAiLCJjb250cm9sU2VhcmNoIiwiQ29udHJvbCIsIlNlYXJjaCIsInBvc2l0aW9uIiwibGF5ZXIiLCJpbml0aWFsIiwiYWRkQ29udHJvbCIsImxvY2F0ZSIsIm9uIiwibGlzdCIsImFycmF5UGFyYW1ldGVyIiwibmV3TGlzdCIsInJlc3BlY3RDcml0ZXJlcyIsInJlc3BlY3RQYXJhbXMiLCJlbGVtIiwiY3JpdGVyZSIsImZpbHRlclBhcmFtIiwiZWxlbVBhcmFtIiwiaWQiLCJmaWx0ZXJlZERhdGEiLCJtYXJrZXJzVG9TaG93IiwiaWR4IiwibWFya2VyVG9TaG93IiwicG9wdXBDb250ZW50IiwiZ2V0UG9wdXAiLCJnZXRDb250ZW50IiwiZ2V0TGF0TG5nIiwibGF0IiwibG5nIiwiaW5jbHVkZXMiLCJuZXdQYXJhbSIsImNhbGxiYWNrIiwicmVpbml0TWFwIiwiUmVhY3QiLCJSZWFjdERPTSIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJDYXRlZ29yeSIsImN1c3RvbUNsaWNrRXZlbnQiLCJDb21wYW55RGV0YWlsIiwidXNlU3RhdGUiLCJjbGljayIsImNhbGN1bGF0ZURpc3RhbmNlIiwidXNlckxhdCIsInVzZXJMbmciLCJjb21wYW55TGF0IiwiY29tcGFueUxuZyIsInAiLCJjIiwiTWF0aCIsImNvcyIsImEiLCJkIiwicm91bmQiLCJhc2luIiwic3FydCIsImhhbmRsZUNsaWNrIiwidXNlQ2FsbGJhY2siLCJhZGRyZXNzIiwicGhvbmUiLCJ1cmx3ZWJzaXRlIiwiU3ViQ2F0ZWdvcnlEZXRhaWwiLCJjb21wYW5pZXMiLCJtYXAiLCJTdWJDYXRlZ29yeU1lbnUiLCJnZXRDb21wYW5pZXMiLCJjYXRJZCIsInMiLCJyZXRvdXIiLCJvbkNsaWNrIiwic3ViY2F0cyIsInN1YmNhdCIsIlNpZGVNZW51IiwiZGF0YUNhdGVnb3JpZXMiLCJnZXRDYXRlZ29yaWVzIiwiZGlzcGxheVN1YkNhdHMiLCJzZXRQYXJhbXMiLCJjYXRlZ29yaWVzIiwiZmlsdGVyIiwicGFyYW1zIiwiY2F0ZWdvcnkiLCJzdWJjYXRlZ29yaWVzIiwiaW5pdCJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBRUEsSUFBSUEsWUFBWSxHQUFHLEVBQW5CO0FBQ0EsSUFBSUMsZ0JBQWdCLEdBQUcsRUFBdkI7QUFDQSxJQUFJQyxZQUFKO0FBQ0EsSUFBSUMsVUFBVSxHQUFHLEVBQWpCO0FBQ0EsSUFBSUMsWUFBWSxHQUFHLENBQUMsWUFBRCxDQUFuQjs7SUFFTUMsTzs7Ozs7QUFFRixtQkFBWUMsS0FBWixFQUFtQjtBQUFBOztBQUFBOztBQUNmLDhCQUFNQSxLQUFOO0FBQ0EsVUFBS0MsS0FBTCxHQUFhO0FBQ1RDLG1CQUFhLEVBQUUsRUFETjtBQUVUQyxlQUFTLEVBQUUsQ0FBQyxZQUFELENBRkY7QUFHVEMsV0FBSyxFQUFFLEVBSEU7QUFJVEMsa0JBQVksRUFB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QUFRLG1CQUFPLENBQUMsdUVBQXFCO0FBQ3JDLFlBQVksbUJBQU8sQ0FBQyxxRUFBb0I7QUFDeEMsc0JBQXNCLG1CQUFPLENBQUMsNkZBQWdDO0FBQzlELHFDQUFxQyxzSkFBNEQ7QUFDakcsa0JBQWtCLG1CQUFPLENBQUMsaUZBQTBCOztBQUVwRCw2Q0FBNkMsbUNBQW1DLEVBQUU7QUFDbEY7O0FBRUE7QUFDQTtBQUNBLEdBQUcsbUVBQW1FO0FBQ3RFO0FBQ0E7QUFDQTtBQUNBLENBQUM7Ozs7Ozs7Ozs7O0FDZkQsUUFBUSxtQkFBTyxDQUFDLHVFQUFxQjtBQUNyQyxrQkFBa0IsbUJBQU8sQ0FBQyxpRkFBMEI7QUFDcEQsY0FBYyxtQkFBTyxDQUFDLDJFQUF1QjtBQUM3QyxzQkFBc0IsbUJBQU8sQ0FBQyw2RkFBZ0M7QUFDOUQscUNBQXFDLG1CQUFPLENBQUMsK0hBQWlEO0FBQzlGLHFCQUFxQixtQkFBTyxDQUFDLHlGQUE4Qjs7QUFFM0Q7QUFDQTtBQUNBLEdBQUcsbURBQW1EO0FBQ3REO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsQ0FBQzs7Ozs7Ozs7Ozs7OztBQ3ZCRCIsImZpbGUiOiJjb21wYW5pZXNfbWFwLmpzIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IFJlYWN0IGZyb20gJ3JlYWN0JztcbmltcG9ydCBSZWFjdERPTSBmcm9tICdyZWFjdC1kb20nO1xuaW1wb3J0IHtTaWRlTWVudX0gZnJvbSBcIi4vc2lkZU1lbnVcIjtcbmltcG9ydCAnL2Fzc2V0cy9zdHlsZXMvY29tcGFueV9tYXAuc2Nzcyc7XG5cbmxldCBhcnJheU1hcmtlcnMgPSBbXTtcbmxldCBhcnJheUluaXRNYXJrZXJzID0gW107XG5sZXQgbWFya2Vyc0xheWVyO1xubGV0IGFycmF5UGFyYW0gPSBbXTtcbmxldCBhcnJheUNyaXRlcmUgPSBbJ2NhdGVnb3JpZXMnXTtcblxuY2xhc3MgTWFwUGFnZSBleHRlbmRzIFJlYWN0LkNvbXBvbmVudCB7XG5cbiAgICBjb25zdHJ1Y3Rvcihwcm9wcykge1xuICAgICAgICBzdXBlcihwcm9wcyk7XG4gICAgICAgIHRoaXMuc3RhdGUgPSB7XG4gICAgICAgICAgICBkYXRhQ29tcGFuaWVzOiBbXSxcbiAgICAgICAgICAgIGNyaXRlcmlhczogWydjYXRlZ29yaWVzJ10sXG4gICAgICAgICAgICBwYXJhbTogW10sXG4gICAgICAgICAgICB1c2VyTG9jYXRpb246W11cbiAgICAgICAgfVxuXG5cbiAgICAgICAgdGhpcy5pbml0TWFwID0gdGhpcy5pbml0TWFwLmJpbmQodGhpcylcbiAgICAgICAgdGhpcy5nZXRDb21wYW5pZXNPbk1hcCA9IHRoaXMuZ2V0Q29tcGFuaWVzT25NYXAuYmluZCh0aGlzKVxuICAgICAgICB0aGlzLmZpbHRyYWdlID0gdGhpcy5maWx0cmFnZS5iaW5kKHRoaXMpXG4gICAgICAgIHRoaXMuZmlsdGVyU2hvd0NvbXBhbmllcyA9IHRoaXMuZmlsdGVyU2hvd0NvbXBhbmllcy5iaW5kKHRoaXMpXG4gICAgICAgIHRoaXMucGxhY2VJbml0TWFya2VycyA9IHRoaXMucGxhY2VJbml0TWFya2Vycy5iaW5kKHRoaXMpXG4gICAgICAgIHRoaXMuZ2V0VXNlckxvY2F0aW9uID0gdGhpcy5nZXRVc2VyTG9jYXRpb24uYmluZCh0aGlzKVxuICAgIH1cblxuICAgIGdldENvbXBhbmllc09uTWFwKCl7XG4gICAgICAgIHRoaXMuc2V0U3RhdGUoe1xuICAgICAgICAgICAgZGF0YUNvbXBhbmllczpbXVxuICAgICAgICB9KTtcbiAgICAgICAgZmV0Y2goJy9yZXN0L2NvbXBhbnknLCB7XG4gICAgICAgICAgICBtZXRob2Q6IFwiZ2V0XCIsXG4gICAgICAgICAgICBoZWFkZXI6IHtcbiAgICAgICAgICAgICAgICBcIkNvbnRlbnQtVHlwZVwiOiBcImFwcGxpY2F0aW9uL2pzb25cIixcbiAgICAgICAgICAgICAgICBcIkFjY2VwdFwiOiBcImFwcGxpY2F0aW9uL2pzb25cIlxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGNyZWRlbnRpYWxzOiAnc2FtZS1vcmlnaW4nXG5cbiAgICAgICAgfSkudGhlbihyZXNwb25zZSA9PiB7XG4gICAgICAgICAgICByZXR1cm4gcmVzcG9uc2UuanNvbigpXG4gICAgICAgIH0pLnRoZW4oZGF0YSA9PiB7XG4gICAgICAgICAgICB0aGlzLnNldFN0YXRlKHtcbiAgICAgICAgICAgICAgICAgICAgZGF0YUNvbXBhbmllczogZGF0YVxuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIClcbiAgICAgICAgICAgIC8vY29uc29sZS5sb2coJ291aScpXG4gICAgICAgICAgICB0aGlzLnBsYWNlSW5pdE1hcmtlcnMoKVxuICAgICAgICAgICAgY29uc29sZS5sb2codGhpcy5zdGF0ZS5kYXRhQ29tcGFuaWVzKVxuXG4gICAgICAgIH0pO1xuICAgIH1cblxuXG5cblxuICAgIHJlaW5pdE1hcCgpe1xuICAgICAgICBhcnJheU1hcmtlcnMgPSBbXTtcblxuICAgICAgICBhcnJheUluaXRNYXJrZXJzLmZvckVhY2gobWFya2VyID0+IHtcbiAgICAgICAgICAgIG1hcmtlcnNMYXllci5yZW1vdmVMYXllcihtYXJrZXIpO1xuICAgICAgICAgICAgbWFya2Vyc0xheWVyLmFkZExheWVyKG1hcmtlcik7XG4gICAgICAgICAgICBhcnJheU1hcmtlcnMucHVzaChtYXJrZXIpO1xuICAgICAgICB9KVxuXG4gICAgICAgIGNvbnNvbGUubG9nKGFycmF5TWFya2VycylcbiAgICB9XG5cbiAgICBwbGFjZUluaXRNYXJrZXJzKCl7XG5cbiAgICAgICAgdGhpcy5zdGF0ZS5kYXRhQ29tcGFuaWVzLmZvckVhY2goKGNvbXBhbnksIGkpID0+IHtcbiAgICAgICAgICAgIHZhciBtYXJrZXIgPSBMLm1hcmtlcihbIGNvbXBhbnkubGF0aXR1ZGUsIGNvbXBhbnkubG9uZ3RpdHVkZSBdKTtcbiAgICAgICAgICAgIG1hcmtlci5iaW5kUG9wdXAoXCI8Yj5cIiArIGNvbXBhbnkubmFtZSArIFwiPC9iPlwiKS5vcGVuUG9wdXAoKTtcbiAgICAgICAgICAgIG1hcmtlcnNMYXllci5hZGRMYXllcihtYXJrZXIpO1xuICAgICAgICAgICAgYXJyYXlNYXJrZXJzLnB1c2gobWFya2VyKTtcbiAgICAgICAgICAgIGFycmF5SW5pdE1hcmtlcnMucHVzaChtYXJrZXIpO1xuICAgICAgICB9KVxuICAgICAgICBjb25zb2xlLmxvZyhhcnJheU1hcmtlcnMpXG4gICAgfVxuXG4gICAgZ2V0VXNlckxvY2F0aW9uKGUpIHtcblxuICAgICAgICB0aGlzLnNldFN0YXRlKHtcbiAgICAgICAgICAgIHVzZXJMb2NhdGlvbjogZS5sYXRsbmdcbiAgICAgICAgfSlcbiAgICB9XG5cbiAgICBpbml0TWFwKCkge1xuXG4gICAgICAgIHZhciBteW1hcCA9IG5ldyBMLk1hcCgnbWFwJywge3pvb206IDExLCBjZW50ZXI6IG5ldyBMLmxhdExuZyg0Ni4xOTc0MDI1LDYuMTM1MDcxNSkgfSk7XHQvL3NldCBjZW50ZXIgZnJvbSBmaXJzdCBsb2NhdGlvblxuXG4gICAgICAgIG15bWFwLmFkZExheWVyKG5ldyBMLlRpbGVMYXllcignaHR0cDovL3tzfS50aWxlLm9wZW5zdHJlZXRtYXAub3JnL3t6fS97eH0ve3l9LnBuZycpKTtcdC8vYmFzZSBsYXllclxuICAgICAgICBtYXJrZXJzTGF5ZXIgPSBuZXcgTC5MYXllckdyb3VwKCk7XHQvL2xheWVyIGNvbnRhaW4gc2VhcmNoZWQgZWxlbWVudHNcblxuICAgICAgICBteW1hcC5hZGRMYXllcihtYXJrZXJzTGF5ZXIpO1xuXG4gICAgICAgIHZhciBjb250cm9sU2VhcmNoID0gbmV3IEwuQ29udHJvbC5TZWFyY2goe1xuICAgICAgICAgICAgcG9zaXRpb246J3RvcHJpZ2h0JyxcbiAgICAgICAgICAgIGxheWVyOiBtYXJrZXJzTGF5ZXIsXG4gICAgICAgICAgICBpbml0aWFsOiBmYWxzZSxcbiAgICAgICAgICAgIHpvb206IDEyLFxuICAgICAgICAgICAgbWFya2VyOiBmYWxzZVxuICAgICAgICB9KTtcblxuICAgICAgICBteW1hcC5hZGRDb250cm9sKCBjb250cm9sU2VhcmNoICk7XG4gICAgICAgIG15bWFwLmxvY2F0ZSgpO1xuXG4gICAgICAgIG15bWFwLm9uKCdsb2NhdGlvbmZvdW5kJywgdGhpcy5nZXRVc2VyTG9jYXRpb24pO1xuICAgIH1cblxuXG4gICAgZmlsdHJhZ2UobGlzdCwgYXJyYXlDcml0ZXJlLCBhcnJheVBhcmFtZXRlcil7XG5cbiAgICAgICAgLy9Ew6ljbGFyYXRpb24gZGUgbGEgbGlzdGUgZGVzIMOpbMOpbWVudHMgZmlsdHLDqXNcbiAgICAgICAgbGV0IG5ld0xpc3QgPSBbXTtcblxuICAgICAgICBsZXQgcmVzcGVjdENyaXRlcmVzO1xuICAgICAgICBsZXQgcmVzcGVjdFBhcmFtcztcblxuICAgICAgICAvL1BvdXIgY2hhcXVlIMOpbMOpbWVudCDDoCBmaWx0cmVyXG4gICAgICAgIGxpc3QuZm9yRWFjaChlbGVtID0+IHtcblxuICAgICAgICAgICAgcmVzcGVjdENyaXRlcmVzID0gdHJ1ZTtcblxuICAgICAgICAgICAgLy9PbiBwYXJjb3VydCBjaGFxdWUgY3JpdMOocmUgZGUgZmlsdHJhZ2UgKHBhciBleGVtcGxlIFwiY2F0ZWdvcmllc1wiKVxuICAgICAgICAgICAgYXJyYXlDcml0ZXJlLmZvckVhY2goY3JpdGVyZSA9PiB7XG5cbiAgICAgICAgICAgICAgICAvL09uIHBhcmNvdXJ0IGNoYXF1ZSBwYXJhbcOodHJlICg9dmFsZXVyKSBkZSBjZSBjcml0w6hyZSwgcGFyIGV4ZW1wbGUgXCJhZG1pbmlzdHJhdGlvblwiXG4gICAgICAgICAgICAgICAgYXJyYXlQYXJhbWV0ZXJbY3JpdGVyZV0uZm9yRWFjaChmaWx0ZXJQYXJhbSA9PiB7XG5cbiAgICAgICAgICAgICAgICAgICAgcmVzcGVjdFBhcmFtcyA9IGZhbHNlO1xuXG4gICAgICAgICAgICAgICAgICAgIC8vT24gcGFyY291cnQgY2hhcXVlIHBhcmFtw6h0cmUgZHUgY3JpdMOocmUgZGUgbCfDqWzDqW1lbnQgw6AgZmlsdHJlclxuICAgICAgICAgICAgICAgICAgICBlbGVtW2NyaXRlcmVdLmZvckVhY2goZWxlbVBhcmFtID0+IHtcblxuICAgICAgICAgICAgICAgICAgICAgICAgLy9zaSBsJ8OpbMOpbWVudCBwb3Nzw6hkZSB1bmUgdmFsZXVyIGNvcnJlc3BvbmRhbnQgYXUgcGFyYW3DqHRyZSBkZSBmaWx0cmUsIGlsIHJlc3BlY3RlIGxlIHBhcmFtw6h0cmVcbiAgICAgICAgICAgICAgICAgICAgICAgIGlmKGVsZW1QYXJhbS5pZCA9PT0gZmlsdGVyUGFyYW0pe1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHJlc3BlY3RQYXJhbXMgPSB0cnVlO1xuICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICB9KVxuXG4gICAgICAgICAgICAgICAgfSlcbiAgICAgICAgICAgICAgICBpZighcmVzcGVjdFBhcmFtcyl7XG4gICAgICAgICAgICAgICAgICAgIHJlc3BlY3RDcml0ZXJlcyA9IGZhbHNlO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pXG4gICAgICAgICAgICBpZihyZXNwZWN0Q3JpdGVyZXMpe1xuICAgICAgICAgICAgICAgIG5ld0xpc3QgPSBbLi4ubmV3TGlzdCwgZWxlbV07XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICB9KVxuICAgICAgICByZXR1cm4gbmV3TGlzdDtcbiAgICB9XG5cbiAgICBmaWx0ZXJTaG93Q29tcGFuaWVzKGRhdGEsIGFycmF5Q3JpdGVyZSwgYXJyYXlQYXJhbWV0ZXIpe1xuXG4gICAgICAgIGNvbnN0IGZpbHRlcmVkRGF0YSA9IHRoaXMuZmlsdHJhZ2UoZGF0YSxhcnJheUNyaXRlcmUsYXJyYXlQYXJhbWV0ZXIpO1xuXG4gICAgICAgIGxldCBtYXJrZXJzVG9TaG93ID0gW11cblxuICAgICAgICAvL09uIHBhcmNvdXJ0IGNoYXF1ZSBtYXJrZXIgZGUgbGEgY2FydGVcbiAgICAgICAgYXJyYXlNYXJrZXJzLmZvckVhY2goKG1hcmtlciwgaWR4KSA9PiB7XG5cbiAgICAgICAgICAgIGxldCBtYXJrZXJUb1Nob3cgPSBmYWxzZTtcblxuICAgICAgICAgICAgLy8gb24gcsOpY3Vww6hyZSBsZSBub20gZGUgbCdlbnRyZXByaXNlIGVjcml0ZSBzdXIgbGUgcG9wdXBcbiAgICAgICAgICAgIGxldCBwb3B1cENvbnRlbnQgPSBtYXJrZXIuZ2V0UG9wdXAoKS5nZXRDb250ZW50KClcblxuICAgICAgICAgICAgLy8gT24gcGFyY291cnQgY2hhcXVlIMOpbMOpbWVudCBkZXZhbnQgZXRyZSBhZmZpY2jDqVxuICAgICAgICAgICAgZmlsdGVyZWREYXRhLmZvckVhY2goKGNvbXBhbnkpID0+e1xuXG4gICAgICAgICAgICAgICAgLy8gU2kgbGUgbWFycXVldXIgZXQgbCdlbnRyZXByaXNlIGZpbHRyw6llIG9udCBsZXMgbWVtZXMgY29vcmRvbm7DqWVzIEdQUyBldCBsZSBtZW1lIG5vbSwgb24gZ2FyZGUgbGUgbWFycXVldXJcbiAgICAgICAgICAgICAgICBpZihjb21wYW55LmxhdGl0dWRlID09PSBtYXJrZXIuZ2V0TGF0TG5nKCkubGF0ICYmIGNvbXBhbnkubG9uZ3RpdHVkZSA9PT0gbWFya2VyLmdldExhdExuZygpLmxuZyAmJiBwb3B1cENvbnRlbnQuaW5jbHVkZXMoY29tcGFueS5uYW1lKSl7XG4gICAgICAgICAgICAgICAgICAgIG1hcmtlclRvU2hvdyA9IHRydWU7XG4gICAgICAgICAgICAgICAgICAgIG1hcmtlcnNUb1Nob3cucHVzaChtYXJrZXIpXG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSlcbiAgICAgICAgICAgIC8vc2lub24gb24gbGUgc3VwcHJpbWVcbiAgICAgICAgICAgIGlmKCFtYXJrZXJUb1Nob3cpe1xuICAgICAgICAgICAgICAgIG1hcmtlcnNMYXllci5yZW1vdmVMYXllcihtYXJrZXIpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KVxuICAgICAgICAvLyBPbiBtZXQgw6Agam91ciBsZSB0YWJsZWF1IGRlIG1hcnF1ZXVycyBwb3VyIGxlcyBwb3RlbnRpZWxzIHByb2NoYWlucyBmaWx0cmFnZXMgPT4gVG91am91cnMgcydhcHB1eWVyIHN1ciBhcnJheU1hcmtlcnMgcG91ciBmaWx0cmVyIGxlcyBtYXJxdWV1cnNcbiAgICAgICAgYXJyYXlNYXJrZXJzID0gbWFya2Vyc1RvU2hvd1xuXG4gICAgICAgIGNvbnNvbGUubG9nKGFycmF5TWFya2VycylcbiAgICB9XG5cbiAgICBjb21wb25lbnREaWRNb3VudCgpIHtcblxuICAgICAgICB0aGlzLmluaXRNYXAoKVxuICAgICAgICB0aGlzLmdldENvbXBhbmllc09uTWFwKClcblxuICAgIH1cblxuXG4gICAgcmVuZGVyKCkge1xuXG4gICAgICAgIHJldHVybiA8PlxuICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJmaWx0ZXItYmFyXCI+PC9kaXY+XG4gICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cIm1hcC1jb250ZW50XCI+XG4gICAgICAgICAgICAgICAgPGRpdiBpZD1cInNpZGVtZW51XCI+XG4gICAgICAgICAgICAgICAgICAgIDxTaWRlTWVudSBkYXRhPXt0aGlzLnN0YXRlLmRhdGFDb21wYW5pZXN9XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjcml0ZXJpYXM9e3RoaXMuc3RhdGUuY3JpdGVyaWFzfVxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgc2V0UGFyYW1zPXsobmV3UGFyYW0sIGNhbGxiYWNrKSA9PiB0aGlzLnNldFN0YXRlKHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgcGFyYW06IG5ld1BhcmFtXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9LCBjYWxsYmFjayl9XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICBwYXJhbXM9e3RoaXMuc3RhdGUucGFyYW19XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICBmaWx0ZXI9e3RoaXMuZmlsdGVyU2hvd0NvbXBhbmllc31cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGluaXQ9e3RoaXMucmVpbml0TWFwfVxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgdXNlckxvY2F0aW9uPXt0aGlzLnN0YXRlLnVzZXJMb2NhdGlvbn0vPlxuICAgICAgICAgICAgICAgIDwvZGl2PlxuXG4gICAgICAgICAgICAgICAgPGRpdiBpZD1cIm1hcFwiPjwvZGl2PlxuICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgIDwvPlxuICAgIH1cbn1cblxuXG5cblxuXG5cblxuXG5cblxuXG5cblxuUmVhY3RET00ucmVuZGVyKDxNYXBQYWdlIC8+LCBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnd3JhcC1tYXAnKSk7XG5cblxuXG5cbiIsImltcG9ydCBSZWFjdCwge3VzZUNhbGxiYWNrLCB1c2VTdGF0ZX0gZnJvbSAncmVhY3QnO1xuXG5cbmNsYXNzIENhdGVnb3J5IGV4dGVuZHMgUmVhY3QuQ29tcG9uZW50IHtcblxuXG4gICAgcmVuZGVyKCl7XG4gICAgICAgIHJldHVybiA8ZGl2IGNsYXNzTmFtZT1cImNhdGVnb3JpZVwiIG9uQ2xpY2s9e3RoaXMucHJvcHMuY3VzdG9tQ2xpY2tFdmVudH0+XG4gICAgICAgICAgICA8aW1nIHNyYz17YC9pbWFnZXMvSWNvbmVzX0NhdGVnb3JpZXMvJHt0aGlzLnByb3BzLm5hbWV9LyR7dGhpcy5wcm9wcy5uYW1lfS5wbmdgfSBhbHQ9e3RoaXMucHJvcHMubmFtZX0vPlxuICAgICAgICAgICAgPHA+e3RoaXMucHJvcHMubmFtZX08L3A+XG4gICAgICAgIDwvZGl2PlxuXG4gICAgfVxuXG59XG5cbmZ1bmN0aW9uIENvbXBhbnlEZXRhaWwoe2NvbXBhbnksaWR4LHVzZXJMb2NhdGlvbn0pIHtcblxuICAgIGNvbnN0IFtzdGF0ZSwgc2V0U3RhdGVdID0gdXNlU3RhdGUoe1xuICAgICAgICBjbGljazogZmFsc2UsXG4gICAgfSlcblxuICAgIGNvbnN0IGNhbGN1bGF0ZURpc3RhbmNlID0gKHVzZXJMYXQsIHVzZXJMbmcsIGNvbXBhbnlMYXQsIGNvbXBhbnlMbmcpID0+IHtcbiAgICAgICAgdmFyIHAgPSAwLjAxNzQ1MzI5MjUxOTk0MzI5NTsgICAgLy8gTWF0aC5QSSAvIDE4MFxuICAgICAgICB2YXIgYyA9IE1hdGguY29zO1xuICAgICAgICB2YXIgYSA9IDAuNSAtIGMoKGNvbXBhbnlMYXQgLSB1c2VyTGF0KSAqIHApLzIgK1xuICAgICAgICAgICAgYyh1c2VyTGF0ICogcCkgKiBjKGNvbXBhbnlMYXQgKiBwKSAqXG4gICAgICAgICAgICAoMSAtIGMoKGNvbXBhbnlMbmcgLSB1c2VyTG5nKSAqIHApKS8yO1xuXG4gICAgICAgIHZhciBkID0gTWF0aC5yb3VuZCggMTI3NDIgKiBNYXRoLmFzaW4oTWF0aC5zcXJ0KGEpICkgKiAxMCkgLyAxMDsgLy8gMiAqIFI7IFIgPSA2MzcxIGttXG4gICAgICAgIGNvbnNvbGUubG9nKDEyNzQyICogTWF0aC5hc2luKE1hdGguc3FydChhKSkpXG4gICAgICAgIHJldHVybiBkXG4gICAgfVxuXG4gICAgY29uc3QgaGFuZGxlQ2xpY2sgPSB1c2VDYWxsYmFjaygoKSA9PiB7XG4gICAgICAgIGxldCBjbGljayA9IHN0YXRlLmNsaWNrID8gZmFsc2UgOiB0cnVlXG4gICAgICAgIHNldFN0YXRlKHtjbGljazpjbGlja30pXG4gICAgfSlcblxuICAgIHJldHVybiA8ZGl2IGNsYXNzTmFtZT1cImNvbXBhbnlDb250ZW50XCI+XG4gICAgICAgIDxkaXYgY2xhc3NOYW1lPVwiY29tcGFueVRpdGxlXCIga2V5PXtpZHh9IG9uQ2xpY2s9e2hhbmRsZUNsaWNrfT5cbiAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwiaWNvbk5hbWVcIj5cbiAgICAgICAgICAgICAgICA8c3BhbiBjbGFzc05hbWU9XCJwdWNlXCI+PC9zcGFuPlxuICAgICAgICAgICAgICAgIDxpbWcgc3JjPVwiL2ltYWdlcy9TdWJjYXRlZ29yeS9wb3NpdGlvbi5wbmdcIiBhbHQ9XCJpY29uZSBwb3NpdGlvbiBHUFNcIi8+XG4gICAgICAgICAgICAgICAgPGg0Pntjb21wYW55Lm5hbWV9PC9oND5cbiAgICAgICAgICAgIDwvZGl2PlxuICAgICAgICAgICAgPHA+e2NhbGN1bGF0ZURpc3RhbmNlKHVzZXJMb2NhdGlvbi5sYXQsIHVzZXJMb2NhdGlvbi5sbmcsIGNvbXBhbnkubGF0aXR1ZGUsIGNvbXBhbnkubG9uZ3RpdHVkZSl9IGttPC9wPlxuICAgICAgICA8L2Rpdj5cbiAgICAgICAge3N0YXRlLmNsaWNrICYmIDxkaXYgY2xhc3NOYW1lPVwiY29tcGFueURldGFpbFwiPlxuICAgICAgICAgICAgPHAgY2xhc3NOYW1lPVwicEJvcmRlclwiPntjb21wYW55LmFkZHJlc3N9PC9wPlxuICAgICAgICAgICAgPHAgY2xhc3NOYW1lPVwicEJvcmRlclwiPntjb21wYW55LnBob25lfTwvcD5cbiAgICAgICAgICAgIDxwIGNsYXNzTmFtZT1cInBCb3JkZXJcIj57Y29tcGFueS51cmx3ZWJzaXRlfTwvcD5cbiAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwieUFsbGVyXCI+XG4gICAgICAgICAgICAgICAgPHA+WSBhbGxlcjwvcD5cbiAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImltZ1lBbGxlclwiPlxuICAgICAgICAgICAgICAgICAgICA8aW1nIHNyYz1cIi9pbWFnZXMvU3ViY2F0ZWdvcnkvcGlldG9uLnBuZ1wiIGFsdD1cInBpZXRvblwiLz5cbiAgICAgICAgICAgICAgICAgICAgPGltZyBzcmM9XCIvaW1hZ2VzL1N1YmNhdGVnb3J5L3ZlbG8ucG5nXCIgYWx0PVwidmVsb1wiLz5cbiAgICAgICAgICAgICAgICAgICAgPGltZyBzcmM9XCIvaW1hZ2VzL1N1YmNhdGVnb3J5L3ZvaXR1cmUucG5nXCIgYWx0PVwidm9pdHVyZVwiLz5cbiAgICAgICAgICAgICAgICA8L2Rpdj5cbiAgICAgICAgICAgIDwvZGl2PlxuICAgICAgICAgICAgPHAgY2xhc3NOYW1lPVwicEJvcmRlciBwb2ludGVyXCI+Q2FsY3VsZXIgdm90cmUgZW1wcmVpbnRlIMOpY29sb2dpcXVlPC9wPlxuICAgICAgICA8L2Rpdj59XG4gICAgPC9kaXY+XG5cbn1cblxuZnVuY3Rpb24gU3ViQ2F0ZWdvcnlEZXRhaWwocHJvcHMpIHtcblxuICAgIHJldHVybiA8ZGl2IGNsYXNzTmFtZT1cInN1YmNhdERldGFpbFwiPlxuICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cInN1YmNhdEVsZW1lbnQgY2xpY2tlZFwiPlxuICAgICAgICAgICAge3Byb3BzLm5hbWV9XG4gICAgICAgIDwvZGl2PlxuICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImNvbXBhbnlMaXN0XCI+XG4gICAgICAgICAgICB7cHJvcHMuY29tcGFuaWVzLm1hcCgoY29tcGFueSxpZHgpID0+IHtcbiAgICAgICAgICAgICAgICByZXR1cm4gPENvbXBhbnlEZXRhaWwgY29tcGFueT17Y29tcGFueX0gaWR4PXtpZHh9IHVzZXJMb2NhdGlvbj17cHJvcHMudXNlckxvY2F0aW9ufS8+XG4gICAgICAgICAgICB9KX1cbiAgICAgICAgPC9kaXY+XG4gICAgPC9kaXY+XG5cbn1cblxuZnVuY3Rpb24gU3ViQ2F0ZWdvcnlNZW51KHByb3BzKSB7XG5cbiAgICBjb25zdCBbc3RhdGUsIHNldFN0YXRlXSA9IHVzZVN0YXRlKHtcbiAgICAgICAgY29tcGFuaWVzOiBbXSxcbiAgICAgICAgY2xpY2s6IGZhbHNlLFxuICAgICAgICBuYW1lOicnXG4gICAgfSlcblxuICAgIGNvbnN0IGdldENvbXBhbmllcyA9IHVzZUNhbGxiYWNrKChpZCxjYXRJZCkgPT4ge1xuICAgICAgICBmZXRjaChgL3Jlc3QvY2F0ZWdvcnkvJHtjYXRJZH0vc3ViY2F0ZWdvcnkvJHtpZH0vY29tcGFuaWVzYCwge1xuICAgICAgICAgICAgbWV0aG9kOiBcImdldFwiLFxuICAgICAgICAgICAgaGVhZGVyOiB7XG4gICAgICAgICAgICAgICAgXCJDb250ZW50LVR5cGVcIjogXCJhcHBsaWNhdGlvbi9qc29uXCIsXG4gICAgICAgICAgICAgICAgXCJBY2NlcHRcIjogXCJhcHBsaWNhdGlvbi9qc29uXCJcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBjcmVkZW50aWFsczogJ3NhbWUtb3JpZ2luJ1xuXG4gICAgICAgIH0pLnRoZW4ocmVzcG9uc2UgPT4ge1xuICAgICAgICAgICAgcmV0dXJuIHJlc3BvbnNlLmpzb24oKVxuICAgICAgICB9KS50aGVuKGRhdGEgPT4ge1xuICAgICAgICAgICAgLy9jb25zb2xlLmxvZyhkYXRhKVxuICAgICAgICAgICAgc2V0U3RhdGUocyA9PiAoXG4gICAgICAgICAgICAgICAgey4uLnMsIGNvbXBhbmllczogZGF0YX0pXG4gICAgICAgICAgICApXG4gICAgICAgIH0pO1xuICAgIH0sIFtdKVxuXG4gICAgY29uc3QgaGFuZGxlQ2xpY2sgPSB1c2VDYWxsYmFjaygoaWQsIG5hbWUpID0+IHtcbiAgICAgICAgLy9jb25zb2xlLmxvZyhpZClcbiAgICAgICAgZ2V0Q29tcGFuaWVzKGlkLCBwcm9wcy5jYXRJZClcbiAgICAgICAgc2V0U3RhdGUocyA9PiAoey4uLnMsIGNsaWNrOiB0cnVlLCBuYW1lOiBuYW1lfSkpXG4gICAgfSxbXSlcblxuICAgIGNvbnN0IHJldG91ciA9IHVzZUNhbGxiYWNrKCgpID0+IHtcbiAgICAgICAgc2V0U3RhdGUocyA9PiAoey4uLnMsIGNsaWNrOiBmYWxzZX0pKVxuICAgIH0pXG5cblxuICAgIHJldHVybiA8ZGl2IGNsYXNzTmFtZT1cInN1YmNhdGVnb3J5X21lbnVcIj5cbiAgICAgICAgeyFzdGF0ZS5jbGljayAmJiA8cCBjbGFzc05hbWU9XCJwb2ludGVyXCIgb25DbGljaz17cHJvcHMub25DbGlja30+ICZsdDsgbGlzdGUgZGVzIGNhdMOpZ29yaWVzPC9wPn1cbiAgICAgICAge3N0YXRlLmNsaWNrICYmIDxwIGNsYXNzTmFtZT1cInBvaW50ZXJcIiBvbkNsaWNrPXtyZXRvdXJ9PiAmbHQ7IHtwcm9wcy5uYW1lfTwvcD59XG4gICAgICAgIDxkaXYgY2xhc3NOYW1lPVwibWVudV90aXRsZVwiPlxuICAgICAgICAgICAgPGltZyBzcmM9e2AvaW1hZ2VzL0ljb25lc19DYXRlZ29yaWVzLyR7cHJvcHMubmFtZX0vJHtwcm9wcy5uYW1lfS5wbmdgfSBhbHQ9e3Byb3BzLm5hbWV9Lz5cbiAgICAgICAgICAgIDxoMz57cHJvcHMubmFtZX08L2gzPlxuICAgICAgICA8L2Rpdj5cbiAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJzdWJjYXRzXCI+XG4gICAgICAgICAgICB7IXN0YXRlLmNsaWNrICYmIHByb3BzLnN1YmNhdHMubWFwKHN1YmNhdCA9PiB7XG4gICAgICAgICAgICAgICAgcmV0dXJuIDxkaXYgY2xhc3NOYW1lPVwic3ViY2F0RWxlbWVudFwiIGtleT17c3ViY2F0LmlkfSBvbkNsaWNrPXsoKSA9PiBoYW5kbGVDbGljayhzdWJjYXQuaWQsIHN1YmNhdC5uYW1lKX0+XG4gICAgICAgICAgICAgICAgICAgICAgICB7c3ViY2F0Lm5hbWV9XG4gICAgICAgICAgICAgICAgICAgIDwvZGl2PlxuXG4gICAgICAgICAgICB9KX1cbiAgICAgICAgPC9kaXY+XG4gICAgICAgIHtzdGF0ZS5jbGljayAmJiA8U3ViQ2F0ZWdvcnlEZXRhaWwgbmFtZT17c3RhdGUubmFtZX0gY29tcGFuaWVzPXtzdGF0ZS5jb21wYW5pZXN9IHVzZXJMb2NhdGlvbj17cHJvcHMudXNlckxvY2F0aW9ufS8+fVxuXG4gICAgPC9kaXY+XG59XG5cbmV4cG9ydCBjbGFzcyBTaWRlTWVudSBleHRlbmRzIFJlYWN0LkNvbXBvbmVudCB7XG5cblxuICAgIGNvbnN0cnVjdG9yKHByb3BzKXtcbiAgICAgICAgc3VwZXIocHJvcHMpXG4gICAgICAgIHRoaXMuc3RhdGUgPSB7XG4gICAgICAgICAgICBkYXRhQ2F0ZWdvcmllczpbXSxcbiAgICAgICAgfVxuXG4gICAgICAgIHRoaXMuZ2V0Q2F0ZWdvcmllcyA9IHRoaXMuZ2V0Q2F0ZWdvcmllcy5iaW5kKHRoaXMpXG4gICAgICAgIHRoaXMuaGFuZGxlQ2xpY2sgPSB0aGlzLmhhbmRsZUNsaWNrLmJpbmQodGhpcylcbiAgICB9XG5cbiAgICBnZXRDYXRlZ29yaWVzKCkge1xuICAgICAgICB0aGlzLnNldFN0YXRlKHtcbiAgICAgICAgICAgIGRhdGFDYXRlZ29yaWVzOltdXG4gICAgICAgIH0pO1xuICAgICAgICBmZXRjaCgnL2dldC1jYXRlZ29yaWVzLycsIHtcbiAgICAgICAgICAgIG1ldGhvZDogXCJnZXRcIixcbiAgICAgICAgICAgIGhlYWRlcjoge1xuICAgICAgICAgICAgICAgIFwiQ29udGVudC1UeXBlXCI6IFwiYXBwbGljYXRpb24vanNvblwiLFxuICAgICAgICAgICAgICAgIFwiQWNjZXB0XCI6IFwiYXBwbGljYXRpb24vanNvblwiXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgY3JlZGVudGlhbHM6ICdzYW1lLW9yaWdpbidcblxuICAgICAgICB9KS50aGVuKHJlc3BvbnNlID0+IHtcbiAgICAgICAgICAgIHJldHVybiByZXNwb25zZS5qc29uKClcbiAgICAgICAgfSkudGhlbihkYXRhID0+IHtcbiAgICAgICAgICAgIHRoaXMuc2V0U3RhdGUoe1xuICAgICAgICAgICAgICAgICAgICBkYXRhQ2F0ZWdvcmllczogZGF0YVxuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIClcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgY29tcG9uZW50RGlkTW91bnQoKSB7XG4gICAgICAgIHRoaXMuZ2V0Q2F0ZWdvcmllcygpXG4gICAgfVxuXG4gICAgaGFuZGxlQ2xpY2soaWQsIG5hbWUsIHN1YmNhdCkge1xuICAgICAgICB0aGlzLnNldFN0YXRlKFxuICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgIGlkOiBpZCxcbiAgICAgICAgICAgICAgICBuYW1lOiBuYW1lLFxuICAgICAgICAgICAgICAgIHN1YmNhdDogc3ViY2F0LFxuICAgICAgICAgICAgICAgIGRpc3BsYXlTdWJDYXRzOiB0cnVlXG4gICAgICAgICAgICB9XG4gICAgICAgIClcblxuXG4gICAgICAgIHRoaXMucHJvcHMuc2V0UGFyYW1zKHtcbiAgICAgICAgICAgIGNhdGVnb3JpZXM6IFtpZF1cbiAgICAgICAgfSwgKCkgPT4ge1xuICAgICAgICAgICAgdGhpcy5wcm9wcy5maWx0ZXIodGhpcy5wcm9wcy5kYXRhLHRoaXMucHJvcHMuY3JpdGVyaWFzLCB0aGlzLnByb3BzLnBhcmFtcylcbiAgICAgICAgfSlcblxuICAgIH1cblxuICAgIHJlbmRlcigpe1xuICAgICAgICBpZighdGhpcy5zdGF0ZS5kaXNwbGF5U3ViQ2F0cykge1xuXG4gICAgICAgICAgICByZXR1cm4gKHRoaXMuc3RhdGUuZGF0YUNhdGVnb3JpZXMubWFwKCBjYXRlZ29yeSA9PiB7XG4gICAgICAgICAgICAgICAgcmV0dXJuIDxDYXRlZ29yeSBpZD17Y2F0ZWdvcnkuaWR9IG5hbWU9e2NhdGVnb3J5Lm5hbWV9IGtleT17Y2F0ZWdvcnkuaWR9XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjdXN0b21DbGlja0V2ZW50PXsoKSA9PiB0aGlzLmhhbmRsZUNsaWNrKGNhdGVnb3J5LmlkLCBjYXRlZ29yeS5uYW1lLCBjYXRlZ29yeS5zdWJjYXRlZ29yaWVzKX0vPlxuICAgICAgICAgICAgICAgIH0pXG4gICAgICAgICAgICApXG4gICAgICAgIH1cbiAgICAgICAgcmV0dXJuICh0aGlzLnN0YXRlLmRpc3BsYXlTdWJDYXRzICYmIDxTdWJDYXRlZ29yeU1lbnUgY2F0SWQ9e3RoaXMuc3RhdGUuaWR9IG5hbWU9e3RoaXMuc3RhdGUubmFtZX0gc3ViY2F0cz17dGhpcy5zdGF0ZS5zdWJjYXR9IG9uQ2xpY2s9eygpID0+IHt0aGlzLnByb3BzLmluaXQoKTsgdGhpcy5zZXRTdGF0ZSh7ZGlzcGxheVN1YkNhdHM6IGZhbHNlfSl9fSBrZXk9e3RoaXMuc3RhdGUuaWR9IHVzZXJMb2NhdGlvbj17dGhpcy5wcm9wcy51c2VyTG9jYXRpb259Lz4pXG4gICAgfVxuXG59XG5cblxuXG4iLCIndXNlIHN0cmljdCc7XG52YXIgdG9QcmltaXRpdmUgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvdG8tcHJpbWl0aXZlJyk7XG52YXIgZGVmaW5lUHJvcGVydHlNb2R1bGUgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvb2JqZWN0LWRlZmluZS1wcm9wZXJ0eScpO1xudmFyIGNyZWF0ZVByb3BlcnR5RGVzY3JpcHRvciA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9jcmVhdGUtcHJvcGVydHktZGVzY3JpcHRvcicpO1xuXG5tb2R1bGUuZXhwb3J0cyA9IGZ1bmN0aW9uIChvYmplY3QsIGtleSwgdmFsdWUpIHtcbiAgdmFyIHByb3BlcnR5S2V5ID0gdG9QcmltaXRpdmUoa2V5KTtcbiAgaWYgKHByb3BlcnR5S2V5IGluIG9iamVjdCkgZGVmaW5lUHJvcGVydHlNb2R1bGUuZihvYmplY3QsIHByb3BlcnR5S2V5LCBjcmVhdGVQcm9wZXJ0eURlc2NyaXB0b3IoMCwgdmFsdWUpKTtcbiAgZWxzZSBvYmplY3RbcHJvcGVydHlLZXldID0gdmFsdWU7XG59O1xuIiwidmFyIGlzT2JqZWN0ID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2lzLW9iamVjdCcpO1xudmFyIGNsYXNzb2YgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvY2xhc3NvZi1yYXcnKTtcbnZhciB3ZWxsS25vd25TeW1ib2wgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvd2VsbC1rbm93bi1zeW1ib2wnKTtcblxudmFyIE1BVENIID0gd2VsbEtub3duU3ltYm9sKCdtYXRjaCcpO1xuXG4vLyBgSXNSZWdFeHBgIGFic3RyYWN0IG9wZXJhdGlvblxuLy8gaHR0cHM6Ly90YzM5LmVzL2VjbWEyNjIvI3NlYy1pc3JlZ2V4cFxubW9kdWxlLmV4cG9ydHMgPSBmdW5jdGlvbiAoaXQpIHtcbiAgdmFyIGlzUmVnRXhwO1xuICByZXR1cm4gaXNPYmplY3QoaXQpICYmICgoaXNSZWdFeHAgPSBpdFtNQVRDSF0pICE9PSB1bmRlZmluZWQgPyAhIWlzUmVnRXhwIDogY2xhc3NvZihpdCkgPT0gJ1JlZ0V4cCcpO1xufTtcbiIsIid1c2Ugc3RyaWN0JztcbnZhciBnZXRCdWlsdEluID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2dldC1idWlsdC1pbicpO1xudmFyIGRlZmluZVByb3BlcnR5TW9kdWxlID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL29iamVjdC1kZWZpbmUtcHJvcGVydHknKTtcbnZhciB3ZWxsS25vd25TeW1ib2wgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvd2VsbC1rbm93bi1zeW1ib2wnKTtcbnZhciBERVNDUklQVE9SUyA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9kZXNjcmlwdG9ycycpO1xuXG52YXIgU1BFQ0lFUyA9IHdlbGxLbm93blN5bWJvbCgnc3BlY2llcycpO1xuXG5tb2R1bGUuZXhwb3J0cyA9IGZ1bmN0aW9uIChDT05TVFJVQ1RPUl9OQU1FKSB7XG4gIHZhciBDb25zdHJ1Y3RvciA9IGdldEJ1aWx0SW4oQ09OU1RSVUNUT1JfTkFNRSk7XG4gIHZhciBkZWZpbmVQcm9wZXJ0eSA9IGRlZmluZVByb3BlcnR5TW9kdWxlLmY7XG5cbiAgaWYgKERFU0NSSVBUT1JTICYmIENvbnN0cnVjdG9yICYmICFDb25zdHJ1Y3RvcltTUEVDSUVTXSkge1xuICAgIGRlZmluZVByb3BlcnR5KENvbnN0cnVjdG9yLCBTUEVDSUVTLCB7XG4gICAgICBjb25maWd1cmFibGU6IHRydWUsXG4gICAgICBnZXQ6IGZ1bmN0aW9uICgpIHsgcmV0dXJuIHRoaXM7IH1cbiAgICB9KTtcbiAgfVxufTtcbiIsIid1c2Ugc3RyaWN0JztcbnZhciAkID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2V4cG9ydCcpO1xudmFyIGZhaWxzID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2ZhaWxzJyk7XG52YXIgaXNBcnJheSA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9pcy1hcnJheScpO1xudmFyIGlzT2JqZWN0ID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2lzLW9iamVjdCcpO1xudmFyIHRvT2JqZWN0ID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL3RvLW9iamVjdCcpO1xudmFyIHRvTGVuZ3RoID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL3RvLWxlbmd0aCcpO1xudmFyIGNyZWF0ZVByb3BlcnR5ID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2NyZWF0ZS1wcm9wZXJ0eScpO1xudmFyIGFycmF5U3BlY2llc0NyZWF0ZSA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9hcnJheS1zcGVjaWVzLWNyZWF0ZScpO1xudmFyIGFycmF5TWV0aG9kSGFzU3BlY2llc1N1cHBvcnQgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvYXJyYXktbWV0aG9kLWhhcy1zcGVjaWVzLXN1cHBvcnQnKTtcbnZhciB3ZWxsS25vd25TeW1ib2wgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvd2VsbC1rbm93bi1zeW1ib2wnKTtcbnZhciBWOF9WRVJTSU9OID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2VuZ2luZS12OC12ZXJzaW9uJyk7XG5cbnZhciBJU19DT05DQVRfU1BSRUFEQUJMRSA9IHdlbGxLbm93blN5bWJvbCgnaXNDb25jYXRTcHJlYWRhYmxlJyk7XG52YXIgTUFYX1NBRkVfSU5URUdFUiA9IDB4MUZGRkZGRkZGRkZGRkY7XG52YXIgTUFYSU1VTV9BTExPV0VEX0lOREVYX0VYQ0VFREVEID0gJ01heGltdW0gYWxsb3dlZCBpbmRleCBleGNlZWRlZCc7XG5cbi8vIFdlIGNhbid0IHVzZSB0aGlzIGZlYXR1cmUgZGV0ZWN0aW9uIGluIFY4IHNpbmNlIGl0IGNhdXNlc1xuLy8gZGVvcHRpbWl6YXRpb24gYW5kIHNlcmlvdXMgcGVyZm9ybWFuY2UgZGVncmFkYXRpb25cbi8vIGh0dHBzOi8vZ2l0aHViLmNvbS96bG9pcm9jay9jb3JlLWpzL2lzc3Vlcy82NzlcbnZhciBJU19DT05DQVRfU1BSRUFEQUJMRV9TVVBQT1JUID0gVjhfVkVSU0lPTiA+PSA1MSB8fCAhZmFpbHMoZnVuY3Rpb24gKCkge1xuICB2YXIgYXJyYXkgPSBbXTtcbiAgYXJyYXlbSVNfQ09OQ0FUX1NQUkVBREFCTEVdID0gZmFsc2U7XG4gIHJldHVybiBhcnJheS5jb25jYXQoKVswXSAhPT0gYXJyYXk7XG59KTtcblxudmFyIFNQRUNJRVNfU1VQUE9SVCA9IGFycmF5TWV0aG9kSGFzU3BlY2llc1N1cHBvcnQoJ2NvbmNhdCcpO1xuXG52YXIgaXNDb25jYXRTcHJlYWRhYmxlID0gZnVuY3Rpb24gKE8pIHtcbiAgaWYgKCFpc09iamVjdChPKSkgcmV0dXJuIGZhbHNlO1xuICB2YXIgc3ByZWFkYWJsZSA9IE9bSVNfQ09OQ0FUX1NQUkVBREFCTEVdO1xuICByZXR1cm4gc3ByZWFkYWJsZSAhPT0gdW5kZWZpbmVkID8gISFzcHJlYWRhYmxlIDogaXNBcnJheShPKTtcbn07XG5cbnZhciBGT1JDRUQgPSAhSVNfQ09OQ0FUX1NQUkVBREFCTEVfU1VQUE9SVCB8fCAhU1BFQ0lFU19TVVBQT1JUO1xuXG4vLyBgQXJyYXkucHJvdG90eXBlLmNvbmNhdGAgbWV0aG9kXG4vLyBodHRwczovL3RjMzkuZXMvZWNtYTI2Mi8jc2VjLWFycmF5LnByb3RvdHlwZS5jb25jYXRcbi8vIHdpdGggYWRkaW5nIHN1cHBvcnQgb2YgQEBpc0NvbmNhdFNwcmVhZGFibGUgYW5kIEBAc3BlY2llc1xuJCh7IHRhcmdldDogJ0FycmF5JywgcHJvdG86IHRydWUsIGZvcmNlZDogRk9SQ0VEIH0sIHtcbiAgLy8gZXNsaW50LWRpc2FibGUtbmV4dC1saW5lIG5vLXVudXNlZC12YXJzIC0tIHJlcXVpcmVkIGZvciBgLmxlbmd0aGBcbiAgY29uY2F0OiBmdW5jdGlvbiBjb25jYXQoYXJnKSB7XG4gICAgdmFyIE8gPSB0b09iamVjdCh0aGlzKTtcbiAgICB2YXIgQSA9IGFycmF5U3BlY2llc0NyZWF0ZShPLCAwKTtcbiAgICB2YXIgbiA9IDA7XG4gICAgdmFyIGksIGssIGxlbmd0aCwgbGVuLCBFO1xuICAgIGZvciAoaSA9IC0xLCBsZW5ndGggPSBhcmd1bWVudHMubGVuZ3RoOyBpIDwgbGVuZ3RoOyBpKyspIHtcbiAgICAgIEUgPSBpID09PSAtMSA/IE8gOiBhcmd1bWVudHNbaV07XG4gICAgICBpZiAoaXNDb25jYXRTcHJlYWRhYmxlKEUpKSB7XG4gICAgICAgIGxlbiA9IHRvTGVuZ3RoKEUubGVuZ3RoKTtcbiAgICAgICAgaWYgKG4gKyBsZW4gPiBNQVhfU0FGRV9JTlRFR0VSKSB0aHJvdyBUeXBlRXJyb3IoTUFYSU1VTV9BTExPV0VEX0lOREVYX0VYQ0VFREVEKTtcbiAgICAgICAgZm9yIChrID0gMDsgayA8IGxlbjsgaysrLCBuKyspIGlmIChrIGluIEUpIGNyZWF0ZVByb3BlcnR5KEEsIG4sIEVba10pO1xuICAgICAgfSBlbHNlIHtcbiAgICAgICAgaWYgKG4gPj0gTUFYX1NBRkVfSU5URUdFUikgdGhyb3cgVHlwZUVycm9yKE1BWElNVU1fQUxMT1dFRF9JTkRFWF9FWENFRURFRCk7XG4gICAgICAgIGNyZWF0ZVByb3BlcnR5KEEsIG4rKywgRSk7XG4gICAgICB9XG4gICAgfVxuICAgIEEubGVuZ3RoID0gbjtcbiAgICByZXR1cm4gQTtcbiAgfVxufSk7XG4iLCJ2YXIgJCA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9leHBvcnQnKTtcbnZhciBiaW5kID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2Z1bmN0aW9uLWJpbmQnKTtcblxuLy8gYEZ1bmN0aW9uLnByb3RvdHlwZS5iaW5kYCBtZXRob2Rcbi8vIGh0dHBzOi8vdGMzOS5lcy9lY21hMjYyLyNzZWMtZnVuY3Rpb24ucHJvdG90eXBlLmJpbmRcbiQoeyB0YXJnZXQ6ICdGdW5jdGlvbicsIHByb3RvOiB0cnVlIH0sIHtcbiAgYmluZDogYmluZFxufSk7XG4iLCJ2YXIgJCA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9leHBvcnQnKTtcbnZhciBERVNDUklQVE9SUyA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9kZXNjcmlwdG9ycycpO1xudmFyIGRlZmluZVByb3BlcnRpZXMgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvb2JqZWN0LWRlZmluZS1wcm9wZXJ0aWVzJyk7XG5cbi8vIGBPYmplY3QuZGVmaW5lUHJvcGVydGllc2AgbWV0aG9kXG4vLyBodHRwczovL3RjMzkuZXMvZWNtYTI2Mi8jc2VjLW9iamVjdC5kZWZpbmVwcm9wZXJ0aWVzXG4kKHsgdGFyZ2V0OiAnT2JqZWN0Jywgc3RhdDogdHJ1ZSwgZm9yY2VkOiAhREVTQ1JJUFRPUlMsIHNoYW06ICFERVNDUklQVE9SUyB9LCB7XG4gIGRlZmluZVByb3BlcnRpZXM6IGRlZmluZVByb3BlcnRpZXNcbn0pO1xuIiwidmFyICQgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvZXhwb3J0Jyk7XG52YXIgZmFpbHMgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvZmFpbHMnKTtcbnZhciB0b0luZGV4ZWRPYmplY3QgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvdG8taW5kZXhlZC1vYmplY3QnKTtcbnZhciBuYXRpdmVHZXRPd25Qcm9wZXJ0eURlc2NyaXB0b3IgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvb2JqZWN0LWdldC1vd24tcHJvcGVydHktZGVzY3JpcHRvcicpLmY7XG52YXIgREVTQ1JJUFRPUlMgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvZGVzY3JpcHRvcnMnKTtcblxudmFyIEZBSUxTX09OX1BSSU1JVElWRVMgPSBmYWlscyhmdW5jdGlvbiAoKSB7IG5hdGl2ZUdldE93blByb3BlcnR5RGVzY3JpcHRvcigxKTsgfSk7XG52YXIgRk9SQ0VEID0gIURFU0NSSVBUT1JTIHx8IEZBSUxTX09OX1BSSU1JVElWRVM7XG5cbi8vIGBPYmplY3QuZ2V0T3duUHJvcGVydHlEZXNjcmlwdG9yYCBtZXRob2Rcbi8vIGh0dHBzOi8vdGMzOS5lcy9lY21hMjYyLyNzZWMtb2JqZWN0LmdldG93bnByb3BlcnR5ZGVzY3JpcHRvclxuJCh7IHRhcmdldDogJ09iamVjdCcsIHN0YXQ6IHRydWUsIGZvcmNlZDogRk9SQ0VELCBzaGFtOiAhREVTQ1JJUFRPUlMgfSwge1xuICBnZXRPd25Qcm9wZXJ0eURlc2NyaXB0b3I6IGZ1bmN0aW9uIGdldE93blByb3BlcnR5RGVzY3JpcHRvcihpdCwga2V5KSB7XG4gICAgcmV0dXJuIG5hdGl2ZUdldE93blByb3BlcnR5RGVzY3JpcHRvcih0b0luZGV4ZWRPYmplY3QoaXQpLCBrZXkpO1xuICB9XG59KTtcbiIsInZhciAkID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2V4cG9ydCcpO1xudmFyIERFU0NSSVBUT1JTID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2Rlc2NyaXB0b3JzJyk7XG52YXIgb3duS2V5cyA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9vd24ta2V5cycpO1xudmFyIHRvSW5kZXhlZE9iamVjdCA9IHJlcXVpcmUoJy4uL2ludGVybmFscy90by1pbmRleGVkLW9iamVjdCcpO1xudmFyIGdldE93blByb3BlcnR5RGVzY3JpcHRvck1vZHVsZSA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9vYmplY3QtZ2V0LW93bi1wcm9wZXJ0eS1kZXNjcmlwdG9yJyk7XG52YXIgY3JlYXRlUHJvcGVydHkgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvY3JlYXRlLXByb3BlcnR5Jyk7XG5cbi8vIGBPYmplY3QuZ2V0T3duUHJvcGVydHlEZXNjcmlwdG9yc2AgbWV0aG9kXG4vLyBodHRwczovL3RjMzkuZXMvZWNtYTI2Mi8jc2VjLW9iamVjdC5nZXRvd25wcm9wZXJ0eWRlc2NyaXB0b3JzXG4kKHsgdGFyZ2V0OiAnT2JqZWN0Jywgc3RhdDogdHJ1ZSwgc2hhbTogIURFU0NSSVBUT1JTIH0sIHtcbiAgZ2V0T3duUHJvcGVydHlEZXNjcmlwdG9yczogZnVuY3Rpb24gZ2V0T3duUHJvcGVydHlEZXNjcmlwdG9ycyhvYmplY3QpIHtcbiAgICB2YXIgTyA9IHRvSW5kZXhlZE9iamVjdChvYmplY3QpO1xuICAgIHZhciBnZXRPd25Qcm9wZXJ0eURlc2NyaXB0b3IgPSBnZXRPd25Qcm9wZXJ0eURlc2NyaXB0b3JNb2R1bGUuZjtcbiAgICB2YXIga2V5cyA9IG93bktleXMoTyk7XG4gICAgdmFyIHJlc3VsdCA9IHt9O1xuICAgIHZhciBpbmRleCA9IDA7XG4gICAgdmFyIGtleSwgZGVzY3JpcHRvcjtcbiAgICB3aGlsZSAoa2V5cy5sZW5ndGggPiBpbmRleCkge1xuICAgICAgZGVzY3JpcHRvciA9IGdldE93blByb3BlcnR5RGVzY3JpcHRvcihPLCBrZXkgPSBrZXlzW2luZGV4KytdKTtcbiAgICAgIGlmIChkZXNjcmlwdG9yICE9PSB1bmRlZmluZWQpIGNyZWF0ZVByb3BlcnR5KHJlc3VsdCwga2V5LCBkZXNjcmlwdG9yKTtcbiAgICB9XG4gICAgcmV0dXJuIHJlc3VsdDtcbiAgfVxufSk7XG4iLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiXSwic291cmNlUm9vdCI6IiJ9