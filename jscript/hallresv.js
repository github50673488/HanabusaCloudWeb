/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function currentDate(){
     var d=new Date(),str='';
     str +=d.getFullYear()+'/';   //获取当前年份
     var m=d.getMonth()+1;
     str +=(m>9?m:("0"+m))+'/';   //获取当前月份（0——11）
     var d=d.getDate(); 
     str +=(d>9?d:("0"+d))
     return str; 
}

function dateFormat(obj,flg){
	var str0=obj.value
	if(flg){
	if(str0==""){
	return
	}else if(str0.match(/[0-9]{8}/)){
	str1=str0.substring(0,4)+"/"+str0.substring(4,6)+"/"+str0.substring(6,8)
	obj.value=str1
	}else{
	//alert("８桁の数字を入力してください")
	//obj.value="";
	}
	}else{
	//str1=str0.split("/").join("");
	//obj.value=str1
	}
}






