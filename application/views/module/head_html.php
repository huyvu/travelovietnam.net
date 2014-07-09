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
	if (empty($meta['canonical'])) {
		$meta['canonical'] = "";
	}
	if (empty($meta['addition_tags'])) {
		$meta['addition_tags'] = "";
	}
}

if (empty($meta['author'])) {
	$meta['author'] = "TraveloVietnam.Com";
}
?>

<title><?= $meta['title'] ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="<?=$meta['description']?>" />
<meta name="keywords" content="<?=$meta['keywords']?>" />
<meta name="news_keywords" content="<?=$meta['keywords']?>" />
<meta name="robots" content="index,follow" />
<meta name="googlebot" content="index,follow" />
<meta name="author" content="<?=$meta['author']?>" />
<meta name="google-site-verification" content="RcXIp9Nc_VTuo4_vVmcPHyLlLCSChqSMpYQaZcDuP7Q" />

<?=$meta['addition_tags']?>

<link rel='SHORTCUT ICON' href='<?=BASE_URL?>/favicon.ico'/>
<? if (!empty($meta['canonical'])) { ?>
<link rel="canonical" href="<?=$meta['canonical']?>"/>
<? } ?>
<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>site.css" />
<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/jquery.ui.css" />
<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/fancybox.css" />
<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/jquery.onebyone.css" />
<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/slide.css" />
<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/animate.css" />
<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/wt-scroller.css" />
<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/wt-lightbox.css" />

<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.ui.min.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.fancybox.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.onebyone.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.touchwipe.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.wt-scroller.min.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.wt-lightbox.min.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.wt-preview.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.lazy.min.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>js/tooltip.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>js/util.js"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45889774-1', 'travelovietnam.com');
  ga('send', 'pageview');
</script>

<script language="javascript" type="text/javascript">
//<![CDATA[
var cot_loc0=(window.location.protocol == "https:")? "https://secure.comodo.net/trustlogo/javascript/cot.js" :
"http://www.trustlogo.com/trustlogo/javascript/cot.js";
document.writeln('<scr' + 'ipt language="JavaScript" src="'+cot_loc0+'" type="text\/javascript">' + '<\/scr' + 'ipt>');
//]]>
</script>