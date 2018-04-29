<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thông tin chi tiết của nhân viên</h4>
      </div>
      <hr>
      <div class="modal-body" id="conten-modal" style="padding-top: 0">
      </div>
      <hr>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-close-modal" >Close</button>
      </div>

    </div>
  </div>
</div>

<script>
    $(document).ready( function () {
        $('.modal-user').hover(function(){
            $(this).css("cursor", "pointer")
        });
        // $('.dataTable').DataTable();
        $('.modal-user').click(function(){
                user_id = $(this).data('user_id')
                $.ajax({
            url: '/users/view/'+user_id,
            type: 'POST',
        }).done(function(data) {
            $('#conten-modal').children().remove()
            $('#conten-modal').append(data)
        })
        $("#myModal").modal("show")
        
        $('.btn-close-modal').click(function(){
            $("#myModal").modal("hide")
        })
    })
});
</script>