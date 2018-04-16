<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

class AppComponent extends Component
{
    // Execute any other additional setup for your component.
    public function initialize(array $config)
    {
    }

    public function get_file_extension($file_name) {
        return substr(strrchr($file_name,'.'),1);
    }

    // public upload file($_FILES) {
    //     $_FILES['files']
    // }
}
?>