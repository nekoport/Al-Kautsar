<?php

namespace App\Http\Controllers;

use App\Models\MosqueProfile;
use App\Models\Official;
use App\Models\DonationInfo;
use App\Models\Post;
use App\Models\Category;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Streaming;
use App\Models\Announcement;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $mosque = MosqueProfile::first();

        $latestPosts = Post::where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();

        $upcomingEvents = Event::where('is_active', true)
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->take(3)
            ->get();

        $announcement = Announcement::where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>=', now());
            })
            ->latest()
            ->first();

        return view('home', compact(
            'mosque', 'latestPosts',
            'upcomingEvents', 'announcement'
        ));
    }

    public function profil()
    {
        $mosque = MosqueProfile::first();
        $officials = Official::where('is_active', true)
                        ->orderBy('order')
                        ->get();

        return view('profil', compact('mosque', 'officials'));
    }

    public function jadwalShalat()
    {
        $prayerTimes = Cache::remember('prayer_times_today', 86400, function () {
            try {
                $response = Http::timeout(10)->get('https://api.aladhan.com/v1/timings', [
                    'latitude' => -6.3319,
                    'longitude' => 106.8178,
                    'method' => 11,
                ]);

                if ($response->failed()) {
                    return null;
                }

                $data = $response->json();
                $timings = $data['data']['timings'] ?? [];
                $date = $data['data']['date']['readable'] ?? date('d-m-Y');

                return ['timings' => $timings, 'date' => $date];
            } catch (\Exception $e) {
                return null;
            }
        });

        return view('jadwal-shalat', compact('prayerTimes'));
    }

    public function donasi()
    {
        $donation = DonationInfo::first();

        return view('donasi', compact('donation'));
    }

    public function kontak()
    {
        $mosque = MosqueProfile::first();

        return view('kontak', compact('mosque'));
    }

    public function berita()
    {
        $posts = Post::where('published_at', '<=', now())
                    ->orderBy('published_at', 'desc')
                    ->paginate(9);

        return view('berita', compact('posts'));
    }

    public function beritaDetail($slug)
    {
        $post = Post::where('slug', $slug)
                   ->where('published_at', '<=', now())
                   ->firstOrFail();

        $related = Post::where('category_id', $post->category_id)
                      ->where('id', '!=', $post->id)
                      ->where('published_at', '<=', now())
                      ->latest('published_at')
                      ->take(3)
                      ->get();

        return view('berita-detail', compact('post', 'related'));
    }

    public function kegiatan()
    {
        $events = Event::where('is_active', true)
                      ->where('start_date', '>=', now())
                      ->orderBy('start_date')
                      ->get();

        $months = $events->groupBy(function ($event) {
            return $event->start_date->format('F Y');
        });

        return view('kegiatan', compact('events', 'months'));
    }

    public function galeri()
    {
        $galleries = Gallery::with('items')->latest()->get();

        return view('galeri', compact('galleries'));
    }

    public function streaming()
    {
        $live = Streaming::where('is_live', true)->first();
        $upcoming = Streaming::where('is_live', false)
                            ->where('scheduled_at', '>=', now())
                            ->orderBy('scheduled_at')
                            ->get();

        return view('streaming', compact('live', 'upcoming'));
    }
}