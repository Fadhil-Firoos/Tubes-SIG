<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-l mt-14">
            <div class="w-full mb-4">
                <span class="text-center text-xl font-bold">Tambah Users</span>
            </div>
            <form class="grid grid-cols-1 md:grid-cols-2 gap-4" action="{{ route('admin.users-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="">
                    <label for="nama_perusahaan" class="block mb-2 text-sm font-medium text-gray-900">Nama Perusahaan <span class="text-red-500">*</span></label>
                    <input type="text" id="nama_perusahaan" name="nama_perusahaan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukan nama perusahaan" value="{{ old('nama_perusahaan') }}" required />
                    @error('nama_perusahaan')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukan email" value="{{ old('email') }}" required />
                    @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password <span class="text-red-500">*</span></label>
                    <input type="text" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukan password" value="{{ old('password') }}" required />
                    @error('password')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="">
                    <label for="nama_pemilik" class="block mb-2 text-sm font-medium text-gray-900">Nama Pemilik <span class="text-red-500">*</span></label>
                    <input type="text" id="nama_pemilik" name="nama_pemilik"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukan nama pemilik" value="{{ old('nama_pemilik') }}" required />
                    @error('nama_pemilik')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat <span class="text-red-500">*</span></label>
                    <input type="text" id="Alamat" name="alamat"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukan alamat" value="{{ old('alamat') }}" required />
                    @error('alamat')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="">
                    <label for="foto" class="block mb-2 text-sm font-medium text-gray-900">Foto Users <span class="text-red-500">*</span></label>
                    <input type="file" id="foto" name="foto"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        required />
                    @error('foto')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="">
                    <label for="rekening" class="block mb-2 text-sm font-medium text-gray-900">Rekening <span class="text-red-500">*</span></label>
                    <input type="text" id="rekening" name="rekening"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukan rekening" value="{{ old('rekening') }}" required />
                    @error('rekening')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-2 text-end">
                    <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
