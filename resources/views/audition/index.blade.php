<x-app-layout title="Audition">
    @push('head_scripts')
        @vite(['resources/ts/audition.ts'])
    @endpush

    @php
        $setting = \App\Models\AuditionSetting::first();
        $auditionStart = $setting?->audition_start;
        $auditionEnd = $setting?->audition_end;

        $timeline = \App\Models\AuditionContent::active()->byType('timeline')->orderBy('sort_order')->get();
        $requirements = \App\Models\AuditionContent::active()->byType('requirement')->orderBy('sort_order')->get();
        $benefits = \App\Models\AuditionContent::active()->byType('benefit')->orderBy('sort_order')->get();
        $contactLinks = \App\Models\AuditionContent::active()->byType('contact_link')->orderBy('sort_order')->get();
        $aboutCards = \App\Models\AuditionContent::active()->byType('about_card')->orderBy('sort_order')->get();

        $isRegistrationOpen = $auditionStart && $auditionEnd
            ? now() >= $auditionStart && now() <= $auditionEnd
            : false;
    @endphp

    <div id="audition-root" class="relative bg-base-100">
        {{-- ===== HERO SECTION ===== --}}
        <section
            id="hero-section"
            class="relative flex min-h-[calc(100dvh-4rem)] items-end pb-16 pt-24 lg:min-h-[calc(100vh-4rem)] lg:pb-20 lg:pt-28"
        >
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_60%_30%,_rgba(234,179,8,0.12),_transparent_55%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_90%_90%,_rgba(234,179,8,0.08),_transparent_40%)]"></div>

            <div
                class="absolute inset-0 opacity-[0.03]"
                style="background-image: radial-gradient(circle, currentColor 1px, transparent 1px); background-size: 12px 12px;"
            ></div>

            {{-- VT Characters --}}
            <div class="pointer-events-none absolute z-0 w-auto h-[150%] lg:h-[175%] top-0 right-0 max-sm:right-[-25%] pt-6 pr-2 sm:pt-8 sm:pr-8 lg:pt-12 lg:pr-12">
                <div class="h-full w-auto max-w-none drop-shadow-[0_0_30px_rgba(234,179,8,0.30)]">
                    <img id="vt1" src="{{ asset('images/audition/vt1-trim.webp') }}" alt="vt1" class="h-full w-auto max-w-none object-contain opacity-0" />
                </div>
            </div>
            <div class="pointer-events-none absolute z-0 w-auto h-[135%] lg:h-[150%] top-0 right-[17.5%] pt-28 pr-8 sm:pt-56 sm:pr-8 lg:pt-36 lg:pr-12">
                <div class="h-full w-auto max-w-none drop-shadow-[0_0_25px_rgba(234,179,8,0.25)]">
                    <img id="vt2" src="{{ asset('images/audition/vt2-trim.webp') }}" alt="vt2" class="h-full w-auto max-w-none object-contain opacity-0" />
                </div>
            </div>

            <canvas id="sparkle-canvas" class="absolute inset-0 pointer-events-none"></canvas>

            <div class="container relative z-10 mx-auto px-6">
                <div class="grid items-end gap-8 lg:grid-cols-2 lg:gap-4">
                    <div class="order-2 space-y-5 lg:order-1 lg:space-y-6">
                        <img id="chapter-hero" src="{{ asset('images/audition/chapter-hero.webp') }}" alt="Chapter 02" class="h-14 w-auto opacity-0 lg:h-16" />
                        <img id="title-hero" src="{{ asset('images/audition/audition-title-hero.webp') }}" alt="Virtual Liver Audition" class="w-full max-w-lg opacity-0 lg:max-w-xl" />
                            <p id="tagline" class="font-share-tech text-lg tracking-[0.2em] text-primary/90 uppercase opacity-0 lg:text-xl">
                                {{ $setting?->tagline ?? 'Your Voice. Your Character. Your Story.' }}
                            </p>

                        <div id="date-badge" class="inline-flex items-center gap-3 rounded-full border border-primary/50 bg-primary/10 px-5 py-2.5 text-primary opacity-0 shadow-[0_0_20px_rgba(234,179,8,0.15)] lg:px-6 lg:py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256" fill="currentColor"><path d="M208 32h-24v-8a8 8 0 0 0-16 0v8H88v-8a8 8 0 0 0-16 0v8H48a16 16 0 0 0-16 16v160a16 16 0 0 0 16 16h160a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16Zm0 176H48V48h24v8a8 8 0 0 0 16 0v-8h80v8a8 8 0 0 0 16 0v-8h24Zm-16-80h-48v48h48Zm-64 0H80v48h48Zm0-16v-48H80v48Zm16 0h48V80h-48Z"/></svg>
                            <span class="font-bold tracking-wider text-sm lg:text-base">
                                {{ $auditionStart ? strtoupper($auditionStart->format('d F Y')) : '-' }} - {{ $auditionEnd ? strtoupper($auditionEnd->format('d F Y')) : '-' }}
                            </span>
                        </div>

                        <div id="hero-cta" class="flex flex-wrap items-center gap-3 opacity-0 lg:gap-4">
                            <a href="{{ url('/audition/form') }}" class="btn btn-primary group shadow-[0_0_20px_rgba(234,179,8,0.25)] transition-shadow hover:shadow-[0_0_30px_rgba(234,179,8,0.4)]">
                                Daftar Sekarang
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 256 256" fill="currentColor" class="transition-transform group-hover:translate-x-1"><path d="M224.49 136.49l-72 72a12 12 0 0 1-17-17L187 140H40a12 12 0 0 1 0-24h147l-51.49-51.52a12 12 0 0 1 17-17l72 72a12 12 0 0 1-.02 17.01Z"/></svg>
                            </a>
                            <a href="#about" class="btn btn-outline btn-primary">
                                Pelajari Lebih Lanjut
                            </a>
                        </div>

                        @if (!$isRegistrationOpen && $auditionStart && $auditionEnd)
                            <p class="text-sm text-base-content/60">
                                @if (now() < $auditionStart)
                                    Pendaftaran dibuka {{ $auditionStart->format('d F Y') }}
                                @else
                                    Pendaftaran telah ditutup pada {{ $auditionEnd->format('d F Y') }}
                                @endif
                            </p>
                        @endif
                    </div>

                    <div class="order-1 hidden lg:order-2 lg:block"></div>
                </div>
            </div>
        </section>

        {{-- ===== ABOUT SECTION ===== --}}
        <section id="about" class="relative py-20 lg:py-32">
            <div class="container relative z-10 mx-auto px-6">
                <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">
                    <div id="about-heading" class="space-y-5">
                        <span class="text-sm font-bold tracking-[0.2em] text-primary uppercase">About</span>
                        <h2 class="text-3xl font-bold leading-tight lg:text-5xl">{{ $setting?->about_title ?? 'Apa sih ini?' }}</h2>
                        <div class="space-y-4 text-base leading-relaxed text-base-content/80 lg:text-lg">
                            {!! nl2br(e($setting?->about_description ?? '')) !!}
                        </div>
                    </div>

                    <div id="about-cards" class="grid gap-4 lg:gap-5">
                        @foreach ($aboutCards as $i => $card)
                            <div class="card border border-base-300 bg-base-200 p-5 transition-all duration-300 hover:-translate-y-1 hover:border-primary/50 hover:shadow-[0_0_25px_rgba(234,179,8,0.12)] lg:p-6" style="margin-left: {{ $i % 2 === 1 ? '1.5rem' : '0' }}">
                                <div class="flex flex-row items-center justify-center gap-5">
                                    <div class="w-[30px] h-[30px] text-primary">
                                        <x-icon name="{{ $card->icon }}" />
                                    </div>
                                    <div>
                                        <h3 class="mb-1 text-lg font-bold">{{ $card->title }}</h3>
                                        <p class="text-sm text-base-content/70 lg:text-base">{{ $card->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== TIMELINE SECTION ===== --}}
        <section id="timeline" class="relative py-20 lg:py-32">
            <div class="container mx-auto px-6">
                <div class="mb-12 text-center lg:mb-16">
                    <span class="text-sm font-bold tracking-[0.2em] text-primary uppercase">Timeline</span>
                    <h2 class="mt-3 text-3xl font-bold lg:text-5xl">Jadwal Audisi</h2>
                    <p class="mt-3 text-base-content/70">Catat tanggal-tanggal penting berikut ini.</p>
                </div>

                <div class="relative mx-auto max-w-4xl">
                    <div id="timeline-line" class="absolute top-0 bottom-0 left-6 w-0.5 bg-gradient-to-b from-primary via-primary/50 to-primary/20 lg:left-1/2 lg:-translate-x-1/2"></div>

                    <div class="space-y-8 lg:space-y-12">
                        @php $now = now(); @endphp
                        @foreach ($timeline as $index => $item)
                            @php
                                $itemDate = $item->date;
                                if ($now < $itemDate) {
                                    $status = 'upcoming';
                                } elseif (!isset($timeline[$index + 1])) {
                                    $status = 'active';
                                } else {
                                    $nextDate = $timeline[$index + 1]->date;
                                    $status = $now < $nextDate ? 'active' : 'completed';
                                }
                                $isLeft = $index % 2 === 0;
                            @endphp

                            <div class="timeline-item relative flex items-center gap-6 lg:gap-0 {{ $isLeft ? 'lg:flex-row' : 'lg:flex-row-reverse' }}">
                                <div class="absolute left-6 z-10 h-4 w-4 -translate-x-1/2 rounded-full border-2 border-base-100 lg:left-1/2 {{ $status === 'completed' ? 'bg-primary' : ($status === 'active' ? 'bg-base-100 ring-2 ring-primary' : 'bg-base-300') }}"></div>

                                <div class="ml-14 flex-1 lg:ml-0 lg:w-[45%] {{ $isLeft ? 'lg:pr-12' : 'lg:pl-12' }}">
                                    <div class="card border bg-base-200 p-5 transition-all duration-300 hover:-translate-y-1 {{ $status === 'active' ? 'border-primary shadow-[0_0_25px_rgba(234,179,8,0.15)]' : 'border-base-300 hover:border-primary/40' }}">
                                        <div class="flex flex-wrap items-center justify-between gap-2">
                                            <h3 class="text-lg font-bold">{{ $item->title }}</h3>
                                            <span class="badge text-xs {{ $status === 'completed' ? 'badge-primary' : ($status === 'active' ? 'badge-outline badge-primary' : 'badge-ghost') }}">
                                                {{ $status === 'completed' ? 'Selesai' : ($status === 'active' ? 'Sedang Berlangsung' : 'Mendatang') }}
                                            </span>
                                        </div>
                                        <p class="mt-1 text-sm font-semibold text-primary">{{ $itemDate?->format('d F Y') }}</p>
                                        <p class="mt-2 text-sm text-base-content/70">{{ $item->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== REQUIREMENTS SECTION ===== --}}
        <section id="requirements" class="relative py-20 lg:py-32">
            <div class="container mx-auto px-6">
                <div class="mb-12 text-center lg:mb-16">
                    <span class="text-sm font-bold tracking-[0.2em] text-primary uppercase">Requirements</span>
                    <h2 class="mt-3 text-3xl font-bold lg:text-5xl">Syarat & Ketentuan</h2>
                    <p class="mt-3 text-base-content/70">Pastikan kamu memenuhi persyaratan berikut sebelum mendaftar.</p>
                </div>

                <div id="requirements-grid" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 lg:gap-6">
                    @foreach ($requirements as $req)
                        <div class="card border border-base-300 bg-base-200 p-5 transition-all duration-300 hover:-translate-y-1 hover:border-primary/50 hover:shadow-[0_0_25px_rgba(234,179,8,0.12)] lg:p-6">
                            <div class="mb-3 inline-flex rounded-lg bg-primary/10 p-2.5 text-primary">
                                <div class="w-[50%] m-auto">
                                    <x-icon name="{{ $req->icon }}" />
                                </div>
                            </div>
                            <h3 class="mb-2 text-lg font-bold">{{ $req->title }}</h3>
                            <p class="text-sm text-base-content/70 lg:text-base">{{ $req->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ===== BENEFITS SECTION ===== --}}
        <section id="benefits" class="relative py-20 lg:py-32">
            <div class="container mx-auto px-6">
                <div class="mb-12 text-center lg:mb-16">
                    <span class="text-sm font-bold tracking-[0.2em] text-primary uppercase">Benefits</span>
                    <h2 class="mt-3 text-3xl font-bold lg:text-5xl">Benefit Bergabung</h2>
                    <p class="mt-3 text-base-content/70">Keuntungan yang kamu dapatkan saat menjadi bagian dari Mimpi Maya.</p>
                </div>

                <div id="benefits-grid" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 lg:gap-6">
                    @foreach ($benefits as $benefit)
                        <div class="card border border-base-300 bg-base-200 p-5 transition-all duration-300 hover:-translate-y-1 hover:border-primary/50 hover:shadow-[0_0_25px_rgba(234,179,8,0.12)] lg:p-6">
                            <div class="mb-3 inline-flex rounded-lg bg-primary/10 p-2.5 text-primary">
                                <div class="w-[50%] m-auto">
                                    <x-icon name="{{ $benefit->icon }}" />
                                </div>
                            </div>
                            <h3 class="mb-2 text-lg font-bold">{{ $benefit->title }}</h3>
                            <p class="text-sm text-base-content/70 lg:text-base">{{ $benefit->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ===== CTA SECTION ===== --}}
        <section id="cta-section" class="relative py-24 lg:py-40">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(234,179,8,0.1),_transparent_60%)]"></div>

            <div class="container relative z-10 mx-auto px-6">
                <div id="cta-content" class="mx-auto max-w-3xl text-center">
                    <h2 class="text-3xl font-bold leading-tight lg:text-6xl">Siap Jadi Virtual Liver Berikutnya?</h2>
                    <p class="mx-auto mt-5 max-w-xl text-base-content/70 lg:text-lg">
                        Daftarkan dirimu sekarang dan mulai perjalananmu bersama Mimpi Maya.
                    </p>

                    <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                        <a href="{{ url('/audition/form') }}" class="btn btn-primary group animate-pulse shadow-[0_0_30px_rgba(234,179,8,0.3)] transition-shadow hover:shadow-[0_0_45px_rgba(234,179,8,0.5)]">
                            Daftar Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 256 256" fill="currentColor" class="transition-transform group-hover:translate-x-1"><path d="M224.49 136.49l-72 72a12 12 0 0 1-17-17L187 140H40a12 12 0 0 1 0-24h147l-51.49-51.52a12 12 0 0 1 17-17l72 72a12 12 0 0 1-.02 17.01Z"/></svg>
                        </a>
                    </div>

                    <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                        @foreach ($contactLinks as $contact)
                            <a href="{{ $contact->url }}" class="btn btn-ghost btn-sm gap-2 text-base-content/70 hover:text-primary">
                                <div class="w-[30px] h-[30px]">
                                    <x-icon name="{{ $contact->icon }}" />
                                </div>
                                {{ $contact->label }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
