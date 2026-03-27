import $ from 'jquery';

function listenForMediaUpdate(mediaId, $card) {
    window.Echo.private(`media.${mediaId}`)
        .listen('MediaStatusUpdated', (e) => {
            $card.find('.rounded-full').text(e.media.status.charAt(0).toUpperCase() + e.media.status.slice(1));

            if (e.media.s3_url) {
                $card.find('a[target="_blank"]').attr('href', e.media.s3_url);
            }
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
                    <span class="text-white text-xs font-bold uppercase">${platform.substring(0, 3)}</span>
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
                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
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
            alert("Por favor, insira uma URL valida.");
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
            },
            error: function (xhr) {
                const response = JSON.parse(xhr.responseText);
                alert(response.message);
            }
        });
    });
});
