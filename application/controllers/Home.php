<?php
namespace Controller;

use Core\Controller;
use Core\View;

class Home extends Controller {
    function main() {
        $header = new View;
        $header->title = 'Meetplaces';
        $header->vars['title'] = 'Meetplaces';
        $header->css = 'main.css';
        $header->template = 'home.php';
        $header->display();
    }
}