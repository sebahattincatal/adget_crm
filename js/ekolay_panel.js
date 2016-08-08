function option_add(){
var veri = $("#optionADD").serialize();
$(".opt_sonuc").html("");
$(".opt_sonuc").hide();
$.post("inc/case.php?ido=102",veri,function(donenVeri){
                             var donen  =donenVeri;
                            
						
							$(".opt_sonuc").html(donen);
							$(".opt_sonuc").show();
						
					  
                            });	



}


function selectADD(){
	
var veri = $("#selectADD").serialize();
$(".opt_sonuc").html("");
$(".opt_sonuc").hide();

$.post("inc/case.php?ido=103",veri,function(donenVeri){
                             var donen  =donenVeri;
                            
					
							$(".opt_sonuc").html(donen);
							$(".opt_sonuc").show();
						
					  
                            });	



}