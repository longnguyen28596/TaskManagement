$('.status').change(function(){
    id_task = $(this).data('task_id')
    $.ajax({
        url: '/tasks/edit_ajax/'+id_task,
        type: 'POST',
        data: {
            status: $(this).val()
        }
    }).done(function(ketqua) {
        $('#message').hide().html(ketqua).fadeIn(2000).fadeOut(5000);
    })
})
