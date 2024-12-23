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
        <div class="flex items-center justify-center mb-4">
            <span class="text-xl font-bold">Edit Laporan</span>
        </div>
        <div>
            <div class="p-2 border-2 border-gray-200 border-dashed rounded-lg mt-3">
                <div id="map" class="rounded-lg z-0"></div>
            </div>
            <div class="p-2 border-2 border-gray-200 border-dashed rounded-xl mt-7">
                <div class="col-span-full">
                    <label for="cover-photo" class="block text-sm/6 font-medium">Cover photo</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-200/25 px-6 py-10">
                        <div class="text-center">
                            <!-- Tempat untuk preview gambar -->
                            <div id="preview-container" class="mt-4 flex place-content-center">
                                <img id="preview-image" src="{{$coordinate->foto}}" alt="Preview" class="lg:w-96 rounded-lg" />
                                <img id="preview-image" src="" alt="Preview" class="lg:w-96 rounded-lg hidden" />
                            </div>

                                <div class="mt-4 flex justify-center items-center text-sm/6 text-gray-500">
                                    <label for="file-upload" class="relative cursor-pointer rounded-md text-black hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                    </label>
                                    <!-- <p class="pl-1">or drag and drop</p> -->
                                </div>
                                <p class="text-xs/5 text-gray-500">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <label for="widthMaintenance" class="block text-sm/6 font-medium">Lebar Perbaikan (Meter)</label>
                    <div class="mt-2">
                        <input id="widthMaintenance"
                        value="{{ $coordinate->lebar_perbaikan }}"
                        name="widthMaintenance" type="number" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                        @if (auth()->user()->hasRole('admin') && $coordinate->status == 'reported')
                            @readonly(true)
                        @endif>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <label for="lengthMaintenance" class="block text-sm/6 font-medium">Panjang Perbaikan (Meter)</label>
                    <div class="mt-2">
                        <input id="lengthMaintenance"
                        value="{{ $coordinate->panjang_perbaikan }}"
                        name="lengthMaintenance" type="number" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                        @if (auth()->user()->hasRole('admin') && $coordinate->status == 'reported')
                            @readonly(true)
                        @endif>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <label for="location" class="block text-sm/6 font-medium">Lokasi Pengerjaan</label>
                    <div class="mt-2">
                        <input id="lokasi_pengerjaan"
                        value="{{ $coordinate->nama_lokasi }}"
                        name="lokasi_pengerjaan" type="text" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                        @if (auth()->user()->hasRole('admin') && $coordinate->status == 'reported')
                            @readonly(true)
                        @endif>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <label for="companyName" class="block text-sm/6 font-medium">Nama Perusahaan</label>
                    <div class="mt-2">
                        <input id="companyName"
                        value="{{ $coordinate->nama_company }}" disabled
                        name="companyName" type="text" class="block w-full disabled:bg-gray-500 disabled:text-black rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                        @if (auth()->user()->hasRole('admin') && $coordinate->status == 'reported')
                            @readonly(true)
                        @endif>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <label for="startDate" class="block text-sm/6 font-medium" >Tanggal Mulai</label>
                    <input id="startDate"
                    value="{{ date('Y-m-d', strtotime($coordinate->tgl_start)) }}"
                    name="startDate" type="date" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                        @if (auth()->user()->hasRole('admin') && $coordinate->status == 'reported')
                            @readonly(true)
                        @endif>
                </div>

                @if ($coordinate->status == 'reported' || $coordinate->status == 'finish' && Auth::user()->hasRole('admin'))
                    <div class="sm:col-span-4">
                        <label for="status" class="block text-sm/6 font-medium">Status</label>
                        <select id="status" name="status" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                            <option value="reported" {{ $coordinate->status == 'reported' ? 'selected' : '' }}>Reported</option>
                            <option value="process" {{ $coordinate->status == 'process' ? 'selected' : '' }}>Process</option>
                            <option value="rejected" {{ $coordinate->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            @if($coordinate->status == 'finish')
                            <option value="accepted" {{ $coordinate->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            @endif
                        </select>
                    </div>

                    <div class="flex items-center justify-center pt-7">
                        <button class="bg-blue-600 px-4 py-4 rounded-lg text-white" id="saveButton">Save Coordinates</button>
                    </div>

                @elseif ($coordinate->status == 'process' && auth()->user()->hasRole('vendor'))
                    <input type="hidden" id="status" value="finish">
                    <div class="flex items-center justify-center pt-7">
                        <button class="bg-blue-600 px-4 py-4 rounded-lg text-white" id="saveButton">Save Coordinates</button>
                    </div>
                @elseif ($coordinate->status == 'rejected' && auth()->user()->hasRole('vendor'))
                    <input type="hidden" id="status" value="reported">
                    <div class="flex items-center justify-center pt-7">
                        <button class="bg-blue-600 px-4 py-4 rounded-lg text-white" id="saveButton">Save Coordinates</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize map
        var map = L.map('map').setView([-5.37949832999664, 105.29666579508937], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© Geopala',
        }).addTo(map);

        // Normalize pathCoordinates from the database
        var pathCoordinates = {!! json_encode($coordinate->longlat) !!};

        // Convert to array format if needed
        pathCoordinates = pathCoordinates.map(coord =>
            Array.isArray(coord) ? coord : [coord.lat, coord.lng]
        );

        // Render the polyline with markers
        var polyline = L.polyline(pathCoordinates, {
            color: 'blue',
            weight: 4,
            opacity: 0.7
        }).addTo(map);

        var markers = [];

        // Render existing points as markers
        pathCoordinates.forEach((coord, index) => {
            var marker = L.marker(coord, { draggable: true }).addTo(map);
            markers.push(marker);

            // Handle marker deletion on click
            marker.on('click', function () {
                map.removeLayer(marker);
                markers.splice(index, 1);
                updatePolyline();
            });

            // Handle marker dragging
            marker.on('drag', function () {
                updatePolyline();
            });
        });

        // Function to update the polyline when markers are added, moved, or removed
        function updatePolyline() {
            var updatedCoords = markers.map(marker => [marker.getLatLng().lat, marker.getLatLng().lng]);
            polyline.setLatLngs(updatedCoords);
        }

        // Add new markers and update the polyline on map click
        map.on('click', function (e) {
            var marker = L.marker([e.latlng.lat, e.latlng.lng], { draggable: true }).addTo(map);
            markers.push(marker);
            updatePolyline();

            // Handle marker deletion on click
            marker.on('click', function () {
                map.removeLayer(marker);
                markers = markers.filter(m => m !== marker);
                updatePolyline();
            });

            // Handle marker dragging
            marker.on('drag', function () {
                updatePolyline();
            });
        });

        // File upload functionality
        document.getElementById('file-upload').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
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

        // Save updated polyline and form data to the database
        document.getElementById('saveButton').addEventListener('click', function () {
            // Ensure there are enough coordinates
            if (markers.length < 2) {
                alert('Please add at least two coordinates to save!');
                return;
            }

            // Get Base64 image string
            const base64String = this.dataset.imageBase64;

            // Collect updated coordinates in the desired format
            const updatedCoords = markers.map(marker => [marker.getLatLng().lat, marker.getLatLng().lng]);

            // Collect form data
            const widthMaintenance = document.getElementById('widthMaintenance').value;
            const lengthMaintenance = document.getElementById('lengthMaintenance').value;
            const location = document.getElementById('lokasi_pengerjaan').value;
            const companyName = document.getElementById('companyName').value;
            const startDate = document.getElementById('startDate').value;
            const status = document.getElementById('status').value;

            // Send data to the backend
            fetch(`{{ route('mapping.update', $uuid) }}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for security
                },
                body: JSON.stringify({
                    longlat: updatedCoords,
                    fileUpload: base64String || null,
                    widthMaintenance: widthMaintenance,
                    lengthMaintenance: lengthMaintenance,
                    location: location,
                    companyName: companyName,
                    startDate: startDate,
                    status: status
                })
            }).then(response => {
                if (response.ok) {
                    alert('Coordinates saved successfully!');
                    window.location.href = '{{ route("mapping.index") }}';
                } else {
                    alert('Failed to save coordinates. Please try again!');
                }
            });
        });

    </script>
</x-app-layout>
