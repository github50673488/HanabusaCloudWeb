<div id="dataArea">
<div id="divStepOwner">
    <table style="width: 600px; text-align: center; margin: auto;">
      <tr><td height = "20px"></td></tr>
      <tr>
          <td><input type="button" value="宿泊のみ" class="buttonstyle" style="width: 500px; height: 100px; font-size: 48px" onClick="parent.location='<?php echo $baseUrl; ?>index.php/roomresv'"/></td>
      </tr>
      <tr><td height = "20px"></td></tr>
      <tr>
        <td><input type="button" value="研修のみ" class="buttonstyle" style="width: 500px; height: 100px; font-size: 48px" onClick="parent.location='<?php echo $baseUrl; ?>index.php/hallresv'"/></td>
      </tr>
      <tr><td height = "20px"></td></tr>
      <tr>
        <td><input type="button" value="宿泊・研修" class="buttonstyle" style="width: 500px; height: 100px; font-size: 48px" onClick="parent.location='<?php echo $baseUrl; ?>index.php/allresv'"/></td>
      </tr>      
    </table>
</div><!-- #divStepOwner -->  
</div><!-- #dataArea -->