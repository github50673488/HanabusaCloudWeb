<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Response
 *
 * @author Administrator
 * /测试
$grade = array("score" => array(70, 95, 70.0, 60, "70"), "name" => array("Zhang San", "Li Si", "Wang Wu", "Zhao Liu", "TianQi"));
$response = new Response();
$result = $response :: show(200,'success',$grade,'json');
print_r($result);
 */
class Response {
    /**
   * [show 按综合方式输出数据]
   * @param [int] $code    [状态码]
   * @param [string] $message [提示信息]
   * @param array $data  [数据]
   * @param [string] $type [类型]
   * @return [string]    [返回值]
   */
  public static function Show($code, $message, $data = array(),$type = ''){
    if(!is_numeric($code)){
      return '';
    }
    $result = array(
      'code' => $code,
      'message' => $message,
      'data' => $data
    );
    if($type == 'json'){
      return self::Json($code, $message, $data);
    }elseif($type == 'xml'){
      return self::Xml($code, $message, $data);
    }else{
      //TODO
    }
  }
  /**
   * [json 按json方式输出数据]
   * @param [int] $code    [状态码]
   * @param [string] $message [提示信息]
   * @param [array] $data  [数据]
   * @return [string]     [返回值]
   */
  public static function Json($code, $message, $data = array()){
        if(!is_numeric($code)){
            return false;
        }
        $result = array(
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        );
        return json_encode($result);
  }
  
  /**
   * [xml 按xml格式生成数据]
   * @param [int] $code    [状态码]
   * @param [string] $message [提示信息]
   * @param array $data   [数据]
   * @return [string]     [返回值]
   */
  public static function Xml($code, $message, $data = array()){
    if(!is_numeric($code)){
        return false;
    }
    $result = array(
        'code'=>$code,
        'message'=>$message,
        'data'=>$data
    );
    $xml = '';
    $xml .= "<?xml version='1.0' encoding='UTF-8'?>\n";
    $xml .= "<root>\n";
    $xml .= self::XmlToEncode($result);
    $xml .= "</root>";
    header("Content-Type:text/xml");
    echo $xml;
  }
  
  public static function XmlToEncode($result){
    $xml = $attr ='';
    foreach($result as $key=>$val){
        if(is_numeric($key)){
            $attr = "id='{$key}'";
            $key = "row";
        }
        $xml .= "<{$key} {$attr}>";
        $xml .= is_array($val) ? self::XmlToEncode($val) : $val;
        $xml .= "</{$key}>\n";
    }
    return $xml;
  }
}
