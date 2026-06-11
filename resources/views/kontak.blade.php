@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
    <div class="bg-primary-light py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Kontak</h1>
            <p class="text-gray-600">Hubungi kami untuk informasi lebih lanjut</p>
        </div>
    </div>

    @php $profile = App\Models\MosqueProfile::first(); @endphp

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-2 gap-12">
            <div class="space-y-8">
                @if($profile)
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Informasi Kontak</h2>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-primary-light rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Alamat</p>
                                <p class="text-gray-600">{{ $profile->address }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-primary-light rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Telepon</p>
                                <p class="text-gray-600">{{ $profile->phone }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-primary-light rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Email</p>
                                <p class="text-gray-600">{{ $profile->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100" style="min-height: 400px;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.4992149618224!2d106.8178!3d-6.3319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTknNTQuOCJTIDEwNsKwNDknMDQuMSJF!5e0!3m2!1sen!2sid!4v1"
                    width="100%"
                    height="100%"
                    style="border:0; min-height: 400px;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Google Maps - Green Jagakarsa">
                </iframe>
            </div>
        </div>
    </div>
@endsection