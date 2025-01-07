jQuery( document ).ready(function($) {
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
                    response(data.data);
                },
            });
        },
        minLength: 2,
        select: function (event, ui) {
            // Fill the visible input with the term name
            $("#division-autocomplete").val(ui.item.label);

            // Fill the hidden input with the term slug
            $("#division-slug").val(ui.item.id);

            // Prevent the default behavior (e.g., form submission)
            return false;
        },
    });
});