<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>help.css" />
<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> <a title="Blog" href="<?=site_url('blog')?>">Our Blog</a>
		<? require_once(APPPATH."views/module/social.php"); ?>
	</div>
	<h1 class="page-title">OUR BLOG</h1>
	<div class="about">
		<div class="left about-content">
			<div id="our-blog">
				<div class="header">
					<p class="desc"><img alt="" src="<?=IMG_URL?>quote44x32-white.png" />
					This is a place for us to shout about the two loves of our lives, Asia and traveling. We hope that while 
					you are here you will be entertained and informed. You might even learn something new. 
					With Travelovietnam staff spread right across Asia we have plenty of local know-how to share.
					We also want to get to know you, our community of travelers. It is a place to ask us questions, 
					tell us your stories, and share those with other readers too. You’ll hear from like-minded travelers 
					that you can share your ideas with.
					</p>
				</div>
				<div id="blog-content">
					<div id="page-1" class="list">
					<? 
					$cnt  = 0;
					$page = 1;
					foreach ($items as $item) : ?>
						<?
						if ($cnt != 0 && ($cnt % 5) == 0) {
							$page++;
							$cnt = 0;
						?>
						</div>
						<div id="page-<?=$page?>" class="list none" >
						<?
						}
						$cnt++;
						?>
						<? $cat = $this->m_blog_category->load($item->cat_id)?>
							<div class="post">
							<div class="left post-thumb">
								<a href="<?=site_url("blog/{$item->alias}")?>">
									<img src="<?=$item->thumbnail?>" width="245">
								</a>
							</div><!--/.post-thumb -->
							<div class="right post-content">
								<a class="post-title" href="<?=site_url("blog/{$item->alias}")?>"><?=$item->title?></a>
								<div class="post-info">
								  Posted <?=$this->util->dateShortFormat($item->created_date)?> by <a class="author"><?=$item->fullname?></a> 
								  <a class="author comment-count" href="<?=site_url("blog/{$item->alias}")?>"><img style="margin:0 5px 0 20px" src="<?=IMG_URL?>comment-icon.png"> <?=$this->m_blog_comment->count($item->id)?></a>
								</div><!--/.post-info -->
								<div class="post-entry">
									<p><?=$item->summary?></p>
								</div>
								<span><a class="continue" href="<?=site_url("blog/{$item->alias}")?>">Continue reading</a></span>
							</div><!--/.post-content -->
							</div><!--/.post -->
					<? endforeach ?>
				</div><!--/#post -->
					
				</div>
				<? if ($page > 1) { ?>
				<div style="margin: 15px; padding: 15px 0px; border-top: 1px solid #D2D9DB">
					<div id="light-pagination" class="pagination clr"></div>
				</div>
				<? } ?>
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
					   			<li class="sub-item"><a class="sub-link" href="<?=site_url("blog/category/{$category->alias}")?>"><?=$category->name?></a></li>
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
		var curPage = ((hashVal != null && hashVal != "") ? hashVal.substr(6) : 1);
		var numofitem = '<?=sizeof($items)?>';
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
</script>