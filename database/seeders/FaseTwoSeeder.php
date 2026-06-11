<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\GalleryItem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class FaseTwoSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Kegiatan Masjid', 'slug' => 'kegiatan-masjid'],
            ['name' => 'Pengumuman', 'slug' => 'pengumuman'],
            ['name' => 'Artikel Dakwah', 'slug' => 'artikel-dakwah'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin Masjid',
                'email' => 'admin@masjidalkautsar.id',
            ]);
        }

        if (!$user->hasRole('super_admin')) {
            $user->assignRole('super_admin');
        }

        $editorUser = User::where('email', 'editor@masjidalkautsar.id')->first();
        if (!$editorUser) {
            $editorUser = User::factory()->create([
                'name' => 'Editor Masjid',
                'email' => 'editor@masjidalkautsar.id',
            ]);
        }
        if (!$editorUser->hasRole('editor')) {
            $editorUser->assignRole('editor');
        }

        $bendaharaUser = User::where('email', 'bendahara@masjidalkautsar.id')->first();
        if (!$bendaharaUser) {
            $bendaharaUser = User::factory()->create([
                'name' => 'Bendahara Masjid',
                'email' => 'bendahara@masjidalkautsar.id',
            ]);
        }
        if (!$bendaharaUser->hasRole('bendahara')) {
            $bendaharaUser->assignRole('bendahara');
        }

        $posts = [
            [
                'title' => 'Kajian Rutin Ahad Pagi: Tafsir Al-Quran',
                'content' => 'Masjid Al-Kautsar mengadakan kajian rutin setiap hari Ahad pagi setelah shalat Subuh. Kajian ini membahas tafsir Al-Quran dari Juz 1 hingga 30 secara bergantian. Kegiatan ini terbuka untuk seluruh jamaah dan masyarakat umum. Tidak dipungut biaya apapun. Mari bergabung dan tingkatkan pemahaman kita tentang Al-Quran.',
                'excerpt' => 'Kajian tafsir Al-Quran setiap Ahad pagi setelah Subuh. Terbuka untuk umum.',
                'category_id' => 1,
                'user_id' => $user->id,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Jadwal Pembersihan Masjid Bulan Ini',
                'content' => 'Dalam rangka menjaga kebersihan dan kenyamanan masjid, kami menginformasikan jadwal pembersihan masjid bulan ini. Kegiatan pembersihan akan dilaksanakan setiap hari Sabtu mulai pukul 08.00 WIB. Diharapkan partisipasi aktif dari seluruh jamaah. Kebersihan adalah sebagian dari iman.',
                'excerpt' => 'Jadwal gotong royong pembersihan masjid setiap hari Sabtu.',
                'category_id' => 2,
                'user_id' => $user->id,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Keutamaan Shalat Berjamaah di Masjid',
                'content' => 'Shalat berjamaah di masjid memiliki keutamaan yang sangat besar. Rasulullah SAW bersabda bahwa shalat berjamaah lebih utama 27 derajat dibandingkan shalat sendirian. Selain mendapatkan pahala yang berlipat, shalat berjamaah juga mempererat tali silaturahmi antar sesama muslim. Mari kita biasakan shalat berjamaah di masjid.',
                'excerpt' => 'Shalat berjamaah 27 derajat lebih utama dari shalat sendirian.',
                'category_id' => 3,
                'user_id' => $user->id,
                'published_at' => now(),
            ],
            [
                'title' => 'Program Santunan Anak Yatim Bulanan',
                'content' => 'Masjid Al-Kautsar secara rutin mengadakan program santunan untuk anak-anak yatim di sekitar lingkungan Green Jagakarsa. Program ini dilaksanakan setiap bulan pada minggu ketiga. Donasi dari jamaah yang mulia akan disalurkan sepenuhnya untuk kebutuhan pendidikan dan sehari-hari anak yatim. Semoga menjadi amal jariyah bagi kita semua.',
                'excerpt' => 'Santunan rutin anak yatim setiap minggu ketiga bulanan.',
                'category_id' => 1,
                'user_id' => $user->id,
                'published_at' => now()->addDays(1),
            ],
            [
                'title' => 'Tips Menjaga Kekhusyukan Dalam Shalat',
                'content' => 'Kekhusyukan dalam shalat adalah dambaan setiap muslim. Beberapa tips yang bisa dilakukan: memahami arti bacaan shalat, menghadirkan hati, membaca ayat-ayat Al-Quran dengan tartil, dan memilih tempat yang tenang. Dengan latihan dan istiqamah, insya Allah kekhusyukan shalat kita akan meningkat.',
                'excerpt' => 'Tips praktis meningkatkan kekhusyukan dalam shalat sehari-hari.',
                'category_id' => 3,
                'user_id' => $user->id,
                'published_at' => now()->addDays(3),
            ],
        ];

        foreach ($posts as $post) {
            Post::firstOrCreate(['title' => $post['title']], $post);
        }

        $events = [
            [
                'title' => 'Pengajian Akbar Bulanan',
                'description' => 'Pengajian akbar bulan ini akan membahas tema "Membangun Keluarga Sakinah". Menghadirkan penceramah kondang. Acara dimulai setelah shalat Maghrib. Bagi jamaah yang membawa anak-anak, tersedia area bermain yang aman.',
                'location' => 'Masjid Al-Kautsar Green Jagakarsa',
                'start_date' => now()->addDays(7)->setHour(18)->setMinute(30),
                'end_date' => now()->addDays(7)->setHour(20)->setMinute(0),
                'is_active' => true,
            ],
            [
                'title' => 'Buka Puasa Sunnah Senin-Kamis',
                'description' => 'Mari berbuka puasa sunnah bersama di Masjid Al-Kautsar. Tersedia takjil dan makanan berbuka gratis untuk seluruh jamaah. Acara dimulai sore hari menjelang Maghrib.',
                'location' => 'Masjid Al-Kautsar Green Jagakarsa',
                'start_date' => now()->addDays(3)->setHour(16)->setMinute(0),
                'end_date' => now()->addDays(3)->setHour(18)->setMinute(0),
                'is_active' => true,
            ],
            [
                'title' => 'Workshop Kaligrafi untuk Remaja',
                'description' => 'Workshop kaligrafi Islam untuk remaja usia 12-18 tahun. Belajar dasar-dasar kaligrafi khat Naskhi dan Tsuluts. Fasilitator berpengalaman. Peserta akan membawa pulang karya sendiri. Pendaftaran gratis.',
                'location' => 'Ruang Serbaguna Masjid Al-Kautsar',
                'start_date' => now()->addDays(14)->setHour(9)->setMinute(0),
                'end_date' => now()->addDays(14)->setHour(12)->setMinute(0),
                'is_active' => true,
            ],
        ];

        foreach ($events as $event) {
            Event::firstOrCreate(['title' => $event['title']], $event);
        }

        $gallery = Gallery::firstOrCreate(
            ['album_name' => 'Kegiatan Ramadhan 1447 H'],
            ['description' => 'Dokumentasi kegiatan selama bulan Ramadhan di Masjid Al-Kautsar.']
        );

        if ($gallery->items()->count() === 0) {
            $items = [
                ['caption' => 'Taraweh malam pertama', 'order' => 1],
                ['caption' => 'Kajian menjelang berbuka', 'order' => 2],
                ['caption' => 'Buka puasa bersama', 'order' => 3],
                ['caption' => 'Santunan anak yatim', 'order' => 4],
            ];

            foreach ($items as $item) {
                GalleryItem::create([
                    'gallery_id' => $gallery->id,
                    'image_path' => 'gallery/placeholder-' . $item['order'] . '.jpg',
                    'caption' => $item['caption'],
                    'order' => $item['order'],
                ]);
            }
        }
    }
}
