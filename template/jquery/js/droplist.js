$(function() {
	$('.ttpano').live({
        mouseover: function() {
            $(this).find('.ttpano-help').show();
        },
        mouseout: function() {
        	$(this).find('.ttpano-help').hide();
        },
        click: function() {
        	var url = $(this).find('a').attr('href');
        	if($.trim(url) == '') {
        		return
        	} else {
        		location.href = url;
        	}
        }
    });
});
$(document).ready(function(){
	/************* Our City ****************/
	$("#outLink").mouseover(function(){
		$("#dairyForm").attr('style','display:"none"');
		$("#mommentForm").attr('style','display:"none"');
		$("#insightForm").attr('style','display:"none"');
		
		if ($("#outForm").is(":hidden")){
			$("#outForm").slideDown("show");
		}
	});
	$("#outForm").mouseenter(function(){
    }).mouseleave(function(){
    	 if ($("#outForm").is(":hidden")){
 			$("#outForm").slideDown("show");
 		}
 		else{
 		}
    });
	
	$("#outLink").mouseenter(function(){
    }).mouseleave(function(){
    	 if ($("#outForm").is(":hidden") == false){	$("#outForm").attr("style","");}else{$("#outForm").attr("style","display:block");}
    });
	
	/************* City Momment ****************/
	$("#mommentLink").mouseover(function(){
		$("#dairyForm").attr('style','display:"none"');
		$("#outForm").attr('style','display:"none"');
		$("#insightForm").attr('style','display:"none"');
		
		//$("#mommentLink").attr('class','current');
		if ($("#mommentForm").is(":hidden")){
			$("#mommentForm").slideDown("show");
		}
	});
	$("#mommentForm").mouseenter(function(){
    }).mouseleave(function(){
    	 if ($("#mommentForm").is(":hidden")){
 			$("#mommentForm").slideDown("show");
 		}
 		else{
 		}
    });
	
	$("#mommentLink").mouseenter(function(){
    }).mouseleave(function(){
    	 if ($("#mommentForm").is(":hidden") == false){	$("#mommentForm").attr("style","");}else{$("#mommentForm").attr("style","display:block");}
    });

	/*************** Diary ****************************/
	$("#dairyLink").mouseover(function(){
		$("#mommentForm").attr('style','display:"none"');
		$("#outForm").attr('style','display:"none"');
		$("#insightForm").attr('style','display:"none"');
		
		if ($("#dairyForm").is(":hidden")){
			$("#dairyForm").slideDown("show");
		}
	});
	$("#dairyForm").mouseenter(function(){
    }).mouseleave(function(){
    	 if ($("#dairyForm").is(":hidden")){
 			$("#dairyForm").slideDown("show");
 		}
 		else{
 		}
    });
	
	$("#dairyLink").mouseenter(function(){
    }).mouseleave(function(){
    	 if ($("#dairyForm").is(":hidden") == false){	$("#dairyForm").attr("style","");}else{$("#dairyForm").attr("style","display:block");}
    });
	
	/************** City Insight ****************/
	$("#insightLink").mouseover(function(){
		$("#mommentForm").attr('style','display:"none"');
		$("#outForm").attr('style','display:"none"');
		$("#dairyForm").attr('style','display:"none"');
		if ($("#insightForm").is(":hidden")){
			$("#insightForm").slideDown("show");
		}
	});
	$("#insightForm").mouseenter(function(){
    }).mouseleave(function(){
    	 if ($("#insightForm").is(":hidden")){
 			$("#insightForm").slideDown("show");
 		}
 		else{
 		}
    });
	
	$("#insightLink").mouseenter(function(){
    }).mouseleave(function(){
    	 if ($("#insightForm").is(":hidden") == false){	$("#insightForm").attr("style","");}else{$("#insightForm").attr("style","display:block");}
    });
	
	$("#arrLink1").click(function(){
		$(this).attr("class","lessarr");						 
		if ($("#arrForm1").is(":hidden")){
			$("#arrForm1").slideDown("fast");
		}
		else{
			$("#arrForm1").slideUp("fast");
			$(this).attr("class","morearr");
		}
	});
	$("#arrLink2").click(function(){
		$(this).attr("class","lessarr");						 
		if ($("#arrForm2").is(":hidden")){
			$("#arrForm2").slideDown("fast");
		}
		else{
			$("#arrForm2").slideUp("fast");
			$(this).attr("class","morearr");
		}
	});
	$("#arrLink3").click(function(){
		$(this).attr("class","lessarr");						 
		if ($("#arrForm3").is(":hidden")){
			$("#arrForm3").slideDown("fast");
		}
		else{
			$("#arrForm3").slideUp("fast");
			$(this).attr("class","morearr");
		}
	});
	$("#arrLink4").click(function(){
		$(this).attr("class","lessarr");						 
		if ($("#arrForm4").is(":hidden")){
			$("#arrForm4").slideDown("fast");
		}
		else{
			$("#arrForm4").slideUp("fast");
			$(this).attr("class","morearr");
		}
	});
	$("#arrLink5").click(function(){
		$(this).attr("class","lessarr");						 
		if ($("#arrForm5").is(":hidden")){
			$("#arrForm5").slideDown("fast");
		}
		else{
			$("#arrForm5").slideUp("fast");
			$(this).attr("class","morearr");
		}
	});
	
	$("#tipLink1").mouseover(function(){
		if ($("#tipForm1").is(":hidden")){
			$("#tipForm1").slideDown(600);
		}

	});
	
	$(document.body).click(function(){
		if (!$(".tabletip").has(this).length) { // if the click was not within $box
			$("#tipForm1").hide();
		}
	});
	
	$("#tipLink2").mouseover(function(){
		if ($("#tipForm2").is(":hidden")){
			$("#tipForm2").slideDown(600);
		}
	});
	$(document.body).click(function(){
		if (!$(".tabletip").has(this).length) { // if the click was not within $box
			$("#tipForm2").hide();
		}
	});
	
});