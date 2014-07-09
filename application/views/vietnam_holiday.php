<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>help.css" />
<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>content.css" />
<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Vietnam National Holidays
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div class="header-title">
	   <h1 class="page-title">Vietnam National Holidays</h1>
	</div><!--/.header-title -->
	<div class="about">
		<div class="left about-content">
			<div id="vietnam-holiday">
			<? 
				$currYear 	= date('Y');
				$years 		= $this->m_vietnam_holiday->getYears();	//years to select
			?>
				<h2>Holidays in Vietnam in <?=$year?></h2>
				<div id="year-select">
					Change Year : 
					<select id="year" name="year">
						<?foreach ($years as $y) { ?>
							<option value='<?=$y->year?>' <?=($y->year==$year)?'selected':''?>><?=$y->year?></option>;
						<?}?>
					</select>
				</div><!-- #year-select -->
				<table class="holiday-table" style="width:100%">
					<thead>
						<tr>
							<th>Weekday</th>
							<th>Date</th>
							<th>Holiday Name</th>
						</tr>
					</thead>
					<tbody>
						<?foreach ($items as $item) : 						
							$days = (strtotime($item->to)-strtotime($item->from))/86400;
							if ($days > 0) {
								for ($i=0; $i <= $days; $i++) { ?>
									<tr>
										<td><?= date("l",strtotime($item->from." +".$i." day"))?></td>
										<td><?=date("d F Y",strtotime($item->from." +".$i." day"))?></td>
										<td><?=$item->name?></td>
									</tr>
						<?		}
							}else{
						?>
							<tr>
								<td><?= date("l",strtotime($item->from))?></td>
								<td><?=date("d F Y",strtotime($item->from))?></td>
								<td><?=$item->name?></td>
							</tr>
						<?}
						endforeach?>
					</tbody>
				</table>
			</div><!-- end # vietnam-holiday -->
		</div>
		<div class="right" style="width: 280px;">
			<div id="about-view-nav">
				<ul>
					<li>
						<a class="about-us-selected" title="" href="<?=site_url("about")?>">ABOUT US</a>
					</li>
					<li>
						<a class="why-us" title="" href="<?=site_url("whyus")?>">WHY CHOOSE US</a>
					</li>
					<li>
						<a class="our-team" title="" href="<?=site_url("team")?>">OUR TEAM</a>
					</li>
					<li>
						<a class="testimonial" title="" href="<?=site_url("testimonial")?>">TESTIMONIAL</a>
					</li>
					<li>
						<a class="community" title="" href="<?=site_url("community")?>">OUR COMMUNITY</a>
					</li>
					<li>
						<a class="blog" title="" href="<?=site_url("blog")?>">OUR BLOG</a>
					</li>
				</ul>
			</div>
			<? require_once(APPPATH."views/module/about/customer_review.php"); ?>
			<? require_once(APPPATH."views/module/tour/customize.php"); ?>
			<? require_once(APPPATH."views/module/social/fb_like_box.php"); ?>
		</div><!-- .right -->
		<div class="clr"></div>
	</div>
</div>

<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<script>
!function(d,s,id){
	var js,fjs=d.getElementsByTagName(s)[0];
	if(!d.getElementById(id)){js=d.createElement(s);
		js.id=id;
		js.src="https://platform.twitter.com/widgets.js";
		fjs.parentNode.insertBefore(js,fjs);
	}}(document,"script","twitter-wjs");
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$( "#year" ).change(function() {
			window.location = "<?=site_url()?>" + "vietnam-holidays/" + $(this).val();
		});
	});

</script>

