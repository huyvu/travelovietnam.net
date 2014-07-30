<?php if (isset($destination)): ?>
<div class="blue-panel">
	<div class="panel-header">
		<img src="<?=IMG_URL?>thing-to-do.png" alt="">
		<h1>Things To Do</h1>
	</div>
	<ul>
		<li><a class="<?=(isset($cat))?'':'active'?>" href="<?=site_url("tours/vietnam/{$destination->alias}")?>">All Things to Do...</a></li>
		<?foreach($things as $t) :?>
		<li><a class="<?=(isset($cat)&&$t->id==$cat)?'active':''?>" href="<?=site_url('tours/search').'?smode=filter&destination[]='.$destination->id.'&category[]='.$t->id?>"><?=$t->name?></a></li>
		<?endforeach?>
	</ul>
	<a class="all-things" href="">SEE ALL THING TO DO </a>
</div>	
<?php endif ?>
