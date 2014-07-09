<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>member.css" />
<script type="text/javascript" src="<?=JS_URL?>myaccount.js"></script>
<div class="maincontent">
<div class="info-bar">
	<div class="ico"></div>
	<?php
	if ($this->session->userdata('user')) {
		$user = $this->session->userdata('user');
		echo '<h1>Hi, '.$user["fullname"];
		if ($user['provider'] == 'facebook') {
	?>
		<span class="right-panel"><a href="#" onClick="facebookLogout('<?php echo site_url("member/logout") ?>')">» Log Out</a></span></h1>
	<?php
		}else{
		echo '<span class="right-panel"><a href="'.site_url('member/logout').'">» Log Out</a></span></h1>';	
		}
	}
	?>
</div>
<div class="menumember">
	<ul class=topmenu>
		<li class="order"><a  href="<?=site_url("member/myaccount")?>">My Orders</a></li>
		<li class="ticket"><a target="_blank" href="<?=site_url("help/mytickets")?>">My Tickets</a></li>
		<li class="profile"><a href="<?=site_url("member/myprofile")?>">Edit Profile</a></li>
		<li class="password"><a class="current" href="<?=site_url("member/changepassword")?>">Change Password</a></li>
	</ul>
	<? if ($this->session->flashdata('changepass_success')) { ?>
		<div class="msgbox-success" style="margin-top:32px;"><?=$this->session->flashdata('changepass_success')?></div>
		<?php header( "refresh:3;url=myaccount" ); ?>
	<? }elseif ($this->session->flashdata('changepass_error')) { ?>
		<div class="msgbox-error"><?=$this->session->flashdata('changepass_error')?></div>
	<? } ?>
	<div class="tab-details">
		<div id="password" class="tab-contents">
			<div class="ico">
				<img src="<?= IMG_URL ?>/member/change-pass-ico.jpg">
			</div>
			<form id="frmChangePassword" name="frmChangePassword" action="<?=site_url("member/editpassword")?>" method="POST">
				<div class="register-form" style="width:90%">

					<table class="register-table">
						<tr>
							<td colspan=2 class="error-message"><?= !empty($error_message)?$error_message:'' ?></td>
						</tr>
						<?php if (!is_null($user['password_text'])) : ?> 
						<tr>
							<td width="180px">Current Password <span class="red">*</span></td>
							<td><input type="password" id="old-pass" name="old-pass" class="login-input" /></td>
						</tr>
						<?php endif; ?>
						<tr>
							<td style="width:180px">New Password <span class="red">*</span></td>
							<td><input type="password" id="new-pass" name="new-pass" class="login-input" /></td>
						</tr>
						<tr>
							<td>Re-type Password<span class="red">*</span></td>
							<td><input type="password" id="passconf" name="passconf" class="login-input" title="Must be at least 8 characters." /></td>
						</tr>
						<tr>
							<td>
								<input type="hidden" name="user_id" value="<?= $user['id'] ?>"/>
							</td>
							<td>
								<div><input type="button" id="btnChangePassword" class="red-btn" value="Submit"/></div>
							</td>
						</tr>
					</table>
				</div>
			</form>
		</div>
	</div><!-- .tab-details -->	
</div><!-- .menumember -->
</div><!-- .maincontent -->
<div class="clear"></div>
<div id="fb-root"></div>

<script type="text/javascript" src = "<?=JS_URL?>facebook.js"></script>
