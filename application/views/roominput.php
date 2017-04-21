<div id="dataArea">
<div id="divMsgOwner">
    <div id="divMsg" class="Message">施設空き状況 >> 施設情報入力 >> 宿泊空き状況 >> <span style="color:#F00">宿泊情報入力</span> >> 利用者情報入力 >> 申込確認 >> 申込完了</div>
</div><!-- #divMsgOwner -->  
<?php echo $Msg; ?>
<?php echo form_open('', array( 'id' => 'RoomDataForm','onkeydown' => 'if(event.keyCode==13){return false;}','autocomplete'=>'off' )); ?>    
<?php echo $listData; ?>
<?php echo $hiddenData; ?>
<div id="divStepOwner">
    <table style="width: 600px; text-align: center; margin: auto;">
      <tr>
        <td><input type="submit" value="前へ" id="RoomBack" name="RoomBack" class="buttonstyle"/></td>
        <td><input type="submit" value="次へ" id="UserInputR" name="UserInputR" class="buttonstyle"/></td>
      </tr>
    </table>
</div><!-- #divStepOwner -->  
<?php echo form_close(); ?>
<div style="clear: both;height:5px;"></div>
</div><!-- #dataArea -->  
