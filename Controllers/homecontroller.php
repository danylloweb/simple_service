<?php

class HomeController extends Controller
{
    /**
     * @var mixed
     */
    private $request;
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->request = $this->getRequest();
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index()
    {
      try{
         return $this->response_json($this->getRequest());

      }catch (Exception $exception){
            echo $exception->getMessage();
        }

    }


}