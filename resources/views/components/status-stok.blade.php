@props(['stok'])

<div>
    @if ($stok > 0)
        <span>Tersedia ({{ $stok }})</span>
    @else
        <span>Habis</span>
    @endif
</div>