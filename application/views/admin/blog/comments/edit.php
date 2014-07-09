<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>jquery.tagit.css">
<?
	$content		= isset($item->content) ? $item->content : "";
	$name			= isset($item->name) ? $item->name : "";
	$email			= isset($item->email) ? $item->email : "";
	$blog_id		= isset($item->blog_id) ? $item->blog_id : null;
	$parent_id		= isset($item->parent_id) ? $item->parent_id : null;
	$avatar			= isset($item->avatar) ? $item->avatar : "";
	$active			= isset($item->active) ? $item->active : 1;
?>

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
			Blog Comments: <small><small>[ Edit ]</small></small>
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
			
				if (form.title.value == "")
				{
					alert( "PLEASE INPUT TITLE" );
					return;
				}
				submitform( pressbutton );
			}
		</script>
		<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_blog_comment")?>">
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
										<td width="100%">
											<input type="text" value="<?=$name?>" maxlength="255" id="name" name="name" class="inputbox" style="width: 50%; margin-left: 0px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Email:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$email?>" maxlength="255" id="email" name="email" class="inputbox" style="width: 50%; margin-left: 0px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Avatar:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$avatar?>" maxlength="255" id="avatar" name="avatar" class="inputbox" style="width: 50%; margin-left: 0px" onclick="openKCFinder4Textbox(this)" value="Click here and select a file double clicking on it" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Published:</label>
										</td>
										<td width="100%">
											<input type="radio" value="0" id="state0" name="active" <?=(!$active) ? "checked='checked'" : ""?> />
											<label for="state0">No</label>
											<input type="radio" value="1" id="state1" name="active" <?=($active) ? "checked='checked'" : ""?> />
											<label for="state1">Yes</label>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Blog:</label>
										</td>
										<td width="100%">
											<select id="blog_id" name="blog_id">
												<option value="">Select...</option>
												<?
													$blogs = $this->m_blog->getItems();
													foreach ($blogs as $blog) {
														if ($blog->id == $blog_id) {
												?>
														<option selected value="<?=$blog->id?>"><?=$blog->title?></option>
												<?
														}else{
												?>
														<option value="<?=$blog->id?>"><?=$blog->title?></option>
												<?		
														}
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Parent:</label>
										</td>
										<td width="100%">
											<select id="parent_id" name="parent_id">
												<option value="">Select...</option>
												<?
													$comments = $this->m_blog_comment->getItems();
													foreach ($comments as $comment) {
														if ($comment->id == $parent_id) {
												?>
														<option selected value="<?=$comment->id?>"><?=$comment->id?></option>
												<?
														}else{
												?>
														<option value="<?=$comment->id?>"><?=$comment->id?></option>
												<?		
														}
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td width="10%" valign="top">
											<label for="content">Content:</label>
										</td>
										<td width="100%">
											<textarea name="content" style="width:100%; height:200px"><?=$content?></textarea>
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?=JS_URL?>tag-it.min.js"></script>
<script type="text/javascript">
	jQuery.noConflict();
	(function($){
		var tags = "<?=$tags?>".split(",");
		$('#blogTags').val(tags);
		$("#myTags").tagit();
		 $('#myTags').tagit({
		 	availableTags: tags,
			// This will make Tag-it submit a single form value, as a comma-delimited field.
			singleField: true,
			singleFieldNode: $('#blogTags'),
			tagLimit : 10,
		});
	})(jQuery);
</script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		entity_encoding : "raw",
		convert_urls: false,
		elements : "description",
		theme : "advanced",
		plugins : "lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",
		
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		
		// Skin options
		skin : "o2k7",
		skin_variant : "silver",
		
		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",
	
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
	
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		},
		file_browser_callback: 'openKCFinder'
	});
</script>
