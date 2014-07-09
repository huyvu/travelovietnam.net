<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>jquery.tagit.css">
<?
	if ($this->session->userdata('user')) {
		$user = $this->session->userdata('user');
	}
?>
<?
	$title			= isset($item->title) ? $item->title : "";
	$userid			= isset($item->userid) ? $item->userid : null;
	$alias			= isset($item->alias) ? $item->alias : "";
	$thumbnail		= isset($item->thumbnail) ? $item->thumbnail : "";
	$meta_title 	= isset($item->meta_title) ? $item->meta_title : "";
	$meta_key 		= isset($item->meta_key) ? $item->meta_key : "";
	$meta_desc 		= isset($item->meta_desc) ? $item->meta_desc : "";
	$cat_id			= isset($item->cat_id) ? $item->cat_id : null;
	$summary		= isset($item->summary) ? $item->summary : "";
	$content		= isset($item->content) ? $item->content : "";
	$tags			= isset($item->tags) ? $item->tags : "";
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
			Blog: <small><small>[ Edit ]</small></small>
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
		<form id="adminForm" name="adminForm" method="post" action="<?=site_url("administrator/update_blog")?>">
			<input type="hidden" name="task" value="" />
			<? if (isset($item)) { ?>
				<input type="hidden" name="action" id="action" value="edit"/>
				<input type="hidden" name="id" id="id" value="<?=(isset($item->id)?$item->id:0)?>"/>
			<? } else { ?>
				<input type="hidden" name="action" id="action" value="new"/>
			<? } ?>
			<input type="hidden" name="userid" id="userid" value="<?=($userid)?$userid:$user['id']?>"/>
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tbody>
					<tr>
						<td valign="top">
							<table class="adminform">
								<tbody>
									<tr>
										<td width="10%">
											<label for="name">Title:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$title?>" maxlength="255" id="title" name="title" class="inputbox" style="width: 50%; margin-left: 0px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Alias:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$alias?>" maxlength="255" id="alias" name="alias" class="inputbox" style="width: 50%; margin-left: 0px" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="name">Thumbnail:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$thumbnail?>" maxlength="255" id="thumbnail" name="thumbnail" class="inputbox" style="width: 50%; margin-left: 0px" onclick="openKCFinder4Textbox(this)" value="Click here and select a file double clicking on it" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Meta Title (for SEO):</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$meta_title?>" maxlength="255" id="meta_title" name="meta_title" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label>Keywords:</label>
										</td>
										<td width="100%">
											<input type="text" value="<?=$meta_key?>" maxlength="255" id="meta_key" name="meta_key" class="inputbox" style="width: 100%" />
										</td>
									</tr>
									<tr valign="top">
										<td width="10%">
											<label>Page description:</label>
										</td>
										<td width="100%">
											<textarea name="meta_desc" style="width:100%; height:120px"><?=$meta_desc?></textarea>
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
											<label>Category:</label>
										</td>
										<td width="100%">
											<select id="cat_id" name="cat_id">
												<?
													$cats = $this->m_blog_category->getItems();
													foreach ($cats as $cat) {
														if ($cat->id == $cat_id) {
												?>
														<option selected value="<?=$cat->id?>"><?=$cat->name?></option>
												<?
														}else{
												?>
														<option value="<?=$cat->id?>"><?=$cat->name?></option>
												<?		
														}
													}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td width="10%" valign="top">
											<label for="summary">Summary:</label>
										</td>
										<td width="100%">
											<textarea name="summary" style="width:100%; height:200px"><?=$summary?></textarea>
										</td>
									</tr>
									<tr>
										<td width="10%" valign="top">
											<label for="content">Content:</label>
										</td>
										<td width="100%">
											<textarea name="content" style="width:100%; height:600px"><?=$content?></textarea>
										</td>
									</tr>
									<tr>
										<td width="10%">
											<label for="tags">Tags:</label>
										</td>
										<td width="100%">
											<input type="hidden" name="blogTags" id="blogTags" disable="true">
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
