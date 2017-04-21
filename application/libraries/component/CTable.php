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
class CTable extends Element {
    public $Caption;
    public $TR = array();
    public $Col = array();
    public $ColGroup = array();
    public $Thead;
    public $TBody;
    public $TFoot;
    
    public function Render() {
        $inner = (isset($this->Caption) ? ('<caption>'.$this->Caption.'</caption>') : '');
        if(count($this->Col) > 0) {
            foreach ($this->Col as $value) {
                $inner = $inner.$value->Render();
            }
        }
        
        if(count($this->TR) > 0) {
            foreach ($this->TR as $value) {
                $inner = $inner.$value->Render();
            }
        }
                
        if(isset($this->Thead)) { $inner = $inner.$this->Thead->Render(); }        
        if(isset($this->TBody)) { $inner = $inner.$this->TBody->Render(); }
                
        $html = sprintf("<table%s>\n%s</table>\n",
                (isset($this->ID) ? (' id="'.$this->ID.'"') : '')
                .(isset($this->Name) ? (' name="'.$this->Name.'"') : '')
                .(isset($this->Class) ? (' class="'.$this->Class.'"') : ''),
                $inner);
        return $html;
    }    
}
