
function initialiseMap() {
    // initialise
    const map = L.map('map');
    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    tiles.addTo(map);
    return map;
}

function showCityOnMap(map) {

    // show city on map
    const latitude = parseFloat(document.querySelector('.lat').textContent);
    const longitude = parseFloat(document.querySelector('.lon').textContent);

    map.setView([latitude, longitude], 8);

    // marker w/ custom icon
    const customIcon = L.icon({
        iconUrl: 'resources/utopia_smiley.png',
        iconSize: [16, 16],
        iconAnchor: [10, 10]
    });

    // Create and add marker to the map
    const marker = L.marker([latitude, longitude], {icon: customIcon});
    marker.addTo(map);
}

function toggleMap() {
    const mapContainer = document.querySelector('.map-container');
    const checkbox = document.getElementById('toggle-map');

    if (checkbox.checked) {
        mapContainer.style.display = 'block';
        showCityOnMap(initialiseMap());
    } else {
        mapContainer.style.display = 'none';
    }
}

function main() {
    toggleMap();
    document.getElementById('toggle-map').addEventListener('change', toggleMap);
}

window.onload = main;
