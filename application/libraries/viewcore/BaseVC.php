<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseVC
 *
 * @author Administrator
 */
 abstract class BaseVC {
    public $ErrNo = 0;
    public $ErrMsg = "";
    public abstract function GetHeader();
    public abstract function Show($resvData);
    public abstract function GetFromPost($resvData); 
    public abstract function IsValid($resvData);
     
    private function GetHiddenDetail(ResvDetail $detailData)
    {
         $resvLine = $detailData->RoomTypeNo.FIELD_DELIMITER
                .$detailData->RoomNo.FIELD_DELIMITER
                .$detailData->UseDate.FIELD_DELIMITER
                .$detailData->FeeType.FIELD_DELIMITER
                .$detailData->TotalSummary.FIELD_DELIMITER          
                .$detailData->Man.FIELD_DELIMITER
                .$detailData->Woman.FIELD_DELIMITER                 
                .$detailData->RoomCount.FIELD_DELIMITER
                .$detailData->RoomName.FIELD_DELIMITER
                .$detailData->Child.FIELD_DELIMITER
                .$detailData->Meal1.FIELD_DELIMITER
                .$detailData->Meal2.FIELD_DELIMITER
                .$detailData->Meal3;
        $resv = Environment::Authcode($resvLine, 'ENCODE');                
        return $resv;                
    }

    public function GetHiddenData(Resv $resvData)
    {
        $resvLine = $resvData->GroupKubun.FIELD_DELIMITER
            .$resvData->GroupName.FIELD_DELIMITER
            .$resvData->GroupKana.FIELD_DELIMITER
            .$resvData->Name.FIELD_DELIMITER
            .$resvData->Kana.FIELD_DELIMITER
            .$resvData->KnowReason.FIELD_DELIMITER
            .$resvData->GroupType.FIELD_DELIMITER
            .$resvData->PurposeType.FIELD_DELIMITER
            .$resvData->ZipCode.FIELD_DELIMITER
            .$resvData->PrefectureID.FIELD_DELIMITER
            .$resvData->Prefecture.FIELD_DELIMITER
            .$resvData->Address3.FIELD_DELIMITER
            .$resvData->Address2.FIELD_DELIMITER
            .$resvData->Address4.FIELD_DELIMITER
            .$resvData->Tel.FIELD_DELIMITER
            .$resvData->PortableTel.FIELD_DELIMITER
            .$resvData->Fax.FIELD_DELIMITER
            .$resvData->Mail.FIELD_DELIMITER
            .$resvData->CinTime.FIELD_DELIMITER
            .$resvData->CoutTime.FIELD_DELIMITER
            .$resvData->PurposeMemo.FIELD_DELIMITER
            .$resvData->ResvID.FIELD_DELIMITER
            .$resvData->BeforeName.FIELD_DELIMITER
            .$resvData->Memo;
        $resv = Environment::Authcode($resvLine, 'ENCODE');
        $data = form_hidden('Resv', $resv,FALSE);
        
        //会場
        if(count($resvData->Halls) > 0)
        {
            foreach ($resvData->Halls as $list) {
                foreach ($list as $value) {
                    $detailline = $this->GetHiddenDetail($value);
                    $data = form_hidden('Halls[]', $detailline,TRUE);
                }
            }
        }
        
        //部屋
        if(count($resvData->Rooms) > 0)
        {
            foreach ($resvData->Rooms as $list) {
                foreach ($list as $value) {
                    $detailline = $this->GetHiddenDetail($value);
                    $data = form_hidden('Rooms[]', $detailline,TRUE);
                }
            }
        }        
        
        return $data;
    }
     
     public function SetResv($resvData, $CI)
     {
         $resv = $CI->input->post('Resv'); 
        if(isset($resv)){
            //復号
            $resvLine = Environment::Authcode($resv);
            $fieldArr = explode(FIELD_DELIMITER, $resvLine);
            $resvData->GroupKubun = $fieldArr[0];
            $resvData->GroupName = $fieldArr[1];
            $resvData->GroupKana = $fieldArr[2];
            $resvData->Name = $fieldArr[3];
            $resvData->Kana = $fieldArr[4];
            $resvData->KnowReason = $fieldArr[5];
            $resvData->GroupType = $fieldArr[6];
            $resvData->PurposeType = $fieldArr[7];
            $resvData->ZipCode = $fieldArr[8];
            $resvData->PrefectureID = $fieldArr[9];
            $resvData->Prefecture = $fieldArr[10];
            $resvData->Address3 = $fieldArr[11];
            $resvData->Address2 = $fieldArr[12];
            $resvData->Address4 = $fieldArr[13];
            $resvData->Tel = $fieldArr[14];
            $resvData->PortableTel = $fieldArr[15];
            $resvData->Fax = $fieldArr[16];
            $resvData->Mail = $fieldArr[17];
            $resvData->CinTime = $fieldArr[18];
            $resvData->CoutTime = $fieldArr[19];
            $resvData->PurposeMemo = $fieldArr[20];
            $resvData->ResvID = $fieldArr[21];
            $resvData->BeforeName = $fieldArr[22];
            $resvData->Memo = $fieldArr[23];
        }
     }
     
     protected function SetDetailData($detailData,$fieldArr)
     {
        $detailData->RoomTypeNo = $fieldArr[0];
        $detailData->RoomNo = $fieldArr[1];
        $detailData->UseDate = $fieldArr[2];
        $detailData->FeeType = $fieldArr[3];
        $detailData->TotalSummary = $fieldArr[4];                
        $detailData->Man = $fieldArr[5];
        $detailData->Woman = $fieldArr[6];                 
        $detailData->RoomCount = $fieldArr[7];
        $detailData->RoomName = $fieldArr[8];
        $detailData->Child = $fieldArr[9];
        $detailData->Meal1 = $fieldArr[10];
        $detailData->Meal2 = $fieldArr[11];
        $detailData->Meal3 = $fieldArr[12];
     }

    public function SetHall($resvData, $CI)
    {
        $halls = $CI->input->post('Halls'); 
        if(isset($halls)){
            $i = 1;
            foreach ($halls as $value) {
                //復号
                $line = Environment::Authcode($value);
                $fieldArr = explode(FIELD_DELIMITER, $line);
                $detailData = new ResvDetail();
                $detailData->DetailID = $i;
                $this->SetDetailData($detailData,$fieldArr);
                $detailData->RoomKind = 2;                                
                $resvData->Halls[$detailData->UseDate][$detailData->RoomNo] = $detailData;
                $i++;
            }
        }
    }
    
    public function SetRoom($resvData, $CI)
    {
        $rooms = $CI->input->post('Rooms'); 
        if(isset($rooms)){
            $i = count($resvData->Halls);
            foreach ($rooms as $value) {
                //復号
                $line = Environment::Authcode($value);
                $fieldArr = explode(FIELD_DELIMITER, $line);
                $detailData = new ResvDetail();
                $detailData->DetailID = $i;
                $this->SetDetailData($detailData,$fieldArr);
                $detailData->RoomKind = 1;                                
                $resvData->Rooms[$detailData->UseDate][$detailData->RoomTypeNo] = $detailData;
                $i++;
            }
        }
    }
    
    public function IsOverBook(Resv $resvData) 
    {
        //会場
         if(count($resvData->Halls) > 0)
         {
             foreach ($resvData->Halls as $list) {
                 foreach ($list as $value) {
                     $remain = ResvAccess::GetRemain($value);
                     if($remain < $value->RoomCount)
                     {
                         $this->ErrNo = 1;
                         $this->ErrMsg = "「".$value->RoomName."」もう既に予約されました。";
                         return TRUE;                 
                     }                            
                 }
             }
         }

         //部屋
         if(count($resvData->Rooms) > 0)
         {
             foreach ($resvData->Rooms as $list) {
                 foreach ($list as $value) {
                     $remain = ResvAccess::GetRemain($value);
                     if($remain < $value->RoomCount)
                     {
                         $this->ErrNo = 1;
                         $this->ErrMsg = '「'.$value->RoomName.'」の残室数が足りません。【残室数：'.$remain.'】';
                         return TRUE;                 
                     }                                                    
                 }                                                        
             }
         }    
         
         return FALSE;      
    }
}
