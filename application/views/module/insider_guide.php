<?if(isset($_GET['destination'])) :?>
<?
	$destination = $this->m_tour_destination->load($_GET['destination']);
?>
<?if (!empty($destination)) :?>
	<div id="insider">
		<div>Insider's Guide to <h1><?=$destination->name?></h1></div>
		<p>Major attractions, tips and our top things to see and do.</p>
		<div class="inside-btn">
			<a href="">Look Inside »</a>
		</div>
	</div>
<?endif?>

<?endif?>