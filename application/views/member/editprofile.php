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
		<li class="profile"><a class="current" href="<?=site_url("member/myprofile")?>">Edit Profile</a></li>
		<li class="password"><a href="<?=site_url("member/changepassword")?>">Change Password</a></li>
	</ul>
	<? if ($this->session->flashdata('changepass_success')) { ?>
		<div class="msgbox-success" style="margin-top:32px;"><?=$this->session->flashdata('changepass_success')?></div>
	<? }elseif ($this->session->flashdata('changepass_error')) { ?>
		<div class="msgbox-error" style="margin-top:32px;"><?=$this->session->flashdata('changepass_error')?></div>
	<? } ?>		
	<div class="tab-details">
		<div id="profile" class="tab-contents">
			<div class="ico">
				<img src="<?= IMG_URL ?>/member/profile-ico.jpg">
			</div>
			
			<?php $attributes = array('name' => 'frmUpdateProfile', 'id' => 'frmUpdateProfile'); ?>
			<?php echo form_open_multipart('member/updateprofile', $attributes) ?>
				<div class="register-form" style="width:100%">
					<h2 class="edit-profile-title">Your profile information</h2>
					<div id="user-avatar">
							<img id="previewHolder" src="<?php echo !empty($user['avatar'])? $user['avatar'] : IMG_URL.'member/user-picture.png' ?>" width="96" height="96">
							<div id="avatar-edit">
								<p><a href="#" id="changeAvatar"><img src="<?= IMG_URL ?>/member/edit.png" style="margin-right:5px;"><span>Change Profile Picture</span></a></p>
								<?php if(!empty($user['avatar'])) :?>
									<p><a href="#" id="removeAvatar"><img src="<?= IMG_URL ?>/member/remove.gif" style="margin-right:5px;"><span>Remove</span></a></p>
								<?php endif ?>
								<p class="required-message">
									<i>
										- Image files should be formatted as .jpg, .gif, or .png<br/>
										- We recommend a maximum file size of 2MB.<br/>
									</i>
								</p>
								<input type="file" id="userfile" name="userfile" size="20" style="visibility:hidden; height:0"/>
								<input type="hidden" id="currentAvatar" name="currentAvatar" value="<?php echo $user['avatar'] ?>" style="height:0">
							</div><!-- #avatar-edit -->
					</div><!-- end #user-profile -->
					<table class="register-table">
						<tr>
							<td width="110px">Your Name <span class="red">*</span></td>
							<td><input type="text" id="fullname" name="fullname" class="login-input" value="<?php echo $user['fullname'] ?>"/></td>
						</tr>
						<tr>
							<td>Email <span class="red">*</span></td>
							<td><input type="text" id="email" name="email" class="login-input" value="<?php echo $user['email'] ?>"/></td>
						</tr>
						<tr>
							<td>Phone No. <span class="red">*</span></td>
							<td>
								<select id="country_code" name="country_code" class="login-input" value="" />
									<option value="">Select Country Code...</option>
									<? foreach ($nations as $nation) {
										preg_match_all('/\(\+([A-Za-z0-9 ]+?)\)/', $user['phone'], $out);
										if ($nation->country_code == $out[1][0]) {
									?>
										<option selected value="+<?=$nation->country_code?>"><?=$nation->name?> (+<?=$nation->country_code?>)</option>
									<?}else{ ?>
										<option value="+<?=$nation->country_code?>"><?=$nation->name?> (+<?=$nation->country_code?>)</option>
									<?} 
									} ?>
								</select>
								<?php 
									$data = $user['phone'];
									$phone = substr($data, strpos($data, ")") + 1);
								 ?>
								<input type="text" id="phone" name="phone" class="login-input" value="<?php echo $phone ?>"/>
							</td>
						</tr>
						<tr>
							<td>Nationality <span class="red">*</span></td>
							<td>
								<select id="nationality" name="nationality" class="login-input" value="" />
									<option value="">Select Country...</option>
									<? foreach ($nations as $nation) { 
											if ($nation->name == $user['nationality']) {
												echo "<option selected value='{$nation->name}'>{$nation->name}</option>";
											}else{
												echo "<option value='{$nation->name}'>{$nation->name}</option>";
											}
									}?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Birthday <span class="red">*</span></td>
							<td><input type="text" id="birthday" name="birthday" class="login-input" placeholder="mm/dd/yyyy" value="<?php if($user['birthday']) echo  strftime('%m/%d/%Y',strtotime($user['birthday'])); ?>"/></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="radio" id="male" name="gender" value="1" checked="checked"><label for="male">Male</label> <input type="radio" id="female" name="gender" value="0"><label for="female">Female</label></td>
						</tr>
						<tr>
							<td><input type="hidden" name="user_id" value="<?php echo $user['id'] ?>"/></td>
							<td>
								<div><input type="button" id="btnEdit" class="red-btn" value="Update"/></div>
							</td>
						</tr>
					</table>
				</div>
			</form>
		</div><!-- #profile -->
	</div><!-- .tab-details -->
</div><!-- .menumember -->
</div><!-- .maincontent -->
<div class="clear"></div>
<div id="fb-root"></div>
<script type="text/javascript" src = "<?=JS_URL?>facebook.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		//Open browse file window and change user avatar after select a photo
		$('#changeAvatar, #previewHolder').click(function(){
			$('#userfile').click();
		});

		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#previewHolder').attr('src', e.target.result);
				}

			reader.readAsDataURL(input.files[0]);
			}
		}
		$("#userfile").change(function() {
			readURL(this);
			if ($('#removeAvatar').is(':hidden')) {
				$('#removeAvatar').show();
			}
		});

		//Remove photo
		$('#removeAvatar').click(function(event) {
			$('#previewHolder').attr('src', '<?= IMG_URL ?>/member/user-picture.png');
			$('#currentAvatar').val('');
			$(this).hide();
		});
		//Check gender radio button
		var gender = "<?=$user['gender']?>";
		if (gender) {
			$('#male').prop('checked', true);	
		}else{
			$('#female').prop('checked', true);
		}

		//set focus to email field when user haven't provided email before
		var focus = "<?php echo isset($focus)? $focus : '' ?>";
		if (focus != '') {
			focus = '#'+focus;
			$(focus).focus();
			$(focus).css('border-color','red');
			$(focus).css('outline','none');
		}
	});
</script>