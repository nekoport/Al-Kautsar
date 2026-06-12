@extends('layouts.app')

@section('title', 'Galeri')

@section('content')
    <div class="bg-primary-light py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Galeri</h1>
            <p class="text-gray-600">Dokumentasi kegiatan dan momen di Masjid Al-Kautsar</p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @forelse($galleries as $gallery)
        <div class="mb-16 last:mb-0">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $gallery->album_name }}</h2>
                    @if($gallery->description)
                    <div class="text-gray-600 text-sm mt-1">{!! $gallery->description !!}</div>
                    @endif
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse($gallery->items as $item)
                <button type="button" class="group relative aspect-square rounded-xl overflow-hidden bg-gray-100 cursor-pointer" onclick="openLightbox('{{ $item->image_path }}', '{{ $item->caption }}')">
                    <img src="{{ '/storage/' . $item->image_path }}" alt="{{ $item->caption ?? 'Foto galeri' }}" class="w-full h-full object-cover">
                    @if($item->caption)
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition flex items-end p-3">
                        <p class="text-white text-sm">{{ $item->caption }}</p>
                    </div>
                    @endif
                </button>
                @empty
                <p class="col-span-4 text-center text-gray-500 py-8">Belum ada foto dalam album ini.</p>
                @endforelse
            </div>
        </div>
        @empty
        <div class="text-center py-16">
            <p class="text-gray-500 text-lg">Belum ada album galeri.</p>
        </div>
        @endforelse

        @if ($galleries->hasPages())
        <div class="mt-12">
            {{ $galleries->links() }}
        </div>
        @endif
    </div>

    <div id="lightbox" class="fixed inset-0 z-50 bg-black/90 hidden items-center justify-center" onclick="closeLightbox(event)">
        <button type="button" class="absolute top-4 right-4 text-white/80 hover:text-white text-3xl" onclick="closeLightbox(event)">&times;</button>
        <div class="max-w-4xl mx-auto p-4 text-center" onclick="event.stopPropagation()">
            <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[80vh] mx-auto rounded-xl">
            <p id="lightbox-caption" class="text-white mt-4 text-sm"></p>
        </div>
    </div>

    <script>
    function openLightbox(src, caption) {
        document.getElementById('lightbox-img').src = '/storage/' + src;
        document.getElementById('lightbox-caption').textContent = caption || '';
        document.getElementById('lightbox').classList.remove('hidden');
        document.getElementById('lightbox').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox(e) {
        e.stopPropagation();
        document.getElementById('lightbox').classList.add('hidden');
        document.getElementById('lightbox').classList.remove('flex');
        document.body.style.overflow = '';
    }
    </script>
@endsection
