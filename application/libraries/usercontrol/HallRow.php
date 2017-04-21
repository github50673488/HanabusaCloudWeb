<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HallCell
 *
 * @author Administrator
 */
class HallRow {
    public $RoomNo;
    public $RoomID;
    public $Kubun;
    public $MinKubun;
    public $Count;
    public $RoomName;
    
    public function __construct ($roomNo,$cnt,$min,$name) 
    {
        $this->RoomNo = (int)$roomNo;
        $this->RoomID = (int)substr((string)$roomNo, 0,3);
        $this->Kubun = (int)substr((string)$roomNo, 3,1);
        $this->Count = (int)$cnt;
        $this->MinKubun = (int)$min;
        $this->RoomName = $name;
    }    
}
