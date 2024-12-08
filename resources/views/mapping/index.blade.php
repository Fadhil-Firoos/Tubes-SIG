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
    <div class="p-4 sm:ml-64" x-data="{ detailVendorOpen: false, editDetail: false, statusLaporan: ['Reported', 'Process', 'Rejected', 'Accepted'] }">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-l mt-14">
            <div id="map" class="z-0"></div>
            <div class="mt-4">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-white bg-slate-700">
                            <th class="py-2 px-4 border border-gray-400 text-center tracking-wider">Nama Vendor</th>
                            <th class="py-2 px-4 border border-gray-400 text-center tracking-wider">Nama Proyek</th>
                            <th class="py-2 px-4 border border-gray-400 text-center tracking-wider">Lokasi Proyek</th>
                            <th class="py-2 px-4 border border-gray-400 text-center tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-gray-700">
                            <td class="py-2 px-4 border border-gray-400 text-center">PT. Waskita Karya</td>
                            <td class="py-2 px-4 border border-gray-400 text-center">Perbaikan Jalan Sukarame</td>
                            <td class="py-2 px-4 border border-gray-400 text-center">Jalan sukarame no 4</td>
                            <td class="py-3 px-1 border border-gray-400 text-center">
                                <span
                                    class="bg-indigo-100 ring-1 ring-indigo-600 hover:bg-indigo-600 hover:text-white transition-all px-4 py-2 rounded-lg text-sm text-slate-600 font-semibold cursor-pointer"
                                    @click="detailVendorOpen = true">Detail</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Modal -->
                <div x-show="detailVendorOpen"
                    class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center" x-cloak x-transition>
                    <div class="bg-white w-full lg:max-w-max md:max-w-2xl h-fit max-h-[70%] md:max-h-[80%] lg:max-h-[70%] xl:max-h-[80%] mx-auto p-6 rounded-lg overflow-y-scroll"
                        @click.away="detailVendorOpen = false" @click.stop>
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-bold">Detail Vendor</h2>
                            <button @click="detailVendorOpen = false"
                                class="text-gray-500 hover:text-gray-800 font-bold text-2xl">
                                &times;
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 w-full gap-y-2 gap-x-8">
                            <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                <span class="w-full">Nama Proyek</span>
                                <span class="w-full text-base font-normal">: Perbaikan Jalan Sukarame</span>
                            </div>
                            <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                <span class="w-full">Nama Perusahaan</span>
                                <span class="w-full text-base font-normal">: PT. Waskita Karya</span>
                            </div>
                            <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                <span class="w-full">Lokasi Proyek</span>
                                <span class="w-full text-base font-normal">: Jl. Sukarame</span>
                            </div>
                            <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                <span class="w-full">Status</span>
                                <span class="w-full text-base font-normal">:
                                    <template x-if="statusLaporan.includes('Reported')">
                                        <span
                                            class="bg-gray-200 px-4 py-2 rounded-lg text-sm text-gray-800 font-semibold">Reported</span>
                                    </template>
                                    <template x-if="statusLaporan.includes('Process')">
                                        <span
                                            class="bg-amber-200 px-4 py-2 rounded-lg text-sm text-amber-800 font-semibold">Process</span>
                                    </template>
                                    <template x-if="statusLaporan.includes('Rejected')">
                                        <span
                                            class="bg-red-200 px-4 py-2 rounded-lg text-sm text-red-800 font-semibold">Rejected</span>
                                    </template>
                                    <template x-if="statusLaporan.includes('Accepted')">
                                        <span
                                            class="bg-emerald-200 px-4 py-2 rounded-lg text-sm text-emerald-800 font-semibold">Accepted</span>
                                    </template>
                                </span>
                            </div>
                            <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                <span class="w-full">Panjang Perbaikan</span>
                                <span class="w-full text-base font-normal">: 85 meter</span>
                            </div>
                            <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                <span class="w-full">Lebar Perbaikan</span>
                                <span class="w-full text-base font-normal">: 20 meter</span>
                            </div>
                            <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                <span class="w-full">Longitude Latitude</span>
                                <span class="w-full text-base font-normal">: {1.1234567890 , 2.1234567890}</span>
                            </div>
                            <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                <span class="w-full">Tanggal Mulai</span>
                                <span class="w-full text-base font-normal">: 17 November 2024</span>
                            </div>
                            <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                <span class="w-full">Tanggal Selesai</span>
                                <span class="w-full text-base font-normal">: 31 Desember 2024</span>
                            </div>
                            <form class="w-full md:col-span-2 space-y-2" x-show="editDetail" x-cloak x-transition>
                                <div class="col-span-2 py-2 text-center bg-amber-100 rounded-md">
                                    <span class="text-amber-800 text-lg font-semibold">Ubah data anda dibawah ini!</span>
                                </div>
                                <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                    <span class="w-full">Nama Proyek</span>
                                    <input type="text" id="" name=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="Masukan nama proyek" required />
                                </div>
                                <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                    <span class="w-full">Nama Perusahaan</span>
                                    <input type="text" id="" name=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="Masukan nama perusahaan" required />
                                </div>
                                <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                    <span class="w-full">Lokasi Proyek</span>
                                    <input type="text" id="" name=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="Masukan lokasi proyek" required />
                                </div>
                                <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                    <span class="w-full">Panjang Perbaikan</span>
                                    <input type="text" id="" name=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="Masukan panjang perbaikan" required />
                                </div>
                                <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                    <span class="w-full">Lebar Perbaikan</span>
                                    <input type="text" id="" name=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="Masukan lebar perbaikan" required />
                                </div>
                                <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                    <span class="w-full">Longitude Latitude</span>
                                    <input type="text" id="" name=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="Masukan longitude latitude" required />
                                </div>
                                <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                    <span class="w-full">Tanggal Mulai</span>
                                    <input type="date" id="" name=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="Masukan tanggal mulai" required />
                                </div>
                                <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                    <span class="w-full">Tanggal Selesai</span>
                                    <input type="date" id="" name=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                        placeholder="Masukan tanggal selesai" required />
                                </div>
                            </form>
                            <template x-if="statusLaporan.includes('Rejected')">
                                <div class="col-span-1 md:col-span-2 flex justify-end text-base font-medium w-full">
                                    <button type="button" class="bg-blue-600 px-4 py-2 rounded-lg text-white text-base font-semibold" @click="editDetail = true">
                                        Edit
                                    </button>
                                </div>
                            </template>
                            <template x-if="editDetail">
                                <div class="col-span-1 md:col-span-2 flex justify-end text-base font-medium w-full">
                                    <button type="submit" class="bg-blue-600 px-4 py-2 rounded-lg text-white text-base font-semibold" @click="editDetail = !editDetail">
                                        Simpan
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
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
        @foreach ($coordinates as $coordinate)
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
