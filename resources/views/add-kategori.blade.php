<!-- resources/views/admin/create.blade.php -->

@extends('admin')

@section('content')
    <div class="p-4 mt-12 sm:ml-64">
        <div class="mt-4 p-4 relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="pb-4 bg-white">
                <!-- Your search input here (if needed) -->
            </div>
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="id" class="bg-white block text-sm font-medium text-gray-700">ID</label>
                    <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-slate-400 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed" value="{{ $nextCategoryId }}"disabled>
                </div>
                <div class="mb-4">
                    <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="nama_kategori"
                        class="mt-1 p-2 block w-full border rounded-md bg-gray-50 text-gray-800">
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi"
                        class="mt-1 p-2 block w-full border rounded-md bg-gray-50 text-gray-800"></textarea>
                </div>

                <div class="flex items-center justify-between">
                    {{-- <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Tambah Kategori
                    </button> --}}
                    <button type="submit"
                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 shadow-lg shadow-green-500/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Tambah
                        Kategori</button>

                    <a href="{{ route('kategori.index') }}"
                        class="text-blue-500 hover:text-blue-600 font-medium">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
