@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="bg-primary-light py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-sm breadcrumbs text-gray-600 mb-2">
                <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('berita') }}" class="hover:text-primary">Berita</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">{{ $post->title }}</span>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <article class="bg-white rounded-2xl p-8 md:p-12 shadow-sm border border-gray-100">
            <div class="flex items-center text-sm text-gray-500 mb-4">
                <span class="bg-primary-light text-primary px-3 py-1 rounded-full">{{ $post->category->name }}</span>
                <span class="mx-3">&middot;</span>
                <span>{{ $post->published_at->format('d F Y') }}</span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">{{ $post->title }}</h1>

            @if($post->thumbnail)
            <div class="mb-8 rounded-xl overflow-hidden">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full">
            </div>
            @endif

            <div class="prose prose-gray max-w-none leading-relaxed">
                {{ $post->content }}
            </div>
        </article>

        @if($related->isNotEmpty())
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Artikel Terkait</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($related as $relatedPost)
                <a href="{{ route('berita.detail', $relatedPost->slug) }}" class="group bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="h-36 bg-primary-light flex items-center justify-center">
                        @if($relatedPost->thumbnail)
                        <img src="{{ asset('storage/' . $relatedPost->thumbnail) }}" class="w-full h-full object-cover">
                        @else
                        <svg class="w-8 h-8 text-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        @endif
                    </div>
                    <div class="p-4">
                        <p class="text-xs text-gray-500 mb-1">{{ $relatedPost->published_at->format('d M Y') }}</p>
                        <h3 class="font-semibold text-gray-900 text-sm group-hover:text-primary transition">{{ $relatedPost->title }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
@endsection
