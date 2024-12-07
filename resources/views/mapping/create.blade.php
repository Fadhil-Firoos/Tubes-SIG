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
    <div class="p-4 mt-14 sm:ml-64">
        <!-- <div class="flex items-center justify-center">
            <h3 class="text-2xl font-bold">BUAT LAPORAN </h3>
        </div> -->
        <div class="flex items-center justify-center mb-4">
            <span class="text-xl font-bold">Buat Laporan</span>
        </div>
        <div>
            <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-3">
                <div id="map" class="rounded-lg z-0"></div>
            </div>
            <div class="px-6 py-2 border-2 border-gray-200 border-dashed rounded-xl mt-7 grid grid-cols-1 gap-y-3.5">
                <div class="">
                    <label for="cover-photo" class="block text-base font-medium after:content-['*'] after:ml-0.5 after:text-red-500">Cover photo</label>
                    <div class="mt-1 flex justify-center rounded-lg bg-slate-200 border border-dashed border-gray-800 px-6 py-10">
                        <div class="text-center">
                            <svg id="input-image" class="mx-auto size-12  text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill="#6366f1" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 716.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                            </svg>
                            <!-- Tempat untuk preview gambar -->
                            <div id="preview-container" class="mt-4">
                                <img id="preview-image" src="" alt="Preview" class="lg:w-96 rounded-lg hidden" />
                            </div>
                            <div class="mt-4 flex justify-center items-center text-sm text-gray-500">
                                <label for="file-upload" class="relative cursor-pointer rounded-md text-black hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2">
                                    <span class="text-xl font-bold">Upload Foto</span>
                                    <input id="file-upload" name="file-upload" type="file" class="sr-only" required>
                                </label>
                                <!-- <p class="pl-1">or drag and drop</p> -->
                            </div>
                            <p class="text-xs font-medium text-gray-500">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <label for="widthMaintenance" class="block text-base font-medium after:content-['*'] after:ml-0.5 after:text-red-500">Lebar Perbaikan (Meter)</label>
                    <div class="mt-1">
                        <input id="widthMaintenance" name="widthMaintenance" type="number" placeholder="Masukan lebar perbaikan" class="placeholder:text-sm block w-full rounded-md border-0 py-2 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm">
                    </div>
                </div>
                <div class="">
                    <label for="lengthMaintenance" class="block text-base font-medium after:content-['*'] after:ml-0.5 after:text-red-500">Panjang Perbaikan (Meter)</label>
                    <div class="mt-1">
                        <input id="lengthMaintenance" name="lengthMaintenance" type="number" placeholder="Masukan panjang perbaikan" class="placeholder:text-sm block w-full rounded-md border-0 py-2 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm">
                    </div>
                </div>
                <div class="">
                    <label for="location" class="block text-base font-medium after:content-['*'] after:ml-0.5 after:text-red-500">Lokasi Pengerjaan</label>
                    <div class="mt-1">
                        <input id="lokasi_pengerjaan" name="lokasi_pengerjaan" type="text" placeholder="Masukan lokasi pengerjaan" class="placeholder:text-sm block w-full rounded-md border-0 py-2 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm">
                    </div>
                </div>
                <div class="">
                    <label for="companyName" class="block text-base font-medium after:content-['*'] after:ml-0.5 after:text-red-500">Nama Perusahaan</label>
                    <div class="mt-1">
                        <input id="companyName"
                        value="{{ Auth::user()->name }}" disabled
                        name="companyName" type="text" placeholder="Masukan lebar perbaikan" class="placeholder:text-sm block w-full disabled:bg-gray-400 disabled:text-slate-800 rounded-md border-0 py-2 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                    </div>
                </div>
                <div class="">
                    <label for="startDate" class="block text-base font-medium after:content-['*'] after:ml-0.5 after:text-red-500">Tanggal Mulai</label>
                    <input id="startDate" name="startDate" type="date" placeholder="Masukan lebar perbaikan" class="placeholder:text-sm block w-full rounded-md border-0 py-2 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm">
                </div>
                <div class="flex items-center justify-end pt-7">
                    <button class="bg-blue-600 px-4 py-2 rounded-lg text-white text-base font-semibold" id="saveButton">Simpan Koordinat</button>
                </div>
            </div>
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

        const geojsonData = {!! $geoJson !!};

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

        document.getElementById('file-upload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const base64String = e.target.result.split(',')[1]; // Get only the base64 part
                    console.log("Base64 Image String:", base64String);

                    // Attach the Base64 string to the button's dataset for upload
                    document.getElementById('saveButton').dataset.imageBase64 = base64String;

                    const previewImage = document.getElementById('preview-image');
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');

                    document.getElementById('input-image').classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Function to save coordinates to the database
        document.getElementById('saveButton').addEventListener('click', function() {
            // Make a POST request to your Laravel backend
            if(pathCoordinates.length < 2) {
                alert('Please add at least two coordinates to save!');
                return;
            }
            const base64String = this.dataset.imageBase64;

            if (!base64String) {
                alert('Please select an image first!');
                return;
            }

            fetch(`{{ route('mapping.store') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for security
                },
                body: JSON.stringify({
                    longlat: pathCoordinates,
                    fileUpload : base64String,
                    widthMaintenance: document.getElementById('widthMaintenance').value,
                    lengthMaintenance: document.getElementById('lengthMaintenance').value,
                    location: document.getElementById('lokasi_pengerjaan').value,
                    companyName: document.getElementById('companyName').value,
                    startDate: document.getElementById('startDate').value
                })
            })
            .then(response => response.json())
            .then(data => alert('Coordinates saved successfully!'))
            // .catch(error => console.error('Error:', error)); change to alert error message max 1000 character
            .catch(error => alert('Error:',  error.message.substring(0, 1000)));
            console.log(pathCoordinates);
        });
    </script>
</x-app-layout>
