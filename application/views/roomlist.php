<div id="dataArea">
<?php echo form_open($baseUrl, array( 'id' => 'RoomDataForm','onkeydown' => 'if(event.keyCode==13){return false;}' )); ?>    
<div id="divRoomSearch">
    <table id="tabRoomSearch">
          <tr>
            <td width="7%"><label for="BeginDate">開始日</label></td>
            <td width="16%" align="left"><input id="BeginDate" name="BeginDate" type="text" value="<?php echo $usedate; ?>" maxlength="10" onBlur="dateFormat(this,true)" onFocus="dateFormat(this,false)"/></td>
            <td width="11%" align="left"><input type="submit" value="検索" id="RoomSearch" name="RoomSearch" class="buttonstyle"/></td>             
            <td width="13%">空き状況</td>
            <td width="53%" align="left">数字は部屋の残室数になります。</td>            
          </tr>
    </table>
</div>
<div id="divSplit1"></div>
<?php echo $Msg; ?>
<div id="divRoomData">
    <div id="divMsgOwner">
    	<div id="divStepBar">施設空き状況 >> 施設情報入力 >> <span style="color:#F00">宿泊空き状況</span> >> 宿泊情報入力 >> 利用者情報入力 >> 申込確認 >> 申込完了</div>
        <div id="divFunctionBar">
                <input type="submit" value="前へ" id="HallInputBack" name="HallInputBack" class="buttonstyle"/>
                <input type="submit" value="次へ" id="RoomInput" name="RoomInput" class="buttonstyle"/>
              </tr>
            </table>            
        </div>        
    </div>
    <?php echo $listData; ?> 
    <?php echo $hiddenData; ?>    
</div><!-- divRoomData --> 
<?php echo form_close(); ?>
</div><!-- dataArea --> 
