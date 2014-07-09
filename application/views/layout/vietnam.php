<!DOCTYPE html>
<html lang="en-US">
	<head>
		<!-- header -->
		<? require_once(APPPATH."views/module/head_html.php"); ?>
		<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>vietnam.css" />
		<!--end header-->
	</head>
	<body>
		<!-- body content -->
		<div id="page">
			<!-- header -->
			<? require_once(APPPATH."views/module/tour/header.php"); ?>
			<!-- end header -->
			<div id="pagecontent">
				<div id="content">
					<?=$content ?>
				</div>
				<div class="clr"></div>
				<!-- footer -->
				<? require_once(APPPATH."views/module/tour/footer.php"); ?>
				<!-- end footer -->
			</div>
		</div>
		<a class="scrollup" href="#"></a>
	</body>
</html>
