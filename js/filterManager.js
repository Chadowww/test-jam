export default function filterManger() {
    $(document).ready(function() {
        $('.filter-button').click(function() {
            let $parent = $(this).closest('.filter');
            let open = $parent.find('.filter-body').hasClass('open');
            if(open) {
                $parent.css('padding', '0px')
                $parent.find('.filter-header > h2').removeClass('open');
                $parent.find('.filter-body').removeClass('open');
                $parent.find('.filter-footer').removeClass('open');
            } else {
                $parent.css('padding', '10px')
                $parent.find('.filter-header > h2').addClass('open');
                $parent.find('.filter-body').addClass('open');
                $parent.find('.filter-footer').addClass('open');
            }
        });

        $('form').on('submit', function(e) {
            e.preventDefault();

            let data = {
                authors: [],
                genders: []
            };
            $('input[name="authors[]"]:checked').each(function() {
                data["authors"].push($(this).val());
            });
            $('input[name="genders[]"]:checked').each(function() {
                data["genders"].push($(this).val());
            });
            $.ajax({
                url: '/',
                method: 'POST',
                data: data,
                success: function(response) {
                    let htmlResponse = $.parseHTML(response);
                    let newBookList = null;
                    $.each(htmlResponse, function (i, el) {
                        if (el.id && el.id === 'book-list') {
                            newBookList = el;
                            return false;
                        }
                    });
                    if(newBookList) {
                        $("#book-list").html($(newBookList).html());
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus, errorThrown);
                }
            });
        });
    });
}

