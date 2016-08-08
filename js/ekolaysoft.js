
function login(){

		if($("#mail").val()==""){
			alert("Mail adresinizi yazınız");
		}else if($("#password").val()==""){
			alert("Lütfen Şifrenizi Yazınız");
		}else{
			

var veri = $("#LoGin").serialize();

$.post("inc/case.php?ido=101",veri,function(donenVeri){
                             var donen  =donenVeri;
                            
						if(donen=="1"){
							window.location.href="index.php"; 
						}else{
							alert(donen);
						}
					  
                            });	



		}


}