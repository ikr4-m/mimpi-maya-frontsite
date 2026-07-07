import Alpine from 'alpinejs';
import gsap from 'gsap';

declare global {
  interface Window {
    gsap: typeof gsap;
    Alpine: typeof Alpine;
    __lenis: any;
    pages: Array<{ title: string; url: string }>;
  }
}

window.gsap = gsap;
window.Alpine = Alpine;
Alpine.start();
