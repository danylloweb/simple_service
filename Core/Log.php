<?php


class Log
{

    
    /**
     * @param $errorMessage
     */
    public function errorLog($errorMessage)
    {
        $caminho = 'simple-log_'.date('d-m-Y').".txt";
        $fp      = fopen($caminho, "a");
        $errorMessage.= "\n";
        $escreve = fwrite($fp, $errorMessage);
        fclose($fp);
    }

}