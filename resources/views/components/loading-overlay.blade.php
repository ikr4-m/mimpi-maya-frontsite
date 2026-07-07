<div
    x-data="{
        showOverlay: true,
        init() {
            const images = Array.from(document.images);
            const imagePromises = images.map((img) => {
                if (img.complete) return Promise.resolve();
                return new Promise((resolve) => {
                    img.addEventListener('load', () => resolve(undefined), { once: true });
                    img.addEventListener('error', () => resolve(undefined), { once: true });
                });
            });

            Promise.all([
                ...imagePromises,
                document.fonts.ready,
                new Promise((resolve) => {
                    if (document.readyState === 'complete') resolve(undefined);
                    else window.addEventListener('load', () => resolve(undefined), { once: true });
                }),
                new Promise((resolve) => setTimeout(resolve, 800)),
            ]).then(() => {
                this.$nextTick(() => {
                    this.hideOverlay();
                });
            });
        },
        hideOverlay() {
            const overlay = this.$refs.overlay;
            const content = this.$refs.content;
            const { gsap } = window;

            gsap.timeline({
                onComplete: () => {
                    this.showOverlay = false;
                    window.__overlayGone = true;
                    window.dispatchEvent(new CustomEvent('loading-overlay-hidden'));
                },
            })
            .to(content, { opacity: 0, y: -20, duration: 0.4, ease: 'power2.in' })
            .to(overlay, { opacity: 0, duration: 0.5, ease: 'power2.inOut' }, '-=0.2');
        },
    }"
    x-show="showOverlay"
    x-ref="overlay"
    data-loading-overlay
    class="fixed inset-0 z-[100] flex items-center justify-center bg-base-100"
>
    <div x-ref="content" class="flex flex-col items-center gap-4">
        <img src="{{ asset('images/logo.webp') }}" alt="Mimpi Maya" class="h-16 w-auto" />
        <div class="h-1 w-32 overflow-hidden rounded-full bg-base-300">
            <div class="h-full w-full animate-pulse bg-primary"></div>
        </div>
    </div>
</div>
