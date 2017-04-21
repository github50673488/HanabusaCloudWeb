<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HallListVC
 *
 * @author Administrator
 */
class ResvFinishVC extends BaseVC {
    
    public $ActionMode;

    public function __construct ($actionMode) 
    {
        $this->ActionMode = $actionMode;
    }    
    
     public function IsValid($resvData) {
         try {
            //更新成功、失敗？ 
             
            return TRUE;
         } catch (Exception $ex) {
             $this->ErrNo = $ex->getCode();
             $this->ErrMsg = $ex->getMessage();
             return FALSE;
         }
        
    }
            
    public function GetFromPost($resvData) {
    }
    


    public function GetHeader() {
        $CI = &get_instance(); 
        $headData['actionMode'] =  $this->ActionMode;
        $headData['title'] = "【国立女性教育会館】予約完了";
        $headData['filelist'] = '<script type="text/javascript" language="javascript"> 
function CloseWebPage() {  
    if (navigator.userAgent.indexOf("MSIE") > 0) {  
        if (navigator.userAgent.indexOf("MSIE 6.0") > 0) {  
            window.opener = null; window.close();  
        }  
        else {  
            window.open("", "_top"); window.top.close();  
        }  
    }  
    else if (navigator.userAgent.indexOf("Firefox") > 0 || navigator.userAgent.indexOf("Chrome") > 0) {  
        window.location.href = "about:blank"; //火狐默认状态非window.open的页面window.close是无效的 
        //window.history.go(-2);  
    }  
    else {  
        window.opener = null;   
        window.open("", "_self", "");  
        window.close();  
    }  
}  
</script>
';
        return $headData;
    }

    public function Show($resvData) {
        $CI = &get_instance();  
        $bodyData['baseUrl'] = $CI->config->item('base_url');  
        $bodyData['bodyText'] = (($this->ActionMode == Key_ResvDupl) ? '当該予約もう既に完了しました。<br>再度予約を取る場合、トップページへ戻ってください。' : '予約完了しました<br>メールを確認してください。');
        $CI->load->view('resvfinish',$bodyData);                   
    }
}