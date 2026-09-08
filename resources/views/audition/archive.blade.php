<x-app-layout title="Audition">
    <section class="min-h-[60vh] flex flex-col items-center justify-center px-4 py-20">
        <div class="max-w-4xl mx-auto w-full text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-base-content mb-4">
                Audition Archive
            </h1>
            <p class="text-base-content/60 text-lg mb-12">
                Daftar audisi yang pernah dibuka oleh Mimpi Maya.
            </p>

            @if($chapters->isEmpty())
                <p class="text-base-content/40">Belum ada data audisi.</p>
            @else
                <div class="grid gap-6 md:grid-cols-2">
                    @foreach($chapters as $chapter)
                        <a
                            href="{{ route('index.audition.show', $chapter->slug) }}"
                            class="group block rounded-2xl border border-base-content/10 bg-base-200/50 p-6 text-left transition hover:border-primary/40 hover:bg-primary/5"
                        >
                            <div class="flex items-center justify-between mb-3">
                                <h2 class="text-xl font-semibold text-base-content group-hover:text-primary transition">
                                    {{ str($chapter->slug)->replace('-', ' ')->title() }}
                                </h2>
                                @if($chapter->is_active)
                                    <span class="badge badge-primary badge-sm">Aktif</span>
                                @else
                                    <span class="badge badge-ghost badge-sm">Selesai</span>
                                @endif
                            </div>

                            @if($chapter->tagline)
                                <p class="text-sm text-base-content/60 mb-3">{{ $chapter->tagline }}</p>
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
