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
        </div>
    </div>
@endsection
