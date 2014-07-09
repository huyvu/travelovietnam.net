<?
	$nations = $this->m_nation->getItems(1);
	
	$review_info->category_id	= $category_id;
	$review_info->ref_id		= $ref_id;
	$review_info->topLevel		= 1;
	$reviews = $this->m_review->getItems($review_info, 1);
	
	$avg_rating = 3;
	foreach ($reviews as $review) {
		$avg_rating += $review->rating;
	}
	$avg_rating = round($avg_rating / (sizeof($reviews)+1));
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#new-review").click(function(){
		if ($(".review-form").is(":hidden")){
			$(".review-form").slideDown("fast");
		}
		else{
			$(".review-form").slideUp("fast");
		}
	});
	$("#review-cancel-btn").click(function(){
		$(".review-form").slideUp("fast");
	});
	$("#review-submit-btn").click(function(){
		var p = {};
		p["author"]		= $("#review-author").val();
		p["email"]		= $("#review-email").val();
		p["nationality"]= $("#review-nationality").val();
		p["title"] 		= $("#review-title").val();
		p["content"] 	= $("#review-content").val();
		p["rating"] 	= $("input[name='review-rating']:checked").val();
		p["code"] 		= $("#review-code").val();
		p["category_id"]= '<?=$category_id?>';
		p["ref_id"] 	= '<?=$ref_id?>';

		var err = 0;
		if (p["author"] == "") {
			$("#review-author").addClass("error");
			err++;
		} else {
			$("#review-author").removeClass("error");
		}
		if (p["email"] == "") {
			$("#review-email").addClass("error");
			err++;
		} else {
			$("#review-email").removeClass("error");
		}
		if (p["nationality"] == "") {
			$("#review-nationality").addClass("error");
			err++;
		} else {
			$("#review-nationality").removeClass("error");
		}
		if (p["title"] == "") {
			$("#review-title").addClass("error");
			err++;
		} else {
			$("#review-title").removeClass("error");
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
			$.post("<?=site_url("review/post")?>", p);
			$(".review-form").slideUp("fast");
		}
	});
});
</script>
<div id="review-container">
	<div class="summary-box">
		<div class="left">
			<div class="label left">Overall Rating</div>
			<div class="rating left"><img alt="no-avatar" src="<?=IMG_URL?>star<?=$avg_rating?>.png" /></div>
			<div class="clr"></div>
			<div class="count"><?=sizeof($reviews)?> Reviews</div>
		</div>
		<div class="right">
			<div class="label">Have Your Say</div>
			<div class="button">
				<input type="button" id="new-review" name="review-btn" class="review-btn" value="Write a Review" />
			</div>
		</div>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
	<div class="review-form">
		<table class="tbl-review" cellpadding="4" cellspacing="0" border="0">
			<tr>
				<td>Your name<span class="required">*</span></td><td>:</td>
				<td><input type="text" id="review-author" name="review-author" /></td>
			</tr>
			<tr>
				<td>Email<span class="required">*</span></td><td>:</td>
				<td><input type="text" id="review-email" name="review-email" /></td>
			</tr>
			<tr>
				<td>Nationality<span class="required">*</span></td><td>:</td>
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
				<td>Title<span class="required">*</span></td><td>:</td>
				<td><input type="text" id="review-title" name="review-title" /></td>
			</tr>
			<tr>
				<td>Message<span class="required">*</span></td><td>:</td>
				<td><textarea rows="" cols="" id="review-content" name="review-content"></textarea></td>
			</tr>
			<tr>
				<td>Rating<span class="required">*</span></td><td>:</td>
				<td>
					<input type="radio" id="1star"  name="review-rating" value="1" /><label for="1star"><img alt="1 star" src="<?=IMG_URL?>star1.png" /></label>
					<input type="radio" id="2stars" name="review-rating" value="2" /><label for="2stars"><img alt="2 stars" src="<?=IMG_URL?>star2.png" /></label>
					<input type="radio" id="3stars" name="review-rating" value="3" checked="checked" /><label for="3stars"><img alt="3 stars" src="<?=IMG_URL?>star3.png" /></label>
					<input type="radio" id="4stars" name="review-rating" value="4" /><label for="4stars"><img alt="4 stars" src="<?=IMG_URL?>star4.png" /></label>
					<input type="radio" id="5stars" name="review-rating" value="5" /><label for="5stars"><img alt="5 stars" src="<?=IMG_URL?>star5.png" /></label>
				</td>
			</tr>
			<tr>
				<td>Captcha<span class="required">*</span></td><td>:</td>
				<td><input type="text" id="review-code" name="review-code" style="width: 60px"/> <label class="security-code"><?=$this->util->createSecurityCode()?></label></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td><i><span class="required">*</span>Reviews are typically posted within 24 hours, pending approval.</i></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td>
					<input type="button" id="review-submit-btn" name="review-btn" class="review-btn" value="Submit" />
					<input type="button" id="review-cancel-btn" name="review-btn" class="review-btn" value="Cancel" />
				</td>
			</tr>
		</table>
	</div>
	<div class="review-box">
		<? foreach ($reviews as $review) { ?>
		<div class=item>
			<div class="left" style="width: 180px">
				<div class="rating"><img alt="no-avatar" src="<?=IMG_URL?>star<?=$review->rating?>.png" /></div>
				<div class="left">
					<div class="avatar"><img alt="no-avatar" src="<?=IMG_URL?>no-avatar.gif" /></div>
				</div>
				<div class="left">
					<div class="name"><?=$review->author?></div>
					<div class="location"><?=$review->nationality?></div>
				</div>
			</div>
			<div class="left" style="width: 470px; margin-left: 10px;">
				<div class="title"><?=$review->title?></div>
				<div class="date"><?=date('M d, Y', strtotime($review->created_date))?></div>
				<div class="text">
					<?=$review->content?>
				</div>
				<?
					$respond_info->parent_id = $review->id;
					$respond = $this->m_review->getItems($respond_info);
					if (!empty($respond)) {
				?>
				<div class="respond">
					<div class="title">Response from <?=SITE_NAME?></div>
					<div class="date"><?=date('M d, Y', strtotime($respond->created_date))?></div>
					<div class="text">
						<?=$respond->content?>
					</div>
				</div>
				<? } ?>
			</div>
			<div class="clr"></div>
		</div>
		<? } ?>
	</div>
</div>