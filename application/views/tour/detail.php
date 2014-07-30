<?
	$arrduration = array();
	$arrtype = array();
	$hassupplement = false;
	foreach ($rates as $rate) {
		if ($rate->single_supplement) {
			$hassupplement = true;
		} else {
			if (!in_array($rate->group_size, $arrduration)) {
				$arrduration[$rate->group_size] = $rate->group_size;
			}
			if (!in_array($rate->name, $arrtype)) {
				$arrtype[$rate->name] = $rate->name;
			}
		}
	}
	
	$arrduration_txt = array();
	$arrduration_key = array_keys($arrduration);
	$arrduration_len = sizeof($arrduration_key);
	for ($k=0; $k<$arrduration_len; $k++) {
		$curr = $arrduration_key[$k];
		$next = ((($k+1) < $arrduration_len) ? $arrduration_key[$k+1] : NULL);
		if (NULL == $next) {
			$arrduration_txt[$curr] = $curr." plus";
		}
		else if (($curr+1) < $next) {
			$arrduration_txt[$curr] = $curr."-".($next-1)." pax/s";
		} else {
			$arrduration_txt[$curr] = $curr.(($curr>1)?" pax/s":" pax");
		}
	}
	
	$depart_from = $this->m_tour_destination->load($item->depart_from);
	$going_to = $this->m_tour_destination->load($item->going_to);
	
	$arrdestination = explode(';', $item->destinations);
	$destinations = array();
	for ($i=0; $i < sizeof($arrdestination); $i++) {
		$destinations[] = $this->m_tour_destination->load($arrdestination[$i]);
	}
	
	$glocations = array();
	foreach ($destinations as $destination) {
		if ($destination->name != $depart_from->name && $destination->name != $going_to->name) {
			$glocations[] = '{location: "'.$destination->name.'"}';
		}
	}

	//Get the city where tour belongs
	$destination = $this->m_tour_destination->load($item->city_alias);

	$things = $this->m_tour_category->getItems(1);
	$cat = $item->category_id;

?>
<link type="text/css" rel="stylesheet" href="<?=TPL_URL?>jquery/css/flexslider.css" />
<link type="text/css" rel="stylesheet" href="<?=TPL_URL?>jquery/css/panorama.css" />
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/droplist.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.easing.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.contentcarousel.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.flexslider.js"></script>

<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/gdl-custom-slider.css" rel="stylesheet" />
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
	
	function showTab(index) {
		var tabs  = new Array("tab1", "tab2", "tab3", "tab4", "tab5", "tab6");
		var navs  = new Array("nav1", "nav2", "nav3", "nav4", "nav5", "nav6");
		for (var i=0; i<tabs.length; i++) {
			if (i == index){
				$("#"+navs[i]).addClass('selected');
				$("#"+tabs[i]).fadeIn();
			} else {
				$("#"+navs[i]).removeClass('selected');
				$("#"+tabs[i]).hide();
			}
		}
		if (index == 1 && !mapshown) {
			initialize();
			calcRoute('<?=$depart_from->name?>', '<?=$going_to->name?>', 'DRIVING');
			mapshown = true;
		}
	}

	$(document).ready(function() {
		$(".expand-all").click(function() {
			$(".less-detail").hide();
			$(".more-detail").show('fade');
		});
		$(".close-all").click(function() {
			$(".less-detail").show('fade');
			$(".more-detail").hide();
		});
		
		$(".view-map").fancybox();

		var dateoptions = {
			numberOfMonths : 2,
			minDate: 0
		};
	
		$("#departure-date").datepicker(dateoptions);
		$('.select-date').click(function(event) {
			console.log('asdd');
			$("#departure-date").trigger('focus');
		});

		$(".expand-all").click(function() {
			$(".less-detail").hide();
			$(".more-detail").show('fade');
		});
		$(".close-all").click(function() {
			$(".less-detail").show('fade');
			$(".more-detail").hide();
		});
	});
</script>
<?
	$shortlist = $this->session->userdata("tour_shortlist");
	if (empty($shortlist)) {
		$shortlist = array();
	}
?>


<div id="tours" class="container">
	<div id="breadcrumbs" class="row">
		<div class="col-md-12">
			<a class="pathway" title="Home" href="<?=site_url("tours/vietnam")?>">Home</a>
			> Vietnam City > <a href="<?=site_url("tours/vietnam/{$item->city_alias}")?>"><?=$destination->name?></a>
		</div>
	</div>
	<!-- end #breadcrumbs -->

	<div id="tour-content" class="row">
		<div class="col-md-9">
			<div class="row tour-summary">
				<h1 class="tour-name"><?=$item->name?></h1>
				<div class="col-md-5">
					<a id="tour-photo-slide" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
						<div class="tour-thumb">
							<img src="<?="http://localhost/vietnamamazing.com".$photos[0]->file_path?>" alt="<?=$photos[0]->name?>">
							<span class="photo-number"><img src="<?=IMG_URL?>white-camera.png" alt=""> <?=sizeof($photos)?> Photos</span>	
						</div>
					</a>
					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">
									<div class="flexslider" id="flex">
										<ul class="slides">
											<?foreach($photos as $photo) :?>
												<li>
													<img src="http://localhost/vietnamamazing.com<?=$photo->file_path?>" />
												</li>
											<?endforeach?>
										</ul>
									</div>
									<!-- end .flexslider -->
									<div id="carousel" class="flexslider">
										<ul class="slides">
											<?foreach($photos as $photo) :?>
												<li>
													<img src="http://localhost/vietnamamazing.com<?=$photo->file_path?>" />
												</li>
											<?endforeach?>
										<!-- items mirrored twice, total of 12 -->
										</ul>
									</div>
									<!-- end #carousel -->
								</div>
							</div>
						</div>
					</div>
					<!-- end #myModal -->
				</div>
				<div class="col-md-6">
					<div class="review">
						<img height="15" src="<?=IMG_URL?>tour/icon/star5.png" alt=""> 9 Reviews | Add your review
					</div>
					<ul class="summary-list">
						<li><span class="summary-label">Code</span>: <?=$item->code?></li>
						<li><span class="summary-label">Duration</span>: Full day</li>
						<li>
							<span class="summary-label">Itinerary</span>: 
							<?
								$arrdestination = explode(';', $item->destinations);
								$destinations = array();
								for ($i=0; $i < sizeof($arrdestination); $i++) {
									$destinations[] = $this->m_tour_destination->load($arrdestination[$i]);
								}
								$destsize = sizeof($destinations);
								// echo "<span style='padding-left:5px; display: table-cell'>";
								for ($i=0; $i < $destsize; $i++) {
									$destination = $destinations[$i];
									echo '<a target="_blank" title="'.$destination->name.', '.$destination->name.' Vietnam, '.$destination->name.' travel guide" href="'.site_url("vietnam/top-destinations/".$destination->alias).'">'.$destination->name.'</a>';
									if ($i < $destsize-1) {
										echo '&nbsp;<img src="'.IMG_URL.'destination-arrow.gif'.'">&nbsp;';
									}
								}
								// echo "</span>";
							?>
						</li>
						<?
							$arrcategory = explode(';', $item->categories);
							$tour_categories = array();
							for ($i=0; $i < sizeof($arrcategory); $i++) {
								$tour_categories[] = $this->m_tour_category->load($arrcategory[$i]);
							}
							$catsize = sizeof($tour_categories);
							if ($catsize > 1) {
								?>
								<li>
								<span class="summary-label">Themes</span>:
								<?
								for ($i=0; $i < $catsize; $i++) {
									$category = $tour_categories[$i];
									echo $category->name;
									if ($i < $catsize-1) {
										echo ', ';
									}
								}
								?>
								</li>
								<?
							}
						?>
					</ul>
				</div>
				<div class="col-md-1">
					<ul class="social-link">
						<li><img src="<?=IMG_URL?>blue-favorite.png" alt=""><a href="">Save</a></li>
						<li><img src="<?=IMG_URL?>blue-email.png" alt=""><a href="">Email</a></li>
						<li><img src="<?=IMG_URL?>blue-print.png" alt=""><a href="">Print</a></li>
						<li><div class="fb-like" data-href="https://www.facebook.com/travelovietnam.services" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div></li>
						<li><a href="https://twitter.com/share" data-count="none" class="twitter-share-button" data-lang="en">Tweet</a></li>
						<li><div class="g-plus" data-action="share" data-annotation="none"></div></li>
					</ul>
					<!-- end .social-link -->
				</div>
			</div>
			<!-- end #tour-summary -->

			<div id="tour-info" class="row">
				<div class="col-md-4">
					<div id="tour-booking-panel">
						<?if ($item->best_deal) :?>
							<img src="<?=IMG_URL?>best-seller.png" alt="" id="best-seller">
						<?endif?>
						
						<div class="tour-rate">
							<h4>From USD</h4>
							<h1><span>$</span><?=$item->price?></h1>
							<a href="">View Tour Rates ></a>
						</div>
						<!-- end .tour-rate -->
						<div class="booking-content">
							<div>
								<h5><span>1</span>Select Travel Date</h5>
								<p>	
									<input type="text" name="departure-date" id="departure-date" placeholder="mm/dd/yyyy">
									<img src="<?=IMG_URL?>calendar-icon.png" alt="" class="select-date">
								</p>
								<h3>FLEXIBLE DATE GUARANTEE</h3>	
							</div>
							<div>
								<h5><span>2</span>Total Travellers</h5>
								<p>
									<label for="adult">Adult <span>(Age 10+)</span></label>
									<select name="adult" id="adult">
										<option value="">1</option>
										<option value="">2</option>
										<option value="">3</option>
										<option value="">4</option>
										<option value="">5</option>
										<option value="">6</option>
										<option value="">7</option>
										<option value="">8</option>
										<option value="">9</option>
										<option value="">10</option>
										<option value="">11</option>
										<option value="">12</option>
										<option value="">13</option>
										<option value="">14</option>
										<option value="">15</option>
										<option value="">16</option>
										<option value="">17</option>
										<option value="">18</option>
										<option value="">19</option>
										<option value="">20</option>		
									</select>	
								</p>
								<p>
									<label for="adult">Child <span>(Age 2-9)</span></label>
									<select name="adult" id="adult">
										<option value="">1</option>
										<option value="">2</option>
										<option value="">3</option>
										<option value="">4</option>
										<option value="">5</option>
										<option value="">6</option>
										<option value="">7</option>
										<option value="">8</option>
										<option value="">9</option>
										<option value="">10</option>
										<option value="">11</option>
										<option value="">12</option>
										<option value="">13</option>
										<option value="">14</option>
										<option value="">15</option>
										<option value="">16</option>
										<option value="">17</option>
										<option value="">18</option>
										<option value="">19</option>
										<option value="">20</option>
									</select>	
								</p>
							</div>
							<a href="" id="book-now">BOOK NOW!</a>
						</div>
						<!-- end .booking-content -->
					</div>
					<!-- end #tour-booking panel -->

					<div id="tour-inclusion-panel">
						<h1>Inclusion</h1>
						<?=$item->price_inclusion?>
					</div>
					<!-- end #tour-inclusion-panel -->

					<div id="tour-exclusion-panel">
						<h1>Exclusion</h1>
						<?=$item->price_exclusion?>
					</div>
					<!-- end #tour-exclusion-panel -->
				</div>

				<div class="col-md-8">
					<div id="tour-detail">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#tour-infomation" role="tab" data-toggle="tab">Tour Information</a></li>
							<li><a href="#important-note" role="tab" data-toggle="tab">Important Note</a></li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane active" id="tour-infomation">
								<div class="title">
									<img src="/vietnamamazing.com/template/images/highlight-icon.png" alt="">
									<h2 class="title">Highlight</h2>
								</div>
								<div class="content">
									<?=$item->highlight?>
								</div>

								<div class="title">
									<img src="/vietnamamazing.com/template/images/expect-icon.png" alt="">
									<h2 class="title">What You Can Expect</h2>
								</div>
								<div class="content">
									
								</div>
							</div>
							<!-- end #tour-infomation -->
							<div class="tab-pane" id="important-note">
								<div id="tour-view-detailed">
									<h2 class="summary-name">TABLE OF CONTENTS</h2>
									<div class="tour-view-tripnote-table-content">
										<ul>
											<? foreach ($tripnotes as $tripnote) { ?>
											<li>
												<a title="" href="javascript:void(0)" onclick="$('.less-detail-<?=$tripnote->id?>').hide(); $('.more-detail-<?=$tripnote->id?>').show('fade'); $('html, body').animate({ scrollTop: $('.more-detail-<?=$tripnote->id?>').offset().top });"><?=$tripnote->title?></a>
											</li>
											<? } ?>
										</ul>
										<div class="clr"></div>
									</div>
									
									<div class="tour-view-div"></div>
									
									<h2 class="summary-name">
										DETAILS
										<span class="pull-right">
											<a class="expand-all">Expand All</a><a class="close-all">Close All</a>
										</span>
									</h2>
									<div class="tour-view-tripnotes">
										<? foreach ($tripnotes as $tripnote) { ?>
											<div class="tour-view-tripnote">
												<div class="less-detail less-detail-<?=$tripnote->id?>">
													<div class="tripnote-header" onclick="$('.less-detail-<?=$tripnote->id?>').hide(); $('.more-detail-<?=$tripnote->id?>').show('fade')">
														<div class="pull-left tripnote-title">
															<?=$tripnote->title?>
														</div>
														<div class="pull-right collapsed">
															<a title="View more"></a>
														</div>
														<div class="clr"></div>
													</div>
												</div>
												<div class="more-detail more-detail-<?=$tripnote->id?>">
													<div class="tripnote-header" onclick="$('.more-detail-<?=$tripnote->id?>').hide(); $('.less-detail-<?=$tripnote->id?>').show('fade')">
														<div class="pull-left tripnote-title">
															<?=$tripnote->title?>
														</div>
														<div class="pull-right expanded">
															<a title="View less"></a>
														</div>
														<div class="clr"></div>
													</div>
													<div class="tripnote-content">
														<div class="tripnote-detail"><?=$tripnote->content?></div>
													</div>
													<div class="clr"></div>
												</div>
											</div>
										<? } ?>
									</div>
								</div>
							</div>
							<!-- end #important-note -->
						</div>
						<!-- end .tab-content -->
						<?if(!empty($reviews)) :?>
						<div id="tour-review">
							<div class="title">
								<img src="/vietnamamazing.com/template/images/reviews-icon.png" alt="">
								<h2 class="title">Traveller Reviews</h2>
								<a href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}/reviews")?>" class="pull-right view-all">See all review ></a>
							</div>

							<ul>
							<?
							$default = "mm";
							$size = 52;
							foreach($reviews as $review) {
								//option for gavatar
								$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $review->email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
							?>
								<li>
									<div class="pull-left user-info">
										<div class="img-circle">
											<img alt="<?=$review->author?>" src="<?=$grav_url?>" class="img-circle">	
										</div>
										<p class="user-name">
											<span><?=$review->author?></span><br/>
										</p>
									</div>
									<!-- end .user-info -->
									<div class="review-content">
										<p style="font-size:13px">
											<img height="15" src="<?=IMG_URL?>tour/icon/star<?=$review->rating?>.png" alt="rating">&nbsp;<?=date('F Y', strtotime($review->created_date))?>
										</p>
										<div class="main-content">
											<p>
												<?=$review->content?>
											</p>
										</div>
									</div>
									<!-- end .review-content -->
								</li>
							<? } ?>
							</ul>
						</div>
						<!-- end #tour-review -->
						<?endif?>
					</div>
					<!-- end #tour-detail -->
				</div>
			</div>
			<!-- end #tour-info -->
		</div>
		<!-- end .col-md-9 -->
		<div id="right" class="col-md-3">
			<? require_once(APPPATH."views/module/need_help.php"); ?>
			<? require_once(APPPATH."views/module/insider_guide.php"); ?>
			<? require_once(APPPATH."views/module/tour/things_to_do.php"); ?>
			<? require_once(APPPATH."views/module/tour/top_attractions.php"); ?>
			<div id="brochure">
				<h1>Destination</h1>
				<h3>Brochure</h3>
				<img style="width:100%" src="<?=IMG_URL?>brochure.jpg" alt="Brochure">
				<a href="">Download <span class="glyphicon glyphicon-download"></span></a>
			</div>
			<!-- end #brochure -->
		</div>
	</div>
</div>
<!-- end .container -->

<input id="tour_id" type="hidden" value="<?=$item->id?>">

<script type="text/javascript">
	$(document).ready(function() {
		$('#tour-view-shortlist-loader').load("<?=site_url('tours/shortlist')?>", null, function(){});
	});
	$('.favorite-add').click(function() {
		var p = {};
		p['tour-id'] = $(this).attr('tourid');
		$('#tour-view-shortlist-loader').load("<?=site_url('tours/shortlist')?>", p, function(){});
		$(this).hide();
		$('.favorite-remove'+$(this).attr('tourid')).show();
	});
	$('.favorite-remove').click(function() {
		var p = {};
		p['tour-id'] = $(this).attr('tourid');
		$('#tour-view-shortlist-loader').load("<?=site_url('tours/remove_shortlist')?>", p, function(){});
		$(this).hide();
		$('.favorite-add'+$(this).attr('tourid')).show();
	});
</script>

<script type="text/javascript">
	//Resize label size when Departure date is not available
	$(function() {
		if($('.departure_date').length <= 0){
			$('.tour-validity .tour-validity-label').css('width','90px');
			$('.tour-destination .tour-destination-label').css('width','90px');
		}
	});

</script>

<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1417412731849527&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<script>
!function(d,s,id){
	var js,fjs=d.getElementsByTagName(s)[0];
	if(!d.getElementById(id)){
		js=d.createElement(s);
		js.id=id;
		js.src="https://platform.twitter.com/widgets.js";
		fjs.parentNode.insertBefore(js,fjs);
	}
}(document,"script","twitter-wjs");
</script>

<script type="text/javascript">
  (function() {
	var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	po.src = 'https://apis.google.com/js/platform.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<script>
	$(document).ready(function() {
		function initFlexModal() {
			$('#carousel').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: false,
				slideshow: false,
				itemWidth: 180,
				itemMargin: 5,
				asNavFor: '#flex'
			});

			$('#flex').flexslider({
				animation: 'slide',
				controlNav: false,
				animationLoop: false,
				slideshow: false,
				sync: "#carousel"
			});
		};

		$('#myModal').on('shown.bs.modal', function () {
			initFlexModal();
		})
	});
</script>