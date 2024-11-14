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
            <button class="bg-blue-600 px-2 py-1 rounded-sm text-white" id="saveButton">Save Coordinates</button>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-5.37949832999664, 105.29666579508937], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Style function to define the line color and other styles
        function styleFeature(feature) {
            return {
                color: "#FF0000", // Red color
                weight: 3,         // Line thickness
                opacity: 0.6       // Line opacity
            };
        }

        // Hardcoded GeoJSON data
        const geojsonData = {"type":"FeatureCollection","features":[{"type":"Feature","properties":{},"geometry":{"coordinates":[[105.30571315751217,-5.358473875208773],[105.29277029795873,-5.367758128986651],[105.29272396996333,-5.367615910727238],[105.29237651000165,-5.36756209840469],[105.29210548734534,-5.368009455015596],[105.2917060855346,-5.367973950534974],[105.29128453854372,-5.368253167190957],[105.29114860263047,-5.36848237146458],[105.29112098500394,-5.368998308040361],[105.29100843153111,-5.369234019719741],[105.29034820252514,-5.369143201984102],[105.2897788982632,-5.36913474218521],[105.28947868099101,-5.3705897630942445],[105.28919827742351,-5.370471325888317],[105.28880316327223,-5.370369808530739],[105.2882635992824,-5.369682895537721],[105.28763108663355,-5.371011491495167],[105.28417078211851,-5.3714879764641665],[105.27655487145194,-5.372901992833903],[105.28513624160422,-5.381455755994622],[105.28312062405496,-5.382744005073604],[105.28165430384257,-5.382803527503967],[105.28163816612766,-5.389488591890441],[105.28220366602119,-5.3894690483018195],[105.28220085310966,-5.39021952833923]],"type":"LineString"}},{"type":"Feature","properties":{},"geometry":{"coordinates":[[105.2821980403483,-5.390223688676841],[105.28227679698068,-5.390573725943],[105.28258057211951,-5.391242996113988],[105.28276542782226,-5.391735290394749],[105.28273195144703,-5.391940124575697]],"type":"LineString"}},{"type":"Feature","properties":{},"geometry":{"coordinates":[[105.2827314875858,-5.391936856467694],[105.28288056263847,-5.3919536582135095],[105.28335035770459,-5.393238990349616],[105.28369568734627,-5.393306421928386],[105.28431217612558,-5.394357024471375],[105.28524203991589,-5.394233577150828],[105.2851182794945,-5.3936119145752315],[105.28631111998124,-5.393651517763857],[105.28655301534872,-5.39382233500983],[105.28679763980352,-5.393666480219238]],"type":"LineString"}},{"type":"Feature","properties":{},"geometry":{"coordinates":[[105.28679630096133,-5.393665370603159],[105.28728849144147,-5.393643911762467],[105.28740387545389,-5.393916943507122],[105.28890428664755,-5.393358147475865],[105.28973902628366,-5.3931502066801045],[105.2903001500452,-5.393149662961207],[105.29065853739519,-5.393510045871309],[105.29104643045616,-5.393624625466899],[105.29445484326118,-5.39331524786148],[105.29479609146011,-5.393494057030708],[105.29502359025872,-5.393261605100989],[105.29540692764544,-5.393165295880721],[105.29557455833958,-5.393427549375744],[105.29591580653852,-5.392998407233833],[105.29622792419099,-5.392889444876886],[105.29665084790173,-5.3928282009913175],[105.29789057217971,-5.3927975786666735],[105.29799053596639,-5.392828200611703],[105.2981135683188,-5.392965999347112],[105.29986699956612,-5.393142384338233],[105.3001284433148,-5.393167902611438],[105.30013745622858,-5.392976076232642],[105.30025536223155,-5.392866347614827],[105.30097328220086,-5.393248821324107],[105.30202470744308,-5.39328290536416],[105.30353531327466,-5.394353977321529],[105.31563042391264,-5.39424787963857],[105.32173309166541,-5.395906429321954],[105.32178400855264,-5.3958939491151625],[105.32187767683894,-5.395155147977761]],"type":"LineString"}},{"type":"Feature","properties":{},"geometry":{"coordinates":[[105.32187574469782,-5.395156959508739],[105.32160301062152,-5.394956887802508],[105.32163377010357,-5.394820104047469],[105.32160673155164,-5.394287264783415],[105.32171323713851,-5.391633551978288]],"type":"LineString"}},{"type":"Feature","properties":{},"geometry":{"coordinates":[[105.32171198011201,-5.391625746710531],[105.32196773162127,-5.391507530274922],[105.32172568053119,-5.390818619971682],[105.32181245336517,-5.390377581028673],[105.32165207555562,-5.388695315947899],[105.31562789988527,-5.387844047328841],[105.31574207466633,-5.387666721563278],[105.31671777066094,-5.3830387651437945],[105.31694612022176,-5.382615907965828],[105.31692785225698,-5.382374924710902],[105.31551337041151,-5.376061296365549]],"type":"LineString"}},{"type":"Feature","properties":{},"geometry":{"coordinates":[[105.3155294168916,-5.3760682698712685],[105.3102342177412,-5.374944952942755],[105.31016698085875,-5.373728852461767],[105.3095280781597,-5.373935333406848],[105.30843547880949,-5.374710736942319],[105.30832260422932,-5.369385101866314],[105.30825536734517,-5.369095020426343],[105.30802772164822,-5.361319583302176],[105.30540707341498,-5.361236226615873]],"type":"LineString"}},{"type":"Feature","properties":{},"geometry":{"coordinates":[[105.3054018785702,-5.361231054512132],[105.305336598932,-5.360616325395256],[105.30548414229781,-5.360459532699679]],"type":"LineString"}},{"type":"Feature","properties":{},"geometry":{"coordinates":[[105.3054807423913,-5.3604600635698745],[105.30552597611717,-5.359920905718468],[105.3054019488161,-5.359723329690922],[105.30570483747385,-5.3593403841612],[105.30587138842026,-5.3589875694456595],[105.30590345425139,-5.358637677483969],[105.3057144951236,-5.358471896625929]],"type":"LineString"}}]};

        // Add GeoJSON data to map
        L.geoJSON(geojsonData, {
            style: styleFeature,
            onEachFeature: function(feature, layer) {
                if (feature.properties && feature.properties.name) {
                    layer.bindPopup("<b>" + feature.properties.name + "</b>");
                }
            }
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
            if(pathCoordinates.length < 2) {
                alert('Please add at least two coordinates to save!');
                return;
            }
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
