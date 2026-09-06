<x-app-layout title="Proyek">
    <div class="relative bg-base-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8" x-data="{ selectedCategory: 'Semua' }">
        {{-- Ambient background glow --}}
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_50%_15%,_rgba(234,179,8,0.10),_transparent_55%)] pointer-events-none"></div>

        <div class="relative z-10 max-w-7xl mx-auto space-y-12">
            {{-- Header --}}
            <div class="text-center max-w-3xl mx-auto space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-primary/30 bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider">
                    <div class="w-3.5 h-3.5">
                        <x-icon name="sparkle" />
                    </div>
                    Aktivitas & Karya
                </div>

                <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight font-share-tech uppercase">
                    Proyek Resmi
                </h1>

                <p class="text-base text-base-content/70 leading-relaxed">
                    Eksplorasi ragam rilisan musik, konser virtual 3D, merchandise, dan kolaborasi dari seluruh talenta Mimpi Maya.
                </p>

                {{-- Category Filters --}}
                <div class="flex flex-wrap items-center justify-center gap-2 pt-4">
                    @foreach ($categories as $cat)
                        <button
                            type="button"
                            @click="selectedCategory = '{{ $cat }}'"
                            :class="selectedCategory === '{{ $cat }}' ? 'btn-primary shadow-md shadow-primary/20' : 'btn-ghost bg-base-200/60 hover:bg-base-200 text-base-content/80'"
                            class="btn btn-sm rounded-full transition-all duration-200"
                        >
                            {{ $cat }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Projects Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                @foreach ($projects as $project)
                    <div
                        x-show="selectedCategory === 'Semua' || selectedCategory === '{{ $project['category'] }}'"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        class="rounded-3xl bg-base-100 border border-base-300 overflow-hidden flex flex-col justify-between hover:border-primary/50 transition-all duration-300 hover:shadow-xl hover:shadow-primary/5 group"
                    >
                        {{-- Project Thumbnail Placeholder with Badge --}}
                        <div class="relative w-full aspect-[21/9] bg-gradient-to-br from-base-300 via-base-200 to-base-300 flex items-center justify-center overflow-hidden">
                            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_rgba(234,179,8,0.15),_transparent_70%)]"></div>

                            <div class="relative z-10 text-center space-y-1">
                                <span class="text-xs font-mono tracking-widest text-primary/80 uppercase">Mimpi Maya Official</span>
                                <p class="text-lg font-bold font-share-tech text-base-content/80">{{ $project['badge'] }}</p>
                            </div>

                            <span class="absolute top-4 left-4 badge badge-primary font-mono text-xs shadow-md">
                                {{ $project['category'] }}
                            </span>

                            <span class="absolute top-4 right-4 text-xs text-base-content/60 font-mono bg-base-100/80 px-2.5 py-1 rounded-full border border-base-300">
                                {{ $project['date'] }}
                            </span>
                        </div>

                        {{-- Body Content --}}
                        <div class="p-6 sm:p-8 space-y-4 flex-1 flex flex-col justify-between">
                            <div class="space-y-3">
                                <h2 class="text-2xl font-bold group-hover:text-primary transition-colors leading-snug">
                                    {{ $project['title'] }}
                                </h2>

                                <p class="text-sm text-base-content/70 leading-relaxed">
                                    {{ $project['description'] }}
                                </p>
                            </div>

                            <div class="pt-6 border-t border-base-300/80 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="text-xs text-base-content/60">
                                    <span class="font-semibold block sm:inline">Talenta Terlibat:</span>
                                    <span class="text-base-content/90 font-medium">{{ $project['talents'] }}</span>
                                </div>

                                <a
                                    href="{{ $project['url'] }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-sm btn-primary rounded-full gap-2 shadow-sm shrink-0 self-start sm:self-auto"
                                >
                                    <span>Buka Tautan</span>
                                    <div class="w-3.5 h-3.5">
                                        <x-icon name="arrow-up-right" />
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Collaboration Inquiry Banner --}}
            <div class="rounded-3xl border border-base-300 bg-base-200/50 p-8 sm:p-10 text-center space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary mx-auto flex items-center justify-center">
                    <div class="w-6 h-6">
                        <x-icon name="envelope" />
                    </div>
                </div>

                <h3 class="text-2xl font-bold font-share-tech">Tertarik Berkolaborasi Bersama Kami?</h3>
                <p class="text-sm text-base-content/70 max-w-xl mx-auto">
                    Mimpi Maya terbuka untuk kerja sama komersial, promosi merek, konser kolaboratif, lisensi musik, dan event gaming.
                </p>

                <div class="pt-2">
                    <a href="mailto:contact@mimpimaya.com" class="btn btn-outline border-base-300 hover:border-primary hover:bg-base-100 rounded-full btn-sm gap-2">
                        <span>Hubungi Tim Bisnis</span>
                        <div class="w-3.5 h-3.5">
                            <x-icon name="arrow-right" />
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
