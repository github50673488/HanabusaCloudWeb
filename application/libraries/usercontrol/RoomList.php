<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//require_once  APPPATH.'libraries/usercontrol/HallRow.php';
/**
 * Description of DBAccess
 *
 * @author Administrator
 */
class RoomList {
    public $BeginDate;
    public $MonCount = 1;

    public function __construct (Array $data) 
    {
        $this->BeginDate = $data['BeginDate'];
        $this->MonCount = $data['MonCount'];
    }

    private function DrawHeader()
    {
        $obj = &get_instance();
        $text = '';            
        //ヘッダー
        $thead = new CTable();
        $thead->Class= "thead";

        $tbodyHead = new TBody();
        $thead->TBody = $tbodyHead;

        //年月                            
        $col = new Col();
        $col->Width = "200px";
        $thead->Col[] = $col;

        $tr = new TR();   //日付
        $trWeek = new TR();   //曜日

        $beginMon = date ("Y年m月", strtotime($this->BeginDate));
        $th = new TH();
        $th->Rowspan = 2;
        $th->Text = $beginMon;
        $tr->Item[] = $th; 

        //一か月分
        // Start date
        $date = $this->BeginDate;
        // End date +1 months
        $enddate = date ("Y/m/d", strtotime("-1 day",strtotime("+1 months", strtotime($date))));
        $holidays =$obj->common->get_holidays_from_file();
        while (strtotime($date) <= strtotime($enddate)) {
            $usedate = date ("d", strtotime($date));  //日

            //各日付
            $col = new Col();
            $col->Width = "30px";
            $thead->Col[] = $col;

            //日付列の追加    
            $weekid = $obj->common->GetWeekID($date);
            $weekname = $obj->common->GetWeekName($weekid);

            $th = new TH();                
            $tr->Item[] = $th;             

            $th1 = new TH();
            $trWeek->Item[] = $th1;                         

            if($weekid == 6){
                //土曜日
                $th->Text = '<span class="SaturdayColor">'.$usedate.'</span>';                    
                $th1->Text = '<span class="SaturdayColor">'.$weekname.'</span>';
            } else  if($weekid == 0||$obj->common->isHoliday($holidays,$date)){
                //日曜日
                $th->Text = '<span class="SundayColor">'.$usedate.'</span>';                    
                $th1->Text = '<span class="SundayColor">'.$weekname.'</span>';                    
            } else {
                $th->Text = $usedate;                    
                $th1->Text = $weekname;    
            }

            //if (array_key_exists('first', $search_array)) {
            //    echo "The 'first' element is in the array";
            //}

            $date = date ("Y/m/d", strtotime("+1 day", strtotime($date)));
        }
        
        //最後列
        $col = new Col();
        $thead->Col[] = $col;
        
        $th = new TH();
        $th->Text = "&nbsp;";
        $tr->Item[] = $th;             

        $th = new TH();
        $th->Text = "&nbsp;";
        $trWeek->Item[] = $th;                         

        $tbodyHead->TR[] = $tr;  //日付
        $tbodyHead->TR[] = $trWeek;  //曜日

        $text .= $thead->Render();  //ヘッダー内容表示
        //$text .= '</div><!-- #scrollTable -->';
        return $text;
    }
    


    private function  DrawBody()
    {                
        $obj = &get_instance();       
        //一か月分
        // Start date
        $begindate = $this->BeginDate;
        // End date +1 months
        $enddate = date ("Y/m/d", strtotime("-1 day",strtotime("+1 months", strtotime($begindate))));
        
        $data = ResvAccess::GetRoomList($begindate,$enddate);
        
        $text = "<div>\n";            
        //ヘッダー
        $table = new CTable();
        $table->Class= "tbody";
        //年月                       
        $col = new Col();
        $col->Width = "200px";
        $table->Col[] = $col;

        $firstRow = TRUE;
        $tbody = new TBody();
        $table->TBody = $tbody;
        foreach ($data['RowData'] as $roomTypeNo => $roomInfo) {                    
            $tr1 = new TR();   //行1
            $tr2 = new TR();   //行2
                        
            //年月
            $td = new TD(); 
            $td->Rowspan = 2;

            $td->Text = $roomInfo['RoomTypeName']."<br>(定員:".$roomInfo['Capacity']."名まで)";
            $tr1->Item[] = $td;                                 
                                               
            //一か月分
            $date = $begindate;
            while (strtotime($date) <= strtotime($enddate)) {
                $usedate = date ("Ymd", strtotime($date));  //日
                
                //各日付
                if($firstRow)
                {
                    $col = new Col();
                    $col->Width = "30px";
                    $table->Col[] = $col;
                }

                //○ or × or －
                $td = new TD(); 
                $td2 = new TD(); 
                if (isset($data['CellData'][$roomTypeNo][$usedate]) && Convert::ToInt($data['CellData'][$roomTypeNo][$usedate]) > 0) {
                        $td->Text =  $data['CellData'][$roomTypeNo][$usedate];
                        $td2->ID = 'td'.$usedate.'_'.$roomTypeNo;
                        $td2->Text = '<input type="checkbox" id="'.$usedate.'_'.$roomTypeNo.'" name="chk['.$usedate.'_'.$roomTypeNo.']" value="'.$roomTypeNo.'">';                 
                } else {
                    $td->Text = "－";
                    $td2->ID = "";
                    $td2->Text = "";
                }                                
                $tr1->Item[] = $td;                  
                $tr2->Item[] = $td2;    
                
                $date = date ("Y/m/d", strtotime("+1 day", strtotime($date)));
            }
        
            $col = new Col();
            $tbody->Col[] = $col;
            
            $td = new TD(); 
            $td->Text = "&nbsp;";
            $tr1->Item[] = $td;

            $td = new TD(); 
            $td->Text = "&nbsp;";
            $tr2->Item[] = $td;
            
            $tbody->TR[] = $tr1;
            $tbody->TR[] = $tr2;
            $firstRow = FALSE;
        }
        
        $text .= $table->Render();       
        $text .= "</div>\n";            
        return $text;
    }

    public function Render()
    {
        try
        {  
            $text = '<div id="scrollTable">'."\n";
            $text .= $this->DrawHeader();
            $text .= $this->DrawBody();
            $text .= "</div>\n";
            return $text;
        } catch (Exception $e) {
           return '';
        }         
    }    
}

?>
