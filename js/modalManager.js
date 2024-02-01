export default function modalManager() {
    $(document).ready(function() {
        $(document).on('click', 'li', function() {
            let id = $(this).attr("id").split("_")[1];

            getBookDetails(id)

            let modal = $("#modal");

            if(modal.hasClass('open')) {
                modal.removeClass('open');
            } else {
                modal.addClass('open');
            }
        });
    });
}

function getBookDetails(id) {
    $.ajax({
        url: "/book/get-details/" + id,
        type: "GET",
        success: function(data) {
            let modal = $("#modal");
            modal.html(data);

            $("#close").click(function() {
                let modal = $("#modal");
                modal.removeClass('open');
            });


            $(".trash").click(function(){
                let id = $(this).attr("id").split("_")[1];
                deleteBook(id);
            });
        },
        error: function(error) {
            console.log(error);
        }
    })
}

function deleteBook(id) {
    if (confirm("Voulez vous supprimer ce livre ?")) {
        $.ajax({
            url: "/book/delete/" + id,
            type: "DELETE",
            success: function(data) {
                let modal = $("#modal");
                modal.removeClass('open');
                let li = $("#li_" + id);
                li.remove();
            },
            error: function(error) {
                console.log(error);
            }
        })
    }
}