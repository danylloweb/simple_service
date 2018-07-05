<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    /**
     * @var PHPMailer
     */
    private $mail;

    /**
     * Mailer constructor.
     */
    public function __construct()
    {
        $this->mail     = new PHPMailer(true);
    }

    /**
     * @param array $data
     */
    public function sendMail($data)
    {
        try {

            //Variables
            $sender  = (object) [
                'name'  => 'Monitor de Erros',
                'email' => 'ozymandias.mangue3@gmail.com'
            ];
            $receipt = (object) [
                'name'  => 'Iago Neres',
                'email' => 'iagoneresb@gmail.com'
            ];

            $data->date = date('Y');

            //Template
            $template = file_get_contents(__DIR__ . '/email-notification.html');
            foreach($data as $key => $value)
            {
                $template = str_replace('{{ '.$key.' }}', $value, $template);
            }

            //Server settings
            $this->mail->isSMTP();                                              // Set mailer to use SMTP
            $this->mail->SMTPDebug  = 0;                                        // Enable verbose debug output
            $this->mail->Host       = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
            $this->mail->SMTPAuth   = true;                                     // Enable SMTP authentication
            $this->mail->Username   = $sender->email;                           // SMTP username
            $this->mail->Password   = 'g0th@nc!ty';                             // SMTP password
            $this->mail->SMTPSecure = 'tls';                                    // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port       = 587;                                      // TCP port to connect to
            $this->mail->CharSet    = 'UTF-8';

            //Recipients
            $this->mail->setFrom($sender->email, $sender->name);
            $this->mail->addAddress($receipt->email, $receipt->name);     // Add a recipient
            $this->mail->addReplyTo($sender->email, $sender->name);
//            $this->mail->addCC(isset($data['cc']));
//            $this->mail->addBCC(isset($data['bcc']));

            //Attachments
//            $this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//            $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = 'Ozymandias | Notificação de error ' . date('d-m-Y H:i:s');
            $this->mail->Body    = $template;
//            $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->send();
            echo 'Message has been sent';
            return false;
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
            return true;
        }
    }

    public function template()
    {

    }




}