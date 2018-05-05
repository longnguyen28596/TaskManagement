$(document).ready( function () {
    $('.done').change(function(){
        if($(this).val() == 1) {
            $("#myModal").modal("show")
            $("#myModal").find('.stars').data("user_id", $(this).data('user_id'));
            $("#myModal").find('.stars').data("task_id", $(this).data('task_id'));
        } else {
            $.ajax({
                url: '/ratings/delete/',
                type: 'POST',
                data: {
                    id_task: $('.stars').data('task_id'),
                    user_id: $('.stars').data('user_id'),
            }
            }).done(function(ketqua) {
                $("#myModal").modal("hide")
            })
        }
    })
    $('.label-star').click(function(){
        $.ajax({
            url: '/ratings/add/',
            type: 'POST',
            data: {
                point: $(this).data('point'),
                id_task: $('.stars').data('task_id'),
                user_id: $('.stars').data('user_id'),
        }
        }).done(function(ketqua) {
            $("#myModal").modal("hide")
        })
    })
})