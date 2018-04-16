<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="material-icons">close</i>
    </button>
    <?= $message ?>
</div>
<script>
    if ($('.message').length > 0 ) {
        $('.message').click(function(){
            this.classList.add('hidden')
        })
    }
</script>