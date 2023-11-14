<!-- resources/views/arsip/show.blade.php -->

@extends('admin')  <!-- Assuming 'admin' is your layout name -->

@section('content')
    <div class="p-4 mt-10 sm:ml-64">
        <div class="mt-4 p-4 relative overflow-x-auto shadow-md sm:rounded-lg">
            <h2 class="text-2xl font-semibold mb-4">Detail Arsip Surat</h2>

            <!-- Display detailed information about the archive -->
            <div class="mb-4">
                <strong>Nomor Surat:</strong> {{ $arsip->nomor_surat }}
            </div>

            <div class="mb-4">
                <strong>Kategori:</strong> {{ $arsip->kategori }}
            </div>

            <div class="mb-4">
                <strong>Judul:</strong> {{ $arsip->judul }}
            </div>

            <div class="mb-4">
                <strong>Waktu Pengarsipan:</strong> {{ $arsip->waktu_pengarsipan }}
            </div>

            <!-- Add other details as needed -->

            <!-- Display PDF file -->
            <div class="mb-4">
                <strong>File Surat:</strong>
                <a href="{{ asset('storage/' . $arsip->file_surat) }}" target="_blank">View File</a>
                <embed src="{{ Storage::url($arsip->file_surat) }}" type="application/pdf" width="100%" height="600px">
                {{-- <embed src="{{ asset('storage/' . $arsip->file_surat) }}" type="application/pdf" width="100%" height="600px"> --}}
            </div>
            <!-- Add "Kembali" and "Unduh" buttons -->
            <div class="mt-4 flex justify-between items-center">
                <a href="{{ route('arsip.index') }}" class="inline-block text-white bg-pink-500 px-4 py-2 rounded-md hover:bg-blue-600">
                    Kembali
                </a>

                <a href="{{ route('arsip.unduh', $arsip->id) }}" class="inline-block text-white bg-blue-500 px-4 py-2 rounded-md hover:bg-blue-600">
                    Unduh
                </a>
                <a href="{{ route('arsip.edit', $arsip->id) }}" class="inline-block text-white bg-green-500 px-4 py-2 rounded-md hover:bg-green-600">
                    Edit File
                </a>
            </div>
        </div>
    </div>
@endsection
