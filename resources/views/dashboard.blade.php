<x-app-layout>
    <div class="p-4 sm:ml-64" x-data="{ detailVendorOpen: false }">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-l mt-14">
            <!-- Canvas untuk Chart -->
            <div class="w-full">
                <canvas id="statusChart" width="400" height="300"></canvas>
            </div>
            <div class="w-full mt-12">
                <div class="flex mb-4">
                    <span class="text-xl font-bold">
                        @role('admin')
                            Data Vendor
                        @else
                            Data Proyek
                        @endrole
                    </span>
                </div>
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-white bg-slate-700">
                            <th class="py-2 px-4 border border-gray-400 text-center tracking-wider">Lokasi Proyek</th>
                            <th class="py-2 px-4 border border-gray-400 text-center tracking-wider">
                                @role('admin')
                                    Nama Vendor
                                @else
                                    Tanggal Mulai
                                @endrole
                            </th>
                            <th class="py-2 px-4 border border-gray-400 text-center tracking-wider">Status</th>
                            <th class="py-2 px-4 border border-gray-400 text-center tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @role('admin')
                            @foreach ($vendors as $vendor)
                                <tr>
                                    <td class="py-2 px-4 border border-gray-400 text-center">{{ $vendor->coordinatesVendor ? $vendor->coordinatesVendor->nama_lokasi : 'NO DATA'}}</td>
                                    <td class="py-2 px-4 border border-gray-400 text-center">{{ $vendor->name }}</td>
                                    <td class="py-2 px-4 border border-gray-400 text-center">{{ $vendor->coordinatesVendor ? $vendor->coordinatesVendor->status : 'NO DATA'}}</td>
                                    <td class="py-3 px-1 border border-gray-400 text-center">
                                        @if ($vendor->coordinatesVendor)
                                            <span class="bg-indigo-100 ring-1 ring-indigo-600 hover:bg-indigo-600 hover:text-white transition-all px-4 py-2 rounded-lg text-sm text-slate-600 font-semibold cursor-pointer"
                                                onclick="window.location.href = '{{ route('mapping.edit', $vendor->coordinatesVendor->uuid) }}'"
                                                >Detail</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                                @foreach ($coordinates as $coord)
                                    <tr>
                                        <td class="py-2 px-4 border border-gray-400 text-center">{{ $coord->nama_lokasi }}</td>
                                        <td class="py-2 px-4 border border-gray-400 text-center">{{ $coord->tgl_start }}</td>
                                        <td class="py-2 px-4 border border-gray-400 text-center">{{ $coord->status }}</td>
                                        <td class="py-3 px-1 border border-gray-400 text-center">
                                            <span class="bg-indigo-100 ring-1 ring-indigo-600 hover:bg-indigo-600 hover:text-white transition-all px-4 py-2 rounded-lg text-sm text-slate-600 font-semibold cursor-pointer"
                                                onclick="window.location.href = '{{ route('mapping.edit', $coord->uuid) }}'"
                                                >Detail</span>
                                        </td>
                                    </tr>
                                @endforeach
                        @endrole
                    </tbody>
                </table>
                <!-- Modal -->
                {{-- <div x-show="detailVendorOpen"
                     class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center"
                     x-cloak>
                    <div class="bg-white w-full md:max-w-3xl ld:max-w-4xl mx-auto p-6 rounded-lg" @click.away="detailVendorOpen = false">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-bold">Detail Vendor</h2>
                            <button @click="detailVendorOpen = false" class="text-gray-500 hover:text-gray-800 font-bold text-2xl">
                                &times;
                            </button>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <span class="font-semibold">Nama Perusahaan:</span>
                                <span>{{ $vendor->name }}</span>
                            </div>
                            <div>
                                <span class="font-semibold">Email:</span>
                                <span>{{ $vendor->email }}</span>
                            </div>
                            <div>
                                <span class="font-semibold">Nama Pemilik:</span>
                                <span>{{ $vendor->nama_pemilik }}</span>
                            </div>
                            <div>
                                <span class="font-semibold">Alamat:</span>
                                <span>{{ $vendor->alamat }}</span>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Script untuk Chart.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusLabels = @json($statuses);
            const statusData = @json($statusCounts);

            const data = {
                labels: statusLabels,
                datasets: [{
                    label: 'Jumlah Status',
                    data: statusData,
                    backgroundColor: [
                        '#F8BBD0',
                        '#FFF59D',
                        '#C8E6C9',
                        '#B3E5FC',
                        '#FFCCBC'
                    ],
                    borderColor: [
                        '#F06292',
                        '#FBC02D',
                        '#81C784',
                        '#4FC3F7',
                        '#FF7043'
                    ],
                    borderWidth: 2,
                    borderRadius: 5
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Status',
                                font: {
                                    family: 'Inter',
                                    size: 14,
                                    weight: 'bold'
                                }
                            },
                            ticks: {
                                font: {
                                    family: 'Inter',
                                    size: 12
                                }
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    family: 'Inter',
                                    size: 12
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                color: '#4b5563',
                                font: {
                                    family: 'Inter',
                                    size: 12,
                                    weight: 'bold'
                                },
                                generateLabels: function(chart) {
                                    return chart.data.labels.map((label, index) => ({
                                        text: label,
                                        fillStyle: chart.data.datasets[0].backgroundColor[index],
                                        strokeStyle: chart.data.datasets[0].borderColor[index],
                                        lineWidth: chart.data.datasets[0].borderWidth
                                    }));
                                }
                            }
                        }
                    }
                }
            };

            const ctx = document.getElementById('statusChart').getContext('2d');
            new Chart(ctx, config);
        });
    </script>


</x-app-layout>
