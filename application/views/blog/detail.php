<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>help.css" />
<?php  
	if ($this->session->userdata('user')) {
		$user = $this->session->userdata('user');
	}
	if ($this->session->userdata('addmin_logged_in')) {
		$admin = $this->session->userdata('addmin_logged_in');
		$comments = $admin_comments;
	}
?>
<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Home" href="<?=site_url('blog')?>">Our Blog</a>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="page-title"><?=$item->title?></h1>
	<div class="about">
		<div class="left about-content">
			<div id="our-blog">
				<div id="blog">
					<div class="post-info">
						Posted <?=$this->util->dateShortFormat($item->created_date)?> by <a class="author"><?=$item->fullname?></a>
					</div><!--/.post-info -->
					<div class="blog-content">
						<?=$item->content?>
						<div style="position:relative; margin: 10px 0; height: 30px">
							<? require(APPPATH."views/module/social.php"); ?>
						</div>
						<div class="clr"></div>
						<ul class="tags">
							<?
								if (!empty($item->tags)) {
									$Tags = explode(",", $item->tags);
									foreach ($Tags as $tag) {
										echo "<li><a href='".site_url("blog/tags/{$tag}")."'>$tag</a></li>";
									}
								}
							?>
						</ul>
					</div>
					<div class="cmt-container" >
						<div class="new-com-bt">
							<span>Write a comment ...</span>
						</div>
						<div class="new-com-cnt">
							<? if(!isset($user)) :?>
							<input type="text" id="name-com" name="name-com" value="<?=(isset($user))?$user['fullname']:''?>" placeholder="Your name" />
							<input type="text" id="mail-com" name="mail-com" value="<?=(isset($user))?$user['email']:''?>" placeholder="Your e-mail adress" />
							<? endif?>
							<input type="hidden" id="avatar-com" name="avatar-com" value="<?=(isset($user))?$user['avatar']:''?>" />
							<textarea class="the-new-com" maxlength="2000"></textarea>
							<div style="margin-bottom: 20px;">
								<input type="text" id="review-code" name="review-code" style="width: 60px"/> <label class="security-code"><?=$this->util->createSecurityCode()?></label><br>
								<i><span class="required">*</span>Reviews are typically posted within 24 hours, pending approval.</i>
							</div>

							<div class="bt-add-com">Post comment</div>
							<div class="bt-cancel-com">Cancel</div>
						</div>

						<div id="page-1" class="list">
						<? 
						$cnt  = 0;
						$page = 1;
						foreach ($comments as $comment) : ?>
						<?
						if ($cnt != 0 && ($cnt % 15) == 0) {
							$page++;
							$cnt = 0;
						?>
						</div>
						<div id="page-<?=$page?>" class="list none" >
						<?
						}
						$cnt++;
						// Get gravatar Image 
						// https://fr.gravatar.com/site/implement/images/php/
						$default = "mm";
						$size = 35;
						if (empty($comment->avatar)) {
							$avatar = "http://www.gravatar.com/avatar/".md5(strtolower(trim($comment->email)))."?d=".$default."&s=".$size;
						}else{
							$avatar = $comment->avatar;
						}
						?>
						<? if($comment->parent_id == 0) :?>
							<div class="cmt-cnt">
								<img src="<?= $avatar ?>" width="35" />
								<div class="thecom">
									<h5><?=$comment->name; ?></h5><span data-utime="1371248446" class="com-dt"><?= $comment->created_date ?></span>
									<br/>
									<p>
										<?=$comment->content; ?>
									</p>
									<input type="hidden" id="parent_id" value="<?=$comment->id?>">
									<p>
										<span class="reply">Reply</span>
										<!-- If admin is logging in, then show a show/hide link for comment -->
										<?
											if(isset($admin) && $admin==1) {
										?>
													<a id="<?=$comment->id?>" class="cm-active <?=($comment->active)?'hide':'show'?>"><?=($comment->active)?'Hide':'Show'?></a>
										<?
											}
										?>
									</p>
								</div><!-- .the-com -->
							</div><!-- end "cmt-cnt" -->
							<? $subComments = $this->m_blog_comment->getsubItems($comment->id,1);
							foreach($subComments as $sub) :?>
								<?if (empty($sub->avatar)) {
									$subAvatar = "http://www.gravatar.com/avatar/".md5(strtolower(trim($sub->email)))."?d=".$default."&s=".$size;
								}else{
									$subAvatar = $sub->avatar;
								}?>
								<div class="cmt-cnt" style="padding-left: 50px; width:600px">
									<img src="<?= $subAvatar ?>" width="35" />
									<div class="thecom">
										<h5><?=$sub->name; ?></h5><span data-utime="1371248446" class="com-dt"><?= $sub->created_date ?></span>
										<br/>
										<p style="width:550px">
											<?=$sub->content; ?>
										</p>
									</div><!-- .the-com -->
								</div><!-- end "cmt-cnt" -->
							<? endforeach ?>	
						<? endif?>
						<? endforeach ?>
					</div>
						<div class="clr"></div>
						<? if ($page > 1) { ?>
						<div style="margin: 15px; padding: 15px 0px; border-top: 1px solid #D2D9DB">
							<div id="light-pagination" class="pagination clr"></div>
						</div>
						<? } ?>
					</div><!-- end #cmt-container -->

				</div><!--/#blog -->
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
						<a class="testimonial" title="" href="<?=site_url("testimonial")?>">TESTIMONIAL</a>
					</li>
					<li>
						<a class="community" title="" href="<?=site_url("community")?>">OUR COMMUNITY</a>
					</li>
				</ul>
			</div>

			<div id="help-nav">
				<ul class="main">
					<li class="main-item">
						<a class="main-link blog" title="" href="<?=site_url("blog")?>">OUR BLOG</a>
						<ul class="sub">
					   		<? foreach($categories as $category) :?>
					   			<li class="<?=($catindex==$category->id)?'cat-active':''?> sub-item"><a class="sub-link" href="<?=site_url("blog/category/{$category->alias}")?>"><?=$category->name?></a></li>
					   		<? endforeach ?>
					   </ul>
					</li>
				</ul>
			</div><!--/#help-nav -->
			
			<? require_once(APPPATH."views/module/about/customer_review.php"); ?>
			<? require_once(APPPATH."views/module/tour/customize.php"); ?>
			<? require_once(APPPATH."views/module/social/fb_like_box.php"); ?>
		</div>
		<div class="clr"></div>		
	</div>
</div>

<link type="text/css" rel="stylesheet" href="<?=TPL_URL?>jquery/css/pagination.css"/>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.pagination.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.highlight.js"></script>
<script type="text/javascript">
	$(function() {
		var hashVal = window.location.hash;
		var curPage = ((hashVal != null && hashVal != "") ? hashVal.substr(-1,1) : 1);
		var numofitem = '<?=sizeof($comments)?>';
		if ((numofitem / 15) > 1) {
			$("#light-pagination").pagination({
		        items: numofitem,
		        itemsOnPage: 15,
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
</script>


<script type="text/javascript">
   $(function(){
   		function clearField(){
   			var user = "<?=(isset($user))?$user['fullname']:''?>";
			if (user == '') {
	   			$('#name-com').val('');
				$('#mail-com').val('');
			}
			$('.the-new-com').val('');
			$("#review-code").val('');
   		}

   		var parent_id = '';
   		$('.reply').click(function(e) {
			e.preventDefault();
			clearField();
			$('#name-com').removeClass("error");
			$('#mail-com').removeClass("error");
			$('.the-new-com').removeClass('error');
			$("#review-code").removeClass("error");
			$('div.new-com-cnt').insertAfter($(this));
			$('div.new-com-cnt').show();
			var user = "<?=(isset($user))?$user['fullname']:''?>";
			if (user != '') {
				$('.the-new-com').focus();
			}
			else{
				$('#name-com').focus();
			}	
			parent_id = $(this).parent().prev().val();
		});

		//alert(event.timeStamp);
		$('.new-com-bt').click(function(event){   
			$(this).hide();
			clearField();
			$('div.new-com-cnt').insertAfter($(this));
			$('.new-com-cnt').show();
			var user = "<?=(isset($user))?$user['fullname']:''?>";
			if (user != '') {
				$('#name-com').hide();
				$('#mail-com').hide();
				$('.the-new-com').focus();
			}
			else{
				$('#name-com').focus();
			}	
			
		});

		/* when start writing the comment activate the "add" button */
		$('.the-new-com').bind('input propertychange', function() {
		   $(".bt-add-com").css({opacity:0.6});
		   var checklength = $(this).val().length;
		   if(checklength){ $(".bt-add-com").css({opacity:1}); }
		});

		/* on clic  on the cancel button */
		$('.bt-cancel-com').click(function(){
			$('.the-new-com').val('');
			$("#review-code").val('')
			$('.new-com-cnt').fadeOut('fast', function(){
				$('#name-com').removeClass("error");
				$('#mail-com').removeClass("error");
				$('.the-new-com').removeClass('error');
				$("#review-code").removeClass("error");
				$('.new-com-bt').fadeIn('fast');
			});
		});

		// on post comment click 
		$('.bt-add-com').click(function(){
			var p = {};
			var user = "<?=(isset($user))?$user['fullname']:''?>";
			if (user) {
				p['name'] =  "<?=(isset($user))?$user['fullname']:''?>";
				p['email'] = "<?=(isset($user))?$user['email']:''?>";
			}else{
				p['name'] =  $('#name-com').val();
				p['email'] = $('#mail-com').val();
			}
			
			p['avatar'] = $('#avatar-com').val();
			p['content'] = $('.the-new-com').val();
			p['blog_id'] = "<?=$item->id?>";
			p['review-code'] = $("#review-code").val();
			p['parent_id']	= parent_id;
			p['created_time'] = "<?= date('d-m-Y H:i'); ?>";
			p['link'] = "<?=current_url()?>";

			var err = 0;
			
			if (p['name'] == "") {
				$('#name-com').addClass("error");
				err++;
			} else {
				$('#name-com').removeClass("error");
			}
			if (p['email'] == "") {
				$('#mail-com').addClass("error");
				err++;
			} else if(!validateEmail(p['email'])){ // Call validateEmail function from Util.js
				$('#mail-com').addClass("error");
				err ++;
			} else {
				$('#mail-com').removeClass("error");
			}
			if ($('.the-new-com').val() == '') {
				$('.the-new-com').addClass('error');
				err++;
			}else{
				$('.the-new-com').removeClass('error');
			}
			if ($("#review-code").val() == "") {
				$("#review-code").addClass("error");
				err++;
			} else {
				$("#review-code").removeClass("error");
			}

			if (err == 0) {
				$.ajax({
					type: "POST",
					url: "<?=site_url('blog/comment')?>",
					data: p,
					dataType: 'json',
					success: function(result){
						if (result[0] == 'The code you have entered is not valid. Please try with another.') {
							msgbox(result[0],'Error');
							$("#review-code").addClass('error');
						}else{
							$('#name-com').val('');
							$('#mail-com').val('');
							$('.the-new-com').val('');
							$("#review-code").val('');
							msgbox(result[0],'Success');
							$('.new-com-cnt').hide('fast', function(){
								$('.new-com-bt').show('fast');
							})
						}
					},async:false
				});
			}
		});


		//Show/hide comment when logged in as admin
		$('.cm-active').click(function() {
			if ($(this).hasClass('hide')) {
				var p = {};
				p['id'] = $(this).attr('id');
				p['active'] = 0;
				$.ajax({
					type: "POST",
					url: "<?=site_url('blog/active_comment')?>",
					data: p,
					dataType: 'json',
					success: function(result){
							var id = result;
							console.log(id);
							var item = $("#"+id);
							console.log(item);
							console.log('chuyen thanh show');
							item.removeClass('hide');
							item.addClass('show');
							item.html('Show');	
							item.attr('val', id);
						
					},async:false
				});
			}else{
				var p = {};
				p['id'] = $(this).attr('id');
				p['active'] = 1;
				$.ajax({
					type: "POST",
					url: "<?=site_url('blog/active_comment')?>",
					data: p,
					dataType: 'json',
					success: function(result){
							var id = result;
							console.log(id);
							var item = $("#"+id);
							console.log(item);
							console.log('chuyen thanh hide');
							item.removeClass('show');
							item.addClass('hide');
							item.html('Hide');	
							
							item.attr('val', id);
						
					},async:false
				});
			}
		});
		
	});
</script>

