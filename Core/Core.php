<?php
require_once 'Core/Controller.php';

/**
 * Class Core
 */
class Core
{

 protected $currentController;

 protected $currentAction;

    /**
     * Core constructor.
     */
    public function __construct()
    {
//        $this->currentController = 'homecontroller';
//        $this->currentAction    = 'index';
        $this->currentController = 'notificationcontroller';
        $this->currentAction    = 'sendMail';
    }
    /**
     *
     */
    public function handler()
    {
        call_user_func_array([new $this->currentController(),$this->currentAction], []);
    }
}

?>