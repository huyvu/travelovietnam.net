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
						<a class="toolbar" href="javascript:;" onclick="window.history.back()">
							<span title="Cancel" class="icon-32-cancel"></span>Cancel
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
		<div class="header icon-48-generic">
			USER
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
			        				<label>Full name:</label>
			        			</td>
			        			<td><?=($item->gender ? "Mr. " : "Ms. ").$item->fullname?></td>
							</tr>
							<tr>
			        			<td>
			        				<label>Email:</label>
			        			</td>
			        			<td><?=$item->email?></td>
							</tr>
							<tr>
			        			<td>
			        				<label>Phone:</label>
			        			</td>
			        			<td><?=$item->phone?></td>
							</tr>
							<tr>
			        			<td>
			        				<label>Nationality:</label>
			        			</td>
			        			<td><?=$item->nationality?></td>
							</tr>
							<tr>
			        			<td>
			        				<label>Birth date:</label>
			        			</td>
			        			<td><?=date('M d, Y', strtotime($item->birthday))?></td>
							</tr>
							<tr>
			        			<td>
			        				<label>Joined date:</label>
			        			</td>
			        			<td><?=date('M d, Y', strtotime($item->created_date))?></td>
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
