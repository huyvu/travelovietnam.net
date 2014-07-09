<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>TraveloVietnam - Administration</title>
		
		<link rel='SHORTCUT ICON' href='<?=BASE_URL?>/favicon.ico'/>
		
		<link rel="stylesheet" href="<?=CSS_URL?>modal.css" type="text/css" />
		<link rel="stylesheet" href="<?=CSS_URL?>system.css" type="text/css" />
		<link rel="stylesheet" href="<?=CSS_URL?>template.css" type="text/css" />
		
		<script type="text/javascript" src="<?=JS_URL?>joomla.javascript.js"></script>
		<script type="text/javascript" src="<?=JS_URL?>mootools.js"></script>
		<script type="text/javascript" src="<?=JS_URL?>menu.js"></script>
		<script type="text/javascript" src="<?=JS_URL?>index.js"></script>
		<script type="text/javascript" src="<?=JS_URL?>modal.js"></script>
		<script type="text/javascript" src="<?=JS_URL?>util.js"></script>
		<script type="text/javascript" src="<?=TPL_URL?>tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
		
		<script type="text/javascript">
			window.addEvent('domready', function() {
				SqueezeBox.initialize({});
				$$('a.modal').each(function(el) {
					el.addEvent('click', function(e) {
						new Event(e).stop();
						SqueezeBox.fromElement(el);
					});
				});
			});
		</script>
		
		<script type="text/javascript">

			function openKCFile4Textbox(field) {
			    window.KCFinder = {
			        callBack: function(url) {
			            field.value = url;
			            window.KCFinder = null;
			        }
			    };
			    window.open('<?=BASE_URL?>/files/browse.php?type=file', 'kcfinder_textbox',
			        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
			        'resizable=1, scrollbars=0, width=800, height=600'
			    );
			}
			
			function openKCFinder4Textbox(field) {
			    window.KCFinder = {
			        callBack: function(url) {
			            field.value = url;
			            window.KCFinder = null;
			        }
			    };
			    window.open('<?=BASE_URL?>/files/browse.php?type=image&dir=files/public', 'kcfinder_textbox',
			        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
			        'resizable=1, scrollbars=0, width=800, height=600'
			    );
			}
			
			function openKCFinder(field_name, url, type, win) {
		    	tinyMCE.activeEditor.windowManager.open({
			        file: '<?=BASE_URL?>/files/browse.php?opener=tinymce&type=' + type,
			        title: 'File Management',
			        width: 700,
			        height: 500,
			        resizable: "yes",
			        inline: true,
			        close_previous: "no",
			        popup_css: false
			    }, {
			        window: win,
			        input: field_name
			    });
			    return false;
			}
			
			tinyMCE.init({
				// General options
				mode : "exact",
				entity_encoding : "raw",
				convert_urls: false,
				elements : "summary",
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
				content_css : "<?=CSS_URL?>content.css",
			
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
			
			tinyMCE.init({
				// General options
				mode : "exact",
				entity_encoding : "raw",
				convert_urls: false,
				elements : "amenities",
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
				content_css : "<?=CSS_URL?>content.css",
			
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
			
			tinyMCE.init({
				// General options
				mode : "exact",
				entity_encoding : "raw",
				convert_urls: false,
				elements : "highlight",
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
				content_css : "<?=CSS_URL?>content.css",
			
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
			
			tinyMCE.init({
				// General options
				mode : "exact",
				entity_encoding : "raw",
				convert_urls: false,
				elements : "price_inclusion",
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
				content_css : "<?=CSS_URL?>content.css",
			
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
			
			tinyMCE.init({
				// General options
				mode : "exact",
				entity_encoding : "raw",
				convert_urls: false,
				elements : "price_exclusion",
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
				content_css : "<?=CSS_URL?>content.css",
			
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
			
			tinyMCE.init({
				// General options
				mode : "exact",
				entity_encoding : "raw",
				convert_urls: false,
				elements : "content",
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
				content_css : "<?=CSS_URL?>content.css",
			
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
			
			tinyMCE.init({
				// General options
				mode : "exact",
				entity_encoding : "raw",
				convert_urls: false,
				elements : "detail",
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
				content_css : "<?=CSS_URL?>content.css",
			
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
			
			tinyMCE.init({
				// Answer options
				mode : "exact",
				entity_encoding : "raw",
				convert_urls: false,
				elements : "answer",
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
				content_css : "<?=CSS_URL?>content.css",
			
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
			
			tinyMCE.init({
				// Answer options
				mode : "exact",
				entity_encoding : "raw",
				convert_urls: false,
				elements : "policies",
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
				content_css : "<?=CSS_URL?>content.css",
			
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
			
			tinyMCE.init({
				// Answer options
				mode : "exact",
				entity_encoding : "raw",
				convert_urls: false,
				elements : "stop_detail",
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
				content_css : "<?=CSS_URL?>content.css",
			
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
	</head>
	<body id="minwidth-body">
		<div id="border-top" class="h_cherry">
			<div>
				<div><span class="title"></span></div>
			</div>
		</div>
		<? if ($this->session->userdata('addmin_logged_in')) { ?>
		<div id="header-box">
			<div id="module-status">
				<span class="preview"><a href="<?=BASE_URL?>" target="_blank">Preview</a></span>
				<span class="logout"><a href="<?=site_url("administrator/do_logout")?>">Logout</a></span>
			</div>
			<div id="module-menu">
				<ul id="menu">
					<li class="node">
						<a>Booking</a>
						<ul>
							<li><a class="" href="<?=site_url("administrator/tour_booking")?>">Vietnam Tour</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/flight_booking")?>">Vietnam Flight</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/hotel_booking")?>">Vietnam Hotel</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/visa_booking")?>">Vietnam Visa</a></li>
						</ul>
					</li>
					<li class="node">
						<a>Report</a>
						<ul>
							<li><a class="" href="<?=site_url("administrator/payment_report")?>">Payment Report</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/ip_tracking")?>">IP Tracking</a></li>
						</ul>
					</li>
					<li class="node">
						<a>Tour</a>
						<ul>
							<li><a class="" href="<?=site_url("administrator/tour_categories")?>">Categories</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/tour_activities")?>">Activities</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/tour_destinations")?>">Destinations</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/tours")?>">Vietnam Tours</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/tour_options")?>">Tour Options</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/tour_option_categories")?>">Tour Option Categories</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/content/tour-faqs")?>">FAQs</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/tour_request")?>">Tour Requests</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/answers")?>">Q&amp;A</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/reviews")?>">Reviews</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/content/travel-guides")?>">Travel Guides</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/content/tour-booking-conditions")?>">Booking Conditions</a></li>
						</ul>
					</li>
					<li class="node">
						<a>Flight</a>
						<ul>
							<li class="node">
								<a>Routes</a>
								<ul>
									<li class="node">
										<a>Vietnam</a>
										<ul>
											<li><a class="" href="<?=site_url("administrator/flights/buon-ma-thuot")?>">Buon Ma Thuot</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/ca-mau")?>">Ca Mau</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/can-tho")?>">Can Tho</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/chu-lai")?>">Chu Lai</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/con-dao")?>">Con Dao</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/da-lat")?>">Da Lat</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/da-nang")?>">Da Nang</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/dien-bien")?>">Dien Bien</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/dong-hoi")?>">Dong Hoi</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/ha-noi")?>">Ha Noi</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/hai-phong")?>">Hai Phong</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/ho-chi-minh-city")?>">Ho Chi Minh City</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/hue")?>">Hue</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/nha-trang")?>">Nha Trang</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/phu-quoc")?>">Phu Quoc</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/pleiku")?>">Pleiku</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/quy-nhon")?>">Quy Nhon</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/rach-gia")?>">Rach Gia</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/thanh-hoa")?>">Thanh Hoa</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/tuy-hoa")?>">Tuy Hoa</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/vinh")?>">Vinh</a></li>
										</ul>
									</li>
									<li class="separator"><span></span></li>
									<li class="node">
										<a>Australia</a>
										<ul>
											<li><a class="" href="<?=site_url("administrator/flights/melbourne")?>">Melbourne</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/sydney")?>">Sydney</a></li>
										</ul>
									</li>
									<li class="separator"><span></span></li>
									<li class="node">
										<a>Europe</a>
										<ul>
											<li><a class="" href="<?=site_url("administrator/flights/amsterdam")?>">Amsterdam</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/barcelona")?>">Barcelona</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/frankfurt")?>">Frankfurt</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/london")?>">London</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/moscow")?>">Moscow</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/nice")?>">Nice</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/paris")?>">Paris</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/prague")?>">Prague</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/rome")?>">Rome</a></li>
										</ul>
									</li>
									<li class="separator"><span></span></li>
									<li class="node">
										<a>Indochina</a>
										<ul>
											<li><a class="" href="<?=site_url("administrator/flights/luang-prabang")?>">Luang Prabang</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/phnom-penh")?>">Phnom Penh</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/siem-riep")?>">Siem Riep</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/vientiane")?>">Vientiane</a></li>
										</ul>
									</li>
									<li class="separator"><span></span></li>
									<li class="node">
										<a>North East Asia</a>
										<ul>
											<li><a class="" href="<?=site_url("administrator/flights/beijing")?>">Beijing</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/busan")?>">Busan</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/chengdu")?>">Chengdu</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/fukuoka")?>">Fukuoka</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/guangzhou")?>">Guangzhou</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/hong-kong")?>">Hong Kong</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/kaohsiung")?>">Kaohsiung</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/nagoya")?>">Nagoya</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/osaka")?>">Osaka</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/seoul")?>">Seoul</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/shanghai")?>">Shanghai</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/taipei")?>">Taipei</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/tokyo")?>">Tokyo</a></li>
										</ul>
									</li>
									<li class="separator"><span></span></li>
									<li class="node">
										<a>South East Asia</a>
										<ul>
											<li><a class="" href="<?=site_url("administrator/flights/bangkok")?>">Bangkok</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/jakarta")?>">Jakarta</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/kuala-lumpur")?>">Kuala Lumpur</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/manila")?>">Manila</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/singapore")?>">Singapore</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/yangon")?>">Yangon</a></li>
										</ul>
									</li>
									<li class="separator"><span></span></li>
									<li class="node">
										<a>United States of America</a>
										<ul>
											<li><a class="" href="<?=site_url("administrator/flights/atlanta-hartsfield")?>">Atlanta Hartsfield</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/austin")?>">Austin</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/boston-logan")?>">Boston, Logan</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/chicago-il")?>">Chicago IL</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/dallas-fort-worth")?>">Dallas Fort Worth</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/denver")?>">Denver</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/honolulu")?>">Honolulu</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/los-angeles")?>">Los Angeles</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/miami")?>">Miami</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/minneapolis-st-paul")?>">Minneapolis/St.Paul</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/philadelphia")?>">Philadelphia</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/portland")?>">Portland</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/san-francisco")?>">San Francisco</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/seattle-tacoma")?>">Seattle, Tacoma</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/st-louis-lambert")?>">St Louis, Lambert</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/flights/washington")?>">Washington</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/content/flight-information")?>">Flight Information</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/content/flight-faqs")?>">FAQs</a></li>
						</ul>
					</li>
					<li class="node">
						<a>Hotel</a>
						<ul>
							<li><a class="" href="<?=site_url("administrator/hotel_categories")?>">Categories</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/hotel_destinations")?>">Destinations</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/hotels")?>">Vietnam Hotels</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/content/hotel-faqs")?>">FAQs</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/hotel_request")?>">Hotel Requests</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/answers")?>">Q&amp;A</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/reviews")?>">Reviews</a></li>
						</ul>
					</li>
					<li class="node">
						<a>Visa</a>
						<ul>
							<li><a class="" href="<?=site_url("administrator/content/visa-news")?>">Visa News</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/visa_tips")?>">Visa Tips</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/embassies")?>">Vietnam Embassies</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/requirements")?>">Requirements</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/content/visa-faqs")?>">FAQs</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/answers")?>">Q&amp;A</a></li>
						</ul>
					</li>
					<li class="node">
						<a>Cuisine</a>
						<ul>
							<li><a class="" href="<?=site_url("administrator/cuisine_categories")?>">Categories</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/cuisines")?>">Vietnam Cuisines</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/answers")?>">Q&amp;A</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/reviews")?>">Reviews</a></li>
						</ul>
					</li>
					<li class="node">
						<a>Content</a>
						<ul>
							<li class="node">
								<a>Vietnam</a>
								<ul>
									<li><a class="" href="<?=site_url("administrator/content/vietnam-overview")?>">Vietnam Overview</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/vietnam_destinations")?>">Vietnam Destinations</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/travel-guide-for-beginner")?>">Travel Guide for Beginner</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/best-time-to-visit-vietnam")?>">Best time to visit Vietnam</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/vietnam-culture-and-history")?>">Vietnam Culture & History</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/vietnam-life-style")?>">Vietnam Life Style</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/festivals-events")?>">Vietnam Festivals & Events</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/vietnam-travel-tips")?>">Vietnam Travel Tips</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/vietnam_holidays")?>">Vietnam National Holidays</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/vietnam-travel-insurances")?>">Travel Insurances</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/vietnam-travel-visa")?>">Visa for Travel</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/vietnam-money-cost")?>">Money & Cost</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/vietnam-faqs")?>">Vietnam FAQ & Information</a></li>
									<li class="separator"><span></span></li>
									<li class="node">
										<a>Albums</a>
										<ul>
											<li><a class="" href="<?=site_url("administrator/album_categories")?>">Categories</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/albums")?>">Albums</a></li>
										</ul>
									</li>
									<li class="separator"><span></span></li>
									<li class="node">
										<a>Sights</a>
										<ul>
											<li><a class="" href="<?=site_url("administrator/sight_categories")?>">Categories</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/sights")?>">Sights</a></li>
										</ul>
									</li>
									<li class="separator"><span></span></li>
									<li class="node">
										<a>Entertainments</a>
										<ul>
											<li><a class="" href="<?=site_url("administrator/entertainment_categories")?>">Categories</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/entertainments")?>">Entertainments</a></li>
										</ul>
									</li>
									<li class="separator"><span></span></li>
									<li class="node">
										<a>Restaurants</a>
										<ul>
											<li><a class="" href="<?=site_url("administrator/restaurant_categories")?>">Categories</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/restaurants")?>">Restaurants</a></li>
										</ul>
									</li>
									<li class="separator"><span></span></li>
									<li class="node">
										<a>Shoppings</a>
										<ul>
											<li><a class="" href="<?=site_url("administrator/shopping_categories")?>">Categories</a></li>
											<li class="separator"><span></span></li>
											<li><a class="" href="<?=site_url("administrator/shoppings")?>">Shoppings</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/content/vietnam-highlights")?>">Vietnam Highlights</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/content/travel-news")?>">Travel News</a></li>
							<li class="separator"><span></span></li>
							<li class="node">
								<a>About</a>
								<ul>
									<li><a class="" href="<?=site_url("administrator/content/why-us")?>">Why Us</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/about-us")?>">About Us</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/our-community")?>">Our Community</a></li>
								</ul>
							</li>
							<li class="separator"><span></span></li>
							<li class="node">
								<a>Legal</a>
								<ul>
									<li><a class="" href="<?=site_url("administrator/content/privacy-policy")?>">Privacy Policy</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/terms-and-conditions")?>">Terms and Conditions</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/cancel-and-refund")?>">Cancel and Refund</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/money-back-guarantee")?>">Money Back Guarantee</a></li>
									<li class="separator"><span></span></li>
									<li><a class="" href="<?=site_url("administrator/content/safety-payment")?>">Safete Payment</a></li>
								</ul>
							</li>
							<li><a class="" href="<?=site_url("administrator/tooltips")?>">Tooltips</a></li>
						</ul>
					</li>
					<li class="node">
						<a href="<?=site_url("administrator/testimonials")?>">Testimonials</a>
					</li>
					<li class="node">
						<a>Blog</a>
						<ul>
							<li><a class="" href="<?=site_url("administrator/blog_categories")?>">Blog Categories</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/blog")?>">Blog</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/blog_comments")?>">Blog Comments</a></li>
						</ul>
					</li>
					<li class="node">
						<a>Help Center</a>
						<ul>
							<li><a class="" href="<?=site_url("administrator/help_categories")?>">Help Categories</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/help_content")?>">Help Content</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/help_tickets")?>">Help Tickets</a></li>
						</ul>
					</li>
					<li class="node">
						<a href="<?=site_url("administrator/team")?>">Team</a>
					</li>
					<li class="node">
						<a>Promotions</a>
						<ul>
							<li><a class="" href="<?=site_url("administrator/promotion_txts")?>">Templates</a></li>
						</ul>
					</li>
					<li class="node">
						<a class="" href="<?=site_url("administrator/messaging")?>">Contact</a>
					</li>
					<li class="node">
						<a href="<?=site_url("administrator/mail")?>">EMail</a>
					</li>
					<li class="node">
						<a>SEO</a>
						<ul>
							<li><a class="" href="<?=site_url("administrator/metas")?>">Meta Tags</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=site_url("administrator/redirects")?>">Page Redirect</a></li>
						</ul>
					</li>
					<li class="node">
						<a>Media</a>
						<ul>
							<li><a class="" href="<?=BASE_URL."/files/browse.php?type=image"?>">Image management</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=BASE_URL."/files/browse.php?type=file"?>">File management</a></li>
							<li class="separator"><span></span></li>
							<li><a class="" href="<?=BASE_URL."/files/browse.php?type=media"?>">Media management</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="clr"></div>
		</div>
		<? } ?>
		<div id="content-box">
			<div class="border">
				<div class="padding">
					<?= $content ?>
				</div>
			</div>
		</div>
		<div id="border-bottom">
			<div>
				<div></div>
			</div>
		</div>
	</body>
</html>
