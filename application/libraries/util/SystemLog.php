<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SystemLog
 *
 * @author Administrator
 */
class SystemLog {
    public $Path;
    public $Enabled = TRUE;
    
    function __construct ($path) 
    {
        $this->Path = $path;
    }   
    
    public function Writelog($level, $msg)
    {
        try
        {
            if($this->Enabled == FALSE) { return TRUE; }
            
            $_date_fmt = 'Y-m-d H:i:s';
            $filepath = $this->Path;
            $message = '';

            if ( ! file_exists($filepath))
            {
                    $newfile = TRUE;
            }

            if ( ! $fp = @fopen($filepath, 'ab'))
            {
                return FALSE;
            }

            // Instantiating DateTime with microseconds appended to initial date is needed for proper support of this format
            if (strpos($_date_fmt, 'u') !== FALSE)
            {
                    $microtime_full = microtime(TRUE);
                    $microtime_short = sprintf("%06d", ($microtime_full - floor($microtime_full)) * 1000000);
                    $date = new DateTime(date('Y-m-d H:i:s.'.$microtime_short, $microtime_full));
                    $date = $date->format($_date_fmt);
            }
            else
            {
                    $date = date($_date_fmt);
            }

            $message .= $level.' - '.$date.' --> '.$msg."\n";

            flock($fp, LOCK_EX);

            for ($written = 0, $length = strlen($message); $written < $length; $written += $result)
            {
                    if (($result = fwrite($fp, substr($message, $written))) === FALSE)
                    {
                            break;
                    }
            }

            flock($fp, LOCK_UN);
            fclose($fp);

            if (isset($newfile) && $newfile === TRUE)
            {
                    chmod($filepath, 0644);
            }
            return TRUE;
        }
        catch (Exception $e)
        {
            return FALSE;
        }
    }
}
