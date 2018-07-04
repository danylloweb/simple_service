<?php
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var mixed
     */
    private $request;
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->client  = new Client();
        $this->request = $this->getRequest();
    }

    /**
     * @return string
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