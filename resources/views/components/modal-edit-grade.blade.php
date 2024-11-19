<!-- resources/views/components/modal-edit-teacher.blade.php -->
@props(['grade'])

<div id="editModalGrade{{ $grade->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden ">
    <div class="h-full flex items-center justify-center">
        <div class="bg-white rounded-lg w-1/3 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Data Guru: {{ $grade->name }}</h2>
            <!-- Formulir Edit Data -->
            <form action="/admin/grade/{{ $grade->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="block font-semibold mb-1">Nama</label>
                    <input type="text" name="name" id="name" value="{{ $grade->name }}" required
                        class="w-full border py-1.5 px-3 rounded-lg">
                </div>



                <!-- Tombol Aksi -->
                <div class="flex justify-end">
                    <button type="button" onclick="closeEditGradeModal({{ $grade->id }})"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-simipa-1 text-white rounded hover:bg-simipa-2">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
