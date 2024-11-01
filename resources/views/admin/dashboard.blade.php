<x-layout>
    <x-slot:title>Dashboard | Admin</x-slot:title>
    <h1>Hello <h1>Hello, {{ session('user.username') }}</h1>
    </h1>
    @dump(session()->all())

</x-layout>
