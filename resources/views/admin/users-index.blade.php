<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-l mt-14">
            <div class="w-full mb-4">
                <span class="text-center text-xl font-bold">Kelola Users</span>
            </div>
            <table class="w-full table-auto">
                <thead>
                    <tr class="text-white bg-slate-700">
                        <th class="py-2 px-4 border border-gray-400 text-center">Nama</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Email</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Nama Perusahaan</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Nama Pemilik</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Alamat</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Foto</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Rekening</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Status</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Password</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-slate-700">
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">Henry Carnegie</td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">henrycarnegie23@gmail.com</td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">PT. Jann Azzam Mandiri</td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">Henry Carnegie</td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">Jl. Sukarame 12, Bandar Lampung</td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">
                            <img src="{{ asset('images/logo.png') }}" alt="" class="w-10 h-10">
                        </td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">06102141</td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">
                            <span class="px-2 py-1 bg-green-300 text-green-800 text-sm rounded-lg">Aktif</span>
                        </td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">******</td>
                    </tr>
                    <tr class="text-slate-700">
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">Fadhil Firoos</td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">fadhilblue69@gmail.com</td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">PT. Merdeka Cipta</td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">Henry Carnegie</td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">Jl. Kecombrang 17, Bandar Lampung</td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">
                            <img src="{{ asset('images/logo.png') }}" alt="" class="w-10 h-10">
                        </td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">11520875</td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">
                            <span class="px-2 py-1 bg-green-300 text-green-800 text-sm rounded-lg">Aktif</span>
                        </td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">******</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
