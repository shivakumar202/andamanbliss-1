/* ===================================
   FORCE SERVICE WORKER VERSION UPDATE
=================================== */
const SW_VERSION = "7.0.1"; // 🔥 Change this whenever layout changes

self.addEventListener("install", (event) => {
    console.log("Service Worker Installed v" + SW_VERSION);
    self.skipWaiting(); // Force update immediately
});

self.addEventListener("activate", (event) => {
    console.log("Service Worker Activated v" + SW_VERSION);
    event.waitUntil(clients.claim()); // Apply new SW to all open tabs
});

/* ============================
   PUSH NOTIFICATION HANDLER
============================ */

self.addEventListener("push", (event) => {
    if (!event.data) return;

    const data = event.data.json();

    // 🔥 If payload version is old → ignore
    if (data.version && data.version !== SW_VERSION) {
        console.warn("OLD Notification Payload Ignored");
        return; 
    }

    const options = {
        body: data.body,
        icon: data.icon || "https://andamanbliss.com/images/logo.png",
        image: data.image || null,
        actions: data.actions || [],
        requireInteraction: data.requireInteraction ?? true,
        vibrate: data.vibrate || [200, 100, 200, 100, 200],
        data: {
            url: data.url || "/",
            id: data.tag || ("notif-" + Date.now())
        },
        tag: data.tag || ("notif-" + Date.now()),
        renotify: data.renotify ?? false,
        timestamp: data.timestamp || Date.now(),
    };

    event.waitUntil(
        self.registration.showNotification(data.title, options)
    );
});

/* ============================
   CLICK HANDLER
============================ */

self.addEventListener("notificationclick", (event) => {
    event.notification.close();

    const url = event.notification.data.url || "/";
    const action = event.action;

    if (action === "booknow") {
        event.waitUntil(clients.openWindow(url));
    } else {
        event.waitUntil(clients.openWindow(url));
    }
});

/* ============================
   CLOSE HANDLER
============================ */

self.addEventListener("notificationclose", (event) => {
    console.log("Notification closed:", event.notification.tag);
});
