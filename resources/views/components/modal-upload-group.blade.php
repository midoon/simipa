<div id="uploadGroup" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden">
    <div class="h-full flex items-center justify-center">
        <div class="bg-white rounded-lg w-1/3 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Upload Data Rombel</h2>
            <!-- Formulir Tambah Data -->
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5 ">
                    <label for="file" class="block text-gray-700 font-medium mb-2">Pilih file CSV</label>
                    <input type="file" name="file" id="file" required
                        class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-5">
                    <a href="/admin/group/template/donwload"
                        class="text-blue-500 hover:cursor-pointer hover:underline">Download Template</a>
                </div>



                <!-- Tombol Aksi -->
                <div class="flex justify-end">
                    <button type="button" onclick="uploadGroup()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-simipa-1 text-white rounded hover:bg-simipa-2">Upload</button>
                </div>
            </form>
        </div>
    </div>

</div>
