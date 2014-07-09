<?
	$data = null;
	if ($this->session->flashdata('check_status')) {	
		$data = $this->session->flashdata('check_status');
	}
	$email		= (!empty($data->email) ? $data->email : "");
	$email2		= (!empty($data->email2) ? $data->email2 : "");
	$fullname	= (!empty($data->fullname) ? $data->fullname : "");
	$passport	= (!empty($data->passport) ? $data->passport : "");
	$message	= (!empty($data->message) ? $data->message : "");
?>

<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>member.css" />

<div class="left2">
	<div class="module">
		<div class="modulec">
			<h1 class="main_title">CHECK VISA STATUS</h1>
			<div class="contact">
				<p>
					Please fill the form online to check your visa status with our live agent via email or email to <a href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a> if you want to make sure your request will come to us. We will reply you shortly via email.
				</p>
				<h4 class="red">Why you cannot check online with us?</h4>
				<p>
					Due to protecting your personal data & your confidential with us, we do not store your data on our website. No once can guarantee 100% that a website is uncheckable & of course we not guarantee 100% that our site is uncheckable. Therefore, to protect your privacy, please contact us via email <a href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a> or fill the form online as bellow to check your visa status with our live person. 
				</p>
				<div>
					<table cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="100%" valign="top">
								<div style="margin:20px 15px;">
									<? if ($this->session->flashdata('status')) {?>
									<div class="b-error" style="margin: 20px 0px 10px 0px">
										<div class='marker'><?=$this->session->flashdata('status')?></div>
									</div>
									<? } ?>
									<div>
										<form id="frmFeedback" action="<?=site_url("check-visa-status/check")?>" method="POST">
											<table width="100%" cellpadding="6">
												<tbody>
													<tr valign="top">
														<td width="150px">Primary Email <span class="required">*</span></td><td>:</td>
														<td><input type="text" value="<?=$email?>" name="email" class="clstext" style="width: 400px" /></td>
													</tr>
													<tr valign="top">
														<td>Re-Type Primary Email<span class="required">*</span></td><td>:</td>
														<td><input type="text" value="" name="confirm_email" class="clstext" style="width: 400px" /></td>
													</tr>
													<tr valign="top">
														<td>Secondary Email (optional)</td><td>:</td>
														<td><input type="text" value="<?=$email2?>" name="email2" class="clstext" style="width: 400px" /></td>
													</tr>
													<tr valign="top">
														<td>Fullname (as in passport) <span class="required">*</span></td><td>:</td>
														<td><input type="text" value="<?=$fullname?>" name="fullname" class="clstext" style="width: 400px" /></td>
													</tr>
													<tr valign="top">
														<td>Passport Number <span class="required">*</span></td><td>:</td>
														<td><input type="text" value="<?=$passport?>" name="passport" class="clstext" style="width: 400px" /></td>
													</tr>
													<tr valign="top">
														<td>Give us a message</td><td>:</td>
														<td><textarea name="message" rows="10" style="width: 400px"><?=$message?></textarea></td>
													</tr>
													<tr>
														<td colspan="2">&nbsp;</td>
														<td><input class="button" type="submit" value="Submit" name="sbtCheckStatus" /></td>
													</tr>
												</tbody>
											</table>
										</form>
									</div>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<h4 class="red">Why we don't accept call for your visa?</h4>
				<p>
					Getting visa to enter a country is very important and you will lose much money if problem with your visa. We don't want any problem with your visa. Therefore, we would like your visa request must be confirmed via email to make sure we all understand correctly regarding your visa request & we will responsible for what we confirm you via email.
				</p>
				<p>
					Don't worry if you want to get your via on Sat or Sun or public holiday. We know how.
				</p>
				<br>
				<p>
					Best regards,<br>
					<b>Vietnam-Evisa team</b>
				</p>
			</div>
		</div>
	</div>
</div>
<div class="right2">
	<? require_once(APPPATH."views/module/apply_form.php"); ?>
	<? require_once(APPPATH."views/module/support_online.php"); ?>
	<? require_once(APPPATH."views/module/confidence.php"); ?>
</div>
<div class="clr"></div>