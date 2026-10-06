<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Services\BukuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Untuk Logging

class BukuController extends Controller
{
    private $bukuService;

    // Inject Service ke dalam Controller
    public function __construct(BukuService $bukuService)
    {
        $this->bukuService = $bukuService;
    }

    // GET /api/books
    public function index()
    {
        $bukus = $this->bukuService->getAllBooks();
        return response()->json([
            "status" => "success",
            "data" => $bukus
        ], 200);
    }

    // POST /api/books
    public function store(Request $request)
    {
        try {
            // Validasi Data (Sesuai Langkah 9)
            $validated = $request->validate([
                'judul' => 'required|string|max:100',
                'penulis' => 'required|string|max:100',
                'tahun_terbit' => 'required|integer',
                'stok' => 'required|integer|min:0'
            ]);

            // Logging (Sesuai Langkah 10)
            Log::info('Request pembuatan buku diterima', $validated);

            // Memanggil Service
            $buku = $this->bukuService->createBook($validated);

            return response()->json([
                'message' => 'Buku berhasil dibuat',
                'data' => $buku
            ], 201);

        } catch (\Exception $e) {
            // Error Handling (Sesuai Langkah 14)
            Log::error('Error saat membuat buku: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Terjadi kesalahan pada server'
            ], 500);
        }
    }
}