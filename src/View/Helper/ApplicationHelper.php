<?php
namespace App\View\Helper;

use Cake\View\Helper;

class ApplicationHelper extends Helper
{
    public function successMessage($content)
    {
        return '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
        </button>
        <span>'.$content.'</span>
        </div>';
    }

    public function fullDateTime($datetime) {
        return strftime('%d/%m/%Y %H:%M',strtotime($datetime));
    }

    public function fullDate($datetime) {
        return strftime('%d/%m/%Y',strtotime($datetime));
    }
}
?>