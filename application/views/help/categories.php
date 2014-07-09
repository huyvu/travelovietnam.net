<?
	$method = $this->router->fetch_method();
	
	if($this->session->userdata('user')) {
		$user = $this->session->userdata('user');
	}
	$categories = $this->m_help_category->getAndCountItems();
?>

<div id="help-nav">
	<ul class="main">
		<? if (isset($user)) { ?>
		<li class="main-item account-panel">
			<div class="profile-summary">
				<div class="profile-fullname"><?=$user["fullname"]?></div>
				<div class="profile-email"><?=$user["email"]?></div>
			</div>
			<ul class="profile-items">
				<li><a title="" href="<?=site_url("member/myaccount")?>">My orders</a></li>
				<li><a class="<?=($method=="mytickets" || $method=="newticket"  || $method=="question") ? "selected" : ""?>" title="" href="<?=site_url("help/mytickets")?>">My tickets</a></li>
				<li><a title="" href="<?=site_url("member/myprofile")?>">Edit profile</a></li>
				<li><a title="" href="<?=site_url("member/changepassword")?>">Change password</a></li>
				<li><a title="" href="<?=site_url("member/logout")?>">Logout</a></li>
			</ul>
		</li>
		<? } ?>
		<li class="main-item">
			<a class="main-link contact-info<?=((!empty($navindex) && $navindex=="contact") ? "-selected" : "")?>" title="" href="<?=site_url("help")?>">CONTACT INFORMATION</a>
		</li>
		<li class="main-item">
			<a class="main-link support-center<?=((!empty($navindex) && $navindex=="support") ? "-selected" : "")?>" title="" href="<?=site_url("help/support")?>">SUPPORT CENTER</a>
		</li>
		<li class="main-item">
			<a class="main-link about-travelovietnam" title="">ABOUT TRAVELOVIETNAM</a>
			<ul class="sub">
				<li class="sub-item"><a class="sub-link" title="" href="<?=site_url("about")?>">About Us</a></li>
				<li class="sub-item"><a class="sub-link" title="" href="<?=site_url("whyus")?>">Why Us</a></li>
				<li class="sub-item"><a class="sub-link" title="" href="<?=site_url("team")?>">Our Team</a></li>
				<li class="sub-item"><a class="sub-link" title="" href="<?=site_url("community")?>">Our Community</a></li>
				<li class="sub-item"><a class="sub-link" title="" href="<?=site_url("blog")?>">Our Blog</a></li>
				<li class="sub-item"><a class="sub-link" title="" href="<?=site_url("testimonial")?>">Customer's Review</a></li>
			</ul>
		</li>
		<li class="main-item">
			<a class="main-link help-categories" title="">HELP CATEGORIES</a>
			<ul class="sub">
				<? foreach ($categories as $citem) { ?>
				<li class="sub-item"><a class="sub-link" title="<?=$citem->name?>" href="<?=site_url("help/category/".$citem->alias)?>"><?=$citem->name?> (<?=$citem->total_num?>)</a></li>
				<? } ?>
			</ul>
		</li>
	</ul>
</div>