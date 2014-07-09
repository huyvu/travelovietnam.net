$(document).ready(	
	function() {
		var $container = $(".wt-container");	
		$container.wtScroller({
					num_display:4,
					slide_width:218,
					slide_height:160,
					slide_margin:10,
					button_width:35,
					ctrl_height:25,
					margin:10,	
					auto_scroll:false,
					delay:4000,
					scroll_speed:1000,
					easing:"",
					auto_scale:false,
					move_one:false,
					ctrl_type:"scrollbar",
					display_buttons:true,
					mouseover_buttons:false,
					display_caption:true,
					mouseover_caption:true,
					caption_effect:"slide",
					caption_align:"bottom",
					caption_position:"inside",					
					cont_nav:true,
					shuffle:false,
					mousewheel_scroll:true
				});
		
//		$("a[rel='scroller']").wtLightBox({
//			rotate:true,
//			delay:4000,
//			duration:600,
//			display_number:true,
//			display_dbuttons:true,
//			display_timer:true,
//			display_caption:true,
//			caption_position:"outside",
//			cont_nav:true,
//			auto_fit:true,
//			easing:"",
//			type:"GET"
//		});
	
		var $submitButton = $("#submit-btn");
		var $resetButton =  $("#reset-btn");
		var $ctrlTypes =	$("#ctrl-type");
		var $buttonsCB = 	$("#buttons-cb");
		var $captionCB = 	$("#caption-cb");
		var $hoverButtonsCB = $("#btnsmouseover-cb");
		var $hoverCaptionCB = $("#capmouseover-cb");
		var $captionEffects = $("#cap-effect");
		var $captionPositions =	$("#cap-position");
		var $scrollEasing = $("#easing");
		
		var $lightboxRB = $("input[name='lightbox-on']");
		var $rotateCB = 	$("#rotate-cb");
		var $textboxCB =	$("#text-cb");
		var $timerCB =		$("#timer-cb");
		var $numberCB =		$("#number-cb");
		var $dbuttonsCB = $("#dbuttons-cb");
		var $lbTextPositions = $("#text-pos");
		var $lightboxEasing = $("#lb-easing");

		var $panel = $(".panel");
		var $infoPanel = $(".info-section");
		var $desc = $(".description");
		
		$submitButton.click(function() {
			var vals = $captionPositions.val().split("_");
			$container.undoChanges()
					  .setCtrlType($ctrlTypes.val())
					  .setButtons($buttonsCB.prop("checked"))
					  .setBtnsMouseover($hoverButtonsCB.prop("checked"))
					  .setCaption($captionCB.prop("checked"))
					  .setCapMouseover($hoverCaptionCB.prop("checked"))
					  .setCapEffect($captionEffects.val())
					  .setCapPosition(vals[0], vals[1])
					  .setEasing($scrollEasing.val())
					  .updateChanges();
			
			if ($lightboxRB.filter(":checked").val() == "on") {
				$("a[rel='scroller']").wtLightBox({
					rotate:$rotateCB.prop("checked"),
					display_number:$numberCB.prop("checked"),
					display_dbuttons:$dbuttonsCB.prop("checked"),
					display_timer:$timerCB.prop("checked"),
					display_caption:$textboxCB.prop("checked"),
					easing:$lightboxEasing.val(),
					caption_position:$lbTextPositions.val()
				});
			}
			
			if ($buttonsCB.prop("checked") && !$hoverButtonsCB.prop("checked")) {
				$desc.width(680);
				$infoPanel.width(970);
				$panel.width(972);
			}
			else {
				$desc.width(610);
				$infoPanel.width(920);
				$panel.width(922);				
			}
			$panel.css("marginLeft", -Math.floor($panel.outerWidth()/2));
		});
		
		$resetButton.click(function() {
			init();
			$submitButton.trigger("click");
		});
		
		function init() {
			$ctrlTypes.val("scrollbar").attr("disabled", false);
			$buttonsCB.prop("checked",true).attr("disabled", false);
			$captionCB.prop("checked",true).attr("disabled", false);
			$hoverButtonsCB.prop("checked",false).attr("disabled", false);
			$hoverCaptionCB.prop("checked",true).attr("disabled", false);
			$captionEffects.val("slide").attr("disabled", false);
			$captionPositions.val("inside_bottom").attr("disabled", false);
			$scrollEasing.val("").attr("disabled", false);
			
			$("input#lightbox-yes").prop("checked", true).attr("disabled", false);
			$textboxCB.prop("checked",true).attr("disabled", false);
			$numberCB.prop("checked",true).attr("disabled", false);
			$dbuttonsCB.prop("checked",true).attr("disabled", false);
			$rotateCB.prop("checked",true).attr("disabled", false);
			$timerCB.prop("checked",true).attr("disabled", false);
			$lbTextPositions.val("outside").attr("disabled", false);
			$lightboxEasing.val("").attr("disabled", false);
		}
		
		$buttonsCB.change(
				function() {
					$hoverButtonsCB.attr("disabled", !$(this).prop("checked"));
				});
		
		$hoverCaptionCB.change(
				function() {
					$captionEffects.attr("disabled", !$(this).prop("checked"));
				});
		
		$captionPositions.change(
			function() {
				var vals = $(this).val().split("_");
				var disable = vals[0] == "outside";
				$hoverCaptionCB.attr("disabled", disable);
				$captionEffects.attr("disabled", disable || !$hoverCaptionCB.prop("checked"));
			}
		);
		
		$captionCB.change(
				function() {
					var vals = $captionPositions.val().split("_");
					var disable = !$(this).prop("checked");
					$captionEffects.attr("disabled", disable || vals[0] == "outside" || !$hoverCaptionCB.prop("checked"));
					$hoverCaptionCB.attr("disabled", disable || vals[0] == "outside");
					$captionPositions.attr("disabled", disable);
				});
		
		$lightboxRB.change(
				function() {
					var disable = $(this).filter(":checked").val() == "off";
					$textboxCB.attr("disabled", disable);
					$numberCB.attr("disabled", disable);
					$dbuttonsCB.attr("disabled", disable);
					$rotateCB.attr("disabled",  disable);
					$timerCB.attr("disabled",  disable || !$rotateCB.prop("checked"));
					$lbTextPositions.attr("disabled",  disable || !$textboxCB.prop("checked"));
					$lightboxEasing.attr("disabled", disable);
				});
		
		$textboxCB.change(
				function() {
					$lbTextPositions.attr("disabled",  !$(this).prop("checked"));
				});
		
		$rotateCB.change(
			function() {
				$timerCB.attr("disabled", !$(this).prop("checked"));
			}
		);	
		
		init();
	}
);