<div id="quick-finder">
	<form action="<?=site_url("tours/search")?>" method="GET">
		<input type="hidden" id="search-type" name="smode" value="quick">
		<h1>TOUR QUICK FINDER</h1>
		<div class="content">
			<div class="left">
				<div class="quick-finder-destination">
					<div class="input">
						<input type="text" id="search-text" name="q" class="text-input" placeholder="Enter a destination, tour name or code" />
					</div>
				</div>
			</div>
			<div class="right">
				<div class="quick-finder-button">
					<input type="submit" class="search-button" value="SEARCH" />
				</div>
			</div>
			<div class="clr"></div>
		</div>
	</form>
</div>