<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-l mt-14">
            <div class="w-full mb-4">
                <span class="text-center text-xl font-bold">Tambah Users</span>
            </div>
            <form class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" id="nama"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukan nama anda" required />
                </div>
                <div class="">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukan email anda" required />
                </div>
                <div class="">
                    <label for="nama_perusahaan" class="block mb-2 text-sm font-medium text-gray-900">Nama Perusahaan</label>
                    <input type="text" id="nama_perusahaan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukan email anda" required />
                </div>
                <div class="">
                    <label for="nama_pemilik" class="block mb-2 text-sm font-medium text-gray-900">Nama Pemilik</label>
                    <input type="text" id="nama_pemilik"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukan email anda" required />
                </div>
                <div class="">
                    <label for="Alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                    <input type="text" id="Alamat"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukan email anda" required />
                </div>
                <div class="">
                    <label for="foto" class="block mb-2 text-sm font-medium text-gray-900">Foto Users</label>
                    <input type="file" id="foto"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukan email anda" required />
                </div>
                <div class="">
                    <label for="rekening" class="block mb-2 text-sm font-medium text-gray-900">Rekening</label>
                    <input type="text" id="rekening"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukan email anda" required />
                </div>
                <div class="">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" id="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Masukan email anda" required />
                </div>
                <div class="col-span-2 text-end">
                    <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
