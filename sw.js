// StayTheWay — Service Worker Self-Destruct
// This replaces the old NotDrWise service worker.
// It clears all old caches and unregisters itself so the site loads fresh.

self.addEventListener('install', () => {
  self.skipWaiting();
});

self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(keys =>
      Promise.all(keys.map(k => caches.delete(k)))
    ).then(() => self.clients.claim())
     .then(() => self.registration.unregister())
     .then(() => {
       return self.clients.matchAll().then(clients => {
         clients.forEach(client => client.navigate(client.url));
       });
     })
  );
});
