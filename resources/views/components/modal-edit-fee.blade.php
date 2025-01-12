<!-- Modal Tambah Data group -->
@props(['grades', 'paymentTypes', 'gradeFee'])
<div id="editModalFee{{ $gradeFee->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-50  hidden">

    <div class="h-full flex items-center justify-center">
        <div class="bg-white rounded-lg w-1/3 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Data Tagihan</h2>
            <div>

            </div>
            <!-- Formulir Tambah Data -->
            <form action="/admin/payment/fee/{{ $gradeFee->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="gradeSelect">Pilih Tipe Pembayaran</label>
                    <select name="payment_type_id" id="gradeSelect" class="border px-2 py-2 w-full">
                        @foreach ($paymentTypes as $pt)
                            <option value="{{ $pt->id }}" @if ($pt->id == $gradeFee->payment_type_id) selected @endif>
                                {{ $pt->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="amount">Nominal Tagihan</label>
                    <input type="number" name="amount" id="amount" class="border px-2 py-2 w-full"
                        value="{{ $gradeFee->amount }}">
                </div>
                <div class="mb-3">
                    <label for="due_date">Tenggat Waktu</label>
                    <input type="date" name="due_date" id="due_date" class="border px-2 py-2 w-full"
                        value="{{ $gradeFee->due_date }}">
                </div>
                <input type="text" name="grade_id" id="grade_id" class="hidden" value="{{ $gradeFee->grade_id }}">
                <!-- Tombol Aksi -->
                <div class="flex justify-end">
                    <button type="button" onclick="editModalFee({{ $gradeFee->id }})"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-simipa-1 text-white rounded hover:bg-simipa-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
