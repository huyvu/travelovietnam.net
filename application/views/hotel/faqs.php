<script type="text/javascript">
	$(document).ready(function() {
		$('#travelslide').oneByOne({
			className: 'travelads',	             
			easeType: 'random',
			slideShow: true,
			pauseByHover: true,
			delay: 1000,
			slideShowDelay: 5000
		});
		
		var options = {
				numberOfMonths : 2,
				minDate: 0
		};
		$("#hotel-checkindate").datepicker(options);
		$("#hotel-checkoutdate").datepicker(options);
	});
</script>
<div id="home-wizban">
	<div id="travelslide">
		<div class="travelitem">
			<img src="<?=TPL_URL?>jquery/images/HaLong/halong.png" class="img1" />
			<img src="<?=TPL_URL?>jquery/images/HaLong/halong2.png" class="img2" />
			<span class="title"><img src="<?=TPL_URL?>jquery/images/HaLong/halong-tour.png"/></span>
			<span class="price"><img src="<?=TPL_URL?>jquery/images/HaLong/price.png"/></span>
			<span class="button">
				<a class="org-btn-large" href="#">Book Now</a>
			</span>
		</div>
		<div class="travelitem">
			<img src="<?=TPL_URL?>jquery/images/DaNang/danang.png" class="img1" />
			<img src="<?=TPL_URL?>jquery/images/DaNang/hoian.png" class="img2" />
			<span class="title"><img src="<?=TPL_URL?>jquery/images/HaLong/halong-tour.png"/></span>
			<span class="price"><img src="<?=TPL_URL?>jquery/images/HaLong/price.png"/></span>
			<span class="button">
				<a class="org-btn-large" href="#">Book Now</a>
			</span>
		</div>
		<div class="travelitem">
			<img src="<?=TPL_URL?>jquery/images/DaLat/dalat.png" class="img1" />
			<img src="<?=TPL_URL?>jquery/images/DaLat/nhatrang.png" class="img2" />
			<span class="title"><img src="<?=TPL_URL?>jquery/images/HaLong/halong-tour.png"/></span>
			<span class="price"><img src="<?=TPL_URL?>jquery/images/HaLong/price.png"/></span>
			<span class="button">
				<a class="org-btn-large" href="#">Book Now</a>
			</span>
		</div>
		<div class="travelitem">
			<img src="<?=TPL_URL?>jquery/images/BenThanh/benthanh.png" class="img1" />
			<img src="<?=TPL_URL?>jquery/images/BenThanh/cuchi.png" class="img2" />
			<span class="title"><img src="<?=TPL_URL?>jquery/images/HaLong/halong-tour.png"/></span>
			<span class="price"><img src="<?=TPL_URL?>jquery/images/HaLong/price.png"/></span>
			<span class="button">
				<a class="org-btn-large" href="#">Book Now</a>
			</span>
		</div>
		<div class="travelitem">
			<img src="<?=TPL_URL?>jquery/images/Mekong/mekong.png" class="img1" />
			<img src="<?=TPL_URL?>jquery/images/Mekong/mekong1.png" class="img2" />
			<span class="title"><img src="<?=TPL_URL?>jquery/images/HaLong/halong-tour.png"/></span>
			<span class="price"><img src="<?=TPL_URL?>jquery/images/HaLong/price.png"/></span>
			<span class="button">
				<a class="org-btn-large" href="#">Book Now</a>
			</span>
		</div>
	</div>
	<div id="hotel-search-widget">
		<div class="widget-content">
			<div>
				<div class="clearfix">
					<p class="text-form w180">
						<label>Check-in date:</label>
						<span>
							<input type="text" id="hotel-checkindate" name="hotel-checkindate" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="calendar">
						</span>
					</p>
					<p class="text-form w180">
						<label>Check-out date:</label>
						<span>
							<input type="text" id="hotel-checkoutdate" name="hotel-checkoutdate" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="calendar">
						</span>
					</p>
				</div>
				<div class="clearfix">
					<p class="text-form">
						<label>In city (or landmap):</label>
						<input type="text" id="hotel-location" name="hotel-location" class="text-input" placeholder="select city" />
					</p>
				</div>
				<div class="clearfix">
					<p class="text-form">
						<label>Rooms:</label>
						<select name="" style="width: 50px">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
							<option>11</option>
							<option>12</option>
							<option>13</option>
							<option>14</option>
							<option>15</option>
						</select>
					</p>
					<p class="text-form">
						<label>Adults:</label>
						<select name="" style="width: 50px">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
							<option>11</option>
							<option>12</option>
							<option>13</option>
							<option>14</option>
							<option>15</option>
						</select>
					</p>
					<p class="text-form">
						<label>Children:</label>
						<select name="" style="width: 50px">
							<option>0</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
							<option>11</option>
							<option>12</option>
							<option>13</option>
							<option>14</option>
							<option>15</option>
						</select>
					</p>
				</div>
				<div class="clearfix">
					<div class="text-form">
						<div class="map-ticker">
							<a href="<?=IMG_URL?>vietnam.png" class="viewmap"><img alt="" src="<?=IMG_URL?>map-ticker.png"></a>
						</div>
						<input type="submit" class="search-button org-btn-large" value="SEARCH"/>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clr"></div>
</div>
<div class="left">
	<div class="destination-search" style="margin-top: 240px; margin-left: 20px">
		<h2 class="title">Hotels List by Destination</h2>
		<div class="left">
			<div class="hotel-map">
		    	<a class="sapa" title="Sapa" href="">Sapa</a>
		        <a class="hanoi" title="Ha noi" href="">Ha noi</a>
		        <a class="halong" title="Ha long" href="">Ha long</a>
		        <a class="haiphong" title="Hai Phong" href="">Hai Phong</a>
		        <a class="ninhbinh" title="Ninh Binh" href="">Ninh Binh</a>
		        <a class="hue" title="Hue" href="">Hue</a>
		        <a class="danang" title="Da Nang" href="">Da Nang</a>
		        <a class="hoian" title="Hoi An" href="">Hoi An</a>
		        <a class="dalat" title="Da Lat" href="">Da Lat</a>
		        <a class="nhatrang" title="Nha Trang" href="">Nha Trang</a>
		        <a class="hochiminh" title="Ho Chi Minh City" href="">Ho Chi Minh City</a>
		        <a class="chaudoc" title="Chau Doc" href="">Chau Doc</a>
		        <a class="cantho" title="Can Tho" href="">Can Tho</a>
		        <a class="phuquoc" title="Phu Quoc" href="">Phu Quoc</a>
		    </div>
		</div>
		<div class="clr"></div>
	</div>
</div>
<div class="right" style="width: 710px">
	<div id="view-container">
		<div id="breadcrumbs">
			<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
			<img alt="" src="<?=IMG_URL?>arrow.png">
			<a class="pathway" title="Hotel" href="<?=site_url("hotels")?>">Hotel</a>
			<img alt="" src="<?=IMG_URL?>arrow.png"> Frequently Asked Questions
			<? require_once(APPPATH."views/module/social.php"); ?>
		</div>
		<h1 class="headtitle">Frequently Asked Questions</h1>
		<div class="faqs">
			<ul class="list1">
				<?php 
					if (!empty($items) && sizeof($items)) {
						$cnt = 1;
						foreach ($items as $item) {
							?>
							<li <?=($cnt==sizeof($items))?"class='last'":""?>>
								<div class="stt"><?=$cnt?>.</div>
								<div class="title"><a href="#q<?=$cnt?>"><?=$item->title?></a></div>
								<div class="clr"></div>
							</li>
							<?
							$cnt ++;
						}
					}
				?>
			</ul>
			<br/>
			<h1>Answers</h1>
			<ul class="list2">
				<?php 
					if (!empty($items) && sizeof($items)) {
						$cnt = 1;
						foreach ($items as $item) {
							?>
							<li class="item">
								<h2 class="title"><a name="q<?=$cnt?>"></a> <?=$cnt?>. <?=$item->title?></h2>
								<div class="detail">
								<?=$item->content?>
								</div>
								<div class="gotop">
									<a href="#">Back to top</a>
								</div>
							</li>
							<?
							$cnt ++;
						}
					}
				?>
			</ul>
		</div>
	</div>
</div>
<div class="clr"></div>
<? require_once(APPPATH."views/module/travelnews.php"); ?>
<div class="clr"></div>