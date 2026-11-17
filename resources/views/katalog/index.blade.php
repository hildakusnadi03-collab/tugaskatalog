@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')

<style>
    .kasir-wrapper {
        max-width: 1100px;
        margin: 30px auto;
        padding: 0 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        border-bottom: 2px solid #f3f4f6;
        padding-bottom: 15px;
    }

    .header-section h1 {
        font-size: 24px;
        color: #111827;
        margin: 0;
    }

    .header-section p {
        color: #6b7280;
        margin: 4px 0 0 0;
        font-size: 14px;
    }

    /* Layout Utama: Kiri Filter, Kanan Produk */
    .main-layout {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 25px;
    }

    @media (max-width: 768px) {
        .main-layout {
            grid-template-columns: 1fr;
        }
    }

    /* Kotak Pencarian / Filter Sidebar */
    .filter-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        height: fit-content;
    }

    .filter-card h3 {
        font-size: 16px;
        margin-top: 0;
        color: #374151;
        margin-bottom: 15px;
    }

    .filter-group {
        margin-bottom: 15px;
    }

    .filter-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 6px;
    }

    .filter-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        box-sizing: border-box;
        outline: none;
        transition: all 0.2s;
    }

    .filter-group input:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .btn-cari {
        width: 100%;
        padding: 10px;
        background-color: #4f46e5;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-cari:hover {
        background-color: #4338ca;
    }

    .btn-reset {
        display: block;
        text-align: center;
        margin-top: 10px;
        font-size: 13px;
        color: #6b7280;
        text-decoration: none;
    }

    .btn-reset:hover {
        color: #111827;
    }

    /* Grid Produk */
    .katalog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
    }

    .produk-item {
        background: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .produk-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
    }

    .produk-item h4 {
        margin: 0 0 8px 0;
        font-size: 17px;
        color: #1f2937;
    }

    .badge-kategori {
        font-size: 11px;
        background: #eef2ff;
        color: #4f46e5;
        padding: 3px 8px;
        border-radius: 20px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 10px;
        width: fit-content;
    }

    .harga- produk {
        font-size: 16px;
        font-weight: 700;
        color: #059669;
        margin-bottom: 15px;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 40px;
        background: #fff;
        border-radius: 12px;
        color: #6b7280;
        border: 1px dashed #d1d5db;
    }
</style>

<div class="kasir-wrapper">
    <!-- Header -->
    <div class="header-section">
        <div>
            <h1>Katalog Produk</h1>
            <p>Pilih barang dan cek ketersediaan stok secara real-time</p>
        </div>
        <a href="{{ route('katalog.index') }}" style="color: #4f46e5; text-decoration: none; font-weight: 600; font-size: 14px;">&larr; Refresh Halaman</a>
    </div>

    <!-- Layout Utama (Sidebar Filter + Grid Produk) -->
    <div class="main-layout">
        <!-- Kolom Kiri: Form Pencarian / Filter -->
        <div class="filter-card">
            <h3>Pencarian Produk</h3>
            <form method="GET" action="{{ route('katalog.index') }}">
                <div class="filter-group">
                    <label for="q">Nama Produk</label>
                    <input id="q" name="q" value="{{ $q }}" placeholder="Contoh: Kopi, Roti...">
                </div>
                <button type="submit" class="btn-cari">Cari Produk</button>
                @if($q)
                    <a href="{{ route('katalog.index') }}" class="btn-reset">Reset Pencarian</a>
                @endif
            </form>
        </div>

        <!-- Kolom Kanan: Daftar Produk -->
        <div class="katalog-grid">
            @forelse ($produk as $item)
                <div class="produk-item">
                    <div>
                        <span class="badge-kategori">{{ $item['kategori'] ?? 'Umum' }}</span>
                        <h4>{{ $item['nama'] }}</h4>
                        <div class="harga- produk" style="font-size: 16px; font-weight: 700; color: #059669; margin-bottom: 15px;">
                            Rp {{ number_format($item['harga'], 0, ',', '.') }}
                        </div>
                    </div>
                    <div>
                        <x-status-stok :stok="$item['stok']" />
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <p style="margin: 0; font-weight: 500;">Maaf, produk yang Anda cari tidak ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection