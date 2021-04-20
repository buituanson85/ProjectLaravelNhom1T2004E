"use strict";

let map;
const chicago = {
    lat: -33.91721,
    lng: 151.22630
};
/**
 * The CenterControl adds a control to the map that recenters the map on
 * Chicago.
 */

class CenterControl {
    constructor(controlDiv, map, center) {
        this.map_ = map; // Set the center property upon construction

        this.center_ = new google.maps.LatLng(center);
        controlDiv.style.clear = "both"; // Set CSS for the control border

        const goCenterUI = document.createElement("div");
        goCenterUI.id = "goCenterUI";
        goCenterUI.title = "Click to recenter the map";
        controlDiv.appendChild(goCenterUI); // Set CSS for the control interior

        const goCenterText = document.createElement("div");
        goCenterText.id = "goCenterText";
        goCenterText.innerHTML = "Center Map";
        goCenterUI.appendChild(goCenterText); // Set CSS for the setCenter control border

        const setCenterUI = document.createElement("div");
        setCenterUI.id = "setCenterUI";
        setCenterUI.title = "Click to change the center of the map";
        controlDiv.appendChild(setCenterUI); // Set CSS for the control interior

        const setCenterText = document.createElement("div");
        setCenterText.id = "setCenterText";
        setCenterText.innerHTML = "Set Center";
        setCenterUI.appendChild(setCenterText); // Set up the click event listener for 'Center Map': Set the center of
        // the map
        // to the current center of the control.

        goCenterUI.addEventListener("click", () => {
            const currentCenter = this.center_;
            this.map_.setCenter(currentCenter);
        }); // Set up the click event listener for 'Set Center': Set the center of
        // the control to the current center of the map.

        setCenterUI.addEventListener("click", () => {
            const newCenter = this.map_.getCenter();
            this.center_ = newCenter;
        });
    }
}

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: chicago
    }); // Create the DIV to hold the control and call the CenterControl()
    // constructor passing in this DIV.

    const centerControlDiv = document.createElement("div");
    const control = new CenterControl(centerControlDiv, map, chicago);
    centerControlDiv.index = 1;
    centerControlDiv.style.paddingTop = "10px";
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(
        centerControlDiv
    );
    var iconBase =
        'https://developers.google.com/maps/documentation/javascript/examples/full/images/';

    var icons = {
        parking: {
            icon: iconBase + 'parking_lot_maps.png'
        },
        library: {
            icon: iconBase + 'library_maps.png'
        },
        info: {
            icon: iconBase + 'info-i_maps.png'
        }
    };

    var features = [
        {
            position: new google.maps.LatLng(-33.91721, 151.22630),
            type: 'info'
        }, {
            position: new google.maps.LatLng(-33.91539, 151.22820),
            type: 'info'
        }, {
            position: new google.maps.LatLng(-33.91747, 151.22912),
            type: 'info'
        }, {
            position: new google.maps.LatLng(-33.91910, 151.22907),
            type: 'info'
        }, {
            position: new google.maps.LatLng(-33.91725, 151.23011),
            type: 'info'
        }, {
            position: new google.maps.LatLng(-33.91872, 151.23089),
            type: 'info'
        }, {
            position: new google.maps.LatLng(-33.91784, 151.23094),
            type: 'info'
        }, {
            position: new google.maps.LatLng(-33.91682, 151.23149),
            type: 'info'
        }, {
            position: new google.maps.LatLng(-33.91790, 151.23463),
            type: 'info'
        }, {
            position: new google.maps.LatLng(-33.91666, 151.23468),
            type: 'info'
        }, {
            position: new google.maps.LatLng(-33.916988, 151.233640),
            type: 'info'
        }, {
            position: new google.maps.LatLng(-33.91662347903106, 151.22879464019775),
            type: 'parking'
        }, {
            position: new google.maps.LatLng(-33.916365282092855, 151.22937399734496),
            type: 'parking'
        }, {
            position: new google.maps.LatLng(-33.91665018901448, 151.2282474695587),
            type: 'parking'
        }, {
            position: new google.maps.LatLng(-33.919543720969806, 151.23112279762267),
            type: 'parking'
        }, {
            position: new google.maps.LatLng(-33.91608037421864, 151.23288232673644),
            type: 'parking'
        }, {
            position: new google.maps.LatLng(-33.91851096391805, 151.2344058214569),
            type: 'parking'
        }, {
            position: new google.maps.LatLng(-33.91818154739766, 151.2346203981781),
            type: 'parking'
        }, {
            position: new google.maps.LatLng(-33.91727341958453, 151.23348314155578),
            type: 'library'
        }
    ];

    // Create markers.
    for (var i = 0; i < features.length; i++) {
        var marker = new google.maps.Marker({
            position: features[i].position,
            icon: icons[features[i].type].icon,
            map: map
        });
    };
}