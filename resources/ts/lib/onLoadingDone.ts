export default function onLoadingDone(callback: () => void) {
  if (window.__overlayGone) {
    callback();
    return;
  }

  let called = false;
  const run = () => {
    if (called) return;
    called = true;
    callback();
  };

  window.addEventListener('loading-overlay-hidden', run, { once: true });

  // Safety fallback: ensure animations run even if loading event was missed
  setTimeout(run, 1200);
}
