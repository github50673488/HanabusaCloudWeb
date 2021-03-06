<?php
//function __autoload($class_name) { require_once  APPPATH.'component/'.$class_name.'.php'; }
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Table
 *
 * @author Administrator
 */
class TD extends Element {
    public $Colspan = 0;
    public $Rowspan = 0;
    public $Title ;

    public function Render() {
        $html = sprintf("<td%s>%s</td>\n",
                (($this->Rowspan > 0) ? (' rowspan="'.$this->Rowspan.'"') : '') 
                .(($this->Colspan > 0) ? (' colspan="'.$this->Colspan.'"') : '') 
                .(isset($this->ID) ? (' id="'.$this->ID.'"') : '')
                .(isset($this->Name) ? (' name="'.$this->Name.'"') : '')
                .(isset($this->Class) ? (' class="'.$this->Class.'"') : '')
                .(isset($this->Title) ? (' title="'.$this->Title.'"') : '')
            ,
                (isset($this->Text) ? $this->Text : ''));
        return $html;
    }    
}
