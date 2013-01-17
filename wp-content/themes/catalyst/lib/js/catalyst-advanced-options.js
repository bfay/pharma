eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(2($){$.c.f=2(p){p=$.d({g:"!@#$%^&*()+=[]\\\\\\\';,/{}|\\":<>?~`.- ",4:"",9:""},p);7 3.b(2(){5(p.G)p.4+="Q";5(p.w)p.4+="n";s=p.9.z(\'\');x(i=0;i<s.y;i++)5(p.g.h(s[i])!=-1)s[i]="\\\\"+s[i];p.9=s.O(\'|\');6 l=N M(p.9,\'E\');6 a=p.g+p.4;a=a.H(l,\'\');$(3).J(2(e){5(!e.r)k=o.q(e.K);L k=o.q(e.r);5(a.h(k)!=-1)e.j();5(e.u&&k==\'v\')e.j()});$(3).B(\'D\',2(){7 F})})};$.c.I=2(p){6 8="n";8+=8.P();p=$.d({4:8},p);7 3.b(2(){$(3).f(p)})};$.c.t=2(p){6 m="A";p=$.d({4:m},p);7 3.b(2(){$(3).f(p)})}})(C);',53,53,'||function|this|nchars|if|var|return|az|allow|ch|each|fn|extend||alphanumeric|ichars|indexOf||preventDefault||reg|nm|abcdefghijklmnopqrstuvwxyz|String||fromCharCode|charCode||alpha|ctrlKey||allcaps|for|length|split|1234567890|bind|jQuery|contextmenu|gi|false|nocaps|replace|numeric|keypress|which|else|RegExp|new|join|toUpperCase|ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('|'),0,{}));

jQuery(document).ready(function($){

	function getInputSelection(el) {
		var start = 0, end = 0, normalizedValue, range,
			textInputRange, len, endRange;

		if (typeof el.selectionStart == "number" && typeof el.selectionEnd == "number") {
			start = el.selectionStart;
			end = el.selectionEnd;
		} else {
			range = document.selection.createRange();

			if (range && range.parentElement() == el) {
				len = el.value.length;
				normalizedValue = el.value.replace(/\r\n/g, "\n");

				// Create a working TextRange that lives only in the input
				textInputRange = el.createTextRange();
				textInputRange.moveToBookmark(range.getBookmark());

				// Check if the start and end of the selection are at the very end
				// of the input, since moveStart/moveEnd doesn't return what we want
				// in those cases
				endRange = el.createTextRange();
				endRange.collapse(false);

				if (textInputRange.compareEndPoints("StartToEnd", endRange) > -1) {
					start = end = len;
				} else {
					start = -textInputRange.moveStart("character", -len);
					start += normalizedValue.slice(0, start).split("\n").length - 1;

					if (textInputRange.compareEndPoints("EndToEnd", endRange) > -1) {
						end = len;
					} else {
						end = -textInputRange.moveEnd("character", -len);
						end += normalizedValue.slice(0, end).split("\n").length - 1;
					}
				}
			}
		}

		return {
			start: start,
			end: end
		};
	}

	function offsetToRangeCharacterMove(el, offset) {
		return offset - (el.value.slice(0, offset).split("\r\n").length - 1);
	}

	function setInputSelection(el, startOffset, endOffset) {
		if (typeof el.selectionStart == "number" && typeof el.selectionEnd == "number") {
			el.selectionStart = startOffset;
			el.selectionEnd = endOffset;
		} else {
			var range = el.createTextRange();
			var startCharMove = offsetToRangeCharacterMove(el, startOffset);
			range.collapse(true);
			if (startOffset == endOffset) {
				range.move("character", startCharMove);
			} else {
				range.moveEnd("character", offsetToRangeCharacterMove(el, endOffset));
				range.moveStart("character", startCharMove);
			}
			range.select();
		}
	}
	
	// Variables
	var catalyst_options_nav_all = $('.catalyst-options-nav-all');
	var cct, sel, scrollTop, scrollLeft;
	
	catalyst_options_nav_all.click(function() {
		if($('#catalyst-advanced-options-nav-css').hasClass('catalyst-options-nav-active'))
		{
			cct = document.getElementById('catalyst-custom-css');
			sel = getInputSelection(cct);
			scrollTop = cct.scrollTop;
			scrollLeft = cct.scrollLeft;
		}
		var nav_id = $(this).attr('id');
		$('.catalyst-all-options').hide();
		$('#'+nav_id+'-box').show();
		if(nav_id != 'catalyst-advanced-options-nav-layouts')
		{
			$('#catalyst-floating-save').removeClass('catalyst-layouts');
		}
		else
		{
			$('#catalyst-floating-save').addClass('catalyst-layouts');
		}
		if(sel)
		{
			if(nav_id == 'catalyst-advanced-options-nav-css')
			{
				setInputSelection(cct, sel.start, sel.end);
				cct.scrollTop = scrollTop;
				cct.scrollLeft = scrollLeft;
			}
		}
		catalyst_options_nav_all.removeClass('catalyst-options-nav-active');
		$('#'+nav_id).addClass('catalyst-options-nav-active');
	});

	/* BEGIN View Only/All Hook Boxes */
	var view_only_hook_handler = function() {
		var this_hook_id = $(this).parent().parent().parent().attr('id');
		$('.catalyst-all-hook-boxes').hide();
		$('#'+this_hook_id).show();
		$('.view-only-hook').hide();
		$('.view-all-hooks').show();
	};
	
	$(".view-only-hook").bind("click", view_only_hook_handler);
	
	var view_all_hook_handler = function() {
		$('.catalyst-all-hook-boxes').show();
		$('.view-all-hooks').hide();
		$('.view-only-hook').show();
	};
	
	$(".view-all-hooks").bind("click", view_all_hook_handler);
	/* END View Only/All Hook Boxes */

	$('#catalyst-css-builder-popup-active').change(function() {
		if($('#catalyst-css-builder-popup-active').is(':checked')) {
			$('#catalyst-floating-save').removeClass('catalyst-css-tab');
			$('#catalyst-css-builder-popup-editor-only-wrap').animate({"height": "show"}, { duration: 300 });
		} else {
			$('#catalyst-floating-save').addClass('catalyst-css-tab');
			$('#catalyst-css-builder-popup-editor-only-wrap').animate({"height": "hide"}, { duration: 300 });
		}
	});

	function show_message(response) {
		$('#ajax-save-throbber').hide();
		$('#ajax-save-no-throb').show();
		$('#catalyst-advanced-saved').html(response).center().fadeIn('slow');
		window.setTimeout(function(){
			$('#catalyst-advanced-saved').fadeOut('slow'); 
		}, 2222);
	}
	
	$('form#advanced-options-form').submit(function() {
		$('#ajax-save-no-throb').hide();
		$('#ajax-save-throbber').show();
		var data = $(this).serialize();
		jQuery.post(ajaxurl, data, function(response) {
			if(response) {
				show_message(response);
			}
			if( $('#catalyst-floating-save').hasClass('catalyst-layouts') ) {
				window.setTimeout(function(){ location.reload(true); },1111);
			}
			if( $('#catalyst-floating-save').hasClass('catalyst-css-tab') ) {
				window.setTimeout(function(){ location.reload(true); },1111);
			}
		});
		return false;
	});
	
	$('.wrap').on('keydown', '.forbid-chars', function() {
		if (!$(this).data('init')) {
			$(this).data('init', true);
			$(this).alphanumeric({allow:'_',nocaps:true});
			$(this).trigger('keydown');
		}
	});
	
	$('.wrap').on('keydown', '.forbid-chars', function() {
		var value = $(this).val();
		value = value.replace(/^[0-9]/, '');
		$(this).val(value);
	});
	
	$('.wrap').on('keyup', '.forbid-chars', function() {
		var value = $(this).val();
		value = value.replace(/^[0-9]/, '');
		$(this).val(value);
	});
	
    $('.wrap').on('paste', '.forbid-chars', function(event) { 
        var charCode = event.which;
        var keyChar = String.fromCharCode(charCode); 
        return /[*]/.test(keyChar); 
    });
	
	$('.wrap').on('focusout', '.forbid-names', function(e) {
		var value = $(this).val();
		if(value == 'blog' || value == 'home' || value == 'post' || value == 'page' || value == 'single' || value == 'archive' || value == 'date' || value == 'category' || value == 'tag' || value == 'search' || value == 'error404') {
			setTimeout(function() {
				alert('"'+value+'" is not a valid Custom Layout Name. Please refer to the Custom Layouts [?]Tooltip (the section titled "Important Information About Naming Your Custom Layout") for more details.');
			}, 0);
		}
	});

	$('.layouts-list-multiselect').multiSelect({minWidth:250});

	var layout_counter = 1000;
	$('.add-layout').click(function () { 
		layout_counter += 1;
		$('#catalyst-layouts-wrap').prepend('<div id="layout-' + layout_counter + '"><div class="catalyst-custom-layout-option-desc"><p>' + e_custom_layout_options + '</p></div><div class="catalyst-custom-layout-option"><p class="bg-box-design">' + e_name + ' <input type="text" id="custom-layout-id-' + layout_counter + '" name="custom_layout_ids[]" value="" style="width:235px;" class="forbid-chars forbid-names"/> <select id="custom-layout-type-' + layout_counter + '" name="custom_layout_types[]" size="1" style="width:155px;">' + f_catalyst_list_layout_types + '</select><span id="' + layout_counter + '"class="button delete-layout">' + e_delete + '</span></p></div></div>');
	});
	
	$('.wrap').on('click', '.delete-layout', function () { 
		var confirm_layout_delete = confirm("Are you sure you want to Delete this Layout?");
		if(confirm_layout_delete) {
			var numb = $(this).attr('id');
			var layout_id = $('#custom-layout-id-' + numb).val();
					
			var data = {
				action: 'catalyst_layout_delete',
				layout_id: layout_id
			};

			jQuery.post(ajaxurl, data, function(response) {
			});
			
			$('#layout-' + numb).empty().remove();
			
			if( $('#catalyst-floating-save').hasClass('catalyst-layouts') ) {
				setTimeout( function() {
					location.reload(true);
				}, 500 );
			}
		}
	});

	var widget_counter = 1000;
	$('.add-widget').click(function () { 
		widget_counter += 1;
		$('#catalyst-widgets-wrap').prepend('<div id="widget-' + widget_counter + '"> <div class="catalyst-custom-widget-option"> <p class="bg-box-design"> ' + e_name + ' <input type="text" id="custom-widget-id-' + widget_counter + '" name="custom_widget_ids[' + widget_counter + ']" value="" style="width:250px;" class="forbid-chars" /> ' + e_hook + ' <select id="custom-widget-hook-' + widget_counter + '" name="custom_widget_hook[' + widget_counter + ']" size="1" style="width:250px;">' + f_catalyst_list_hooks + '</select> ' + e_priority + ' <input type="text" id="custom-widget-priority-' + widget_counter + '" name="custom_widget_priority[' + widget_counter + ']" value="10" style="width:30px;" /> | <select id="custom-widget-active-' + widget_counter + '" name="custom_widget_active[' + widget_counter + ']" ><option value="hkd">' + e_hooked + '</option><option value="sht">' + e_shortcode + '</option><option value="bth">' + e_both + '</option><option value="no">' + e_deactivate + '</option></select> </p> <p> ' + e_layouts + ' <select class="layouts-list-multiselect" id="custom-layouts-list-' + widget_counter + '" name="custom_layouts_list[' + widget_counter + '][]" multiple="multiple" style="width:250px;">' + f_catalyst_list_layouts + '</select> ' + e_class + ' <input type="text" id="custom-widget-class-' + widget_counter + '" name="custom_widget_class[' + widget_counter + ']" value="" style="width:250px;" /> <span id="' + widget_counter + '" class="button delete-widget"> ' + e_delete + '</span> </p> </div> </div>' );
		$('#custom-layouts-list-' + widget_counter).multiSelect()
		$('#custom-layouts-list-' + widget_counter).width(layouts_list_menu_width);
	});
	
	$('.wrap').on('click', '.delete-widget', function () {
		var numb = $(this).attr('id');
		var widget_name = $('#custom-widget-id-' + numb).val();
		if( widget_name != '' ) {
			var confirm_widget_delete = confirm("Are you sure you want to Delete this Widget Area?");
			if(confirm_widget_delete) {		
				var data = {
					action: 'catalyst_widget_delete',
					widget_name: widget_name
				};

				jQuery.post(ajaxurl, data, function(response) {
				});
				
				$('#widget-' + numb).empty().remove();
			}
		} else {
			var cannot_delete_widget = confirm("You cannot delete unsaved Custom Widget Areas. Instead, reload your Advanced Options admin page and they will automatically disappear.");
			if(cannot_delete_widget) {
			}
		}
	});
	
	var hook_counter = 1000;
	$('.add-hook').click(function () { 
		hook_counter += 1;
		$('#catalyst-hooks-wrap').prepend('<div id="hook-' + hook_counter + '"><div class="catalyst-custom-hook-option"><p class="bg-box-design">' + e_name + ' <input type="text" id="custom-hook-id-' + hook_counter + '" name="custom_hook_ids[' + hook_counter + ']" value="" style="width:250px;" class="forbid-chars" /> ' + e_hook + ' <select id="custom-hook-hook-' + hook_counter + '" name="custom_hook_hook[' + hook_counter + ']" size="1" style="width:250px;">' + f_catalyst_list_hooks + '</select> ' + e_priority + ' <input type="text" id="custom-hook-priority-' + hook_counter + '" name="custom_hook_priority[' + hook_counter + ']" value="10" style="width:30px;" /> |  <select id="custom-hook-active-' + hook_counter + '" name="custom_hook_active[' + hook_counter + ']" ><option value="hkd">' + e_hooked + '</option><option value="sht">' + e_shortcode + '</option><option value="bth">' + e_both + '</option><option value="no">' + e_deactivate + '</option></select></p><p>' + e_layouts + ' <select class="layouts-list-multiselect" id="custom-hook-layouts-list-' + hook_counter + '" name="custom_hook_layouts_list[' + hook_counter + '][]" multiple="multiple" style="width:250px;">' + f_catalyst_list_layouts + '</select> <span id="' + hook_counter + '" class="button delete-hook"> ' + e_delete + '</span></p><p><textarea class="resizable" id="custom-hook-textarea-' + hook_counter + '" name="custom_hook_textarea[' + hook_counter + ']" style="width:778px;height:100px;text-align:left;"></textarea></p></div></div>');
		$('#custom-hook-layouts-list-' + hook_counter).multiSelect();
		$('#custom-hook-layouts-list-' + hook_counter).width(layouts_list_menu_width);
		$('textarea.resizable:not(.processed)').TextAreaResizer();
	});
	
	$('.wrap').on('click', '.delete-hook', function () { 
		var confirm_hook_delete = confirm("Are you sure you want to Delete this Hook Box?");
		if(confirm_hook_delete) {
			var numb = $(this).attr('id');
			var hook_name = $('#custom-hook-id-' + numb).val();
					
			var data = {
				action: 'catalyst_hook_delete',
				hook_name: hook_name
			};

			jQuery.post(ajaxurl, data, function(response) {
			});
			
			$('#hook-' + numb).empty().remove();
		}
	});
	
	var css_builder_active = $('#catalyst-css-builder-popup-active:checked').val();
	if( css_builder_active ) {
		$('#css-builder-click-to-view').show();
		$('#catalyst-custom-css-admin-p').hide();
	}
	
	$('.catalyst-save-button').click(function() {
		var css_builder_active = $('#catalyst-css-builder-popup-active:checked').val();
		if( css_builder_active ) {
			$('#css-builder-click-to-view').animate({"height": "show"}, { duration: 300 });
			$('#catalyst-custom-css-admin-p').animate({"height": "hide"}, { duration: 300 });
		} else {
			$('#css-builder-click-to-view').animate({"height": "hide"}, { duration: 300 });
			$('#catalyst-custom-css-admin-p').animate({"height": "show"}, { duration: 300 });
		}
	});
	
	$("#css-builder-output").tabby();
	$("#catalyst-custom-css").tabby();

});