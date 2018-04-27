jQuery(document).ready(function($) {
    // hàm xử lý  table row link
    if ($('.jumb-link-row-table').length > 0) {
        $('.jumb-link-row-table').css('cursor', 'pointer');
        $('.jumb-link-row-table').click(function() {
            window.location = $(this).data("href");
        });
    }
});
// xử lý hiển thị thông báo
if ($('.message').length > 0 ) {
    $('.message').children().fadeOut(5000)
    $('.message').click(function(){
        $(this).fadeOut(3000)
    })
}
