<?
$metas = $this->m_meta->getItems(NULL, 1);
$configured_meta = null;
foreach ($metas as $mt) {
	$request_url1 = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$request_url2 = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$request_url3 = (substr($request_url1, strlen($request_url1)-1) == "/") ? substr($request_url1, 0, strlen($request_url1)-1) : $request_url1;
	$request_url4 = (substr($request_url2, strlen($request_url2)-1) == "/") ? substr($request_url2, 0, strlen($request_url2)-1) : $request_url2;
	if ($mt->url == $request_url1 || $mt->url == $request_url2 || $mt->url == $request_url3 || $mt->url == $request_url4) {
		$configured_meta = $mt;
		break;
	}
}

if (!empty($configured_meta)) {
	// Load configured
	$meta['title']			= $configured_meta->title;
	$meta['keywords']		= $configured_meta->keywords;
	$meta['description']	= $configured_meta->description;
	$meta['canonical']		= $configured_meta->canonical;
	$meta['addition_tags']	= $configured_meta->addition_tags;
}
else {
	// Load default
	if (empty($meta['title'])) {
		$meta['title'] = "Vietnam Travel - Travel to Vietnam - Vietnam Travel Guide";
	}
	if (empty($meta['keywords'])) {
		$meta['keywords'] = "vietnam travel, travel to vietnam, vietnam tours, tours in vietnam, vietnam hotels, hotels in vietnam, vietnam visa, visa to vietnam";
	}
	if (empty($meta['description'])) {
		$meta['description'] = "Book travel for less with specials on cheap airline tickets, hotels, car rentals, and flights on TraveloVietnam.com, your one-stop resource for travel and vacation needs";
	}
}

if (empty($meta['author'])) {
	$meta['author'] = "TraveloVietnam.Com";
}
?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
		<title><?= $meta['title'] ?></title>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content="<?=$meta['description']?>" />
		<meta name="news_keywords" content="<?=$meta['keywords']?>" />
		<meta name="robots" content="index,follow" />
		<meta name="googlebot" content="index,follow" />
		<meta name="author" content="<?=$meta['author']?>" />
		<meta name="google-site-verification" content="RcXIp9Nc_VTuo4_vVmcPHyLlLCSChqSMpYQaZcDuP7Q" />
		
		<style type="text/css">
			.left {
				float: left;
			}
			.right {
				float: right;
			}
			.clr {
				clear: both;
			}
			.fancypopup {
				width: 980px;
			}
			.fancypopup .photo {
				width: 640px;
				overflow: hidden;
			}
			.fancypopup .photo img {
				max-width: 640px;
				max-height: 500px;
			}
			.fancypopup .detail {
				margin-left: 15px;
				width: 325px;
			}
			.fancypopup .detail .name {
				font-size: 18px;
				font-weight: normal;
			}
			.fancypopup .detail .description {
				margin-top: 10px;
				font-size: 12px;
			}
			.fancypopup .detail .description p {
				line-height: 18px;
			}
			.fancypopup .detail .share {
				margin-top: 20px;
			}
			.fancypopup .detail .comment {
				margin-top: 15px;
			}
		</style>
	</head>
	<body>
		<div class="fancypopup">
			<div class="photo left">
				<img alt="" src="<?=$item->file_path?>">
			</div>
			<div class="detail left">
				<h1 class="name"><?=$item->name?></h1>
				<div class="description">
					<?=$item->description?>
				</div>
				<div class="share">
					<div class="addthis_toolbox addthis_default_style" addthis:url="<?=$current_url?>">
						<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
						<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
						<a class="addthis_button_tweet"></a>
						<a class="addthis_counter addthis_pill_style"></a>
					</div>
					<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51bebb7f7f132dfb"></script>
					<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.min.js"></script>
					<script type="text/javascript">
						$(document).ready(function() {
							if (window.addthis){
								window.addthis = null;
								for (var i in window) {
									if (i.match(/^_at/)) {
										window[i]=null;
									}
								}
						    }
						});
					</script>
				</div>
			</div>
			<div class="clr"></div>
		</div>
	</body>
</html>