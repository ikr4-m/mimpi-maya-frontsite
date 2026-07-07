<x-app-layout title="Form Audisi">
    @php
        // ponytail: hardcoded for now, env-based later
        $FORM_URL = '';
    @endphp

    @if (!$FORM_URL)
        <div class="flex min-h-[calc(100vh-4rem)] flex-col items-center justify-center px-6 py-20">
            <div class="card w-full max-w-2xl border border-base-300 bg-base-200 p-8 text-center lg:p-12">
                <h1 class="text-3xl font-bold lg:text-4xl">Form Pendaftaran Akan Segera Hadir</h1>
                <p class="mt-4 text-base-content/70">
                    Halaman pendaftaran untuk Virtual Liver Audition Chapter 02 sedang dalam persiapan.
                    Silakan kembali lagi nanti.
                </p>
                <a href="{{ url('/audition') }}" class="btn btn-primary mt-8 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M228 128a12 12 0 0 1-12 12H69l51.52 51.51a12 12 0 0 1-17 17l-72-72a12 12 0 0 1 0-17l72-72a12 12 0 0 1 17 17L69 116h147a12 12 0 0 1 12 12Z"/></svg>
                    Kembali ke Halaman Audisi
                </a>
            </div>
        </div>
    @else
        <div class="container mx-auto px-6 py-8">
            <iframe
                src="{{ $FORM_URL }}"
                title="Form Pendaftaran Virtual Liver Audition Chapter 02"
                class="min-h-[80vh] w-full rounded-lg border border-base-300"
            ></iframe>
        </div>
    @endif
</x-app-layout>
