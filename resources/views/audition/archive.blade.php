<x-app-layout title="Audition">
    <section class="flex flex-1 flex-col items-center max-md:min-h-[75vh] px-4 py-24 lg:py-16 overflow-hidden">

        {{-- Background ambient glow --}}
        <div class="absolute inset-x-0 top-0 h-[75vh] bg-[radial-gradient(ellipse_at_50%_20%,_rgba(234,179,8,0.15),_transparent_60%)] pointer-events-none"></div>
        <div class="absolute h-[25vh] left-1/2 -translate-x-1/2 -translate-y-1/2 w-[32rem] h-[32rem] bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex-1 flex flex-col lg:max-w-3xl xl:max-w-5xl px-4 gap-8 lg:gap-16 w-full text-center">
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-base-content font-share-tech uppercase">
                <span>Arsip</span> <span class="bg-gradient-to-r from-primary via-amber-200 to-primary bg-clip-text text-transparent">Audisi</span>
            </h1>

            @if($chapters->isEmpty())
                <p class="py-8 text-base-content/40">Belum ada data audisi.</p>
            @else
                <div class="flex flex-col gap-5 w-full">
                    @foreach($chapters as $chapter)
                    <a
                        href="{{ str_starts_with($chapter->slug, 'http') ? $chapter->slug : route('index.audition.show', $chapter->slug) }}"
                        class="group flex items-center justify-between gap-4 overflow-hidden rounded-xl border border-base-content/10 bg-base-200/50 text-left transition-all duration-300 hover:border-primary/40 hover:bg-primary/5 hover:scale-[1.01] max-h-[92px]"
                    >
                        <div class="flex p-2.5 pl-4 items-center gap-3 sm:gap-5 min-w-0 flex-1">
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <h2 class="text-base sm:text-lg font-semibold text-base-content group-hover:text-primary transition truncate">
                                        {{ $chapter->name }}
                                    </h2>
                                </div>

                                @if($chapter->description)
                                    <p class="text-xs sm:text-sm text-base-content/60 truncate mb-1">{{ $chapter->description }}</p>
                                @endif

                                <div class="flex gap-3 items-center text-[11px] sm:text-xs text-base-content/40">
                                    <span class="mt-[2.8px]">
                                        {{ $chapter->audition_start?->format('d M Y') }}
                                        –
                                        {{ $chapter->audition_end?->format('d M Y') }}
                                    </span>
                                    @if(now()->between($chapter->audition_start, $chapter->audition_end))
                                        <span class="badge badge-primary badge-sm">Aktif</span>
                                    @else
                                        <span class="badge badge-ghost badge-sm">Selesai</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if(! empty($chapter->thumbnail_urls))
                            <div class="relative w-4/7 max-lg:hidden shrink-0 self-stretch overflow-hidden bg-base-300">
                                <img
                                    src="{{ $chapter->random_thumbnail_url }}"
                                    alt="{{ $chapter->name }}"
                                    loading="lazy"
                                    class="absolute inset-0 h-full w-full object-cover object-center transition-transform duration-300 group-hover:scale-105"
                                />
                            </div>
                        @endif
                    </a>
                    @endforeach
                </div>
            @endif
        </div>

    </section>
</x-app-layout>
