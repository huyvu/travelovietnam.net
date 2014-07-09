<!DOCTYPE html>
<html lang="en-US">
	<head>
		<!-- header -->
		<? require_once(APPPATH."views/module/head_html.php"); ?>
		<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>cuisine.css" />
		<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/metro-gallery.css" />
		<script type="text/javascript" src="<?=TPL_URL?>jquery/js/hammer.js"></script>
		<script type="text/javascript" src="<?=TPL_URL?>jquery/js/masonry.pkgd.min.js"></script>
		<script type="text/javascript" src="<?=TPL_URL?>jquery/js/metro-gallery.min.js"></script>
		<!--end header-->
	</head>
	<body>
		<!-- body content -->
		<div id="page">
			<div class="right-img"></div>
			<!-- header -->
			<? require_once(APPPATH."views/module/header.php"); ?>
			<!-- end header -->
			<div id="pagecontent">
				<div id="content">
					<?=$content ?>
				</div>
				<div class="clr"></div>
				<!-- footer -->
				<? require_once(APPPATH."views/module/footer.php"); ?>
				<!-- end footer -->
			</div>
		</div>
		<a class="scrollup" href="#"></a>
	</body>
</html>
