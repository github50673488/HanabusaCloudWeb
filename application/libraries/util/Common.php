<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of DBAccess
 *
 * @author Administrator
 */
class Common {
    public function GetWeekID($date)
    {
        //指定日の曜日番号（日:0  月:1  火:2  水:3  木:4  金:5  土:6）を取得
        $weekno = date('w', strtotime($date));
        return $weekno;
    }

    public function isHoliday($holidays,$date) {
        $result= in_array(date('Y-m-d',strtotime($date)), $holidays);
        return $result;
    }
    
    public function get_holidays_from_file() {
        $holidays_filename = APPPATH . '../jscript/holidays.js';
        $filecontent=  file_get_contents($holidays_filename);
        $filecontent = str_replace(array(" ", "\r\n", "\r", "\n", "'"), "", $filecontent);
        $filecontent = str_replace('];', '', str_replace('varholidays=[', '', $filecontent));
        $holidays = explode(",", $filecontent);
        return $holidays;
    }
    
    
    
    public function GetWeekName($id)
    {
        $weekjp = array(
                        '日', //0
                        '月', //1
                        '火', //2
                        '水', //3
                        '木', //4
                        '金', //5
                        '土'  //6
        );
        return $weekjp[$id];
    }
    
    
    /**
    * 校验日期格式是否正确 Valid：有効
    *
    * @param string $date 日期
    * @param string $formats 需要检验的格式数组
    * @return boolean
    */
   public function IsDate($date, $formats = array("Y-m-d", "Y/m/d")) {
       $unixTime = strtotime($date);
       if (!$unixTime) { //strtotime转换不对，日期格式显然不对。
           return false;
       }

       //校验日期的有效性，只要满足其中一个格式就OK
       foreach ($formats as $format) {
           if (date($format, $unixTime) == $date) {
               return true;
           }
       }

       return false;
   }
    
    public function IsDatetime($str,$format="Y/m/d",$delimiter='/')
    { 
        $strArr = explode($delimiter,$str); 
        if(empty($strArr)) {return false;} 
        foreach($strArr as $val) 
        {
            if(strlen($val)<2) { $val="0".$val; }
            $newArr[]=$val;            
        } 
        $str =implode($delimiter,$newArr);  
        $unixTime=strtotime($str);  
        $checkDate= date($format,$unixTime);  
        if($checkDate==$str)  
            return true;  
        else  
            return false;    
    }    
    
    public function FormatTime($text)
    {
        $timeText =$text;        
        if(is_numeric($text))
        {
            if(strlen($text) < 4)  {  $timeText = sprintf("%04d",$text); }
            if(strlen($text) > 4)  {  $timeText = substr($text,0,4); }            
            list($hour,$min) = sscanf($timeText, "%02d%02d");
            $timeText = sprintf("%02d:%02d",$hour,$min);
        }
                
        //$patt = '^(([1-9]{1})|([0-1][0-9])|([1-2][0-3])):([0-5][0-9])$';
        $patt = '/[\d]{1,2}:[\d]{1,2}/';
        $ret = preg_match($patt,$timeText,$m);
        if($ret == 0) { return ""; }
        
        $timeArr = explode(":", $timeText);
        if (is_numeric($timeArr[0]) && is_numeric($timeArr[1])) { 
            if (($timeArr[0] >= 0 && $timeArr[0] <= 23) && ($timeArr[1] >= 0 && $timeArr[1] <= 59)) {                
                //15分単位
                if ($timeArr[1] < 15) {
                    $timeArr[1] = 0;
                } else if ($timeArr[1] < 30) {
                    $timeArr[1] = 15;
                } else if ($timeArr[1] < 45) {
                    $timeArr[1] = 30;
                } else {
                    $timeArr[1] = 45;
                }                
                
                $timeText = sprintf("%02d:%02d",$timeArr[0],$timeArr[1]);
                return $timeText;
            } else {
                return "";
            }
        }
        return "";         
    }    
    
    public function DateDiffDay($begin, $end) {
        $d1 = strtotime($begin);
        $d2 = strtotime($end);
        $Days = round(($d2-$d1)/3600/24);
        return $Days;
    }

    public function FormatDate($dateText)
    {
        if(is_numeric($dateText)) {
            $timeText = $dateText;
            if(strlen($dateText) < 8)  {  $timeText = sprintf("%08d",$dateText); }
            if(strlen($dateText) > 8)  {  $timeText = substr($dateText,0,8); }                        
            list($year,$month,$day) = sscanf($timeText, "%04d%02d%02d");            
        } else {               
            list($year,$month, $day) = explode('[/.-]', $dateText); 
        }
        if(checkdate($month, $day, $year)) {
            return sprintf("%04d/%02d/%02d",$year,$month, $day);
        } else {
            return "";
        }
    }    
}

?>