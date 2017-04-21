<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HallInput
 *
 * @author Administrator
 */
class RoomInput {
    public $ResvData;
    public $ReadOnly;

    public function __construct (Array $data) 
    {
        $this->ResvData = $data['ResvData'];
        $this->ReadOnly = $data['ReadOnly'];
    }
    
    public function Render()
    {
        try
        {  
            $obj = &get_instance();  
            //$text = '<div id="divHallData">'."\n";
            $text = $this->ReadOnly ? '' : ('<div id="divHallData">'."\n");
            $table = new  CTable();
            if($this->ReadOnly == FALSE) { $table->Class = "gradient-style"; }
            $table->Caption = '<span style="color:#F00;font-size:18px;height:30px;">＜＜宿泊予約情報＞＞</span>';
            $thead = new THead();
            $table->Thead = $thead;
            
            $tr = new TR();
            $thead->TR[] = $tr;
            
            if($this->ReadOnly) {
                $nameArr = array('宿泊日' => '100','部屋タイプ' => '300','部屋数' => '80', '男性人数' => '80', '女性人数' => '80', '料金' => '100', '未就学児' => '80', '朝食数' => '80', '昼食数' => '80', '夕食数' => '80');
            } else {
                $nameArr = array('宿泊日' => '100','部屋タイプ' => '300','部屋数' => '80', '男性人数' => '80', '女性人数' => '80', '未就学児' => '80', '朝食数' => '80', '昼食数' => '80', '夕食数' => '80', '&nbsp;' => '100'  );
            }
            foreach ($nameArr as $key => $value) {
                $th = new TH();
                $tr->Item[] = $th;
                $th->Scope = "col";
                $th->Width = $value."px";
                $th->Text = $key;                
            }

            $tbody = new TBody();
            $table->TBody = $tbody;
            //データ
            foreach ($this->ResvData->Rooms as $list) {
                foreach ($list as $value) {  
                    $tr = new TR();
                    $tbody->TR[] = $tr;                
                    //利用日
                    $td = new TD();
                    $tr->Item[] = $td;
                    $td->Text = $obj->common->FormatDate($value->UseDate);

                    //部屋名
                    $td = new TD();
                    $tr->Item[] = $td;
                    $td->Text = $value->RoomName;

                    //部屋数
                    $td = new TD();
                    $tr->Item[] = $td;
                    if($this->ReadOnly) { $td->Class = "rightAlign"; }
                    $td->Text = $this->ReadOnly ? $value->RoomCount : ('<input type="number" name="RoomCount[]" value="'.Convert::ToFormText($value->RoomCount).'" id="RoomCount" min="1" max="999" size="3"/>');

                    //男性
                    $td = new TD();
                    $tr->Item[] = $td;
                    if($this->ReadOnly) { $td->Class = "rightAlign"; }
                    $td->Text = $this->ReadOnly ? $value->Man : ('<input type="number" name="ManCount[]" value="'.Convert::ToFormText($value->Man).'" id="ManCount" min="0" max="999"/>');       

                    //女性
                    $td = new TD();
                    $tr->Item[] = $td;
                    if($this->ReadOnly) { $td->Class = "rightAlign"; }
                    $td->Text = $this->ReadOnly ? $value->Woman : ('<input type="number" name="WoManCount[]" value="'.Convert::ToFormText($value->Woman).'" id="WoManCount" min="0" max="999"/>');    
                    
                    //未就学児
                    $td = new TD();
                    $tr->Item[] = $td;
                    if($this->ReadOnly) { $td->Class = "rightAlign"; }
                    $td->Text = $this->ReadOnly ? $value->Child : ('<input type="number" name="ChildCount[]" value="'.Convert::ToFormText($value->Child).'" id="ChildCount" min="0" max="999"/>');
                    
                    //朝食
                    $td = new TD();
                    $tr->Item[] = $td;
                    if($this->ReadOnly) { $td->Class = "rightAlign"; }
                    $td->Text = $this->ReadOnly ? $value->Meal1 : ('<input type="number" name="Meal1Count[]" value="'.Convert::ToFormText($value->Meal1).'" id="Meal1Count" min="0" max="999"/>');
                    
                    //昼食
                    $td = new TD();
                    $tr->Item[] = $td;
                    if($this->ReadOnly) { $td->Class = "rightAlign"; }
                    $td->Text = $this->ReadOnly ? $value->Meal2 : ('<input type="number" name="Meal2Count[]" value="'.Convert::ToFormText($value->Meal2).'" id="Meal2Count" min="0" max="999"/>');
                    
                    //夕食
                    $td = new TD();
                    $tr->Item[] = $td;
                    if($this->ReadOnly) { $td->Class = "rightAlign"; }
                    $td->Text = $this->ReadOnly ? $value->Meal3 : ('<input type="number" name="Meal3Count[]" value="'.Convert::ToFormText($value->Meal3).'" id="Meal3Count" min="0" max="999"/>');

                    //削除
                    if($this->ReadOnly) {
                        //料金計算
                        $basePrice = MasterAccess::GetBasePrice($value);    
                        $value->TotalSummary = $basePrice * $value->RoomCount; 
                        
                        $td = new TD();
                        $tr->Item[] = $td;
                        $td->Class = "rightAlign";
                        $td->Text = number_format($value->TotalSummary);                                  
                    } else {
                        $td = new TD();
                        $tr->Item[] = $td;
                        $td->Text = '<input type="submit" value="削除" name="RoomDel['.$value->UseDate.'_'.$value->RoomTypeNo.']" class="buttonstyle" id="DelBtn"/>';                                  
                    }
                }
            }                                               
            $text .= $table->Render();       
            if(!$this->ReadOnly) { $text .= "</div><!-- #divHallData -->\n"; }
            return $text;
        } catch (Exception $e) {
           return '';
        }         
    } 
}
