<?php

class Display {
    private $header, $footer, $sidebar, $open_content;
    private $css, $js, $css_pattern, $js_pattern;
    private $ci;
    public function __construct(){
        $this->header = 'templates/header';
        $this->footer = 'templates/footer';
        $this->sidebar = 'templates/sidebar';
        $this->open_content = 'templates/open_wrapper';
        $this->css_pattern = '<link href="%s" rel="stylesheet" type="text/css">';
        $this->js_pattern  = ' <script type="text/javascript" src="%s"></script>';
        $this->ci =& get_instance();
    }
    public function run($site, $data){
        $css_files = $this->ci->config->item('css');
        if (isset($this->ci->config->item('css_')[$site])){
            $css_specific_files = $this->ci->config->item('css_')[$site];
            $css_files = array_merge($css_files, $css_specific_files);
        }
        $this->css = '';
        foreach ($css_files as $item){
            $this->css .= sprintf($this->css_pattern, base_url($item));
        }
        $js_files = $this->ci->config->item('js');
        if (isset($this->ci->config->item('js_')[$site])){
            $js_specific_files = $this->ci->config->item('js_')[$site];
            $js_files = array_merge($js_files, $js_specific_files);
        }
        $this->js = '';
        foreach ($js_files as $item){
            $this->js .= sprintf($this->js_pattern, base_url($item));
        }

        $title = $this->ci->config->item('title')[$site];
        if ($title == NULL){
            $title = $data["title"];
        }
        $h_data = [
            'title' => $title,
            'css' => $this->css
        ];

        // load header view
        $this->ci->load->view($this->header, $h_data);
        // load body view
        $this->ci->load->view('pages/'.$site, $data);
        // load footer view        
        $this->ci->load->view($this->footer, ['js' => $this->js]);

    }
}