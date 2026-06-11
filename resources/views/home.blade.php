@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-primary-light to-transparent"></div>
        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 leading-tight mb-6">
                    Selamat Datang di
                    <span class="text-primary">Masjid Al-Kautsar</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 mb-10 leading-relaxed">
                    Masjid Al-Kautsar Green Jagakarsa — rumah ibadah yang damai, terbuka untuk seluruh masyarakat.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('profil') }}" class="px-8 py-3 bg-primary text-white rounded-full font-medium hover:bg-primary/90 transition shadow-md">Tentang Kami</a>
                    <a href="{{ route('donasi') }}" class="px-8 py-3 border-2 border-primary text-primary rounded-full font-medium hover:bg-primary hover:text-white transition">Donasi</a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Akses Cepat</h2>
            <p class="text-gray-600">Layanan dan informasi yang Anda butuhkan</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <a href="{{ route('jadwal-shalat') }}" class="group p-8 bg-white rounded-2xl shadow-sm hover:shadow-md transition border border-gray-100">
                <div class="w-12 h-12 bg-primary-light rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary transition-colors">
                    <svg class="w-6 h-6 text-primary group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Jadwal Shalat</h3>
                <p class="text-gray-600 text-sm">Informasi waktu shalat lima waktu untuk wilayah Jagakarsa.</p>
            </a>
            <a href="{{ route('donasi') }}" class="group p-8 bg-white rounded-2xl shadow-sm hover:shadow-md transition border border-gray-100">
                <div class="w-12 h-12 bg-primary-light rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary transition-colors">
                    <svg class="w-6 h-6 text-primary group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Donasi</h3>
                <p class="text-gray-600 text-sm">Salurkan donasi Anda melalui rekening resmi masjid.</p>
            </a>
            <a href="{{ route('kontak') }}" class="group p-8 bg-white rounded-2xl shadow-sm hover:shadow-md transition border border-gray-100">
                <div class="w-12 h-12 bg-primary-light rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary transition-colors">
                    <svg class="w-6 h-6 text-primary group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Kontak</h3>
                <p class="text-gray-600 text-sm">Hubungi kami untuk informasi lebih lanjut.</p>
            </a>
        </div>
    </div>

    <div class="bg-primary-light py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Jadwal Shalat Hari Ini</h2>
                <p class="text-gray-600">Wilayah Green Jagakarsa, Jakarta Selatan</p>
            </div>
            @php
                $prayerTimes = \Illuminate\Support\Facades\Cache::remember('prayer_times_today', 86400, function () {
                    try {
                        $client = new \GuzzleHttp\Client(['timeout' => 10]);
                        $response = $client->get('https://api.aladhan.com/v1/timingsByCity', [
                            'query' => [
                                'city' => 'Jakarta',
                                'country' => 'Indonesia',
                                'method' => 11,
                            ]
                        ]);
                        $data = json_decode($response->getBody(), true);
                        return $data['data']['timings'] ?? [];
                    } catch (\Exception $e) {
                        return [];
                    }
                });
            @endphp
            @if(!empty($prayerTimes))
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach(['Fajr' => 'Subuh', 'Dhuhr' => 'Dzuhur', 'Asr' => 'Ashar', 'Maghrib' => 'Maghrib', 'Isha' => 'Isya'] as $key => $label)
                <div class="bg-white rounded-xl p-5 text-center shadow-sm border border-gray-100">
                    <p class="text-sm text-gray-500 mb-1">{{ $label }}</p>
                    <p class="text-xl font-semibold text-primary">{{ $prayerTimes[$key] ?? '-' }}</p>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-center text-gray-500">Gagal memuat jadwal shalat. Silakan coba kembali nanti.</p>
            @endif
        </div>
    </div>
@endsection