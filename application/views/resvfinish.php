<div id="dataArea">
<div id="divMsgOwner">
    <div id="divMsg" class="Message">施設空き状況 >> 施設情報入力 >> 宿泊空き状況 >> 宿泊情報入力 >> 利用者情報入力 >> 申込確認 >> <span style="color:#F00">申込完了</span></div>
</div><!-- #divMsgOwner -->  
<div id="divHallData" align="center">
<p><?php echo $bodyText; ?></p>
</div><!-- #divHallData -->
<div id="divStepOwner">
    <table style="width: 400px; text-align: center; margin: auto;">
      <tr>
        <td><input type="button" value="トップページへ" class="buttonstyle" onClick="parent.location='<?php echo $baseUrl; ?>'"/></td>
        <!--<td><input type="button" value="閉じる" class="buttonstyle" onclick="CloseWebPage();"/></td>-->
      </tr>
    </table>
</div><!-- #divStepOwner -->  
</div><!-- #dataArea -->