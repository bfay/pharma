eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(2($){$.c.f=2(p){p=$.d({g:"!@#$%^&*()+=[]\\\\\\\';,/{}|\\":<>?~`.- ",4:"",9:""},p);7 3.b(2(){5(p.G)p.4+="Q";5(p.w)p.4+="n";s=p.9.z(\'\');x(i=0;i<s.y;i++)5(p.g.h(s[i])!=-1)s[i]="\\\\"+s[i];p.9=s.O(\'|\');6 l=N M(p.9,\'E\');6 a=p.g+p.4;a=a.H(l,\'\');$(3).J(2(e){5(!e.r)k=o.q(e.K);L k=o.q(e.r);5(a.h(k)!=-1)e.j();5(e.u&&k==\'v\')e.j()});$(3).B(\'D\',2(){7 F})})};$.c.I=2(p){6 8="n";8+=8.P();p=$.d({4:8},p);7 3.b(2(){$(3).f(p)})};$.c.t=2(p){6 m="A";p=$.d({4:m},p);7 3.b(2(){$(3).f(p)})}})(C);',53,53,'||function|this|nchars|if|var|return|az|allow|ch|each|fn|extend||alphanumeric|ichars|indexOf||preventDefault||reg|nm|abcdefghijklmnopqrstuvwxyz|String||fromCharCode|charCode||alpha|ctrlKey||allcaps|for|length|split|1234567890|bind|jQuery|contextmenu|gi|false|nocaps|replace|numeric|keypress|which|else|RegExp|new|join|toUpperCase|ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('|'),0,{}));

function displayLoading() {  if (document.getElementById('upload-progress')) {   document.getElementById('upload-progress').style.display='block';  } }

function verify(){
msg = "Are you absolutely sure that you want to delete all selected images?";
return confirm(msg);
}

jQuery(document).ready(function($) {

	$('#show-hide-dynamik-settings-button').click(function() {
		$('#catalyst-dynamik-settings-content').animate({"height": "toggle"}, { duration: 300 });
	});

	// Variables
	var catalyst_options_nav_all = $('.catalyst-options-nav-all');
	var catalyst_all_options = $('.catalyst-all-options');
	
	catalyst_options_nav_all.click(function() {
		var nav_id = $(this).attr('id');
		catalyst_all_options.hide();
		$('#'+nav_id+'-box').show();
		catalyst_options_nav_all.removeClass('catalyst-options-nav-active');
		$('#'+nav_id).addClass('catalyst-options-nav-active');
		if( nav_id == 'catalyst-dynamik-options-nav-responsive' ) {
			if( $('#query-1').hasClass('responsive-hover-first') ) {
				$('#query-1').addClass('responsive-hover');
				$('#query-1-box').addClass('catalyst-options-display');
			}
			$('#query-1').removeClass('responsive-hover-first');
		}
	});
	
	$('.responsive-icon').click(function() {
		var nav_id = $(this).attr('id');
		$('.query-box-all').hide();
		$('#'+nav_id+'-box').show();
		$('.responsive-icon').removeClass('responsive-hover');
		$('#'+nav_id).addClass('responsive-hover');
	});
	
	$('.dynamik-level-option').change(function() {
		$('#catalyst-floating-save').addClass('dynamik-options-reload')
	});
	
	if( $('#catalyst-admin-wrap').hasClass('catalyst-wrap-structure-settings') ) {
		$('#show-hide-responsive-options-box').show();
	}
	
	$('.catalyst-bg-type').change(function() {
		var value = $(this).val() || [];
		var bg_type_id = $(this).attr('id');
		if( value != 'color' && value != 'transparent' ) {
			$('#'+bg_type_id+'-checkbox').animate({"height": "show"}, { duration: 300 });
		} else {
			$('#'+bg_type_id+'-checkbox').animate({"height": "hide"}, { duration: 300 });
		}
	});
	$('.catalyst-bg-type').change();
	
	$('.catalyst-universal-px-em-child').change(function() {
		var value = $(this).val() || [];
		var px_em_id = $(this).attr('id');
		var font_size = $('#'+px_em_id.slice(0,-6)+'-font-size').val();
		var body_font_size = $('#catalyst-body-font-size').val();
		if( value == 'em' ) {
			var value_conversion = font_size/body_font_size;
			var new_value = Math.round(value_conversion*1000)/1000;
		} else {
			var value_conversion = font_size*body_font_size;
			var new_value = Math.round(value_conversion);
		}
		$('#'+px_em_id.slice(0,-6)+'-font-size').val(new_value);
	});
	
	function universal_font_control() {
		var $this = $(this), $children = $('.'+$this.attr('id')+'-child');
		if( $this.hasClass('color') ) {
			var $thisColor = $this.css('color');
		}
		$children.each(function() {
			var $checkbox = $(this).parents('div.catalyst-dynamik-option').find('.universal-check');
			if( $checkbox.is(':checked') ){
				var $this_child = $(this);
				$this_child.val( $this.val() );
				if( $this_child.hasClass('color') ) {
					$this_child.css({'background-color': '#' + $this.val(), 'color': $thisColor });
				}
				if( $this_child.hasClass('catalyst-universal-px-em-child') ) {
					var value = $this_child.val() || [];
					var px_em_id = $this_child.attr('id');
					var font_size = $('#'+px_em_id.slice(0,-6)+'-font-size').val();
					var body_font_size = $('#catalyst-body-font-size').val();
					if( value == 'em' ) {
						var value_conversion = font_size/body_font_size;
						var new_value = Math.round(value_conversion*1000)/1000;
					} else {
						var value_conversion = font_size*body_font_size;
						var new_value = Math.round(value_conversion);
					}
					$('#'+px_em_id.slice(0,-6)+'-font-size').val(new_value);
				}
			}
		});
	}
		
	$('.universal-font-master').change(universal_font_control).keyup(universal_font_control);
	
	function hilight_custom() {
		$('.catalyst-universal-font-css-child').each(function(){
			var $this = $(this);
			var $button = $this.parent().parent().find('.catalyst-custom-fonts-button');
			if($this.val().length > 0) {
				$button.addClass('custom-hilight');
			} else {
				$button.removeClass('custom-hilight');
			}
		});
	}
	
	$('.catalyst-custom-fonts-button').click(function() {
		var $this = $(this), font_css_id = $this.attr('id');
		$('#'+font_css_id+'-box').animate({"height": "toggle"}, { duration: 300 });
		hilight_custom();
	});
	
	$('.catalyst-nav-sub-indicator-type').change(function() {
		var value = $(this).val() || [];
		var sub_indicator_type_id = $(this).attr('id');
		if( value == 'Image' ) {
			$('#'+sub_indicator_type_id+'-options').animate({"height": "show"}, { duration: 300 });
		} else {
			$('#'+sub_indicator_type_id+'-options').animate({"height": "hide"}, { duration: 300 });
		}
	});
	$('.catalyst-nav-sub-indicator-type').change();
	
	$('#show-hide-custom-layout-width-defaults').click(function() {
		$('#catalyst-custom-layout-width-defaults').animate({"height": "toggle"}, { duration: 300 });
	});
	
	function show_message(response) {
		$('#ajax-save-throbber').hide();
		$('#ajax-save-no-throb').show();
		$('#catalyst-dynamik-saved').html(response).center().fadeIn('slow');
		window.setTimeout(function(){
			$('#catalyst-dynamik-saved').fadeOut('slow'); 
		}, 2222);
	}
	
	$('.catalyst-save-button').mousedown(function() {
		$('#ajax-save-no-throb').hide();
		$('#ajax-save-throbber').show();
	});
	
	$('form#dynamik-options-form').submit(function() {
		if( $('form#responsive-options-form').length ) {
			if( $('#catalyst-dynamik-options-nav-responsive').hasClass('responsive-changed') ) {
				var responsive_data = $('form#responsive-options-form').serialize();
				jQuery.ajax({
					type: "POST",
					url: ajaxurl,
					data: responsive_data,
					async: false,
					success: function() {}
				});
			}
		}		
		var dynamik_data = $(this).serialize();
		jQuery.post(ajaxurl, dynamik_data, function(response) {
			if(response) {
				show_message(response);
			}
			if( $('#catalyst-floating-save').hasClass('dynamik-options-reload') ) {
				location.reload(true);
			}
		});
		return false;
	});
	
	$('#catalyst-dynamik-options-nav-responsive').click(function() {
		$('.responsive-option').change(function() {
			$('#catalyst-dynamik-options-nav-responsive').addClass('responsive-changed');
		});
	});
	
	$('.forbid-chars').on('keydown', function() {
		if (!$(this).data('init')) {
			$(this).data('init', true);
			$(this).alphanumeric({allow:'_',nocaps:false});
			$(this).trigger('keydown');
		}
	});
	
	function dynamik_width_calculator( num ) {
		var layout_type = $('#catalyst-layout-type-' + num).val();
		var cc_width = $('#catalyst-content-width-' + num).val();
		var sb1_width = $('#catalyst-sb1-width-' + num).val();
		var sb2_width = $('#catalyst-sb2-width-' + num).val();
		var sep_pad = $(":input[name='catalyst[sb_separation_padding]']").val();
		var wrap_pad = $(":input[name='catalyst[container_wrap_lr_padding]']").val();
		
		if( layout_type == 'double-right-sidebar' || layout_type == 'double-left-sidebar' || layout_type == 'double-sidebar' ){
			var cc_plus_sb_width = parseInt(cc_width) + parseInt(sb1_width) + parseInt(sb2_width);
			var total_sep_pad = parseInt(sep_pad) * 2;
		}else if( layout_type == 'right-sidebar' || layout_type == 'left-sidebar' ){
			var cc_plus_sb_width = parseInt(cc_width) + parseInt(sb1_width);
			var total_sep_pad = parseInt(sep_pad);
		}else{
			var cc_plus_sb_width = parseInt(cc_width);
			var total_sep_pad = 0;
		}
		
		var container_width = parseInt(cc_plus_sb_width) + parseInt(total_sep_pad);
		var container_pad = parseInt(wrap_pad) * 2;
		var wrap_width = parseInt(container_width) + parseInt(container_pad);

		$('#calculated-width-' + num).text(wrap_width);
		dynamik_responsive_wrap_width();
	}
	
	function dynamik_widths_change() {
		$('.catalyst-width-option-wrap').each( function() {
			var this_id = $(this).attr('id');
			if( this_id.slice(-2,-1) == '-' ) {
				var num = this_id.substr(-1);
			} else if( this_id.slice(-3,-2) == '-' ) {
				var num = this_id.substr(-2);
			} else if( this_id.slice(-4,-3) == '-' ) {
				var num = this_id.substr(-3);
			} else if( this_id.slice(-5,-4) == '-' ) {
				var num = this_id.substr(-4);
			}
			dynamik_width_calculator(num);
		});
	}
	
	$('.dynamik-width-option').keyup(dynamik_widths_change);
	
	$('.dynamik-update-wrap-widths').one('click', function() {
		var clickCounter = $('.dynamik-update-wrap-widths').data('clickCounter') || 0;
		if( clickCounter == 0 ) {
			dynamik_widths_change();
			clickCounter = 1;
		}
		$('.dynamik-update-wrap-widths').data('clickCounter', clickCounter);
	});
	
	function dynamik_responsive_wrap_width() {
		var wrap_pad = $(":input[name='catalyst[wrap_lr_padding]']").val();
		var wrap_width = $('#calculated-width-1').text();
		var total_width = parseInt(wrap_width) + ( parseInt(wrap_pad) * 2 );
		$('.responsive-wrap-width').text(total_width);
	}
	
	function catalyst_widget_width_calculator() {
		var site_width = $('#catalyst-widget-site-width').val();
		var widget_count = $('#catalyst-widget-count').val();
		var border_type = $('#catalyst-catalyst-widget-border-type').val();
		var border_thick = $('#catalyst-catalyst-widget-border-thickness').val();
		var left_margin = $('#catalyst-widget-margin-left').val();
		var right_margin = $('#catalyst-widget-margin-right').val();
		var left_padding = $('#catalyst-widget-padding-left').val();
		var right_padding = $('#catalyst-widget-padding-right').val();
		var container_lr_padding = $('#catalyst-container-wrap-lr-padding').val();
		
		if( border_type == 'Full' ){
			var border_width = parseInt(border_thick) * 2;
		}else if( border_type == 'Left' || border_type == 'Right' ){
			var border_width = parseInt(border_thick);
		}else{
			var border_width = 0;
		}
		
		if( site_width != 0 && widget_count != 0 ) {
			var calculated_widget_width = Math.floor( ( ( parseInt(site_width) - ( parseInt(container_lr_padding) * 2 ) ) / parseInt(widget_count) ) ) - ( parseInt(border_width) + parseInt(left_margin) + parseInt(right_margin) + parseInt(left_padding) + parseInt(right_padding) )
			$('#catalyst-widget-width').val(calculated_widget_width);
		}
	}
	
	$('.catalyst-widget-width-option').change(catalyst_widget_width_calculator).keyup(catalyst_widget_width_calculator);
	
	$('.wrap-div-option').change( function() {
		var opener = $('.wrap-opener:checked').nextAll('input:hidden').val();
		var closer = $('.wrap-closer:checked').nextAll('input:hidden').val();
		$('#catalyst-wrap-preview-img').attr('src', dynamik_wrap_image_url + opener + '-' + closer + '.png');
	});
	
	$('.wrap-div-option').change();
	hilight_custom();
	
	$('#ez-feature-check-all').click( function() {
		$('.ez-feature-check').attr('checked', true);
	});
	
	$('#ez-feature-uncheck-all').click( function() {
		$('.ez-feature-check').attr('checked', false);
	});
	
	$('#ez-footer-check-all').click( function() {
		$('.ez-footer-check').attr('checked', true);
	});
	
	$('#ez-footer-uncheck-all').click( function() {
		$('.ez-footer-check').attr('checked', false);
	});
	
	$('#catalyst-navbar-media-query-default').change(function() {
		var navbar_media_query_default = $('#catalyst-navbar-media-query-default').val();
		if( navbar_media_query_default == 'tablet_dropdown' || navbar_media_query_default == 'mobile_dropdown' ) {
			$('#catalyst-display-dropdown-menu-text-box').animate({"height": "show"}, { duration: 300 });
		} else {
			$('#catalyst-display-dropdown-menu-text-box').animate({"height": "hide"}, { duration: 300 });
		}
	});
	
	$('#catalyst-navbar-media-query-default').change();
	
	$("#catalyst-media-query-large-cascading-content").tabby();
	$("#catalyst-media-query-large-content").tabby();
	$("#catalyst-media-query-medium-cascading-content").tabby();
	$("#catalyst-media-query-medium-content").tabby();
	$("#catalyst-media-query-small-content").tabby();

});