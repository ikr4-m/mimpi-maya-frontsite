<?php

namespace Database\Seeders;

use App\Models\AuditionContent;
use App\Models\AuditionSetting;
use Illuminate\Database\Seeder;

class AuditionSeeder extends Seeder
{
    public function run(): void
    {
        AuditionSetting::firstOrCreate(
            ['id' => 1],
            [
                'form_url' => '',
                'audition_start' => '2026-07-10 00:00:00',
                'audition_end' => '2026-08-10 23:59:59',
                'tagline' => 'Your Voice. Your Character. Your Story.',
                'about_title' => 'Apa sih ini?',
                'about_description' => "Diluncurkan pada Agustus 2024, MIMPI MAYA hadir untuk mengembangkan industri hiburan lewat penciptaan Virtual Talent. Kami berkomitmen menghadirkan hiburan berkualitas tinggi serta membangun lingkungan yang interaktif bagi audiens maupun talent.\n\nDengan semangat ini, MIMPI MAYA kini membuka audisi resmi. Kami mengundang kamu yang ingin mengekspresikan diri tanpa batas di dunia digital untuk tumbuh bersama agensi yang suportif. Siapkan dirimu, dan ikuti audisinya!",
                'is_active' => true,
            ]
        );

        $timelines = [
            ['date' => '2026-07-10 00:00:00', 'title' => 'Pendaftaran Dibuka', 'description' => 'Periode pendaftaran resmi dibuka untuk semua calon Virtual Liver.'],
            ['date' => '2026-08-10 00:00:00', 'title' => 'Pendaftaran Ditutup', 'description' => 'Batas akhir pengiriman formulir dan sample audisi.'],
            ['date' => '2026-08-11 00:00:00', 'title' => 'Interview 1', 'description' => 'Sesi perkenalan dan diskusi singkat.'],
            ['date' => '2026-08-18 00:00:00', 'title' => 'Interview 2', 'description' => 'Sesi penyaringan lebih mendalam terkait komitmen, kesiapan, dan visi kontenmu.'],
            ['date' => '2026-08-25 00:00:00', 'title' => 'Persiapan Debut', 'description' => 'Pengumuman akhir dan persiapan debut.'],
        ];

        foreach ($timelines as $index => $item) {
            AuditionContent::firstOrCreate(
                ['type' => 'timeline', 'title' => $item['title']],
                [
                    'description' => $item['description'],
                    'date' => $item['date'],
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
        }

        $requirements = [
            ['icon' => 'check-circle', 'title' => 'Berusia 18+', 'description' => 'Minimal berusia 18 tahun saat pendaftaran dibuka.'],
            ['icon' => 'check-circle', 'title' => 'WNI', 'description' => 'Pendaftar wajib tinggal, berdomisili, dan hidup di Indonesia.'],
            ['icon' => 'book-open', 'title' => 'Komitmen Konten', 'description' => 'Bersedia membuat konten secara konsisten sesuai jadwal.'],
            ['icon' => 'calendar', 'title' => 'Waktu Luang', 'description' => 'Memiliki jadwal yang fleksibel untuk streaming dan meeting.'],
            ['icon' => 'check-circle', 'title' => 'Koneksi Stabil', 'description' => 'Internet yang cukup untuk live streaming tanpa kendala.'],
            ['icon' => 'users-three', 'title' => 'Tidak Jaim', 'description' => 'Semua orang di dalam sini gila kok!'],
        ];

        foreach ($requirements as $index => $item) {
            AuditionContent::firstOrCreate(
                ['type' => 'requirement', 'title' => $item['title']],
                [
                    'icon' => $item['icon'],
                    'description' => $item['description'],
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
        }

        $benefits = [
            ['icon' => 'gift', 'title' => 'Alat Livestream', 'description' => 'Peralatan streaming dan rekaman disediakan agar kamu bisa fokus berkonten.'],
            ['icon' => 'user', 'title' => 'Aset Virtual dan Karakter', 'description' => 'Disediakan sepenuhnya oleh Mimpi Maya (yang ada di spoiler btw).'],
            ['icon' => 'gear', 'title' => 'Manajemen', 'description' => 'Tim manajemen profesional membantu jadwal, strategi, dan pengembangan karirmu.'],
            ['icon' => 'trend-up', 'title' => 'Marketing', 'description' => 'Pusing urusan Personal Branding? Ada abang-abangannya di sini.'],
            ['icon' => 'crown', 'title' => 'Komunitas & Dukungan', 'description' => 'Bergabung dengan komunitas kreator yang saling support dan berkembang bersama.'],
        ];

        foreach ($benefits as $index => $item) {
            AuditionContent::firstOrCreate(
                ['type' => 'benefit', 'title' => $item['title']],
                [
                    'icon' => $item['icon'],
                    'description' => $item['description'],
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
        }

        $aboutCards = [
            ['icon' => 'microphone', 'title' => 'Your Voice', 'description' => 'Biarkan dunia mendengar ciri khas dan keunikan suaramu.'],
            ['icon' => 'user', 'title' => 'Your Character', 'description' => 'Desain avatar virtual yang beneran mencerminkan persona unikmu.'],
            ['icon' => 'book-open', 'title' => 'Your Story', 'description' => 'Buat konten menarik yang bikin audiens betah dan terhubung.'],
        ];

        foreach ($aboutCards as $index => $item) {
            AuditionContent::firstOrCreate(
                ['type' => 'about_card', 'title' => $item['title']],
                [
                    'icon' => $item['icon'],
                    'description' => $item['description'],
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
        }

        $contactLinks = [
            ['label' => 'Instagram', 'url' => 'https://www.instagram.com/mimpimaya_/', 'icon' => 'instagram-logo'],
            ['label' => 'Twitter / X', 'url' => 'https://x.com/mimpimaya_', 'icon' => 'x-logo'],
            ['label' => 'YouTube', 'url' => 'https://www.youtube.com/@MimpiMaya', 'icon' => 'youtube-logo'],
            ['label' => 'Email', 'url' => 'mailto:mimpimayamedia@gmail.com', 'icon' => 'envelope'],
        ];

        foreach ($contactLinks as $index => $item) {
            AuditionContent::firstOrCreate(
                ['type' => 'contact_link', 'label' => $item['label']],
                [
                    'url' => $item['url'],
                    'icon' => $item['icon'],
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
        }
    }
}
