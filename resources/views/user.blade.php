@extends('admin')

@section('content')
    <h1>TEST</h1>
    <div class="p-4 mt-12 sm:ml-64 main-content-container">
        <h1 class="text-2xl font-bold mb-4">Data Mahasiswa</h1>
        <div class="mt-4 p-4  relative overflow-x-auto shadow-md sm:rounded-lg">
            @foreach ($mahasiswa as $mhs)
                <div class="bg-slate-400 p-4 shadow-md rounded-md">
                    <h2 class="text-lg font-semibold mb-2">{{ $mhs->nama }}</h2>
                    <p class="text-gray-600 mb-1">NIM: {{ $mhs->nim }}</p>
                    <p class="text-gray-600 mb-1">Prodi: {{ $mhs->prodi }}</p>
                    <p class="text-gray-600 mb-1">Tanggal: {{ $mhs->tanggal }}</p>
                </div>
            @endforeach
        </div>

    </div>
@endsection
