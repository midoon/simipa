@props(['payment'])

<div id="editPayment{{ $payment->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-50  hidden z-50">

    <div class="h-full flex items-center justify-center">
        <div class="bg-white rounded-lg w-10/12 p-4 sm:w-1/3 sm:py-10">
            <h2 class="text-xl font-semibold text-gray-800 mb-5">Edit Pembayaran</h2>



            <!-- Formulir Tambah Data -->
            <form action="/teacher/payment/update/{{ $payment->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="amount">Nominal Tagihan</label>
                    <input type="number" name="amount" id="amount" class="border px-2 py-2 w-full"
                        value="{{ $payment->amount }}">
                </div>
                <div class="mb-3">
                    <label for="date" class="block font-semibold mb-1">Tanggal</label>
                    <input type="date" id="date" name="date" class="w-full px-2 py-2 border rounded-lg"
                        value="{{ $payment->payment_date }}">
                </div>




                <!-- Tombol Aksi -->
                <div class="flex justify-end">
                    <button type="button" onclick="editPayment({{ $payment->id }})"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-simipa-1 text-white rounded hover:bg-simipa-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
