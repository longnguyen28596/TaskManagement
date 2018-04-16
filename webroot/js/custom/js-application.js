jQuery(document).ready(function($) {
    // hàm xử lý  table row link
    if ($('.jumb-link-row-table').length > 0) {
        $('.jumb-link-row-table').css('cursor', 'pointer');
        $('.jumb-link-row-table').click(function() {
            window.location = $(this).data("href");
        });
    }
});