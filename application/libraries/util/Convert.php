<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Convert
 *
 * @author Administrator
 */
class Convert {
    public static function ToInt($value)
    {
        try {
            return (int)$value;
        } catch (Exception $ex) {
            return 0;
        }        
    }
    
    public static function ToFormText($intval)
    {
        $value = self::ToInt($intval);
        return ($value == 0) ? '' : (string)$value;
    }
    
    public static function ArrayToString($array)
    {
        $json = json_encode($array);
        //var_dump($json);
        $phpStringArray = str_replace(array("{","}",":"), array("array(","}","=>"), $json);        
        return $phpStringArray;
    }    
}
