<?php


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
        $res = $this->mail->sendMail($this->request);
        $this->response_json([
            'error' => $res
        ]);
    }

}