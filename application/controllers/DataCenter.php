<?php

//function __autoload($class_name) { require_once  '/../libraries/'.$class_name.'.php'; }
defined('BASEPATH') OR exit('No direct script access allowed');

function __autoload($class_name) {
    $filepath = array('libraries/component/', 'libraries/data/', 'libraries/model/', 'libraries/usercontrol/', 'libraries/util/', 'libraries/viewcore/');
    foreach ($filepath as $value) {
        $filename = APPPATH . $value . $class_name . '.php';
        if (file_exists($filename)) {
            require_once($filename);
            break;
        }
    }
}

class DataCenter extends CI_Controller {

    /**
      $type == 2 -----tooltip取得
     */
    public function index($type = 0) {
        if ($type == 2) {
            $roomID = $this->uri->segment(3);
            $memo = MasterAccess::GetRoomMemo($roomID);
            $memo = str_replace("\r\n", "<br>", $memo);
            echo "<span>$memo</span>";
            return;
        }


        /*
          $userid = $this->input->post('UserId');
          $password = $this->input->post('Password');
          header("Content-Type:text/html");
          if($userid != API_USERID) {
          echo 'ErrorNo=1,ErrMsg=ユーザーID不正';
          return;
          } else if($password != API_PASSWORD) {
          echo 'ErrorNo=2,ErrMsg=パスワード不正';
          return;
          }
         */

        if ($type == 0) {
            $this->_GetResvData();
        } else if ($type == 1) {
            $this->_SetResvFinish();
        } else if ($type == 3) {
            $this->_SetAdjustment();
        } else if ($type == 4) {
            $this->_SaveHolidaySettingFile();
        } else {
            $grade = array("score" => array(70, 95, 70.0, 60, "70"), "name" => array("Zhang San", "Li Si", "Wang Wu", "Zhao Liu", "TianQi"));
            $result = Response::Show(200, 'success', $grade, 'json');
            print_r($result);
        }
    }

    private function _SetAdjustment() {
        if (ResvAccess::SetAdjustment() == TRUE) {
            echo '0';
        } else {
            echo '1,Error';
        }
    }

    private function _SaveHolidaySettingFile() {
        if (ResvAccess::_SaveHolidaySettingFile() == TRUE) {
            echo '0';
        } else {
            echo '1,Error';
        }
    }

    private function _SetResvFinish() {
        if (ResvAccess::SetResvFinish() == TRUE) {
            echo '0';
        } else {
            echo '1,Error';
        }
    }

    private function _GetResvData() {
        $data = ResvAccess::GetResvData();
        print_r($data);
    }

}
