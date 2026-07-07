export default function onLoadingDone(callback: () => void) {
  if (window.__overlayGone) {
    callback();
    return;
  }
  window.addEventListener('loading-overlay-hidden', callback, { once: true });
}
