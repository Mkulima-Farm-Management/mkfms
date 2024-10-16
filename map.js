var map = L.map('map').setView([0, 0], 2); // Default view at world level, adjust as needed

// Add a base map layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19, // Adjust maxZoom as needed
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var marker;

function geocodeAndDisplay() {
    var address = document.getElementById('addressInput').value;

    // Use Nominatim geocoder from OpenStreetMap
    var geocoder = L.Control.Geocoder.nominatim();
    geocoder.geocode(address, function(results) {
        if (results.length > 0) {
            var latlng = results[0].center;
            map.setView(latlng, 16); // Zoom level 16, adjust as needed

            // Clear previous markers if any
            if (typeof marker !== 'undefined') {
                map.removeLayer(marker);
            }

            // Add marker and popup
            marker = L.marker(latlng).addTo(map);
            marker.bindPopup(`<b>${results[0].name}</b><br>${results[0].display_name}`).openPopup();
        } else {
            alert('Address not found.');
        }
    });
}
