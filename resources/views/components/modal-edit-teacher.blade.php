<!-- resources/views/components/modal-edit-teacher.blade.php -->
@props(['teacher'])

<div id="editModalTeacher{{ $teacher->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden">
    <div class="h-full flex items-center justify-center">
        <div class="bg-white rounded-lg w-1/3 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Data Guru: {{ $teacher->name }}</h2>
            <!-- Formulir Edit Data -->
            <form action="/admin/teacher/{{ $teacher->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="block font-semibold mb-1">Nama</label>
                    <input type="text" name="name" id="name" value="{{ $teacher->name }}" required
                        class="w-full border py-1.5 px-3 rounded-lg">
                </div>

                <div class="mb-3">
                    <label for="nik" class="block font-semibold mb-1">NIK</label>
                    <input type="text" name="nik" id="nik" value="{{ $teacher->nik }}" required
                        class="w-full border py-1.5 px-3 rounded-lg">
                </div>

                <div class="mb-3">
                    <label for="gender" class="block font-semibold mb-1">Gender</label>
                    <select id="gender" name="gender" class="border w-full rounded-lg px-2 py-1.5" required>
                        <option disabled>Pilih Gender</option>
                        <option value="laki-laki" {{ $teacher->gender == 'laki-laki' ? 'selected' : '' }}>Laki-laki
                        </option>
                        <option value="perempuan" {{ $teacher->gender == 'perempuan' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                </div>

                <div class="mb-7">
                    <label class="block font-semibold mb-1">Role</label>
                    <div class="flex items-center space-x-5 border p-3 rounded-lg">
                        <div>
                            <label for="guru">
                                <input type="checkbox" id="guru" name="roles[]" value="guru"
                                    class="mr-2 capitalize"
                                    {{ in_array('guru', $teacher->role ?? []) ? 'checked' : '' }}>Guru
                            </label>
                        </div>
                        <div>
                            <label for="bendahara">
                                <input type="checkbox" id="bendahara" name="roles[]" value="bendahara"
                                    class="mr-2 capitalize"
                                    {{ in_array('bendahara', $teacher->role ?? []) ? 'checked' : '' }}>Bendahara
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end">
                    <button type="button" onclick="editModalTeacher({{ $teacher->id }})"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-simipa-1 text-white rounded hover:bg-simipa-2">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
