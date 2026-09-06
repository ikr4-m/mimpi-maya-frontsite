import Alpine from 'alpinejs';

const safeStorage = {
  get(key: string): string | null {
    try {
      return sessionStorage.getItem(key);
    } catch {
      return null;
    }
  },
  set(key: string, value: string): void {
    try {
      sessionStorage.setItem(key, value);
    } catch {
      // Storage unavailable or disabled
    }
  },
  remove(key: string): void {
    try {
      sessionStorage.removeItem(key);
    } catch {
      // Storage unavailable or disabled
    }
  },
};

Alpine.data('loadingOverlay', () => ({
  showOverlay: true,
  isTransitioning: false,

  init() {
    const isNavigating = safeStorage.get('mm_navigating') === '1';
    const hasLoadedBefore = safeStorage.get('mm_loaded') === '1';

    // Clear navigation flag immediately
    safeStorage.remove('mm_navigating');

    // Handle bfcache (browser back/forward button restore)
    window.addEventListener('pageshow', (event: PageTransitionEvent) => {
      if (event.persisted) {
        this.resetOverlay();
      }
    });

    // Setup link click interception for outbound transitions
    this.setupLinkInterceptor();

    // Fast reveal if navigated internally or revisited in active session
    if (isNavigating || hasLoadedBefore) {
      Promise.race([
        document.fonts.ready,
        new Promise<void>((resolve) => {
          setTimeout(resolve, 80);
        }),
      ]).then(() => {
        this.$nextTick(() => {
          requestAnimationFrame(() => {
            this.hideOverlay(true);
          });
        });
      });
      return;
    }

    // Cold initial visit: wait for critical assets and display brand splash
    safeStorage.set('mm_loaded', '1');

    const images = Array.from(document.images);
    const imagePromises = images.map((img) => {
      if (img.complete) {
        return Promise.resolve();
      }
      return new Promise<void>((resolve) => {
        img.addEventListener('load', () => resolve(), { once: true });
        img.addEventListener('error', () => resolve(), { once: true });
      });
    });

    Promise.all([
      ...imagePromises,
      document.fonts.ready,
      new Promise<void>((resolve) => {
        if (document.readyState === 'complete') {
          resolve();
        } else {
          window.addEventListener('load', () => resolve(), { once: true });
        }
      }),
      new Promise<void>((resolve) => {
        setTimeout(resolve, 800);
      }),
    ]).then(() => {
      this.$nextTick(() => {
        this.hideOverlay(false);
      });
    });
  },

  hideOverlay(fast = false) {
    const overlay = this.$refs.overlay as HTMLElement | undefined;
    const content = this.$refs.content as HTMLElement | undefined;
    const { gsap } = window;

    if (!overlay || !content || !gsap) {
      this.showOverlay = false;
      this.isTransitioning = false;
      window.__overlayGone = true;
      window.dispatchEvent(new CustomEvent('loading-overlay-hidden'));
      return;
    }

    gsap.killTweensOf([overlay, content]);

    const contentDuration = fast ? 0.2 : 0.35;
    const overlayDuration = fast ? 0.25 : 0.45;

    gsap
      .timeline({
        onComplete: () => {
          this.showOverlay = false;
          this.isTransitioning = false;
          window.__overlayGone = true;
          window.dispatchEvent(new CustomEvent('loading-overlay-hidden'));
        },
      })
      .to(content, {
        opacity: 0,
        y: -16,
        duration: contentDuration,
        ease: 'power2.in',
      })
      .to(
        overlay,
        {
          opacity: 0,
          duration: overlayDuration,
          ease: 'power2.inOut',
        },
        '-=0.1',
      );
  },

  navigateWithTransition(url: string) {
    this.isTransitioning = true;
    window.__overlayGone = false;

    const overlay = this.$refs.overlay as HTMLElement | undefined;
    const content = this.$refs.content as HTMLElement | undefined;
    const { gsap } = window;

    if (!overlay || !content || !gsap) {
      safeStorage.set('mm_navigating', '1');
      window.location.href = url;
      return;
    }

    // Fallback timer if navigation stalls
    const safetyTimer = setTimeout(() => {
      safeStorage.set('mm_navigating', '1');
      window.location.href = url;
    }, 1200);

    gsap.killTweensOf([overlay, content]);
    gsap.set(overlay, { opacity: 0, display: 'flex' });
    gsap.set(content, { opacity: 0, y: 16 });
    this.showOverlay = true;

    gsap
      .timeline({
        onComplete: () => {
          clearTimeout(safetyTimer);
          safeStorage.set('mm_navigating', '1');
          window.location.href = url;
        },
      })
      .to(overlay, {
        opacity: 1,
        duration: 0.22,
        ease: 'power2.inOut',
      })
      .to(
        content,
        {
          opacity: 1,
          y: 0,
          duration: 0.18,
          ease: 'power2.out',
        },
        '-=0.12',
      );
  },

  resetOverlay() {
    const overlay = this.$refs.overlay as HTMLElement | undefined;
    const content = this.$refs.content as HTMLElement | undefined;
    const { gsap } = window;

    this.showOverlay = false;
    this.isTransitioning = false;
    window.__overlayGone = true;
    safeStorage.remove('mm_navigating');

    if (overlay && gsap) {
      gsap.killTweensOf(overlay);
      gsap.set(overlay, { opacity: 0, display: 'none' });
    }
    if (content && gsap) {
      gsap.killTweensOf(content);
      gsap.set(content, { opacity: 0 });
    }
    window.dispatchEvent(new CustomEvent('loading-overlay-hidden'));
  },

  setupLinkInterceptor() {
    document.addEventListener('click', (e: MouseEvent) => {
      if (this.isTransitioning) {
        const clickedLink = (e.target as HTMLElement | null)?.closest?.('a');
        if (clickedLink) {
          e.preventDefault();
        }
        return;
      }

      if (e.button !== 0 || e.defaultPrevented) {
        return;
      }

      if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) {
        return;
      }

      const link = (e.target as HTMLElement | null)?.closest?.('a');
      if (!link) {
        return;
      }

      if (
        link.hasAttribute('download') ||
        link.hasAttribute('data-no-transition') ||
        link.getAttribute('rel')?.includes('external')
      ) {
        return;
      }

      if (link.target && link.target !== '_self') {
        return;
      }

      const href = link.getAttribute('href');
      if (
        !href ||
        href.startsWith('#') ||
        href.startsWith('javascript:') ||
        href.startsWith('mailto:') ||
        href.startsWith('tel:')
      ) {
        return;
      }

      try {
        const targetUrl = new URL(link.href, window.location.href);
        if (targetUrl.origin !== window.location.origin) {
          return;
        }

        if (
          targetUrl.pathname === window.location.pathname &&
          targetUrl.search === window.location.search
        ) {
          if (targetUrl.hash) {
            return;
          }
          e.preventDefault();
          return;
        }

        e.preventDefault();
        this.navigateWithTransition(targetUrl.href);
      } catch {
        // Fallback to native navigation on invalid URL
      }
    });
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
