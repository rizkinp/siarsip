<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function edit($id)
    {
        $arsip = Arsip::findOrFail($id);
        $categories = Kategori::all();

        return view('edit_arsip', compact('arsip', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'nomor_surat' => 'required',
            'kategori' => 'required',
            'judul' => 'required',
            'file_surat' => 'nullable|mimes:pdf|max:10240',
        ]);

        // Temukan data arsip berdasarkan ID
        $arsip = Arsip::findOrFail($id);

        // Perbarui data arsip
        $arsip->nomor_surat = $validatedData['nomor_surat'];
        $arsip->kategori = $validatedData['kategori'];
        $arsip->judul = $validatedData['judul'];

        // Perbarui file surat jika ada yang diunggah
        if ($request->hasFile('file_surat')) {
            // Hapus file lama
            Storage::delete($arsip->file_surat);

            // Simpan file surat yang baru
            $filePath = $request->file_surat->storeAs('public/pdfs', $validatedData['judul'] . '.pdf');
            $arsip->file_surat = $filePath;
        }

        // Simpan perubahan
        $arsip->save();

        // Redirect ke halaman yang sesuai atau sesuaikan sesuai kebutuhan Anda
        return redirect()->route('arsip.index')->with('success', 'Arsip surat berhasil diperbarui.');
    }
    public function unduhPdf($id)
    {
        $arsip = Arsip::findOrFail($id);

        // Periksa apakah file PDF ada
        $pdfPath = storage_path("app/public/pdfs/{$arsip->judul}.pdf");

        if (!file_exists($pdfPath)) {
            return response()->json(['error' => 'File PDF tidak ditemukan'], 404);
        }

        return response()->download($pdfPath, "{$arsip->judul}.pdf", ['Content-Type' => 'application/pdf']);
    }

    public function index()
    {
        $arsips = Arsip::all();
        return view('arsip', compact('arsips'));
    }
    public function show($id)
    {
        $arsip = Arsip::findOrFail($id);
        return view('show-arsip', compact('arsip'));
    }

    public function create()
    {
        // Fetch categories to be used in the dropdown
        $categories = Kategori::all();

        return view('add-arsip', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'nomor_surat' => 'required',
            'kategori' => 'required',
            'judul' => 'required',
            'file_surat' => 'required|mimes:pdf|max:10240',
            
        ]);
        $filePath = $request->file_surat->storeAs('public/pdfs', $validatedData['judul'] . '.pdf');
        Arsip::create([
            'nomor_surat' => $validatedData['nomor_surat'],
            'kategori' => $validatedData['kategori'],
            'judul' => $validatedData['judul'],
            'file_surat' => $filePath,
            // Add other fields as needed
        ]);

        // Redirect to the index page or any other page as needed
        return redirect()->route('arsip.index')->with('success', 'Arsip surat berhasil ditambahkan.');
    }
    public function delete($id)
{
    // Hapus data arsip berdasarkan ID
    Arsip::findOrFail($id)->delete();

    // Redirect dengan pesan sukses atau tampilkan SweetAlert di sini
    return redirect()->route('arsip.index')->with('success', 'Arsip berhasil dihapus');
}
}
