<?php
use Core\Framework;

define('DS', DIRECTORY_SEPARATOR);
define('FW_NAME', 'Framework');
define('FW_DIR', 'framework' . DS);
define('CORE_DIR', FW_DIR . 'core' . DS);

require_once CORE_DIR . FW_NAME . '.php';

$fw = new Framework();
$fw->define('DS', DS);
$fw->define('FW_NAME', FW_NAME);
$fw->define('FW_DIR', FW_DIR);
$fw->define('CORE_DIR', CORE_DIR);
$fw->run();
