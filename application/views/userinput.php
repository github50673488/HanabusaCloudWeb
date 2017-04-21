<div id="dataArea">
<div id="divMsgOwner">
    <div id="divMsg" class="Message">施設空き状況 >> 施設情報入力 >> 宿泊空き状況 >> 宿泊情報入力 >> <span style="color:#F00">利用者情報入力</span> >> 申込確認 >> 申込完了</div>
</div><!-- #divMsgOwner -->  
<?php echo $Msg; ?>
<?php echo form_open('', array( 'id' => 'RoomDataForm' )); ?>
<div id="divHallData">
    <table id="tbInput" cellspacing="5px" width="1200px" style="table-layout:fixed">
  <tr>
    <td width="165" class="labelCol">会館を知った理由</td>
    <td width="250" class="inputCol"><?php echo form_dropdown('KnowReason', $FreeDs[2], $ResvData->KnowReason,'id="KnowReason"'); ?></td>
    <td width="170" class="inputCol"><div class="tips"><span class="txt-tips">（選択項目）</span></div></td>     
    <td width="160" class="labelCol">研修室前の表示名</td>
    <td width="250" class="inputCol"> <input type="text" name="BeforeName" value="<?php echo $ResvData->BeforeName; ?>" id="BeforeName" style="ime-mode: active;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/></td>
    <td  class="inputCol"><div class="tips"><span class="txt-tips">（全角漢字）</span></div></td>            
  </tr>
  <tr>
    <td class="labelCol">団体名称</td>
    <td class="inputCol">
        <input type="text" name="GroupName" value="<?php echo $ResvData->GroupName; ?>" id="GroupName" style="ime-mode: active;" class="textbox"  onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（全角漢字）</span></div></td>        
    <td class="labelCol">団体カナ</td>
    <td class="inputCol">
	    <input type="text" name="GroupKana" value="<?php echo $ResvData->GroupKana; ?>" id="GroupKana" style="ime-mode: active;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（全角カナ）</span></div></td>        
  </tr>
  <tr>
    <td class="labelCol"><span class="txtimpt">*</span>代表者名</td>
    <td class="inputCol">
	    <input type="text" name="Name" value="<?php echo $ResvData->Name; ?>" id="Name" style="ime-mode: active;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（全角漢字）</span></div></td>        
    <td class="labelCol"><span class="txtimpt">*</span>代表者カナ</td>
    <td class="inputCol">
	    <input type="text" name="Kana" value="<?php echo $ResvData->Kana; ?>" id="Kana" style="ime-mode: active;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（全角カナ）</span></div></td>        
  </tr>  
  <tr>
    <td class="labelCol"><span class="txtimpt">*</span>電話</td>
    <td class="inputCol">
	    <input type="text" name="Tel" value="<?php echo $ResvData->Tel; ?>" id="Tel" style="ime-mode: disabled;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（例：080-****-****）</span></div></td>        
    <td class="labelCol"><span class="txtimpt">*</span>携帯電話</td>
    <td class="inputCol">
	    <input type="text" name="PortableTel" value="<?php echo $ResvData->PortableTel; ?>" id="PortableTel" style="ime-mode: disabled;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（例：030-****-****）</span></div></td>        
  </tr>   
  <tr>
    <td class="labelCol">Fax</td>
    <td class="inputCol">
	    <input type="text" name="Fax" value="<?php echo $ResvData->Fax; ?>" id="Fax" style="ime-mode: disabled;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（例：030-****-****）</span></div></td>   
    <td>&nbsp;</td>     
    <td>&nbsp;</td>     
    <td>&nbsp;</td>     
  </tr>  
  <tr>
    <td class="labelCol"><span class="txtimpt">*</span>メール</td>
    <td class="inputCol">
	    <input type="email" name="Mail" value="<?php echo $ResvData->Mail; ?>" id="Mail" style="ime-mode: disabled;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（例：****@***.co.jp）</span></div></td>        
    <td class="labelCol"><span class="txtimpt">*</span>メールの確認</td>
    <td class="inputCol">
	    <input type="email" name="Mail2" value="" id="Mail2" autocomplete="off" style="ime-mode: disabled;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（例：****@***.co.jp）</span></div></td>        
  </tr>      
  <tr>
    <td class="labelCol">郵便番号</td>
    <td class="inputCol">
	    <input type="text" name="ZipCode" value="<?php echo $ResvData->ZipCode; ?>" id="ZipCode" style="ime-mode: disabled;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（数字）</span></div></td> 
    <td>&nbsp;</td>     
    <td>&nbsp;</td>     
    <td>&nbsp;</td>              
  </tr>  
  <tr>
    <td class="labelCol">都道府県</td>
    <td class="inputCol"><?php echo form_dropdown('Prefecture', $FreeDs[0], $ResvData->PrefectureID,'id="Prefecture"'); ?></td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（全角漢字）</span></div></td>        
    <td class="labelCol">市区町村</td>
    <td class="inputCol">
	    <input type="text" name="Address2" value="<?php echo $ResvData->Address2; ?>" id="Address2" style="ime-mode: active;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（全角漢字）</span></div></td>        
  </tr>
  <tr>
    <td class="labelCol">町域</td>
    <td class="inputCol">
	    <input type="text" name="Address3" value="<?php echo $ResvData->Address3; ?>" id="Address3" style="ime-mode: active;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（全角漢字）</span></div></td>        
    <td class="labelCol">番地</td>
    <td class="inputCol">
	    <input type="text" name="Address4" value="<?php echo $ResvData->Address4; ?>" id="Address4" style="ime-mode: active;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（全角漢字）</span></div></td>        
  </tr>   

  <tr>    
    <td class="labelCol">利用目的</td>
    <td class="inputCol" colspan="4">
        <input type="text"  name="PurposeMemo" value="<?php echo $ResvData->PurposeMemo; ?>" id="PurposeMemo" style="ime-mode: active;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（全角漢字）</span></div></td>                      
  </tr>   

  <tr>    
    <td class="labelCol">メモ</td>
    <td class="inputCol" colspan="4"><textarea name="Memo" cols="103" rows="3" wrap="hard"><?php echo $ResvData->Memo; ?></textarea></td>
    <td width="199" class="inputCol"><div class="tips"><span class="txt-tips">（全角漢字）</span></div></td>            
  </tr>  
  <tr>
    <td class="labelCol"><span class="txtimpt">*</span>入館時間</td>
    <td class="inputCol">
	    <input type="text" name="CinTime" value="<?php echo $ResvData->CinTime; ?>" id="CinTime" style="ime-mode: disabled;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（例：15:00）</span></div></td>   
    <td class="labelCol"><span class="txtimpt">*</span>退館時間</td>
    <td class="inputCol">
	    <input type="text" name="CoutTime" value="<?php echo $ResvData->CoutTime; ?>" id="CoutTime" style="ime-mode: disabled;" class="textbox" onkeydown="if(event.keyCode==13){return false;}"/>
    </td>
    <td class="inputCol"><div class="tips"><span class="txt-tips">（例：10:00）</span></div></td>   
  </tr>    
</table>
</div><!-- #divHallData -->  
<?php echo $hiddenData; ?>
<div id="divStepOwner">
    <table style="width: 400px; text-align: center; margin: auto;">
      <tr>
        <td><input type="submit" value="前へ" id="<?php echo $ActionMode; ?>" name="<?php echo $ActionMode; ?>" class="buttonstyle"/></td>
        <td><input type="submit" value="次へ" id="ResvConfirm" name="ResvConfirm" class="buttonstyle"/></td>
      </tr>
    </table>
</div><!-- #divStepOwner -->  
<?php echo form_close(); ?>
<div style="clear: both;height:5px;"></div>
</div><!-- #dataArea --> 