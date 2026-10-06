<?php

namespace App\Services;

use App\Models\Buku;

class BukuService
{
    public function getAllBooks()
    {
        return Buku::all();
    }

    public function createBook(array $data)
    {
        return Buku::create($data);
    }
}