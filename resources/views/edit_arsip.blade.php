@extends('admin')

@section('content')
    <div class="p-4 mt-12 sm:ml-64">
        <div class="mt-4 p-4 relative overflow-x-auto shadow-md sm:rounded-lg">
            <h2 class="text-2xl font-semibold mb-4">Edit Arsip Surat</h2>
            <form action="{{ route('arsip.update', $arsip->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nomor_surat" class="block text-sm font-medium text-gray-700">Nomor Surat</label>
                    <input type="text" name="nomor_surat" id="nomor_surat" class="mt-1 p-2 w-full border rounded-md" value="{{ $arsip->nomor_surat }}">
                </div>

                <div class="mb-4">
                    <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="kategori" id="kategori" class="mt-1 p-2 w-full border rounded-md">
                        <!-- Loop through categories data to generate options -->
                        @foreach ($categories as $category)
                            <option value="{{ $category->nama_kategori }}" {{ $arsip->kategori == $category->nama_kategori ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="judul" id="judul" class="mt-1 p-2 w-full border rounded-md" value="{{ $arsip->judul }}">
                </div>

                <div class="mb-4">
                    <label for="file_surat" class="block text-sm font-medium text-gray-700">File Surat (PDF)</label>
                    <input type="file" name="file_surat" id="file_surat" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <div class="mt-4 flex justify-between items-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                        Simpan
                    </button>

                    <a href="{{ route('arsip.index') }}" class="inline-block text-blue-500 hover:underline">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection