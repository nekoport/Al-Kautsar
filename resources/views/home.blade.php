@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="relative overflow-hidden">
        @if(isset($mosque) && $mosque->hero_image)
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ '/storage/' . $mosque->hero_image }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-black/60 via-black/40 to-black/60"></div>
        @else
        <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-primary-light to-transparent"></div>
        @endif
        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="text-center max-w-3xl mx-auto">
                @php($hasHero = isset($mosque) && $mosque->hero_image)
                <h1 class="text-4xl md:text-6xl font-bold {{ $hasHero ? 'text-white' : 'text-gray-900' }} leading-tight mb-6">
                    Selamat Datang di
                    <span class="{{ $hasHero ? 'text-white' : 'text-primary' }}">Masjid Al-Kautsar</span>
                </h1>
                <p class="text-lg md:text-xl {{ $hasHero ? 'text-white/90' : 'text-gray-600' }} mb-10 leading-relaxed">
                    Masjid Al-Kautsar Green Jagakarsa — rumah ibadah yang damai, terbuka untuk seluruh masyarakat.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('profil') }}" class="px-8 py-3 bg-primary text-white rounded-full font-medium hover:bg-primary/90 transition shadow-md">Tentang Kami</a>
                    <a href="{{ route('donasi') }}" class="px-8 py-3 border-2 {{ $hasHero ? 'border-white text-white hover:bg-white hover:text-primary' : 'border-primary text-primary hover:bg-primary hover:text-white' }} rounded-full font-medium transition">Donasi</a>
                </div>
            </div>
        </div>
    </div>

    @if(isset($prayerTimes) && !empty($prayerTimes['timings']))
    <div class="bg-primary-light py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Jadwal Shalat</h2>
                <p class="text-gray-600">{{ now()->format('d M Y') }}</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                @foreach(['Imsak' => 'Imsak', 'Fajr' => 'Subuh', 'Dhuhr' => 'Dzuhur', 'Asr' => 'Ashar', 'Maghrib' => 'Maghrib', 'Isha' => 'Isya'] as $key => $label)
                <div class="bg-white rounded-xl p-5 text-center shadow-sm border border-gray-100">
                    <p class="text-sm text-gray-500 mb-1">{{ $label }}</p>
                    <p class="text-xl font-semibold text-primary">{{ $prayerTimes['timings'][$key] ?? '-' }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @if(isset($announcement) && $announcement)
    <div class="bg-primary">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 text-center">
            <p class="text-white font-medium">{{ $announcement->title }}</p>
            <p class="text-white/80 text-sm mt-1">{{ $announcement->content }}</p>
        </div>
    </div>
    @endif

    @if(isset($latestPosts) && $latestPosts->isNotEmpty())
    <div class="bg-white py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Berita Terbaru</h2>
                    <p class="text-gray-600">Artikel dan informasi terkini dari masjid</p>
                </div>
                <a href="{{ route('berita') }}" class="text-primary font-medium hover:underline">Lihat Semua</a>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($latestPosts as $post)
                <a href="{{ route('berita.detail', $post->slug) }}" class="group bg-gray-50 rounded-2xl overflow-hidden hover:shadow-md transition">
                    <div class="h-44 bg-primary-light flex items-center justify-center">
                        @if($post->thumbnail)
                        <img src="{{ '/storage/' . $post->thumbnail }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" loading="lazy">
                        @else
                        <svg class="w-10 h-10 text-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        @endif
                    </div>
                    <div class="p-5">
                        <p class="text-xs text-gray-500 mb-2">{{ $post->published_at->format('d M Y') }}</p>
                        <h3 class="font-semibold text-gray-900 group-hover:text-primary transition">{{ $post->title }}</h3>
                        <p class="text-sm text-gray-600 mt-2">{{ $post->excerpt }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @if(isset($upcomingEvents) && $upcomingEvents->isNotEmpty())
    <div class="bg-primary-light py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Kegiatan Mendatang</h2>
                    <p class="text-gray-600">Agenda dan acara di Masjid Al-Kautsar</p>
                </div>
                <a href="{{ route('kegiatan') }}" class="text-primary font-medium hover:underline">Lihat Semua</a>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($upcomingEvents as $event)
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <div class="text-center mb-4">
                        <div class="text-3xl font-bold text-primary">{{ $event->start_date->format('d') }}</div>
                        <div class="text-sm text-gray-500">{{ $event->start_date->format('M Y') }}</div>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-center mb-2">{{ $event->title }}</h3>
                    <p class="text-sm text-gray-600 text-center">{{ $event->start_date->format('H:i') }} WIB</p>
                    @if($event->location)
                    <p class="text-xs text-gray-500 text-center mt-2">{{ $event->location }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
@endsection