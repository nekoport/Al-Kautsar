@extends('layouts.app')

@section('title', 'Donasi')

@section('content')
    <div class="bg-primary-light py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Donasi</h1>
            <p class="text-gray-600">Salurkan donasi Anda melalui rekening resmi Masjid Al-Kautsar</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
        @if($bankDonations->isNotEmpty())
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Transfer Bank</h2>
            <div class="flex flex-wrap justify-center gap-8">
                @foreach($bankDonations as $bank)
                <div class="space-y-4 p-5 bg-gray-50 rounded-xl border border-gray-100 w-full max-w-sm">
                    <div>
                        <p class="text-sm text-gray-500">Bank</p>
                        <p class="font-semibold text-gray-900">{{ $bank->bank_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Nomor Rekening</p>
                        <p class="font-semibold text-gray-900 text-lg tracking-wider">{{ $bank->account_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Atas Nama</p>
                        <p class="font-semibold text-gray-900">{{ $bank->account_name }}</p>
                    </div>
                    @if($bank->notes)
                    <div>
                        <p class="text-sm text-gray-500">Keterangan</p>
                        <p class="text-gray-700">{{ $bank->notes }}</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($qrisDonations->isNotEmpty())
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            <h2 class="text-xl font-bold text-gray-900 mb-6">QRIS</h2>
            <div class="flex flex-wrap justify-center gap-8">
                @foreach($qrisDonations as $qris)
                <div class="p-5 bg-gray-50 rounded-xl border border-gray-100 w-full max-w-sm">
                    <div class="flex justify-center">
                        @if($qris->qris_image)
                        <img src="{{ asset('storage/' . $qris->qris_image) }}" alt="QRIS" class="max-w-[200px] rounded-xl shadow-sm" loading="lazy">
                        @else
                        <div class="w-48 h-48 bg-gray-100 rounded-xl flex items-center justify-center">
                            <p class="text-gray-400 text-sm">QRIS tidak tersedia</p>
                        </div>
                        @endif
                    </div>
                    @if($qris->notes)
                    <p class="text-gray-700 text-sm mt-4 text-center w-full">{{ $qris->notes }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($bankDonations->isEmpty() && $qrisDonations->isEmpty())
        <div class="text-center py-16">
            <p class="text-gray-500 text-lg">Belum ada informasi donasi.</p>
        </div>
        @endif
    </div>
@endsection
