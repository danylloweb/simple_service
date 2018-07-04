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
        $this->mail  = new PHPMailer(true);
        $this->request = $this->getRequest();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendMail()
    {
        try {
            return $this->request;
            //Server settings
            $this->mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $this->mail->isSMTP();                                      // Set mailer to use SMTP
            $this->mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
            $this->mail->Username = 'ozymandias.mangue3@gmail.com'; // SMTP username
            $this->mail->Password = 'g0th@nc!ty';                         // SMTP password
            $this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port = 587;                                    // TCP port to connect to
            $this->mail->charSet = "UTF-8";

            //Recipients
            $this->mail->setFrom('ozymandias.mangue3@gmail.com',  utf8_decode('Monitor de Notificações'));
            $this->mail->addAddress('iagoneresb@gmail.com', 'Iago Neres');      // Add a recipient
            $this->mail->addReplyTo('ozymandias.mangue3@gmail.com', 'Monitor de Notificações');
//            $this->mail->addCC('iagoneresb@gmail.com');
//            $this->mail->addBCC('bcc@example.com');

            //Attachments
//            $this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//            $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = utf8_decode('Teste de notificação');
            $this->mail->Body    = utf8_decode("This is the HTML message body <b>in bold!</b>");
            $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
        }
    }


}