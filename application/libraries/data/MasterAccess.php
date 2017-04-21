<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MasterAccess
 *
 * @author Administrator
 */
class MasterAccess {
    public static function GetRoomTypeNo($roomNo)
    {
        $obj = MySqlAccess::GetInstance();
        return $obj->GetRowField('SELECT RoomTypeNo FROM m_room WHERE RoomNo='.$roomNo);
    }
    
    public static function GetRoomMemo($roomNo)
    {
        $obj = MySqlAccess::GetInstance();
        return $obj->GetRowField('SELECT Memo FROM m_room WHERE RoomNo='.$roomNo);
    }
    
    public static function GetHallData($roomNo)
    {
        $obj = MySqlAccess::GetInstance();
        $row = $obj->GetDataRow('SELECT A.*,B.BasePrice FROM m_room A LEFT JOIN m_fee B ON B.FeeType = 0 AND A.RoomTypeNo = B.RoomTypeNo AND B.PersonCount = 1 WHERE A.RoomNo='.$roomNo);
        $room = new Room();
        $room->RoomNo = $roomNo;
        $room->RoomTypeNo = $row["RoomTypeNo"];
        $room->RoomName = $row["RoomName"];
        $room->Capacity = $row["Capacity"];
        $room->BasePrice = $row["BasePrice"];
        return $room;
    }
    
    public static function GetRoomTypeName($roomTypeNo)
    {
        $obj = MySqlAccess::GetInstance();
        return $obj->GetRowField('SELECT RoomTypeName FROM m_roomtype WHERE RoomTypeNo='.$roomTypeNo);
    }

    public static function GetFreeDataSet()
    {
        $obj = MySqlAccess::GetInstance();
        $ds = array();        
        $db = $obj->GetConnect();
        $rs = $db->query('SELECT TitleCode,Code,Name FROM m_freesummary ORDER BY TitleCode,Code');
        $rs->setFetchMode(PDO::FETCH_NUM);
        while ($row = $rs->fetch()) {
            $ds[$row[0]][$row[1]] = $row[2];
        }    
        $rs->closeCursor();
        $rs = null;        
        return $ds;
    }
    
    /*
     * Para: TitleCode,Code
     * Return: TitleCode,Name
     */
    public static function GetFreeDict($keyArray)
    {
        $obj = MySqlAccess::GetInstance();
        $ds = array();        
        $db = $obj->GetConnect();
        foreach ($keyArray as $key => $value) {
            $rs = $db->query("SELECT Name FROM m_freesummary WHERE TitleCode=$key AND Code=$value");
            $rs->setFetchMode(PDO::FETCH_NUM);
            $row = $rs->fetch();
            $ds[$key] = isset($row) ? $row[0] : '';            
            $rs->closeCursor();
            $rs = null;        
        }        
        return $ds;
    }
    
    public static function GetBasePrice($value)
    {
        $obj = MySqlAccess::GetInstance();
        $personCount = $value->Man + $value->Woman;
        $sql = "SELECT BasePrice FROM m_fee WHERE FeeType=0 AND RoomTypeNo=$value->RoomTypeNo AND PersonCount=$personCount";
        $basePrice = Convert::ToInt($obj->GetRowField($sql));     
        return $basePrice;
    }
}
