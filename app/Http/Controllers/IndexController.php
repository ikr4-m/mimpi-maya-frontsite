<?php

namespace App\Http\Controllers;

use App\Models\AuditionSetting;
use App\Models\AuditionContent;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class IndexController extends Controller
{
    public function home(): View
    {
        $talents = $this->getMockTalents();
        $projects = array_slice($this->getMockProjects(), 0, 3);
        return view('home', compact('talents', 'projects'));
    }

    public function talent(): View
    {
        $talents = $this->getMockTalents();
        $generations = ['Semua', 'Chapter 01', 'Chapter 02'];
        return view('talent.index', compact('talents', 'generations'));
    }

    public function talentShow(string $vtuber_name): View
    {
        $talents = $this->getMockTalents();
        $talent = collect($talents)->firstWhere('slug', $vtuber_name);

        if (!$talent) {
            abort(404, 'Talenta tidak ditemukan.');
        }

        $otherTalents = collect($talents)->where('slug', '!==', $vtuber_name)->values()->all();
        $relatedProjects = collect($this->getMockProjects())
            ->filter(fn ($project) => str_contains($project['talents'], $talent['name']) || str_contains($project['talents'], 'Chapter 01'))
            ->values()
            ->all();

        return view('talent.show', compact('talent', 'otherTalents', 'relatedProjects'));
    }

    public function project(): View
    {
        $projects = $this->getMockProjects();
        $categories = ['Semua', 'Music', 'Event', 'Merchandise', 'Collab'];
        return view('project.index', compact('projects', 'categories'));
    }

    public function about(): View
    {
        $aboutCards = AuditionContent::active()->byType('about_card')->orderBy('sort_order')->get();
        $pillars = [
            [
                'title' => 'Eksplorasi Kreatif Tanpa Batas',
                'description' => 'Mendukung setiap talenta untuk mengeksplorasi persona, minat seni, dan musikalitas mereka secara bebas dan otentik.',
                'icon' => 'sparkle',
            ],
            [
                'title' => 'Produksi Musik & Panggung 3D',
                'description' => 'Didukung alur kerja modern dari rekaman orisinal hingga integrasi model dan panggung virtual 3D interaktif.',
                'icon' => 'broadcast',
            ],
            [
                'title' => 'Komunitas Inklusif & Hangat',
                'description' => 'Membangun jembatan interaksi yang aman, suportif, dan penuh keceriaan antara talenta dan penggemar global.',
                'icon' => 'users',
            ],
            [
                'title' => 'Integritas & Kolaborasi Terpercaya',
                'description' => 'Menjunjung tinggi profesionalisme dalam setiap kemitraan komersial, event resmi, dan perlindungan privasi talenta.',
                'icon' => 'shield-check',
            ],
        ];

        $milestones = [
            ['year' => '2024', 'title' => 'Fondasi Agensi', 'description' => 'Pembentukan visi Mimpi Maya dan inisiasi program pelatihan bakat perdana.'],
            ['year' => '2025', 'title' => 'Debut Chapter 01', 'description' => 'Peluncuran resmi Kuroko Dille, Anne Droitte, dan Biyu Nara ke panggung virtual.'],
            ['year' => '2026', 'title' => 'Ekspansi Chapter 02 & Konser 3D', 'description' => 'Penyelenggaraan konser 3D perdana serta pembukaan pendaftaran audisi generasi baru.'],
        ];

        return view('about', compact('aboutCards', 'pillars', 'milestones'));
    }

    /**
     * Mock data repository for talents.
     * When database tables are introduced, replace this with Eloquent queries.
     *
     * @return array<int, array<string, mixed>>
     */
    private function getMockTalents(): array
    {
        return [
            [
                'slug' => 'kuroko-dille',
                'name' => 'Kuroko Dille',
                'japanese_name' => 'クロコ・ディル',
                'gen' => 'Chapter 01',
                'tag' => 'Crocodile Detective',
                'theme_color' => '#eab308',
                'theme_color_soft' => 'rgba(234, 179, 8, 0.15)',
                'image' => 'images/talents/kuroko-dille.webp',
                'catchphrase' => 'Keberuntungan atau deduksi? Semua misteri pasti punya jawaban!',
                'bio' => 'Seorang detektif buaya yang gemar memecahkan teka-teki rumit sambil menyeduh secangkir teh hangat. Dikenal santai namun memiliki deduksi tajam serta komedi spontan saat siaran.',
                'debut_date' => '10 Januari 2025',
                'status' => 'Aktif',
                'stats' => [
                    'birthday' => '14 Mei',
                    'height' => '168 cm',
                    'zodiac' => 'Taurus',
                    'fan_name' => 'Dille-ctives',
                    'hashtag_stream' => '#KurokoLive',
                    'hashtag_art' => '#DilleArt',
                ],
                'socials' => [
                    ['platform' => 'YouTube', 'icon' => 'youtube-logo', 'url' => 'https://youtube.com', 'handle' => '@KurokoDille'],
                    ['platform' => 'X (Twitter)', 'icon' => 'twitter-logo', 'url' => 'https://x.com', 'handle' => '@KurokoDille'],
                    ['platform' => 'TikTok', 'icon' => 'tiktok-logo', 'url' => 'https://tiktok.com', 'handle' => '@kurokodille'],
                ],
                'featured_videos' => [
                    ['title' => '【DEBUT STREAM】Membuka Kantor Detektif Pertama!', 'views' => '45K views', 'duration' => '1:45:20'],
                    ['title' => 'Cover Song: "Sherlock In The Dark" [Official MV]', 'views' => '120K views', 'duration' => '3:45'],
                    ['title' => '【KARAOKE】Bernyanyi Lagu Pop 90-an Sampai Subuh', 'views' => '32K views', 'duration' => '2:15:00'],
                ],
            ],
            [
                'slug' => 'anne-droitte',
                'name' => 'Anne Droitte',
                'japanese_name' => 'アン・ドロイト',
                'gen' => 'Chapter 01',
                'tag' => 'Android Virtuoso',
                'theme_color' => '#38bdf8',
                'theme_color_soft' => 'rgba(56, 189, 248, 0.15)',
                'image' => 'images/talents/anne-droitte.webp',
                'catchphrase' => 'Menghubungkan data dan nada ke dalam frekuensi hatimu.',
                'bio' => 'Unit android musikal generasi mutakhir yang mempelajari emosi manusia melalui melodi dan interaksi hangat. Suara merdu dan kemampuan aransemen musiknya menghipnotis siapa pun yang mendengarkan.',
                'debut_date' => '11 Januari 2025',
                'status' => 'Aktif',
                'stats' => [
                    'birthday' => '28 November',
                    'height' => '160 cm',
                    'zodiac' => 'Sagittarius',
                    'fan_name' => 'Droitties',
                    'hashtag_stream' => '#AnneStream',
                    'hashtag_art' => '#AnneGallery',
                ],
                'socials' => [
                    ['platform' => 'YouTube', 'icon' => 'youtube-logo', 'url' => 'https://youtube.com', 'handle' => '@AnneDroitte'],
                    ['platform' => 'X (Twitter)', 'icon' => 'twitter-logo', 'url' => 'https://x.com', 'handle' => '@AnneDroitte'],
                    ['platform' => 'TikTok', 'icon' => 'tiktok-logo', 'url' => 'https://tiktok.com', 'handle' => '@annedroitte'],
                ],
                'featured_videos' => [
                    ['title' => '【ORIGINAL SONG】Synaptic Resonance - Anne Droitte', 'views' => '210K views', 'duration' => '4:12'],
                    ['title' => '【PIANO STREAM】Bermain Musik Relaksasi Sebelum Tidur', 'views' => '68K views', 'duration' => '2:30:10'],
                    ['title' => '【COLLAB】Duet Nyanyi Bersama Teman Chapter 01', 'views' => '94K views', 'duration' => '1:50:00'],
                ],
            ],
            [
                'slug' => 'biyu-nara',
                'name' => 'Biyu Nara',
                'japanese_name' => 'ビユ・ナラ',
                'gen' => 'Chapter 01',
                'tag' => 'Celestial Tiger',
                'theme_color' => '#f97316',
                'theme_color_soft' => 'rgba(249, 115, 22, 0.15)',
                'image' => 'images/talents/biyu-nara.webp',
                'catchphrase' => 'Auman dari rimba mimpi yang siap mengguncang panggung virtual!',
                'bio' => 'Harimau penjaga spiritual dari alam mimpi yang melompat ke dimensi manusia untuk menjadi idola paling membara. Penuh energi, tawa riang, dan kecintaan mendalam pada turnamen game kompetitif.',
                'debut_date' => '12 Januari 2025',
                'status' => 'Aktif',
                'stats' => [
                    'birthday' => '8 Agustus',
                    'height' => '155 cm',
                    'zodiac' => 'Leo',
                    'fan_name' => 'Naranation',
                    'hashtag_stream' => '#BiyuRoar',
                    'hashtag_art' => '#NaraSketch',
                ],
                'socials' => [
                    ['platform' => 'YouTube', 'icon' => 'youtube-logo', 'url' => 'https://youtube.com', 'handle' => '@BiyuNara'],
                    ['platform' => 'X (Twitter)', 'icon' => 'twitter-logo', 'url' => 'https://x.com', 'handle' => '@BiyuNara'],
                    ['platform' => 'TikTok', 'icon' => 'tiktok-logo', 'url' => 'https://tiktok.com', 'handle' => '@biyunara'],
                ],
                'featured_videos' => [
                    ['title' => '【APEX LEGENDS】Ranked Grind Sampai Predator bareng Chat!', 'views' => '52K views', 'duration' => '3:40:00'],
                    ['title' => '【3D LIVE CLIP】Tarian Harimau Penuh Semangat!', 'views' => '88K views', 'duration' => '3:20'],
                    ['title' => '【HORROR GAME】Jangan Takut, Harimau Ini yang Bakal Ngedrive!', 'views' => '74K views', 'duration' => '2:04:15'],
                ],
            ],
        ];
    }

    /**
     * Mock data repository for projects.
     *
     * @return array<int, array<string, mixed>>
     */
    private function getMockProjects(): array
    {
        return [
            [
                'id' => 1,
                'slug' => 'mimpi-maya-1st-anniversary-live',
                'title' => 'Mimpi Maya 1st Anniversary Special 3D Concert',
                'category' => 'Event',
                'date' => '15 Agustus 2026',
                'badge' => '3D Concert',
                'talents' => 'Kuroko Dille, Anne Droitte, Biyu Nara',
                'description' => 'Konser virtual 3D berskala penuh merayakan satu tahun perjalanan Mimpi Maya bersama para penggemar di seluruh dunia dengan panggung interaktif.',
                'url' => 'https://youtube.com',
                'highlight' => true,
            ],
            [
                'id' => 2,
                'slug' => 'resonance-original-single',
                'title' => 'Original Single: "Resonance Beyond Dreams"',
                'category' => 'Music',
                'date' => '20 Juni 2026',
                'badge' => 'Original MV',
                'talents' => 'Anne Droitte, Kuroko Dille, Biyu Nara',
                'description' => 'Lagu tema resmi Mimpi Maya yang dibawakan serentak oleh Chapter 01 dengan sentuhan aransemen synthwave dan orkestra futuristik.',
                'url' => 'https://youtube.com',
                'highlight' => true,
            ],
            [
                'id' => 3,
                'slug' => 'official-voice-pack-summer-2026',
                'title' => 'Mimpi Maya Summer Voice Pack & Goods 2026',
                'category' => 'Merchandise',
                'date' => '01 Juli 2026',
                'badge' => 'Voice & Goods',
                'talents' => 'Chapter 01 Talents',
                'description' => 'Paket rekaman suara bertema petualangan pantai musim panas eksklusif, dilengkapi merchandise akrilik dan gantungan kunci edisi terbatas.',
                'url' => 'https://trakteer.id',
                'highlight' => false,
            ],
            [
                'id' => 4,
                'slug' => 'vtuber-invitational-apex-tournament',
                'title' => 'VTuber Invitational Championship 2026',
                'category' => 'Collab',
                'date' => '10 Mei 2026',
                'badge' => 'Tournament',
                'talents' => 'Biyu Nara, Kuroko Dille',
                'description' => 'Turnamen persahabatan game kompetitif berskala nasional yang mempertemukan berbagai agensi dan kreator indie dalam turnamen epik.',
                'url' => 'https://youtube.com',
                'highlight' => false,
            ],
        ];
    }

    public function auditionIndex(): View|RedirectResponse
    {
        $active = AuditionSetting::where('is_active', true)->first();

        if ($active) {
            return redirect()->route('index.audition.show', $active->slug);
        }

        // No active audition → show archive list
        $chapters = AuditionSetting::orderByDesc('audition_end')->get();
        return view('audition.archive', compact('chapters'));
    }

    public function auditionShow(string $slug): View
    {
        $setting = AuditionSetting::where('slug', $slug)->firstOrFail();

        // For archived (hardcoded) chapters, use a dedicated view if it exists
        $archiveView = "audition.chapters.{$slug}";
        if (!$setting->is_active && view()->exists($archiveView)) {
            return view($archiveView, compact('setting'));
        }

        // Active chapter (or archived without dedicated view): use dynamic data
        $auditionStart = $setting->audition_start;
        $auditionEnd = $setting->audition_end;

        $timeline = AuditionContent::active()->byType('timeline')->orderBy('sort_order')->get();
        $requirements = AuditionContent::active()->byType('requirement')->orderBy('sort_order')->get();
        $benefits = AuditionContent::active()->byType('benefit')->orderBy('sort_order')->get();
        $contactLinks = AuditionContent::active()->byType('contact_link')->orderBy('sort_order')->get();
        $aboutCards = AuditionContent::active()->byType('about_card')->orderBy('sort_order')->get();

        $isRegistrationOpen = $auditionStart && $auditionEnd
            ? now() >= $auditionStart && now() <= $auditionEnd
            : false;

        return view('audition.index', compact(
            'setting', 'auditionStart', 'auditionEnd',
            'timeline', 'requirements', 'benefits', 'contactLinks', 'aboutCards',
            'isRegistrationOpen'
        ));
    }

    public function auditionForm(string $slug): View
    {
        $formUrl = AuditionSetting::where('slug', $slug)->firstOrFail()->form_url;
        return view('audition.form', compact('formUrl'));
    }
}
