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
    <div class="p-4 md:ml-64" x-data="{ detailVendorOpen: false, editDetail: false, statusLaporan: ['Reported', 'Process', 'Rejected', 'Accepted'] }">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-l mt-14">
            <form method="GET" action="{{ url()->current() }}" id="query-form" class="my-3 flex max-md:flex-col gap-4 md:gap-10">
                <!-- Status Dropdown -->
                <div>
                    <label for="status">Status:</label>
                    <select name="status" id="status" onchange="updateQuery()">
                        <option value="">Select Status</option>
                        <option value="reported" {{ request('status') === 'reported' ? 'selected' : '' }}>Reported</option>
                        <option value="process" {{ request('status') === 'process' ? 'selected' : '' }}>Process</option>
                        <option value="finish" {{ request('status') === 'finish' ? 'selected' : '' }}>Finish</option>
                        <option value="accepted" {{ request('status') === 'accepted' ? 'selected' : '' }}>Accepted</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <!-- Start Date Input -->
                <div>
                    <label for="start_date">Start Date:</label>
                    <input
                        type="datetime-local"
                        name="start_date"
                        id="start_date"
                        value="{{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('Y-m-d\TH:i') : '' }}"
                        onchange="updateQuery()"
                    >
                </div>
            </form>
            <div id="map" class="rounded-lg z-0"></div>
            <div class="mt-4 overflow-x-scroll">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-white bg-slate-700">
                            <th class="py-2 px-4 border border-gray-400 text-center tracking-wider">Nama Vendor</th>
                            <th class="py-2 px-4 border border-gray-400 text-center tracking-wider">Lokasi Proyek</th>
                            <th class="py-2 px-4 border border-gray-400 text-center tracking-wider">Status</th>
                            <th class="py-2 px-4 border border-gray-400 text-center tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coordinates as $coord)
                            <tr class="text-gray-700">
                                <td class="py-2 px-4 border border-gray-400 text-center">{{ $coord->nama_company }}</td>
                                <td class="py-2 px-4 border border-gray-400 text-center">{{ $coord->nama_lokasi }}</td>
                                <td class="py-2 px-4 border border-gray-400 text-center">

                                    @if ($coord->status == 'accepted')
                                        <span
                                            class="bg-emerald-200 px-4 py-2 rounded-lg text-sm text-emerald-800 font-semibold">Accepted</span>
                                    @elseif ($coord->status == 'rejected')
                                        <span
                                            class="bg-red-200 px-4 py-2 rounded-lg text-sm text-red-800 font-semibold">Rejected</span>
                                    @elseif ($coord->status == 'finish')
                                        <span
                                            class="bg-amber-200 px-4 py-2 rounded-lg text-sm text-amber-800 font-semibold">Finish</span>
                                    @elseif ($coord->status == 'process')
                                        <span
                                            class="bg-amber-200 px-4 py-2 rounded-lg text-sm text-amber-800 font-semibold">Process</span>
                                    @elseif ($coord->status == 'reported')
                                        <span
                                            class="bg-gray-200 px-4 py-2 rounded-lg text-sm text-gray-800 font-semibold">Reported</span>
                                    @endif
                                </td>
                                <td class="py-3 px-1 border border-gray-400 text-center">
                                    <span
                                        class="bg-indigo-100 ring-1 ring-indigo-600 hover:bg-indigo-600 hover:text-white transition-all px-4 py-2 rounded-lg text-sm text-slate-600 font-semibold cursor-pointer mr-2"
                                        @click="detailVendorOpen = true"
                                        >
                                        Detail
                                    </span>
                                    @if ($coord->status == 'rejected' && auth()->user()->hasRole('vendor'))
                                        <span
                                        class="bg-red-100 ring-1 ring-red-600 hover:bg-red-600 hover:text-white transition-all px-4 py-2 rounded-lg text-sm text-slate-600 font-semibold cursor-pointer"
                                        onclick="window.location.href = '{{ route('mapping.edit', $coord->uuid) }}'"
                                        >
                                        Edit
                                        </span>
                                    @elseif ($coord->status == 'process' && auth()->user()->hasRole('vendor'))
                                        <span
                                        class="bg-red-100 ring-1 ring-red-600 hover:bg-red-600 hover:text-white transition-all px-4 py-2 rounded-lg text-sm text-slate-600 font-semibold cursor-pointer"
                                        onclick="window.location.href = '{{ route('mapping.edit', $coord->uuid) }}'"
                                        >
                                        Request Finish
                                        </span>
                                    @endif
                                    @if ($coord->status == 'reported' && auth()->user()->hasRole('admin'))
                                        <span
                                        class="bg-red-100 ring-1 ring-red-600 hover:bg-red-600 hover:text-white transition-all px-4 py-2 rounded-lg text-sm text-slate-600 font-semibold cursor-pointer"
                                        onclick="window.location.href = '{{ route('mapping.edit', $coord->uuid) }}'"
                                        >
                                        Review
                                        </span>
                                    @elseif ($coord->status == 'finish' && auth()->user()->hasRole('admin'))
                                        <span
                                        class="bg-red-100 ring-1 ring-red-600 hover:bg-red-600 hover:text-white transition-all px-4 py-2 rounded-lg text-sm text-slate-600 font-semibold cursor-pointer"
                                        onclick="window.location.href = '{{ route('mapping.edit', $coord->uuid) }}'"
                                        >
                                        Review
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Modal -->
                @foreach ($coordinates as $coord)
                    <div x-show="detailVendorOpen"
                        class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center" x-cloak x-transition>
                        <div class="bg-white w-[50%] lg:max-w-max md:max-w-2xl h-fit max-h-[70%] md:max-h-[80%] lg:max-h-[70%] xl:max-h-[80%] mx-auto p-6 rounded-lg overflow-y-auto"
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
                                    <span class="w-full">Nama Perusahaan</span>
                                    <span class="w-full text-base font-normal">: {{ $coord->nama_company }}</span>
                                </div>
                                <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                    <span class="w-full">Lokasi Proyek</span>
                                    <span class="w-full text-base font-normal">: {{ $coord->nama_lokasi }}</span>
                                </div>
                                <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                    <span class="w-full">Status</span>
                                    <span class="w-full text-base font-normal">:
                                        @if ($coord->status == 'accepted')
                                            <span
                                                class="bg-emerald-200 px-4 py-2 rounded-lg text-sm text-emerald-800 font-semibold">Accepted</span>
                                        @elseif ($coord->status == 'rejected')
                                            <span
                                                class="bg-red-200 px-4 py-2 rounded-lg text-sm text-red-800 font-semibold">Rejected</span>
                                        @elseif ($coord->status == 'finish')
                                            <span
                                                class="bg-amber-200 px-4 py-2 rounded-lg text-sm text-amber-800 font-semibold">Finish</span>
                                        @elseif ($coord->status == 'process')
                                            <span
                                                class="bg-amber-200 px-4 py-2 rounded-lg text-sm text-amber-800 font-semibold">Process</span>
                                        @elseif ($coord->status == 'reported')
                                            <span
                                                class="bg-gray-200 px-4 py-2 rounded-lg text-sm text-gray-800 font-semibold">Reported</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                    <span class="w-full">Panjang Perbaikan</span>
                                    <span class="w-full text-base font-normal">: {{ $coord->panjang_perbaikan }} meter</span>
                                </div>
                                <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                    <span class="w-full">Lebar Perbaikan</span>
                                    <span class="w-full text-base font-normal">: {{ $coord->lebar_perbaikan }} meter</span>
                                </div>
                                <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                    <span class="w-full">Longitude Latitude</span>
                                    <span class="w-full text-base font-normal">:
                                        {{ implode(' | ', array_map(fn($point) => implode(', ', $point), $coord->longlat)) }}
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                    <span class="w-full">Tanggal Mulai</span>
                                    <span class="w-full text-base font-normal">: {{ $coord->tgl_start }}</span>
                                </div>
                                <div class="grid grid-cols-2 md:flex text-base font-medium w-full">
                                    <span class="w-full">Tanggal Selesai</span>
                                    <span class="w-full text-base font-normal">: {{ ($coord->tgl_end != null) ? $coord->tgl_end : '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-5.37949832999664, 105.29666579508937], 13.5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© Geopala'
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

        function updateQuery() {
            const form = document.getElementById('query-form');
            const url = new URL(window.location.href);
            const status = document.getElementById('status').value;
            const startDate = document.getElementById('start_date').value;

            if (status) {
                url.searchParams.set('status', status);
            } else {
                url.searchParams.delete('status');
            }

            if (startDate) {
                url.searchParams.set('start_date', startDate);
            } else {
                url.searchParams.delete('start_date');
            }

            window.location.href = url.toString();
        }
    </script>
</x-app-layout>
