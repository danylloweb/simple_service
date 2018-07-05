<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Class Mailer
 */
class Mailer extends Log
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
        $this->mail = new PHPMailer(true);
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
                'name'  => 'Danyllo',
                'email' => 'danylloferreira@mangue3.com'
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
            $this->mail->setFrom($sender->email, $sender->name);
            $this->mail->addAddress($receipt->email, $receipt->name);     
            $this->mail->addReplyTo($sender->email, $sender->name);
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = 'Ozymandias | Notificação de erro ' . date('d-m-Y H:i:s');
            $this->mail->Body    = $template;
            $this->mail->send();
            $this->errorLog("[".date('d-m-Y H:i:s')."] Email enviado");
            return true;
        } catch (Exception $e) {
            $this->errorLog($this->mail->ErrorInfo);
            return false;
        }
    }





}