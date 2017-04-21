<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function __autoload($class_name) 
{ 
    $filepath = array('libraries/component/','libraries/data/','libraries/model/','libraries/usercontrol/','libraries/util/','libraries/viewcore/');
    foreach ($filepath as $value) {
        $filename = APPPATH.$value.$class_name.'.php'; 
        if(file_exists($filename)) { require_once($filename); break; }
    }
    require_once('../CloudWeb/DBApi.class.php');
    require_once('../CloudWeb/db.class.php');
}

class Main extends CI_Controller {


	public function index($index = 0)
	{
            Environment::Initialize($index);    
            
//            $CI = &get_instance();
//            $loginData['assets_url'] = $CI->config->item('assets_url');
            
//        $DBApi = new DBApi ();
//        $LoginUser = 'navc2-debug';
//        $LoginPwd = 'navc2-debug';
//        $ApiLoginReq = new stdClass ( );
//        $ApiLoginReq->LoginUser = $LoginUser;
//        $ApiLoginReq->LoginPwd = $LoginPwd;
//        $Req = new stdClass ( );
//        $Req->arg0 = $ApiLoginReq;
//        $ApiResult = $DBApi->Login($Req);
//        $ApiReturn = $ApiResult->return;
            
            
        $ApiLoginReq = new stdClass ( );
	$ApiLoginReq->LoginUser ='navc2-debug';
	$ApiLoginReq->LoginPwd = 'navc2-debug';
	$ApiLoginReq->sql ='select * from m_person;';
	$ApiLoginReq->IsSuperDB ='False';
	$Req = new stdClass ( );
	$Req->arg0 = $ApiLoginReq;
        $DBApi = new DBApi ();
	$ApiResult = $DBApi->GetDataTable ( $Req );
	$ApiReturn = $ApiResult->return;
            
	
            $loginData=null;
            $this->load->view('login',$loginData);
             
            Environment::Dispose();
	}

	/**
	 * 会場予約空き状況表示
         * $actionMode
         * 10.HallSearch or null or HallBack：null ⇒ 施設空き状況予約
         * 20.HallInput 施設空き状況 ⇒ 予約会場予約入力
         * 30.RoomResv 予約会場予約入力 ⇒ 宿泊空き状況予約 
         * 40.RoomInput 宿泊空き状況予約 ⇒ 宿泊予約入力
         * 50.UserInput 宿泊予約入力 ⇒ 利用者予約入力
         * 60.ResvConfirm 利用者予約入力 ⇒ 予約確認
         * 70.ResvFinish  予約確認 ⇒ 予約完了
	 */        
        private function _GetActionMode()
        {
            $actionMode = Key_Menu;
            $submitKey = $this->input->post('HallSearch');
            if(isset($submitKey)) { $actionMode = Key_HallSearch; return $actionMode; }
            
            $submitKey = $this->input->post('HallInput');
            if(isset($submitKey)) { $actionMode = Key_HallInput; return $actionMode; }

            $submitKey = $this->input->post('HallDel');
            if(isset($submitKey)) { $actionMode = Key_HallDel; return $actionMode; }            
            
            $submitKey = $this->input->post('HallBack');
            if(isset($submitKey)) { $actionMode = Key_HallBack; return $actionMode; }
            
            $submitKey = $this->input->post('UserInputH');
            if(isset($submitKey)) { $actionMode = Key_UserInputH; return $actionMode; }           
            
            $submitKey = $this->input->post('RoomSearch');
            if(isset($submitKey)) { $actionMode = Key_RoomSearch; return $actionMode; }
            
            $submitKey = $this->input->post('RoomList');
            if(isset($submitKey)) { $actionMode = Key_RoomList; return $actionMode; }

            $submitKey = $this->input->post('HallInputBack');
            if(isset($submitKey)) { $actionMode = Key_HallInputBack; return $actionMode; }
                        
            $submitKey = $this->input->post('RoomDel');
            if(isset($submitKey)) { $actionMode = Key_RoomDel; return $actionMode; }            
            
            $submitKey = $this->input->post('RoomBack');
            if(isset($submitKey)) { $actionMode = Key_RoomBack; return $actionMode; }
            
            $submitKey = $this->input->post('RoomInput');
            if(isset($submitKey)) { $actionMode = Key_RoomInput; return $actionMode; }

            $submitKey = $this->input->post('RoomSearch');
            if(isset($submitKey)) { $actionMode = Key_RoomSearch; return $actionMode; }
            
            $submitKey = $this->input->post('UserInputR');
            if(isset($submitKey)) { $actionMode = Key_UserInputR; return $actionMode; }

            $submitKey = $this->input->post('UserBackH');
            if(isset($submitKey)) { $actionMode = Key_UserBackH; return $actionMode; }

            $submitKey = $this->input->post('UserBackR');
            if(isset($submitKey)) { $actionMode = Key_UserBackR; return $actionMode; }           
                                    
            $submitKey = $this->input->post('ResvConfirm');
            if(isset($submitKey)) { $actionMode = Key_ResvConfirm; return $actionMode; }

            $submitKey = $this->input->post('ResvConfirmBack');
            if(isset($submitKey)) { $actionMode = Key_ResvConfirmBack; return $actionMode; }            
                        
            $submitKey = $this->input->post('ResvFinish');
            if(isset($submitKey)) { $actionMode = Key_ResvFinish; return $actionMode; }
            
            return  $actionMode;
        }

        /*
         * チェック失敗の場合、現在の画面に戻る
         */
        private function _GetNotValidAction($actionMode)
        {
            if($actionMode == Key_HallInput) {
                return Key_HallList;    
            } elseif ($actionMode == Key_RoomList || $actionMode == Key_HallBack || $actionMode == Key_UserInputH) {
                return Key_HallInput;
            } elseif ($actionMode == Key_RoomInput) {
                return Key_RoomList;                
            } elseif ($actionMode == Key_UserInputR || $actionMode == Key_RoomBack) {
                return Key_RoomInput;
            } elseif ($actionMode == Key_ResvConfirm) {
                return Key_UserInputR;     
            } elseif ($actionMode == Key_ResvFinish) {
                return Key_ResvConfirm;                                 
            }            
            return Key_HallList;
        }        
        
        /*
         * 現在の画面
         */
        private function _CreateCurrentViewCore($actionMode)
        {
            if($actionMode == Key_HallInput || $actionMode == Key_HallSearch) {
                return new HallListVC($actionMode);    
            } elseif ($actionMode == Key_HallBack || $actionMode == Key_HallDel || $actionMode == Key_RoomList || $actionMode == Key_UserInputH) {
                return new HallInputVC($actionMode);
            } elseif ($actionMode == Key_RoomInput || $actionMode == Key_HallInputBack || $actionMode == Key_RoomSearch) {
                return new RoomListVC($actionMode);
            } elseif ($actionMode == Key_RoomBack || $actionMode == Key_RoomDel || $actionMode == Key_UserInputR) {
                return new RoomInputVC($actionMode);                
            } elseif ($actionMode == Key_ResvConfirm || $actionMode == Key_UserBackH || $actionMode == Key_UserBackR) {
                return new UserInputVC($actionMode);                
            } elseif ($actionMode == Key_ResvFinish || $actionMode == Key_ResvConfirmBack) {
                return new ResvConfirmVC($actionMode);                                
            }

            return new MenuVC($actionMode);
        }

        /*
         * 次の画面
         */
        private function _CreateNextViewCore($actionMode)
        {
            if($actionMode == Key_HallList || $actionMode == Key_HallSearch || $actionMode == Key_HallBack) {
                return new HallListVC($actionMode);
            } elseif ($actionMode == Key_HallInput || $actionMode == Key_HallDel || $actionMode == Key_UserBackH  || $actionMode == Key_HallInputBack) {
                return new HallInputVC($actionMode);
            } elseif ($actionMode == Key_RoomList || $actionMode == Key_RoomBack || $actionMode == Key_RoomSearch) {
                return new RoomListVC($actionMode);
            } elseif ($actionMode == Key_RoomInput || $actionMode == Key_RoomDel || $actionMode == Key_UserBackR) {
                return new RoomInputVC($actionMode);
            } elseif ($actionMode == Key_UserInputR || $actionMode == Key_UserInputH || $actionMode == Key_ResvConfirmBack) {
                return new UserInputVC($actionMode);                
            } elseif ($actionMode == Key_ResvConfirm) {
                return new ResvConfirmVC($actionMode);                                
            } elseif ($actionMode == Key_ResvFinish || $actionMode == Key_ResvDupl) {
                return new ResvFinishVC($actionMode);                                                
            }                                    
            return new MenuVC($actionMode);
        }                
}
