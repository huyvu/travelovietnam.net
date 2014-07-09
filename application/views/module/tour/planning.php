<script type="text/javascript">
	$(document).ready(function() {
		$("#tour-request").click(function() {
			$.fancybox({
				href: this.href,
				type: 'iframe',
				openEffect: 'elastic',
				closeEffect: 'elastic',
				width: 500,
				height: 600
			});
			return false;
		});
		$("#interactive-map").click(function() {
			$.fancybox({
				href: this.href,
				type: 'iframe',
				openEffect: 'elastic',
				closeEffect: 'elastic',
				width: 500,
				height: 600
			});
			return false;
		});
	});
</script>
<div id="planning-tool">
	<div class="content">
		<ul>
			<li class="tour-request"><a id="tour-request" title="Tour request" href="<?=site_url("tours/request")?>">Tour request</a></li>
			<li class="interactive-map"><a id="interactive-map" title="Interactive Maps" href="<?=site_url("tours/interactive-maps")?>">Interactive Maps</a></li>
			<li class="travel-expirence"><a title="Travel Guide" href="">Travel Guide</a></li>
			<li class="faq"><a title="Tour FAQs" href="<?=site_url("tours/faqs")?>">FAQs</a></li>
		</ul>
	</div>
</div>