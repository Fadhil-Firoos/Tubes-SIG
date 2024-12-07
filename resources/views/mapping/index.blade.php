<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mapping') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-l mt-14">
            <div id="map"></div>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-5.37949832999664, 105.29666579508937], 13.5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Style function for GeoJSON data
        function styleFeature(feature) {
            return {
                color: "#FF0000",
                weight: 3,
                opacity: 0.6
            };
        }

        const geojsonData = {!! $geoJson !!};

        // Add GeoJSON data to the map and disable selection
        const geojsonLayer = L.geoJSON(geojsonData, {
            style: styleFeature,
            interactive: false // Disable interaction to prevent selection
        }).addTo(map);

        // Load data from Laravel and create a line
        @foreach($coordinates as $coordinate)
            var points = {!! json_encode($coordinate->longlat) !!};
            var locationName = "{{ $coordinate->nama_lokasi }}";
            var status = "{{ $coordinate->status }}";
            var url = "{{ $coordinate->uuid }}";

            // Create a polyline from the points
            var polyline = L.polyline(points, {
                color: "#000",
                weight: 5,
                opacity: 1
            }).addTo(map);

            polyline.bindPopup(`
                <strong>Location Name:</strong> ${locationName}<br>
                <strong>Status:</strong> ${status}<br>
                <a href="/mapping/edit/${url}" target="_blank">More Info</a>
            `);
        @endforeach
    </script>
</x-app-layout>
