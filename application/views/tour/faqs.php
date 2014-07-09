<script type="text/javascript">
	$(document).ready(function() {
		var options = {
				numberOfMonths : 2,
				minDate: 0
		};
		$("#tour-arrivaldate").datepicker(options);
		$("#tour-departuredate").datepicker(options);
		
		var availableTags = [];
		$( "#tour-fromcity" ).autocomplete({
			source: availableTags
		});
		$( "#tour-destination" ).autocomplete({
			source: availableTags
		});
	});
</script>
<div id="tour-view">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Tour" href="<?=site_url("tours")?>">Tour</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Frequently Asked Questions
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
</div>
<div class="left">
	<div id="tour-search-widget">
		<div class="container">
			<h1 class="widget-title">SEARCH TOUR</h1>
			<div class="widget-content">
				<div class="clearfix">
					<p class="text-form w180">
						<label>From date:</label>
						<span>
							<input type="text" id="tour-arrivaldate" name="tour-arrivaldate" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="calendar">
						</span>
					</p>
					<p class="text-form w180">
						<label>To date:</label>
						<span>
							<input type="text" id="tour-departuredate" name="tour-departuredate" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy" class="calendar">
						</span>
					</p>
				</div>
				<div class="clearfix">
					<p class="text-form w180">
						<label>Depart from:</label>
						<input type="text" id="tour-fromcity" name="tour-fromcity" class="text-input" placeholder="from city" />
					</p>
				</div>
				<div class="clearfix">
					<p class="text-form w180">
						<label>Destination:</label>
						<input type="text" id="tour-destination" name="tour-destination" class="text-input" placeholder="to city" />
					</p>
				</div>
				<div class="clearfix">
					<p class="text-form">
						<label>Package Tours:</label>
						<select name="category">
							<option value="">All Package</option>
							<? foreach($categories as $category) {
								echo '<option value="'.$category->id.'">'.$category->name.'</option>';
							} ?>
						</select>
					</p>
				</div>
				<div class="clearfix">
					<div class="text-form center">
						<input type="submit" class="search-button" value=""/>
					</div>
				</div>
			</div>
		</div>
		<div class="overlay"></div>
		<div class="signature">
			www.travelovietnam.com
		</div>
	</div>
	<? require_once(APPPATH."views/module/tour/planning.php"); ?>
</div>
<div class="right" style="width: 710px">
	<div id="view-container">
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
