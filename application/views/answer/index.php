<?
	$nations = $this->m_nation->getItems(1);
	
	$question_info->category_id	= $category_id;
	$question_info->ref_id		= $ref_id;
	$question_info->topLevel	= 1;
	$questions = $this->m_question->getItems($question_info, 1);
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#new-question").click(function(){
		if ($(".question-form").is(":hidden")){
			$(".question-form").slideDown("fast");
		}
		else{
			$(".question-form").slideUp("fast");
		}
	});
	$("#question-cancel-btn").click(function(){
		$(".question-form").slideUp("fast");
	});
	$("#question-submit-btn").click(function(){
		var p = {};
		p["fullname"]	= $("#question-fullname").val();
		p["email"]		= $("#question-email").val();
		p["nationality"]= $("#question-nationality").val();
		p["title"] 		= $("#question-title").val();
		p["content"] 	= $("#question-content").val();
		p["code"] 		= $("#question-code").val();
		p["category_id"]= '<?=$category_id?>';
		p["ref_id"] 	= '<?=$ref_id?>';

		var err = 0;
		if (p["fullname"] == "") {
			$("#question-fullname").addClass("error");
			err++;
		} else {
			$("#question-fullname").removeClass("error");
		}
		if (p["email"] == "") {
			$("#question-email").addClass("error");
			err++;
		} else {
			$("#question-email").removeClass("error");
		}
		if (p["nationality"] == "") {
			$("#question-nationality").addClass("error");
			err++;
		} else {
			$("#question-nationality").removeClass("error");
		}
		if (p["title"] == "") {
			$("#question-title").addClass("error");
			err++;
		} else {
			$("#question-title").removeClass("error");
		}
		if (p["content"] == "") {
			$("#question-content").addClass("error");
			err++;
		} else {
			$("#question-content").removeClass("error");
		}
		if (p["code"] == "") {
			$("#question-code").addClass("error");
			err++;
		} else {
			$("#question-code").removeClass("error");
		}

		if (err == 0) {
			$.post("<?=site_url("answer/post")?>", p);
			$(".question-form").slideUp("fast");
		}
	});
});
</script>
<div id="question-container">
	<div class="summary-box">
		<div class="left">
			<div class="count"><?=sizeof($questions)?> Questions</div>
		</div>
		<div class="right">
			<div class="label">Have Your Question</div>
			<div class="button">
				<input type="button" id="new-question" name="question-btn" class="question-btn" value="Ask a Question" />
			</div>
		</div>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
	<div class="question-form">
		<table class="tbl-question" cellpadding="4" cellspacing="0" border="0">
			<tr>
				<td>Your name<span class="required">*</span></td><td>:</td>
				<td><input type="text" id="question-fullname" name="question-fullname" /></td>
			</tr>
			<tr>
				<td>Email<span class="required">*</span></td><td>:</td>
				<td><input type="text" id="question-email" name="question-email" /></td>
			</tr>
			<tr>
				<td>Nationality<span class="required">*</span></td><td>:</td>
				<td>
					<select id="question-nationality" name="question-nationality">
						<option value="">Select...</option>
						<? foreach ($nations as $nation) { ?>
						<option value="<?=$nation->name?>"><?=$nation->name?></option>
						<? } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Title<span class="required">*</span></td><td>:</td>
				<td><input type="text" id="question-title" name="question-title" /></td>
			</tr>
			<tr>
				<td>Message<span class="required">*</span></td><td>:</td>
				<td><textarea rows="" cols="" id="question-content" name="question-content"></textarea></td>
			</tr>
			<tr>
				<td>Captcha<span class="required">*</span></td><td>:</td>
				<td><input type="text" id="question-code" name="question-code" style="width: 60px"/> <label class="security-code"><?=$this->util->createSecurityCode()?></label></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td><i><span class="required">*</span>Questions & Answers are typically posted within 24 hours, pending approval.</i></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td>
					<input type="button" id="question-submit-btn" name="question-btn" class="question-btn" value="Submit" />
					<input type="button" id="question-cancel-btn" name="question-btn" class="question-btn" value="Cancel" />
				</td>
			</tr>
		</table>
	</div>
	<div class="question-box">
		<? foreach ($questions as $question) { ?>
		<div class=item>
			<div class="left" style="width: 180px">
				<div class="left">
					<div class="avatar"><img alt="no-avatar" src="<?=IMG_URL?>no-avatar.gif" /></div>
				</div>
				<div class="left">
					<div class="name"><?=$question->fullname?></div>
					<div class="location"><?=$question->nationality?></div>
				</div>
			</div>
			<div class="left" style="width: 470px; margin-left: 10px;">
				<div class="title"><?=$question->title?></div>
				<div class="date"><?=date('M d, Y', strtotime($question->created_date))?></div>
				<div class="text">
					<?=$question->content?>
				</div>
				<?
					$respond_info->parent_id = $question->id;
					$respond = $this->m_question->getItems($respond_info);
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