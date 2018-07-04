<?php
use GuzzleHttp\Client;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class NotificationController extends Controller
{
    /**
     * @var Client
     */
    private $mail;
    /**
     * @var mixed
     */
    private $request;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->mail     = new PHPMailer(true);
        $this->request  = $this->getRequest();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendMail()
    {
        try {
            global $config;

            $email = (string) $this->request->email;

            //Server settings
            $this->mail->isSMTP();                                      // Set mailer to use SMTP
            $this->mail->SMTPDebug  = 0;                                 // Enable verbose debug output
            $this->mail->Host       = 'smtp.gmail.com';                 // Specify main and backup SMTP servers
            $this->mail->SMTPAuth   = true;                             // Enable SMTP authentication
            $this->mail->Username   = $config['email_send'];                 // SMTP username
            $this->mail->Password   = $config['password'];              // SMTP password
            $this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port       = 587;                              // TCP port to connect to
            $this->mail->charSet    = "UTF-8";

            //Recipients
            $this->mail->setFrom($config['email_send'],  utf8_decode('Monitor de Notificações'));
            $this->mail->addAddress($config['email_receive'], 'Iago Neres');      // Add a recipient
            $this->mail->addReplyTo($config['email_send'], utf8_decode('Monitor de Notificações'));

            //Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = utf8_decode('Teste de notificação');
            $this->mail->Body    = utf8_decode(
                "<ul style=\"padding: 0; margin: 0; list-style-type: disc;\">
                    <li style=\"margin:0 0 10px 20px;\" class=\"list-item-first\">Trecho: " . $this->request->origin . "</li>
                    <li style=\"margin:0 0 10px 20px;\">user_id: " . $this->request->user_id . "</li>
                    <li style=\"margin:0 0 10px 20px;\">user_name: " . $this->request->user_name ."</li>
                    <li style=\"margin:0 0 10px 20px;\">user_email: " . $this->request->user_email . "</li>
                    <li style=\"margin:0 0 10px 20px;\">agency: " . $this->request->agency . "</li>
                    <li style=\"margin:0 0 10px 20px;\">Mensagem: " . $this->request->message . " </li>
                    <li style=\"margin: 0 0 0 20px;\" class=\"list-item-last\">Erro: " . $this->request->error . "</li>
                </ul>"
            );
            $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->send();
            echo 'Menssagem enviada';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
        }
    }


}