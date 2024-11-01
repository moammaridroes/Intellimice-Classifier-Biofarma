importScripts('https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging-compat.js');

// Initialize Firebase in the service worker
const firebaseConfig = {
    apiKey: "AIzaSyAFaSwxkf6I62_XSYisEAqyMhmwJpiFqYA",
    authDomain: "intellmice-biofarma.firebaseapp.com",
    projectId: "intellmice-biofarma",
    storageBucket: "intellmice-biofarma.appspot.com",
    messagingSenderId: "1052247254183",
    appId: "1:1052247254183:web:278e597cfa5d28eb8e6782",
    measurementId: "G-XEK3SLVW8Z"
};

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

// Handle background notifications
messaging.onBackgroundMessage(function(payload) {
    console.log("Received background message ", payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body
    };

    return self.registration.showNotification(notificationTitle, notificationOptions);
});
