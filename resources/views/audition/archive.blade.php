<x-app-layout title="Audition">
    <section class="relative min-h-[60vh] flex flex-col items-center justify-center px-4 py-20 overflow-hidden">
        {{-- Background ambient glow --}}
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_50%_20%,_rgba(234,179,8,0.15),_transparent_60%)] pointer-events-none"></div>
        <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[32rem] h-[32rem] bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-4xl mx-auto w-full text-center">
            <h1 class="text-4xl sm:text-6xl lg:text-7xl lg:mb-18 font-extrabold tracking-tight text-base-content font-share-tech uppercase">
                <span>
                    Arsip <br class="hidden sm:inline" />
                </span>
                <span class="bg-gradient-to-r from-primary via-amber-200 to-primary bg-clip-text text-transparent">
                    Audisi
                </span>
            </h1>

            @if($chapters->isEmpty())
                <p class="text-base-content/40">Belum ada data audisi.</p>
            @else
                <div class="grid gap-6 md:grid-cols-2">
                    @foreach($chapters as $chapter)
                        <a
                            href="{{ str_starts_with($chapter->slug, 'http') ? $chapter->slug : route('index.audition.show', $chapter->slug) }}"
                            class="group block overflow-hidden rounded-2xl border border-base-content/10 bg-base-200/50 p-6 text-left transition hover:border-primary/40 hover:bg-primary/5"
                        >
                            @if(! empty($chapter->thumbnail_urls))
                                <div class="relative mb-4 aspect-video w-full overflow-hidden rounded-xl bg-base-300">
                                    <img
                                        src="{{ $chapter->random_thumbnail_url }}"
                                        alt="{{ $chapter->name }}"
                                        loading="lazy"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                    />
                                </div>
                            @endif

                            <div class="flex items-center justify-between mb-3">
                                <h2 class="text-xl font-semibold text-base-content group-hover:text-primary transition">
                                    {{ $chapter->name }}
                                </h2>
                                @if(now()->between($chapter->audition_start, $chapter->audition_end))
                                    <span class="badge badge-primary badge-sm">Aktif</span>
                                @else
                                    <span class="badge badge-ghost badge-sm">Selesai</span>
                                @endif
                            </div>

                            @if($chapter->description)
                                <p class="text-sm text-base-content/60 mb-3">{{ $chapter->description }}</p>
                            @endif

                            <div class="text-xs text-base-content/40">
                                {{ $chapter->audition_start?->format('d M Y') }}
                                –
                                {{ $chapter->audition_end?->format('d M Y') }}
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
