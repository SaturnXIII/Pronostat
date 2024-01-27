const cacheName = 'pronostat-cache-v1';
const cacheAssets = [
    '/',
    '/phone.php',
    '/style-phone.css',
    '/script.js',
    '/icon.png',
    '/img',
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(cacheName)
            .then(cache => {
                return cache.addAll(cacheAssets);
            })
    );
});

self.addEventListener('fetch', event => {
    event.respondWith(
        fetch(event.request)
            .then(response => {
                const clonedResponse = response.clone();
                caches.open(cacheName)
                    .then(cache => {
                        cache.put(event.request, clonedResponse);
                    });
                return response;
            })
            .catch(() => caches.match(event.request)
                .then(response => response)
            )
    );
});
