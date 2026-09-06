<x-app-layout title="Tentang Kami">
    @push('head_meta')
        <meta property="og:title" content="Tentang Kami - Mimpi Maya Virtual Talent Agency" />
        <meta property="og:description" content="Mengenal lebih dekat visi, misi, dan pilar kreativitas di balik panggung virtual Mimpi Maya." />
    @endpush

    <div class="relative bg-base-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        {{-- Background Ambient Glow --}}
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_50%_10%,_rgba(234,179,8,0.12),_transparent_60%)] pointer-events-none"></div>

        <div class="relative z-10 max-w-7xl mx-auto space-y-20">
            {{-- ===== HERO SECTION ===== --}}
            <div class="text-center max-w-3xl mx-auto space-y-6 pt-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-primary/30 bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider">
                    <div class="w-3.5 h-3.5">
                        <x-icon name="info" />
                    </div>
                    Profil Agensi
                </div>

                <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight font-share-tech uppercase">
                    Tentang <span class="bg-gradient-to-r from-primary via-amber-200 to-primary bg-clip-text text-transparent">Mimpi Maya</span>
                </h1>

                <p class="text-base sm:text-lg text-base-content/75 leading-relaxed">
                    Mimpi Maya adalah agensi manajemen talenta virtual (VTuber) yang berdedikasi membangun wadah ekspresi bagi para kreator berbakat untuk menginspirasi, menghibur, dan berkarya tanpa batas.
                </p>
            </div>

            {{-- ===== VISION & MISSION CARDS ===== --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Visi --}}
                <div class="rounded-3xl bg-base-200/50 border border-base-300 p-8 sm:p-10 space-y-4 hover:border-primary/40 transition-colors">
                    <div class="w-12 h-12 rounded-2xl bg-primary/15 text-primary flex items-center justify-center">
                        <div class="w-6 h-6">
                            <x-icon name="eye" />
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold font-share-tech uppercase">Visi Kami</h2>

                    <p class="text-base text-base-content/75 leading-relaxed">
                        Menjadi ekosistem hiburan virtual terkemuka di Asia Tenggara yang menjembatani inovasi teknologi, keindahan seni musik, dan ikatan hangat komunitas dalam setiap detik pertunjukan.
                    </p>
                </div>

                {{-- Misi --}}
                <div class="rounded-3xl bg-base-200/50 border border-base-300 p-8 sm:p-10 space-y-4 hover:border-primary/40 transition-colors">
                    <div class="w-12 h-12 rounded-2xl bg-primary/15 text-primary flex items-center justify-center">
                        <div class="w-6 h-6">
                            <x-icon name="target" />
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold font-share-tech uppercase">Misi Kami</h2>

                    <ul class="space-y-2.5 text-sm text-base-content/75">
                        <li class="flex items-start gap-2">
                            <span class="text-primary font-bold">✓</span>
                            <span>Membina dan memfasilitasi talenta virtual dengan teknologi model 2D/3D mutakhir dan pelatihan komprehensif.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary font-bold">✓</span>
                            <span>Memproduksi karya musik dan konten orisinal yang memiliki daya saing serta resonansi emosional tinggi.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary font-bold">✓</span>
                            <span>Menciptakan ekosistem komunitas yang sehat, suportif, dan ramah bagi para kreator maupun penggemar.</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- ===== STATS OVERVIEW ===== --}}
            <div class="rounded-3xl bg-base-200/80 border border-base-300 p-8 sm:p-10">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div class="space-y-1">
                        <div class="text-3xl sm:text-5xl font-extrabold text-primary font-share-tech">3</div>
                        <p class="text-xs sm:text-sm text-base-content/60 uppercase font-semibold tracking-wider">Talenta Aktif</p>
                    </div>

                    <div class="space-y-1">
                        <div class="text-3xl sm:text-5xl font-extrabold text-primary font-share-tech">10+</div>
                        <p class="text-xs sm:text-sm text-base-content/60 uppercase font-semibold tracking-wider">Lagu & Proyek</p>
                    </div>

                    <div class="space-y-1">
                        <div class="text-3xl sm:text-5xl font-extrabold text-primary font-share-tech">500K+</div>
                        <p class="text-xs sm:text-sm text-base-content/60 uppercase font-semibold tracking-wider">Jangkauan Komunitas</p>
                    </div>

                    <div class="space-y-1">
                        <div class="text-3xl sm:text-5xl font-extrabold text-primary font-share-tech">Chapter 02</div>
                        <p class="text-xs sm:text-sm text-base-content/60 uppercase font-semibold tracking-wider">Generasi Berikutnya</p>
                    </div>
                </div>
            </div>

            {{-- ===== PILLARS / VALUES SECTION ===== --}}
            <div class="space-y-10">
                <div class="text-center max-w-2xl mx-auto space-y-3">
                    <div class="text-xs font-bold text-primary tracking-wider uppercase">Nilai & Komitmen</div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-share-tech uppercase">
                        Pilar Utama Mimpi Maya
                    </h2>
                    <p class="text-sm text-base-content/70">
                        Prinsip yang membimbing kami dalam mendampingi perjalanan karier setiap talenta.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($pillars as $pillar)
                        <div class="rounded-3xl bg-base-100 border border-base-300 p-6 space-y-4 hover:border-primary/50 transition-all hover:shadow-lg">
                            <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center">
                                <div class="w-6 h-6">
                                    <x-icon name="{{ $pillar['icon'] }}" />
                                </div>
                            </div>

                            <h3 class="text-lg font-bold">
                                {{ $pillar['title'] }}
                            </h3>

                            <p class="text-sm text-base-content/70 leading-relaxed">
                                {{ $pillar['description'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ===== DYNAMIC ABOUT CARDS (IF REGISTERED IN DB) ===== --}}
            @if ($aboutCards->isNotEmpty())
                <div class="space-y-8 pt-4">
                    <div class="text-center max-w-2xl mx-auto space-y-2">
                        <h2 class="text-2xl sm:text-3xl font-bold font-share-tech uppercase">Informasi Tambahan</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($aboutCards as $card)
                            <div class="rounded-2xl bg-base-200/40 border border-base-300 p-6 space-y-3">
                                @if ($card->icon)
                                    <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                                        <div class="w-5 h-5">
                                            <x-icon name="{{ $card->icon }}" />
                                        </div>
                                    </div>
                                @endif
                                <h3 class="font-bold text-base">{{ $card->title }}</h3>
                                <p class="text-xs text-base-content/70 leading-relaxed">{{ $card->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- ===== TIMELINE / MILESTONES ===== --}}
            <div class="space-y-10 pt-8 border-t border-base-300/80">
                <div class="text-center max-w-2xl mx-auto space-y-3">
                    <div class="text-xs font-bold text-primary tracking-wider uppercase">Jejak Langkah</div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-share-tech uppercase">
                        Perjalanan Kami
                    </h2>
                </div>

                <div class="max-w-3xl mx-auto space-y-8">
                    @foreach ($milestones as $m)
                        <div class="flex items-start gap-6 group">
                            <div class="font-share-tech text-2xl font-bold text-primary shrink-0 w-20 text-right pt-0.5">
                                {{ $m['year'] }}
                            </div>

                            <div class="relative flex flex-col items-center">
                                <div class="w-4 h-4 rounded-full bg-primary border-4 border-base-100 ring-2 ring-primary/40 group-hover:scale-125 transition-transform"></div>
                                @if (!$loop->last)
                                    <div class="w-0.5 h-full min-h-[4rem] bg-base-300 my-1"></div>
                                @endif
                            </div>

                            <div class="pb-6 space-y-1">
                                <h3 class="text-lg font-bold text-base-content group-hover:text-primary transition-colors">
                                    {{ $m['title'] }}
                                </h3>
                                <p class="text-sm text-base-content/70 leading-relaxed">
                                    {{ $m['description'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ===== PARTNERSHIP & CONTACT BANNER ===== --}}
            <div class="rounded-3xl border border-primary/30 bg-gradient-to-br from-primary/10 via-base-200 to-base-100 p-8 sm:p-12 flex flex-col md:flex-row items-center justify-between gap-8 shadow-xl">
                <div class="space-y-3 text-center md:text-left">
                    <div class="inline-flex items-center gap-1.5 badge badge-primary text-xs font-bold uppercase tracking-wider">
                        Kemitraan & Bisnis
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold font-share-tech">
                        Mari Berkolaborasi Bersama Mimpi Maya
                    </h2>
                    <p class="text-sm text-base-content/75 max-w-xl">
                        Kami menyambut berbagai kerja sama endorsement, penampilan event langsung, perizinan lagu, dan proyek komersial lainnya.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <a
                        href="mailto:contact@mimpimaya.com"
                        class="btn btn-primary rounded-full px-6 gap-2 shadow-lg shadow-primary/20 hover:scale-105 transition-transform"
                    >
                        <div class="w-4 h-4">
                            <x-icon name="envelope" />
                        </div>
                        <span>Hubungi Bisnis</span>
                    </a>

                    <a
                        href="{{ url('/talent') }}"
                        class="btn btn-outline border-base-300 hover:border-primary hover:bg-base-200 rounded-full px-5"
                    >
                        <span>Jelajahi Talenta</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
