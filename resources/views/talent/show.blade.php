<x-app-layout title="{{ $talent['name'] }}">
    @push('head_meta')
        <meta property="og:title" content="{{ $talent['name'] }} - Mimpi Maya Virtual Talent" />
        <meta property="og:description" content="{{ $talent['catchphrase'] }}" />
        <meta property="og:image" content="{{ asset($talent['image']) }}" />
    @endpush

    <div class="relative bg-base-100 min-h-screen py-10 px-4 sm:px-6 lg:px-8">
        {{-- Background Character Glow --}}
        <div
            class="absolute top-10 left-1/2 -translate-x-1/2 w-full max-w-4xl h-[600px] pointer-events-none blur-3xl opacity-20"
            style="background: radial-gradient(circle, {{ $talent['theme_color'] }} 0%, transparent 70%);"
        ></div>

        <div class="relative z-10 max-w-7xl mx-auto space-y-12">
            {{-- Navigation Back --}}
            <div>
                <a
                    href="{{ url('/talent') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-base-content/70 hover:text-primary transition-colors"
                >
                    <div class="w-4 h-4">
                        <x-icon name="arrow-left" />
                    </div>
                    <span>Kembali ke Daftar Talenta</span>
                </a>
            </div>

            {{-- Main Character Profile Showcase --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                {{-- Left: Character Portrait Stage --}}
                <div class="lg:col-span-5 flex flex-col items-center">
                    <div class="relative w-full max-w-md aspect-[3/4] rounded-3xl overflow-hidden bg-base-200/60 border border-base-300 shadow-2xl flex items-center justify-center p-4">
                        <div
                            class="absolute inset-0 opacity-25 pointer-events-none"
                            style="background: radial-gradient(circle at center, {{ $talent['theme_color'] }} 0%, transparent 80%);"
                        ></div>

                        <img
                            src="{{ asset($talent['image']) }}"
                            alt="{{ $talent['name'] }}"
                            class="w-full h-full object-contain object-bottom drop-shadow-2xl hover:scale-105 transition-transform duration-500"
                        />

                        {{-- Badges --}}
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="badge badge-neutral border border-base-300 font-mono">
                                {{ $talent['gen'] }}
                            </span>
                            <span class="badge badge-success gap-1 text-xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-success-content animate-pulse"></span>
                                {{ $talent['status'] }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Right: Details, Bio & Quick Stats --}}
                <div class="lg:col-span-7 space-y-6">
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold text-primary tracking-widest uppercase">
                                {{ $talent['tag'] }}
                            </span>
                            <span class="text-xs text-base-content/50 font-mono font-medium">
                                {{ $talent['japanese_name'] }}
                            </span>
                        </div>

                        <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight font-share-tech uppercase">
                            {{ $talent['name'] }}
                        </h1>

                        <blockquote
                            class="text-base sm:text-lg italic font-medium text-base-content/90 border-l-4 pl-4 py-1 my-3"
                            style="border-color: {{ $talent['theme_color'] }};"
                        >
                            "{{ $talent['catchphrase'] }}"
                        </blockquote>
                    </div>

                    <p class="text-base text-base-content/80 leading-relaxed">
                        {{ $talent['bio'] }}
                    </p>

                    {{-- Channel & Social Action Buttons --}}
                    <div class="flex flex-wrap items-center gap-3 pt-2">
                        @foreach ($talent['socials'] as $soc)
                            <a
                                href="{{ $soc['url'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="btn btn-sm rounded-full gap-2 {{ $soc['platform'] === 'YouTube' ? 'btn-error' : 'btn-outline border-base-300 hover:border-primary hover:bg-base-200' }}"
                            >
                                <div class="w-4 h-4">
                                    <x-icon name="{{ $soc['icon'] }}" />
                                </div>
                                <span>{{ $soc['platform'] }}</span>
                            </a>
                        @endforeach
                    </div>

                    {{-- Stats Profile Card --}}
                    <div class="rounded-2xl bg-base-200/60 border border-base-300 p-6 space-y-4">
                        <h2 class="text-xs font-bold uppercase tracking-wider text-base-content/60 font-mono">
                            Informasi Profil
                        </h2>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-sm">
                            <div class="space-y-1">
                                <span class="text-xs text-base-content/50">Ulang Tahun</span>
                                <p class="font-bold font-mono">{{ $talent['stats']['birthday'] }}</p>
                            </div>

                            <div class="space-y-1">
                                <span class="text-xs text-base-content/50">Tinggi Badan</span>
                                <p class="font-bold font-mono">{{ $talent['stats']['height'] }}</p>
                            </div>

                            <div class="space-y-1">
                                <span class="text-xs text-base-content/50">Zodiak</span>
                                <p class="font-bold">{{ $talent['stats']['zodiac'] }}</p>
                            </div>

                            <div class="space-y-1">
                                <span class="text-xs text-base-content/50">Nama Fan</span>
                                <p class="font-bold text-primary">{{ $talent['stats']['fan_name'] }}</p>
                            </div>

                            <div class="space-y-1">
                                <span class="text-xs text-base-content/50">Tagar Siaran</span>
                                <p class="font-mono text-xs font-semibold text-secondary">{{ $talent['stats']['hashtag_stream'] }}</p>
                            </div>

                            <div class="space-y-1">
                                <span class="text-xs text-base-content/50">Tagar Karya Fan</span>
                                <p class="font-mono text-xs font-semibold text-accent">{{ $talent['stats']['hashtag_art'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabs Section: Highlights & Related Works --}}
            <div class="pt-8 space-y-8" x-data="{ activeTab: 'videos' }">
                <div class="flex items-center gap-4 border-b border-base-300">
                    <button
                        type="button"
                        @click="activeTab = 'videos'"
                        :class="activeTab === 'videos' ? 'border-b-2 border-primary text-primary font-bold' : 'text-base-content/60 hover:text-base-content'"
                        class="pb-3 text-base font-share-tech uppercase tracking-wider transition-colors"
                    >
                        Sorotan Video & Siaran
                    </button>
                    <button
                        type="button"
                        @click="activeTab = 'projects'"
                        :class="activeTab === 'projects' ? 'border-b-2 border-primary text-primary font-bold' : 'text-base-content/60 hover:text-base-content'"
                        class="pb-3 text-base font-share-tech uppercase tracking-wider transition-colors"
                    >
                        Proyek & Rilisan Terkait ({{ count($relatedProjects) }})
                    </button>
                </div>

                {{-- Tab 1: Video Showcase --}}
                <div x-show="activeTab === 'videos'" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($talent['featured_videos'] as $video)
                        <div class="group rounded-2xl bg-base-100 border border-base-300 overflow-hidden hover:border-primary/40 transition-all hover:shadow-lg">
                            <div class="relative w-full aspect-video bg-base-300 flex items-center justify-center">
                                <div class="w-12 h-12 rounded-full bg-primary/20 text-primary flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <div class="w-6 h-6">
                                        <x-icon name="play" />
                                    </div>
                                </div>
                                <span class="absolute bottom-2 right-2 badge badge-xs bg-black/80 text-white font-mono">
                                    {{ $video['duration'] }}
                                </span>
                            </div>

                            <div class="p-4 space-y-2">
                                <h3 class="font-bold text-sm line-clamp-2 group-hover:text-primary transition-colors">
                                    {{ $video['title'] }}
                                </h3>
                                <p class="text-xs text-base-content/50 font-mono">
                                    {{ $video['views'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Tab 2: Related Projects --}}
                <div x-show="activeTab === 'projects'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($relatedProjects as $project)
                        <div class="rounded-2xl bg-base-100 border border-base-300 p-6 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="badge badge-primary badge-outline text-xs">
                                        {{ $project['badge'] }}
                                    </span>
                                    <span class="text-xs text-base-content/50 font-mono">
                                        {{ $project['date'] }}
                                    </span>
                                </div>
                                <h3 class="font-bold text-base hover:text-primary transition-colors">
                                    {{ $project['title'] }}
                                </h3>
                                <p class="text-xs text-base-content/70 line-clamp-2">
                                    {{ $project['description'] }}
                                </p>
                            </div>

                            <div class="mt-4 pt-3 border-t border-base-300 flex items-center justify-between">
                                <a href="{{ url('/project') }}" class="text-xs font-semibold text-primary hover:underline">
                                    Lihat Proyek &rarr;
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12 text-base-content/50">
                            Belum ada proyek resmi yang terdaftar untuk talenta ini.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Other Talents Section --}}
            <div class="pt-16 border-t border-base-300/80 space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold font-share-tech uppercase">Talenta Lainnya</h2>
                        <p class="text-xs text-base-content/60">Jelajahi profil kreator Mimpi Maya lainnya</p>
                    </div>

                    <a href="{{ url('/talent') }}" class="btn btn-ghost btn-sm text-primary text-xs">
                        Semua Talenta &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($otherTalents as $other)
                        <a
                            href="{{ url('/talent/' . $other['slug']) }}"
                            class="group p-4 rounded-2xl bg-base-200/40 border border-base-300 hover:border-primary/50 transition-all flex items-center gap-4"
                        >
                            <div class="w-16 h-16 rounded-xl bg-base-300 overflow-hidden shrink-0 border border-base-300">
                                <img src="{{ asset($other['image']) }}" alt="{{ $other['name'] }}" class="w-full h-full object-cover object-top group-hover:scale-110 transition-transform" />
                            </div>

                            <div class="overflow-hidden">
                                <h3 class="font-bold text-sm truncate group-hover:text-primary transition-colors">
                                    {{ $other['name'] }}
                                </h3>
                                <p class="text-xs text-primary font-medium truncate">
                                    {{ $other['tag'] }}
                                </p>
                                <span class="text-xs text-base-content/50 font-mono">
                                    {{ $other['gen'] }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
