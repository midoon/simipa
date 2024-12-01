<div class="mb-6">
    <nav class="bg-white sticky top-0 z-50"">
        <div class="max-w-7xl mx-auto flex gap-3 items-center px-4 py-3">
            <!-- Logo atau Nama -->
            <a href="#" class="text-lg font-bold text-gray-700 hover:text-gray-900">
                <img src="{{ asset('images/logo.png') }}" alt="logo.png" width="40">
            </a>

            <h1 class="font-semibold text-simipa-1 text-sm">Hello, {{ session('teacher')['name'] }}</h1>

        </div>
    </nav>
</div>
