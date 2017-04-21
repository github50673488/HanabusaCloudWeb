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
class RoomInputVC extends BaseVC {
    
    public $ActionMode;

    public function __construct ($actionMode) 
    {
        $this->ActionMode = $actionMode;
    }    
    
     public function IsValid($resvData) {
         try {
            $CI = &get_instance(); 
            if(($this->ActionMode == Key_RoomDel) || ($this->ActionMode == Key_RoomBack)) { return TRUE; }

            $manList = $CI->input->post('ManCount');
            $womanList = $CI->input->post('WoManCount');             
            $roomCountList = $CI->input->post('RoomCount');            
            if(count($manList) > 0) {
                $i = 0;
                foreach ($manList as $value) {
                    if(Convert::ToInt($manList[$i]) + Convert::ToInt($womanList[$i]) == 0)
                    {
                        $this->ErrNo = 1;
                        $this->ErrMsg = "人数を入力してください。";
                        return FALSE;                        
                    }
                    
                    if(Convert::ToInt($roomCountList[$i]) == 0)
                    {
                        $this->ErrNo = 1;
                        $this->ErrMsg = "部屋数を入力してください。";
                        return FALSE;                        
                    }    
                    $i++;                    
                }                               
            }
            
            //部屋チェック
            if($this->IsOverBook($resvData)) { return FALSE; }
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
        $i = 1;
        $hallDel = $CI->input->post('RoomDel');
        if(isset($hallDel))
        {
            $key = key($hallDel);
            $delArr = explode("_", $key);
            $delUseDate = $delArr[0];
            $delRoomTypeNo = $delArr[1];
        }
        
        $roomCountList = $CI->input->post('RoomCount');
        $manList = $CI->input->post('ManCount');
        $womanList = $CI->input->post('WoManCount');
        $childList = $CI->input->post('ChildCount');
        $meal1List = $CI->input->post('Meal1Count');
        $meal2List = $CI->input->post('Meal2Count');
        $meal3List = $CI->input->post('Meal3Count');
        
        $halls = $CI->input->post('Rooms');
        if(count($halls) > 0) {
           foreach ($halls as $value) {
                //復号
                $line = Environment::Authcode($value);
                $fieldArr = explode(FIELD_DELIMITER, $line);
                $detailData = new ResvDetail();
                $detailData->DetailID = $i;
                $this->SetDetailData($detailData,$fieldArr);
                $detailData->RoomKind = 1;     
                $detailData->Man = Convert::ToInt($manList[$i-1]);
                $detailData->Woman = Convert::ToInt($womanList[$i-1]);  
                $detailData->Child = Convert::ToInt($childList[$i - 1]);
                $detailData->Meal1 = Convert::ToInt($meal1List[$i - 1]);
                $detailData->Meal2 = Convert::ToInt($meal2List[$i - 1]);
                $detailData->Meal3 = Convert::ToInt($meal3List[$i - 1]);
                $detailData->RoomCount = Convert::ToInt($roomCountList[$i-1]);
                
                //削除の場合
                if(isset($hallDel) && ($detailData->UseDate == $delUseDate) && ($detailData->RoomTypeNo == $delRoomTypeNo)) { continue; }
                $resvData->Rooms[$detailData->UseDate][$detailData->RoomTypeNo] = $detailData;
                $i++;
            }        
        }               
    }
        
    public function GetFromPost($resvData) {
        $CI = &get_instance(); 
        
        //予約ヘッダー
        $this->SetResv($resvData, $CI);
        
        //会場データ 画面から 
        $this->SetHall($resvData, $CI);
        
        //部屋データ ⇒ クリア
        $this->GetFormData($resvData);
    }
    


    public function GetHeader() {
        $CI = &get_instance(); 
        $headData['actionMode'] =  $this->ActionMode;
        $headData['title'] = "【国立女性教育会館】宿泊情報入力";
        $headData['filelist'] = '<link href="'.$CI->config->item('base_url').'css/defaultgrid.css" rel="stylesheet" media="all">
<link href="'.$CI->config->item('base_url').'css/hallinput.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="javascript"> 
$(document).ready(function() {
	$("#RoomCount")[0].focus();	
});
</script>
';
            return $headData;
    }

    public function Show($resvData) {
        $CI = &get_instance();  

        $params = array('ResvData'=>$resvData, 'ReadOnly' => FALSE);
        $CI->load->library('usercontrol/RoomInput',$params);                       
        $listData = $CI->roominput->Render();
        $bodyData['listData'] = $listData;
            
        //隠れデータ
        //TODO:Halls、Roomsクリア
        $bodyData['hiddenData'] = $this->GetHiddenData($resvData);
        
        $msg = "";
        if(strlen($this->ErrMsg) > 0) {
            $msgBar = new MsgBar(array('Msg' => $this->ErrMsg));
            $msg = $msgBar->Render();
        }
        $bodyData['Msg'] = $msg;
        $CI->load->view('roominput',$bodyData);  
    }
}
