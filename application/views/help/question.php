<?
	$user = $this->m_user->load($item->author);
	$nations = $this->m_nation->getItems(1);
	
	$question_info->category_id	= 0;
	$question_info->topLevel	= 1;
	$questions = $this->m_question->getItems($question_info, 1);
?>

<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>help.css" rel="stylesheet" />

<script type="text/javascript">
	$(document).ready(function() {
		$("#replyticket-submit-btn").click(function() {
			var err = 0;
			if ($("#ticket-content").val() == "") {
				$("#ticket-content").addClass("error");
				err ++;
			} else {
				$("#ticket-content").removeClass("error");
			}
			if (!err) {
				$("#frmTicket").submit();
			} else {
				msgbox("Please fill-in all required fields(<span class='required'>*</span>) marked in red.");
			}
		});

		var leftHeight = $(".col-left").height();
		var rightHeight = $(".col-right").height();
		if (leftHeight < rightHeight){
			$(".col-left").height(rightHeight);
		}
	});
</script>

<div class="inner">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Help Center" href="<?=site_url("help")?>">Help Center</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="My Tickets" href="<?=site_url("help/mytickets")?>">My Tickets</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"><?=$item->title?>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<div class="help-center">
		<div class="left help-content">
			<div class="main-banner">
				<div class="support-banner"></div>
			</div>
			<div class="contact-options">
				<div class="left email-us">
					<a href="<?=site_url("help/emailus")?>"><div class="label">Email Us</div></a>
				</div>
				<div class="left new-ticket">
					<a class="selected" href="<?=site_url("help/newticket")?>"><div class="label">Submit Ticket</div></a>
				</div>
				<div class="left live-chat">
					<a><div class="label">Chat Online</div></a>
				</div>
				<div class="left call-us">
					<a><div class="label">Call Us</div></a>
				</div>
				<div class="clr"></div>
			</div>
			<div style="padding: 10px;">
				<div id="question-container">
					<div class="summary-box">
						<div class="left">
							<h1><?=$item->title?></h1>
							<table class="question-details">
								<tr>
									<th>Status</th>
									<td><?=(($item->status == 0) ? "Open" : (($item->status == 1) ? "Resolved" : "Closed"))?></td>
								</tr>
								<tr>
									<th>By</th>
									<td><?=$user->fullname?></td>
								</tr>
								<tr>
									<th>Opened</th>
									<td><?=date('M d, Y', strtotime($item->created_date))?></td>
								</tr>
								<tr>
									<th>Category</th>
									<td><?=$this->m_help_category->load($item->category_id)->name?></td>
								</tr>
							</table>
						</div>
						<div class="right">
							<div class="label">Have Your Question?</div>
							<div class="">
								<a id="new-question" name="question-btn" class="question-btn" href="<?=site_url("help/newticket")?>">Submit a Ticket</a>
							</div>
						</div>
						<div class="clr"></div>
					</div>
					<div class="clr"></div>
					<br/>
					<div>
						<div class="left">
							<h1>Correspondence</h1>
						</div>
						<div class="clr"></div>
					</div>
					<div class="question-box">
						<div class=item>
							<div class="left" style="width: 80px">
								<div class="left">
									<div class="avatar">
									<? if (!empty($user->avatar)) { ?>
										<img alt="no-avatar" src="<?=$user->avatar?>" width="80px" />
									<? } else { ?>
										<img alt="no-avatar" src="<?=IMG_URL?>help/no-avatar.png" />
									<? } ?>
									</div>
								</div>
							</div>
							<div class="left" style="width: 580px; margin-left: 10px;">
								<div class="title"><?=$item->title?></div>
								<div class="date"><?=date('M d, Y', strtotime($item->created_date))?> | by <?=$user->fullname?></div>
								<div class="text">
									<?=$item->content?>
								</div>
								<?
									//Answers
									$info->parent_id = $item->id;
									$answers = $this->m_help_question->getItems($info, 1);
									foreach ($answers as $answer) {
										$answer_user = $this->m_user->load($answer->author);
		                            ?>
								<div class="respond">
									<div class="left">
										<? if (!empty($answer_user->avatar)) { ?>
											<img alt="no-avatar" src="<?=$answer_user->avatar?>" width="80px" />
										<? } else { ?>
											<img alt="no-avatar" src="<?=IMG_URL?>help/no-avatar.png" />
										<? } ?>
									</div>
									<div class="left" style="margin-left: 10px">
										<div class="date"><?=date('M d, Y', strtotime($answer->created_date))?> | by <?=$answer_user->fullname?></div>
										<div class="text">
											<?=$answer->content?>
										</div>
									</div>
									<div class="clr"></div>
								</div>
								<? } ?>
							</div>
							<div class="clr"></div>
						</div>
					</div>
				</div>
				<? if ($this->session->userdata("logged_user") && (($item->author == $this->session->userdata("logged_user")->id) || $this->session->userdata("root_addmin_logged_in") || $this->session->userdata("addmin_logged_in"))) { ?>
				<div id="question-container" style="margin: 40px 0px 20px 0px;">
					<div class="summary-box">
						<h1>Reply this Ticket</h1>
						<div class="bd clearfix">
							<form id="frmTicket" name="frmTicket" action="<?=site_url("help/replyticket")?>" method="POST">
								<div id="newticket-container">
									<div class="newticket-form">
										<table class="tbl-newticket" cellpadding="4" cellspacing="0" border="0">
											<tr>
												<td style="padding-right: 10px">Comment <span class="required">*</span>:</td>
												<td><textarea rows="" cols="" id="ticket-content" name="content" style="width: 580px"></textarea></td>
											</tr>
											<tr>
												<td></td>
												<td>
													<input type="button" id="replyticket-submit-btn" name="replyticket-submit-btn" class="newticket-btn" value="Submit" />
												</td>
											</tr>
										</table>
									</div>
								</div>
								<input type="hidden" name="parent_id" value="<?=$item->id?>">
							</form>
						</div>
					</div>
				</div>
				<? } ?>
				<? if (!empty($othertickets) && sizeof($othertickets)) { ?>
				<div class="popular-questions">
					<div class="hd">
						<h3>Related Questions</h3>
					</div>
					<div class="bd clearfix">
						<ul class="items">
							<? foreach ($othertickets as $ticket) { ?>
							<li><a href="<?=site_url("help/question/".$ticket->alias)?>"><?=$ticket->title?></a></li>
							<? } ?>
						</ul>
					</div>
				</div>
				<? } ?>
			</div>
		</div>
		<div class="right" style="width: 280px;">
			<? require_once(APPPATH."views/help/categories.php"); ?>
		</div>
		<div class="clr"></div>
	</div>
</div>
