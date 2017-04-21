<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResvAccess
 *
 * @author Administrator
 */
class ResvAccess {
    //採番
    public static function GetReserveID($useDate, $typeID = 1)
    {
        $db = MySqlAccess::GetInstance();
        $db->BeginTran();
        $seqNo = 0;
        try
        {
            $sql = "INSERT INTO  m_seq(TypeID,UseDate,SeqNo,LockFlag) SELECT $typeID,'$useDate',0,0 FROM dual WHERE NOT EXISTS(SELECT 1 FROM m_seq WHERE TypeID = $typeID AND UseDate = '$useDate')  ";
            $affected = $db->ExecuteNonQuery($sql);
            if ($affected === -1) {                
                $db->RollBack();            
                $db = null;
                return 0;
            } 
            
            //$sql = "SELECT * FROM m_seqno WHERE ID = 1 FOR UPDATE";
            $sql = "UPDATE m_seq SET LockFlag = CASE WHEN LockFlag = 0 THEN 1 ELSE 0 END WHERE TypeID = $typeID AND UseDate = '$useDate' ";
            if ($db->ExecuteNonQuery($sql) == -1) {                
                $db->RollBack();            
                $db = null;
                return 0;
            } 

            $sql = "SELECT SeqNo FROM m_seq WHERE TypeID = $typeID AND UseDate = '$useDate' ";
            $fieldVal = $db->GetRowField($sql);
            $seqNo = intval($fieldVal);
            if($seqNo == 99999) { $seqNo = 1; } else { $seqNo++;}   
                
            $sql = "UPDATE m_seq SET Seqno = $seqNo WHERE TypeID = $typeID AND UseDate = '$useDate'";
            if ($db->ExecuteNonQuery($sql) == -1) {
                $db->RollBack();            
                $db = null;
                return 0;
            }                 
            $db->Commit();
        } catch (Exception $e) {
            $db->RollBack();            
        }                 
        return $useDate.sprintf("%05d",$seqNo);
    }
    
    public static function SaveDetail($resvID,$value,$db)
    {
        $sql = "INSERT INTO d_resvdetail(ResvID,UseDate,RoomTypeNo,RoomNo,FeeType,TotalSummary,Man,Woman,RoomCount,Child,Meal1,Meal2,Meal3)
                VALUES('$resvID','$value->UseDate',$value->RoomTypeNo,$value->RoomNo,$value->FeeType,$value->TotalSummary,$value->Man,$value->Woman,$value->RoomCount,$value->Child,$value->Meal1,$value->Meal2,$value->Meal3)";
        if ($db->ExecuteNonQuery($sql) == -1) {
            $em = "d_resvdetail Error: " . Convert::ArrayToString($db->GetConnect()->errorInfo());
            $db->RollBack();
            return $em;            
        }    

        //部屋残数の変更
        $sql = "UPDATE d_offer SET UseCount=UseCount+$value->RoomCount WHERE UseDate='$value->UseDate' AND RoomTypeNo=$value->RoomTypeNo AND RoomNo=$value->RoomNo";
        if ($db->ExecuteNonQuery($sql) == -1) {
            $em = "d_offer Error: " . Convert::ArrayToString($db->GetConnect()->errorInfo());
            $db->RollBack();
            return $em;            
        }                        
        return "";
    }

    //予約データの保存処理
    public static function Save($resvData)
    {
        $db = MySqlAccess::GetInstance();
        $db->BeginTran();
                
        $sql = "INSERT INTO d_resv(ResvID,SendStatus,ResvNo,GroupKubun,GroupName,GroupKana,Name,Kana,KnowReason,GroupType,PurposeType,ZipCode,PrefectureID,Prefecture,Address2,Address3,Address4,Tel,PortableTel,Fax,Mail,CinTime,CoutTime,PurposeMemo,UpdateDate,Memo,BeforeName)
        VALUES('$resvData->ResvID',0,'$resvData->ResvNo',$resvData->GroupKubun,'$resvData->GroupName','$resvData->GroupKana','$resvData->Name','$resvData->Kana',
                $resvData->KnowReason,$resvData->GroupType,$resvData->PurposeType,'$resvData->ZipCode','$resvData->PrefectureID','$resvData->Prefecture',
                    '$resvData->Address2','$resvData->Address3','$resvData->Address4','$resvData->Tel','$resvData->PortableTel',
                        '$resvData->Fax','$resvData->Mail','$resvData->CinTime','$resvData->CoutTime','$resvData->PurposeMemo',NOW(),'$resvData->Memo','$resvData->BeforeName')";
        if ($db->ExecuteNonQuery($sql) == -1) {
            $em = "d_resv Error: " . Convert::ArrayToString($db->GetConnect()->errorInfo());
            $db->RollBack();
            return $em;
        }        
        
        //会場
        if(count($resvData->Halls) > 0)
        {
            foreach ($resvData->Halls as $list) {
                foreach ($list as $value) {
                    $em = self::SaveDetail($resvData->ResvID, $value, $db);
                    if(strlen($em) > 0) { return $em; }
                }
            }
        }
        
        //部屋
        if(count($resvData->Rooms) > 0)
        {
            foreach ($resvData->Rooms as $list) {
                foreach ($list as $value) {
                    $em = self::SaveDetail($resvData->ResvID, $value, $db);
                    if(strlen($em) > 0) { return $em; }                    
                }                                                        
            }
        }        
        
        $sql = "UPDATE d_resvstatus SET Status=".Key_END.",UpdateDate=NOW() WHERE ResvID='$resvData->ResvID'";
        if ($db->ExecuteNonQuery($sql) == -1) {
            $em = "d_resvstatus Error: " . Convert::ArrayToString($db->GetConnect()->errorInfo());
            $db->RollBack();
            return $em;            
        }
        $db->Commit();                        
        return "";
    }    
    
    /*
     * 休日カレンダApi
     */
    public static function _SaveHolidaySettingFile() {
        $CI = &get_instance();
        $holidayFileContent = $CI->input->post('Data');
        $holidays_filename = APPPATH . '../jscript/holidays.js';
        $result = file_put_contents($holidays_filename, $holidayFileContent);
        return $result===FALSE?FALSE:TRUE;
    }
    
    /*
     * 在庫調整Api
     * 電文フォーマット
     * 日付(yyyyMMdd) + FIELD_DELIMITER + RoomTypeNo_RoomNo + FIELD_DELIMITER + 残室数 + ROW_DELIMITER
     * NetGroupCode：RoomTypeNo + RoomNo
     */
    public static function SetAdjustment()
    {
        $CI = &get_instance(); 
        $obj = MySqlAccess::GetInstance();        
        $offerData = $CI->input->post('Data');
        $offerData = urldecode($offerData); 
        $rowArr = explode(ROW_DELIMITER, $offerData);
        $obj->BeginTran();
        foreach ($rowArr as $row) {
            if(strlen($row) == 0) { continue; }
            $fieldArr = explode(FIELD_DELIMITER, $row);
            $roomArr = explode('_', $fieldArr[1]);
            $sql = "DELETE FROM d_offer WHERE UseDate='$fieldArr[0]' AND RoomTypeNo=$roomArr[0] AND RoomNo=$roomArr[1]";
            if ($obj->ExecuteNonQuery($sql) == -1) {
                //$em = "d_resv Error: " . Convert::ArrayToString($db->GetConnect()->errorInfo());
                $obj->RollBack();
                return FALSE;
            } 

            $sql = "INSERT INTO d_offer(UseDate,RoomTypeNo,RoomNo,OfferCount,UseCount,UpdateDate) VALUES('".$fieldArr[0]."',".$roomArr[0].",".$roomArr[1].",".$fieldArr[2]
                    .",IFNULL((SELECT SUM(RoomCount) FROM d_resvdetail WHERE UseDate='".$fieldArr[0]."' AND RoomTypeNo=".$roomArr[0]." AND RoomNo=".$roomArr[1]."),0),NOW());";
            if ($obj->ExecuteNonQuery($sql) == -1) {
                //$em = "d_resv Error: " . Convert::ArrayToString($db->GetConnect()->errorInfo());
                $obj->RollBack();
                return FALSE;
            }                 
        }             
        $obj->Commit();   
        return TRUE;
    }
    
    public static function SetResvFinish()
    {
        $obj = MySqlAccess::GetInstance();
        $row = $obj->ExecuteNonQuery("UPDATE d_resv SET SendStatus = 2 WHERE SendStatus = 1");
        return ($row == -1) ? FALSE : TRUE;
    }    

    public static function GetResvData()
    {        
        $obj = MySqlAccess::GetInstance();
        $obj->ExecuteNonQuery("UPDATE d_resv SET SendStatus = 1 WHERE SendStatus = 0");
        //SendStatus = 0 ⇒ 1
        $data = '';                       
        $sql = "SELECT ResvID,ResvNo,GroupKubun,GroupName,GroupKana,Name,Kana,KnowReason,GroupType,PurposeType,ZipCode,PrefectureID,Prefecture,Address2,Address3,Address4,Tel,PortableTel,Fax,Mail,CinTime,CoutTime,PurposeMemo,UpdateDate,Memo,BeforeName "
                . " FROM d_resv "
                . " WHERE SendStatus = 1";
        $db = $obj->GetConnect();
        $res = $db->query($sql);
        $res->setFetchMode(PDO::FETCH_BOTH);
        while ($row = $res->fetch()) {
            $data .=$row['ResvID'].FIELD_DELIMITER;
            $data .=$row['ResvNo'].FIELD_DELIMITER;
            $data .=$row['GroupKubun'].FIELD_DELIMITER;
            $data .=$row['GroupName'].FIELD_DELIMITER;
            $data .=$row['GroupKana'].FIELD_DELIMITER;
            $data .=$row['Name'].FIELD_DELIMITER;
            $data .=$row['Kana'].FIELD_DELIMITER;
            $data .=$row['KnowReason'].FIELD_DELIMITER;
            $data .=$row['GroupType'].FIELD_DELIMITER;
            $data .=$row['PurposeType'].FIELD_DELIMITER;
            $data .=$row['ZipCode'].FIELD_DELIMITER;
            $data .=$row['PrefectureID'].FIELD_DELIMITER;
            $data .=$row['Prefecture'].FIELD_DELIMITER;
            $data .=$row['Address2'].FIELD_DELIMITER;
            $data .=$row['Address3'].FIELD_DELIMITER;
            $data .=$row['Address4'].FIELD_DELIMITER;
            $data .=$row['Tel'].FIELD_DELIMITER;
            $data .=$row['PortableTel'].FIELD_DELIMITER;
            $data .=$row['Fax'].FIELD_DELIMITER;
            $data .=$row['Mail'].FIELD_DELIMITER;
            $data .=$row['CinTime'].FIELD_DELIMITER;
            $data .=$row['CoutTime'].FIELD_DELIMITER;
            $data .=$row['PurposeMemo'].FIELD_DELIMITER;
            $data .=$row['UpdateDate'].FIELD_DELIMITER;
            $data .=$row['Memo'].FIELD_DELIMITER;
            $data .=$row['BeforeName'].ROW_DELIMITER;
        }
        $res->closeCursor();
        $res = null;  
        $data .= TABLE_DELIMITER;
        
        $sql = "SELECT A.ResvID,A.UseDate,A.RoomTypeNo,A.RoomNo,A.FeeType,A.TotalSummary,A.Man,A.Woman,A.RoomCount,A.Child,A.Meal1,A.Meal2,A.Meal3 
            FROM d_resvdetail A LEFT JOIN d_resv B ON A.ResvID = B.ResvID WHERE B.SendStatus = 1";
        $res = $db->query($sql);
        $res->setFetchMode(PDO::FETCH_BOTH);
        while ($row = $res->fetch()) {
            $data .=$row['ResvID'].FIELD_DELIMITER;
            $data .=$row['UseDate'].FIELD_DELIMITER;
            $data .=$row['RoomTypeNo'].FIELD_DELIMITER;
            $data .=$row['RoomNo'].FIELD_DELIMITER;
            $data .=$row['FeeType'].FIELD_DELIMITER;
            $data .=$row['TotalSummary'].FIELD_DELIMITER;
            $data .=$row['Man'].FIELD_DELIMITER;
            $data .=$row['Woman'].FIELD_DELIMITER;
            $data .=$row['RoomCount'].FIELD_DELIMITER;
            $data .=$row['Child'].FIELD_DELIMITER;
            $data .=$row['Meal1'].FIELD_DELIMITER;
            $data .=$row['Meal2'].FIELD_DELIMITER;
            $data .=$row['Meal3'].ROW_DELIMITER;
        }
        $res->closeCursor();
        $res = null;  
        return $data;
    }

    public static function GetHallList($begindate,$enddate,$type)
    {
        $obj = MySqlAccess::GetInstance();
        $data = array();
        $sqlBegindate = str_replace('/', '', $begindate);
        $sqlEnddate = str_replace('/', '', $enddate);        
        $sql = "SELECT A.RoomNo,A.RoomName,C.Cnt,C.MinKubun
FROM m_room A
LEFT JOIN m_roomtype B ON A.RoomTypeNo = B.RoomTypeNo
LEFT JOIN (SELECT substring(CAST(RoomNo AS CHAR(4)),1,3) RoomID,COUNT(1) Cnt,MIN(substring(CAST(RoomNo AS CHAR(4)),4,1)) MinKubun FROM m_room WHERE RoomNo > 1000 GROUP BY substring(CAST(RoomNo AS CHAR(4)),1,3)) C
       ON substring(CAST(A.RoomNo AS CHAR(4)),1,3) = C.RoomID
WHERE B.RoomKind = 2";
        if($type > 0) { $sql .= " AND A.SectionNo=$type "; }
        $sql .= " ORDER BY A.RoomNo";

        $dataRow = array(); //Array(部屋No, HallRow)        
        $db = $obj->GetConnect();
        $res = $db->query($sql);
        $res->setFetchMode(PDO::FETCH_BOTH);
        while ($row = $res->fetch()) {
            $roomNo = $row['RoomNo'];
            $dataRow[$roomNo] = new HallRow($roomNo,$row['Cnt'],$row['MinKubun'],$row['RoomName']);                            
        }
        $res->closeCursor();
        $res = null;  
        $data['RowData'] = $dataRow;
                
        $dataCell = array();  //日付、部屋毎の残室数データ Array(部屋No, Array(日付,残数))
        $sql = "SELECT A.RoomNo,A.UseDate,A.OfferCount - A.UseCount AS Remain 
FROM d_offer A 
LEFT JOIN m_roomtype B ON A.RoomTypeNo = B.RoomTypeNo";
        if($type > 0) { $sql .= " LEFT JOIN m_room C ON A.RoomNo = C.RoomNo "; }
        $sql .= " WHERE A.UseDate BETWEEN '$sqlBegindate' AND '$sqlEnddate'
  AND B.RoomKind = 2 ";
        if($type > 0) { $sql .= " AND C.SectionNo=$type "; }
        $sql .= " ORDER BY A.RoomNo,A.UseDate";
        $res = $db->query($sql);
        $res->setFetchMode(PDO::FETCH_BOTH);
        while ($row = $res->fetch()) {
            $roomNo = $row['RoomNo'];
            $usedate = $row['UseDate'];
            $remain = (int)$row['Remain'];
            $dataCell[$roomNo][$usedate] = $remain;            
        }
        $res->closeCursor();
        $res = null;        
        $data['CellData'] = $dataCell;        
        return $data;
    }

    public static function GetRoomList($begindate,$enddate)
    {
        $obj = MySqlAccess::GetInstance();
        $data = array();
        $sqlBegindate = str_replace('/', '', $begindate);
        $sqlEnddate = str_replace('/', '', $enddate);        
        $sql = "SELECT A.RoomTypeNo,A.RoomTypeName,Capacity
FROM m_roomtype A
WHERE A.RoomKind = 1
ORDER BY A.RoomTypeNo";

        $dataRow = array(); //Array(RoomTypeNo, RoomTypeName)        
        $db = $obj->GetConnect();
        $res = $db->query($sql);
        $res->setFetchMode(PDO::FETCH_BOTH);
        while ($row = $res->fetch()) {
            $roomNo = $row['RoomTypeNo'];
            //$dataRow[$roomNo] = $row['RoomTypeName'];    
            $dataRow[$roomNo] = $row;    
        }
        $res->closeCursor();
        $res = null;  
        $data['RowData'] = $dataRow;
                
        $dataCell = array();  //日付、部屋毎の残室数データ Array(RoomTypeNo, Array(日付,残数))
        $sql = "SELECT A.RoomTypeNo,A.UseDate,A.OfferCount - A.UseCount AS Remain 
FROM d_offer A 
LEFT JOIN m_roomtype B ON A.RoomTypeNo = B.RoomTypeNo
WHERE A.UseDate BETWEEN '$sqlBegindate' AND '$sqlEnddate'
  AND B.RoomKind = 1
ORDER BY A.RoomTypeNo,A.UseDate";
        $res = $db->query($sql);
        $res->setFetchMode(PDO::FETCH_BOTH);
        while ($row = $res->fetch()) {
            $roomNo = $row['RoomTypeNo'];
            $usedate = $row['UseDate'];
            $remain = (int)$row['Remain'];
            $dataCell[$roomNo][$usedate] = $remain;            
        }
        $res->closeCursor();
        $res = null;        
        $data['CellData'] = $dataCell;
        return $data;
    }    

    public static function AddResvStatus($useDate,$resvID)
    {
        $db = MySqlAccess::GetInstance();
        $sql = "INSERT INTO d_resvstatus(ResvID,UseDate,Status,BeginDate,UpdateDate) VALUES($resvID,'$useDate',0,NOW(),NOW())";
        $db->ExecuteNonQuery($sql);
        Environment::Writelog('info','AddResvStatus('.$useDate.','.$resvID.')');
    }
    
    public static function SetStatus($resvID,$status,$errNo,$errMsg)
    {
        $count = MySqlAccess::GetInstance()->ExecuteNonQuery("UPDATE d_resvstatus SET Status=$status,UpdateDate=NOW(),ErrNo=$errNo,ErrMsg='$errMsg' WHERE ResvID='$resvID'");
        Environment::Writelog('info','SetStatus('.$resvID.','.$status.','.$errNo.','.$errMsg.')');
        return $count;
    }    
    
    public static function GetStatus($resvID)
    {
        $resvStatus =  MySqlAccess::GetInstance()->GetRowField("SELECT Status FROM d_resvstatus WHERE ResvID='$resvID'");
        return $resvStatus;
    }
    
    public static function GetRemain($resvDetail)
    {
        $sql = "SELECT OfferCount-UseCount FROM d_offer WHERE UseDate='$resvDetail->UseDate' AND RoomTypeNo=$resvDetail->RoomTypeNo AND RoomNo=$resvDetail->RoomNo";
        $remain = Convert::ToInt(MySqlAccess::GetInstance()->GetRowField($sql));
        return $remain;
    }
}
