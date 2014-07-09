<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>help.css" />
<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Testimonials
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="page-title">CUSTOMER'S REVIEW</h1>
	<div class="about">
		<div class="left about-content">
			<div id="testimonial">
				<div class="header">
					<p class="desc">Still deciding if a Travelovietnam is for you? Many of our travellers have experienced the adventure of a lifetime and are now more than happy to share their stories with you. Check out these adventure travel trip reviews or search for feedback by region, country or trip.
					<br>Have you been on a Travelovietnam trip before? Fill out an evaluation, and let us and other travelers hear about it!</p>
				</div>
				<div class="content">
					<?
						$nations = $this->m_nation->getItems(1);
					?>
					<div class="comments">
						<ul id="page-1">
						<?
						$cnt  = 0;
						$page = 1;
						for ($i=0; $i<sizeof($reviews); $i++) {
							if ($cnt != 0 && ($cnt % 5) == 0) {
								$page++;
								$cnt = 0;
						?>
						</ul>
						<ul id="page-<?=$page?>" class="none">
						<?
								}
							$cnt++;
						?>
							<li>
								<div class="comment">
									<div class="<?=(($i%2)?"cright":"cleft")?>">
										<div class="review-overall">
											<div class="avatar">
												<? if (!empty($reviews[$i]->avatar)) { ?>
												<img alt="<?=$reviews[$i]->author?>" src="<?=$reviews[$i]->avatar?>" />
												<? } else { ?>
												<img alt="no-avatar" src="<?=IMG_URL?>help/no-avatar.png" />
												<? } ?>
											</div>
											<div class="author">
												<?=$reviews[$i]->author?>
											</div>
											<div class="date">
												<?=date('d M Y', strtotime($reviews[$i]->created_date))?>
											</div>
											<div class="rating">
												<img alt="" src="<?=IMG_URL?>star<?=$reviews[$i]->rating?>.png" />
											</div>
											<div class="overall">
												Overall:
												<strong>
												<?
													switch ($reviews[$i]->rating) {
														case 1: echo "Dissatified"; break;
														case 2: echo "Need Improve"; break;
														case 3: echo "Normal"; break;
														case 4: echo "Satified"; break;
														case 5: echo "Very Satified"; break;
													}
												?>
												</strong>
											</div>
										</div>
										<div class="review-content">
											<div class="summary">
												<div class="quote"></div>
												<?=$reviews[$i]->content?></div>
										</div>
									</div>
									<div class="clr"></div>
								</div>
							</li>
							<? } ?>
						</ul>
						<div class="clr"></div>
						<? if ($page > 1) { ?>
						<div style="margin-top: 15px; text-align: center">
							<div id="light-pagination" class="pagination clr"></div>
						</div>
						<? } ?>
					</div>
					<div class="review-module">
						<div id="review-container">
							<div class="summary-box">
								<div class="label">Write your review</div>
							</div>
							<div class="review-form">
								<table class="tbl-review" cellpadding="6" cellspacing="0" border="0">
									<tr>
										<td>Your name <span class="required">*</span></td><td>:</td>
										<td><input type="text" id="review-author" name="review-author" /></td>
									</tr>
									<tr>
										<td>Nationality <span class="required">*</span></td><td>:</td>
										<td>
											<select id="review-nationality" name="review-nationality">
												<option value="">Select...</option>
												<? foreach ($nations as $nation) { ?>
												<option value="<?=$nation->name?>"><?=$nation->name?></option>
												<? } ?>
											</select>
										</td>
									</tr>
									<tr>
										<td>Tour name</td><td>:</td>
										<td><input type="text" id="review-title" name="review-title" /></td>
									</tr>
									<tr>
										<td style="vertical-align: top !important;">Review Content <span class="required">*</span></td><td style="vertical-align: top !important;">:</td>
										<td><textarea rows="" cols="" id="review-content" name="review-content"></textarea></td>
									</tr>
									<tr>
										<td>Rating <span class="required">*</span></td><td>:</td>
										<td>
											<input type="radio" id="5stars" name="review-rating" value="5" checked="checked" /><label for="5stars" class="rating-label">Very Satified</label>
											<input type="radio" id="4stars" name="review-rating" value="4" /><label for="4stars" class="rating-label">Satified</label>
											<input type="radio" id="3stars" name="review-rating" value="3" /><label for="3stars" class="rating-label">Normal</label>
											<input type="radio" id="2stars" name="review-rating" value="2" /><label for="2stars" class="rating-label">Need Improve</label>
											<input type="radio" id="1star"  name="review-rating" value="1" /><label for="1star" class="rating-label">Dissatified</label>
										</td>
									</tr>
									<tr>
										<td>Captcha <span class="required">*</span></td><td>:</td>
										<td><input type="text" id="review-code" name="review-code" style="width: 60px"/> <label class="security-code"><?=$this->util->createSecurityCode()?></label></td>
									</tr>
									<tr>
										<td colspan="2"></td>
										<td><i>Reviews are typically posted within 24 hours, pending approval.</i></td>
									</tr>
									<tr>
										<td colspan="2"></td>
										<td>
											<input type="button" id="review-submit-btn" name="review-btn" class="review-btn" value="Submit" />
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="right" style="width: 280px">
			<div id="about-view-nav">
				<ul>
					<li>
						<a class="about-us" title="" href="<?=site_url("about")?>">ABOUT US</a>
					</li>
					<li>
						<a class="why-us" title="" href="<?=site_url("whyus")?>">WHY CHOOSE US</a>
					</li>
					<li>
						<a class="our-team" title="" href="<?=site_url("team")?>">OUR TEAM</a>
					</li>
					<li>
						<a class="testimonial-selected" title="" href="<?=site_url("testimonial")?>">TESTIMONIAL</a>
					</li>
					<li>
						<a class="community" title="" href="<?=site_url("community")?>">OUR COMMUNITY</a>
					</li>
					<li>
						<a class="blog" title="" href="<?=site_url("blog")?>">OUR BLOG</a>
					</li>
				</ul>
			</div>
			<? require_once(APPPATH."views/module/about/customer_review.php"); ?>
			<? require_once(APPPATH."views/module/tour/customize.php"); ?>
			<? require_once(APPPATH."views/module/social/fb_like_box.php"); ?>
		</div>
		<div class="clr"></div>
	</div>
</div>

<link type="text/css" rel="stylesheet" href="<?=TPL_URL?>jquery/css/pagination.css"/>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.pagination.js"></script>
<script type="text/javascript">
	$(function() {
		var hashVal = window.location.hash;
		var curPage = ((hashVal != null && hashVal != "") ? hashVal.substr(-1,1) : 1);
		var numofitem = '<?=sizeof($reviews)?>';
		if ((numofitem / 5) > 1) {
			$("#light-pagination").pagination({
		        items: numofitem,
		        itemsOnPage: 5,
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
	}
	
	$(document).ready(function() {
		$("#review-submit-btn").click(function(){
			var p = {};
			p["author"]		= $("#review-author").val();
			p["nationality"]= $("#review-nationality").val();
			p["title"] 		= $("#review-title").val();
			p["content"] 	= $("#review-content").val();
			p["rating"] 	= $("input[name='review-rating']:checked").val();
			p["code"] 		= $("#review-code").val();
			
			var err = 0;
			if (p["author"] == "") {
				$("#review-author").addClass("error");
				err++;
			} else {
				$("#review-author").removeClass("error");
			}
			if (p["nationality"] == "") {
				$("#review-nationality").addClass("error");
				err++;
			} else {
				$("#review-nationality").removeClass("error");
			}
			if (p["content"] == "") {
				$("#review-content").addClass("error");
				err++;
			} else {
				$("#review-content").removeClass("error");
			}
			if (p["code"] == "") {
				$("#review-code").addClass("error");
				err++;
			} else {
				$("#review-code").removeClass("error");
			}
			
			if (err == 0) {
				$.post("<?=site_url("testimonial/post")?>", p);
				
				$("#review-author").val("");
				$("#review-author").removeClass("error");
				
				$("#review-nationality").val("");
				$("#review-nationality").removeClass("error");
				
				$("#review-content").val("");
				$("#review-content").removeClass("error");
				
				$("input[name='review-rating']:checked").val();
				
				$("#review-code").val("");
				$("#review-code").removeClass("error");
				
				msgbox("Your review is posted successful and pending for approval.", "Thank you!");
			} else {
				msgbox("Please fill-in all required fields(*) before submiting your review!");
			}
		});
	});
</script>