<link type="text/css" rel="stylesheet" href="<?=TPL_URL?>jquery/css/pagination.css"/>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.pagination.js"></script>
<script type="text/javascript">
	$(function() {
		var numofitem = '<?=sizeof($destinations)?>';
		if ((numofitem / 9) > 1) {
			$("#light-pagination").pagination({
		        items: numofitem,
		        itemsOnPage: 9,
		        cssStyle: 'light-theme',
		        onPageClick: function(pageNumber){selectPage(pageNumber, numofitem);}
		    });
		}
	});
	function selectPage(pageNumber, items) {
		for (var i=1; i<=items; i++) {
			$("#destination-page-"+i).hide();
		}
		$("#destination-page-"+pageNumber).show();
	}
</script>
<div class="destination-search">
	<h2 class="title">Hotels List by Destination</h2>
	<div class="left">
		<div class="hotel-map">
	    	<a class="sapa" title="Sapa" href="<?=site_url("hotels/vietnam/sapa")?>">Sapa</a>
	        <a class="hanoi" title="Ha noi" href="<?=site_url("hotels/vietnam/ha-noi")?>">Ha noi</a>
	        <a class="halong" title="Ha long" href="<?=site_url("hotels/vietnam/ha-long")?>">Ha long</a>
	        <a class="haiphong" title="Hai Phong" href="<?=site_url("hotels/vietnam/hai-phong")?>">Hai Phong</a>
	        <a class="ninhbinh" title="Ninh Binh" href="<?=site_url("hotels/vietnam/ninh-binh")?>">Ninh Binh</a>
	        <a class="hue" title="Hue" href="<?=site_url("hotels/vietnam/hue")?>">Hue</a>
	        <a class="danang" title="Da Nang" href="<?=site_url("hotels/vietnam/da-nang")?>">Da Nang</a>
	        <a class="hoian" title="Hoi An" href="<?=site_url("hotels/vietnam/hoi-an")?>">Hoi An</a>
	        <a class="dalat" title="Da Lat" href="<?=site_url("hotels/vietnam/da-lat")?>">Da Lat</a>
	        <a class="nhatrang" title="Nha Trang" href="<?=site_url("hotels/vietnam/nha-trang")?>">Nha Trang</a>
	        <a class="hochiminh" title="Ho Chi Minh City" href="<?=site_url("hotels/vietnam/ho-chi-minh")?>">Ho Chi Minh</a>
	        <a class="chaudoc" title="Chau Doc" href="<?=site_url("hotels/vietnam/chau-doc")?>">Chau Doc</a>
	        <a class="cantho" title="Can Tho" href="<?=site_url("hotels/vietnam/can-tho")?>">Can Tho</a>
	        <a class="phuquoc" title="Phu Quoc" href="<?=site_url("hotels/vietnam/phu-quoc")?>">Phu Quoc</a>
	    </div>
	</div>
	<div class="right">
		<ul id="destination-page-1" class="listdes">
			<?
				$cnt  = 0;
				$page = 1;
				foreach ($destinations as $destination) {
					$info->city = $destination->id;
					$num = $this->m_hotel->getSumItems($info, 1);
					if ($cnt != 0 && ($cnt % 9) == 0) {
						$page++;
						$cnt = 0;
			?>
		</ul>
		<ul id="destination-page-<?=$page?>" class="listdes" style="display: none">
			<?
					}
					$cnt++;
			?>
			<li class="<?=($cnt<=3)?"top":""?>">
				<a title="<?=$destination->name?>" href="<?=site_url("hotels/vietnam/".$destination->alias)?>">
				<img width="72px" height="74px" src="<?=$destination->thumbnail?>" class="img-asyn thumb" alt="<?=$destination->name?>" title="<?=$destination->name?>"></a>
				<h2><a title="<?=$destination->name?>" href="<?=site_url("hotels/vietnam/".$destination->alias)?>"><?=$destination->name?></a></h2>
				<p><?=$num?> Hotels</p>
			</li>
			<?	} ?>
		</ul>
		<div id="light-pagination" class="pagination clr"></div>
	</div>
	<div class="clr"></div>
</div>