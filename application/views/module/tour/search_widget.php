<div id="tour-advance-search-widget">
	<div id="simple-mode" class="container">
		<form action="<?=site_url("tours/search")?>" method="GET">
			<input type="hidden" id="search-type" name="smode" value="quick">
			<h1 class="widget-title">QUICK FINDER</h1>
			<div class="widget-content">
				<div class="clearfix">
					<p class="text-form">
						<input type="text" id="search-text" name="q" class="text-input" value="<?=(!empty($search->search_text) ? $search->search_text : "")?>" placeholder="Enter a destination, tour name or code" />
					</p>
				</div>
				<div class="clearfix">
					<div class="text-form" style="padding: 0px 10px">
						<div class="left">
							<a class="advance-search" title="" href="<?=site_url("tours/search")?>">Clear all filters &raquo;</a>
						</div>
						<div class="right">
							<input type="submit" class="search-button" value="SHOW TRIPS"/>
						</div>
						<div class="clr"></div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>