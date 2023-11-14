<!-- resources/views/edit-kategori.blade.php -->

@extends('admin')

@section('content')
    <div class="p-4 mt-12 sm:ml-64">
        <div class="mt-4 p-4 relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="mt-4 p-4 relative overflow-x-auto shadow-md sm:rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">KATEGORI SURAT >> Edit</h2>
                    <h3 class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400"> Edit data kategori.<h3>
                    <h3 class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400"> Jika sudah klik button Update kategori.<h3>
                    <p></p>
            <div class="pb-4 bg-white dark:bg-gray-900">
                <!-- Your search input here (if needed) -->
            </div>
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="id" class="bg-slate-400 block text-sm font-medium text-gray-700">ID</label>
                    <input type="text" id="disabled-input" aria-label="disabled input"
                        class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $kategori->id }}" disabled>
                </div>
                <div class="mb-4">
                    <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="nama_kategori"
                        class="mt-1 p-2 block w-full border rounded-md bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white"
                        value="{{ $kategori->nama_kategori }}">
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi"
                        class="mt-1 p-2 block w-full border rounded-md bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white">{{ $kategori->deskripsi }}</textarea>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Update
                        Kategori</button>

                    <a href="{{ route('kategori.index') }}"
                        class="text-blue-500 hover:text-blue-600 font-medium">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
