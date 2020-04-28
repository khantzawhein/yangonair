var map = L.map('mapid').setView([16.806292, 96.1562634], 13);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1Ijoia2hhbnR6YXdoZWluIiwiYSI6ImNrOWd3cHN2YTA0bDMzZXJ1eTJvbHhydTAifQ.jK1-XAaW9JFdLXTk2iTYcA'
}).addTo(map);

var myIcon = L.Icon.extend({
    options: {
        iconUrl : '',
        shadowUrl : null,
        iconSize: new L.Point(25, 41),
		iconAnchor: new L.Point(13, 41),
		popupAnchor: new L.Point(6, -40),
        number: '',
        className: 'leaflet-icon'
    }, 

    createIcon: function () {
    var container = document.createElement('div');
    var img = this._createImg(this.options['iconUrl']);
    var text_container = document.createElement('div')
    container.setAttribute('class', 'container_icon');
    img.setAttribute('class', 'bgforicon');
    container.appendChild(img);
    text_container.setAttribute('class', 'text_container');
    container.appendChild(text_container);
    var text = document.createElement('div');
    text.setAttribute('class', 'text');
    text_container.appendChild(text);
    text.innerHTML = this.options['number'];
    this._setIconStyles(container, 'icon');
    return container;
    }
    });

