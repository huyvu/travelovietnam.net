<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>help.css" rel="stylesheet" />

<div class="inner">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Help Center" href="<?=site_url("help/support")?>">Help Center</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="<?=$category->name?>" href="<?=site_url("help/category/".$category->alias)?>"><?=$category->name?></a>
		<img alt="" src="<?=IMG_URL?>arrow.png"><?=$item->title?>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div class="help-center">
		<div class="left help-content">
			<div class="main-banner">
				<div class="support-banner"></div>
			</div>
			<div class="contact-options">
				<div class="left email-us">
					<a href="<?=site_url("help/emailus")?>"><div class="label">Email Us</div></a>
				</div>
				<div class="left new-ticket">
					<a href="<?=site_url("help/newticket")?>"><div class="label">Submit Ticket</div></a>
				</div>
				<div class="left live-chat">
					<a><div class="label">Chat Online</div></a>
				</div>
				<div class="left call-us">
					<a><div class="label">Call Us</div></a>
				</div>
				<div class="clr"></div>
			</div>
			<div style="padding: 10px;">
				<div class="help-box popular-questions">
					<div class="hd">
						<h1 class="title"><?=$item->title?></h1>
					</div>
					<div class="bd-content">
						<?=$item->content?>
					</div>
				</div>
				<? if (!empty($otheritems) && sizeof($otheritems)) { ?>
				<div class="related-questions">
					<div class="hd">
						<h3>Related Information</h3>
					</div>
					<div class="bd clearfix">
						<ul class="items">
							<? foreach ($otheritems as $item) { ?>
							<li><a title="<?=$item->title?>" href="<?=site_url("help/category/".$category->alias."/".$item->alias)?>"><?=$item->title?></a></li>
							<? } ?>
						</ul>
					</div>
				</div>
				<? } ?>
			</div>
		</div>
		<div class="right" style="width: 280px;">
			<? require_once(APPPATH."views/help/categories.php"); ?>
		</div>
		<div class="clr"></div>
	</div>
</div>