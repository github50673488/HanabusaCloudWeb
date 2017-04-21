<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MsgBar
 *
 * @author Administrator
 */
class MsgBar {
    public $Msg;

    public function __construct (Array $data) 
    {
        $this->Msg = $data['Msg'];
    }
    
    public function Render()
    {
        /*
    <div id="divMsgOwner">
	    <div id="divRoomDataMenu"><input type="submit" value="予約" id="HallInput" name="HallInput" class="buttonstyle"/></div>
    	<div id="divMsg" class="Message"><span style="color:#F00">施設空き状況</span> >> 施設情報入力 >> 宿泊空き状況 >> 宿泊情報入力 >> 利用者情報入力 >> 予約確認 >> 予約完了</div>
    </div>    
         * */
        try
        {  
            $CI = &get_instance();  
            $text = '<div id="divMsgBar"><img src="'.$CI->config->item('base_url').'images/warn.png" alt="" width="40" height="44" class="flogo">'.$this->Msg.'</div>'."\n";
            return $text;
        } catch (Exception $e) {
           return '';
        }
    }
}
