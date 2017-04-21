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
class HallListVC extends BaseVC {
    public $ActionMode;

    public function __construct ($actionMode) 
    {
        $this->ActionMode = $actionMode;
    }   
    
    public function IsValid($resvData) {
        try {
            if ($this->ActionMode == Key_HallSearch) { return TRUE; }
            if(count($resvData->Halls) == 0) {
                $this->ErrNo = 1;
                $this->ErrMsg = "施設を選択してください。";
                return FALSE;
            }
            
            //幼児室だけの予約はできません
            $existsNormal = FALSE;
            foreach ($resvData->Halls as $value) {
                foreach ($value as $detail) {
                    if($detail->RoomNo < 7031 || $detail->RoomNo > 7053) {
                        $existsNormal = TRUE;
                        break;
                    }
                }
            }

            if($existsNormal == FALSE) {
                $this->ErrNo = 1;
                $this->ErrMsg = "幼児室だけの予約はできません。";
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
                $detailData->RoomNo = $keyArr[1];
                $room = MasterAccess::GetHallData($detailData->RoomNo);
                $detailData->RoomTypeNo = $room->RoomTypeNo;
                $detailData->RoomName = $room->RoomName;
                $detailData->FeeType = 0;
                $detailData->RoomKind = 2;
                //$detailData->Man = $room->Capacity;
                $detailData->TotalSummary = Convert::ToInt($room->BasePrice);
                $resvData->Halls[$detailData->UseDate][$detailData->RoomNo] = $detailData;
                $i++;
            }       
        }
    }
        
    public function GetFromPost($resvData) {
        $CI = &get_instance(); 
        
        //予約ヘッダー
        $this->SetResv($resvData, $CI);
        
        //会場データ 画面から 
        if ($this->ActionMode != Key_HallSearch) { $this->GetFormData($resvData); }
        
        //部屋データ ⇒ クリア
        
    }
    


    public function GetHeader() {
        $CI = &get_instance();  
        $headData['actionMode'] =  $this->ActionMode;
        $headData['title'] = "【国立女性教育会館】施設空き状況";
        $headData['filelist'] = '<link href="'.$CI->config->item('base_url').'css/main.css" rel="stylesheet" media="all">    
<link href="'.$CI->config->item('base_url').'css/roomgrid.css" rel="stylesheet" media="all">                
<!-- ▼jQuery-UI -->
<script src="'.$CI->config->item('base_url').'jscript/jquery-ui.min.js"></script>
<!-- ▼jQuery-UI-datepicker -->
<script src="'.$CI->config->item('base_url').'jscript/jquery.ui.datepicker-ja.min.js"></script>
<link rel="stylesheet" href="'.$CI->config->item('base_url').'css/jquery-ui.css" >
<script src="'.$CI->config->item('base_url').'jscript/hallresv.js"></script>
';
       $headData['filelist'] .=' <!-- ▼tooltipster -->
<link rel="stylesheet" type="text/css" href="'.$CI->config->item('base_url').'tooltipster/css/tooltipster.css" />
<link rel="stylesheet" type="text/css" href="'.$CI->config->item('base_url').'tooltipster/css/themes/tooltipster-punk.css" />
<script type="text/javascript" src="'.$CI->config->item('base_url').'tooltipster/js/jquery.tooltipster.js"></script>
';
        
          $headData['filelist'] .='<link rel="stylesheet" type="text/css" href="'.$CI->config->item('base_url').'lightbox/lightbox.css" media="screen,tv" />
 <script type="text/javascript" charset="UTF-8" src="'.$CI->config->item('base_url').'lightbox/lightbox_plus.js"></script>
     ';// liu 20160308 add
       
        return $headData;
    }

    public function Show($resvData) {
        $CI = &get_instance();  
        //日付チェック
        $buildingType = $CI->input->post('BuildingType'); 
        if(!isset($buildingType)) { $buildingType = 1; }
        
        $usedate = $CI->input->post('BeginDate');            
        if(!isset($usedate) || !$CI->common->IsDate($usedate))
        {
           $now = getdate();
           $year = $now['year'];
           $month = $now['mon'];
           $day = $now['mday'];
            $usedate = sprintf("%04d/%02d/%02d", $year, $month, $day);
        }           

        //会場一覧
        $params = array('BeginDate'=>$usedate, 'MonCount'=>$CI->load->config->item('hallresv_moncount'), 'BuildingType'=>$buildingType);
        $CI->load->library('usercontrol/HallList',$params);                       
        $listData = $CI->halllist->Render();

        //隠れデータ
        //TODO:Halls、Roomsクリア
        $bodyData['hiddenData'] = $this->GetHiddenData($resvData);
        $bodyData['usedate'] = $usedate; 
        $bodyData['listData'] = $listData;
        $bodyData['baseUrl'] = $CI->config->item('base_url');
        $bodyData['buildingList'] = $CI->config->item('building_type');
        $bodyData['buildingType'] = $buildingType;
        
        $msg = "";
        if(strlen($this->ErrMsg) > 0) {
            $msgBar = new MsgBar(array('Msg' => $this->ErrMsg));
            $msg = $msgBar->Render();
        }
        $bodyData['Msg'] = $msg;
        $CI->load->view('hallresv',$bodyData);  
    }
}
