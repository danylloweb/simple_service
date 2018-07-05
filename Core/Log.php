<?php


class Log
{
    
    /**
     * @param $errorMessage
     */
    public function errorLog($errorMessage)
    {
        $caminho = BASE_PATH . '/Log/simple-log_'.date('d-m-Y').".txt";
//        die($caminho);
        $fp      = fopen($caminho, "a");
        $errorMessage.= "\n";
        $escreve = fwrite($fp, $errorMessage);
        fclose($fp);
    }

}