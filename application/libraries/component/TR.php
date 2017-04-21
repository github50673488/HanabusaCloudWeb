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
class TR extends Element {
    public $Item = array();
    
    public function Render() {
        $inner = '';
        foreach ($this->Item as $value) {
            $inner = $inner.$value->Render();
        }
        
        $html = sprintf("<tr%s>\n%s</tr>\n",
                (isset($this->ID) ? (' id="'.$this->ID.'"') : '')
                .(isset($this->Name) ? (' name="'.$this->Name.'"') : '')
                .(isset($this->Class) ? (' class="'.$this->Class.'"') : ''),
                $inner);
        return $html;
    }    
}
