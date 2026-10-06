<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // READ - Ambil semua produk
    public function index()
    {
        return response()->json([
            "status" => "success",
            "data" => Product::all()
        ], 200);
    }

    // CREATE - Tambah produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::create($validated);

        return response()->json([
            "status" => "success",
            "message" => "Produk berhasil ditambahkan",
            "data" => $product
        ], 201);
    }

    // READ - Ambil satu produk berdasarkan ID
    public function show(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(["status" => "error", "message" => "Data tidak ditemukan"], 404);
        }
        return response()->json(["status" => "success", "data" => $product], 200);
    }

    // UPDATE - Ubah data produk
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(["status" => "error", "message" => "Data tidak ditemukan"], 404);
        }

        $product->update($request->all());
        return response()->json(["status" => "success", "message" => "Data berhasil diupdate", "data" => $product], 200);
    }

    // DELETE - Hapus produk
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(["status" => "error", "message" => "Data tidak ditemukan"], 404);
        }

        $product->delete();
        return response()->json(["status" => "success", "message" => "Data berhasil dihapus"], 200);
    }
}