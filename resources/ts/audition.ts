import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';
import onLoadingDone from './lib/onLoadingDone';

gsap.registerPlugin(ScrollTrigger);

function initSparkleCanvas(): () => void {
  const canvas = document.getElementById('sparkle-canvas') as HTMLCanvasElement | null;
  if (!canvas) return () => {};

  const ctx = canvas.getContext('2d');
  if (!ctx) return () => {};

  interface Particle {
    x: number;
    y: number;
    size: number;
    speedX: number;
    speedY: number;
    opacity: number;
    twinkleSpeed: number;
  }

  let animationId: number;
  let particles: Particle[] = [];
  let time = 0;

  const initParticles = () => {
    particles = [];
    const cssWidth = canvas.offsetWidth;
    const cssHeight = canvas.offsetHeight;
    const count = Math.min(150, Math.floor((cssWidth * cssHeight) / 5000));

    for (let i = 0; i < count; i++) {
      particles.push({
        x: Math.random() * cssWidth,
        y: Math.random() * cssHeight,
        size: Math.random() * 2 + 0.5,
        speedX: (Math.random() - 0.5) * 0.3,
        speedY: (Math.random() - 0.5) * 0.3 - 0.1,
        opacity: Math.random() * 0.6 + 0.2,
        twinkleSpeed: Math.random() * 0.02 + 0.005,
      });
    }
  };

  const resize = () => {
    const dpr = window.devicePixelRatio || 1;
    const cssWidth = canvas.offsetWidth;
    const cssHeight = canvas.offsetHeight;

    canvas.width = cssWidth * dpr;
    canvas.height = cssHeight * dpr;
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

    initParticles();
  };

  const animate = () => {
    const cssWidth = canvas.offsetWidth;
    const cssHeight = canvas.offsetHeight;

    ctx.clearRect(0, 0, cssWidth, cssHeight);
    time += 1;

    particles.forEach((p) => {
      p.x += p.speedX;
      p.y += p.speedY;

      if (p.x < 0) p.x = cssWidth;
      if (p.x > cssWidth) p.x = 0;
      if (p.y < 0) p.y = cssHeight;
      if (p.y > cssHeight) p.y = 0;

      const opacity = p.opacity * (0.6 + 0.4 * Math.sin(time * p.twinkleSpeed));
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(250, 204, 21, ${opacity})`;
      ctx.fill();
    });

    animationId = requestAnimationFrame(animate);
  };

  resize();
  window.addEventListener('resize', resize);
  animate();

  return () => {
    cancelAnimationFrame(animationId);
    window.removeEventListener('resize', resize);
  };
}

function initParallax(): () => void {
  const layers = document.querySelectorAll<HTMLElement>('.parallax-vt');
  if (layers.length === 0) return () => {};

  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const isTouch = window.matchMedia('(pointer: coarse)').matches;
  if (prefersReducedMotion || isTouch) return () => {};

  const tweens = Array.from(layers).map((el) => {
    const duration = parseFloat(el.dataset.duration ?? '0.7');
    return {
      x: gsap.quickTo(el, 'x', { duration, ease: 'power2.out' }),
      y: gsap.quickTo(el, 'y', { duration, ease: 'power2.out' }),
      depthX: parseFloat(el.dataset.depthX ?? '-15'),
      depthY: parseFloat(el.dataset.depthY ?? '-6'),
    };
  });

  const handleMouseMove = (e: MouseEvent) => {
    const centerX = window.innerWidth / 2;
    const centerY = window.innerHeight / 2;
    const x = (e.clientX - centerX) / centerX;
    const y = (e.clientY - centerY) / centerY;

    tweens.forEach((t) => {
      t.x(x * t.depthX);
      t.y(y * t.depthY);
    });
  };

  window.addEventListener('mousemove', handleMouseMove);
  return () => window.removeEventListener('mousemove', handleMouseMove);
}

function initLenis(): () => void {
  const lenis = new Lenis({
    duration: 1.2,
    easing: (t: number) => Math.min(1, 1.001 - 2 ** (-10 * t)),
  });

  window.__lenis = lenis;

  lenis.on('scroll', ScrollTrigger.update);

  gsap.ticker.add((time) => {
    lenis.raf(time * 1000);
  });

  gsap.ticker.lagSmoothing(0);

  return () => {
    lenis.destroy();
    window.__lenis = null;
  };
}

function initHeroEntrance(): () => void {
  const chapterHero = document.getElementById('chapter-hero');
  const titleHero = document.getElementById('title-hero');
  const tagline = document.getElementById('tagline');
  const dateBadge = document.getElementById('date-badge');
  const heroCta = document.getElementById('hero-cta');
  const vts = document.querySelectorAll<HTMLElement>('.hero-vt');

  const tl = gsap.timeline({ defaults: { ease: 'power3.out' }, delay: 0.2 });

  tl.fromTo(chapterHero, { scale: 0.8, opacity: 0 }, { scale: 1, opacity: 1, duration: 0.6 })
    .fromTo(titleHero, { y: 60, opacity: 0 }, { y: 0, opacity: 1, duration: 0.8 }, '-=0.3')
    .fromTo(tagline, { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.6 }, '-=0.5')
    .fromTo(dateBadge, { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.6 }, '-=0.4')
    .fromTo(heroCta, { y: 20, opacity: 0 }, { y: 0, opacity: 1, duration: 0.5 }, '-=0.3');

  if (vts.length) {
    tl.fromTo(vts, { y: 100, opacity: 0 }, { y: 0, opacity: 1, duration: 1, stagger: 0.1 }, '-=0.8');
  }

  return () => tl.kill();
}

function initScrollAnimations(): void {
  // About section
  const aboutHeading = document.getElementById('about-heading');
  const aboutCards = document.getElementById('about-cards');
  const aboutSection = document.getElementById('about');

  if (aboutHeading && aboutSection) {
    gsap.fromTo(
      aboutHeading,
      { x: -50, opacity: 0 },
      {
        scrollTrigger: {
          trigger: aboutSection,
          start: 'top 75%',
          toggleActions: 'play none none reverse',
        },
        x: 0,
        opacity: 1,
        duration: 0.8,
        ease: 'power3.out',
      },
    );
  }

  if (aboutCards && aboutCards.children.length) {
    gsap.fromTo(
      aboutCards.children,
      { x: 50, opacity: 0 },
      {
        scrollTrigger: {
          trigger: aboutCards,
          start: 'top 75%',
          toggleActions: 'play none none reverse',
        },
        x: 0,
        opacity: 1,
        stagger: 0.15,
        duration: 0.7,
        ease: 'power3.out',
      },
    );
  }

  // Timeline line
  const timelineLine = document.getElementById('timeline-line');
  const timelineSection = document.getElementById('timeline');
  if (timelineLine && timelineSection) {
    gsap.fromTo(
      timelineLine,
      { scaleY: 0 },
      {
        scrollTrigger: { trigger: timelineSection, start: 'top 70%', end: 'bottom 50%', scrub: 1 },
        scaleY: 1,
        transformOrigin: 'top center',
        ease: 'none',
      },
    );
  }

  // Timeline items slide-in
  const timelineItems = document.querySelectorAll('.timeline-item');
  timelineItems.forEach((item, index) => {
    const isLeft = index % 2 === 0;
    gsap.fromTo(
      item,
      { x: isLeft ? -40 : 40, opacity: 0 },
      {
        scrollTrigger: { trigger: item, start: 'top 80%', toggleActions: 'play none none reverse' },
        x: 0,
        opacity: 1,
        duration: 0.7,
        ease: 'power3.out',
      },
    );
  });

  // Requirements
  const reqGrid = document.getElementById('requirements-grid');
  const reqSection = document.getElementById('requirements');
  if (reqGrid && reqGrid.children.length && reqSection) {
    gsap.fromTo(
      reqGrid.children,
      { y: 40, opacity: 0 },
      {
        scrollTrigger: {
          trigger: reqSection,
          start: 'top 70%',
          toggleActions: 'play none none reverse',
        },
        y: 0,
        opacity: 1,
        stagger: 0.1,
        duration: 0.6,
        ease: 'power3.out',
      },
    );
  }

  // Benefits
  const benefitsGrid = document.getElementById('benefits-grid');
  const benefitsSection = document.getElementById('benefits');
  if (benefitsGrid && benefitsGrid.children.length && benefitsSection) {
    gsap.fromTo(
      benefitsGrid.children,
      { y: 40, opacity: 0 },
      {
        scrollTrigger: {
          trigger: benefitsSection,
          start: 'top 70%',
          toggleActions: 'play none none reverse',
        },
        y: 0,
        opacity: 1,
        stagger: 0.1,
        duration: 0.6,
        ease: 'power3.out',
      },
    );
  }

  // CTA
  const ctaContent = document.getElementById('cta-content');
  const ctaSection = document.getElementById('cta-section');
  if (ctaContent && ctaSection) {
    gsap.fromTo(
      ctaContent,
      { y: 50, opacity: 0 },
      {
        scrollTrigger: {
          trigger: ctaSection,
          start: 'top 70%',
          toggleActions: 'play none none reverse',
        },
        y: 0,
        opacity: 1,
        duration: 0.8,
        ease: 'power3.out',
      },
    );
  }

  ScrollTrigger.refresh();
}

// --- Main init ---
window.addEventListener('load', () => {
  initLenis();

  ScrollTrigger.refresh();
  setTimeout(() => ScrollTrigger.refresh(), 500);

  onLoadingDone(() => {
    initHeroEntrance();
    initScrollAnimations();
    initSparkleCanvas();
    initParallax();
  });
});
