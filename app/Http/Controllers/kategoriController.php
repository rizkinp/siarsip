<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function search(Request $request)
{
    $searchTerm = $request->input('search');
    $categories = Kategori::where('nama_kategori', 'like', '%' . $searchTerm . '%')->get();

    return response()->json($categories);
}

    // public function search(Request $request)
    // {
    //     $searchTerm = $request->input('search');
    //     $categories = Kategori::where('nama_kategori', 'like', '%' . $searchTerm . '%')->get();

    //     return view('search_result-kategori', compact('categories'));
    // }
    // KategoriController.php

// public function search(Request $request)
// {
//     $searchTerm = $request->input('search');
//     $categories = Kategori::where('nama_kategori', 'like', '%' . $searchTerm . '%')->get();

//     return response()->json($categories);
// }

    public function edit($id)
    {
        // Find the category by ID
        $kategori = Kategori::findOrFail($id);

        return view('edit-kategori', compact('kategori'));
    }

    // Update method to handle the form submission for editing
    public function update(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Find the category by ID
        $kategori = Kategori::findOrFail($id);

        // Update the category with the validated data
        $kategori->update($validatedData);

        return redirect()->route('kategori.index')->with('success', 'Category updated successfully');
    }

    public function index()
    {
        $categories = Kategori::all();
        return view('kategori', compact('categories'));
    }

    // public function create()
    // {
    //     return view('add-kategori');
    // }

    public function create()
    {
        // Get the next available ID for the Kategori model
        $nextCategoryId = DB::table('kategoris')->max('id') + 1;

        return view('add-kategori', ['nextCategoryId' => $nextCategoryId]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Kategori::create($validatedData);

        return redirect()->route('kategori.index')->with('success', 'Category added successfully');
    }

    public function delete($id)
    {
        // Hapus data arsip berdasarkan ID
        Kategori::findOrFail($id)->delete();

        // Redirect dengan pesan sukses atau tampilkan SweetAlert di sini
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
