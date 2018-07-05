<?php

/**
 * Class Controller
 */
class Controller {
    /**
     * @return mixed
     */
	public function getRequest()
    {
        if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
            $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
            if(strcasecmp($contentType, 'application/json') == 0) {
                $_POST = json_decode(trim(file_get_contents("php://input")));
            }
            return $_POST;
        }
        else{
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
        echo json_encode(['data' => $data]);
    }
}

 ?>