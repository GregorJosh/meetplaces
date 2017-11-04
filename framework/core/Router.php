<?php
namespace Core;

class Router {
    private $instance;
    private $controller;
    private $action;
    private $params;
    
    public function __construct(Framework $instance, Request $request) {
        $this->instance = $instance;
        
        $rootDir = $instance->getConfig('root_dir');
        
        if ($rootDir) {
            $rootDirArray = explode('/', $rootDir);
        }
        
        $pathArray = array_filter(explode('/', $request->getPath()), function($value) {
            return $value !== '';
        });
        
        $array = array_diff($pathArray, $rootDirArray);
        
        if (!empty($array)) {
            $this->controller = ucfirst($array[0]);
            array_shift($array);
        } else {
            $this->controller = ucfirst($instance->getConfig('start_page'));
        }
        
        if (!empty($array)) {
            $this->action = lcfirst($array[0]);
            array_shift($array);
        } else {
            $this->action = 'main';
        }
        
        if (!empty($array)) {
            $this->params = $array;
        }
    }
    
    public function getAction() {
        return $this->action;
    }
    
    public function getController() {
        return $this->controller;
    }
    
    public function getParams() {
        return $this->params;
    }
}
