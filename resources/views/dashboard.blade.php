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
                                    <td class="py-2 px-4 border border-gray-400 text-center">{{ $vendor->coordinatesVendor->nama_lokasi }}</td>
                                    <td class="py-2 px-4 border border-gray-400 text-center">{{ $vendor->name }}</td>
                                    <td class="py-2 px-4 border border-gray-400 text-center">{{ $vendor->coordinatesVendor->status }}</td>
                                    <td class="py-3 px-1 border border-gray-400 text-center">
                                        <span class="bg-indigo-100 ring-1 ring-indigo-600 hover:bg-indigo-600 hover:text-white transition-all px-4 py-2 rounded-lg text-sm text-slate-600 font-semibold cursor-pointer"
                                            {{-- @click="detailVendorOpen = true" --}}
                                            onclick="window.location.href = '{{ route('mapping.edit', $vendor->coordinatesVendor->uuid) }}'"
                                            >Detail</span>
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
                                                {{-- @click="detailVendorOpen = true" --}}
                                                onclick="window.location.href = '{{ route('mapping.edit', $coord->uuid) }}'"
                                                >Detail</span>
                                        </td>
                                    </tr>
                                @endforeach
                        @endrole
                    </tbody>
                </table>
                <!-- Modal -->
                <div x-show="detailVendorOpen"
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
                                <span>PT. Waskita Karya</span>
                            </div>
                            <div>
                                <span class="font-semibold">Email:</span>
                                <span>waskitakarya@gmail.com</span>
                            </div>
                            <div>
                                <span class="font-semibold">Nama Pemilik:</span>
                                <span>Fadhil Firoos</span>
                            </div>
                            <div>
                                <span class="font-semibold">Alamat:</span>
                                <span>Jl. Kemuning 3 Bandar Lampung, Lampung</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Chart.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const data = {
                labels: ['Ditolak', 'Sedang Dikerjakan', 'Diterima'],
                datasets: [{
                    label: 'Ditolak',
                    data: [8, 0, 0], // Data hanya untuk Ditolak
                    backgroundColor: '#F8BBD0',
                    borderColor: '#F06292',
                    borderWidth: 2,
                    borderRadius: 5
                }, {
                    label: 'Sedang Dikerjakan',
                    data: [0, 15, 0], // Data hanya untuk Sedang Dikerjakan
                    backgroundColor: '#FFF59D',
                    borderColor: '#FBC02D',
                    borderWidth: 2,
                    borderRadius: 5
                }, {
                    label: 'Diterima',
                    data: [0, 0, 10], // Data hanya untuk Diterima
                    backgroundColor: '#C8E6C9',
                    borderColor: '#81C784',
                    borderWidth: 2,
                    borderRadius: 5
                }]
            };

            // Konfigurasi Chart
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
                                text: 'Jumlah Perbaikan',
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
                                    size: 16,
                                    weight: 'bold'
                                }
                            },
                            onClick: function(e, legendItem, legend) {
                                // Dapatkan index dataset yang diklik
                                const index = legendItem.datasetIndex;
                                const chart = legend.chart;

                                // Toggle visibilitas dataset
                                const meta = chart.getDatasetMeta(index);
                                meta.hidden = meta.hidden === null ? !chart.data.datasets[index].hidden :
                                    null;
                                chart.update();
                            }
                        }
                    }
                }
            };

            // Render Chart
            const ctx = document.getElementById('statusChart').getContext('2d');
            new Chart(ctx, config);
        });
    </script>
</x-app-layout>
