const BASE = new URL('./', self.location.href);
const CACHE_PREFIX = `von-portfolio-${BASE.pathname}-`;
const CACHE_NAME = `${CACHE_PREFIX}v9`;
const HOME = BASE.href;
const urlsToCache = [
  './', 'manifest.json', 'styles.css', 'chat.css', 'enhancements.css',
  'script.js?v=9', 'images/logo.png', 'Von_Esson_Vergara_Resume.pdf',
  'image.png', 'images/sdp.png', 'images/carwash.png', 'images/ams.png'
].map(path => new URL(path, BASE).href);

self.addEventListener('install', event => {
  event.waitUntil(caches.open(CACHE_NAME).then(cache => cache.addAll(urlsToCache))
    .then(() => self.skipWaiting()));
});

self.addEventListener('activate', event => {
  event.waitUntil(caches.keys().then(names => Promise.all(names
    .filter(name => (name.startsWith(CACHE_PREFIX) || /^von-portfolio-v\d+$/.test(name)) && name !== CACHE_NAME)
    .map(name => caches.delete(name))))
    .then(() => self.clients.claim()));
});

self.addEventListener('fetch', event => {
  const url = new URL(event.request.url);
  if (event.request.method !== 'GET' || url.origin !== BASE.origin
      || !url.pathname.startsWith(BASE.pathname)
      || url.pathname.startsWith(`${BASE.pathname}api/`)) return;

  if (event.request.mode === 'navigate') {
    // Only the portfolio is an offline page; never cache errors as the home page.
    if (![BASE.pathname, `${BASE.pathname}index.html`].includes(url.pathname)) return;
    event.respondWith(fetch(event.request).then(async response => {
      if (response.ok) {
        const cache = await caches.open(CACHE_NAME);
        await cache.put(HOME, response.clone());
      }
      return response;
    }).catch(async () => (await caches.match(HOME)) || Response.error()));
    return;
  }

  event.respondWith(caches.match(event.request).then(cached => cached || fetch(event.request)
    .then(async response => {
      if (response.ok && response.type === 'basic') {
        const cache = await caches.open(CACHE_NAME);
        await cache.put(event.request, response.clone());
      }
      return response;
    })));
});
