/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
	$("#BeginYear")[0].focus();
	
	$("input[type='checkbox']").change(function() {
		var $li = $(this);
		var idName = $li.eq(0).attr("id");
		if(idName == undefined) { return; }
		if(this.checked) {
			//var color = $("#BeginYear").css("background-color");
			$("#td" + idName).css('background-color','#c9b176');
		}
		else
		{
			$("#td" + idName).css('background-color','');
		}
	});
});

