<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HallListVC
 *
 * @author Administrator
 */
class MenuVC extends BaseVC {
    
    public $ActionMode;

    public function __construct ($actionMode) 
    {
        $this->ActionMode = $actionMode;
    }    
    
     public function IsValid($resvData) {
         try {
            //更新成功、失敗？ 
             
            return TRUE;
         } catch (Exception $ex) {
             $this->ErrNo = $ex->getCode();
             $this->ErrMsg = $ex->getMessage();
             return FALSE;
         }
        
    }
            
    public function GetFromPost($resvData) {
    }
    


    public function GetHeader() {
        $CI = &get_instance(); 
        $headData['actionMode'] =  $this->ActionMode;
        $headData['title'] = "【国立女性教育会館】メニュー";
        $headData['filelist'] = '';
        return $headData;
    }

    public function Show($resvData) {
        $CI = &get_instance();  
        $bodyData['baseUrl'] = $CI->config->item('base_url');  
        $CI->load->view('menu',$bodyData);                   
    }
}