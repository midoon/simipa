<!-- Modal Tambah Data Siswa -->

@props(['subject'])

<div id="showModalSubjectDesc{{ $subject->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-50  hidden">
    <div class="h-full flex items-center justify-center">
        <div class="bg-white rounded-lg w-1/3 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Deskripsi: {{ $subject->name }}</h2>
            <!-- Formulir Tambah Data -->
            <h1>{{ $subject->description }}</h1>
            <div class="flex justify-end">
                <button type="button" onclick="showDescription({{ $subject->id }})"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Tutup</button>

            </div>
        </div>
    </div>

</div>
