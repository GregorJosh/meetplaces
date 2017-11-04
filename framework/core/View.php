<?php
namespace Core;

class View {
    public $css;
    public $vars = array();
    public $template;
    public $title;
    
    public function display() {
        extract($this->vars);
        
        $content = '';
        $content .= '<!doctype html>';
        $content .= '<html>';
        $content .= '<head>';
        $content .= '<title>' . $this->title . '</title>';
        $content .= '<meta charset="UTF-8">';
        $content .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $content .= '<link rel="stylesheet" href="' . CSS_URL . $this->css . '">';
        $content .= '</head>';
        $content .= '<body>';
        
        if (is_file(VIEWS_DIR . $this->template)) { 
            ob_start();
            include(VIEWS_DIR . $this->template);
            
            $content .= ob_get_clean();
        }
        
        $content .= '</body>';
        $content .= '</html>';
        
        echo $content;
    }
}
