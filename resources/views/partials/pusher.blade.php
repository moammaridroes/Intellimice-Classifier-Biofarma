<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    // Inisialisasi Pusher
    // Inisialisasi Pusher
    const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
    cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
    encrypted: true,
    });

    // Subscribe ke channel
    const channel = pusher.subscribe('orders');

    // CSS untuk notifikasi
    const style = document.createElement('style');
    style.textContent = `
        .notification-container {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #28a745;
            color: white;
            padding: 15px 25px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 9000;
            opacity: 0;
            transform: translateY(-20px);
            transition: all 0.3s ease-in-out;
            max-width: 350px;
            word-wrap: break-word;
        }

        .notification-container.show {
            opacity: 1;
            transform: translateY(0);
        }

        .notification-container.hide {
            opacity: 0;
            transform: translateY(-20px);
        }
    `;
    document.head.appendChild(style);

    // Dengarkan event 'order.created'
    channel.bind('order.created', function(data) {
        // Buat container notifikasi
        const notificationContainer = document.createElement('div');
        notificationContainer.classList.add('notification-container');
        notificationContainer.textContent = `New orders have been received`;
        document.body.appendChild(notificationContainer);

        // Animasi munculnya notifikasi
        setTimeout(() => {
            notificationContainer.classList.add('show');
        }, 100);

        // Hilangkan notifikasi setelah 5 detik
        setTimeout(() => {
            notificationContainer.classList.add('hide');
            setTimeout(() => {
                notificationContainer.remove();
            }, 300);
        }, 5000);

        // Update badge notifikasi
        const badge = document.getElementById('notificationBadge');
        if (badge) {
            // Ambil nilai badge saat ini dan ubah ke angka (0 jika kosong)
            let currentCount = parseInt(badge.textContent) || 0;

            // Tambahkan 1 ke nilai saat ini
            currentCount += 1;
            badge.textContent = currentCount;

            // Tampilkan badge jika sebelumnya tidak terlihat
            badge.style.display = 'inline-block';
        }
    });

    // Listener untuk DataTables
// const mencitChannel = pusher.subscribe('mencit-data');
// mencitChannel.bind('data.updated', function(data) {
//     const table = $('.yajra-datatable').DataTable();
//     table.row.add({
//         DT_RowIndex: data.id,
//         created_at: data.created_at,
//         berat: data.berat,
//         gender: data.gender,
//         health_status: data.health_status === 'Healthy'
//             ? `<span class="badge bg-success">Healthy</span>`
//             : `<span class="badge bg-danger">Sick</span>`
//     }).draw(false);
// });
</script>
