<!-- Modal Tambah Data Siswa -->


<div id="createModalPayment" class="fixed inset-0 bg-gray-900 bg-opacity-50  hidden">
    <div class="h-full flex items-center justify-center">
        <div class="bg-white rounded-lg w-1/3 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Data Tipe Pembayaran</h2>
            <!-- Formulir Tambah Data -->
            <form action="/admin/payment" method="POST">
                @csrf
                <div class="mb-3">
                    <div class="flex-1 space-y-2 md:flex md:items-center md:space-x-3 md:space-y-0">
                        <div class="w-full ">
                            <label for="name" class="block font-semibold mb-1">Nama</label>
                            <input type="text" name="name" id="name" placeholder="nama pembayaran" required
                                class="w-full border py-1.5 px-3 rounded-lg">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="flex-1 space-y-2 md:flex md:items-center md:space-x-3 md:space-y-0">
                        <div class="w-full ">
                            <label for="name" class="block font-semibold mb-1">Desskripsi</label>
                            <textarea id="description" name="description" class="w-full border py-1.5 px-3" placeholder="Deskripsi"></textarea>
                        </div>
                    </div>
                </div>
                <!-- Tombol Aksi -->
                <div class="flex justify-end">
                    <button type="button" onclick="closeCreatePaymentModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-simipa-1 text-white rounded hover:bg-simipa-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
