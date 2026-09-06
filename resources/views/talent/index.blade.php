<x-app-layout title="Talenta">
    <div class="relative bg-base-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8" x-data="{ selectedGen: 'Semua' }">
        {{-- Background glow --}}
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_50%_10%,_rgba(234,179,8,0.10),_transparent_50%)] pointer-events-none"></div>

        <div class="relative z-10 max-w-7xl mx-auto space-y-12">
            {{-- Header --}}
            <div class="text-center max-w-3xl mx-auto space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-primary/30 bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider">
                    <x-icon name="users" class="w-3.5 h-3.5" />
                    Roster Talenta
                </div>
                <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight font-share-tech uppercase">
                    Talenta Kami
                </h1>
                <p class="text-base text-base-content/70 leading-relaxed">
                    Kreator virtual berbakat yang membawa keceriaan, musik, dan petualangan tanpa batas ke layar Anda.
                </p>

                {{-- Filter Buttons --}}
                <div class="flex flex-wrap items-center justify-center gap-2 pt-4">
                    @foreach ($generations as $gen)
                        <button
                            type="button"
                            @click="selectedGen = '{{ $gen }}'"
                            :class="selectedGen === '{{ $gen }}' ? 'btn-primary shadow-md shadow-primary/20' : 'btn-ghost bg-base-200/60 hover:bg-base-200 text-base-content/80'"
                            class="btn btn-sm rounded-full transition-all duration-200"
                        >
                            {{ $gen }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Talents Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($talents as $talent)
                    <div
                        x-show="selectedGen === 'Semua' || selectedGen === '{{ $talent['gen'] }}'"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        class="group relative rounded-3xl bg-base-100 border border-base-300 p-6 flex flex-col justify-between hover:border-primary/50 transition-all duration-300 hover:shadow-xl hover:shadow-primary/5"
                    >
                        <div>
                            {{-- Card Image Container --}}
                            <div class="relative w-full aspect-[4/5] rounded-2xl overflow-hidden bg-base-200/70 mb-6 flex items-center justify-center">
                                <div
                                    class="absolute inset-0 opacity-25 pointer-events-none"
                                    style="background: radial-gradient(circle, {{ $talent['theme_color'] }} 0%, transparent 70%);"
                                ></div>

                                <img
                                    src="{{ asset($talent['image']) }}"
                                    alt="{{ $talent['name'] }}"
                                    class="w-full h-full object-contain object-bottom group-hover:scale-105 transition-transform duration-300 drop-shadow-md"
                                    loading="lazy"
                                />

                                <div class="absolute top-3 left-3 flex gap-2">
                                    <span class="badge badge-sm bg-base-100/90 backdrop-blur border border-base-300 font-mono">
                                        {{ $talent['gen'] }}
                                    </span>
                                    <span class="badge badge-sm badge-success gap-1 text-xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-success-content animate-pulse"></span>
                                        {{ $talent['status'] }}
                                    </span>
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="space-y-1.5">
                                <div class="flex items-baseline justify-between">
                                    <h2 class="text-2xl font-bold group-hover:text-primary transition-colors">
                                        {{ $talent['name'] }}
                                    </h2>
                                    <span class="text-xs text-base-content/50 font-medium font-share-tech">
                                        {{ $talent['japanese_name'] }}
                                    </span>
                                </div>

                                <p class="text-xs text-primary font-semibold tracking-wide uppercase">
                                    {{ $talent['tag'] }}
                                </p>

                                <blockquote class="text-xs italic text-base-content/60 border-l-2 border-primary/40 pl-2.5 py-0.5 mt-2">
                                    "{{ $talent['catchphrase'] }}"
                                </blockquote>

                                <p class="text-sm text-base-content/70 line-clamp-3 pt-2">
                                    {{ $talent['bio'] }}
                                </p>
                            </div>
                        </div>

                        {{-- Footer & Action --}}
                        <div class="mt-8 pt-4 border-t border-base-300/80 flex items-center justify-between">
                            {{-- Social icons --}}
                            <div class="flex items-center gap-1">
                                @foreach ($talent['socials'] as $soc)
                                    <a
                                        href="{{ $soc['url'] }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="btn btn-circle btn-ghost btn-xs text-base-content/60 hover:text-primary hover:bg-base-200"
                                        title="{{ $soc['platform'] }}"
                                    >
                                        <div class="w-3.5 h-3.5">
                                            <x-icon name="{{ $soc['icon'] }}" />
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            <a
                                href="{{ url('/talent/' . $talent['slug']) }}"
                                class="btn btn-sm btn-primary rounded-full gap-1.5 shadow-sm hover:scale-105 transition-transform"
                            >
                                <span>Profil Lengkap</span>
                                <div class="w-3.5 h-3.5">
                                    <x-icon name="arrow-right" />
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Chapter 02 Audition Teaser Card --}}
            <div class="rounded-3xl border border-dashed border-primary/40 bg-base-200/30 p-8 text-center space-y-4">
                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary mx-auto flex items-center justify-center">
                    <div class="w-6 h-6">
                        <x-icon name="plus" />
                    </div>
                </div>
                <h3 class="text-xl font-bold font-share-tech">Ingin Berada di Panggung Ini?</h3>
                <p class="text-sm text-base-content/70 max-w-md mx-auto">
                    Mimpi Maya Chapter 02 sedang membuka pendaftaran untuk talenta baru. Mari ciptakan sejarah bersama!
                </p>
                <div>
                    <a href="{{ url('/audition') }}" class="btn btn-outline btn-primary btn-sm rounded-full gap-2">
                        <span>Lihat Persyaratan Audisi</span>
                        <div class="w-3.5 h-3.5">
                            <x-icon name="arrow-right" />
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
