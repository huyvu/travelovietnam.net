<?
	$start				= isset($item->start) ? $item->start : "";
	$finish				= isset($item->finish) ? $item->finish : "";
	$places				= isset($item->places) ? $item->places : 0;
	$price				= isset($item->price) ? $item->price : 0;
	$supplement			= isset($item->supplement) ? $item->supplement : 0;
	$active				= isset($item->active) ? $item->active : 1;
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
			Tour Departure: <small><small>[ Edit ]</small></small>
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
				submitform( pressbutton );
			}
		</script>
		<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_tour_departures")?>">
			<input type="hidden" name="tour_id" value="<?=$tour_id?>" />
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
									<tr>
										<td width="10%">
											<label for="name">Places:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$places?>" maxlength="255" id="places" name="places" class="inputbox" style="width: 100px; text-align: right;" /> available
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Price:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$price?>" maxlength="255" id="price" name="price" class="inputbox" style="width: 100px; text-align: right;" /> USD
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Supplement:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$supplement?>" maxlength="255" id="supplement" name="supplement" class="inputbox" style="width: 100px; text-align: right;" /> USD
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
