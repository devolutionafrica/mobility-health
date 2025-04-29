(function () {

    const longitude = document.getElementById('longitude');
    const latitude = document.getElementById('latitude');
    const dragMapVar = document.getElementById('dragMap');
    if (dragMapVar && longitude && latitude) {
        latitude.value = latitude.value.toString().trim() === "" ? "6.8059136" : latitude.value.toString().trim();
        longitude.value = longitude.value.toString().trim() === "" ? "-5.2461568" : longitude.value.toString().trim();
        navigator.geolocation.getCurrentPosition((position) => {
            latitude.value = position.coords.latitude;
            longitude.value = position.coords.longitude;
        });
        const draggableMap = L.map('dragMap').setView([parseFloat(latitude.value.toString()), parseFloat(longitude.value.toString())], 10);
        const markerLocation = L.marker([parseFloat(latitude.value.toString()), parseFloat(longitude.value.toString())], {
            draggable: 'true',
        }).addTo(draggableMap);
        markerLocation.bindPopup("<b>Tu es là!</b>").openPopup();
        L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
            maxZoom: 18
        }).addTo(draggableMap);
        markerLocation.on('dragend', function (event) {
            const marker = event.target;  // you could also simply access the marker through the closure
            const result = marker.getLatLng();  // but using the passed event is cleaner
            latitude.value = result.lat;
            longitude.value = result.lng;
        });

    }
})();
