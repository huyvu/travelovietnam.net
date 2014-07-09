<script type="text/javascript">
	$(document).ready(function() {
		$('#travelslide').oneByOne({
			className: 'travelads',	             
			easeType: 'random',
			slideShow: true,
			pauseByHover: true,
			delay: 1000,
			slideShowDelay: 5000
		});
		
		$("#morehotels").click(function() {
			$(this).attr("class","");						 
			if ($("#listhotels").is(":hidden")){
				$("#listhotels").slideDown("fast");
			}
			else{
				$("#listhotels").slideUp("fast");
				$(this).attr("class","");
			}
		});
	});
</script>
<div id="home-wizban">
	<div id="travelslide">
	</div>
	<? require_once(APPPATH."views/module/hotel/search_widget.php"); ?>
</div>
<div id="content">
	<div class="">
		<div class="right" style="width: 710px">
			<div class="recommendation">
				<h1>FEATURE HOTEL OFFERS</h1>
				<ul style="min-height: 180px">
					<?	for ($i=0; $i<4 && $i<sizeof($featured_hotels); $i++) {
							$hotel = $featured_hotels[$i];
					?>
					<li class="<?=(($i==0)?"first":(($i==3)?"last":""))?>">
						<a title="<?=$hotel->name?>" href="<?=site_url("hotels/vietnam/{$hotel->city_alias}/{$hotel->alias}")?>"><img alt="<?=$hotel->name?>" width="170px" height="130px" src="<?=$hotel->thumbnail?>"></a>
						<div class="name"><a title="<?=$hotel->name?>" href="<?=site_url("hotels/vietnam/{$hotel->city_alias}/{$hotel->alias}")?>"><?=$hotel->name?></a></div>
						<div class="left">From <span class="price"><?=$hotel->price?> USD</span></div>
						<div class="right"><img src="<?=IMG_URL?>capture.png" /></div>
					</li>
					<?	} ?>
				</ul>
			</div>
		</div>
		<div class="clr"></div>
	</div>
	<div class="hotels">
		<div class="hotels-l">
			<div class="besttabs">
				<h2>Best Selling Hotels in</h2>
				<ul id="citytab">
					<li class="default" id="top-city-1">
						<a id="1" class="top-cities" href="<?=site_url("hotels/vietnam/ho-chi-minh")?>">Ho Chi Minh City</a>
					</li>
					<li class="default" id="top-city-2">
						<a id="1" class="top-cities" href="<?=site_url("hotels/vietnam/ha-noi")?>">Hanoi</a>
					</li>
					<li class="default" id="top-city-3">
						<a id="1" class="top-cities" href="<?=site_url("hotels/vietnam/da-nang")?>">Danang</a>
					</li>
					<li>
						<div style="position:relative;"><a id="morehotels" href="javascript:void(0);" class="">More »</a></div>
						<div id="listhotels" style="display: none;">
                        	<ul>
                        		<li>
	                				› <a id="1" class="more-top-cities" href="<?=site_url("hotels/vietnam/hoi-an")?>">Hoi An</a>
	                			</li>
			                	<li>
	                				› <a id="1" class="more-top-cities" href="<?=site_url("hotels/vietnam/nha-trang")?>">Nha Trang</a>
	                			</li>
			                	<li>
	                				› <a id="1" class="more-top-cities" href="<?=site_url("hotels/vietnam/da-lat")?>">Da Lat</a>
	                			</li>
			                	<li>
	                				› <a id="1" class="more-top-cities" href="<?=site_url("hotels/vietnam/phan-thiet")?>">Phan Thiet - Mui ne</a>
	                			</li>
			                	<li class="last">
	                				› <a id="1" class="more-top-cities" href="<?=site_url("hotels/vietnam/ha-long")?>">Halong</a>
	                			</li>
			                </ul>
                        </div>
					</li>
				</ul>
			</div>
			<ul id="topListHotels" class="listhotels">
				<? foreach($best_sale_hotels as $hotel) { ?>
				<li>
					<a title="<?=$hotel->name?>" href="<?=site_url("hotels/vietnam/{$hotel->city_alias}/{$hotel->alias}")?>">
						<img width="100px" height="100px" alt="<?=$hotel->name?>" title="<?=$hotel->name?>" src="<?=$hotel->thumbnail?>" class="img-asyn thumb">
					</a>
					<span class="info">
						<h2><a title="<?=$hotel->name?>" href="<?=site_url("hotels/vietnam/{$hotel->city_alias}/{$hotel->alias}")?>"><?=$hotel->name?></a></h2>
						<p class="top-star"><img class="starhotel star<?=$hotel->star?>" alt="<?=$hotel->star?> star" title="<?=$hotel->star?> star" src="<?=IMG_URL?>trans.gif"></p>
						<span><font class="price">From: <font style="color:#888888"><strong><?=$hotel->price?></strong> USD</font></span>
						<p style="margin-top:6px;"><?=$hotel->address?></p>
					</span>
				</li>
				<? } ?>
			</ul>
		</div>
		<div class="hotels-r">
			<div class="ttpromotion">
				HOTEL PROMOTION
			</div>
			<ul class="listprm">
				<? foreach($promotion_hotels as $hotel) { ?>
				<li>
					<h2><a title="<?=$hotel->name?>" href="<?=site_url("hotels/vietnam/{$hotel->city_alias}/{$hotel->alias}")?>"><?=$hotel->name?></a></h2>
					<p><img class="starhotel star<?=$hotel->star?>" alt="<?=$hotel->name?>" title="<?=$hotel->name?>" src="<?=IMG_URL?>trans.gif"> <?=$this->m_hotel_destination->load($hotel->city)->name?></p>
					<p>DEAL : Save up to <font class="num"><?=round((($hotel->original_price - $hotel->price)/$hotel->original_price)*100)?>%</font>.  Only from: <font class="num"><?=$hotel->price?></font><font style="color:#888888"> USD</font></p>
				</li>
				<? } ?>
				<li class="end">
					<a class="view" title="View all hotel on deal" href="">View all hotel on deal</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="clr"></div>
	<? require_once(APPPATH."views/module/hotel/destination_select.php"); ?>
</div>
<div class="clr"></div>