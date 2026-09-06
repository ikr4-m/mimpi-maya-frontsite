<div
    x-data="loadingOverlay"
    x-show="showOverlay"
    x-ref="overlay"
    data-loading-overlay
    class="fixed inset-0 z-[100] flex items-center justify-center bg-base-100 select-none"
>
    <div x-ref="content" class="flex flex-col items-center gap-4 pointer-events-none">
        <img src="{{ asset('images/logo.webp') }}" alt="Mimpi Maya" class="h-16 w-auto pointer-events-none" />
        <div class="h-1 w-32 overflow-hidden rounded-full bg-base-300">
            <div class="h-full w-full animate-pulse bg-primary"></div>
        </div>
    </div>
</div>
