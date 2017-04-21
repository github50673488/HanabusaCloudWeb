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
class ResvConfirmVC extends BaseVC {
    
    public $ActionMode;

    public function __construct ($actionMode) 
    {
        $this->ActionMode = $actionMode;
    }    
    
     public function IsValid($resvData) {
         try {
            if($this->ActionMode == Key_ResvConfirmBack) { return TRUE; }
            $CI = &get_instance(); 
            
            //部屋チェック
            if($this->IsOverBook($resvData)) { return FALSE; }
            
            //DB更新成功失敗 
            $ret = ResvAccess::Save($resvData);
            if(strlen($ret) > 0)
            {
                $this->ErrNo = 1;
                $this->ErrMsg = "ネットワークエラー発生しました、予約できません。".$ret;
                return FALSE;                 
            }
             
            return TRUE;
         } catch (Exception $ex) {
             $this->ErrNo = $ex->getCode();
             $this->ErrMsg = $ex->getMessage();
             return FALSE;
         }
        
    }
            
    public function GetFromPost($resvData) {
        $CI = &get_instance(); 
        
        //予約ヘッダー
        $this->SetResv($resvData, $CI);
        
        //会場データ
        $this->SetHall($resvData, $CI);
        
        //部屋データ
        $this->SetRoom($resvData, $CI);
    }
    


    public function GetHeader() {
        $CI = &get_instance();
        $headData['actionMode'] =  $this->ActionMode;
        $headData['title'] = "【国立女性教育会館】予約確認";
        $headData['filelist'] = '<link href="'.$CI->config->item('base_url').'css/defaultgrid.css" rel="stylesheet" media="all">
<link href="'.$CI->config->item('base_url').'css/resvconfirm.css" rel="stylesheet" type="text/css">
';
        return $headData;
    }

    private function GetTotalSummary($resvData) {
        $summary = 0;
        if(count($resvData->Halls) > 0) {
            foreach ($resvData->Halls as $list) {
                foreach ($list as $value) { 
                    $summary += $value->TotalSummary;
                }
            }
        }
        
        if(count($resvData->Rooms) > 0) {
            foreach ($resvData->Rooms as $list) {
                foreach ($list as $value) { 
                    $summary += $value->TotalSummary;
                }
            }                               
        }   
        return $summary;
    }

    public function Show($resvData) {
        $CI = &get_instance();  
        $bodyData['baseUrl'] = $CI->config->item('base_url');            
        //予約データ
        $bodyData['ResvData'] = $resvData;
        
        //自由集計データ
        $freeDs = MasterAccess::GetFreeDict(Array( 
            0 => $resvData->PrefectureID,
            1 => $resvData->GroupKubun,
            2 => $resvData->KnowReason,
            3 => $resvData->GroupType,
            4 => $resvData->PurposeType
        ));        
        $bodyData['FreeDs'] = $freeDs;
        
        $bodyData['hallListData'] = '';
        if(count($resvData->Halls) > 0) {
            $params = array('ResvData'=>$resvData, 'ReadOnly' => TRUE);
            $CI->load->library('usercontrol/HallInput',$params);                       
            $hallListData = $CI->hallinput->Render();
            $bodyData['hallListData'] = $hallListData;
        }
        
        $bodyData['roomListData'] = '';
        if(count($resvData->Rooms) > 0) {
            $params = array('ResvData'=>$resvData, 'ReadOnly' => TRUE);
            $CI->load->library('usercontrol/RoomInput',$params);                       
            $roomListData = $CI->roominput->Render();
            $bodyData['roomListData'] = $roomListData;        
        }
        
        $msg = "";
        if(strlen($this->ErrMsg) > 0) {
            $msgBar = new MsgBar(array('Msg' => $this->ErrMsg));
            $msg = $msgBar->Render();
        }
        $bodyData['Msg'] = $msg;            
        
        //部屋予約の料金計算
        $bodyData['summary'] = $this->GetTotalSummary($resvData);     
        //隠れデータ
        $bodyData['hiddenData'] = $this->GetHiddenData($resvData);        
        $CI->load->view('resvconfirm',$bodyData);                    
    }
}
