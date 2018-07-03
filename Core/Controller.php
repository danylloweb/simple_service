<?php

/**
 * Class Controller
 */
class Controller{
    /**
     * @return mixed
     */
	public function getRequest()
    {
        if (isset($_GET)){
            unset($_GET['path']);
           return $_GET;
        }
        else{
            return (object)$_POST;
        }
    }

    /**
     * @param $data
     * @return string
     */
    public function response_json($data)
    {
        header('Content-Type: application/json');
        echo $data;
    }
}

 ?>