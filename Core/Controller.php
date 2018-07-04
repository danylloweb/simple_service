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
        if (isset($_POST)){
            return (object) $_POST;
        }else{
            unset($_GET['path']);
            return $_GET;
        }
    }

    /**
     * @param $data
     * @return string
     */
    public function response_json($data)
    {
        header('Content-Type: application/json');
        echo json_encode(['data'=>$data]);
    }
}

 ?>