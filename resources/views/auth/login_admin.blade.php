<x-layout title="Login | Admin">

    <div class="w-full bg-simipa-5 border">
        <div class="w-full flex justify-center items-center min-h-screen px-8">
            <div class="w-full md:max-w-sm rounded-xl bg-white p-10 border">
                @if (session('error'))
                    <div class=" text-red-700 p-4 rounded mb-4 text-center">
                        {{ session('error') }}
                    </div>
                @endif
                <h1 class="text-center text-3xl font-bold text-simipa-1">Login</h1>
                <form action="/login/admin" method="POST" class="mt-10">
                    @csrf
                    <div class="mb-10">
                        <input type="text" name="username" id="username" placeholder="username "
                            class="border-b-2 w-full focus:outline-none py-1.5" required>
                    </div>
                    <div class="mb-10">
                        <input type="password" name="password" id="password" placeholder="password"
                            class="border-b-2 w-full focus:outline-none py-1.5" required>
                    </div>
                    <div class="w-full text-center">
                        <button type="submit" class="px-20 py-2 bg-simipa-2 text-white rounded-full">Login
                            Admin</button>
                    </div>
                </form>
                <div class="mt-8">

                    <h3 class="text-simipa-2 text-center text-sm mt-5 hover:underline"><a href="/login/teacher">Login
                            sebagai
                            guru</a></h3>
                </div>
            </div>
        </div>
    </div>
</x-layout>
