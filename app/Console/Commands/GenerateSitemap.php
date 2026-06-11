<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Post;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate the sitemap.xml for the website';

    public function handle()
    {
        $sitemap = SitemapGenerator::create(config('app.url'))
            ->getSitemap();

        $sitemap->add(Url::create('/')->setPriority(1.0));
        $sitemap->add(Url::create('/profil')->setPriority(0.8));
        $sitemap->add(Url::create('/jadwal-shalat')->setPriority(0.7));
        $sitemap->add(Url::create('/donasi')->setPriority(0.7));
        $sitemap->add(Url::create('/kontak')->setPriority(0.6));
        $sitemap->add(Url::create('/berita')->setPriority(0.8));
        $sitemap->add(Url::create('/kegiatan')->setPriority(0.7));
        $sitemap->add(Url::create('/galeri')->setPriority(0.6));
        $sitemap->add(Url::create('/streaming')->setPriority(0.5));

        Post::where('published_at', '<=', now())->each(function (Post $post) use ($sitemap) {
            $sitemap->add(
                Url::create("/berita/{$post->slug}")
                    ->setLastModificationDate($post->published_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.6)
            );
        });

        Event::where('is_active', true)->each(function (Event $event) use ($sitemap) {
            $sitemap->add(
                Url::create("/kegiatan")
                    ->setLastModificationDate($event->start_date)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.5)
            );
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully at public/sitemap.xml');
    }
}
