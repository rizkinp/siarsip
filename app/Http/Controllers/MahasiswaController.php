<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa; 
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all(); // Mengambil semua data mahasiswa, sesuaikan dengan model dan database Anda

        return view('user', compact('mahasiswa'));
    }
}
