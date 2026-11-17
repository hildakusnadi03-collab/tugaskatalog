<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request): \Illuminate\View\View
    {
        // 1. Ambil nilai pencarian dari URL (parameter ?q=...)
        $q = $request->input('q');

        // 2. Daftar produk yang diperbanyak
        $produk = [
            ['id' => 1, 'nama' => 'Kopi Ende', 'kategori' => 'Minuman', 'harga' => 15000, 'stok' => 12],
            ['id' => 2, 'nama' => 'Roti Cokelat', 'kategori' => 'Makanan', 'harga' => 8000, 'stok' => 0],
            ['id' => 3, 'nama' => 'Es Teh Manis', 'kategori' => 'Minuman', 'harga' => 5000, 'stok' => 25],
            ['id' => 4, 'nama' => 'Nasi Goreng Spesial', 'kategori' => 'Makanan', 'harga' => 20000, 'stok' => 7],
            ['id' => 5, 'nama' => 'Keripik Singkong', 'kategori' => 'Snack', 'harga' => 7000, 'stok' => 15],
            ['id' => 6, 'nama' => 'Jus Alpukat', 'kategori' => 'Minuman', 'harga' => 12000, 'stok' => 4],
            ['id' => 7, 'nama' => 'Mie Goreng Instan', 'kategori' => 'Makanan', 'harga' => 10000, 'stok' => 30],
            ['id' => 8, 'nama' => 'Air Mineral 600ml', 'kategori' => 'Minuman', 'harga' => 4000, 'stok' => 50],
        ];

        // 3. Jika user mengetik pencarian, filter produk berdasarkan nama
        if ($q) {
            $produk = array_filter($produk, function ($item) use ($q) {
                return stripos($item['nama'], $q) !== false;
            });
        }

        // 4. Kirim variabel $produk DAN $q ke view
        return view('katalog.index', compact('produk', 'q'));
    }
}