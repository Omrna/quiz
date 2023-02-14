$(document).ready(function () {
    // On click on a page
    $(document).on("click", ".pagination a", function (event) {
        event.preventDefault();
        var page = $(this).attr("href").split("page=")[1]; // Get the page number
        fetch_data(page); // Load data dynamically
    });

    function fetch_data(page) {
        $.ajax({
            url: "/answer_dynamic_loading?page=" + page,
            success: function (data) {
                $(".usercontent").html(data); // Show data in the 'usercontent' class
            },
        });
    }
});
