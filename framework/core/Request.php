<?php
namespace Core;

class Request {
    private $instance;
    private $method;
    private $path;
    
    function __construct(Framework $instance, $method = null, $path = null) {
        $this->instance = $instance;
        
        if ($method === null) {
            $this->method = $_SERVER['REQUEST_METHOD'];
        } else {
            $this->method = $method;
        }
        
        if ($path === null) {
            $this->path = $_SERVER['REQUEST_URI'];
        } else {
            $this->path = $path;
        }
    }
    
    function getMethod() {
        return $this->method;
    }
    
    function getPath() {
        return $this->path;
    }
}