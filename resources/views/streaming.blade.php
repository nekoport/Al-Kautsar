@extends('layouts.app')

@section('title', 'Streaming')

@section('content')
    <div class="bg-primary-light py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Streaming</h1>
            <p class="text-gray-600">Tonton siaran langsung kajian dan kegiatan Masjid Al-Kautsar</p>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($live)
        <div class="mb-16">
            <div class="flex items-center gap-3 mb-4">
                <span class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
                <h2 class="text-xl font-bold text-gray-900">Sedang Live: {{ $live->title }}</h2>
            </div>
            <div class="aspect-video rounded-2xl overflow-hidden shadow-lg bg-black">
                <iframe
                    src="{{ str_replace('watch?v=', 'embed/', $live->youtube_url) }}?autoplay=1"
                    class="w-full h-full"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
        @endif

        @if($upcoming->isNotEmpty())
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Jadwal Siaran Mendatang</h2>
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($upcoming as $item)
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <div class="aspect-video rounded-lg overflow-hidden bg-gray-100 mb-4 flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">{{ $item->title }}</h3>
                    @if($item->scheduled_at)
                    <p class="text-sm text-gray-500">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $item->scheduled_at->format('d F Y H:i') }} WIB
                    </p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @elseif(!$live)
        <div class="text-center py-16">
            <p class="text-gray-500 text-lg">Belum ada jadwal siaran.</p>
        </div>
        @endif
    </div>
@endsection
