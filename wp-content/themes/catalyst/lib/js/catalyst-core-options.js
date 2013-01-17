eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(2($){$.c.f=2(p){p=$.d({g:"!@#$%^&*()+=[]\\\\\\\';,/{}|\\":<>?~`.- ",4:"",9:""},p);7 3.b(2(){5(p.G)p.4+="Q";5(p.w)p.4+="n";s=p.9.z(\'\');x(i=0;i<s.y;i++)5(p.g.h(s[i])!=-1)s[i]="\\\\"+s[i];p.9=s.O(\'|\');6 l=N M(p.9,\'E\');6 a=p.g+p.4;a=a.H(l,\'\');$(3).J(2(e){5(!e.r)k=o.q(e.K);L k=o.q(e.r);5(a.h(k)!=-1)e.j();5(e.u&&k==\'v\')e.j()});$(3).B(\'D\',2(){7 F})})};$.c.I=2(p){6 8="n";8+=8.P();p=$.d({4:8},p);7 3.b(2(){$(3).f(p)})};$.c.t=2(p){6 m="A";p=$.d({4:m},p);7 3.b(2(){$(3).f(p)})}})(C);',53,53,'||function|this|nchars|if|var|return|az|allow|ch|each|fn|extend||alphanumeric|ichars|indexOf||preventDefault||reg|nm|abcdefghijklmnopqrstuvwxyz|String||fromCharCode|charCode||alpha|ctrlKey||allcaps|for|length|split|1234567890|bind|jQuery|contextmenu|gi|false|nocaps|replace|numeric|keypress|which|else|RegExp|new|join|toUpperCase|ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('|'),0,{}));

jQuery(document).ready(function($) {
	
	// Variables
	var catalyst_options_nav_all = $('.catalyst-options-nav-all');
	var catalyst_all_options = $('.catalyst-all-options');
	
	catalyst_options_nav_all.click(function() {
		var nav_id = $(this).attr('id');
		catalyst_all_options.hide();
		$('#'+nav_id+'-box').show();
		catalyst_options_nav_all.removeClass('catalyst-options-nav-active');
		$('#'+nav_id).addClass('catalyst-options-nav-active');
	});
	
	function show_message(response) {
		$('#ajax-save-throbber').hide();
		$('#ajax-save-no-throb').show();
		$('#catalyst-core-saved').html(response).center().fadeIn('slow');
		window.setTimeout(function(){
			$('#catalyst-core-saved').fadeOut('slow'); 
		}, 2222);
	}
	
	$('form#core-options-form').submit(function() {
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

	$('.forbid-chars').on('keydown', function() {
		if (!$(this).data('init')) {
			$(this).data('init', true);
			$(this).alphanumeric({allow:'_',nocaps:false});
			$(this).trigger('keydown');
		}
	});
	
	$('#catalyst-logo-links-to').change(function() {
		var logo_links_to = $('#catalyst-logo-links-to').val();
		if( logo_links_to != 'custom_url' ) {
			$('#catalyst-logo-links-to-box').animate({"height": "hide"}, { duration: 300 });
		} else {
			$('#catalyst-logo-links-to-box').animate({"height": "show"}, { duration: 300 });
		}
	});
	
	$('#catalyst-logo-links-to').change();
	
	$('#catalyst-nav1-type').change(function() {
		var default_content_type = $('#catalyst-nav1-type').val();
		if( default_content_type == 'Default' ) {
			$('#catalyst-display-default-nav1-box').animate({"height": "show"}, { duration: 300 });
		} else {
			$('#catalyst-display-default-nav1-box').animate({"height": "hide"}, { duration: 300 });
		}
	});
	
	$('#catalyst-nav1-type').change();
	
	$('#catalyst-nav2-type').change(function() {
		var default_content_type = $('#catalyst-nav2-type').val();
		if( default_content_type == 'Default' ) {
			$('#catalyst-display-default-nav2-box').animate({"height": "show"}, { duration: 300 });
		} else {
			$('#catalyst-display-default-nav2-box').animate({"height": "hide"}, { duration: 300 });
		}
	});
	
	$('#catalyst-nav2-type').change();
	
	$('#catalyst-nav1-right-content').change(function() {
		var default_content_type = $('#catalyst-nav1-right-content').val();
		if( default_content_type == 'Text' ) {
			$('#catalyst-display-nav1-text-box').animate({"height": "show"}, { duration: 300 });
		} else {
			$('#catalyst-display-nav1-text-box').animate({"height": "hide"}, { duration: 300 });
		}
	});
	
	$('#catalyst-nav1-right-content').change();
	
	$('#catalyst-nav2-right-content').change(function() {
		var default_content_type = $('#catalyst-nav2-right-content').val();
		if( default_content_type == 'Text' ) {
			$('#catalyst-display-nav2-text-box').animate({"height": "show"}, { duration: 300 });
		} else {
			$('#catalyst-display-nav2-text-box').animate({"height": "hide"}, { duration: 300 });
		}
	});
	
	$('#catalyst-nav2-right-content').change();
	
	$('#catalyst-default-content-type').change(function() {
		var default_content_type = $('#catalyst-default-content-type').val();
		if( default_content_type == 'Hybrid' ) {
			$('#catalyst-display-default-hybrid-box').animate({"height": "show"}, { duration: 300 });
		} else {
			$('#catalyst-display-default-hybrid-box').animate({"height": "hide"}, { duration: 300 });
		}
	});
	
	$('#catalyst-default-content-type').change();
	
	$('#catalyst-archive-content-type').change(function() {
		var archive_content_type = $('#catalyst-archive-content-type').val();
		if( archive_content_type == 'Hybrid' ) {
			$('#catalyst-display-archive-hybrid-box').animate({"height": "show"}, { duration: 300 });
		} else {
			$('#catalyst-display-archive-hybrid-box').animate({"height": "hide"}, { duration: 300 });
		}
	});
	
	$('#catalyst-archive-content-type').change();
	
	$('#catalyst-footer-content').keyup(function() {
		var $this = $(this), the_length = $this.val().length, last_char = $this.val().charAt(the_length-1);
		if( last_char == ']' ) {
			var val = $this.val();
			$this.val(val + ' ');
		}
	});
	
	$('#catalyst-remove-all-page-titles').change(function() {
		var remove_all_page_titles = $('#catalyst-remove-all-page-titles:checked').val();
		if( remove_all_page_titles ) {
			$('#catalyst-remove-all-page-titles-box').animate({"height": "hide"}, { duration: 300 });
		} else {
			$('#catalyst-remove-all-page-titles-box').animate({"height": "show"}, { duration: 300 });
		}
	});
	
	$('#catalyst-remove-all-page-titles').change();
	
	$('.catalyst-custom-fonts-button').click(function() {
		var $this = $(this), font_css_id = $this.attr('id');
		$('#'+font_css_id+'-box').animate({"height": "toggle"}, { duration: 300 });
		hilight_custom();
	});
	
});