<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>jquery.tagit.css">
<?
	$name			= isset($item->name) ? $item->name : "";
	$code			= isset($item->code) ? $item->code : "";
	$sub_title		= isset($item->sub_title) ? $item->sub_title : "";
	$note			= isset($item->note) ? $item->note : "";
	$alias			= isset($item->alias) ? $item->alias : "";
	$meta_title 	= isset($item->meta_title) ? $item->meta_title : "";
	$meta_key 		= isset($item->meta_key) ? $item->meta_key : "";
	$meta_desc 		= isset($item->meta_desc) ? $item->meta_desc : "";
	$thumbnail		= isset($item->thumbnail) ? $item->thumbnail : "";
	$promotion_image= isset($item->promotion_image) ? $item->promotion_image : "";
	$map			= isset($item->map) ? $item->map : "";
	$brochure		= isset($item->brochure) ? $item->brochure : "";
	$depart_from	= isset($item->depart_from) ? $item->depart_from : 0;
	$going_to		= isset($item->going_to) ? $item->going_to : 0;
	$duration		= isset($item->duration) ? $item->duration : 1;
	$destinations	= isset($item->destinations) ? explode(';', $item->destinations) : array();
	$original_price	= isset($item->original_price) ? $item->original_price : 0;
	$price			= isset($item->price) ? $item->price : 0;
	$start			= isset($item->start) ? $item->start : "";
	$finish			= isset($item->finish) ? $item->finish : "";
	$summary		= isset($item->summary) ? $item->summary : "";
	$highlight		= isset($item->highlight) ? $item->highlight : "";
	$price_inclusion= isset($item->price_inclusion) ? $item->price_inclusion : "";
	$price_exclusion= isset($item->price_exclusion) ? $item->price_exclusion : "";
	$detail			= isset($item->detail) ? $item->detail : "";
	$featured		= isset($item->featured) ? $item->featured : 0;
	$package		= isset($item->package) ? $item->package : 0;
	$short_tour		= isset($item->short_tour) ? $item->short_tour : 0;
	$daily			= isset($item->daily) ? $item->daily : 0;
	$throughout		= isset($item->throughout) ? $item->throughout : 0;
	$best_deal		= isset($item->best_deal) ? $item->best_deal : 0;
	$popular		= isset($item->popular) ? $item->popular : 0;
	$popular_image	= isset($item->popular_image) ? $item->popular_image : "";
	$category_id	= isset($item->category_id) ? $item->category_id : 0;
	$categories		= isset($item->categories) ? explode(';', $item->categories) : array();
	$activities		= isset($item->activities) ? explode(';', $item->activities) : array();
	$tags			= isset($item->tags) ? $item->tags : "";
	$active			= isset($item->active) ? $item->active : 1;
	
	$tour_categories	= $this->m_tour_category->getItems();
	$tour_activities	= $this->m_tour_activity->getItems();
	$tour_destinations	= $this->m_tour_destination->getItems();
?>

<link rel="stylesheet" type="text/css" href="<?=TPL_URL?>jquery/css/jquery.ui.css" />
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var dateoptions = {
			numberOfMonths : 2,
			dateFormat: 'mm/dd/yy'
		};
	$("#start").datepicker(dateoptions);
	$("#finish").datepicker(dateoptions);
});
</script>

<div id="toolbar-box">
	<div class="t">
		<div class="t">
			<div class="t"></div>
		</div>
	</div>
	<div class="m">
		<div id="toolbar" class="toolbar">
			<table class="toolbar">
				<tbody>
					<tr>
						<td id="toolbar-save" class="button">
							<a class="toolbar" onclick="javascript: submitbutton('save')" href="#">
							<span title="Save" class="icon-32-save">
							</span>
							Save
							</a>
						</td>
						<td id="toolbar-cancel" class="button">
							<a class="toolbar" onclick="javascript: submitbutton('cancel')" href="#">
							<span title="Cancel" class="icon-32-cancel">
							</span>
							Cancel
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="header icon-48-generic">
			Vietnam Tour: <small><small>[ Edit ]</small></small>
		</div>
		<div class="clr"></div>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>
<div class="clr"></div>
<div id="element-box">
	<div class="t">
		<div class="t">
			<div class="t"></div>
		</div>
	</div>
	<div class="m">
		<script type="text/javascript" language="javascript">
			function submitbutton(pressbutton)
			{
				var form = document.adminForm;
				if (pressbutton == 'cancel') 
				{
					submitform( pressbutton );
					return;
				}
			
				if (form.name.value == "")
				{
					alert( "PLEASE INPUT THE NAME" );
					return;
				}
				submitform( pressbutton );
			}
		</script>
		<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_tours")?>">
			<input type="hidden" name="task" value="" />
			<? if (isset($item)) { ?>
				<input type="hidden" name="action" id="action" value="edit"/>
				<input type="hidden" name="id" id="id" value="<?=(isset($item->id)?$item->id:0)?>"/>
			<? } else { ?>
				<input type="hidden" name="action" id="action" value="new"/>
			<? } ?>
			
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tbody>
					<tr>
						<td valign="top">
							<table class="adminform">
								<tbody>
									<tr>
										<td width="10%">
											<label for="name">Name:</label>
										</td>
										<td width="90%">
											<input type="text" value="<?=$name?>" maxlength="255" id="name" name="name" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>URL Alias:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$alias?>" maxlength="255" id="alias" name="alias" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Tour Code:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$code?>" maxlength="255" id="code" name="code" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Sub Title:</label>
										</td>
										<td width="90%">
											<input type="text" value="<?=$sub_title?>" maxlength="255" id="sub_title" name="sub_title" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Note:</label>
										</td>
										<td width="90%">
											<input type="text" value="<?=$note?>" maxlength="255" id="note" name="note" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Thumbnail:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$thumbnail?>" maxlength="255" id="thumbnail" name="thumbnail" class="inputbox" style="width: 100%" onclick="openKCFinder4Textbox(this)" value="Click here and select a file double clicking on it"/>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Promotion Image:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$promotion_image?>" maxlength="255" id="promotion_image" name="promotion_image" class="inputbox" style="width: 100%" onclick="openKCFinder4Textbox(this)" value="Click here and select a file double clicking on it"/>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Map:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$map?>" maxlength="255" id="map" name="map" class="inputbox" style="width: 100%" onclick="openKCFinder4Textbox(this)" value="Click here and select a file double clicking on it"/>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Brochure:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$brochure?>" maxlength="255" id="brochure" name="brochure" class="inputbox" style="width: 100%" onclick="openKCFile4Textbox(this)" value="Click here and select a file double clicking on it"/>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Meta Title (for SEO):</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$meta_title?>" maxlength="255" id="meta_title" name="meta_title" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Keywords:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$meta_key?>" maxlength="255" id="meta_key" name="meta_key" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label for="name">Page description:</label>
										</td>
										<td width="100%">
											<textarea name="meta_desc" style="width:100%; height:120px"><?=$meta_desc?></textarea>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Tour Type:</label>
										</td>
										<td width="90%">
											<input type="radio" value="1" id="type0" name="type" <?=($daily) ? "checked='checked'" : ""?> />
											<label for="type0">Daily</label>
											<input type="radio" value="2" id="type1" name="type" <?=($throughout) ? "checked='checked'" : ""?> />
											<label for="type1">Throughout</label>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Tour Theme:</label>
										</td>
										<td width="100%">
											<select id="category" name="category">
												<? foreach($tour_categories as $c) { ?>
												<option value="<?=$c->id?>"><?=$c->name?></option>
												<? } ?>
											</select>
											<script> setValueHTML("category", '<?=$category_id?>'); </script>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Including Themes:</label>
										</td>
										<td width="100%">
											<ul style="list-style-type: none; margin: 0; padding: 0;">
											<? for ($i=0; $i<5; $i++) { ?>
												<li style="float: left">
													<select id="category_<?=$i?>" name="category_<?=$i?>">
														<option value="">---</option>
														<? foreach ($tour_categories as $c) {
															echo '<option value="'.$c->id.'">'.$c->name.'</option>';
														}?>
													</select>
													<script> setValueHTML("category_<?=$i?>", '<?=$categories[$i]?>'); </script>
												</li>
											<? } ?>
											</ul>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Activities:</label>
										</td>
										<td width="100%">
											<ul style="list-style-type: none; margin: 0; padding: 0;">
											<? for ($i=0; $i<10; $i++) { ?>
												<li style="float: left">
													<select id="activity_<?=$i?>" name="activity_<?=$i?>">
														<option value="">---</option>
														<? foreach ($tour_activities as $c) {
															echo '<option value="'.$c->id.'">'.$c->name.'</option>';
														}?>
													</select>
													<script> setValueHTML("activity_<?=$i?>", '<?=$activities[$i]?>'); </script>
												</li>
											<? } ?>
											</ul>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Depart From:</label>
										</td>
										<td width="100%">
											<select id="depart_from" name="depart_from">
												<? foreach($tour_destinations as $d) { ?>
												<option value="<?=$d->id?>"><?=$d->name?></option>
												<? } ?>
											</select>
											<script> setValueHTML("depart_from", '<?=$depart_from?>'); </script>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>To:</label>
										</td>
										<td width="100%">
											<select id="going_to" name="going_to">
												<? foreach($tour_destinations as $d) { ?>
												<option value="<?=$d->id?>"><?=$d->name?></option>
												<? } ?>
											</select>
											<script> setValueHTML("going_to", '<?=$going_to?>'); </script>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Destinations:</label>
										</td>
										<td width="100%">
											<ul style="list-style-type: none; margin: 0; padding: 0;">
											<? for ($i=0; $i<20; $i++) { ?>
												<li style="width: 100px; float: left">
													<select id="destination_<?=$i?>" name="destination_<?=$i?>">
														<option value="">---</option>
														<? foreach ($tour_destinations as $d) {
															echo '<option value="'.$d->id.'">'.$d->name.'</option>';
														}?>
													</select>
													<script> setValueHTML("destination_<?=$i?>", '<?=$destinations[$i]?>'); </script>
												</li>
											<? } ?>
											</ul>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Duration:</label>
										</td>
										<td width="100%">
											<select id="duration" name="duration" style="width: 60px">
												<? for ($d=1; $d<=30; $d++) { ?>
													<option value="<?=$d?>"><?=$d?></option>
												<? } ?>
											</select> day(s)
											<script> setValueHTML("duration", '<?=$duration?>'); </script>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Orginal Price:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$original_price?>" id="original_price" name="original_price" style="width: 60px; text-align: right"/> USD
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Sale Price:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$price?>" id="price" name="price" style="width: 60px; text-align: right"/> USD
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Featured Tour:</label>
										</td>
										<td width="90%">
											<input type="radio" value="0" id="featured0" name="featured" <?=(!$featured) ? "checked='checked'" : ""?> />
											<label for="featured0">No</label>
											<input type="radio" value="1" id="featured1" name="featured" <?=($featured) ? "checked='checked'" : ""?> />
											<label for="featured1">Yes</label>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Best Deal:</label>
										</td>
										<td width="90%">
											<input type="radio" value="0" id="best_deal0" name="best_deal" <?=(!$best_deal) ? "checked='checked'" : ""?> />
											<label for="best_deal0">No</label>
											<input type="radio" value="1" id="best_deal1" name="best_deal" <?=($best_deal) ? "checked='checked'" : ""?> />
											<label for="best_deal1">Yes</label>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Popular:</label>
										</td>
										<td width="90%">
											<input type="radio" value="0" id="popular0" name="popular" <?=(!$popular) ? "checked='checked'" : ""?> />
											<label for="popular0">No</label>
											<input type="radio" value="1" id="popular1" name="popular" <?=($popular) ? "checked='checked'" : ""?> />
											<label for="popular1">Yes</label>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Popular Image:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$popular_image?>" maxlength="255" id="popular_image" name="popular_image" class="inputbox" style="width: 100%" onclick="openKCFinder4Textbox(this)" value="Click here and select a file double clicking on it"/>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Start:</label>
										</td>
										<td width="90%">
											<input type="text" value="<?=(!empty($start) && $start != '0000-00-00 00:00:00') ? date('m/d/Y', strtotime($start)) : ''?>" maxlength="255" id="start" name="start" class="inputbox" style="width: 100px" placeholder="mm/dd/yyyy" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Finish:</label>
										</td>
										<td width="90%">
											<input type="text" value="<?=(!empty($finish) && $finish != '0000-00-00 00:00:00') ? date('m/d/Y', strtotime($finish)) : ''?>" maxlength="255" id="finish" name="finish" class="inputbox" style="width: 100px" placeholder="mm/dd/yyyy" />
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label>Summary:</label>
										</td>
										<td width="100%">
											<textarea name="summary" style="width:100%; height:200px"><?=$summary?></textarea>
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label>Highlight:</label>
										</td>
										<td width="100%">
											<textarea name="highlight" style="width:100%; height:200px"><?=$highlight?></textarea>
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label>Detail:</label>
										</td>
										<td width="100%">
											<textarea name="detail" style="width:100%; height:600px"><?=$detail?></textarea>
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label>Price Inclusions:</label>
										</td>
										<td width="100%">
											<textarea name="price_inclusion" style="width:100%; height:200px"><?=$price_inclusion?></textarea>
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label>Price Exclusions:</label>
										</td>
										<td width="100%">
											<textarea name="price_exclusion" style="width:100%; height:200px"><?=$price_exclusion?></textarea>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="tags">Tags:</label>
										</td>
										<td width="100%">
											<input type="hidden" name="tourTags" id="tourTags" disable="true">
											<ul id="myTags">
												<!-- Existing list items will be pre-added to the tags -->
												<?
													if (!empty($tags)) {
														$Tags = explode(",", $tags);
														foreach ($Tags as $tag) {
															echo "<li>$tag</li>";
														}
													}
												?>
												<!-- <li>Tag1</li>
												<li>Tag2</li> -->
											</ul>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Published:</label>
										</td>
										<td width="90%">
											<input type="radio" value="0" id="state0" name="active" <?=(!$active) ? "checked='checked'" : ""?> />
											<label for="state0">No</label>
											<input type="radio" value="1" id="state1" name="active" <?=($active) ? "checked='checked'" : ""?> />
											<label for="state1">Yes</label>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<div class="clr"></div>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>
<div class="clr"></div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?=JS_URL?>tag-it.min.js"></script>
<script type="text/javascript">
	// jQuery.noConflict();
	var $j = jQuery.noConflict();
	$j(document).ready(function() {
		var tags = "<?=$tags?>".split(",");
		$j('#tourTags').val(tags);
		$j("#myTags").tagit();
		 $j('#myTags').tagit({
		 	availableTags: tags,
			// This will make Tag-it submit a single form value, as a comma-delimited field.
			singleField: true,
			singleFieldNode: $j('#tourTags'),
			tagLimit : 10,
		});
	});
</script>