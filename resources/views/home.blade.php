<x-app-layout title="Beranda">
    <div class="relative bg-base-100 overflow-hidden">
        {{-- ===== HERO SECTION ===== --}}
        <section class="relative min-h-[calc(100dvh-4rem)] flex items-center justify-center px-4 py-16 sm:px-6 lg:px-8">
            {{-- Background ambient glow --}}
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_50%_20%,_rgba(234,179,8,0.15),_transparent_60%)] pointer-events-none"></div>
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[32rem] h-[32rem] bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-5xl mx-auto text-center space-y-8">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-primary/30 bg-primary/10 text-primary text-xs font-semibold tracking-wider uppercase">
                    <div class="w-2 h-2 rounded-full bg-primary animate-pulse"></div>
                    Mimpi Maya • Indonesian Virtual Talent Agency
                </div>

                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-base-content font-share-tech uppercase">
                    Wujudkan Impian <br class="hidden sm:inline" />
                    <span class="bg-gradient-to-r from-primary via-amber-200 to-primary bg-clip-text text-transparent">
                        Tanpa Batas
                    </span>
                </h1>

                <p class="max-w-2xl mx-auto text-base sm:text-lg text-base-content/70 leading-relaxed">
                    Mimpi Maya adalah agensi talenta virtual yang memadukan keajaiban musik, karakter unik, dan teknologi interaktif untuk menghadirkan pengalaman hiburan masa depan.
                </p>

                <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
                    <a href="{{ url('/talent') }}" class="btn btn-primary px-8 rounded-full shadow-lg shadow-primary/20 hover:scale-105 transition-transform duration-200">
                        <span>Lihat Semua Talenta</span>
                        <div class="w-4 h-4">
                            <x-icon name="arrow-right" />
                        </div>
                    </a>

                    <a href="{{ url('/audition') }}" class="btn btn-outline border-base-300 hover:border-primary hover:bg-base-200 px-6 rounded-full">
                        <div class="w-4 h-4 text-error">
                            <x-icon name="fire" />
                        </div>
                        <span>Audisi Chapter 02</span>
                    </a>
                </div>

                {{-- Quick Talents Preview Silhouette Avatars --}}
                <div class="pt-8 flex flex-col items-center justify-center gap-3">
                    <p class="text-xs tracking-widest text-base-content/50 uppercase font-semibold">Generasi 01 Talents</p>
                    <div class="flex items-center -space-x-3">
                        @foreach ($talents as $t)
                            <a href="{{ url('/talent/' . $t['slug']) }}" class="relative group" title="{{ $t['name'] }}">
                                <div class="w-12 h-12 rounded-full border-2 border-base-100 overflow-hidden bg-base-300 transition-transform duration-200 group-hover:scale-110 group-hover:z-10 shadow-md">
                                    <img src="{{ asset($t['image']) }}" alt="{{ $t['name'] }}" class="w-full h-full object-cover object-top" />
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== FEATURED TALENTS SECTION ===== --}}
        <section class="relative py-20 px-4 sm:px-6 lg:px-8 border-t border-base-300/60 bg-base-200/40">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                    <div>
                        <div class="text-xs font-bold text-primary tracking-wider uppercase mb-2">Panggung Utama</div>
                        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-share-tech">Talenta Kami</h2>
                        <p class="text-base-content/70 mt-1">Kenali para kreator di balik panggung virtual Mimpi Maya.</p>
                    </div>

                    <a href="{{ url('/talent') }}" class="inline-flex items-center gap-2 text-primary hover:underline text-sm font-semibold">
                        <span>Lihat Profil Lengkap</span>
                        <div class="w-4 h-4">
                            <x-icon name="arrow-right" />
                        </div>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($talents as $talent)
                        <div class="group relative rounded-3xl bg-base-100 border border-base-300 p-6 flex flex-col justify-between hover:border-primary/50 transition-all duration-300 hover:shadow-xl hover:shadow-primary/5">
                            <div>
                                <div class="relative w-full aspect-[4/5] rounded-2xl overflow-hidden bg-base-200/80 mb-6 flex items-center justify-center">
                                    <div
                                        class="absolute inset-0 opacity-20 pointer-events-none"
                                        style="background: radial-gradient(circle, {{ $talent['theme_color'] }} 0%, transparent 70%);"
                                    ></div>
                                    <img
                                        src="{{ asset($talent['image']) }}"
                                        alt="{{ $talent['name'] }}"
                                        class="w-full h-full object-contain object-bottom group-hover:scale-105 transition-transform duration-300 drop-shadow-md"
                                        loading="lazy"
                                    />
                                    <span class="absolute top-3 left-3 badge badge-sm bg-base-100/90 backdrop-blur border border-base-300 font-mono">
                                        {{ $talent['gen'] }}
                                    </span>
                                </div>

                                <div class="space-y-1">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-xl font-bold group-hover:text-primary transition-colors">
                                            {{ $talent['name'] }}
                                        </h3>
                                        <span class="text-xs text-base-content/50 font-medium">
                                            {{ $talent['japanese_name'] }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-primary font-medium tracking-wide uppercase">
                                        {{ $talent['tag'] }}
                                    </p>
                                    <p class="text-sm text-base-content/70 line-clamp-2 pt-2">
                                        {{ $talent['bio'] }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6 pt-4 border-t border-base-300/80 flex items-center justify-between">
                                <span class="text-xs text-base-content/50">
                                    Fan: <strong class="text-base-content/80">{{ $talent['stats']['fan_name'] }}</strong>
                                </span>

                                <a href="{{ url('/talent/' . $talent['slug']) }}" class="btn btn-sm btn-ghost gap-1.5 text-primary hover:bg-primary/10">
                                    <span>Detail</span>
                                    <div class="w-3.5 h-3.5">
                                        <x-icon name="arrow-up-right" />
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ===== AGENCY STORY / PILLARS SECTION ===== --}}
        <section class="relative py-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto space-y-16">
                <div class="text-center max-w-2xl mx-auto space-y-3">
                    <div class="text-xs font-bold text-primary tracking-wider uppercase">Dunia Mimpi Maya</div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-share-tech">Membawa Imajinasi Menjadi Nyata</h2>
                    <p class="text-base-content/70">Tiga pilar utama yang menjadi pondasi ekosistem kreasi kami.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-6 rounded-3xl bg-base-200/50 border border-base-300 space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center">
                            <div class="w-6 h-6">
                                <x-icon name="music-notes" />
                            </div>
                        </div>
                        <h3 class="text-lg font-bold">Produksi Musik Orisinal</h3>
                        <p class="text-sm text-base-content/70 leading-relaxed">
                            Kolaborasi bersama komposer dan produser terkemuka untuk melahirkan diskografi orisinal berkualitas tinggi.
                        </p>
                    </div>

                    <div class="p-6 rounded-3xl bg-base-200/50 border border-base-300 space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center">
                            <div class="w-6 h-6">
                                <x-icon name="sparkle" />
                            </div>
                        </div>
                        <h3 class="text-lg font-bold">Teknologi & Konser 3D</h3>
                        <p class="text-sm text-base-content/70 leading-relaxed">
                            Integrasi model 3D interaktif dan panggung virtual dinamis untuk pengalaman live show yang imersif.
                        </p>
                    </div>

                    <div class="p-6 rounded-3xl bg-base-200/50 border border-base-300 space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center">
                            <div class="w-6 h-6">
                                <x-icon name="users" />
                            </div>
                        </div>
                        <h3 class="text-lg font-bold">Komunitas Global</h3>
                        <p class="text-sm text-base-content/70 leading-relaxed">
                            Ruang komunitas yang inklusif dan suportif menghubungkan penggemar dengan talenta kesayangan mereka.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== RECENT PROJECTS SECTION ===== --}}
        <section class="relative py-20 px-4 sm:px-6 lg:px-8 bg-base-200/40 border-t border-base-300/60">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                    <div>
                        <div class="text-xs font-bold text-primary tracking-wider uppercase mb-2">Sorotan Karya</div>
                        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-share-tech">Proyek Terbaru</h2>
                        <p class="text-base-content/70 mt-1">Aktivitas resmi, rilisan musik, dan konser terbaru.</p>
                    </div>

                    <a href="{{ url('/project') }}" class="inline-flex items-center gap-2 text-primary hover:underline text-sm font-semibold">
                        <span>Semua Proyek</span>
                        <div class="w-4 h-4">
                            <x-icon name="arrow-right" />
                        </div>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($projects as $project)
                        <div class="rounded-3xl bg-base-100 border border-base-300 overflow-hidden flex flex-col justify-between hover:border-primary/40 transition-colors">
                            <div class="p-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="badge badge-primary badge-outline text-xs font-semibold">
                                        {{ $project['badge'] }}
                                    </span>
                                    <span class="text-xs text-base-content/50 font-mono">
                                        {{ $project['date'] }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-bold hover:text-primary transition-colors">
                                    {{ $project['title'] }}
                                </h3>

                                <p class="text-sm text-base-content/70 line-clamp-3">
                                    {{ $project['description'] }}
                                </p>
                            </div>

                            <div class="px-6 py-4 bg-base-200/50 border-t border-base-300 flex items-center justify-between">
                                <div class="text-xs text-base-content/60">
                                    Talenta: <span class="font-medium text-base-content/80">{{ $project['talents'] }}</span>
                                </div>

                                <a href="{{ $project['url'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-circle btn-ghost btn-sm text-primary hover:bg-primary/20">
                                    <div class="w-4 h-4">
                                        <x-icon name="arrow-up-right" />
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ===== AUDITION CTA SECTION ===== --}}
        <section class="relative py-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto rounded-3xl border border-primary/40 bg-gradient-to-br from-primary/15 via-base-200 to-base-100 p-8 sm:p-12 text-center relative overflow-hidden shadow-2xl">
                <div class="relative z-10 space-y-6">
                    <div class="inline-flex items-center gap-1.5 badge badge-error text-xs font-bold uppercase tracking-wider">
                        <div class="w-3.5 h-3.5">
                            <x-icon name="fire" />
                        </div>
                        Pendaftaran Dibuka
                    </div>

                    <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight font-share-tech">
                        Siap Menjadi Bintang Berikutnya?
                    </h2>

                    <p class="max-w-xl mx-auto text-base sm:text-lg text-base-content/80">
                        Audisi Mimpi Maya Chapter 02 sedang berlangsung. Daftarkan dirimu dan mulai kisah petualangan virtualmu hari ini!
                    </p>

                    <div class="pt-2">
                        <a href="{{ url('/audition') }}" class="btn btn-primary px-8 rounded-full shadow-lg shadow-primary/20 hover:scale-105 transition-transform">
                            <span>Informasi & Pendaftaran Audisi</span>
                            <div class="w-4 h-4">
                                <x-icon name="arrow-right" />
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== FOOTER ===== --}}
        <footer class="border-t border-base-300 py-10 px-4 sm:px-6 lg:px-8 text-center text-xs text-base-content/50 space-y-4">
            <div class="flex items-center justify-center gap-3">
                <img src="{{ asset('images/logo.webp') }}" alt="Mimpi Maya" class="h-6 w-auto opacity-70" />
                <span class="font-bold tracking-wider uppercase text-base-content/80">Mimpi Maya Entertainment</span>
            </div>
            <p>&copy; {{ date('Y') }} Mimpi Maya. Seluruh hak cipta dilindungi.</p>
        </footer>
    </div>
</x-app-layout>
