$(document).ready( function () {
    $('#done').change(function(){
        if($(this).val() == 1) {
            $("#myModal").modal("show")
        } else {
            alert($('#myModal').data('task_id'))
            alert($('#myModal').data('user_id'))
            $.ajax({
                url: '/ratings/delete/',
                type: 'POST',
                data: {
                    id_task: $('#myModal').data('task_id'),
                    user_id: $('#myModal').data('user_id'),
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
                id_task: $('#myModal').data('task_id'),
                user_id: $('#myModal').data('user_id'),
        }
        }).done(function(ketqua) {
            $("#myModal").modal("hide")
        })
    })
})