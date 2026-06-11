<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MosqueProfile;
use App\Models\Official;

class MosqueSeeder extends Seeder
{
    public function run(): void
    {
        MosqueProfile::create([
            'name' => 'Masjid Al-Kautsar Green Jagakarsa',
            'address' => 'Green Jagakarsa, Jagakarsa, Jakarta Selatan, DKI Jakarta 12620',
            'phone' => '021-12345678',
            'email' => 'info@masjidalkautsar.id',
            'history' => 'Masjid Al-Kautsar Green Jagakarsa dibangun sebagai pusat ibadah dan kegiatan masyarakat di kawasan Green Jagakarsa, Jakarta Selatan. Masjid ini hadir untuk melayani kebutuhan spiritual warga serta menjadi pusat kegiatan sosial kemasyarakatan.',
            'vision' => 'Menjadi pusat ibadah dan peradaban Islam yang rahmatan lil alamin, berkontribusi dalam membangun masyarakat yang beriman, berilmu, dan berakhlak mulia.',
            'mission' => 'Menyelenggarakan ibadah dan kegiatan keagamaan yang berkualitas; Mengembangkan pendidikan Islam yang inklusif; Menjalin silaturahmi dan kerjasama dengan masyarakat; Mengelola dana amanah secara transparan dan profesional.',
        ]);

        $officials = [
            [
                'name' => 'Ustadz Ahmad Fauzi',
                'position' => 'Ketua DKM',
                'bio' => 'Aktif dalam dakwah dan pembinaan umat di Jakarta Selatan.',
                'order' => 1,
            ],
            [
                'name' => 'Ustadzah Siti Nuraini',
                'position' => 'Sekretaris',
                'bio' => 'Berpengalaman dalam manajemen organisasi keagamaan.',
                'order' => 2,
            ],
            [
                'name' => 'Bapak H. Abdullah',
                'position' => 'Bendahara',
                'bio' => 'Mengelola keuangan masjid secara amanah dan transparan.',
                'order' => 3,
            ],
        ];

        foreach ($officials as $official) {
            Official::create($official);
        }
    }
}