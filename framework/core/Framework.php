<?php
namespace Core;

class Framework {
    private $application;
    private $configuration = array();
    private $constants = array();
    private $controller;

    public function run() {
        ob_start();
        
        $this->init();
        
        $url = $this->getConfig('url');
        
        if ($url) {
            $this->define('CSS_URL', $url . 'public/css/');
            $this->define('JS_URL', $url . 'public/js');
            $this->define('IMAGES_URL', $url . 'public/images');
            $this->define('UPLOADS_URL', $url . 'public/uploads');
        }
        
        $request = new Request($this);
        $router = new Router($this, $request);
        
        $controller = 'Controller\\' . $router->getController();
        $action = $router->getAction();
        $params = $router->getParams();
        
        $this->application = new Application($this);
        $this->controller = new $controller($this);
        $this->controller->$action($params);
        
        ob_end_flush();
    }
    
    private function init() {
        $this->define('ROOT_DIR', getcwd() . DS);
        
        $this->define('APP_DIR', ROOT_DIR . 'application' . DS);
        $this->define('CONTROLLERS_DIR', APP_DIR . 'controllers' . DS);
        $this->define('MODELS_DIR', APP_DIR . 'models' . DS);
        $this->define('VIEWS_DIR', APP_DIR . 'views' . DS);
        $this->define('CONFIG_DIR', APP_DIR . 'configuration' . DS);
        
        $this->define('DB_DIR', FW_DIR . 'database' . DS);
        $this->define('HELPERS_DIR', FW_DIR . 'helpers' . DS);
        $this->define('LIBRARIES_DIR', FW_DIR . 'libraries' . DS);
        
        $this->define('UPLOADS_DIR', 'public' . DS . 'uploads' . DS);
        
        $this->configuration = parse_ini_file(CONFIG_DIR . 'misc.ini.php');
        
        spl_autoload_register(function ($className) {
            $array = explode('\\', $className);
            
            if (strpos($className, 'Controller') === 0) {
                $path = CONTROLLERS_DIR . $array[1] . '.php';
            }
            
            if (strpos($className, 'Library') === 0) {
                $path = LIBRARIES_DIR . $array[1] . '.php';
            }
            
            if (strpos($className, 'Core') === 0) {
                $path = CORE_DIR . $array[1] . '.php';
            }
            
            require_once $path;
        });
    }
    
    public function define($constantName, $constant) {
        if (!defined($constantName)) {
            define($constantName, $constant);
        }
        $this->constants[$constantName] = $constant;
    }
    
    public function getConfig($config) {
        if (isset($this->configuration[$config])) {
            return $this->configuration[$config];
        } else {
            return false;
        }
    }
}