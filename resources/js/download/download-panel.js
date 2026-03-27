import $ from 'jquery';

function listenForMediaUpdates() {
    $('[data-media-id]').each(function () {
        const mediaId = $(this).data('media-id');
        const $card = $(this);

        window.Echo.private(`media.${mediaId}`)
            .listen('MediaStatusUpdated', (e) => {
                $card.find('.rounded-full').text(e.media.status.charAt(0).toUpperCase() + e.media.status.slice(1));
            });
    });
}

$(function () {
    listenForMediaUpdates();

    $("#download-form button").on("click", function (e) {
        e.preventDefault();

        let url = $("#download-form input[type='url']").val();

        if(!url || !url.startsWith("http")) {
            alert("Por favor, insira uma URL válida.");
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
                console.log(response.message);
                alert("URL salva com sucesso!");
            },
            error: function (xhr) {
                const response = JSON.parse(xhr.responseText);
                alert(response.message);
            }
        });
    });
});
