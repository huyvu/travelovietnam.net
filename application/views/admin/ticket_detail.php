<style>
.prss0 {
}
.prss1 {
	color: orange;
}
.prss2 {
	color: red;
}
.car_item {
	background-color: #ADA081;
}
</style>

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
					<td id="toolbar-cancel" class="button">
						<a class="toolbar" href="<?=site_url("administrator/ticket")?>">
							<span title="Cancel" class="icon-32-cancel"></span>Cancel
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
		<div class="header icon-48-generic">
			TICKETS
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
					submitform(pressbutton);
					return;
				}
			
				submitform( pressbutton );
			}
		</script>
		<form id="adminForm" name="adminForm" method="post" action="index.php">
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
			    <tbody><tr>
			        <td valign="top">
			            <table>
			            	<tbody>
			            	<tr>
			        			<td width="100px" valign="top">
			        				<label>Fullname:</label>
			        			</td>
			        			<td width="100%"><?=$item->fullname?></td>
							</tr>
							<tr>
			        			<td width="100px" valign="top">
			        				<label>Phone number</label>
			        			</td>
			        			<td width="100%"><?=$item->phone?></td>
							</tr>
							<tr>
			        			<td width="100px" valign="top">
			        				<label>Sender email:</label>
			        			</td>
			        			<td width="100%"><?=$item->email?></td>
							</tr>
							<tr>
			        			<td width="10%" valign="top">
			        				<label>To department:</label>
			        			</td>
			        			<td width="100%"><?=$item->receiver?></td>
							</tr>
			            	<tr>
			        			<td width="10%" valign="top">
			        				<label>Subject:</label>
			        			</td>
			        			<td width="100%"><?=$item->subject?></td>
							</tr>
							<tr>
			        			<td width="10%" valign="top">
			        				<label for="description">Message:</label>
			        			</td>
			        			<td width="100%">
			        				<?=$item->message?>
			        			</td>
							</tr>
						</tbody></table>
			        </td>
			    </tr>
			</tbody></table>
			<input type="hidden" value="" name="task">
		</form>
		<div class="clr"></div>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>
