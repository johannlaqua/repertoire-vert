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
/* harmony import */ var _assets_styles_company_map_scss__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(/*! ../../../../../assets/styles/company_map.scss */ "./assets/styles/company_map.scss");
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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY29tcG9uZW50cy9jb21wYW5pZXNfbWFwL2NvbXBhbmllc19tYXAuanN4Iiwid2VicGFjazovLy8uL2Fzc2V0cy9jb21wb25lbnRzL2NvbXBhbmllc19tYXAvc2lkZU1lbnUuanN4Iiwid2VicGFjazovLy8uL25vZGVfbW9kdWxlcy9jb3JlLWpzL2ludGVybmFscy9jcmVhdGUtcHJvcGVydHkuanMiLCJ3ZWJwYWNrOi8vLy4vbm9kZV9tb2R1bGVzL2NvcmUtanMvaW50ZXJuYWxzL2lzLXJlZ2V4cC5qcyIsIndlYnBhY2s6Ly8vLi9ub2RlX21vZHVsZXMvY29yZS1qcy9pbnRlcm5hbHMvc2V0LXNwZWNpZXMuanMiLCJ3ZWJwYWNrOi8vLy4vbm9kZV9tb2R1bGVzL2NvcmUtanMvbW9kdWxlcy9lcy5hcnJheS5jb25jYXQuanMiLCJ3ZWJwYWNrOi8vLy4vbm9kZV9tb2R1bGVzL2NvcmUtanMvbW9kdWxlcy9lcy5mdW5jdGlvbi5iaW5kLmpzIiwid2VicGFjazovLy8uL25vZGVfbW9kdWxlcy9jb3JlLWpzL21vZHVsZXMvZXMub2JqZWN0LmRlZmluZS1wcm9wZXJ0aWVzLmpzIiwid2VicGFjazovLy8uL25vZGVfbW9kdWxlcy9jb3JlLWpzL21vZHVsZXMvZXMub2JqZWN0LmdldC1vd24tcHJvcGVydHktZGVzY3JpcHRvci5qcyIsIndlYnBhY2s6Ly8vLi9ub2RlX21vZHVsZXMvY29yZS1qcy9tb2R1bGVzL2VzLm9iamVjdC5nZXQtb3duLXByb3BlcnR5LWRlc2NyaXB0b3JzLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zdHlsZXMvY29tcGFueV9tYXAuc2NzcyJdLCJuYW1lcyI6WyJhcnJheU1hcmtlcnMiLCJhcnJheUluaXRNYXJrZXJzIiwibWFya2Vyc0xheWVyIiwiYXJyYXlQYXJhbSIsImFycmF5Q3JpdGVyZSIsIk1hcFBhZ2UiLCJwcm9wcyIsInN0YXRlIiwiZGF0YUNvbXBhbmllcyIsImNyaXRlcmlhcyIsInBhcmFtIiwidXNlckxvY2F0aW9uIiwiaW5pdE1hcCIsImJpbmQiLCJnZXRDb21wYW5pZXNPbk1hcCIsImZpbHRyYWdlIiwiZmlsdGVyU2hvd0NvbXBhbmllcyIsInBsYWNlSW5pdE1hcmtlcnMiLCJnZXRVc2VyTG9jYXRpb24iLCJzZXRTdGF0ZSIsImZldGNoIiwibWV0aG9kIiwiaGVhZGVyIiwiY3JlZGVudGlhbHMiLCJ0aGVuIiwicmVzcG9uc2UiLCJqc29uIiwiZGF0YSIsImNvbnNvbGUiLCJsb2ciLCJmb3JFYWNoIiwibWFya2VyIiwicmVtb3ZlTGF5ZXIiLCJhZGRMYXllciIsInB1c2giLCJjb21wYW55IiwiaSIsIkwiLCJsYXRpdHVkZSIsImxvbmd0aXR1ZGUiLCJiaW5kUG9wdXAiLCJuYW1lIiwib3BlblBvcHVwIiwiZSIsImxhdGxuZyIsIm15bWFwIiwiTWFwIiwiem9vbSIsImNlbnRlciIsImxhdExuZyIsIlRpbGVMYXllciIsIkxheWVyR3JvdXAiLCJjb250cm9sU2VhcmNoIiwiQ29udHJvbCIsIlNlYXJjaCIsInBvc2l0aW9uIiwibGF5ZXIiLCJpbml0aWFsIiwiYWRkQ29udHJvbCIsImxvY2F0ZSIsIm9uIiwibGlzdCIsImFycmF5UGFyYW1ldGVyIiwibmV3TGlzdCIsInJlc3BlY3RDcml0ZXJlcyIsInJlc3BlY3RQYXJhbXMiLCJlbGVtIiwiY3JpdGVyZSIsImZpbHRlclBhcmFtIiwiZWxlbVBhcmFtIiwiaWQiLCJmaWx0ZXJlZERhdGEiLCJtYXJrZXJzVG9TaG93IiwiaWR4IiwibWFya2VyVG9TaG93IiwicG9wdXBDb250ZW50IiwiZ2V0UG9wdXAiLCJnZXRDb250ZW50IiwiZ2V0TGF0TG5nIiwibGF0IiwibG5nIiwiaW5jbHVkZXMiLCJuZXdQYXJhbSIsImNhbGxiYWNrIiwicmVpbml0TWFwIiwiUmVhY3QiLCJSZWFjdERPTSIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJDYXRlZ29yeSIsImN1c3RvbUNsaWNrRXZlbnQiLCJDb21wYW55RGV0YWlsIiwidXNlU3RhdGUiLCJjbGljayIsImNhbGN1bGF0ZURpc3RhbmNlIiwidXNlckxhdCIsInVzZXJMbmciLCJjb21wYW55TGF0IiwiY29tcGFueUxuZyIsInAiLCJjIiwiTWF0aCIsImNvcyIsImEiLCJkIiwicm91bmQiLCJhc2luIiwic3FydCIsImhhbmRsZUNsaWNrIiwidXNlQ2FsbGJhY2siLCJhZGRyZXNzIiwicGhvbmUiLCJ1cmx3ZWJzaXRlIiwiU3ViQ2F0ZWdvcnlEZXRhaWwiLCJjb21wYW5pZXMiLCJtYXAiLCJTdWJDYXRlZ29yeU1lbnUiLCJnZXRDb21wYW5pZXMiLCJjYXRJZCIsInMiLCJyZXRvdXIiLCJvbkNsaWNrIiwic3ViY2F0cyIsInN1YmNhdCIsIlNpZGVNZW51IiwiZGF0YUNhdGVnb3JpZXMiLCJnZXRDYXRlZ29yaWVzIiwiZGlzcGxheVN1YkNhdHMiLCJzZXRQYXJhbXMiLCJjYXRlZ29yaWVzIiwiZmlsdGVyIiwicGFyYW1zIiwiY2F0ZWdvcnkiLCJzdWJjYXRlZ29yaWVzIiwiaW5pdCJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBRUEsSUFBSUEsWUFBWSxHQUFHLEVBQW5CO0FBQ0EsSUFBSUMsZ0JBQWdCLEdBQUcsRUFBdkI7QUFDQSxJQUFJQyxZQUFKO0FBQ0EsSUFBSUMsVUFBVSxHQUFHLEVBQWpCO0FBQ0EsSUFBSUMsWUFBWSxHQUFHLENBQUMsWUFBRCxDQUFuQjs7SUFFTUMsTzs7Ozs7QUFFRixtQkFBWUMsS0FBWixFQUFtQjtBQUFBOztBQUFBOztBQUNmLDhCQUFNQSxLQUFOO0FBQ0EsVUFBS0MsS0FBTCxHQUFhO0FBQ1RDLG1CQUFhLEVBQUUsRUFETjtBQUVUQyxlQUFTLEVBQUUsQ0FBQyxZQUFELENBRkY7QUFHVEMsV0FBSyxFQUFFLEVBSEU7QUFJVEMsa0JBQVksRUFB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QUFRLG1CQUFPLENBQUMsdUVBQXFCO0FBQ3JDLFlBQVksbUJBQU8sQ0FBQyxxRUFBb0I7QUFDeEMsc0JBQXNCLG1CQUFPLENBQUMsNkZBQWdDO0FBQzlELHFDQUFxQyxzSkFBNEQ7QUFDakcsa0JBQWtCLG1CQUFPLENBQUMsaUZBQTBCOztBQUVwRCw2Q0FBNkMsbUNBQW1DLEVBQUU7QUFDbEY7O0FBRUE7QUFDQTtBQUNBLEdBQUcsbUVBQW1FO0FBQ3RFO0FBQ0E7QUFDQTtBQUNBLENBQUM7Ozs7Ozs7Ozs7O0FDZkQsUUFBUSxtQkFBTyxDQUFDLHVFQUFxQjtBQUNyQyxrQkFBa0IsbUJBQU8sQ0FBQyxpRkFBMEI7QUFDcEQsY0FBYyxtQkFBTyxDQUFDLDJFQUF1QjtBQUM3QyxzQkFBc0IsbUJBQU8sQ0FBQyw2RkFBZ0M7QUFDOUQscUNBQXFDLG1CQUFPLENBQUMsK0hBQWlEO0FBQzlGLHFCQUFxQixtQkFBTyxDQUFDLHlGQUE4Qjs7QUFFM0Q7QUFDQTtBQUNBLEdBQUcsbURBQW1EO0FBQ3REO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsQ0FBQzs7Ozs7Ozs7Ozs7OztBQ3ZCRCIsImZpbGUiOiJjb21wYW5pZXNfbWFwLmpzIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IFJlYWN0IGZyb20gJ3JlYWN0JztcclxuaW1wb3J0IFJlYWN0RE9NIGZyb20gJ3JlYWN0LWRvbSc7XHJcbmltcG9ydCB7U2lkZU1lbnV9IGZyb20gXCIuL3NpZGVNZW51XCI7XHJcbmltcG9ydCAnL2Fzc2V0cy9zdHlsZXMvY29tcGFueV9tYXAuc2Nzcyc7XHJcblxyXG5sZXQgYXJyYXlNYXJrZXJzID0gW107XHJcbmxldCBhcnJheUluaXRNYXJrZXJzID0gW107XHJcbmxldCBtYXJrZXJzTGF5ZXI7XHJcbmxldCBhcnJheVBhcmFtID0gW107XHJcbmxldCBhcnJheUNyaXRlcmUgPSBbJ2NhdGVnb3JpZXMnXTtcclxuXHJcbmNsYXNzIE1hcFBhZ2UgZXh0ZW5kcyBSZWFjdC5Db21wb25lbnQge1xyXG5cclxuICAgIGNvbnN0cnVjdG9yKHByb3BzKSB7XHJcbiAgICAgICAgc3VwZXIocHJvcHMpO1xyXG4gICAgICAgIHRoaXMuc3RhdGUgPSB7XHJcbiAgICAgICAgICAgIGRhdGFDb21wYW5pZXM6IFtdLFxyXG4gICAgICAgICAgICBjcml0ZXJpYXM6IFsnY2F0ZWdvcmllcyddLFxyXG4gICAgICAgICAgICBwYXJhbTogW10sXHJcbiAgICAgICAgICAgIHVzZXJMb2NhdGlvbjpbXVxyXG4gICAgICAgIH1cclxuXHJcblxyXG4gICAgICAgIHRoaXMuaW5pdE1hcCA9IHRoaXMuaW5pdE1hcC5iaW5kKHRoaXMpXHJcbiAgICAgICAgdGhpcy5nZXRDb21wYW5pZXNPbk1hcCA9IHRoaXMuZ2V0Q29tcGFuaWVzT25NYXAuYmluZCh0aGlzKVxyXG4gICAgICAgIHRoaXMuZmlsdHJhZ2UgPSB0aGlzLmZpbHRyYWdlLmJpbmQodGhpcylcclxuICAgICAgICB0aGlzLmZpbHRlclNob3dDb21wYW5pZXMgPSB0aGlzLmZpbHRlclNob3dDb21wYW5pZXMuYmluZCh0aGlzKVxyXG4gICAgICAgIHRoaXMucGxhY2VJbml0TWFya2VycyA9IHRoaXMucGxhY2VJbml0TWFya2Vycy5iaW5kKHRoaXMpXHJcbiAgICAgICAgdGhpcy5nZXRVc2VyTG9jYXRpb24gPSB0aGlzLmdldFVzZXJMb2NhdGlvbi5iaW5kKHRoaXMpXHJcbiAgICB9XHJcblxyXG4gICAgZ2V0Q29tcGFuaWVzT25NYXAoKXtcclxuICAgICAgICB0aGlzLnNldFN0YXRlKHtcclxuICAgICAgICAgICAgZGF0YUNvbXBhbmllczpbXVxyXG4gICAgICAgIH0pO1xyXG4gICAgICAgIGZldGNoKCcvcmVzdC9jb21wYW55Jywge1xyXG4gICAgICAgICAgICBtZXRob2Q6IFwiZ2V0XCIsXHJcbiAgICAgICAgICAgIGhlYWRlcjoge1xyXG4gICAgICAgICAgICAgICAgXCJDb250ZW50LVR5cGVcIjogXCJhcHBsaWNhdGlvbi9qc29uXCIsXHJcbiAgICAgICAgICAgICAgICBcIkFjY2VwdFwiOiBcImFwcGxpY2F0aW9uL2pzb25cIlxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICBjcmVkZW50aWFsczogJ3NhbWUtb3JpZ2luJ1xyXG5cclxuICAgICAgICB9KS50aGVuKHJlc3BvbnNlID0+IHtcclxuICAgICAgICAgICAgcmV0dXJuIHJlc3BvbnNlLmpzb24oKVxyXG4gICAgICAgIH0pLnRoZW4oZGF0YSA9PiB7XHJcbiAgICAgICAgICAgIHRoaXMuc2V0U3RhdGUoe1xyXG4gICAgICAgICAgICAgICAgICAgIGRhdGFDb21wYW5pZXM6IGRhdGFcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgKVxyXG4gICAgICAgICAgICAvL2NvbnNvbGUubG9nKCdvdWknKVxyXG4gICAgICAgICAgICB0aGlzLnBsYWNlSW5pdE1hcmtlcnMoKVxyXG4gICAgICAgICAgICBjb25zb2xlLmxvZyh0aGlzLnN0YXRlLmRhdGFDb21wYW5pZXMpXHJcblxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuXHJcblxyXG5cclxuICAgIHJlaW5pdE1hcCgpe1xyXG4gICAgICAgIGFycmF5TWFya2VycyA9IFtdO1xyXG5cclxuICAgICAgICBhcnJheUluaXRNYXJrZXJzLmZvckVhY2gobWFya2VyID0+IHtcclxuICAgICAgICAgICAgbWFya2Vyc0xheWVyLnJlbW92ZUxheWVyKG1hcmtlcik7XHJcbiAgICAgICAgICAgIG1hcmtlcnNMYXllci5hZGRMYXllcihtYXJrZXIpO1xyXG4gICAgICAgICAgICBhcnJheU1hcmtlcnMucHVzaChtYXJrZXIpO1xyXG4gICAgICAgIH0pXHJcblxyXG4gICAgICAgIGNvbnNvbGUubG9nKGFycmF5TWFya2VycylcclxuICAgIH1cclxuXHJcbiAgICBwbGFjZUluaXRNYXJrZXJzKCl7XHJcblxyXG4gICAgICAgIHRoaXMuc3RhdGUuZGF0YUNvbXBhbmllcy5mb3JFYWNoKChjb21wYW55LCBpKSA9PiB7XHJcbiAgICAgICAgICAgIHZhciBtYXJrZXIgPSBMLm1hcmtlcihbIGNvbXBhbnkubGF0aXR1ZGUsIGNvbXBhbnkubG9uZ3RpdHVkZSBdKTtcclxuICAgICAgICAgICAgbWFya2VyLmJpbmRQb3B1cChcIjxiPlwiICsgY29tcGFueS5uYW1lICsgXCI8L2I+XCIpLm9wZW5Qb3B1cCgpO1xyXG4gICAgICAgICAgICBtYXJrZXJzTGF5ZXIuYWRkTGF5ZXIobWFya2VyKTtcclxuICAgICAgICAgICAgYXJyYXlNYXJrZXJzLnB1c2gobWFya2VyKTtcclxuICAgICAgICAgICAgYXJyYXlJbml0TWFya2Vycy5wdXNoKG1hcmtlcik7XHJcbiAgICAgICAgfSlcclxuICAgICAgICBjb25zb2xlLmxvZyhhcnJheU1hcmtlcnMpXHJcbiAgICB9XHJcblxyXG4gICAgZ2V0VXNlckxvY2F0aW9uKGUpIHtcclxuXHJcbiAgICAgICAgdGhpcy5zZXRTdGF0ZSh7XHJcbiAgICAgICAgICAgIHVzZXJMb2NhdGlvbjogZS5sYXRsbmdcclxuICAgICAgICB9KVxyXG4gICAgfVxyXG5cclxuICAgIGluaXRNYXAoKSB7XHJcblxyXG4gICAgICAgIHZhciBteW1hcCA9IG5ldyBMLk1hcCgnbWFwJywge3pvb206IDExLCBjZW50ZXI6IG5ldyBMLmxhdExuZyg0Ni4xOTc0MDI1LDYuMTM1MDcxNSkgfSk7XHQvL3NldCBjZW50ZXIgZnJvbSBmaXJzdCBsb2NhdGlvblxyXG5cclxuICAgICAgICBteW1hcC5hZGRMYXllcihuZXcgTC5UaWxlTGF5ZXIoJ2h0dHA6Ly97c30udGlsZS5vcGVuc3RyZWV0bWFwLm9yZy97en0ve3h9L3t5fS5wbmcnKSk7XHQvL2Jhc2UgbGF5ZXJcclxuICAgICAgICBtYXJrZXJzTGF5ZXIgPSBuZXcgTC5MYXllckdyb3VwKCk7XHQvL2xheWVyIGNvbnRhaW4gc2VhcmNoZWQgZWxlbWVudHNcclxuXHJcbiAgICAgICAgbXltYXAuYWRkTGF5ZXIobWFya2Vyc0xheWVyKTtcclxuXHJcbiAgICAgICAgdmFyIGNvbnRyb2xTZWFyY2ggPSBuZXcgTC5Db250cm9sLlNlYXJjaCh7XHJcbiAgICAgICAgICAgIHBvc2l0aW9uOid0b3ByaWdodCcsXHJcbiAgICAgICAgICAgIGxheWVyOiBtYXJrZXJzTGF5ZXIsXHJcbiAgICAgICAgICAgIGluaXRpYWw6IGZhbHNlLFxyXG4gICAgICAgICAgICB6b29tOiAxMixcclxuICAgICAgICAgICAgbWFya2VyOiBmYWxzZVxyXG4gICAgICAgIH0pO1xyXG5cclxuICAgICAgICBteW1hcC5hZGRDb250cm9sKCBjb250cm9sU2VhcmNoICk7XHJcbiAgICAgICAgbXltYXAubG9jYXRlKCk7XHJcblxyXG4gICAgICAgIG15bWFwLm9uKCdsb2NhdGlvbmZvdW5kJywgdGhpcy5nZXRVc2VyTG9jYXRpb24pO1xyXG4gICAgfVxyXG5cclxuXHJcbiAgICBmaWx0cmFnZShsaXN0LCBhcnJheUNyaXRlcmUsIGFycmF5UGFyYW1ldGVyKXtcclxuXHJcbiAgICAgICAgLy9Ew6ljbGFyYXRpb24gZGUgbGEgbGlzdGUgZGVzIMOpbMOpbWVudHMgZmlsdHLDqXNcclxuICAgICAgICBsZXQgbmV3TGlzdCA9IFtdO1xyXG5cclxuICAgICAgICBsZXQgcmVzcGVjdENyaXRlcmVzO1xyXG4gICAgICAgIGxldCByZXNwZWN0UGFyYW1zO1xyXG5cclxuICAgICAgICAvL1BvdXIgY2hhcXVlIMOpbMOpbWVudCDDoCBmaWx0cmVyXHJcbiAgICAgICAgbGlzdC5mb3JFYWNoKGVsZW0gPT4ge1xyXG5cclxuICAgICAgICAgICAgcmVzcGVjdENyaXRlcmVzID0gdHJ1ZTtcclxuXHJcbiAgICAgICAgICAgIC8vT24gcGFyY291cnQgY2hhcXVlIGNyaXTDqHJlIGRlIGZpbHRyYWdlIChwYXIgZXhlbXBsZSBcImNhdGVnb3JpZXNcIilcclxuICAgICAgICAgICAgYXJyYXlDcml0ZXJlLmZvckVhY2goY3JpdGVyZSA9PiB7XHJcblxyXG4gICAgICAgICAgICAgICAgLy9PbiBwYXJjb3VydCBjaGFxdWUgcGFyYW3DqHRyZSAoPXZhbGV1cikgZGUgY2UgY3JpdMOocmUsIHBhciBleGVtcGxlIFwiYWRtaW5pc3RyYXRpb25cIlxyXG4gICAgICAgICAgICAgICAgYXJyYXlQYXJhbWV0ZXJbY3JpdGVyZV0uZm9yRWFjaChmaWx0ZXJQYXJhbSA9PiB7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIHJlc3BlY3RQYXJhbXMgPSBmYWxzZTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLy9PbiBwYXJjb3VydCBjaGFxdWUgcGFyYW3DqHRyZSBkdSBjcml0w6hyZSBkZSBsJ8OpbMOpbWVudCDDoCBmaWx0cmVyXHJcbiAgICAgICAgICAgICAgICAgICAgZWxlbVtjcml0ZXJlXS5mb3JFYWNoKGVsZW1QYXJhbSA9PiB7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAvL3NpIGwnw6lsw6ltZW50IHBvc3PDqGRlIHVuZSB2YWxldXIgY29ycmVzcG9uZGFudCBhdSBwYXJhbcOodHJlIGRlIGZpbHRyZSwgaWwgcmVzcGVjdGUgbGUgcGFyYW3DqHRyZVxyXG4gICAgICAgICAgICAgICAgICAgICAgICBpZihlbGVtUGFyYW0uaWQgPT09IGZpbHRlclBhcmFtKXtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHJlc3BlY3RQYXJhbXMgPSB0cnVlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfSlcclxuXHJcbiAgICAgICAgICAgICAgICB9KVxyXG4gICAgICAgICAgICAgICAgaWYoIXJlc3BlY3RQYXJhbXMpe1xyXG4gICAgICAgICAgICAgICAgICAgIHJlc3BlY3RDcml0ZXJlcyA9IGZhbHNlO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9KVxyXG4gICAgICAgICAgICBpZihyZXNwZWN0Q3JpdGVyZXMpe1xyXG4gICAgICAgICAgICAgICAgbmV3TGlzdCA9IFsuLi5uZXdMaXN0LCBlbGVtXTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICB9KVxyXG4gICAgICAgIHJldHVybiBuZXdMaXN0O1xyXG4gICAgfVxyXG5cclxuICAgIGZpbHRlclNob3dDb21wYW5pZXMoZGF0YSwgYXJyYXlDcml0ZXJlLCBhcnJheVBhcmFtZXRlcil7XHJcblxyXG4gICAgICAgIGNvbnN0IGZpbHRlcmVkRGF0YSA9IHRoaXMuZmlsdHJhZ2UoZGF0YSxhcnJheUNyaXRlcmUsYXJyYXlQYXJhbWV0ZXIpO1xyXG5cclxuICAgICAgICBsZXQgbWFya2Vyc1RvU2hvdyA9IFtdXHJcblxyXG4gICAgICAgIC8vT24gcGFyY291cnQgY2hhcXVlIG1hcmtlciBkZSBsYSBjYXJ0ZVxyXG4gICAgICAgIGFycmF5TWFya2Vycy5mb3JFYWNoKChtYXJrZXIsIGlkeCkgPT4ge1xyXG5cclxuICAgICAgICAgICAgbGV0IG1hcmtlclRvU2hvdyA9IGZhbHNlO1xyXG5cclxuICAgICAgICAgICAgLy8gb24gcsOpY3Vww6hyZSBsZSBub20gZGUgbCdlbnRyZXByaXNlIGVjcml0ZSBzdXIgbGUgcG9wdXBcclxuICAgICAgICAgICAgbGV0IHBvcHVwQ29udGVudCA9IG1hcmtlci5nZXRQb3B1cCgpLmdldENvbnRlbnQoKVxyXG5cclxuICAgICAgICAgICAgLy8gT24gcGFyY291cnQgY2hhcXVlIMOpbMOpbWVudCBkZXZhbnQgZXRyZSBhZmZpY2jDqVxyXG4gICAgICAgICAgICBmaWx0ZXJlZERhdGEuZm9yRWFjaCgoY29tcGFueSkgPT57XHJcblxyXG4gICAgICAgICAgICAgICAgLy8gU2kgbGUgbWFycXVldXIgZXQgbCdlbnRyZXByaXNlIGZpbHRyw6llIG9udCBsZXMgbWVtZXMgY29vcmRvbm7DqWVzIEdQUyBldCBsZSBtZW1lIG5vbSwgb24gZ2FyZGUgbGUgbWFycXVldXJcclxuICAgICAgICAgICAgICAgIGlmKGNvbXBhbnkubGF0aXR1ZGUgPT09IG1hcmtlci5nZXRMYXRMbmcoKS5sYXQgJiYgY29tcGFueS5sb25ndGl0dWRlID09PSBtYXJrZXIuZ2V0TGF0TG5nKCkubG5nICYmIHBvcHVwQ29udGVudC5pbmNsdWRlcyhjb21wYW55Lm5hbWUpKXtcclxuICAgICAgICAgICAgICAgICAgICBtYXJrZXJUb1Nob3cgPSB0cnVlO1xyXG4gICAgICAgICAgICAgICAgICAgIG1hcmtlcnNUb1Nob3cucHVzaChtYXJrZXIpXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0pXHJcbiAgICAgICAgICAgIC8vc2lub24gb24gbGUgc3VwcHJpbWVcclxuICAgICAgICAgICAgaWYoIW1hcmtlclRvU2hvdyl7XHJcbiAgICAgICAgICAgICAgICBtYXJrZXJzTGF5ZXIucmVtb3ZlTGF5ZXIobWFya2VyKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pXHJcbiAgICAgICAgLy8gT24gbWV0IMOgIGpvdXIgbGUgdGFibGVhdSBkZSBtYXJxdWV1cnMgcG91ciBsZXMgcG90ZW50aWVscyBwcm9jaGFpbnMgZmlsdHJhZ2VzID0+IFRvdWpvdXJzIHMnYXBwdXllciBzdXIgYXJyYXlNYXJrZXJzIHBvdXIgZmlsdHJlciBsZXMgbWFycXVldXJzXHJcbiAgICAgICAgYXJyYXlNYXJrZXJzID0gbWFya2Vyc1RvU2hvd1xyXG5cclxuICAgICAgICBjb25zb2xlLmxvZyhhcnJheU1hcmtlcnMpXHJcbiAgICB9XHJcblxyXG4gICAgY29tcG9uZW50RGlkTW91bnQoKSB7XHJcblxyXG4gICAgICAgIHRoaXMuaW5pdE1hcCgpXHJcbiAgICAgICAgdGhpcy5nZXRDb21wYW5pZXNPbk1hcCgpXHJcblxyXG4gICAgfVxyXG5cclxuXHJcbiAgICByZW5kZXIoKSB7XHJcblxyXG4gICAgICAgIHJldHVybiA8PlxyXG4gICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImZpbHRlci1iYXJcIj48L2Rpdj5cclxuICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJtYXAtY29udGVudFwiPlxyXG4gICAgICAgICAgICAgICAgPGRpdiBpZD1cInNpZGVtZW51XCI+XHJcbiAgICAgICAgICAgICAgICAgICAgPFNpZGVNZW51IGRhdGE9e3RoaXMuc3RhdGUuZGF0YUNvbXBhbmllc31cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgY3JpdGVyaWFzPXt0aGlzLnN0YXRlLmNyaXRlcmlhc31cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgc2V0UGFyYW1zPXsobmV3UGFyYW0sIGNhbGxiYWNrKSA9PiB0aGlzLnNldFN0YXRlKHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBwYXJhbTogbmV3UGFyYW1cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfSwgY2FsbGJhY2spfVxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICBwYXJhbXM9e3RoaXMuc3RhdGUucGFyYW19XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGZpbHRlcj17dGhpcy5maWx0ZXJTaG93Q29tcGFuaWVzfVxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpbml0PXt0aGlzLnJlaW5pdE1hcH1cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgdXNlckxvY2F0aW9uPXt0aGlzLnN0YXRlLnVzZXJMb2NhdGlvbn0vPlxyXG4gICAgICAgICAgICAgICAgPC9kaXY+XHJcblxyXG4gICAgICAgICAgICAgICAgPGRpdiBpZD1cIm1hcFwiPjwvZGl2PlxyXG4gICAgICAgICAgICA8L2Rpdj5cclxuICAgICAgICA8Lz5cclxuICAgIH1cclxufVxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuUmVhY3RET00ucmVuZGVyKDxNYXBQYWdlIC8+LCBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnd3JhcC1tYXAnKSk7XHJcblxyXG5cclxuXHJcblxyXG4iLCJpbXBvcnQgUmVhY3QsIHt1c2VDYWxsYmFjaywgdXNlU3RhdGV9IGZyb20gJ3JlYWN0JztcclxuXHJcblxyXG5jbGFzcyBDYXRlZ29yeSBleHRlbmRzIFJlYWN0LkNvbXBvbmVudCB7XHJcblxyXG5cclxuICAgIHJlbmRlcigpe1xyXG4gICAgICAgIHJldHVybiA8ZGl2IGNsYXNzTmFtZT1cImNhdGVnb3JpZVwiIG9uQ2xpY2s9e3RoaXMucHJvcHMuY3VzdG9tQ2xpY2tFdmVudH0+XHJcbiAgICAgICAgICAgIDxpbWcgc3JjPXtgL2ltYWdlcy9JY29uZXNfQ2F0ZWdvcmllcy8ke3RoaXMucHJvcHMubmFtZX0vJHt0aGlzLnByb3BzLm5hbWV9LnBuZ2B9IGFsdD17dGhpcy5wcm9wcy5uYW1lfS8+XHJcbiAgICAgICAgICAgIDxwPnt0aGlzLnByb3BzLm5hbWV9PC9wPlxyXG4gICAgICAgIDwvZGl2PlxyXG5cclxuICAgIH1cclxuXHJcbn1cclxuXHJcbmZ1bmN0aW9uIENvbXBhbnlEZXRhaWwoe2NvbXBhbnksaWR4LHVzZXJMb2NhdGlvbn0pIHtcclxuXHJcbiAgICBjb25zdCBbc3RhdGUsIHNldFN0YXRlXSA9IHVzZVN0YXRlKHtcclxuICAgICAgICBjbGljazogZmFsc2UsXHJcbiAgICB9KVxyXG5cclxuICAgIGNvbnN0IGNhbGN1bGF0ZURpc3RhbmNlID0gKHVzZXJMYXQsIHVzZXJMbmcsIGNvbXBhbnlMYXQsIGNvbXBhbnlMbmcpID0+IHtcclxuICAgICAgICB2YXIgcCA9IDAuMDE3NDUzMjkyNTE5OTQzMjk1OyAgICAvLyBNYXRoLlBJIC8gMTgwXHJcbiAgICAgICAgdmFyIGMgPSBNYXRoLmNvcztcclxuICAgICAgICB2YXIgYSA9IDAuNSAtIGMoKGNvbXBhbnlMYXQgLSB1c2VyTGF0KSAqIHApLzIgK1xyXG4gICAgICAgICAgICBjKHVzZXJMYXQgKiBwKSAqIGMoY29tcGFueUxhdCAqIHApICpcclxuICAgICAgICAgICAgKDEgLSBjKChjb21wYW55TG5nIC0gdXNlckxuZykgKiBwKSkvMjtcclxuXHJcbiAgICAgICAgdmFyIGQgPSBNYXRoLnJvdW5kKCAxMjc0MiAqIE1hdGguYXNpbihNYXRoLnNxcnQoYSkgKSAqIDEwKSAvIDEwOyAvLyAyICogUjsgUiA9IDYzNzEga21cclxuICAgICAgICBjb25zb2xlLmxvZygxMjc0MiAqIE1hdGguYXNpbihNYXRoLnNxcnQoYSkpKVxyXG4gICAgICAgIHJldHVybiBkXHJcbiAgICB9XHJcblxyXG4gICAgY29uc3QgaGFuZGxlQ2xpY2sgPSB1c2VDYWxsYmFjaygoKSA9PiB7XHJcbiAgICAgICAgbGV0IGNsaWNrID0gc3RhdGUuY2xpY2sgPyBmYWxzZSA6IHRydWVcclxuICAgICAgICBzZXRTdGF0ZSh7Y2xpY2s6Y2xpY2t9KVxyXG4gICAgfSlcclxuXHJcbiAgICByZXR1cm4gPGRpdiBjbGFzc05hbWU9XCJjb21wYW55Q29udGVudFwiPlxyXG4gICAgICAgIDxkaXYgY2xhc3NOYW1lPVwiY29tcGFueVRpdGxlXCIga2V5PXtpZHh9IG9uQ2xpY2s9e2hhbmRsZUNsaWNrfT5cclxuICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJpY29uTmFtZVwiPlxyXG4gICAgICAgICAgICAgICAgPHNwYW4gY2xhc3NOYW1lPVwicHVjZVwiPjwvc3Bhbj5cclxuICAgICAgICAgICAgICAgIDxpbWcgc3JjPVwiL2ltYWdlcy9TdWJjYXRlZ29yeS9wb3NpdGlvbi5wbmdcIiBhbHQ9XCJpY29uZSBwb3NpdGlvbiBHUFNcIi8+XHJcbiAgICAgICAgICAgICAgICA8aDQ+e2NvbXBhbnkubmFtZX08L2g0PlxyXG4gICAgICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgPHA+e2NhbGN1bGF0ZURpc3RhbmNlKHVzZXJMb2NhdGlvbi5sYXQsIHVzZXJMb2NhdGlvbi5sbmcsIGNvbXBhbnkubGF0aXR1ZGUsIGNvbXBhbnkubG9uZ3RpdHVkZSl9IGttPC9wPlxyXG4gICAgICAgIDwvZGl2PlxyXG4gICAgICAgIHtzdGF0ZS5jbGljayAmJiA8ZGl2IGNsYXNzTmFtZT1cImNvbXBhbnlEZXRhaWxcIj5cclxuICAgICAgICAgICAgPHAgY2xhc3NOYW1lPVwicEJvcmRlclwiPntjb21wYW55LmFkZHJlc3N9PC9wPlxyXG4gICAgICAgICAgICA8cCBjbGFzc05hbWU9XCJwQm9yZGVyXCI+e2NvbXBhbnkucGhvbmV9PC9wPlxyXG4gICAgICAgICAgICA8cCBjbGFzc05hbWU9XCJwQm9yZGVyXCI+e2NvbXBhbnkudXJsd2Vic2l0ZX08L3A+XHJcbiAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwieUFsbGVyXCI+XHJcbiAgICAgICAgICAgICAgICA8cD5ZIGFsbGVyPC9wPlxyXG4gICAgICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJpbWdZQWxsZXJcIj5cclxuICAgICAgICAgICAgICAgICAgICA8aW1nIHNyYz1cIi9pbWFnZXMvU3ViY2F0ZWdvcnkvcGlldG9uLnBuZ1wiIGFsdD1cInBpZXRvblwiLz5cclxuICAgICAgICAgICAgICAgICAgICA8aW1nIHNyYz1cIi9pbWFnZXMvU3ViY2F0ZWdvcnkvdmVsby5wbmdcIiBhbHQ9XCJ2ZWxvXCIvPlxyXG4gICAgICAgICAgICAgICAgICAgIDxpbWcgc3JjPVwiL2ltYWdlcy9TdWJjYXRlZ29yeS92b2l0dXJlLnBuZ1wiIGFsdD1cInZvaXR1cmVcIi8+XHJcbiAgICAgICAgICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgIDxwIGNsYXNzTmFtZT1cInBCb3JkZXIgcG9pbnRlclwiPkNhbGN1bGVyIHZvdHJlIGVtcHJlaW50ZSDDqWNvbG9naXF1ZTwvcD5cclxuICAgICAgICA8L2Rpdj59XHJcbiAgICA8L2Rpdj5cclxuXHJcbn1cclxuXHJcbmZ1bmN0aW9uIFN1YkNhdGVnb3J5RGV0YWlsKHByb3BzKSB7XHJcblxyXG4gICAgcmV0dXJuIDxkaXYgY2xhc3NOYW1lPVwic3ViY2F0RGV0YWlsXCI+XHJcbiAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJzdWJjYXRFbGVtZW50IGNsaWNrZWRcIj5cclxuICAgICAgICAgICAge3Byb3BzLm5hbWV9XHJcbiAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJjb21wYW55TGlzdFwiPlxyXG4gICAgICAgICAgICB7cHJvcHMuY29tcGFuaWVzLm1hcCgoY29tcGFueSxpZHgpID0+IHtcclxuICAgICAgICAgICAgICAgIHJldHVybiA8Q29tcGFueURldGFpbCBjb21wYW55PXtjb21wYW55fSBpZHg9e2lkeH0gdXNlckxvY2F0aW9uPXtwcm9wcy51c2VyTG9jYXRpb259Lz5cclxuICAgICAgICAgICAgfSl9XHJcbiAgICAgICAgPC9kaXY+XHJcbiAgICA8L2Rpdj5cclxuXHJcbn1cclxuXHJcbmZ1bmN0aW9uIFN1YkNhdGVnb3J5TWVudShwcm9wcykge1xyXG5cclxuICAgIGNvbnN0IFtzdGF0ZSwgc2V0U3RhdGVdID0gdXNlU3RhdGUoe1xyXG4gICAgICAgIGNvbXBhbmllczogW10sXHJcbiAgICAgICAgY2xpY2s6IGZhbHNlLFxyXG4gICAgICAgIG5hbWU6JydcclxuICAgIH0pXHJcblxyXG4gICAgY29uc3QgZ2V0Q29tcGFuaWVzID0gdXNlQ2FsbGJhY2soKGlkLGNhdElkKSA9PiB7XHJcbiAgICAgICAgZmV0Y2goYC9yZXN0L2NhdGVnb3J5LyR7Y2F0SWR9L3N1YmNhdGVnb3J5LyR7aWR9L2NvbXBhbmllc2AsIHtcclxuICAgICAgICAgICAgbWV0aG9kOiBcImdldFwiLFxyXG4gICAgICAgICAgICBoZWFkZXI6IHtcclxuICAgICAgICAgICAgICAgIFwiQ29udGVudC1UeXBlXCI6IFwiYXBwbGljYXRpb24vanNvblwiLFxyXG4gICAgICAgICAgICAgICAgXCJBY2NlcHRcIjogXCJhcHBsaWNhdGlvbi9qc29uXCJcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgY3JlZGVudGlhbHM6ICdzYW1lLW9yaWdpbidcclxuXHJcbiAgICAgICAgfSkudGhlbihyZXNwb25zZSA9PiB7XHJcbiAgICAgICAgICAgIHJldHVybiByZXNwb25zZS5qc29uKClcclxuICAgICAgICB9KS50aGVuKGRhdGEgPT4ge1xyXG4gICAgICAgICAgICAvL2NvbnNvbGUubG9nKGRhdGEpXHJcbiAgICAgICAgICAgIHNldFN0YXRlKHMgPT4gKFxyXG4gICAgICAgICAgICAgICAgey4uLnMsIGNvbXBhbmllczogZGF0YX0pXHJcbiAgICAgICAgICAgIClcclxuICAgICAgICB9KTtcclxuICAgIH0sIFtdKVxyXG5cclxuICAgIGNvbnN0IGhhbmRsZUNsaWNrID0gdXNlQ2FsbGJhY2soKGlkLCBuYW1lKSA9PiB7XHJcbiAgICAgICAgLy9jb25zb2xlLmxvZyhpZClcclxuICAgICAgICBnZXRDb21wYW5pZXMoaWQsIHByb3BzLmNhdElkKVxyXG4gICAgICAgIHNldFN0YXRlKHMgPT4gKHsuLi5zLCBjbGljazogdHJ1ZSwgbmFtZTogbmFtZX0pKVxyXG4gICAgfSxbXSlcclxuXHJcbiAgICBjb25zdCByZXRvdXIgPSB1c2VDYWxsYmFjaygoKSA9PiB7XHJcbiAgICAgICAgc2V0U3RhdGUocyA9PiAoey4uLnMsIGNsaWNrOiBmYWxzZX0pKVxyXG4gICAgfSlcclxuXHJcblxyXG4gICAgcmV0dXJuIDxkaXYgY2xhc3NOYW1lPVwic3ViY2F0ZWdvcnlfbWVudVwiPlxyXG4gICAgICAgIHshc3RhdGUuY2xpY2sgJiYgPHAgY2xhc3NOYW1lPVwicG9pbnRlclwiIG9uQ2xpY2s9e3Byb3BzLm9uQ2xpY2t9PiAmbHQ7IGxpc3RlIGRlcyBjYXTDqWdvcmllczwvcD59XHJcbiAgICAgICAge3N0YXRlLmNsaWNrICYmIDxwIGNsYXNzTmFtZT1cInBvaW50ZXJcIiBvbkNsaWNrPXtyZXRvdXJ9PiAmbHQ7IHtwcm9wcy5uYW1lfTwvcD59XHJcbiAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJtZW51X3RpdGxlXCI+XHJcbiAgICAgICAgICAgIDxpbWcgc3JjPXtgL2ltYWdlcy9JY29uZXNfQ2F0ZWdvcmllcy8ke3Byb3BzLm5hbWV9LyR7cHJvcHMubmFtZX0ucG5nYH0gYWx0PXtwcm9wcy5uYW1lfS8+XHJcbiAgICAgICAgICAgIDxoMz57cHJvcHMubmFtZX08L2gzPlxyXG4gICAgICAgIDwvZGl2PlxyXG4gICAgICAgIDxkaXYgY2xhc3NOYW1lPVwic3ViY2F0c1wiPlxyXG4gICAgICAgICAgICB7IXN0YXRlLmNsaWNrICYmIHByb3BzLnN1YmNhdHMubWFwKHN1YmNhdCA9PiB7XHJcbiAgICAgICAgICAgICAgICByZXR1cm4gPGRpdiBjbGFzc05hbWU9XCJzdWJjYXRFbGVtZW50XCIga2V5PXtzdWJjYXQuaWR9IG9uQ2xpY2s9eygpID0+IGhhbmRsZUNsaWNrKHN1YmNhdC5pZCwgc3ViY2F0Lm5hbWUpfT5cclxuICAgICAgICAgICAgICAgICAgICAgICAge3N1YmNhdC5uYW1lfVxyXG4gICAgICAgICAgICAgICAgICAgIDwvZGl2PlxyXG5cclxuICAgICAgICAgICAgfSl9XHJcbiAgICAgICAgPC9kaXY+XHJcbiAgICAgICAge3N0YXRlLmNsaWNrICYmIDxTdWJDYXRlZ29yeURldGFpbCBuYW1lPXtzdGF0ZS5uYW1lfSBjb21wYW5pZXM9e3N0YXRlLmNvbXBhbmllc30gdXNlckxvY2F0aW9uPXtwcm9wcy51c2VyTG9jYXRpb259Lz59XHJcblxyXG4gICAgPC9kaXY+XHJcbn1cclxuXHJcbmV4cG9ydCBjbGFzcyBTaWRlTWVudSBleHRlbmRzIFJlYWN0LkNvbXBvbmVudCB7XHJcblxyXG5cclxuICAgIGNvbnN0cnVjdG9yKHByb3BzKXtcclxuICAgICAgICBzdXBlcihwcm9wcylcclxuICAgICAgICB0aGlzLnN0YXRlID0ge1xyXG4gICAgICAgICAgICBkYXRhQ2F0ZWdvcmllczpbXSxcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIHRoaXMuZ2V0Q2F0ZWdvcmllcyA9IHRoaXMuZ2V0Q2F0ZWdvcmllcy5iaW5kKHRoaXMpXHJcbiAgICAgICAgdGhpcy5oYW5kbGVDbGljayA9IHRoaXMuaGFuZGxlQ2xpY2suYmluZCh0aGlzKVxyXG4gICAgfVxyXG5cclxuICAgIGdldENhdGVnb3JpZXMoKSB7XHJcbiAgICAgICAgdGhpcy5zZXRTdGF0ZSh7XHJcbiAgICAgICAgICAgIGRhdGFDYXRlZ29yaWVzOltdXHJcbiAgICAgICAgfSk7XHJcbiAgICAgICAgZmV0Y2goJy9nZXQtY2F0ZWdvcmllcy8nLCB7XHJcbiAgICAgICAgICAgIG1ldGhvZDogXCJnZXRcIixcclxuICAgICAgICAgICAgaGVhZGVyOiB7XHJcbiAgICAgICAgICAgICAgICBcIkNvbnRlbnQtVHlwZVwiOiBcImFwcGxpY2F0aW9uL2pzb25cIixcclxuICAgICAgICAgICAgICAgIFwiQWNjZXB0XCI6IFwiYXBwbGljYXRpb24vanNvblwiXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIGNyZWRlbnRpYWxzOiAnc2FtZS1vcmlnaW4nXHJcblxyXG4gICAgICAgIH0pLnRoZW4ocmVzcG9uc2UgPT4ge1xyXG4gICAgICAgICAgICByZXR1cm4gcmVzcG9uc2UuanNvbigpXHJcbiAgICAgICAgfSkudGhlbihkYXRhID0+IHtcclxuICAgICAgICAgICAgdGhpcy5zZXRTdGF0ZSh7XHJcbiAgICAgICAgICAgICAgICAgICAgZGF0YUNhdGVnb3JpZXM6IGRhdGFcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgKVxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIGNvbXBvbmVudERpZE1vdW50KCkge1xyXG4gICAgICAgIHRoaXMuZ2V0Q2F0ZWdvcmllcygpXHJcbiAgICB9XHJcblxyXG4gICAgaGFuZGxlQ2xpY2soaWQsIG5hbWUsIHN1YmNhdCkge1xyXG4gICAgICAgIHRoaXMuc2V0U3RhdGUoXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGlkOiBpZCxcclxuICAgICAgICAgICAgICAgIG5hbWU6IG5hbWUsXHJcbiAgICAgICAgICAgICAgICBzdWJjYXQ6IHN1YmNhdCxcclxuICAgICAgICAgICAgICAgIGRpc3BsYXlTdWJDYXRzOiB0cnVlXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICApXHJcblxyXG5cclxuICAgICAgICB0aGlzLnByb3BzLnNldFBhcmFtcyh7XHJcbiAgICAgICAgICAgIGNhdGVnb3JpZXM6IFtpZF1cclxuICAgICAgICB9LCAoKSA9PiB7XHJcbiAgICAgICAgICAgIHRoaXMucHJvcHMuZmlsdGVyKHRoaXMucHJvcHMuZGF0YSx0aGlzLnByb3BzLmNyaXRlcmlhcywgdGhpcy5wcm9wcy5wYXJhbXMpXHJcbiAgICAgICAgfSlcclxuXHJcbiAgICB9XHJcblxyXG4gICAgcmVuZGVyKCl7XHJcbiAgICAgICAgaWYoIXRoaXMuc3RhdGUuZGlzcGxheVN1YkNhdHMpIHtcclxuXHJcbiAgICAgICAgICAgIHJldHVybiAodGhpcy5zdGF0ZS5kYXRhQ2F0ZWdvcmllcy5tYXAoIGNhdGVnb3J5ID0+IHtcclxuICAgICAgICAgICAgICAgIHJldHVybiA8Q2F0ZWdvcnkgaWQ9e2NhdGVnb3J5LmlkfSBuYW1lPXtjYXRlZ29yeS5uYW1lfSBrZXk9e2NhdGVnb3J5LmlkfVxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjdXN0b21DbGlja0V2ZW50PXsoKSA9PiB0aGlzLmhhbmRsZUNsaWNrKGNhdGVnb3J5LmlkLCBjYXRlZ29yeS5uYW1lLCBjYXRlZ29yeS5zdWJjYXRlZ29yaWVzKX0vPlxyXG4gICAgICAgICAgICAgICAgfSlcclxuICAgICAgICAgICAgKVxyXG4gICAgICAgIH1cclxuICAgICAgICByZXR1cm4gKHRoaXMuc3RhdGUuZGlzcGxheVN1YkNhdHMgJiYgPFN1YkNhdGVnb3J5TWVudSBjYXRJZD17dGhpcy5zdGF0ZS5pZH0gbmFtZT17dGhpcy5zdGF0ZS5uYW1lfSBzdWJjYXRzPXt0aGlzLnN0YXRlLnN1YmNhdH0gb25DbGljaz17KCkgPT4ge3RoaXMucHJvcHMuaW5pdCgpOyB0aGlzLnNldFN0YXRlKHtkaXNwbGF5U3ViQ2F0czogZmFsc2V9KX19IGtleT17dGhpcy5zdGF0ZS5pZH0gdXNlckxvY2F0aW9uPXt0aGlzLnByb3BzLnVzZXJMb2NhdGlvbn0vPilcclxuICAgIH1cclxuXHJcbn1cclxuXHJcblxyXG5cclxuIiwiJ3VzZSBzdHJpY3QnO1xudmFyIHRvUHJpbWl0aXZlID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL3RvLXByaW1pdGl2ZScpO1xudmFyIGRlZmluZVByb3BlcnR5TW9kdWxlID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL29iamVjdC1kZWZpbmUtcHJvcGVydHknKTtcbnZhciBjcmVhdGVQcm9wZXJ0eURlc2NyaXB0b3IgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvY3JlYXRlLXByb3BlcnR5LWRlc2NyaXB0b3InKTtcblxubW9kdWxlLmV4cG9ydHMgPSBmdW5jdGlvbiAob2JqZWN0LCBrZXksIHZhbHVlKSB7XG4gIHZhciBwcm9wZXJ0eUtleSA9IHRvUHJpbWl0aXZlKGtleSk7XG4gIGlmIChwcm9wZXJ0eUtleSBpbiBvYmplY3QpIGRlZmluZVByb3BlcnR5TW9kdWxlLmYob2JqZWN0LCBwcm9wZXJ0eUtleSwgY3JlYXRlUHJvcGVydHlEZXNjcmlwdG9yKDAsIHZhbHVlKSk7XG4gIGVsc2Ugb2JqZWN0W3Byb3BlcnR5S2V5XSA9IHZhbHVlO1xufTtcbiIsInZhciBpc09iamVjdCA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9pcy1vYmplY3QnKTtcbnZhciBjbGFzc29mID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2NsYXNzb2YtcmF3Jyk7XG52YXIgd2VsbEtub3duU3ltYm9sID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL3dlbGwta25vd24tc3ltYm9sJyk7XG5cbnZhciBNQVRDSCA9IHdlbGxLbm93blN5bWJvbCgnbWF0Y2gnKTtcblxuLy8gYElzUmVnRXhwYCBhYnN0cmFjdCBvcGVyYXRpb25cbi8vIGh0dHBzOi8vdGMzOS5lcy9lY21hMjYyLyNzZWMtaXNyZWdleHBcbm1vZHVsZS5leHBvcnRzID0gZnVuY3Rpb24gKGl0KSB7XG4gIHZhciBpc1JlZ0V4cDtcbiAgcmV0dXJuIGlzT2JqZWN0KGl0KSAmJiAoKGlzUmVnRXhwID0gaXRbTUFUQ0hdKSAhPT0gdW5kZWZpbmVkID8gISFpc1JlZ0V4cCA6IGNsYXNzb2YoaXQpID09ICdSZWdFeHAnKTtcbn07XG4iLCIndXNlIHN0cmljdCc7XG52YXIgZ2V0QnVpbHRJbiA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9nZXQtYnVpbHQtaW4nKTtcbnZhciBkZWZpbmVQcm9wZXJ0eU1vZHVsZSA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9vYmplY3QtZGVmaW5lLXByb3BlcnR5Jyk7XG52YXIgd2VsbEtub3duU3ltYm9sID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL3dlbGwta25vd24tc3ltYm9sJyk7XG52YXIgREVTQ1JJUFRPUlMgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvZGVzY3JpcHRvcnMnKTtcblxudmFyIFNQRUNJRVMgPSB3ZWxsS25vd25TeW1ib2woJ3NwZWNpZXMnKTtcblxubW9kdWxlLmV4cG9ydHMgPSBmdW5jdGlvbiAoQ09OU1RSVUNUT1JfTkFNRSkge1xuICB2YXIgQ29uc3RydWN0b3IgPSBnZXRCdWlsdEluKENPTlNUUlVDVE9SX05BTUUpO1xuICB2YXIgZGVmaW5lUHJvcGVydHkgPSBkZWZpbmVQcm9wZXJ0eU1vZHVsZS5mO1xuXG4gIGlmIChERVNDUklQVE9SUyAmJiBDb25zdHJ1Y3RvciAmJiAhQ29uc3RydWN0b3JbU1BFQ0lFU10pIHtcbiAgICBkZWZpbmVQcm9wZXJ0eShDb25zdHJ1Y3RvciwgU1BFQ0lFUywge1xuICAgICAgY29uZmlndXJhYmxlOiB0cnVlLFxuICAgICAgZ2V0OiBmdW5jdGlvbiAoKSB7IHJldHVybiB0aGlzOyB9XG4gICAgfSk7XG4gIH1cbn07XG4iLCIndXNlIHN0cmljdCc7XG52YXIgJCA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9leHBvcnQnKTtcbnZhciBmYWlscyA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9mYWlscycpO1xudmFyIGlzQXJyYXkgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvaXMtYXJyYXknKTtcbnZhciBpc09iamVjdCA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9pcy1vYmplY3QnKTtcbnZhciB0b09iamVjdCA9IHJlcXVpcmUoJy4uL2ludGVybmFscy90by1vYmplY3QnKTtcbnZhciB0b0xlbmd0aCA9IHJlcXVpcmUoJy4uL2ludGVybmFscy90by1sZW5ndGgnKTtcbnZhciBjcmVhdGVQcm9wZXJ0eSA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9jcmVhdGUtcHJvcGVydHknKTtcbnZhciBhcnJheVNwZWNpZXNDcmVhdGUgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvYXJyYXktc3BlY2llcy1jcmVhdGUnKTtcbnZhciBhcnJheU1ldGhvZEhhc1NwZWNpZXNTdXBwb3J0ID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2FycmF5LW1ldGhvZC1oYXMtc3BlY2llcy1zdXBwb3J0Jyk7XG52YXIgd2VsbEtub3duU3ltYm9sID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL3dlbGwta25vd24tc3ltYm9sJyk7XG52YXIgVjhfVkVSU0lPTiA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9lbmdpbmUtdjgtdmVyc2lvbicpO1xuXG52YXIgSVNfQ09OQ0FUX1NQUkVBREFCTEUgPSB3ZWxsS25vd25TeW1ib2woJ2lzQ29uY2F0U3ByZWFkYWJsZScpO1xudmFyIE1BWF9TQUZFX0lOVEVHRVIgPSAweDFGRkZGRkZGRkZGRkZGO1xudmFyIE1BWElNVU1fQUxMT1dFRF9JTkRFWF9FWENFRURFRCA9ICdNYXhpbXVtIGFsbG93ZWQgaW5kZXggZXhjZWVkZWQnO1xuXG4vLyBXZSBjYW4ndCB1c2UgdGhpcyBmZWF0dXJlIGRldGVjdGlvbiBpbiBWOCBzaW5jZSBpdCBjYXVzZXNcbi8vIGRlb3B0aW1pemF0aW9uIGFuZCBzZXJpb3VzIHBlcmZvcm1hbmNlIGRlZ3JhZGF0aW9uXG4vLyBodHRwczovL2dpdGh1Yi5jb20vemxvaXJvY2svY29yZS1qcy9pc3N1ZXMvNjc5XG52YXIgSVNfQ09OQ0FUX1NQUkVBREFCTEVfU1VQUE9SVCA9IFY4X1ZFUlNJT04gPj0gNTEgfHwgIWZhaWxzKGZ1bmN0aW9uICgpIHtcbiAgdmFyIGFycmF5ID0gW107XG4gIGFycmF5W0lTX0NPTkNBVF9TUFJFQURBQkxFXSA9IGZhbHNlO1xuICByZXR1cm4gYXJyYXkuY29uY2F0KClbMF0gIT09IGFycmF5O1xufSk7XG5cbnZhciBTUEVDSUVTX1NVUFBPUlQgPSBhcnJheU1ldGhvZEhhc1NwZWNpZXNTdXBwb3J0KCdjb25jYXQnKTtcblxudmFyIGlzQ29uY2F0U3ByZWFkYWJsZSA9IGZ1bmN0aW9uIChPKSB7XG4gIGlmICghaXNPYmplY3QoTykpIHJldHVybiBmYWxzZTtcbiAgdmFyIHNwcmVhZGFibGUgPSBPW0lTX0NPTkNBVF9TUFJFQURBQkxFXTtcbiAgcmV0dXJuIHNwcmVhZGFibGUgIT09IHVuZGVmaW5lZCA/ICEhc3ByZWFkYWJsZSA6IGlzQXJyYXkoTyk7XG59O1xuXG52YXIgRk9SQ0VEID0gIUlTX0NPTkNBVF9TUFJFQURBQkxFX1NVUFBPUlQgfHwgIVNQRUNJRVNfU1VQUE9SVDtcblxuLy8gYEFycmF5LnByb3RvdHlwZS5jb25jYXRgIG1ldGhvZFxuLy8gaHR0cHM6Ly90YzM5LmVzL2VjbWEyNjIvI3NlYy1hcnJheS5wcm90b3R5cGUuY29uY2F0XG4vLyB3aXRoIGFkZGluZyBzdXBwb3J0IG9mIEBAaXNDb25jYXRTcHJlYWRhYmxlIGFuZCBAQHNwZWNpZXNcbiQoeyB0YXJnZXQ6ICdBcnJheScsIHByb3RvOiB0cnVlLCBmb3JjZWQ6IEZPUkNFRCB9LCB7XG4gIC8vIGVzbGludC1kaXNhYmxlLW5leHQtbGluZSBuby11bnVzZWQtdmFycyAtLSByZXF1aXJlZCBmb3IgYC5sZW5ndGhgXG4gIGNvbmNhdDogZnVuY3Rpb24gY29uY2F0KGFyZykge1xuICAgIHZhciBPID0gdG9PYmplY3QodGhpcyk7XG4gICAgdmFyIEEgPSBhcnJheVNwZWNpZXNDcmVhdGUoTywgMCk7XG4gICAgdmFyIG4gPSAwO1xuICAgIHZhciBpLCBrLCBsZW5ndGgsIGxlbiwgRTtcbiAgICBmb3IgKGkgPSAtMSwgbGVuZ3RoID0gYXJndW1lbnRzLmxlbmd0aDsgaSA8IGxlbmd0aDsgaSsrKSB7XG4gICAgICBFID0gaSA9PT0gLTEgPyBPIDogYXJndW1lbnRzW2ldO1xuICAgICAgaWYgKGlzQ29uY2F0U3ByZWFkYWJsZShFKSkge1xuICAgICAgICBsZW4gPSB0b0xlbmd0aChFLmxlbmd0aCk7XG4gICAgICAgIGlmIChuICsgbGVuID4gTUFYX1NBRkVfSU5URUdFUikgdGhyb3cgVHlwZUVycm9yKE1BWElNVU1fQUxMT1dFRF9JTkRFWF9FWENFRURFRCk7XG4gICAgICAgIGZvciAoayA9IDA7IGsgPCBsZW47IGsrKywgbisrKSBpZiAoayBpbiBFKSBjcmVhdGVQcm9wZXJ0eShBLCBuLCBFW2tdKTtcbiAgICAgIH0gZWxzZSB7XG4gICAgICAgIGlmIChuID49IE1BWF9TQUZFX0lOVEVHRVIpIHRocm93IFR5cGVFcnJvcihNQVhJTVVNX0FMTE9XRURfSU5ERVhfRVhDRUVERUQpO1xuICAgICAgICBjcmVhdGVQcm9wZXJ0eShBLCBuKyssIEUpO1xuICAgICAgfVxuICAgIH1cbiAgICBBLmxlbmd0aCA9IG47XG4gICAgcmV0dXJuIEE7XG4gIH1cbn0pO1xuIiwidmFyICQgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvZXhwb3J0Jyk7XG52YXIgYmluZCA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9mdW5jdGlvbi1iaW5kJyk7XG5cbi8vIGBGdW5jdGlvbi5wcm90b3R5cGUuYmluZGAgbWV0aG9kXG4vLyBodHRwczovL3RjMzkuZXMvZWNtYTI2Mi8jc2VjLWZ1bmN0aW9uLnByb3RvdHlwZS5iaW5kXG4kKHsgdGFyZ2V0OiAnRnVuY3Rpb24nLCBwcm90bzogdHJ1ZSB9LCB7XG4gIGJpbmQ6IGJpbmRcbn0pO1xuIiwidmFyICQgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvZXhwb3J0Jyk7XG52YXIgREVTQ1JJUFRPUlMgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvZGVzY3JpcHRvcnMnKTtcbnZhciBkZWZpbmVQcm9wZXJ0aWVzID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL29iamVjdC1kZWZpbmUtcHJvcGVydGllcycpO1xuXG4vLyBgT2JqZWN0LmRlZmluZVByb3BlcnRpZXNgIG1ldGhvZFxuLy8gaHR0cHM6Ly90YzM5LmVzL2VjbWEyNjIvI3NlYy1vYmplY3QuZGVmaW5lcHJvcGVydGllc1xuJCh7IHRhcmdldDogJ09iamVjdCcsIHN0YXQ6IHRydWUsIGZvcmNlZDogIURFU0NSSVBUT1JTLCBzaGFtOiAhREVTQ1JJUFRPUlMgfSwge1xuICBkZWZpbmVQcm9wZXJ0aWVzOiBkZWZpbmVQcm9wZXJ0aWVzXG59KTtcbiIsInZhciAkID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2V4cG9ydCcpO1xudmFyIGZhaWxzID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2ZhaWxzJyk7XG52YXIgdG9JbmRleGVkT2JqZWN0ID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL3RvLWluZGV4ZWQtb2JqZWN0Jyk7XG52YXIgbmF0aXZlR2V0T3duUHJvcGVydHlEZXNjcmlwdG9yID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL29iamVjdC1nZXQtb3duLXByb3BlcnR5LWRlc2NyaXB0b3InKS5mO1xudmFyIERFU0NSSVBUT1JTID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2Rlc2NyaXB0b3JzJyk7XG5cbnZhciBGQUlMU19PTl9QUklNSVRJVkVTID0gZmFpbHMoZnVuY3Rpb24gKCkgeyBuYXRpdmVHZXRPd25Qcm9wZXJ0eURlc2NyaXB0b3IoMSk7IH0pO1xudmFyIEZPUkNFRCA9ICFERVNDUklQVE9SUyB8fCBGQUlMU19PTl9QUklNSVRJVkVTO1xuXG4vLyBgT2JqZWN0LmdldE93blByb3BlcnR5RGVzY3JpcHRvcmAgbWV0aG9kXG4vLyBodHRwczovL3RjMzkuZXMvZWNtYTI2Mi8jc2VjLW9iamVjdC5nZXRvd25wcm9wZXJ0eWRlc2NyaXB0b3JcbiQoeyB0YXJnZXQ6ICdPYmplY3QnLCBzdGF0OiB0cnVlLCBmb3JjZWQ6IEZPUkNFRCwgc2hhbTogIURFU0NSSVBUT1JTIH0sIHtcbiAgZ2V0T3duUHJvcGVydHlEZXNjcmlwdG9yOiBmdW5jdGlvbiBnZXRPd25Qcm9wZXJ0eURlc2NyaXB0b3IoaXQsIGtleSkge1xuICAgIHJldHVybiBuYXRpdmVHZXRPd25Qcm9wZXJ0eURlc2NyaXB0b3IodG9JbmRleGVkT2JqZWN0KGl0KSwga2V5KTtcbiAgfVxufSk7XG4iLCJ2YXIgJCA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9leHBvcnQnKTtcbnZhciBERVNDUklQVE9SUyA9IHJlcXVpcmUoJy4uL2ludGVybmFscy9kZXNjcmlwdG9ycycpO1xudmFyIG93bktleXMgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvb3duLWtleXMnKTtcbnZhciB0b0luZGV4ZWRPYmplY3QgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvdG8taW5kZXhlZC1vYmplY3QnKTtcbnZhciBnZXRPd25Qcm9wZXJ0eURlc2NyaXB0b3JNb2R1bGUgPSByZXF1aXJlKCcuLi9pbnRlcm5hbHMvb2JqZWN0LWdldC1vd24tcHJvcGVydHktZGVzY3JpcHRvcicpO1xudmFyIGNyZWF0ZVByb3BlcnR5ID0gcmVxdWlyZSgnLi4vaW50ZXJuYWxzL2NyZWF0ZS1wcm9wZXJ0eScpO1xuXG4vLyBgT2JqZWN0LmdldE93blByb3BlcnR5RGVzY3JpcHRvcnNgIG1ldGhvZFxuLy8gaHR0cHM6Ly90YzM5LmVzL2VjbWEyNjIvI3NlYy1vYmplY3QuZ2V0b3ducHJvcGVydHlkZXNjcmlwdG9yc1xuJCh7IHRhcmdldDogJ09iamVjdCcsIHN0YXQ6IHRydWUsIHNoYW06ICFERVNDUklQVE9SUyB9LCB7XG4gIGdldE93blByb3BlcnR5RGVzY3JpcHRvcnM6IGZ1bmN0aW9uIGdldE93blByb3BlcnR5RGVzY3JpcHRvcnMob2JqZWN0KSB7XG4gICAgdmFyIE8gPSB0b0luZGV4ZWRPYmplY3Qob2JqZWN0KTtcbiAgICB2YXIgZ2V0T3duUHJvcGVydHlEZXNjcmlwdG9yID0gZ2V0T3duUHJvcGVydHlEZXNjcmlwdG9yTW9kdWxlLmY7XG4gICAgdmFyIGtleXMgPSBvd25LZXlzKE8pO1xuICAgIHZhciByZXN1bHQgPSB7fTtcbiAgICB2YXIgaW5kZXggPSAwO1xuICAgIHZhciBrZXksIGRlc2NyaXB0b3I7XG4gICAgd2hpbGUgKGtleXMubGVuZ3RoID4gaW5kZXgpIHtcbiAgICAgIGRlc2NyaXB0b3IgPSBnZXRPd25Qcm9wZXJ0eURlc2NyaXB0b3IoTywga2V5ID0ga2V5c1tpbmRleCsrXSk7XG4gICAgICBpZiAoZGVzY3JpcHRvciAhPT0gdW5kZWZpbmVkKSBjcmVhdGVQcm9wZXJ0eShyZXN1bHQsIGtleSwgZGVzY3JpcHRvcik7XG4gICAgfVxuICAgIHJldHVybiByZXN1bHQ7XG4gIH1cbn0pO1xuIiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307Il0sInNvdXJjZVJvb3QiOiIifQ==