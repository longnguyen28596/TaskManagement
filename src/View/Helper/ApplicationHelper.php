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
        return strftime('%H:%M %d/%m/%Y',strtotime($datetime));
    }

    public function fullDate($datetime) {
        return strftime('%d/%m/%Y',strtotime($datetime));
    }
    public function ratingStar($user_id, $point, $count) {
        $rating = round($point/$count);
        return '<div class="awesomeRating-'.$user_id.'"></div>
        <script>
            $(".awesomeRating-'.$user_id.'").awesomeRating({
                readonly            : true,
                valueInitial        : '.$rating.',
            });
        </script>';
    }
}
?>