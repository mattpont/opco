jQuery(document).ready(function ($) {
    console.log('division-autocomplete.js is running');
    $("#division-autocomplete").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: autocomplete_data.ajax_url,
                method: "GET",
                dataType: "json",
                data: {
                    action: "fetch_division_terms",
                    term: request.term,
                },
                success: function (data) {
                    if (data.success) {
                        response(data.data);
                    } else {
                        response([]);
                    }
                },
                error: function () {
                    response([]);
                },
            });
        },
        minLength: 2, // Minimum characters before triggering search
        select: function (event, ui) {
            console.log("Selected term:", ui.item);
        },
    });
});