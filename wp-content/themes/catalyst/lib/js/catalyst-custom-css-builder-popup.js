function insertAtCaret(obj, text) {
	if(document.selection) {
		obj.focus();
		var orig = obj.value.replace(/\r\n/g, "\n");
		var range = document.selection.createRange();

		if(range.parentElement() != obj) {
			return false;
		}

		range.text = text;
		
		var actual = tmp = obj.value.replace(/\r\n/g, "\n");

		for(var diff = 0; diff < orig.length; diff++) {
			if(orig.charAt(diff) != actual.charAt(diff)) break;
		}

		for(var index = 0, start = 0; 
			tmp.match(text) 
				&& (tmp = tmp.replace(text, "")) 
				&& index <= diff; 
			index = start + text.length
		) {
			start = actual.indexOf(text, index);
		}
	} else if(obj.selectionStart) {
		var start = obj.selectionStart;
		var end   = obj.selectionEnd;

		obj.value = obj.value.substr(0, start) 
			+ text 
			+ obj.value.substr(end, obj.value.length);
	}
	
	if(start != null) {
		setCaretTo(obj, start + text.length);
	} else {
		obj.value += text;
	}
}
	
function setCaretTo(obj, pos) {
	if(obj.createTextRange) {
		var range = obj.createTextRange();
		range.move('character', pos);
		range.select();
	} else if(obj.selectionStart) {
		obj.focus();
		obj.setSelectionRange(pos, pos);
	}
}

jQuery(document).ready(function($) {

	/***
		For both Builder and Editor Only
										***/
	var custom_css_echo_value = $("#custom-css-echo").text()+"";
	custom_css_echo_value.replace(/url\(\images/g, cssBuilderImagesUrl);
	var custom_css_echo_val = $("#custom-css-echo").text();
	$("#custom-css-echo").text(custom_css_echo_val.replace(/url\(\images/g, cssBuilderImagesUrl));
	
	var media_query_custom_css_echo_value = $("#media-query-custom-css-echo").text()+"";
	media_query_custom_css_echo_value.replace(/url\(\images/g, cssBuilderImagesUrl);
	var media_query_custom_css_echo_val = $("#media-query-custom-css-echo").text();
	$("#media-query-custom-css-echo").text(media_query_custom_css_echo_val.replace(/url\(\images/g, cssBuilderImagesUrl));
	/***
		END Builder and Editor Only
										***/
	
	/***
		For Editor Only
						***/
	var css_editor_toggle_handler = function (event) {
		var clickCounter = $(event.target).data('clickCounter') || 0;
		
		if( clickCounter == 0 ) {
			$('body').addClass("css-builder-body-nav-empty css-builder-body-editor");
			$('#catalyst-custom-css-editor').animate({"width": "show"}, { duration: 300 });
			$('#catalyst-custom-css-builder-nav').animate({"height": "show"}, { duration: 300 });
			var css_editor_h3_draggable_mouseenter = function() {
				$("#catalyst-custom-css-editor").draggable();
				$("#catalyst-custom-css-editor").draggable( "enable" );
			};
			var css_editor_h3_draggable_mouseleave = function() {			
				$("#catalyst-custom-css-editor").draggable( "disable" );
			};
			$("#catalyst-custom-css-editor").addClass("css-editor-draggable");
			$("#css-editor-h3").bind("mouseenter", css_editor_h3_draggable_mouseenter);
			$("#css-editor-h3").bind("mouseleave", css_editor_h3_draggable_mouseleave);
			clickCounter = 1;
		} else {
			$('body').removeClass("css-builder-body-nav-empty");
			$('#catalyst-custom-css-editor').animate({"width": "hide"}, { duration: 300 });
			$('#catalyst-custom-css-builder-nav').animate({"height": "hide"}, { duration: 300 });
			clickCounter = 0;
		}
		
		$(event.target).data('clickCounter', clickCounter);
	};
	
	$("#css-builder-custom-css-only").bind('click', css_editor_toggle_handler).one('click', css_editor_activate);
	
	$("#css-builder-custom-css-only").one('click', function() {
		var custom_css_length = $('#catalyst-custom-css').val().length;
		$('#catalyst-custom-css').selectRange(custom_css_length,custom_css_length);
		$('#catalyst-custom-css').focus();
	});
	
	function css_editor_activate() {
		$('#custom-css-echo').html('');
		
		function show_message(response) {
			$('#ajax-save-throbber').hide();
			$('#ajax-save-no-throb').show();
			$('#catalyst-css-builder-saved').html(response).fadeIn('slow');
			window.setTimeout(function(){
				$('#catalyst-css-builder-saved').fadeOut('slow'); 
			}, 2222);
		}
		
		$('form#css-builder-custom-css-form').submit(function() {
			$('#ajax-save-no-throb').hide();
			$('#ajax-save-throbber').show();
			var data = $(this).serialize();
			jQuery.post(ajaxurl, data, function(response) {
				if(response) {
					show_message(response);
				}
			});
			return false;
		});
		
		function css_builder_custom_css_change() {
			var custom_css = $('#catalyst-custom-css').val();
			$("#css-builder-custom-css-only").html('<style id="css-builder-custom-css-style" type="text/css">' + custom_css + '</style>');
		}
		
		function css_builder_custom_css_change2() {
			css_builder_custom_css_change();
			var value = $("#css-builder-custom-css-style").text()+"";
			value.replace(/url\(\images/g, cssBuilderImagesUrl);
			var val = $("#css-builder-custom-css-style").text();
			$("#css-builder-custom-css-style").text(val.replace(/url\(\images/g, cssBuilderImagesUrl));
		}
		
		$('#catalyst-custom-css').bind('keyup paste', function(e) {
			if (e.type == 'paste') {
				setTimeout(css_builder_custom_css_change2, 20);
			} else {
				css_builder_custom_css_change2();
			}
		});
		
		css_builder_custom_css_change2();
	}
	/***
		END Editor Only
			***/

	/***
		For Builder Only
						***/
	var css_builder_toggle_handler = function (event) {
		var clickCounter = $(event.target).data('clickCounter') || 0;
		
		if( clickCounter == 0 ) {
			$('body').addClass("css-builder-body-nav css-builder-body-builder");
			$('#catalyst-custom-css-builder').animate({"width": "show"}, { duration: 300 });
			$('#catalyst-custom-css-builder-nav').animate({"height": "show"}, { duration: 300 });
			clickCounter = 1;
		} else {
			$('body').removeClass("css-builder-body-nav css-builder-body-builder");
			$('#catalyst-custom-css-builder').animate({"width": "hide"}, { duration: 300 });
			$('#catalyst-custom-css-builder-nav').animate({"height": "hide"}, { duration: 300 });
			clickCounter = 0;
		}
		
		$(event.target).data('clickCounter', clickCounter);
	};
	
	$("#css-builder-custom-css").bind('click', css_builder_toggle_handler).one('click', css_builder_activate);
	
	$("#css-builder-custom-css").one('click', function() {
		var custom_css_length = $('#catalyst-custom-css').val().length;
		$('#catalyst-custom-css').selectRange(custom_css_length,custom_css_length);
		$('#css-builder-output').focus();
	});

	function css_builder_activate() {
		$('#custom-css-echo').html('');
		
		function css_builder_element_labels_append() {
			$('body').css('position', 'relative').append('<img id="body-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/body-elements-label.png" title="body" />');
			$('#header-wrap').css('position', 'relative').append('<img id="header-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/header-elements-label.png" title="#header-wrap" />');
			$('#navbar-1-wrap').css('position', 'relative').append('<img id="navbar1-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/navbar1-elements-label.png" title="#navbar-1-wrap" />');
			$('#navbar-2-wrap').css('position', 'relative').append('<img id="navbar2-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/navbar2-elements-label.png" title="#navbar-2-wrap" />');
			$('.breadcrumbs').css('position', 'relative').append('<img id="breadcrumbs-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/breadcrumbs-elements-label.png" title=".breadcrumbs" />');
			$('#content-wrap').css('position', 'relative').append('<img id="content-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/content-elements-label.png" title="#content-wrap" />');
			$('#entry-author-info').css('position', 'relative').append('<img id="author-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/author-elements-label.png" title="#entry-author-info" />');
			$('#comment-wrap').css('position', 'relative').append('<img id="comments-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/comments-elements-label.png" title="#comment-wrap" />');
			$('#sidebar-1-wrap').css('position', 'relative').append('<img id="sidebar1-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/sidebar1-elements-label.png" title="#sidebar-1-wrap" />');
			$('#sidebar-2-wrap').css('position', 'relative').append('<img id="sidebar2-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/sidebar2-elements-label.png" title="#sidebar-2-wrap" />');
			$('#footer-wrap').css('position', 'relative').append('<img id="footer-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/footer-elements-label.png" title="#footer-wrap" />');
			$('#ez-feature-top-container-wrap').css('position', 'relative').append('<img id="ezfeaturetop-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/ezfeaturetop-elements-label.png" title="#ez-feature-top-container-wrap" />');
			$('#ez-fat-footer-container-wrap').css('position', 'relative').append('<img id="ezfatfooter-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/ezfatfooter-elements-label.png" title="#ez-fat-footer-container-wrap" />');
			$('#ez-home-container-wrap').css('position', 'relative').append('<img id="ezhome-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/ezhome-elements-label.png" title="#ez-home-container-wrap" />');
			$('#ez-home-sidebar-1-wrap').css('position', 'relative').append('<img id="ezhomesidebar-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/ezhomesidebar-elements-label.png" title="#ez-home-sidebar-1-wrap" />');
			$('#ez-home-slider-container-wrap').css('position', 'relative').append('<img id="homeslider-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/homeslider-elements-label.png" title="#ez-home-slider-container-wrap" />');
			$('.catalyst-widget-area').css('position', 'relative').append('<img id="customwidget-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/customwidget-elements-label.png" title=".catalyst-widget-area" />');
			$('.catalyst-excerpt-widget').css('position', 'relative').append('<img id="excerptwidget-label" class="element-labels" src="'+cssBuilderLabelsUrl+'/excerptwidget-elements-label.png" title=".catalyst-excerpt-widget" />');
		};
		
		var css_builder_element_selectors_enable_handler = function() {
			var clickCounter = $('#css-builder-element-selectors-wrap').data('clickCounter') || 0;
			
			if( clickCounter == 0 ) {
				$("#css-builder-element-selectors-wrap").addClass("element_selectors_enabled");
				css_builder_element_labels_append();
				$('#css-builder-element-selectors-enable').hide();
				$('#css-builder-element-selectors-disable').show();
				$('img.element-labels').animate(
					{opacity:"0.7"},
					{duration:"300"}
				);
				$('.element-labels').mouseover(function() {
					$(this).animate(
						{opacity:"1"},
						{duration:"300"}
					);
				});
				$('.element-labels').mouseleave(function() {
					$(this).animate(
						{opacity:".7"},
						{duration:"300"}
					);
				});
				$('.element-labels').click(function() {
					$('#css-builder-element-selectors-info').animate({"height": "hide"}, { duration: 300 });
					var element_label_id = $(this).attr('id');
					$('.all-labeled-elements').hide();
					$('#'+element_label_id+'-select').show();
					var value = $(this).attr('title') + ' {';
					var styles = " background: #DDFFDD !important; -moz-transition-property: background-color; -moz-transition-duration: .5s; -webkit-transition-property: background-color; -webkit-transition-duration: .5s; transition-property: background-color; transition-duration: .5s;";
					$("#css-builder-highlight-css").html('');
					$("#css-builder-highlight-css").html('<style type="text/css">' + value + styles + '}</style>');
					var lable_html = $(this).closest('div[id]').clone().wrap('<div></div>').parent().html().replace(/\t/g,'').replace(/ style="position: relative;"/g,'').replace(/ style="position: relative; "/g,'').replace(/ class=""/g,'');
					$("#css-builder-html").val(lable_html);
				});
				clickCounter = 1;
			} else {
				$("#css-builder-element-selectors-wrap").removeClass("element_selectors_enabled");
				$('img.element-labels').remove();
				$('#css-builder-element-selectors-enable').show();
				$('#css-builder-element-selectors-disable').hide();
				clickCounter = 0;
			}
			
			$('#css-builder-element-selectors-wrap').data('clickCounter', clickCounter);
		};
		
		$("#css-builder-element-selectors-wrap").bind("click", css_builder_element_selectors_enable_handler);
		
		$("#css-builder-element-selectors-wrap").one("click", function() {
			$('#css-builder-element-selectors-info').animate({"height": "show"}, { duration: 300 });
		});
		
		$('.labeled-elements-button').click(function() {
			if( $("#css-builder-element-selectors-wrap").hasClass("element_selectors_enabled") ) {
				$("#css-builder-element-selectors-wrap").click();
			}
		});
		
		var show_hide_builder_sidebar_toggle_handler = function (event) {
			var clickCounter = $(event.target).data('clickCounter') || 0;
			
			if( clickCounter == 0 ) {
				$('#catalyst-custom-css-builder-wrap-inner').animate({"width": "hide"}, { duration: 300 });
				$('#catalyst-custom-css-builder').css('width', '0');
				$('#catalyst-optionbox-inner-1col').css('width', '0');
				$('#catalyst-custom-css-builder-wrap').css('width', '0');
				$('body').removeClass("css-builder-body-builder");
				css_builder_custom_css_change2();
				clickCounter = 1;
			} else {
				$('#catalyst-custom-css-builder-wrap-inner').animate({"width": "show"}, { duration: 300 });
				$('#catalyst-custom-css-builder').css('width', '304px');
				$('#catalyst-optionbox-inner-1col').css('width', '304px');
				$('#catalyst-custom-css-builder-wrap').css('width', '302px');
				$('body').addClass("css-builder-body-builder");
				css_builder_custom_css_change2();
				clickCounter = 0;
			}
			
			$(event.target).data('clickCounter', clickCounter);
		};
		
		$("#custom-css-show-hide-sidebar-link").bind('click', show_hide_builder_sidebar_toggle_handler);
		
		var css_builder_toggle_css_handler = function() {
			$('#catalyst-custom-css').animate({ height: '200px' }, 300);
			$('#css-builder-output').animate({ height: '50px' }, 300);
			$('#css-builder-output-insert').addClass("css-builder-display-none");
			$('#css-builder-editor-css').html('');
		};
		
		$('#catalyst-custom-css').bind("focus", css_builder_toggle_css_handler);

		var css_builder_toggle_editor_handler = function() {
			$('#custom-css-popout-link').show("css-builder-display");
			$('#catalyst-custom-css').animate({ height: '50px' }, 300);
			$('#css-builder-output').animate({ height: '200px' }, 300);
			$('#css-builder-output-insert').removeClass("css-builder-display-none");
			css_builder_css_change();
		};

		$('#css-builder-output').bind("focus", css_builder_toggle_editor_handler);
		
		$('#css-builder-output').focus();
		
		var css_editor_h3_draggable_mouseenter = function() {
			$("#catalyst-custom-css-editor").draggable();
			$("#catalyst-custom-css-editor").draggable( "enable" );
		};
		
		var css_editor_h3_draggable_mouseleave = function() {			
			$("#catalyst-custom-css-editor").draggable( "disable" );
		};
		
		var css_editor_popout_handler = function() {
			$('#custom-css-popout-link').hide("css-builder-display");
			$('#custom-css-popin-link').show("css-builder-display");
			$('#custom-css-show-hide-sidebar-link').show("css-builder-display");
			$('#css-editor-h3').css("width", "628px");
			$('#catalyst-custom-css-editor-wrap-inner').css("width", "608px");
			$('#catalyst-custom-css').unbind("focus", css_builder_toggle_css_handler);
			$('#css-builder-output').unbind("focus", css_builder_toggle_editor_handler);
			$('#catalyst-custom-css').animate({ height: '300px', width: '600px' }, 300);
			$('#css-builder-output').animate({ height: '300px' }, 300);
			$('#css-builder-output-insert').removeClass("css-builder-display-none");
			$("#catalyst-custom-css-editor").addClass("css-editor-draggable");
			$("#css-editor-h3").bind("mouseenter", css_editor_h3_draggable_mouseenter);
			$("#css-editor-h3").bind("mouseleave", css_editor_h3_draggable_mouseleave);
			css_builder_custom_css_change2();
		};
		
		$("#custom-css-popout-link").bind("click", css_editor_popout_handler);
		
		var css_editor_popin_handler = function() {
			$('#catalyst-custom-css-builder-wrap-inner').animate({"width": "show"}, { duration: 300 });
			$('#catalyst-custom-css-builder').css('width', '304px');
			$('#catalyst-optionbox-inner-1col').css('width', '304px');
			$('#catalyst-custom-css-builder-wrap').css('width', '302px');
			$('body').addClass("css-builder-body-builder");
			$('#custom-css-popout-link').show("css-builder-display");
			$('#custom-css-popin-link').hide("css-builder-display");
			$('#custom-css-show-hide-sidebar-link').hide("css-builder-display");
			$('#css-editor-h3').css("width", "280px");
			$('#catalyst-custom-css-editor-wrap-inner').css("width", "260px");
			$('#catalyst-custom-css').bind("focus", css_builder_toggle_css_handler);
			$('#css-builder-output').bind("focus", css_builder_toggle_editor_handler);
			$('#catalyst-custom-css').animate({ height: '50px', width: '252px' }, 300);
			$('#css-builder-output').animate({ height: '200px' }, 300);
			$("#catalyst-custom-css-editor").removeClass("css-editor-draggable");
			$("#css-editor-h3").unbind("mouseenter", css_editor_h3_draggable_mouseenter);
			$("#css-editor-h3").unbind("mouseleave", css_editor_h3_draggable_mouseleave);
			css_builder_custom_css_change2();
		};
		
		$("#custom-css-popin-link").bind("click", css_editor_popin_handler);
		
		function show_message(response) {
			$('#ajax-save-throbber').hide();
			$('#ajax-save-no-throb').show();
			$('#catalyst-css-builder-saved').html(response).fadeIn('slow');
			window.setTimeout(function(){
				$('#catalyst-css-builder-saved').fadeOut('slow'); 
			}, 2222);
		}
		
		$('form#css-builder-custom-css-form').submit(function() {
			$('#ajax-save-no-throb').hide();
			$('#ajax-save-throbber').show();
			var data = $(this).serialize();
			jQuery.post(ajaxurl, data, function(response) {
				if(response) {
					show_message(response);
				}
			});
			return false;
		});
	
		function custom_widget_width_calculator() {
			var site_width = $('#site_width').val();
			var widget_count = $('#widgets_number').val();
			var border_type = $('#widget_border_type').val();
			var border_thick = $('#widget_border_thickness').val();
			var left_margin = $('#widget_margin_left').val();
			var right_margin = $('#widget_margin_right').val();
			var left_padding = $('#widget_padding_left').val();
			var right_padding = $('#widget_padding_right').val();
			
			if( border_type == 'border' ){
				var border_width = parseInt(border_thick) * 2;
			}else if( border_type == 'border-left' || border_type == 'border-right' ){
				var border_width = parseInt(border_thick);
			}else{
				var border_width = 0;
			}
			
			if( site_width != 0 && widget_count != 0 ) {
				var calculated_widget_width = Math.floor( parseInt(site_width) / parseInt(widget_count) ) - ( parseInt(border_width) + parseInt(left_margin) + parseInt(right_margin) + parseInt(left_padding) + parseInt(right_padding) )
				$('#widget_width').val(calculated_widget_width);
			}
		}
		
		$('.custom-widget-width-option').change(custom_widget_width_calculator).keyup(custom_widget_width_calculator);
		
		function append_scripts() {
			var value = $('#css-builder-scripts').val();
			$("head").append(value);
		}
		
		$('#css-builder-scripts').bind('blur paste', function(e) {
			if (e.type == 'paste') {
				setTimeout(append_scripts, 20);
			} else {
				append_scripts();
			}
		});
		
		$("#catalyst-custom-css-builder-nav").addClass('css-builder-element');
		$("#catalyst-custom-css-builder-nav *").addClass('css-builder-element');
		$("#catalyst-custom-css-builder-wrap").addClass('css-builder-element');
		$("#catalyst-custom-css-builder-wrap *").addClass('css-builder-element');
		$("#catalyst-custom-css-editor").addClass('css-builder-element');
		$("#catalyst-custom-css-editor *").addClass('css-builder-element');
		$("#css-builder-h3").addClass('css-builder-element');
		$("#css-builder-editor-css").addClass('css-builder-element');
		$("#css-builder-custom-css").addClass('css-builder-element');

		var catalyst_css_builder_nav_all = $('.catalyst-css-builder-nav-all');
		
		catalyst_css_builder_nav_all.click(function() {
			var css_nav_id = $(this).attr('id');
			$('.catalyst-all-css-builder').hide();
			$('#'+css_nav_id+'-box').show();
			catalyst_css_builder_nav_all.removeClass('catalyst-options-nav-active');
			$('#'+css_nav_id).addClass('catalyst-options-nav-active');
		});
		
		$(".css-builder-elements-select").change(function () {
			var value = $(this).val() || [];
			var styles = " background: #DDFFDD !important; -moz-transition-property: background-color; -moz-transition-duration: .5s; -webkit-transition-property: background-color; -webkit-transition-duration: .5s; transition-property: background-color; transition-duration: .5s;";
			$("#css-builder-highlight-css").html('<style type="text/css">' + value + styles + '}</style>');
		});
		
		function css_builder_custom_css_change() {
			var custom_css = $('#catalyst-custom-css').val();
			$("#css-builder-custom-css").html('<style id="css-builder-custom-css-style" type="text/css">' + custom_css + '</style>');
		}
		
		function css_builder_custom_css_change2() {
			css_builder_custom_css_change();
			var value = $("#css-builder-custom-css-style").text()+"";
			value.replace(/url\(\images/g, cssBuilderImagesUrl);
			var val = $("#css-builder-custom-css-style").text();
			$("#css-builder-custom-css-style").text(val.replace(/url\(\images/g, cssBuilderImagesUrl));
		}
		
		$('#catalyst-custom-css').bind('keyup paste', function(e) {
			if (e.type == 'paste') {
				setTimeout(css_builder_custom_css_change2, 20);
			} else {
				css_builder_custom_css_change2();
			}
		});
		
		css_builder_custom_css_change2();
		
		function css_builder_css_change() {
			var custom_css = $('#css-builder-output').val();
			$("#css-builder-highlight-css").html('');
			$("#css-builder-editor-css").html('<style id="css-builder-editor-css-style" type="text/css">' + custom_css + '</style>');
		}
		
		function css_builder_css_change2() {
			css_builder_css_change();
			$('*').removeClass('css-builder-hover-child');
			var value = $("#css-builder-editor-css-style").text()+"";
			value.replace(/url\(\images/g, cssBuilderImagesUrl);
			var val = $("#css-builder-editor-css-style").text();
			$("#css-builder-editor-css-style").text(val.replace(/url\(\images/g, cssBuilderImagesUrl));
		}
		
		$('#css-builder-output').bind('keyup paste', function(e) {
			if (e.type == 'paste') {
				setTimeout(css_builder_css_change2, 20);
			} else {
				css_builder_css_change2();
			}
		});

		$('.custom-css-builder-buttons').click(function() {
			css_builder_css_change2();
		});
		
		$('.custom-css-builder-button-elements').click(function() {
			var custom_css_length = $('#css-builder-output').val().length;
			var custom_css_cursor_position = custom_css_length - 3;
			$('#css-builder-output').selectRange(custom_css_cursor_position,custom_css_cursor_position);
		});
		
		$('#css-builder-output-insert').click(function() {
			var custom_css = $('#css-builder-output').val();
			var new_custom_css = custom_css.replace(/\n\n}/g,'\n}');
			$('#catalyst-custom-css').insertAtCaret(new_custom_css);
			css_builder_custom_css_change2();
			$('#css-builder-output').val('')
			$("#css-builder-editor-css").html('');
			css_builder_toggle_css();
		});
		
		var bodyClasses = $("body").attr('class');
		$("#css-builder-body-classes").val(bodyClasses);
		
		$('#css-builder-scripts-highlight').click(function() {
			selectAllText($('#css-builder-scripts'));
		});
		
		function selectAllText(textarea) {
			textarea.focus();
			textarea.select();
		}
		
		$.fn.getCursorPosition = function() {
			var pos = 0;
			var input = $(this).get(0);
			// IE Support
			if (document.selection) {
				input.focus();
				var sel = document.selection.createRange();
				var selLen = document.selection.createRange().text.length;
				sel.moveStart('character', -input.value.length);
				pos = sel.text.length - selLen;
			}
			// Firefox support
			else if (input.selectionStart || input.selectionStart == '0')
				pos = input.selectionStart;

			return pos;
		};
		
		$.fn.selectRange = function(start, end) {
			return this.each(function() {
				if (this.setSelectionRange) {
					this.focus();
					this.setSelectionRange(start, end);
				} else if (this.createTextRange) {
					var range = this.createTextRange();
					range.collapse(true);
					range.moveEnd('character', end);
					range.moveStart('character', start);
					range.select();
				}
			});
		};
		
		$.fn.insertAtCaret = function (tagName) {
			return this.each(function(){
				if (document.selection) {
					//IE support
					this.focus();
					sel = document.selection.createRange();
					sel.text = tagName;
					this.focus();
				} else if (this.selectionStart || this.selectionStart == '0') {
					//MOZILLA/NETSCAPE support
					startPos = this.selectionStart;
					endPos = this.selectionEnd;
					scrollTop = this.scrollTop;
					this.value = this.value.substring(0, startPos) + tagName + this.value.substring(endPos,this.value.length);
					this.focus();
					this.selectionStart = startPos + tagName.length;
					this.selectionEnd = startPos + tagName.length;
					this.scrollTop = scrollTop;
				} else {
					this.value += tagName;
					this.focus();
				}
			});
		};
	}
	
	// tabby plugin

	$.fn.tabby = function(options) {
		debug(this);
		// build main options before element iteration
		var opts = $.extend({}, $.fn.tabby.defaults, options);
		var pressed = $.fn.tabby.pressed; 
		
		// iterate and reformat each matched element
		return this.each(function() {
			$this = $(this);
			
			// build element specific options
			var options = $.meta ? $.extend({}, opts, $this.data()) : opts;
			
			$this.bind('keydown',function (e) {
				var kc = $.fn.tabby.catch_kc(e);
				if (16 == kc) pressed.shft = true;
				/*
				because both CTRL+TAB and ALT+TAB default to an event (changing tab/window) that 
				will prevent js from capturing the keyup event, we'll set a timer on releasing them.
				*/
				/* commenting this out to fix copy/paste issue
				if (17 == kc) {pressed.ctrl = true;	setTimeout("$.fn.tabby.pressed.ctrl = false;",1000);}
				if (18 == kc) {pressed.alt = true; 	setTimeout("$.fn.tabby.pressed.alt = false;",1000);}
				*/
					
				if (9 == kc && !pressed.ctrl && !pressed.alt) {
					e.preventDefault; // does not work in O9.63 ??
					pressed.last = kc;	setTimeout("$.fn.tabby.pressed.last = null;",0);
					process_keypress ($(e.target).get(0), pressed.shft, options);
					return false;
				}
				
			}).bind('keyup',function (e) {
				if (16 == $.fn.tabby.catch_kc(e)) pressed.shft = false;
			}).bind('blur',function (e) { // workaround for Opera -- http://www.webdeveloper.com/forum/showthread.php?p=806588
				if (9 == pressed.last) $(e.target).one('focus',function (e) {pressed.last = null;}).get(0).focus();
			});
		
		});
	};
	
	// define and expose any extra methods
	$.fn.tabby.catch_kc = function(e) { return e.keyCode ? e.keyCode : e.charCode ? e.charCode : e.which; };
	$.fn.tabby.pressed = {shft : false, ctrl : false, alt : false, last: null};
	
	// private function for debugging
	function debug($obj) {
		if (window.console && window.console.log)
		window.console.log('textarea count: ' + $obj.size());
	};

	function process_keypress (o,shft,options) {
		var scrollTo = o.scrollTop;
		//var tabString = String.fromCharCode(9);
		
		// gecko; o.setSelectionRange is only available when the text box has focus
		if (o.setSelectionRange) gecko_tab (o, shft, options);
		
		// ie; document.selection is always available
		else if (document.selection) ie_tab (o, shft, options);
		
		o.scrollTop = scrollTo;
	}
	
	// plugin defaults
	$.fn.tabby.defaults = {tabString : String.fromCharCode(9)};
	
	function gecko_tab (o, shft, options) {
		var ss = o.selectionStart;
		var es = o.selectionEnd;	
				
		// when there's no selection and we're just working with the caret, we'll add/remove the tabs at the caret, providing more control
		if(ss == es) {
			// SHIFT+TAB
			if (shft) {
				// check to the left of the caret first
				if ("\t" == o.value.substring(ss-options.tabString.length, ss)) {
					o.value = o.value.substring(0, ss-options.tabString.length) + o.value.substring(ss); // put it back together omitting one character to the left
					o.focus();
					o.setSelectionRange(ss - options.tabString.length, ss - options.tabString.length);
				} 
				// then check to the right of the caret
				else if ("\t" == o.value.substring(ss, ss + options.tabString.length)) {
					o.value = o.value.substring(0, ss) + o.value.substring(ss + options.tabString.length); // put it back together omitting one character to the right
					o.focus();
					o.setSelectionRange(ss,ss);
				}
			}
			// TAB
			else {			
				o.value = o.value.substring(0, ss) + options.tabString + o.value.substring(ss);
				o.focus();
				o.setSelectionRange(ss + options.tabString.length, ss + options.tabString.length);
			}
		} 
		// selections will always add/remove tabs from the start of the line
		else {
			// split the textarea up into lines and figure out which lines are included in the selection
			var lines = o.value.split("\n");
			var indices = new Array();
			var sl = 0; // start of the line
			var el = 0; // end of the line
			var sel = false;
			for (var i in lines) {
				el = sl + lines[i].length;
				indices.push({start: sl, end: el, selected: (sl <= ss && el > ss) || (el >= es && sl < es) || (sl > ss && el < es)});
				sl = el + 1;// for "\n"
			}
			
			// walk through the array of lines (indices) and add tabs where appropriate						
			var modifier = 0;
			for (var i in indices) {
				if (indices[i].selected) {
					var pos = indices[i].start + modifier; // adjust for tabs already inserted/removed
					// SHIFT+TAB
					if (shft && options.tabString == o.value.substring(pos,pos+options.tabString.length)) { // only SHIFT+TAB if there's a tab at the start of the line
						o.value = o.value.substring(0,pos) + o.value.substring(pos + options.tabString.length); // omit the tabstring to the right
						modifier -= options.tabString.length;
					}
					// TAB
					else if (!shft) {
						o.value = o.value.substring(0,pos) + options.tabString + o.value.substring(pos); // insert the tabstring
						modifier += options.tabString.length;
					}
				}
			}
			o.focus();
			var ns = ss + ((modifier > 0) ? options.tabString.length : (modifier < 0) ? -options.tabString.length : 0);
			var ne = es + modifier;
			o.setSelectionRange(ns,ne);
		}
	}
	
	function ie_tab (o, shft, options) {
		var range = document.selection.createRange();
		
		if (o == range.parentElement()) {
			// when there's no selection and we're just working with the caret, we'll add/remove the tabs at the caret, providing more control
			if ('' == range.text) {
				// SHIFT+TAB
				if (shft) {
					var bookmark = range.getBookmark();
					//first try to the left by moving opening up our empty range to the left
					range.moveStart('character', -options.tabString.length);
					if (options.tabString == range.text) {
						range.text = '';
					} else {
						// if that didn't work then reset the range and try opening it to the right
						range.moveToBookmark(bookmark);
						range.moveEnd('character', options.tabString.length);
						if (options.tabString == range.text) 
							range.text = '';
					}
					// move the pointer to the start of them empty range and select it
					range.collapse(true);
					range.select();
				}
				
				else {
					// very simple here. just insert the tab into the range and put the pointer at the end
					range.text = options.tabString; 
					range.collapse(false);
					range.select();
				}
			}
			// selections will always add/remove tabs from the start of the line
			else {
			
				var selection_text = range.text;
				var selection_len = selection_text.length;
				var selection_arr = selection_text.split("\r\n");
				
				var before_range = document.body.createTextRange();
				before_range.moveToElementText(o);
				before_range.setEndPoint("EndToStart", range);
				var before_text = before_range.text;
				var before_arr = before_text.split("\r\n");
				var before_len = before_text.length; // - before_arr.length + 1;
				
				var after_range = document.body.createTextRange();
				after_range.moveToElementText(o);
				after_range.setEndPoint("StartToEnd", range);
				var after_text = after_range.text; // we can accurately calculate distance to the end because we're not worried about MSIE trimming a \r\n
				
				var end_range = document.body.createTextRange();
				end_range.moveToElementText(o);
				end_range.setEndPoint("StartToEnd", before_range);
				var end_text = end_range.text; // we can accurately calculate distance to the end because we're not worried about MSIE trimming a \r\n
								
				var check_html = $(o).html();
				$("#r3").text(before_len + " + " + selection_len + " + " + after_text.length + " = " + check_html.length);				
				if((before_len + end_text.length) < check_html.length) {
					before_arr.push("");
					before_len += 2; // for the \r\n that was trimmed	
					if (shft && options.tabString == selection_arr[0].substring(0,options.tabString.length))
						selection_arr[0] = selection_arr[0].substring(options.tabString.length);
					else if (!shft) selection_arr[0] = options.tabString + selection_arr[0];	
				} else {
					if (shft && options.tabString == before_arr[before_arr.length-1].substring(0,options.tabString.length)) 
						before_arr[before_arr.length-1] = before_arr[before_arr.length-1].substring(options.tabString.length);
					else if (!shft) before_arr[before_arr.length-1] = options.tabString + before_arr[before_arr.length-1];
				}
				
				for (var i = 1; i < selection_arr.length; i++) {
					if (shft && options.tabString == selection_arr[i].substring(0,options.tabString.length))
						selection_arr[i] = selection_arr[i].substring(options.tabString.length);
					else if (!shft) selection_arr[i] = options.tabString + selection_arr[i];
				}
				
				if (1 == before_arr.length && 0 == before_len) {
					if (shft && options.tabString == selection_arr[0].substring(0,options.tabString.length))
						selection_arr[0] = selection_arr[0].substring(options.tabString.length);
					else if (!shft) selection_arr[0] = options.tabString + selection_arr[0];
				}

				if ((before_len + selection_len + after_text.length) < check_html.length) {
					selection_arr.push("");
					selection_len += 2; // for the \r\n that was trimmed
				}
				
				before_range.text = before_arr.join("\r\n");
				range.text = selection_arr.join("\r\n");
				
				var new_range = document.body.createTextRange();
				new_range.moveToElementText(o);
				
				if (0 < before_len)	new_range.setEndPoint("StartToEnd", before_range);
				else new_range.setEndPoint("StartToStart", before_range);
				new_range.setEndPoint("EndToEnd", range);
				
				new_range.select();
				
			} 
		}
	}

	$("#css-builder-output").tabby();
	$("#catalyst-custom-css").tabby();
	
});