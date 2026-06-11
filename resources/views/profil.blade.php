@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <div class="bg-primary-light py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Profil Masjid</h1>
            <p class="text-gray-600">Mengenal lebih dekat Masjid Al-Kautsar Green Jagakarsa</p>
        </div>
    </div>

    @php
        $profile = App\Models\MosqueProfile::first();
    @endphp

    @if($profile)
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-2xl p-8 md:p-12 shadow-sm border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Sejarah</h2>
            <div class="prose prose-gray max-w-none leading-relaxed">
                {{ $profile->history ?? 'Belum ada data sejarah.' }}
            </div>
        </div>
        @if($profile->vision || $profile->mission)
        <div class="grid md:grid-cols-2 gap-8 mt-8">
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Visi</h2>
                <p class="text-gray-600 leading-relaxed">{{ $profile->vision }}</p>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Misi</h2>
                <p class="text-gray-600 leading-relaxed">{{ $profile->mission }}</p>
            </div>
        </div>
        @endif
    </div>
    @endif

    <div class="bg-primary-light py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Pengurus Masjid</h2>
                <p class="text-gray-600">Dewan pengurus yang melayani masyarakat</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @php $officials = App\Models\Official::where('is_active', true)->orderBy('order')->get(); @endphp
                @forelse($officials as $official)
                <div class="bg-white rounded-2xl p-8 text-center shadow-sm border border-gray-100">
                    <div class="w-24 h-24 bg-primary-light rounded-full mx-auto mb-4 flex items-center justify-center overflow-hidden">
                        @if($official->photo)
                        <img src="{{ asset('storage/' . $official->photo) }}" alt="{{ $official->name }}" class="w-full h-full object-cover">
                        @else
                        <span class="text-3xl font-bold text-primary">{{ substr($official->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $official->name }}</h3>
                    <p class="text-primary font-medium text-sm mt-1">{{ $official->position }}</p>
                    @if($official->bio)
                    <p class="text-gray-600 text-sm mt-3">{{ $official->bio }}</p>
                    @endif
                </div>
                @empty
                <p class="col-span-3 text-center text-gray-500">Belum ada data pengurus.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection