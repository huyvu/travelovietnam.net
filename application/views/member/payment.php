<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>member.css" />

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
			<li class="order"><a class="current" href="<?=site_url("member/myaccount")?>">My Orders</a></li>
			<li class="ticket"><a target="_blank" href="<?=site_url("help/mytickets")?>">My Tickets</a></li>
			<li class="profile"><a href="<?=site_url("member/myprofile")?>">Edit Profile</a></li>
			<li class="password"><a href="<?=site_url("member/changepassword")?>">Change Password</a></li>
		</ul>
		<div class="tab-details">
			<div class="client-name">
				<p><span>Application Number</span>: <b>T<?=$book_id?></b></p>
				<?php
					$paid = 0;
					if ($item->status) {
						$paid = $item->paid;
					}					
				?>
				<p><span>Total Fee</span>: <b>$<?=$item->total_fee?></b></p>
				<p><span>Paid</span>: <b>$<?=$paid?></b></p>
				<p><span>Amount to wire</span>: <b class="red">$<?=$item->total_fee - $paid?></b></p>
			</div>
			<div class="ca-payment">
				<div class="detail">
					<form method="post" action="<?=site_url("member/pay")?>">
						<input type="hidden" id="book_id" name="book_id" value="<?=$book_id?>"/>
						<h1>Select Your Payment Method</h1>
						<table width="600px" cellpadding="20" style="margin:20px auto">
							<tbody>
								<tr>
									<td align="left" width="350px">
										<label for="paymentop" class="paymentlabel">
										<img src="<?=IMG_URL?>/payment/onepay.png" alt="OnePay" /><br />
										<span style="vertical-align: middle;"><input type="radio" <?=(($item->payment_method=="OnePay")?"checked='checked'":"")?> name="payment" id="paymentop" value="OnePay" /> OnePay</span>
										</label>
									</td>
									<td align="left">
										<label for="paymentpaypal" class="paymentlabel">
										<img src="<?=IMG_URL?>/payment/paypal.png" alt="Paypal.com" /><br />
										<span style="vertical-align: middle;"><input type="radio" <?=(($item->payment_method=="Paypal")?"checked='checked'":"")?> name="payment" id="paymentpaypal" value="Paypal" /> Paypal.com</span>
										</label>
									</td>
								</tr>
							</tbody>
						</table>
						<button class="btnstep" type="submit">PROCEED TO PAYMENT</button>
					</form>
				</div>
				<div class="clear"></div>
			</div>
		</div><!-- .tab-details -->
	</div>
	<div class="clear"></div>
</div>
