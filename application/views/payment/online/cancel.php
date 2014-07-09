<div class="inner">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Secured Payment Online" href="<?=site_url("payment-online")?>">Secured Payment Online</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Submit Failure !!!
	</div>
	<h1 class="page-title">Submit Failure !!!</h1>
	<div id="view-container">
		<div class="view-content">
			<div class="detail">
				<div>
					<p>
						Dear <b><?=strtoupper($client_name)?></b>,
					</p>
					<br/>
					<p>
						Your payment was not successful because of some reasons:
						<ul style="list-style-type: disc; margin-left: 20px">
							<li>You cancelled the payment.</li>
							<li>Your bank did not approved your payment.</li>
							<li>You stopped while it was processing.</li>
							<li>Your information is incorrect while filling the credit card information.</li>
						</ul>
					</p>
					<p>
						Please <a href="<?=BASE_URL_HTTPS."/payment-online.html"?>">click here</a> to make another payment try with new card or choose other method of payment.<br/>
						Or please contact us by email to <a href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a>, we will contact you immediately.
					</p>
					<br/>
					<p>
						Best Regards,<br />
						TRAVELOVIETNAM.COM<br />
						Hotline: <a title="hotline" href="tel:<?=HOTLINE?>"><?=HOTLINE?></a><br />
						Tollfree: <a title="toll free" href="tel:<?=TOLL_FREE?>"><?=TOLL_FREE?></a><br />
						Email: <a title="email" href="mailto:<?=MAIL_INFO?>"><?=MAIL_INFO?></a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

