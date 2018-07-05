<?php

/**
 * Class NotificationController
 */
class NotificationController extends Controller
{
    /**
     * @var Mailer
     */
    protected $mail;

    /**
     * @var mixed
     */
    private $request;

    /**
     * @var array
     */
    protected $config;

    /**
     * NotificationController constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->request  = $this->getRequest();
        $this->config   = $config;
        $this->mail     = new Mailer();
    }

    /**
     *
     */
    public function sendMail()
    {
        if($this->mail->sendMail($this->request)) {
            return $this->response_json([
                'error'   => false,
                'message' => 'email enviado!'
            ]);
        }else{
            return $this->response_json([
                'error'   => true,
                'message' => 'email não enviado!'
            ]);
        }
    }

}