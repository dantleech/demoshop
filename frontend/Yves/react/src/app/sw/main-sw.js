
'use strict';

var PUBLIC_PATH = '/assets/react';
var CACHE_VERSION = 1;
var CURRENT_CACHES = {
    prefetch: 'prefetch-cache-v' + CACHE_VERSION
};

self.addEventListener('install', function (event) {
    var now = Date.now();

    var urlsToPrefetch = [
        '/',
        '/?fetch=1',
        '/offline?fetch=1',
        PUBLIC_PATH + '/css/app.css',
        PUBLIC_PATH + '/fonts/fontawesome-webfont.eot?v=4.7.0',
        PUBLIC_PATH + '/fonts/fontawesome-webfont.svg?v=4.7.0',
        PUBLIC_PATH + '/fonts/fontawesome-webfont.ttf?v=4.7.0',
        PUBLIC_PATH + '/fonts/fontawesome-webfont.woff?v=4.7.0',
        PUBLIC_PATH + '/fonts/fontawesome-webfont.woff2?v=4.7.0',
        PUBLIC_PATH + '/fonts/FontAwesome.otf?v=4.7.0',
        PUBLIC_PATH + '/js/app.js',
        PUBLIC_PATH + '/js/manifest.js',
        PUBLIC_PATH + '/js/vendor.js',
        PUBLIC_PATH + '/manifest.json',
        '//fonts.googleapis.com/css?family=Ubuntu+Mono:400,400i,700,700i'
    ];

    console.log('Handling install event. Resources to prefetch:', urlsToPrefetch);

    event.waitUntil(
        caches.open(CURRENT_CACHES.prefetch).then(function (cache) {
            var cachePromises = urlsToPrefetch.map(function (urlToPrefetch) {
                var url = new URL(urlToPrefetch, location.href);
                url.search += (url.search ? '&' : '?') + 'cache-bust=' + now;

                var request = new Request(url, { mode: 'no-cors' });
                return fetch(request).then(function (response) {
                    if (response.status >= 400) {
                        throw new Error('request for ' + urlToPrefetch +
                            ' failed with status ' + response.statusText);
                    }

                    return cache.put(urlToPrefetch, response);
                }).catch(function (error) {
                    console.error('Not caching ' + urlToPrefetch + ' due to ' + error);
                });
            });

            return Promise.all(cachePromises).then(function () {
                console.log('Pre-fetching complete.');
            });
        }).catch(function (error) {
            console.error('Pre-fetching failed:', error);
        })
    );
});

self.addEventListener('activate', function (event) {
    var expectedCacheNames = Object.keys(CURRENT_CACHES).map(function (key) {
        return CURRENT_CACHES[key];
    });

    self.clients.claim();

    event.waitUntil(
        caches.keys().then(function (cacheNames) {
            return Promise.all(
                cacheNames.map(function (cacheName) {
                    if (expectedCacheNames.indexOf(cacheName) === -1) {
                        console.log('Deleting out of date cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

self.addEventListener('fetch', function (event) {
    let originalResponse;
    console.log('Handling fetch event for', event.request.url);

    event.respondWith(
        fetch(event.request).then(function (response) {
            originalResponse = response;

            if (!response) {
                throw Error('offline');
            }

            if (response.status > 404) {
                throw Error('status error: ' + response.status);
            }

            console.log('fetched:', event.request.url);

            return caches.open(CURRENT_CACHES.prefetch).then(function (cache) {
                console.log('Response from network added to cache:', response);
                cache.put(event.request.url, response.clone());
                return response;
                
            }).catch(function (error) {
                console.log('Response from network:', response);
                return response;
            });
            
        }).catch(function (error) {
            console.error('Network failed:', error);
            console.log('Fallback to cache...');

            return caches.match(event.request).then(function (response) {
                console.log('Found response in cache:', response);

                if (response) { 
                    return response;
                }
                
                return originalResponse;
            });
        })
    );
});
