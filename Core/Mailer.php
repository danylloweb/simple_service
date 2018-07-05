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
     * @param $data
     * @return bool
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
            $this->mail->isSMTP();                                            
            $this->mail->SMTPDebug  = 0;                                      
            $this->mail->Host       = 'smtp.gmail.com';                        
            $this->mail->SMTPAuth   = true;                                     
            $this->mail->Username   = $sender->email;                           
            $this->mail->Password   = 'g0th@nc!ty';                            
            $this->mail->SMTPSecure = 'tls';                                   
            $this->mail->Port       = 587;                               
            $this->mail->CharSet    = 'UTF-8';

            //Recipients
            $this->mail->setFrom($sender->email, $sender->name);
            $this->mail->addAddress($receipt->email, $receipt->name);     
            $this->mail->addReplyTo($sender->email, $sender->name);
//          $this->mail->addCC(isset($data['cc']));
//          $this->mail->addBCC(isset($data['bcc']));
//          $this->mail->addAttachment('/var/tmp/file.tar.gz');         
//          $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');   
            //Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = 'Ozymandias | Notificação de error ' . date('d-m-Y H:i:s');
            $this->mail->Body    = $template;
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