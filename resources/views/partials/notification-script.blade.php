{{-- GA KEPAKE TP JGN DIHAPUS TP GTAU BUAT AP --}}
<script>
    function fetchUnreadNotifications() {
        fetch('/admin/notification-count')
            .then(response => response.json())
            .then(data => {
                const notificationBadge = document.querySelector('.badge-danger');
                if (data.unreadNotificationsCount > 0) {
                    if (!notificationBadge) {
                        const badge = document.createElement('span');
                        badge.classList.add('badge', 'badge-danger');
                        badge.innerText = data.unreadNotificationsCount;
                        document.querySelector('.nav-link[href="{{ route('admin.notification') }}"]').appendChild(badge);
                    } else {
                        notificationBadge.innerText = data.unreadNotificationsCount;
                    }
                } else if (notificationBadge) {
                    notificationBadge.remove();
                }
            })
            .catch(error => console.error('Error fetching notifications:', error));
    }

    // Polling setiap 10 detik
    setInterval(fetchUnreadNotifications, 10000);

    // Panggil pertama kali saat halaman di-load
    fetchUnreadNotifications();
</script>
