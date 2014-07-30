<?
	$arrduration = array();
	$arrtype = array();
	$hassupplement = false;

	
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

	$destination = $this->m_tour_destination->load($item->city_alias);

	$things = $this->m_tour_category->getItems(1);
	$cat = $item->category_id;

?>
<link type="text/css" rel="stylesheet" href="<?=CSS_URL?>vietnam.css" />
<link type="text/css" rel="stylesheet" href="<?=TPL_URL?>jquery/css/flexslider.css" />
<link type="text/css" rel="stylesheet" href="<?=TPL_URL?>jquery/css/panorama.css" />
<link type="text/css" rel="stylesheet" href="<?=TPL_URL?>jquery.raty.css"/>
<script type="text/javascript" src="<?=JS_URL?>jquery.raty.js"></script>
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
			> Vietnam City > 
			<a href="<?=site_url("tours/vietnam/{$item->city_alias}")?>"><?=$destination->name?></a> >
			<a href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}")?>"><?=$item->name?></a>
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
						<p>
							Read what other Travelovietnam.com travelers think about the Mekong 
							Delta Discovery Small Group Adventure Tour from Ho Chi Minh City. 
							What they loved, what they liked and what they think could be improved, 
							it's all here to help you make the most of your next trip.
						</p>
						<p><a href="">Click here for tour details, schedule and pricing</a></p>
						<div id="tour-review">
							<div class="title">
								<img src="/vietnamamazing.com/template/images/reviews-icon.png" alt="">
								<h2 class="title">Viewing All <?=sizeof($reviews)?> Reviews</h2>
								<a href="#review-box" class="write-review">Write a Review</a>
							</div>

							<ul id="page-1">
							<?
							$cnt  = 0;
							$page = 1;
							for ($i=0; $i<sizeof($reviews); $i++) {
								if ($cnt != 0 && ($cnt % 4) == 0) {
									$page++;
									$cnt = 0;

							?>
							</ul>
							<ul id="page-<?=$page?>" class="none">
							<?
									}
								$cnt++;
								//option for gavatar
									$default = "mm";
									$size = 52;
									//option for gavatar
									$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $reviews[$i]->email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
							?>
								<li>
									<div class="pull-left user-info">
										<div class="img-circle">
											<img alt="<?=$reviews[$i]->author?>" src="<?=$grav_url?>" class="img-circle">	
										</div>
										<p class="user-name">
											<span><?=$reviews[$i]->author?></span><br/>
										</p>
									</div>
									<!-- end .user-info -->
									<div class="review-content">
										<p style="font-size:13px">
											<img height="15" src="<?=IMG_URL?>tour/icon/star<?=$reviews[$i]->rating?>.png" alt="rating">&nbsp;<?=date('F Y', strtotime($reviews[$i]->created_date))?>
										</p>
										<div class="main-content">
											<p>
												<?=$reviews[$i]->content?>
											</p>
										</div>
									</div>
									<!-- end .review-content -->
								</li>
							<? } ?>
							</ul>
							<div class="clr"></div>
							<? if ($page > 1) { ?>
							<div style="margin-top: 15px; text-align: center">
								<div class="left page-range" style="font-weight:bold">1 - 4 of <?=sizeof($reviews)?> Reviews</div>
								<div id="light-pagination" class="right pagination"></div>
							</div>
							<? } ?>
						</div>
						<!-- end #tour-review -->
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

<!-- Review box for attraction -->
<div style="display:none;width:100%">
	<div id="review-box" >
		<h1>Share your opinion, travel insight & expertise</h1>
		<p style="color:#7e7e7e; font-size:14px">The fields marked<span style="color:red;vertical-align:top">*</span> are mandatory and must be completed.</p>
		<div class="row tour-summary">
			<h1 class="tour-name"><?=$item->name?></h1>
			<div class="col-md-4">
				<div class="tour-thumb" style="height:139px;width:162px">
					<img height="139" src="<?="http://localhost/vietnamamazing.com".$photos[0]->file_path?>" alt="<?=$photos[0]->name?>">
				</div>
			</div>
			<div class="col-md-5">
				<div class="review">
					<img height="15" src="<?=IMG_URL?>tour/icon/star5.png" alt=""> 9 Reviews
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
			<div class="col-md-3">
				<h5>PRICE FROM</h5>
				<h1 style="font-size:40px;font-weight:bold;color:#ff9000">$<?=$item->price?></h1>
			</div>
		</div>
		<!-- end #tour-summary -->
		<p style="font-size:16px; margin-top:15px"><span style="color:red;">*</span> Rate it</p>
		<p style="font-size:14px;color:#7e7e7e; margin-top:15px; line-height:24px"><div id="star"></div>  Roll over and click on the star to make a selection</p>
		<p style="font-size:16px; margin-top:15px;"><span style="color:red;">*</span> Submit your review or leave a reply</p>
		<form action="">
			<div class="form-group">
				<textarea class="form-control" name="content" id="txt_content" rows="5"></textarea>
			</div>
			<p>
				<a class="right btn-review">Submit</a>
				<a  onclick="openInfoPopup();" href="#review-info" id="btt-info" style="visibility:hidden">Submit</a>
				<input type="hidden" id="attraction_id" value="<?=$item->id?>">
				<input type="hidden" id="ip" value="">
				<input type="hidden" id="category_id" value="1">
			</p>
		</form>
	</div>
	<!-- end #review-box -->
</div>


<!-- Popup for user to login to post a review  -->
<div style="display:none">
	<div id="review-info">
		<div class="left">
			<p class="info-title" style="text-align:right">Review with</p>
			<p class="p-social"><a rel="facebook" href="javascript:void(0)" onClick="fbReview('<?php echo site_url("vietnam/insertReview");?>','<?=$item->id?>');" class="login-social lg-facebook"></a></p>
			<p class="p-social"><a rel="google" href="javascript:void(0)" onClick="gpReview();" class="login-social lg-google"></a></p>
		</div>

		<div class="pull-right right">
			<p class="info-title">Or review with your information</p>
			<p class="login-txt">
				<input id="txt_email" type="text" class="txt-login" placeholder="Your Email">
				<span class="errormsg"></span>
			</p>
			<p class="login-txt">
				<input id="txt_fullname" type="text" class="txt-login" placeholder="Your Fullname">
				<span class="errormsg"></span>
			</p>
			<a  class="btt-complete">Submit</a>
			<a  onclick="openSuccessPopup();" href="#review-success" id="btt-success" style="visibility:hidden">Submit</a>
		</div>
	</div>
	<!-- end #review-info -->
</div>

<!-- Successful dialog popup when user submitted review successfully -->
<div style="display:none">
	<div id="review-success">
		That's great ! Your review has been sent successfully.<br/>
		Reviews are typically posted within 24 hours, pending approval.
	</div>
	<!-- end #review-success -->
</div>

<script type="text/javascript" src = "<?=JS_URL?>facebook.js"></script>
<script type="text/javascript" src = "<?=JS_URL?>google-plus.js"></script>
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
		});

		//Star rating jquery plugin
		$("#star").raty({
			path: "<?=IMG_URL?>",
			score: 4,
			starOff     : 'star-off.png',
			starOn      : 'star-on.png',
			scoreName   : 'rating' 
		});

		//Open a popup when click review button
		$(".write-review").fancybox({
			'href'   : '#review-box',
			'width'      : 700,
			'height'     : 630,
			'autoScale'         : false,
			'autoDimensions'	: false,
			'transitionIn'      : 'none',
			'transitionOut'     : 'none',
		})

		//Open popup for user to enter their information when click submit button in review box
		function openInfoPopup(){
			$("a#btt-info").fancybox({
				'width'      : '75%',
				'height'     : '75%',
				'autoScale'         : false,
				'transitionIn'      : 'fadeIn',
				'transitionOut'     : 'fadeOut',
				'hideOnOverlayClick': false
			}).trigger('click');
		}

		function openSuccessPopup(){
			$("a#btt-success").fancybox({
				'width'      : '75%',
				'height'     : '75%',
				'autoScale'         : false,
				'transitionIn'      : 'fadeIn',
				'transitionOut'     : 'fadeOut',
			}).trigger('click');
		}

		//Review box's textarea validation
		$("a.btn-review").click(function(event) {
			var error = 0;
			if ($('#txt_content').val() == '') {
				$('#txt_content').parent().addClass('has-error');
				error++;
			}else{
				$('#txt_content').parent().removeClass('has-error');
			}

			if (error ==0 ) {
				//Check if user is logged in, then insert data to database and display success popup
				var user = "<?=(isset($user))?$user['fullname']:''?>";
				if (user === '') {
					openInfoPopup();
				}else{
					var p = {};
					p['content'] = $('#txt_content').val();
					p['author'] = "<?=(isset($user))?$user['fullname']:''?>";
					p['email'] = "<?=(isset($user))?$user['email']:''?>";
					p['rating'] = $('input[name=rating]').val();
					p['ref_id'] = "<?=$item->id?>";
					p['nationality'] = $('input#ip').val();
					p['category_id'] = $('#category_id').val();

					$.ajax({
						type: "POST",
						url: "<?=site_url('vietnam/insertReview')?>",
						data: p,
						dataType: 'json',
						success: function(result){
							console.log(result);
							if (result[0]) {
								$('#txt_content').val('');
								$('#txt_fullname').val('');
								$('#txt_email').val('');
								openSuccessPopup();	
							}
						},async:false
					});	
				}
			}
		});


		//Review info box validation
		$("a.btt-complete").click(function(event) {
			var error = 0;
			if ($('#txt_email').val() == '') {
				$('#txt_email').addClass('error');
				$('#txt_email').next('.errormsg').text("You can't leave this empty");
				error++;
			}else if(!isEmail($('#txt_email').val())){
				$('#txt_email').addClass('error');
				$('#txt_email').next('.errormsg').text("The input is not a valid email address.");
				error++;
			}else{
				$('#txt_email').removeClass('error');
				$('#txt_email').next('.errormsg').text("");
			}

			if ($('#txt_fullname').val() == '') {
				$('#txt_fullname').addClass('error');
				$('#txt_fullname').next('.errormsg').text("You can't leave this empty");
				error++;
			}else{
				$('#txt_fullname').removeClass('error');
				$('#txt_fullname').next('.errormsg').text("");
			}

			if (error ==0 ) {
				var p = {};
				p['content'] = $('#txt_content').val();
				p['author'] = $('#txt_fullname').val();
				p['email'] = $('#txt_email').val();
				p['rating'] = $('input[name=rating]').val();
				p['ref_id'] = "<?=$item->id?>";
				p['nationality'] = $('input#ip').val();
				p['category_id'] = $('#category_id').val();

				$.ajax({
					type: "POST",
					url: "<?=site_url('vietnam/insertReview')?>",
					data: p,
					dataType: 'json',
					success: function(result){
						console.log(result);
						if (result[0]) {
							$('#txt_content').val('');
							$('#txt_fullname').val('');
							$('#txt_email').val('');
							openSuccessPopup();	
						}
					},async:false
				});
			}
		});
	});
</script>

<link type="text/css" rel="stylesheet" href="<?=TPL_URL?>jquery/css/pagination.css"/>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.pagination.js"></script>
<script type="text/javascript">
	$(function() {
		var hashVal = window.location.hash;
		var curPage = ((hashVal != null && hashVal != "") ? hashVal.substr(-1,1) : 1);
		var numofitem = '<?=sizeof($reviews)?>';
		if ((numofitem / 4) > 1) {
			$("#light-pagination").pagination({
				items: numofitem,
				itemsOnPage: 4,
				currentPage: curPage,
				cssStyle: 'light-theme',
				onPageClick: function(pageNumber){selectPage(pageNumber, numofitem);}
			});
			if (curPage > 1) {
				selectPage(curPage, numofitem);
			}
		}
	});
	
	function selectPage(pageNumber, items) {
		for (var i=1; i<=items; i++) {
			$("#page-"+i).hide();
		}
		$("#page-"+pageNumber).show('fade');
		var from 	= ((pageNumber-1)*4)+1;
		var to 		= ((items-((pageNumber-1)*4))%4)+((pageNumber-1)*4);
		if ((pageNumber*4) < items ) {
			to = pageNumber * 4;
		}
		var str 	= from + " - " + to + " of " + items + " Reviews";
		$(".page-range").html(str);
		console.log(from);
		console.log(to);
	}
</script>