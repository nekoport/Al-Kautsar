@extends('layouts.app')

@section('title', 'Jadwal Shalat')

@section('content')
    <div class="bg-primary-light py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Jadwal Shalat</h1>
            <p class="text-gray-600">Waktu shalat untuk wilayah Green Jagakarsa, Jakarta Selatan</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($prayerTimes && !empty($prayerTimes['timings']))
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-primary text-white px-6 py-4">
                <p class="text-sm opacity-80">{{ $prayerTimes['date'] ?? '' }}</p>
                <p class="font-semibold">Jadwal Shalat Hari Ini</p>
            </div>
            <div class="divide-y divide-gray-100">
                @foreach([
                    'Fajr' => 'Subuh',
                    'Sunrise' => 'Terbit',
                    'Dhuhr' => 'Dzuhur',
                    'Asr' => 'Ashar',
                    'Maghrib' => 'Maghrib',
                    'Isha' => 'Isya'
                ] as $key => $label)
                <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition">
                    <span class="font-medium text-gray-900">{{ $label }}</span>
                    <span class="text-primary font-semibold text-lg">{{ $prayerTimes['timings'][$key] ?? '-' }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="text-center py-16">
            <p class="text-gray-500 text-lg">Gagal memuat jadwal shalat. Silakan coba kembali nanti.</p>
        </div>
        @endif

        <div class="mt-8 bg-primary-light rounded-2xl p-6 text-center">
            <p class="text-gray-700 text-sm">
                Data waktu shalat bersumber dari API Aladhan.com menggunakan metode Kemenag RI (Method 11).
                <br>Koordinat: -6.3319, 106.8178 (Green Jagakarsa).
            </p>
        </div>
    </div>
@endsection