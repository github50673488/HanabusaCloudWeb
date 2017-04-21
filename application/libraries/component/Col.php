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
class Col extends Element {
    public function Render() {       
        $html = sprintf('<col%s></col>',
                (isset($this->ID) ? (' id="'.$this->ID.'"') : '')
                .(isset($this->Name) ? (' name="'.$this->Name.'"') : '')
                .(isset($this->Class) ? (' class="'.$this->Class.'"') : '')
                .(isset($this->Width) ? (' width="'.$this->Width.'"') : ''));
        return $html;
    }    
}
