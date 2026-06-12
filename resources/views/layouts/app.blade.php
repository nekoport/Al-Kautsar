<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php($siteName = isset($mosque) ? $mosque->name : 'Masjid Al-Kautsar')
    <meta name="description" content="@yield('meta_description', $siteName . ' — tempat ibadah yang damai, terbuka untuk seluruh masyarakat. Informasi jadwal shalat, donasi, kegiatan, dan berita terbaru.')">
    <meta property="og:title" content="@yield('title', $siteName) - {{ $siteName }}">
    <meta property="og:description" content="@yield('meta_description', $siteName . ' — tempat ibadah yang damai, terbuka untuk seluruh masyarakat.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="canonical" href="{{ url()->current() }}">
    @if(isset($mosque) && $mosque->favicon)
    <link rel="icon" href="{{ '/storage/' . $mosque->favicon }}" type="image/x-icon">
    @else
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    @endif
    <title>@yield('title', $siteName) - {{ $siteName }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    @if(isset($mosque) && $mosque->logo)
                    <img src="{{ '/storage/' . $mosque->logo }}" alt="{{ $mosque->name }}" class="h-8 w-auto">
                    @else
                    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    </div>
                    @endif
                    <span class="font-semibold text-lg text-gray-900">{{ isset($mosque) ? $mosque->name : 'Masjid Al-Kautsar' }}</span>
                </a>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary transition">Beranda</a>
                    <a href="{{ route('profil') }}" class="text-gray-600 hover:text-primary transition">Profil</a>
                    <a href="{{ route('jadwal-shalat') }}" class="text-gray-600 hover:text-primary transition">Jadwal Shalat</a>
                    <a href="{{ route('donasi') }}" class="text-gray-600 hover:text-primary transition">Donasi</a>
                    <a href="{{ route('galeri') }}" class="text-gray-600 hover:text-primary transition">Galeri</a>
                    <a href="{{ route('kontak') }}" class="text-gray-600 hover:text-primary transition">Kontak</a>
                </div>
                <button class="md:hidden p-2 rounded-lg hover:bg-gray-100" type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-primary-light transition">Beranda</a>
                <a href="{{ route('profil') }}" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-primary-light transition">Profil</a>
                <a href="{{ route('jadwal-shalat') }}" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-primary-light transition">Jadwal Shalat</a>
                <a href="{{ route('donasi') }}" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-primary-light transition">Donasi</a>
                <a href="{{ route('galeri') }}" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-primary-light transition">Galeri</a>
                <a href="{{ route('kontak') }}" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-primary-light transition">Kontak</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-900" style="background: #0F6E56; color: #ffffff;">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        @if(isset($mosque) && $mosque->logo)
                        <img src="{{ '/storage/' . $mosque->logo }}" alt="{{ $mosque->name }}" class="h-8 w-auto brightness-0 invert">
                        @else
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        </div>
                        @endif
                        <span class="font-semibold text-lg text-white">{{ isset($mosque) ? $mosque->name : 'Masjid Al-Kautsar' }}</span>
                    </div>
                    @php($footerText = isset($mosque) && $mosque->footer_text ? $mosque->footer_text : (isset($mosque) ? $mosque->name : 'Masjid Al-Kautsar') . ' — tempat ibadah yang damai, terbuka untuk semua.')
                    <p class="text-sm text-white">{{ $footerText }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-3">Navigasi</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="text-white hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('profil') }}" class="text-white hover:text-white transition">Profil</a></li>
                        <li><a href="{{ route('jadwal-shalat') }}" class="text-white hover:text-white transition">Jadwal Shalat</a></li>
                        <li><a href="{{ route('donasi') }}" class="text-white hover:text-white transition">Donasi</a></li>
                        <li><a href="{{ route('galeri') }}" class="text-white hover:text-white transition">Galeri</a></li>
                        <li><a href="{{ route('kontak') }}" class="text-white hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-3">Kontak</h3>
                    <ul class="space-y-2 text-sm text-white">
                        <li>Green Jagakarsa, Jakarta Selatan</li>
                        @if(isset($mosque))
                        <li>{{ $mosque->phone }}</li>
                        <li>{{ $mosque->email }}</li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/20 mt-8 pt-8 text-center text-sm text-white">
                &copy; {{ date('Y') }} Masjid Al-Kautsar Green Jagakarsa. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>