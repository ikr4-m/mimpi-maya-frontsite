import type Lenis from 'lenis';

declare global {
  interface Window {
    gsap: typeof import('gsap').default;
    Alpine: typeof import('alpinejs').default;
    __lenis: Lenis | null;
    __overlayGone: boolean;
    pages: Array<{ title: string; url: string }>;
  }
}
