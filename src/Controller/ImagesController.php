<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class ImagesController extends AppController
{
    public function delete($id) {
        $image = $this->Images->get($id);
        if ($this->Images->delete($image)) {
            echo $this->AppHelper->successMessage('Sửa trạng thái thành công');die();
        } 
    }
}
?>