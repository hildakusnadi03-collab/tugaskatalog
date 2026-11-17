<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk Kasir</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-2 text-blue-600">Katalog Produk Kasir</h1>
        <p class="text-gray-600 mb-6">Daftar produk dan ketersediaan stok.</p>

        <table class="w-full border-collapse border border-gray-300 text-left">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-3">ID</th>
                    <th class="border border-gray-300 p-3">Nama Produk</th>
                    <th class="border border-gray-300 p-3">Kategori</th>
                    <th class="border border-gray-300 p-3">Harga</th>
                    <th class="border border-gray-300 p-3">Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produk as $p)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 p-3">{{ $p['id'] }}</td>
                    <td class="border border-gray-300 p-3 font-semibold">{{ $p['nama'] }}</td>
                    <td class="border border-gray-300 p-3">{{ $p['kategori'] }}</td>
                    <!-- Format harga ke Rupiah -->
                    <td class="border border-gray-300 p-3">Rp {{ number_format($p['harga'], 0, ',', '.') }}</td>
                    <!-- Kondisi Status Stok -->
                    <td class="border border-gray-300 p-3">
                        @if($p['stok'] > 0)
                            <span class="text-green-600 font-bold">Tersedia ({{ $p['stok'] }})</span>
                        @else
                            <span class="text-red-500 font-bold">Stok Habis</span>
                        @endif
                    </td>
                </tr>
                @empty
                <!-- Empty State jika data produk kosong -->
                <tr>
                    <td colspan="5" class="border border-gray-300 p-4 text-center text-gray-500">
                        Belum ada produk yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>