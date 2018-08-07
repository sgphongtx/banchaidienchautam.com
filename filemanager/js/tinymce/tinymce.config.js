tinymce.init({
	selector: "textarea.tinymce-editor",
	theme: "modern", 
	height: 400,
	language: 'vi_VN',
	plugins: [
		'advlist autolink lists link image charmap print preview hr anchor pagebreak',
		'searchreplace wordcount visualblocks visualchars code fullscreen',
		'insertdatetime media nonbreaking save table contextmenu directionality',
		'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
	],
	toolbar1: 'undo redo | styleselect | bold italic fontselect fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	toolbar2: 'print preview media | forecolor backcolor emoticons | codesample | fullscreen',

	entity_encoding : "raw",
	force_br_newlines : false,
	force_p_newlines : true,
	forced_root_block : '',
	menubar: true,
	statusbar: false,
	image_advtab: true ,
	relative_urls: false,
	remove_script_host : false,
	paste_retain_style_properties: "all",

 	valid_elements : "@[id|class|style|title|dir<ltr?rtl|lang|xml::lang|onclick|ondblclick|"
							+ "onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|"
							+ "onkeydown|onkeyup],a[rel|rev|charset|hreflang|tabindex|accesskey|type|"
							+ "name|href|target|title|class|onfocus|onblur],strong/b,em,i,strike,u,"
							+ "#p,-ol[type|compact],-ul[type|compact],-li,br,img[longdesc|usemap|"
							+ "src|border|alt=|title|hspace|vspace|width|height|align],-sub,-sup,"
							+ "-blockquote,-table[border=0|cellspacing|cellpadding|width|frame|rules|"
							+ "height|align|summary|bgcolor|background|bordercolor],-tr[rowspan|width|"
							+ "height|align|valign|bgcolor|background|bordercolor],tbody,thead,tfoot,"
							+ "#td[colspan|rowspan|width|height|align|valign|bgcolor|background|bordercolor"
							+ "|scope],#th[colspan|rowspan|width|height|align|valign|scope],caption,-div,"
							+ "-span,-code,-pre,address,-h1,-h2,-h3,-h4,-h5,-h6,hr[size|noshade],-font[face"
							+ "|size|color],dd,dl,dt,cite,abbr,acronym,del[datetime|cite],ins[datetime|cite],"
							+ "object[classid|width|height|codebase|*],param[name|value|_value],embed[type|width"
							+ "|height|src|*],script[src|type],map[name],area[shape|coords|href|alt|target],bdo,"
							+ "button,col[align|char|charoff|span|valign|width],colgroup[align|char|charoff|span|"
							+ "valign|width],dfn,fieldset,form[action|accept|accept-charset|enctype|method],"
							+ "input[accept|alt|checked|disabled|maxlength|name|readonly|size|src|type|value],"
							+ "kbd,label[for],legend,noscript,optgroup[label|disabled],option[disabled|label|selected|value],"
							+ "q[cite],samp,select[disabled|multiple|name|size],small,"
							+ "textarea[cols|rows|disabled|name|readonly],tt,var,big",

	external_filemanager_path: "/filemanager/",
	filemanager_title: "Responsive Filemanager" ,
	external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
	extended_valid_elements : "iframe[src|width|height|name|align],style[*],section[*],marquee[scrolldelay|scrollamount],script[language|type|src]",
	custom_elements: "marquee",
	schema: "html5",
});