<?php

require_once 'Core/Controller.php';

/**
 * Class Core
 */
class Core
{
    /**
     * @var string
     */
 protected $currentController;
    /**
     * @var string
     */
 protected $currentAction;

    /**
     * Core constructor.
     */
    public function __construct()
    {
        $this->currentController = 'notificationcontroller';
        $this->currentAction     = 'sendMail';
    }

    /**
     * Handler
     */
    public function handler()
    {
        call_user_func_array([new $this->currentController(require 'config.php'),$this->currentAction], []);
    }
}

?>