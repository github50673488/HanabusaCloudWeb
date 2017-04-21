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
class UserInputVC extends BaseVC {
    
    public $ActionMode;

    public function __construct ($actionMode) 
    {
        $this->ActionMode = $actionMode;
    }    
    
     public function IsValid($resvData) {
         try {
            if(($this->ActionMode == Key_UserBackH) || ($this->ActionMode == Key_UserBackR)) { return TRUE; }
            
            //部屋チェック
            if($this->IsOverBook($resvData)) { return FALSE; }            
            
            if(strlen($resvData->Name) == 0)
            {
               $this->ErrNo = 1;
               $this->ErrMsg = "代表者名を入力してください。";
               return FALSE;
            }
            
            if(strlen($resvData->Kana) == 0)
            {
               $this->ErrNo = 1;
               $this->ErrMsg = "代表者カナを入力してください。";
               return FALSE;
            }

            if(strlen($resvData->CinTime) == 0)
            {
               $this->ErrNo = 1;
               $this->ErrMsg = "入館時間を入力してください。";
               return FALSE;
            }

            if(strlen($resvData->CoutTime) == 0)
            {
               $this->ErrNo = 1;
               $this->ErrMsg = "退館時間を入力してください。";
               return FALSE;
            }
            
            if(strlen($resvData->Tel) == 0 && strlen($resvData->PortableTel) == 0)
            {
               $this->ErrNo = 1;
               $this->ErrMsg = "電話番号を入力してください。";
               return FALSE;
            }
            
            if(strlen($resvData->Mail) == 0)
            {
               $this->ErrNo = 1;
               $this->ErrMsg = "メールを入力してください。";
               return FALSE;
            }    
                                    
            $CI = &get_instance(); 
            $CI->load->helper('email');
            if (!valid_email($resvData->Mail))
            {
               $this->ErrNo = 1;
               $this->ErrMsg = "正しいメールを入力してください。";
               return FALSE;
            }            
            
            $mail2 = $CI->input->post('Mail2');
            if($resvData->Mail != $mail2)
            {
               $this->ErrNo = 1;
               $this->ErrMsg = "入力したメールの内容を一致しません。";
               return FALSE;
            }              
            return TRUE;
         } catch (Exception $ex) {
             $this->ErrNo = $ex->getCode();
             $this->ErrMsg = $ex->getMessage();
             return FALSE;
         }
        
    }
    
    /**
     * 会場空き状況予約画面より、予約データを取得
     * $actionMode
     * 1.ResvHall 会場予約入力
     */                
    private function GetFormData($resvData)
    {
        $CI = &get_instance(); 
        //$resvData->GroupKubun = $CI->input->post('GroupKubun');
        $resvData->GroupName = $CI->input->post('GroupName');
        $resvData->GroupKana = $CI->input->post('GroupKana');
        $resvData->Name = $CI->input->post('Name');
        $resvData->Kana = $CI->input->post('Kana');
        $resvData->KnowReason = $CI->input->post('KnowReason');
        //$resvData->GroupType = $CI->input->post('GroupType');//20160309 del 
        //$resvData->PurposeType = $CI->input->post('PurposeType');//20160309 del
        $resvData->ZipCode = $CI->input->post('ZipCode');
        $resvData->PrefectureID = $CI->input->post('Prefecture');
        //$resvData->Prefecture = $this->input->post('Prefecture');//20160309 del
        $resvData->Address2 = $CI->input->post('Address2');
        $resvData->Address3 = $CI->input->post('Address3');
        $resvData->Address4 = $CI->input->post('Address4');
        $resvData->Tel = $CI->input->post('Tel');
        $resvData->PortableTel = $CI->input->post('PortableTel');
        $resvData->Fax = $CI->input->post('Fax');
        $resvData->Mail = $CI->input->post('Mail');
        $resvData->CinTime = $CI->input->post('CinTime');
        $resvData->CoutTime = $CI->input->post('CoutTime');
        $resvData->PurposeMemo = $CI->input->post('PurposeMemo');
        $resvData->Memo = $CI->input->post('Memo');
        $resvData->BeforeName = $CI->input->post('BeforeName');
         
    }
        
    public function GetFromPost($resvData) {
        $CI = &get_instance(); 
        
        //予約ヘッダー
        $this->SetResv($resvData, $CI);
        $this->GetFormData($resvData);
        
        //会場データ
        $this->SetHall($resvData, $CI);
        
        //部屋データ
        $this->SetRoom($resvData, $CI);
    }
    


    public function GetHeader() {
        $CI = &get_instance();  
        $headData['actionMode'] =  $this->ActionMode;
        $headData['title'] = "【国立女性教育会館】利用者情報入力";
        $headData['filelist'] = '<link href="'.$CI->config->item('base_url').'css/defaultgrid.css" rel="stylesheet" media="all">
<link href="'.$CI->config->item('base_url').'css/userinput.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="javascript"> 
$(document).ready(function() {
	$("#KnowReason")[0].focus();	
});
</script>
';
        return $headData;
    }

    public function Show($resvData) {
        $CI = &get_instance();  
                     
        $bodyData['ActionMode'] = ($this->ActionMode == Key_UserInputH) ? 'UserBackH' : 'UserBackR';                 
        $bodyData['ResvData'] = $resvData;
        $freeDs = MasterAccess::GetFreeDataSet();        
        $bodyData['FreeDs'] = $freeDs;
        //隠れデータ
        //TODO:Halls、Roomsクリア
        $bodyData['hiddenData'] = $this->GetHiddenData($resvData);
        
        $msg = "";
        if(strlen($this->ErrMsg) > 0) {
            $msgBar = new MsgBar(array('Msg' => $this->ErrMsg));
            $msg = $msgBar->Render();
        }
        $bodyData['Msg'] = $msg;            
        $CI->load->view('userinput',$bodyData);                  
    }
}
