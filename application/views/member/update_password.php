<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>member.css" />
<script type="text/javascript" src="<?=JS_URL?>myaccount.js"></script>
<div class="maincontent">
	<div class="info-bar">
		<div class="ico"></div>
		<h1>Reset Password</h1>
	</div><!-- .info-bar -->

	<div class="reset-pass-wrap">
		<div id="update-pass">
			<? if ($this->session->flashdata('reset_error')) { ?>
				<div class="msgbox-error"><?=$this->session->flashdata('reset_error')?></div>
			<? } ?>

			<form name="frmUpdatePassword" id="frmUpdatePassword" method="POST" action="<?php echo site_url('member/updatepassword') ?>">
				<p>
					<label for="newPass">New Password</label>
					<input type="password" id="newPass" name="newPass" >
				</p>
				<p>
					<label for="newPassConf">Password Confirmation</label>
					<input type="password" id="newPassConf" name="newPassConf" >
				</p>
				<p>
					<input type="hidden" name="email" value="<?php echo $email ?>">
					<input type="button" name="btnUpdatePassword" id="btnUpdatePassword" value="Submit">	
				</p>
				<div class="clr"></div>			
			</form>
		</div><!-- reset-pass -->
	</div><!--/.reset-pass-wrap -->

	<div class="clear"></div>
</div><!-- .maincontent -->

<script type="text/javascript">
	$(document).ready(function(){
		$("#btnUpdatePassword").click(function() {
			var error = 0;
			var err_msg = '';
			if ($("#newPass").val() == "") {
				$("#newPass").addClass("error");
				error ++;
			} else {
				$("#newPass").removeClass("error");
			}
			
			if ($("#newPass").val() != "") {
				if ($("#newPassConf").val() == "") {
					$("#newPassConf").addClass("error");
					error ++;
				} else {
					if ($("#newPassConf").val() != $("#newPass").val()) {
						var p = $(this).parent().parent().find('p:nth-child(1)');
						console.log(p);
						p.before('<p style="color:red">Please retype your new password. Confirm field is not matched.</p>');
						// $('td.error-message').text('Please retype your new password. Confirm field is not matched.');
						$("#newPassConf").addClass("error");
						error ++;
					} else {
						$("#newPassConf").removeClass("error");
					}
				}	
			}

			console.log(error);
			if (error == 0) {
				$("#frmUpdatePassword").submit();
			}
		});
	});

</script>


