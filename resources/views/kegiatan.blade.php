@extends('layouts.app')

@section('title', 'Kegiatan')

@section('content')
    <div class="bg-primary-light py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Kegiatan</h1>
            <p class="text-gray-600">Agenda dan acara mendatang di Masjid Al-Kautsar</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($events->isEmpty())
        <p class="text-center text-gray-500 py-16">Belum ada kegiatan mendatang.</p>
        @else
            @foreach($months as $month => $monthEvents)
            <div class="mb-12">
                <h2 class="text-xl font-bold text-gray-900 mb-6">{{ $month }}</h2>
                <div class="space-y-4">
                    @foreach($monthEvents as $event)
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex items-start gap-4">
                            <div class="text-center flex-shrink-0 w-16">
                                <div class="text-2xl font-bold text-primary">{{ $event->start_date->format('d') }}</div>
                                <div class="text-sm text-gray-500">{{ $event->start_date->format('M') }}</div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-gray-900 mb-1">{{ $event->title }}</h3>
                                <p class="text-sm text-gray-500 mb-2">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $event->start_date->format('H:i') }} WIB
                                    @if($event->location)
                                    <span class="mx-2">&middot;</span>
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $event->location }}
                                    @endif
                                </p>
                                @if($event->description)
                                <p class="text-sm text-gray-600">{{ $event->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        @endif
    </div>
@endsection
