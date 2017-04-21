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
class RoomListVC extends BaseVC {
    public $ActionMode;

    public function __construct ($actionMode) 
    {
        $this->ActionMode = $actionMode;
    }   
    
    public function IsValid($resvData) {
        try {
             if($this->ActionMode == Key_RoomSearch || $this->ActionMode == Key_HallInputBack) { return TRUE; }
            
            if(count($resvData->Halls) == 0 && count($resvData->Rooms) == 0) {
               $this->ErrNo = 1;
               $this->ErrMsg = "部屋を選択してください。";
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
        $i = 1;
        $detailList = $CI->input->post('chk');
        if(count($detailList) > 0) {
            foreach ($detailList as $key => $value) {
                $keyArr = explode("_", $key);
                $detailData = new ResvDetail();                
                $detailData->DetailID = $i;
                $detailData->UseDate = $keyArr[0];
                $detailData->RoomTypeNo =  $keyArr[1];
                $detailData->RoomNo = 0;
                $detailData->RoomName = MasterAccess::GetRoomTypeName($detailData->RoomTypeNo);
                $detailData->FeeType = 0;
                $detailData->RoomKind = 1;
                //$detailData->Man = $room->Capacity;
                $detailData->TotalSummary = 0;
                 $resvData->Rooms[$detailData->UseDate][$detailData->RoomTypeNo] = $detailData;
                $i++;
            }            
        }        
    }
        
    public function GetFromPost($resvData) {
        $CI = &get_instance(); 
        
        //予約ヘッダー
        $this->SetResv($resvData, $CI);
        
        //会場データ
        $this->SetHall($resvData, $CI);
        
        //部屋データ ⇒ 画面から
        $this->GetFormData($resvData);
    }
    


    public function GetHeader() {
        $CI = &get_instance();  
        $headData['actionMode'] =  $this->ActionMode;
        $headData['title'] = "【国立女性教育会館】宿泊空き状況";
        $headData['filelist'] = '<link href="'.$CI->config->item('base_url').'css/main.css" rel="stylesheet" media="all">    
<link href="'.$CI->config->item('base_url').'css/roomgrid.css" rel="stylesheet" media="all">                
<!-- ▼jQuery-UI -->
<script src="'.$CI->config->item('base_url').'jscript/jquery-ui.min.js"></script>
<!-- ▼jQuery-UI-datepicker -->
<script src="'.$CI->config->item('base_url').'jscript/jquery.ui.datepicker-ja.min.js"></script>
<link rel="stylesheet" href="'.$CI->config->item('base_url').'css/jquery-ui.css" >
<script src="'.$CI->config->item('base_url').'jscript/hallresv.js"></script>
';
        
      /*  $headData['filelist'] ='<link rel="stylesheet" type="text/css" href="'.$CI->config->item('base_url').'lightbox/lightbox.css" media="screen,tv" />
 <script type="text/javascript" charset="UTF-8" src="'.$CI->config->item('base_url').'lightbox/lightbox_plus.js"></script>';
       * */
       
        
        
        return $headData;
    }

    public function Show($resvData) {
        $CI = &get_instance();  
        //日付チェック
        $usedate = $CI->input->post('BeginDate');            
        if(!isset($usedate) || !$CI->common->IsDate($usedate))
        {
           $now = getdate();
           $year = $now['year'];
           $month = $now['mon'];
           $day = $now['mday'];
            $usedate = sprintf("%04d/%02d/%02d", $year, $month, $day);
        }           

        //部屋一覧               
        $params = array('BeginDate'=>$usedate, 'MonCount'=>$CI->load->config->item('hallresv_moncount'));
        $CI->load->library('usercontrol/RoomList',$params);                       
        $listData = $CI->roomlist->Render();

        //隠れデータ
        //TODO:Halls、Roomsクリア
        $bodyData['hiddenData'] = $this->GetHiddenData($resvData);
        $bodyData['usedate'] = $usedate; 
        $bodyData['listData'] = $listData;
        $bodyData['baseUrl'] = $CI->config->item('base_url');
        
        $msg = "";
        if(strlen($this->ErrMsg) > 0) {
            $msgBar = new MsgBar(array('Msg' => $this->ErrMsg));
            $msg = $msgBar->Render();
        }
        $bodyData['Msg'] = $msg;
        $CI->load->view('roomlist',$bodyData);  
    }
}
