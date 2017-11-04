<?php
namespace Core;

class Controller {
    private $fwInstance;
    
    public function __construct(Framework $fwInstance) {
        $this->fwInstance = $fwInstance;
    }
}
