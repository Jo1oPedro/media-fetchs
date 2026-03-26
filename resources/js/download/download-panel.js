import $ from 'jquery';

$(function () {
    $("#download-form button").on("click", function (e) {
        e.preventDefault();

        let url = $("#download-form input[type='url']").val();

        if(!url || !url.startsWith("http")) {
            alert("Por favor, insira uma URL válida.");
            return;
        }

        const csrfToken = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "/api/download/media",
            method: "POST",
            headers: {
                'X-XSRF-TOKEN': csrfToken
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
                console.error(xhr.responseText);
                alert("Erro ao salvar a URL.");
            }
        });
    });
});
