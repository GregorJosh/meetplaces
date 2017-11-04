<?php
namespace Core;

class Application {
    private $fwInstance;
    public $name;
    
    public function __construct(Framework $fwInstance) {
        $this->fwInstance = $fwInstance;
        $this->name = $fwInstance->getConfig('name');
    }
}