<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-l mt-14">
            <div class="w-full mb-4">
                <span class="text-center text-xl font-bold">Kelola Users</span>
            </div>
            <table class="w-full table-auto">
                <thead>
                    <tr class="text-white bg-slate-700">
                        <th class="py-2 px-4 border border-gray-400 text-center">Nama Perusahaan</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Email</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Nama Pemilik</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Alamat</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Foto</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Rekening</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Status</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Password</th>
                        <th class="py-2 px-4 border border-gray-400 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr class="text-slate-700">
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">
                            {{ $item->name }}
                        </td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">{{ $item->email }}</td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">
                            {{ $item->vendor->nama_pemilik }}
                        </td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">
                            {{ $item->vendor->alamat }}
                        </td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">
                            <img src="{{ asset('storage/' . $item->vendor->image_users) ?? asset('images/logo.png') }}"
                                 alt="" class="w-10 h-10">
                        </td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">
                            {{ $item->vendor->rekening }}
                        </td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">
                            <span class="px-2 py-1 {{ ($item->status == true ? 'bg-green-300 text-green-800' : 'bg-red-300 text-red-800') }} text-sm rounded-lg">{{ $item->status == true ? 'Aktif' : 'Tidak Aktif' }}</span>
                        </td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">******</td>
                        <td class="py-2 px-4 border border-gray-400 text-center text-sm">
                            @if ($item->status == 1)
                                <a href="{{ route('admin.users-non-active', $item->id) }}" class="px-2 py-1 bg-red-300 text-red-800 text-sm rounded-lg">Nonaktifkan</a>
                            @elseif ($item->status == 0)
                            <a href="{{ route('admin.users-activate', $item->id) }}" class="px-2 py-1 bg-green-300 text-green-800 text-sm rounded-lg">Aktifkan</a>
                            @endif
                            <a href="{{ route('admin.users-edit', $item->id) }}" class="px-2 py-1 bg-blue-300 text-blue-800 text-sm rounded-lg">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
