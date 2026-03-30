import $ from 'jquery';

const platformIcons = {
    twitter: {
        svg: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15"/></svg>',
        color: 'text-blue-400',
    },
    x: {
        svg: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/></svg>',
        color: 'text-gray-800',
    },
    facebook: {
        svg: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/></svg>',
        color: 'text-blue-600',
    },
    instagram: {
        svg: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/></svg>',
        color: 'text-pink-500',
    },
    tiktok: {
        svg: '<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>',
        color: 'text-gray-800',
    },
    youtube: {
        svg: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/></svg>',
        color: 'text-red-500',
    },
};

function showToast(message, type = 'alert-success') {
    const $toast = $(`
        <div class="toast toast-top toast-end z-50 cursor-pointer">
            <div class="alert ${type}">
                <span>${message}</span>
            </div>
        </div>
    `);

    $('body').append($toast);
    $toast.on('click', () => $toast.remove());
    setTimeout(() => $toast.remove(), 3000);
}

function getPlatformIcon(slug) {
    const icon = platformIcons[slug];
    if (icon) {
        return `<span class="${icon.color} h-5 w-5">${icon.svg}</span>`;
    }
    return `<span class="text-white text-xs font-bold uppercase">${(slug || 'unknown').substring(0, 3)}</span>`;
}

function getStatusClasses(status) {
    switch (status) {
        case 'success': return 'bg-green-100 text-green-800';
        case 'failed': return 'bg-red-100 text-red-800';
        default: return 'bg-yellow-100 text-yellow-800';
    }
}

function listenForMediaUpdate(mediaId, $card) {
    window.Echo.private(`media.${mediaId}`)
        .listen('MediaStatusUpdated', (e) => {
            const $badge = $card.find('.rounded-full');
            $badge
                .removeClass('bg-green-100 text-green-800 bg-red-100 text-red-800 bg-yellow-100 text-yellow-800')
                .addClass(getStatusClasses(e.media.status))
                .text(e.media.status.charAt(0).toUpperCase() + e.media.status.slice(1));

            if (e.media.s3_url) {
                $card.find('a[target="_blank"]').attr('href', e.media.s3_url);
            }

            if(e.media.status !== "success") {
                showToast(`Download ${e.media.platform} falhou!`, 'alert-error');
                return;
            }
            showToast(`Download ${e.media.platform} concluido com sucesso!`);
        });
}

function listenForMediaUpdates() {
    $('[data-media-id]').each(function () {
        const mediaId = $(this).data('media-id');
        listenForMediaUpdate(mediaId, $(this));
    });
}

function createMediaCard(media) {
    const platform = media.platform || 'unknown';
    const status = media.status.charAt(0).toUpperCase() + media.status.slice(1);
    const downloadUrl = media.original_url || '#';

    const $card = $(`
        <div class="flex flex-col md:flex-row items-center gap-4 p-4 bg-gray-50 rounded-lg" data-media-id="${media.id}">
            <div class="flex gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-purple-500 rounded-lg flex items-center justify-center">
                    ${getPlatformIcon(platform)}
                </div>
                <div class="flex-1">
                    <p class="font-medium text-gray-900">
                        ${platform} ${media.format}
                    </p>
                    <p class="text-sm text-gray-500">
                        Downloaded just now
                    </p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <span class="px-2 py-1 ${getStatusClasses(media.status)} text-xs rounded-full">
                    ${status}
                </span>
                <a
                    href="${downloadUrl}"
                    target="_blank"
                    class="inline-flex p-2 text-gray-400 hover:text-gray-600 cursor-pointer"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V3"/>
                    </svg>
                </a>
            </div>
        </div>
    `);

    $('#recent-downloads .space-y-4').prepend($card);

    listenForMediaUpdate(media.id, $card);
}

$(function () {
    listenForMediaUpdates();

    $("#download-form button").on("click", function (e) {
        e.preventDefault();

        let url = $("#download-form input[type='url']").val();

        if(!url || !url.startsWith("http")) {
            showToast("Por favor, insira uma URL valida.", 'alert-error')
            return;
        }

        const csrfToken = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "/api/media",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                url: url,
                _token: csrfToken
            },
            xhrFields: {
                withCredentials: true
            },
            success: function (response) {
                $("#download-form input[type='url']").val('');

                if (response.media) {
                    createMediaCard(response.media);
                }

                showToast(response.message);
            },
            error: function (xhr) {
                const response = JSON.parse(xhr.responseText);
                showToast(response.message, 'alert-error');
            }
        });
    });
});
