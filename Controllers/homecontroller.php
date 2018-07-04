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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index()
    {
        $options = [
            'headers' => [
                'postman-token' => '5c9b3854-7ada-20a0-fcb6-3e5826bbd757',
                'cache-control' => 'no-cache',
                'accept-language' => 'pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
                'accept-encoding' => 'gzip, deflate, br',
                'referer' => 'https://www.psvturismo.com.br/',
                'user-agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36',
                'origin' => 'https://www.psvturismo.com.br',
                'accept' => 'application/json, text/plain, */*'
            ],
            'form_params' => [],
        ];
        try {
            $response = $this->client->request('GET', 'http://apigateway.dev/psv/airports?limit=99999', $options);

         return $this->response_json($response->getBody());

        }catch (\GuzzleHttp\Exception\ClientException $e){
            echo $e->getMessage();
        }catch (Exception $exception){
            echo $exception->getMessage();
        }

    }


}