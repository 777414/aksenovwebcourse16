function getSomeGenre() {
    $.ajax(
        {
            url: 'api.php',
            type: 'post',
            data: {
                method_type: "getSomeGenre"
            },
            success: function (data) {
                $("#targetGenre").html(data);
            }
        }
    );
}
function getSomeMusic() {
    $.ajax(
        {
            url: 'api.php',
            type: 'post',
            data: {
                method_type: "getSomeMusic"
            },
            success: function (data) {
                $("#targetContent").html(data);

            }
        }
    );
}

function getGenreMusic() {
    $('#targetGenre').on('click', 'li', function () {
        $.ajax(
            {
                url: 'api.php',
                type: 'post',
                data: {
                    method_type: "getGenreMusic",
                    genre: $(this).html()
                },
                success: function (data) {
                    $("#targetContent").html(data);

                }
            }
        );

    });
}