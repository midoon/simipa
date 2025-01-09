<!-- Modal Tambah Data Guru -->



<div id="createModalTeacher" class="fixed inset-0 bg-gray-900 bg-opacity-50  hidden">
    <div class="h-full flex items-center justify-center">
        <div class="bg-white rounded-lg w-1/3 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Data Guru</h2>
            <!-- Formulir Tambah Data -->
            <form action="/admin/teacher" method="POST">
                @csrf
                <div class="mb-3">
                    <div class="flex-1 space-y-2 md:flex md:items-center md:space-x-3 md:space-y-0">
                        <div class="w-full md:w-1/2">
                            <label for="name" class="block font-semibold mb-1">Nama</label>
                            <input type="text" name="name" id="name" placeholder="John Dhoe" required
                                class="w-full border py-1.5 px-3 rounded-lg">
                        </div>
                        <div class="w-full md:w-1/2">
                            <label for="nik" class="block font-semibold mb-1">NIK</label>
                            <input type="text" name="nik" id="nik" placeholder="123456**" required
                                class="w-full border py-1.5 px-3 rounded-lg">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="gender" class="block font-semibold mb-1">Gender</label>
                    <select id="gender" name="gender" class="border w-full rounded-lg px-2 py-1.5" required>
                        <option selected disabled>Pilih Gender</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-7">
                    <label class="block font-semibold mb-1">Role</label>
                    <div class="flex items-center space-x-5 border p-3 rounded-lg">

                        <div>
                            <label for="guru">
                                <input type="checkbox" id="guru" name="roles[]" value="guru"
                                    class="mr-2 capitalize">Guru
                            </label>
                        </div>
                        <div>
                            <label for="bendahara">
                                <input type="checkbox" id="bendahara" name="roles[]" value="bendahara"
                                    class="mr-2 capitalize">Bendahara
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Tombol Aksi -->
                <div class="flex justify-end">
                    <button type="button" onclick="createModalTeacher()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-simipa-1 text-white rounded hover:bg-simipa-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
