<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Load extends CI_Controller {

    public function load_css($filename)
    {
        $text = file_get_contents(VIEWPATH."css/".$filename);
        echo $text;
    }
}
