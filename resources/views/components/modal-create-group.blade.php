<!-- Modal Tambah Data group -->
@props(['grades'])
<div id="createModalGroup" class="fixed inset-0 bg-gray-900 bg-opacity-50  hidden">

    <div class="h-full flex items-center justify-center">
        <div class="bg-white rounded-lg w-1/3 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Data Rombel</h2>
            <div>

            </div>
            <!-- Formulir Tambah Data -->
            <form action="/admin/group" method="POST">
                @csrf
                <div class="mb-3">
                    <div class="flex-1 space-y-2 md:flex md:items-center md:space-x-3 md:space-y-0">
                        <div class="w-full">
                            <label for="name" class="block font-semibold mb-1">Nama Robel</label>
                            <input type="text" name="name" id="name" placeholder="kelas-1-A" required
                                class="w-full border py-1.5 px-3 rounded-lg">
                        </div>
                    </div>
                </div>


                <div class="mb-3">
                    <label for="gradeSelect">Pilih Kelas</label>
                    <select name="grade_id" id="gradeSelect" class="border px-2 py-2 w-full">
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Tombol Aksi -->
                <div class="flex justify-end">
                    <button type="button" onclick="createGroupModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-simipa-1 text-white rounded hover:bg-simipa-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
