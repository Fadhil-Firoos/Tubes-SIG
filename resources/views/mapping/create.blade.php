<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <div id="map"></div>
    <button id="saveButton">Save Coordinates</button>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([51.505, -0.09], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Array to store coordinates and markers
        var pathCoordinates = [];
        var markers = [];

        // Function to add a marker on the map and store its coordinates
        map.on('click', function(e) {
            var coord = [e.latlng.lat, e.latlng.lng];
            pathCoordinates.push(coord);

            // Create a marker and add it to the map
            var marker = L.marker(coord).addTo(map);
            markers.push(marker);

            // Bind a click event to the marker to handle deletion
            marker.on('click', function() {
                // Remove the marker from the map
                map.removeLayer(marker);

                // Remove the coordinates from the array
                var index = pathCoordinates.findIndex(function(point) {
                    return point[0] === coord[0] && point[1] === coord[1];
                });

                if (index !== -1) {
                    pathCoordinates.splice(index, 1);
                    markers.splice(index, 1);
                }
            });
        });

        // Function to save coordinates to the database
        document.getElementById('saveButton').addEventListener('click', function() {
            // Make a POST request to your Laravel backend
            fetch(`{{ route('mapping.store') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for security
                },
                body: JSON.stringify({ longlat: pathCoordinates })
            })
            .then(response => response.json())
            .then(data => alert('Coordinates saved successfully!'))
            .catch(error => console.error('Error:', error));
            console.log(pathCoordinates);
        });
    </script>
</x-app-layout>
