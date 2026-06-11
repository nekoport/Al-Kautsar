@extends('layouts.app')

@section('title', 'Berita')

@section('content')
    <div class="bg-primary-light py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Berita</h1>
            <p class="text-gray-600">Informasi dan artikel terbaru dari Masjid Al-Kautsar</p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-3 gap-8">
            @forelse($posts as $post)
            <a href="{{ route('berita.detail', $post->slug) }}" class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="h-48 bg-primary-light flex items-center justify-center overflow-hidden">
                    @if($post->thumbnail)
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" loading="lazy">
                    @else
                    <svg class="w-12 h-12 text-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    @endif
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <span>{{ $post->category->name }}</span>
                        <span class="mx-2">&middot;</span>
                        <span>{{ $post->published_at->format('d M Y') }}</span>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-primary transition">{{ $post->title }}</h2>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $post->excerpt }}</p>
                </div>
            </a>
            @empty
            <p class="col-span-3 text-center text-gray-500 py-16">Belum ada berita.</p>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
