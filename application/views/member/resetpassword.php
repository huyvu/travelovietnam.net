<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>member.css" />
<script type="text/javascript" src="<?=JS_URL?>myaccount.js"></script>
<div class="maincontent">
	<div class="info-bar">
		<div class="ico"></div>
		<h1>Forgot Password</h1>
	</div><!-- .info-bar -->
	<div class="reset-pass-wrap">
		<div id="reset-pass">
			<? if ($this->session->flashdata('reset_error')) { ?>
				<div class="msgbox-error"><?=$this->session->flashdata('reset_error')?></div>
			<? } ?>
			<h1>Forgot your password ?</h1>
			<label for="email">Enter your email address</label>
			<form name="frmReset" id="frmReset" method="POST" action="<?php echo site_url('member/resetpassword') ?>">
				<p>
					<input type="text" id="email" name="email" >
				</p>
				<p>
					<input type="button" name="btnReset" id="btnReset" value="Submit">	
				</p>
				<div class="clr"></div>
			</form>

		</div><!-- reset-pass -->
	</div><!--/.reset-pass-wrap -->
	   
	
</div><!-- .maincontent -->
<div class="clear"></div>

<script type="text/javascript">
	$(document).ready(function(){
			$('#btnReset').click(function(){
				var error = 0;
			if ($("#email").val() == "") {
				$("#email").addClass("error");
				error ++;
			}else if(!validateEmail($("#email").val())){ // Call validateEmail function from Util.js
				$("#email").addClass("error");
				error ++;
			} else {
				$("#email").removeClass("error");
			}
			if (error == 0) {
				$("#frmReset").submit();
			}	
		});
	});

</script>


