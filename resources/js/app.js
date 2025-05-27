import './bootstrap';
import Swal from 'sweetalert2';
import Swiper from 'swiper';
import 'swiper/css';

Swiper.use([Autoplay]);

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,  // or process.env.MIX_PUSHER_APP_KEY if laravel-mix
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    authEndpoint: '/broadcasting/auth',  // default Laravel
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    },
});

// Ambil threadId dari meta tag
const threadId = document.querySelector('meta[name="thread-id"]').content;

// Subscribe private channel thread
window.Echo.private('thread.' + threadId)
    .listen('CommentPosted', (e) => {
        // Update UI komentar realtime
        const html = `
            <div class="comment">
                <strong>${e.user}</strong>:
                <p>${e.body}</p>
                <small>${e.created_at}</small>
            </div>
        `;
        document.getElementById('comments-list').insertAdjacentHTML('beforeend', html);
    });

// Kirim komentar via fetch
document.getElementById('comment-form').addEventListener('submit', function(e) {
    e.preventDefault();

    fetch('/chat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({
            thread_id: threadId,
            body: document.getElementById('comment-body').value,
        }),
    })
    .then(res => res.json())  // ambil data json dari response
    .then(data => {
        if (data.message) {
            // reset form
            this.reset();

            // tambahkan komentar baru ke list komentar secara manual (optional, karena realtime juga via Echo)
            const html = `
                <div class="comment">
                    <strong>${data.user}</strong>:
                    <p>${data.body}</p>
                    <small>${data.created_at}</small>
                </div>
            `;
            document.getElementById('comments-list').insertAdjacentHTML('beforeend', html);
        }
    })
    .catch(err => {
        console.error('Error posting comment:', err);
    });
});
