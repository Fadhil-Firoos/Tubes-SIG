<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-l mt-14">
            <!-- Canvas untuk Chart -->
            <div class="w-full">
                <canvas id="statusChart" width="400" height="300"></canvas>
            </div>
            <div class="w-full mt-12">
                <div class="flex mb-4">
                    <span class="text-xl font-bold">Data Vendor</span>
                </div>
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-white bg-slate-700">
                            <th class="py-2 px-4 border border-gray-400 text-center">Nama Vendor</th>
                            <th class="py-2 px-4 border border-gray-400 text-center">Nama Proyek</th>
                            <th class="py-2 px-4 border border-gray-400 text-center">Lokasi Proyek</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-gray-700">
                            <td class="py-2 px-4 border border-gray-400 text-center">PT. Waskita Karya</td>
                            <td class="py-2 px-4 border border-gray-400 text-center">Perbaikan Jalan Sukarame</td>
                            <td class="py-2 px-4 border border-gray-400 text-center">Jalan sukarame no 4</td>
                        </tr>
                        <tr class="text-gray-700">
                            <td class="py-2 px-4 border border-gray-400 text-center">PT. Waskita Karya</td>
                            <td class="py-2 px-4 border border-gray-400 text-center">Perbaikan Jalan Sukarame</td>
                            <td class="py-2 px-4 border border-gray-400 text-center">Jalan sukarame no 12</td>
                        </tr>
                        <tr class="text-gray-700">
                            <td class="py-2 px-4 border border-gray-400 text-center">PT. Waskita Karya</td>
                            <td class="py-2 px-4 border border-gray-400 text-center">Perbaikan Jalan Sukarame</td>
                            <td class="py-2 px-4 border border-gray-400 text-center">Jalan sukarame no 12</td>
                        </tr>
                        <tr class="text-gray-700">
                            <td class="py-2 px-4 border border-gray-400 text-center">PT. Waskita Karya</td>
                            <td class="py-2 px-4 border border-gray-400 text-center">Perbaikan Jalan Sukarame</td>
                            <td class="py-2 px-4 border border-gray-400 text-center">Jalan sukarame no 12</td>
                        </tr>
                    </tbody>
                </table>
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
                data: [8, 0, 0],  // Data hanya untuk Ditolak
                backgroundColor: '#F8BBD0',
                borderColor: '#F06292',
                borderWidth: 2,
                borderRadius: 5
            }, {
                label: 'Sedang Dikerjakan',
                data: [0, 15, 0],  // Data hanya untuk Sedang Dikerjakan
                backgroundColor: '#FFF59D',
                borderColor: '#FBC02D',
                borderWidth: 2,
                borderRadius: 5
            }, {
                label: 'Diterima',
                data: [0, 0, 10],  // Data hanya untuk Diterima
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
                        onClick: function (e, legendItem, legend) {
                            // Dapatkan index dataset yang diklik
                            const index = legendItem.datasetIndex;
                            const chart = legend.chart;

                            // Toggle visibilitas dataset
                            const meta = chart.getDatasetMeta(index);
                            meta.hidden = meta.hidden === null ? !chart.data.datasets[index].hidden : null;
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
