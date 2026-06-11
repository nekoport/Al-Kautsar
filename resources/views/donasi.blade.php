@extends('layouts.app')

@section('title', 'Donasi')

@section('content')
    <div class="bg-primary-light py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Donasi</h1>
            <p class="text-gray-600">Salurkan donasi Anda melalui rekening resmi Masjid Al-Kautsar</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($donation)
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Rekening Donasi</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Bank</p>
                        <p class="font-semibold text-gray-900">{{ $donation->bank_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Nomor Rekening</p>
                        <p class="font-semibold text-gray-900 text-lg tracking-wider">{{ $donation->account_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Atas Nama</p>
                        <p class="font-semibold text-gray-900">{{ $donation->account_name }}</p>
                    </div>
                    @if($donation->notes)
                    <div>
                        <p class="text-sm text-gray-500">Keterangan</p>
                        <p class="text-gray-700">{{ $donation->notes }}</p>
                    </div>
                    @endif
                </div>
                <div class="flex items-center justify-center">
                    @if($donation->qris_image)
                    <img src="{{ asset('storage/' . $donation->qris_image) }}" alt="QRIS" class="max-w-[200px] rounded-xl shadow-sm">
                    @else
                    <div class="w-48 h-48 bg-gray-100 rounded-xl flex items-center justify-center">
                        <p class="text-gray-400 text-sm">QRIS tidak tersedia</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-16">
            <p class="text-gray-500 text-lg">Belum ada informasi donasi.</p>
        </div>
        @endif
    </div>
@endsection