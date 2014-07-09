<div class="left">
	<? require_once(APPPATH."views/module/visa/apply_form.php"); ?>
	<? require_once(APPPATH."views/module/visa/support_online.php"); ?>
	<? require_once(APPPATH."views/module/visa/confidence.php"); ?>
</div>
<div class="right" style="width: 710px">
	<div id="view-container">
		<div id="breadcrumbs">
			<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
			<img alt="" src="<?=IMG_URL?>arrow.png">
			<a class="pathway" title="Visa" href="<?=site_url("visa")?>">Visa</a>
			<img alt="" src="<?=IMG_URL?>arrow.png"> Extra Services
			<? require_once(APPPATH."views/module/social.php"); ?>
		</div>
		<h1 class="headtitle">EXTRA SERVICES</h1>
		<div class="extra-service-banner">
			<p>In order to help Foreigners avoid confusing to choose the required services in their trip, <b>travelovietnam.com</b> offer an <b>all-in-one package</b> which covers every little thing the visitor need for their trip, besides the Vietnam visa service via our offical site <a href="<?=BASE_URL?>"><b>www.travelovietnam.com</b></a></p>
		</div>
		<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="100%" valign="top">
					<div style="line-height: 18px">
						<?php 
							if (!empty($items) && sizeof($items)) {
								$cnt = 1;
								$vid = 0;
								$size = sizeof($items);
								foreach ($items as $item) {
									if (!empty($viewItem) && $viewItem->alias == $item->alias) {
										$vid = $cnt;
									}
									?>
									<div class="itemlist">
										<h1 id="f_<?=$cnt?>"><a href="javascript:void(0);" onclick="display_box('<?=$cnt?>', '<?=$size?>');"><?=$cnt?>. <?=$item->title?></a></h1>
										<div id="less_<?=$cnt?>">
											<p><?=$item->summary?></p>
											<span class="view_more"><a href="javascript:void(0);" onclick="display_box('<?=$cnt?>', '<?=$size?>');">» More detail</a></span>
										</div>
										<div id="more_<?=$cnt?>" style="display: none">
											<?
												$types = array("[FLIGHT]", "[HOTEL]", "[TOUR]");
												$ctype = "";
												for ($i=0; $i < sizeof($types); $i++) {
													if (strpos($item->content, $types[$i]) !== FALSE) {
														$item->content = str_ireplace($types[$i], "", $item->content);
														$ctype = $types[$i];
														break;
													}
												}
											?>
											<p><?=$item->content?></p>
											<span class="view_more"><a href="javascript:void(0);" onclick="display_box('<?=$cnt?>', '<?=$size?>');">» Less detail</a></span>
										</div>
									</div>
									<?
									$cnt ++;
								}
							}
						?>
						<? if (!empty($viewItem)) { ?>
						<script type="text/javascript">
							display_box('<?=$vid?>', '<?=$size?>');
						</script>
						<? } ?>
		            </div>
				</td>
			</tr>
		</table>
		<br/>
		<div class="center">
			<a class="red-btn" href="<?=BASE_URL_HTTPS."/visa/apply"?>">APPLY VISA NOW &gt;&gt;</a>
		</div>
	</div>
</div>
<div class="clr"></div>
