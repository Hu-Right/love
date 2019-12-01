// JavaScript Document
var Dianji=0;
window.onload=function(){
	var buhao = document.getElementById("buhao");
	var hao = document.getElementById("hao");
	buhao.onclick=function(){
		Dianji++;
		if(Dianji==1){
	   			alert("小姐姐在考虑一下呗 www.0du520.com");
	   }else if(Dianji==2){
		   		alert("你是我见过的最帅气善良可爱的男孩 www.0du520.com");
		   		
	   }else if(Dianji==3){
		   		alert("一生一世爱你 www.0du520.com");
		   		
	   }else if(Dianji==4){
		   		alert("家务我全干 www.0du520.com");
		   		
	  }else if(Dianji==5){
		   		alert("不藏私房钱 www.0du520.com");
	  }else if(Dianji==6){
		   		alert("房子写你名 www.0du520.com");
	  }else if(Dianji==7){
		   		alert("工资全上交 www.0du520.com");
		  		Dianji=1;
	  }

	}
	hao.onclick=function(){
		alert("小姐姐终于同意了，我爱你  www.0du520.com");
	}
	

}