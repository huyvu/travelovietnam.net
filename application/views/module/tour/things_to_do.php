<?
if (isset($_GET['destination'])) {
	$destination = 	$_GET['destination'][0];
}else{
	$destination = '';
}
$things = $this->m_tour_category->getItems(1);
if (isset($_GET['category'])) {
	$cat = $_GET['category'][0];
}
?>
<div class="blue-panel">
	<div class="panel-header">
		<img src="<?=IMG_URL?>thing-to-do.png" alt="">
		<h1>Things To Do</h1>
	</div>
	<ul>
		<li><a class="<?=(isset($cat))?'':'active'?>" href="<?=site_url('tours/search').'?smode=filter&destination[]='.$destination?>">All Things to Do...</a></li>
		<?foreach($things as $t) :?>
		<li><a class="<?=(isset($cat)&&$t->id==$cat)?'active':''?>" href="<?=site_url('tours/search').'?smode=filter&destination[]='.$destination.'&category[]='.$t->id?>"><?=$t->name?></a></li>
		<?endforeach?>
	</ul>
	<a class="all-things" href="">SEE ALL THING TO DO </a>
</div>