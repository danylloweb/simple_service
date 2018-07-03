<?php
require_once 'Core/Controller.php';

/**
 * Class Core
 */
class Core
{

 protected $currentController;

 protected $currentAcition;

    /**
     * Core constructor.
     */
    public function __construct()
    {
        $this->currentController = 'homecontroller';
        $this->currentAcition    = 'index';

    }
    /**
     *
     */
    public function handler()
    {
        call_user_func_array([new $this->currentController(),$this->currentAcition], []);
    }
}

?>