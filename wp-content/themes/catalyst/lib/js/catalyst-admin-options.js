jQuery.fn.center = function () {
	this.css("position","absolute");
	this.css("top", ( jQuery(window).height() - this.height() - 200 ) / 2+jQuery(window).scrollTop() + "px");
	this.css("left", 450);
	return this;
}
jQuery(document).ready(function($) {

	if($.browser.msie) {
		$('select').one('mousedown',function(){
			$(this).data('origWidth', $(this).css('width'));
		}).mousedown(function(){
			$(this).css('width','auto');
		}).change(function(){
			$(this).css('width',$(this).data('origWidth'));
		}).blur(function(){
			$(this).css('width',$(this).data('origWidth'));
		});
	}

	$('.tooltip-mark').hover(function() {
		var tooltip_id = $(this).attr('id'), tooltip_class = $(this).attr('class');
		if (tooltip_class == 'tooltip-mark tooltip-top-left') {
			$('#'+tooltip_id).tooltip({ effect: 'slide', position: 'top left', offset: [20, 0], events: { def: 'click, hover', tooltip: 'mouseenter, mouseleave' }});
		} else if (tooltip_class == 'tooltip-mark tooltip-center-left') {
			$('#'+tooltip_id).tooltip({ effect: 'slide', position: 'center left', offset: [20, 0], events: { def: 'click, hover', tooltip: 'mouseenter, mouseleave' }});
		} else if (tooltip_class == 'tooltip-mark tooltip-bottom-left') {
			$('#'+tooltip_id).tooltip({ effect: 'slide', position: 'bottom left', events: { def: 'click, hover', tooltip: 'mouseenter, mouseleave' }});
		} else if (tooltip_class == 'tooltip-mark tooltip-top-right') {
			$('#'+tooltip_id).tooltip({ effect: 'slide', position: 'top right', offset: [20, 0], events: { def: 'click, hover', tooltip: 'mouseenter, mouseleave' }});
		} else if (tooltip_class == 'tooltip-mark tooltip-center-right') {
			$('#'+tooltip_id).tooltip({ effect: 'slide', position: 'center right', offset: [20, 0], events: { def: 'click, hover', tooltip: 'mouseenter, mouseleave' }});
		} else if (tooltip_class == 'tooltip-mark tooltip-bottom-right') {
			$('#'+tooltip_id).tooltip({ effect: 'slide', position: 'bottom right', events: { def: 'click, hover', tooltip: 'mouseenter, mouseleave' }});
		} else if (tooltip_class == 'tooltip-mark tooltip-top-center') {
			$('#'+tooltip_id).tooltip({ effect: 'slide', position: 'top center', offset: [10, 0], events: { def: 'click, hover', tooltip: 'mouseenter, mouseleave' }});
		} else if (tooltip_class == 'tooltip-mark tooltip-bottom-center') {
			$('#'+tooltip_id).tooltip({ effect: 'slide', position: 'bottom center', offset: [10, 0], events: { def: 'click, hover', tooltip: 'mouseenter, mouseleave' }});
		}
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
});