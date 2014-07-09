<link rel="stylesheet" href="<?=CSS_URL?>login.css" type="text/css" />
<div id="element-box" class="login">
	<div id="section-box">
		<img src="<?=IMG_URL?>travelovietnam.png">
		<? if ($this->session->flashdata('status')) {?>
		<dl id="system-message">
			<dt class="message">Message</dt>
			<dd class="message message fade">
				<ul>
					<li><?=$this->session->flashdata('status')?></li>
				</ul>
			</dd>
		</dl>
		<? } ?>
		<div class="login-box">
			<form action="<?=site_url("administrator/do_logon")?>" method="post" name="login" id="form-login">
				<p id="form-login-username"><label for="modlgn_username">Username</label>
					<input name="username" id="modlgn_username" type="text" class="inputbox" size="32" />
				</p>
				<p id="form-login-password"><label for="modlgn_passwd">Password</label>
					<input name="passwd" id="modlgn_passwd" type="password" class="inputbox" size="32" />
				</p>
				<div class="button_holder">
					<div class="button1">
						<div class="next"><a onclick="login.submit();"> Login</a></div>
					</div>
				</div>
				<div class="clr"></div>
				<input type="submit" style="border: 0; padding: 0; margin: 0; width: 0px; height: 0px;" value="Login" />
				<input type="hidden" name="option" value="com_login" />
				<input type="hidden" name="task" value="login" />
			</form>
			<div class="clr"></div>
		</div>
		<p style="margin-top: 6px"><a href="<?=BASE_URL?>">Return to site Home Page</a></p>
	</div>
	<div class="clr"></div>
</div>
<div class="clr"></div>
