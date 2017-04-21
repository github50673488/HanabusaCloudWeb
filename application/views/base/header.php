<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<link href="<?php echo $baseUrl; ?>css/common.css" rel="stylesheet" media="all">

<script src="<?php echo $baseUrl; ?>jscript/jquery-1.12.0.js"></script>
<?php echo $filelist; ?>
<?php if($actionMode == Key_HallList || $actionMode == Key_HallSearch || $actionMode == Key_HallBack || $actionMode == Key_RoomList || $actionMode == Key_RoomBack || $actionMode == Key_RoomSearch) { ?>
<script src="<?php echo $baseUrl; ?>jscript/holidays.js"></script>
<script type="text/javascript" language="javascript">    
    $(document).ready(function() {
	$("input[type='checkbox']").change(function() {
		var $li = $(this);
		var idName = $li.eq(0).attr("id");
		if(idName == undefined) { return; }
		if(this.checked) {
			//var color = $("#BeginYear").css("background-color");
			$("#td" + idName).css('background-color','#e9d0a1');
		}
		else
		{
			$("#td" + idName).css('background-color','');
		}
	});
        

         $(function() {
            $("#BeginDate").datepicker({  
                beforeShowDay: function(date) {
                    for (var i = 0; i < holidays.length; i++) {
                        var htime = Date.parse(holidays[i]);
                    //alert(searchHolidays(date.getFullYear(), date.getMonth()+1));
                    //holidayajax='2016-03-02';
                   // var htime = Date.parse(holidayajax);    
                        var holiday = new Date();
                        holiday.setTime(htime);                
                        if (holiday.getYear() == date.getYear() &&
                            holiday.getMonth() == date.getMonth() &&
                            holiday.getDate() == date.getDate()) { return [true, 'holiday']; }
                                }
                                if (date.getDay() == 0) {
                                    return [true, 'sunday'];
                                        }
                                        if (date.getDay() == 6) {
                                            return [true, 'saturday'];
                                        }
                                        return [true, ''];
                                    }
                    });
                    $("#BeginDate").datepicker("option", "showOn", 'button');
                    $("#BeginDate").datepicker("option", "buttonImageOnly", true);
                    $("#BeginDate").datepicker("option", "buttonImage", '<?php echo $baseUrl; ?>images/ico_calendar.png');
                });
    
    <?php if($actionMode == Key_HallList || $actionMode == Key_HallSearch || $actionMode == Key_HallBack) { ?>
        $('.tooltip').tooltipster();
        $('[id^=my_tooltip]').tooltipster({
          theme: 'tooltipster-punk', position: 'right',
          content: '読込中...',
          functionBefore: function(origin, continueTooltip) {
              continueTooltip();
              if (origin.data('ajax') !== 'cached') {
                  $.ajax({
                      context:this,
                      type: 'GET',
                      url: '<?php echo $baseUrl."index.php/"; ?>get_tooltip/tooltipID/'+($(this).attr('id').substring( (($(this).attr('id').indexOf('my_tooltip'))+('my_tooltip'.length)))),
                      success: function(data) {
                         origin.tooltipster('content', $(data)).data('ajax', 'cached');
                         //origin.tooltipster('content', $(data));
                      }
                  });
              }
          }
        });
    <?php } ?>




    $("#BeginDate")[0].focus();    
        //var a=currentDate();
	//$("#BeginDate").val(a);
});
</script>
<link href="<?php echo $baseUrl; ?>css/datepicker.css" rel="stylesheet" media="all">
<?php } ?>

<?php if ($actionMode == Key_ResvConfirm) { ?>
   <script type="text/javascript" language="javascript">               
    $(document).ready(function() {
     $("#agree").prop("checked", false);
     $("#ResvFinish").prop("disabled", true);
               $('#agree').change(function(){
                    if($(this).prop('checked')) {
                            $('#ResvFinish').prop('disabled',false);
                            $('#ResvFinish').removeClass("btnreg").addClass("buttonstyle");
                    } else {
                            $('#ResvFinish').prop('disabled',true);
                            $('#ResvFinish').removeClass("buttonstyle").addClass("btnreg");
                    }
            });
    });

    </script>
<?php } ?>

</head>
<body>    
<div class="wrapper">
    <div id="header">
            <div class="w1200">
                    <div id="header-left">
                            <h1><a href="#"><img src="<?php echo $baseUrl; ?>images/logo.png" width="506" height="100" alt="独立行政法人国立女性教育会館・男女共同参画社会を実現するための推進機関" title="独立行政法人国立女性教育会館・男女共同参画社会を実現するための推進機関" /></a></h1>
                    </div><!-- #header-left -->
                    <div id="header-right"></div><!-- #header-right -->
                    <div style="clear: both;"></div>
            </div>
    </div><!-- #header -->
    <div id="divMenu">
            <nav role="navigation">
            <ul id="nav">                
                <li><a href="<?php echo $baseUrl; ?>">トップページ</a></li>
                <li><a href="<?php echo $baseUrl; ?>index.php/roomresv">宿泊予約</a></li>            
                <li><a href="https://www.nwec-bs.jp/?page_id=8">施設のご案内</a></li>                
                <li><a href="https://www.nwec-bs.jp/?page_id=10">ご利用方法</a></li>                    
                <li><a href="https://www.nwec-bs.jp/?page_id=12">ご利用料金</a></li>        
            </ul>
            </nav>
    </div>    