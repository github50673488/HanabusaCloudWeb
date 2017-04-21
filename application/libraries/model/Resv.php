<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Resv
 *
 * @author Administrator
 */
class Resv {
    public $Halls = array();  //<日付,<部屋番号,bean>>
    public $Rooms = array();  //<日付,<部屋タイプ番号,bean>>
    public $Details = array();
    public $ResvID = "";
    public $ResvNo = "";
    public $GroupKubun = 3;
    public $GroupName = "";
    public $GroupKana = "";
    public $Name = "";
    public $Kana = "";
    public $KnowReason = 8;
    public $GroupType = 1;
    public $PurposeType = 1;
    public $ZipCode = "";
    public $PrefectureID = 999;
    public $Prefecture = "その他";
    public $Address2 = "";
    public $Address3 = "";
    public $Address4 = "";
    public $Tel = "";
    public $PortableTel = "";
    public $Fax = "";
    public $Mail = "";
    public $CinTime = "";
    public $CoutTime = "";
    public $PurposeMemo = "";
    public $UpdateDate = "";
    public $Memo = "";
    public $BeforeName = "";
}
