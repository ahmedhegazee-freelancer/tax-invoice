import { Loader } from "@googlemaps/js-api-loader";
import { ref } from "vue";
let mapReport = null;
let marker = null;
export const coordinate = ref({
    lat: 25.286106,
    lng: 51.534817,
});
export const initializeMap = async () => {
    const loader = new Loader({
        apiKey: "AIzaSyBSji4f8rxgtuD-JnkBgm4jrIUaXkFDyCw",
        version: "weekly",
        libraries: ["places"],
    });

    const mapOptions = {
        center: {
            lat: coordinate.value.lat,
            lng: coordinate.value.lng,
        },
        zoom: 14,
        mapTypeId: "roadmap",
    };

    await loader
        .load()
        .then((google) => {
            mapReport = new google.maps.Map(
                document.getElementById("map"),
                mapOptions
            );
            placeMarker(mapOptions.center);
            google.maps.event.addListener(mapReport, "click", function (event) {
                placeMarker(event.latLng);
            });

            const input = document.getElementById("search_map");
            const searchBox = new google.maps.places.SearchBox(input);
            mapReport.addListener("bounds_changed", () => {
                searchBox.setBounds(mapReport.getBounds());
            });
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();
                console.log(places);
                if (places.length == 0) {
                    return;
                }
                marker.setMap(null);
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();

                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    placeMarker(place.geometry.location);
                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                mapReport.fitBounds(bounds);
            });
        })
        .catch((e) => {
            // do something
        });
};

export const placeMarker = (location) => {
    // markers.value.forEach((marker) => marker.setMap(null));
    if (marker != null) {
        marker.setPosition(null);
        marker.setMap(null);
        marker = null;
    }

    // console.log(location.lat());
    marker = new google.maps.Marker({
        position: location,
        map: mapReport,
    });
    // markers.push(marker);
    // long = document.getElementById('long');
    // lat = document.getElementById('lat');

    if (typeof location.lat == "function") {
        coordinate.value.lng = location.lng();
        coordinate.value.lat = location.lat();
    } else {
        coordinate.value.lng = location.lng;
        coordinate.value.lat = location.lat;
    }
    mapReport.setCenter(location);
};
