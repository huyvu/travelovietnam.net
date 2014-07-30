<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>member.css" />
<script type="text/javascript" src="<?=JS_URL?>login.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#birthday").datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: '1910:'+(new Date()).getFullYear()
		});
	});
</script>


<div class="container" id="login">
	<div class="signup-container">
		<form role="form" id="frmSignUp" name="frmSignUp" action="<?=site_url("member/signup")?>" method="POST">
			<div id="breadcrumbs" class="row">
				<div class="col-md-12 ">
					<a class="pathway" title="Home" href="<?=site_url("tours/vietnam")?>">Home</a>
					> Tour Booking > Step 1: Sign up	
				</div>
			</div><!-- .navigate-info -->
			<div class="row login-title">
				<div class="col-md-12 col-sm-12">
					<div class="col-md-4 col-sm-4">
						Tour booking
					</div>
					<div class="col-md-8 col-sm-8">
						<a href=""><div class="col-md-4 col-sm-4 active">1. Sign up</div></a>
						<a href=""><div class="col-md-4 col-sm-4">2. Fill Information</div></a>
						<a href=""><div class="col-md-4 col-sm-4">3. Review &amp; Payment</div></a>
					</div>
				</div>
			</div>

			<div class="row register-content clr">
				<div class="col-md-3 col-xs-12" id="sign-in">
					<img src="<?=IMG_URL?>member/signin-delimiter.png" id="signin-delimiter" />
					<h3>I am a returning customer</h3>  
					<h2 class="form-title">LOGIN HERE</h2>
					<h4 class="form-subtitle">Sign in to your account using</h4>
					<div class="login-account">
						<ul>
							<li><a href="#" onClick = "facebookLogin('<?php echo site_url("auth/facebookLogin");?>','<?php echo site_url("member/myaccount") ?>')" class="facebook">&nbsp;</a></li>
							<li><a href="<?php echo site_url('auth/oauth/twitter'); ?>" class="twitter">&nbsp;</a></li>   
							<li><a href="<?php echo site_url('auth/oauth/linkedin'); ?>" class="linkedin">&nbsp;</a></li>
							<li><a href="<?php echo site_url('auth/oauth2/google'); ?>" class="google">&nbsp;</a></li>
							<li><a href="#" onClick="openPopup('<?php echo $yahoo->authUrl() ?>',600,400)" class="flickr">&nbsp;</a></li>         
						</ul>
					</div><!-- /login-account-->
					<h2 class='or'>OR</h2>

					<div class="login-form" style="width:100%">
						<? if ($this->session->flashdata('login_error')) { ?>
						<div class="msgbox-error"><?=$this->session->flashdata('login_error')?></div>
						<? } ?>
						<p>
							<input type="text" name="username" id="username" class="login-input" placeholder="Registered email"/>
						</p>
						<p>
							<input type="password" name="password" id="password" class="login-input" placeholder="Password"/>
						</p>
						<p>
							<a href="<?php echo site_url('member/forgotpassword') ?>">Forgot your password?</a>
							<!-- <input type="button" id="btnLogin" value="Log In"/> -->
							<button type="button" id="btnLogin">Log In</button>
						</p>
						<p>
							<input type="checkbox" name="chk_remember" id="chk_remember">
							<label for="chk_remember">Remember</label>
						</p>
						<p>
							<ul class="attention">
								<li><img src="<?=IMG_URL?>member/icon-summary.png" alt="">See the summary of your previous bookings</li>
								<li><img src="<?=IMG_URL?>member/icon-info.png" alt="">Update your contact information</li>
								<li><img src="<?=IMG_URL?>member/icon-lock.png" alt="">Change the password for your account</li>
							</ul>
							<!-- end .attention -->
						</p>
					</div><!-- .login-form -->
				</div><!-- #sign-in -->
							
				<div class="col-md-6 col-xs-12 register-form ">
					<h3>I am a new customer</h3>  
					<h2 class="form-title">CREATE ACCOUNT HERE</h2>
					<h4 class="form-subtitle">Create your account using</h4>
					<div class="login-account">
						<ul>
							<li><a href="#" onClick = "facebookLogin('<?php echo site_url("auth/facebookLogin");?>','<?php echo site_url("member/myaccount") ?>')" class="facebook">&nbsp;</a></li>
							<li><a href="<?php echo site_url('auth/oauth/twitter'); ?>" class="twitter">&nbsp;</a></li>   
							<li><a href="<?php echo site_url('auth/oauth/linkedin'); ?>" class="linkedin">&nbsp;</a></li>
							<li><a href="<?php echo site_url('auth/oauth2/google'); ?>" class="google">&nbsp;</a></li>
							<li><a href="#" onClick="openPopup('<?php echo $yahoo->authUrl() ?>',600,400)" class="flickr">&nbsp;</a></li>         
						</ul>
					</div><!-- /login-account-->
					<h2 class='or'>OR</h2>
					<? if ($this->session->flashdata('register_error')) { ?>
					<div class="msgbox-error"><?=$this->session->flashdata('register_error')?></div>
					<? } ?>
					<div id="register-section">
						<p>
							<select id="gender" name="gender">
								<option value="Mr">Mr</option>
								<option value="Ms">Ms</option>
								<option value="Mrs">Mrs</option>
							</select>
							<input type="text" id="fullname" name="fullname" class="login-input" placeholder="Fullname"/>
						</p>
						<p>
							<input type="text" id="email" name="email" class="login-input" placeholder="Email" />
						</p>
						<p>
							<select id="nationality" name="nationality" class="login-input"/>
								<option value="">Select Country...</option>
								<? foreach ($nations as $nation) { ?>
								<option value="<?=$nation->name.'|'.$nation->country_code?>"><?=$nation->name?> (+<?=$nation->country_code?>)</option>
								<? } ?>
							</select>
							<input type="text" id="phone" name="phone" class="login-input" placeholder="Phone" />
						</p>
						<p>
							<input type="password" id="newpassword" name="newpassword" class="login-input" placeholder="Password"/>
						</p>
						<p>
							<input type="password" id="password_confirm" name="password_confirm" class="login-input" placeholder="Password Confirmation"/>
						</p>
						<p class="required-message">
							Password must be at least 5 characters long. A combination of 
							numbers and letters is highly recommended for security reasons.
						</p>
						<p>
							<div><input type="button" id="btnSignUp" value="continue"/></div>
						</p>
					</div><!-- #register-section -->
				</div><!-- .register-form -->

				<div class="col-md-3 col-xs-12" id="benefit">
					<div>
						<h1>benefits</h1>
						<h3>of member account</h3>
						<ul>
							<li>Manage customers application more easily.</li>
							<li>Save personal information more securely.</li>
							<li>Reduce customers fee automatically.</li>
						</ul>
					</div>
					<p>
						If you use a Yahoo!, AOL, Hotmail or Gmail email 
						address please add info@travelovietnam.com to 
						your address book. <a href="">More information</a>
					</p>
					<p>
						Viator respects your privacy. Read our <a href="">privacy policy for details</a>.
					</p>   
				</div><!-- #benefit -->
				<input type="hidden" id="task" name="task" value="" />
		</form>
		</div><!-- .register-content -->
	</div><!-- signup-container -->
</div><!-- end .inner -->
<div class="clr"></div>
<br/>
<div id="fb-root"></div>

<script type="text/javascript" src = "<?=JS_URL?>facebook.js"></script>

<script type="text/javascript">
//open popup window for login
function openPopup(url,w,h){
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2) - h;
	window.open(url,'open_popup','width='+w+',height='+h+',toolbar=0,menubar=0,location=0,status=0,scrollbars=0,resizable=0,left='+left+',top='+top+'');
	return false;
}
</script>
