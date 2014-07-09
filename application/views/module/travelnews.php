<?
	$info->catid = $this->m_content_category->load('travel-news')->id;
	$tv_news = $this->m_content->getItems($info, 1);
?>
<div>
	<div class="left senior-recommendation">
		<h3>RECOMMENDED FROM SENIOR TRAVELERS<span></span></h3>
		<ul>
			<li>Accommodations</li>
			<li>Restaurants</li>
			<li>Places</li>
			<li class="last">Weather Vietnam</li>
		</ul>
	</div>
	<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.marquee.min.js"></script>
	<div class="left whatnew">
		<h3>WHAT'S NEW<span class="viewall"><a href="<?=site_url("news")?>">View all &raquo;</a></span></h3>
		<div id="news-container">
			<ul id="marqueecontainer" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">
			<?	foreach ($tv_news as $news) { ?>
				<li>
					<a href="<?=site_url("news/view/".$news->alias)?>" title="<?=$news->alias?>"><?=$news->title?></a>
					<?=$news->summary?>
				</li>
			<?	} ?>
			</ul>
		</div>
	</div>
	<div class="right facebook-channel">
		<h3>FIND US ON FACEBOOK<span></span></h3>
		<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fplatform&amp;width=310&amp;height=200&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color=%23FFFFFF&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:310px; height:160px;" allowTransparency="true"></iframe>
	</div>
</div>
<div class="clr"></div>
<br>
<p class="footer-note">*Savings based on all vacation package bookings with Flight + Hotel on Travelovietnam.com in 2013, as compared to price of the same components booked separately.<br/>Savings will vary based on origin/destination, length of trip, stay dates and selected travel supplier(s). Savings not available on all packages.</p>