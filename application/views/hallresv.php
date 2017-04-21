<div id="dataArea">
<?php echo form_open('', array( 'id' => 'RoomDataForm','onkeydown' => 'if(event.keyCode==13){return false;}' )); ?>    
<div id="divRoomSearch">
    <table id="tabRoomSearch">
          <tr>
            <td width="7%"><label for="BeginDate">開始日</label></td>
            <td width="16%" align="left"><input id="BeginDate" name="BeginDate" type="text" value="<?php echo $usedate; ?>" maxlength="10" onBlur="dateFormat(this,true)" onFocus="dateFormat(this,false)"/></td>            
            <td width="15%" align="left"><?php echo form_dropdown('BuildingType', $buildingList, $buildingType,'id="BuildingType"'); ?></td>            
            <td width="11%" align="left"><input type="submit" value="検索" id="HallSearch" name="HallSearch" class="buttonstyle"/></td>             
            <td width="10%" style="font-size: 14px">空き状況</td>
            <td width="39%" align="left" style="font-size: 14px">午前　9:00～12:00　午後　13:00～17:00　夜間　18:00～21:00<br>○：空室です。　×：満室です。</td>            
          </tr>
    </table>
</div>
<div id="divSplit1"></div>
<?php echo $Msg; ?>
<div id="divRoomData">    
    <div id="divMsgOwner">
    	<div id="divStepBar"><span style="color:#F00">施設空き状況</span> >> 施設情報入力 >> 宿泊空き状況 >> 宿泊情報入力 >> 利用者情報入力 >> 申込確認 >> 申込完了</div>
        <div id="divFunctionBar"><input type="submit" value="次へ" id="HallInput" name="HallInput" class="buttonstyle"/></div>        
    </div>
    <?php echo $listData; ?>
    <?php echo $hiddenData; ?>
</div><!-- divRoomData --> 
<?php echo form_close(); ?>
</div><!-- dataArea --> 
