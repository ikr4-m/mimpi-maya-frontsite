import Alpine from 'alpinejs';

Alpine.data('loadingOverlay', () => ({
  showOverlay: true,

  init() {
    const images = Array.from(document.images);
    const imagePromises = images.map((img) => {
      if (img.complete) return Promise.resolve();
      return new Promise<void>((resolve) => {
        img.addEventListener('load', () => resolve(), { once: true });
        img.addEventListener('error', () => resolve(), { once: true });
      });
    });

    Promise.all([
      ...imagePromises,
      document.fonts.ready,
      new Promise<void>((resolve) => {
        if (document.readyState === 'complete') resolve();
        else window.addEventListener('load', () => resolve(), { once: true });
      }),
      new Promise<void>((resolve) => setTimeout(resolve, 800)),
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

    if (!overlay || !content || !gsap) return;

    gsap
      .timeline({
        onComplete: () => {
          this.showOverlay = false;
          window.__overlayGone = true;
          window.dispatchEvent(new CustomEvent('loading-overlay-hidden'));
        },
      })
      .to(content, { opacity: 0, y: -20, duration: 0.4, ease: 'power2.in' })
      .to(overlay, { opacity: 0, duration: 0.5, ease: 'power2.inOut' }, '-=0.2');
  },
}));

Alpine.data('navbar', () => ({
  open: false,

  get currentPage() {
    const path = window.location.pathname;
    if (path === '/') return '/';
    const found = window.pages.find(
      (p) => p.url !== '/' && (path === p.url || path.startsWith(`${p.url}/`)),
    );
    return found ? found.url : null;
  },

  init() {
    this.$watch('open', (val) => {
      if (window.__lenis) {
        val ? window.__lenis.stop() : window.__lenis.start();
      }
    });
  },
}));
