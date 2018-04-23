// xử lý nút coppy
if($('.js-btn-copy').length >0 ) {
    $('.js-btn-copy').click(function(){
        var copyText = document.getElementById("title_task");
        copyText.select();
        document.execCommand("Copy");
    })
}

// horver thì show ra ảnh
$('.show_image_hover').hover(function() {
    $('.preview_image').remove()
    $('#preview').append( '<img class="preview_image" style="width:100%; height: 100%"  src="'+$(this).data('url_image')+'">')
    $('#preview').css('display', 'block')
},function(){
    $('#preview').css('display', 'none')
})

if ($('.comment').length > 0 ) {

    function handle_reply(a) {
        comment_parent_id = $(a).data('comment_id');
        $('.comment_child').find('#formCommentChildAdd').remove()
        $('.reply_comment').find('#formCommentChildAdd').remove()
        $('#'+comment_parent_id).find('.reply_comment').append('<form method="post" action="/Comments/add/'+$(a).data("task_id")+'" id="formCommentChildAdd"><textarea id="content_comment_child" name="content_comment"></textarea><input type="hidden" name="comment_parent" value="'+comment_parent_id+'"><button data-task_id = '+$(a).data("task_id")+' data-comment_parent="'+comment_parent_id+'"  id="submit_comment_child" class="btn btn-primary pull-right submit_comment_child">Bình luận</button></form>');
        CKEDITOR.replace('content_comment_child')
    }

    function handle_edit(a) {
        comment_parent_id = $(a).data('comment_parent_id');
        $('.comment_child').find('#formCommentChildAdd').remove()
        $('.reply_comment').find('#formCommentChildAdd').remove()
        if ($(a).data('is_parent') == 0) {
            $('#'+comment_parent_id).find('.comment_child').append('<form method="post" action="/Comments/edit/'+$(a).data('comment_child_id')+'" id="formCommentChildAdd"><textarea id="content_comment_child" name="content_comment">'+$(a).data("content_comment")+'</textarea><input type="hidden" name="comment_parent" value="'+comment_parent_id+'"><button data-comment_parent="'+comment_parent_id+'"  id="submit_comment_child" class="btn btn-primary pull-right submit_comment_child">Cập nhập</button></form>');
        } else {
            $('#'+comment_parent_id).find('.reply_comment').append('<form method="post" action="/Comments/edit/'+$(a).data('comment_id')+'" id="formCommentChildAdd"><textarea id="content_comment_child" name="content_comment">'+$(a).data("content_comment")+'</textarea><input type="hidden" name="comment_parent" value="'+comment_parent_id+'"><button data-comment_parent="'+comment_parent_id+'"  id="submit_comment_child" class="btn btn-primary pull-right submit_comment_child">Cập nhập</button></form>');
        }
        CKEDITOR.replace('content_comment_child')
    }

    function delete_comment(a) {
        if(confirm("Bạn có chắc sẽ xoá bình luận này ?")) {
            commnet_id = $(a).data('comment_id')
            $.ajax({
                url: '/Comments/delete/'+ commnet_id,
                type: 'POST',
            }).done(function(newcomment){
                $(document).find('#'+commnet_id).fadeOut('3000')            
                if ($(document).find('.'+commnet_id).length > 0) {
                    $(document).find('.'+commnet_id).fadeOut('3000')
                }
            })
        }
    }
}