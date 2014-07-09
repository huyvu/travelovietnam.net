<div class="left">
	<? require_once(APPPATH."views/module/visa/apply_form.php"); ?>
	<? require_once(APPPATH."views/module/visa/support_online.php"); ?>
	<? require_once(APPPATH."views/module/visa/confidence.php"); ?>
</div>
<div class="right">
	<div class="feeds">
		<div id="viewTab1">
			<div class="img">
				<div>Vietnam Visa Services</div>
				<ul>
					<li><a title="Visa on Arrival for Tourist & Business" href="<?=site_url("visa/news")?>">Visa on Arrival for Tourist & Business</a></li>
					<li><a title="Visa Extension" href="<?=site_url("visa/extension")?>">Visa Extension</a></li>
					<li><a title="Fast Checking Service" href="<?=site_url("visa/services")?>">Fast Checking Service</a></li>
					<li><a title="Car Pick-up Service" href="<?=site_url("visa/services")?>">Car Pick-up Service</a></li>
					<li><a title="View more" href="<?=site_url("visa/services")?>">And more...</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="visa-processing">
		<h3>4 STEPS TO GET VIETNAM VISA AT THE AIRPORTS</h3>
		<div class="left step">
			<div class="img"><a title="visa processing" href="<?=site_url("visa/processing")?>"><img alt="visa processing step1" src="<?=IMG_URL?>visa-processing-step1.jpg"/></a></div>
			<div>1. Fill out online form</div>
		</div>
		<div class="left nav"></div>
		<div class="left step">
			<div class="img"><a title="visa processing" href="<?=site_url("visa/processing")?>"><img alt="visa processing step2" src="<?=IMG_URL?>visa-processing-step2.jpg"/></a></div>
			<div>2. Confirm & Pay</div>
		</div>
		<div class="left nav"></div>
		<div class="left step">
			<div class="img"><a title="visa processing" href="<?=site_url("visa/processing")?>"><img alt="visa processing step3" src="<?=IMG_URL?>visa-processing-step3.jpg"/></a></div>
			<div>3. Get your approval letter</div>
		</div>
		<div class="left nav"></div>
		<div class="left step">
			<div class="img"><a title="visa processing" href="<?=site_url("visa/processing")?>"><img alt="visa processing step4" src="<?=IMG_URL?>visa-processing-step4.jpg"/></a></div>
			<div>4. Get your visa stamped</div>
		</div>
		<div class="clr"></div>
	</div>
	<div id="visa-news-container" style="overflow: hidden; position: relative; display: none;">
		<ul class="scroll-area" style="position: absolute; margin: 0px; padding: 0px; top: 0px;">
		</ul>
		<div class="nav">
			<div class="up"><a onclick="scrollUp()" href="javascript:void(0)"><img src="/template/images/up-arrow.jpg"></a></div>
			<div class="current"><div class="news-number">4 of 19</div></div>
			<div class="down"><a onclick="scrollDown()" href="javascript:void(0)"><img src="/template/images/down-arrow.jpg"></a></div>
		</div>
	</div>
	<div id="check-requirement">
		<div class="content">
			<form method="POST" action="<?=site_url("visa/requirements")?>" id="frmCheckRequirement">
				<h3>CHECK IF YOU NEED A VISA TO VIETNAM</h3>
				<select class="select-nation" id="citizen" name="citizen">
					<option value="">Select your country</option>
					<? foreach($nations as $n) {
						echo "<option value='{$n->alias}'>{$n->name}</option>";
					} ?>
				</select>
				<input type="submit" value="CHECK REQUIREMENT" class="red-btn">
			</form>
		</div>
	</div>
	<div id="news-container" style="width: 710px">
		<div style="width: 48%" class="left">
			<div class="content">
				<h1>VIETNAM VISA INFORMATION</h1>
				<ul>
					<li>
						<a title="" href=""></a>
					</li>
				</ul>
				<p class="more"><a class="more" href="">&raquo; View All</a></p>
			</div>
		</div>
		<div style="width: 50%" class="right">
			<div class="content">
				<h1>FREQUENTLY ASKED QUESTIONS</h1>
				<ul>
					<li>
						<a title="" href=""></a>
					</li>
				</ul>
				<p class="more"><a class="more" href="">&raquo; View All</a></p>
			</div>
		</div>
		<div class="clr"></div>
	</div>
	<div id="external-block">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tbody><tr valign="top">
				<td class="testimonial">
					<h1>CLIENT'S TESTIMONIALS</h1>
					<p class="content">
						"We would like to thank your kind to help us the last minute visa to Vietnam. You save our life and all my trip for visiting beautiful country. We will need your help in the future and we will recommend you to our friends."
						<br><img src="<?=IMG_URL?>star5.png" style="float:left"> <span style="float:left; padding-left:6px"> by <b>Gary Brown</b></span>
					</p>
					<p class="more"><a class="more" href="">&raquo; View more</a></p>
				</td>
				<td class="blog-post">
					<h1>QUESTIONS & ANSWERS</h1>
					<ul>
						<li><a title="" href="" target="_blank"></a></li>
					</ul>
					<p style="text-align: right;margin: 0;"><a class="more" href="">&raquo; View more</a></p>
				</td>
			</tr>
		</tbody></table>
	</div>
</div>
<div class="clr"></div>
			