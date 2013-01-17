/* -----------------------------
*  General Functions
* --------------------------- */
jQuery.fn.center = function ( element ) {
    this.css("position","absolute");
    this.css("top", ( jQuery(window).height() - this.height() ) / 4+jQuery(window).scrollTop() + "px");
    this.css("left", ( jQuery(element).width() - this.width() ) / 2+jQuery(element).scrollLeft() + "px");
    return this;
}


/* -----------------------------
*  Fade out messages
* --------------------------- */
jQuery(function() {
	jQuery(".fade").delay('3000').slideToggle("slow");
});


/* -----------------------------
*  Confirm message for restore
* --------------------------- */
jQuery(function() {
	jQuery('#fpRestore').click(function(){
		var answer = confirm('Are you sure you want to restore default settings?');
		return answer;
	});
});


/* -----------------------------
*  Color Picker
* --------------------------- */
function setColorPicker(element, color){
	jQuery('#fpBody #'+element+'_picker').children('div').css('backgroundColor', color);    
	jQuery('#fpBody #'+element+'_picker').ColorPicker({
		color: color,
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#fpBody #'+element+'_picker').children('div').css('backgroundColor', '#' + hex);
			jQuery('#fpBody #'+element+'_picker').next('input').attr('value','#' + hex);
		},
		onSubmit: function (hsb, hex, rgb) {
			fpSubmitForm();
			updateform( jQuery('#fpBody #'+element+'_picker').next('input') );
		}
	});
}


/* -----------------------------
*  Uploadify
* --------------------------- */
function setUpload(element, frameworkdir){
	var input_text = '#fpBody #' + element;
	var input_upload = '#fpBody #' + element + '_upload';
	var input_preview = '#fpBody #' + element + '_preview';

	var now    = new Date();
	var time   = now.getTime();

	jQuery(input_upload).uploadify({
		'uploader'  : frameworkdir + 'images/uploadify/uploadify.swf',
		'script'    : frameworkdir + 'plugins/uploadify.php',
		'cancelImg' : frameworkdir + 'images/uploadify/cancel.png',
		'buttonImg' : frameworkdir + 'images/uploadify/button.jpg',
		'folder'    : userSettings.url + 'wp-content/uploads/',
		'auto'      : true,
		'height'    : 22,
		'width'     : 82,
		'scriptData': {'addonfile':time},

		'onError'   : function(e,q,f,errorObj){
			console.log(errorObj.type+"    "+errorObj.info);
		},

		'onComplete': function(event, queueID, fileObj){
			var fileName= userSettings.url + 'wp-content/uploads/' + time + '-' + fileObj.name;

                	jQuery(input_text).val(fileName);
			jQuery(input_preview).html('<img src="'+fileName+'"/>');

			fpSubmitForm();
		}
      });
}

/* -----------------------------
*  Function to get parameters
* --------------------------- */
function getParameters(a){return decodeURIComponent(((new RegExp("[?|&]"+a+"="+"([^&;]+?)(&|#|;|$)")).exec(location.search)||[,""])[1].replace(/\+/g,"%20"))||null}


/* -----------------------------
*  Menu Tabs
* --------------------------- */
jQuery(function() {
	jQuery( "#fpBody #fpContent" ).tabs({
		fx: { opacity: "toggle", duration: "fast" }, selected: 0
	});

	var tab = getParameters("tab");

	if(tab) {
	    jQuery("#fpBody #fpContent").tabs("select","#_" + tab);
	}
});


/* -----------------------------
*  Toggle
* --------------------------- */
jQuery(function() {
	jQuery("#fpBody .togglethis").change( function() {
		jQuery(this).parent().parent().parent().find('.toggle_show').slideUp("slow");
		jQuery(this).parent().parent().find('.' + jQuery(this).val()).slideDown("slow").addClass('toggle_show');
	});
});


/* -----------------------------
*  Font select
* --------------------------- */
jQuery(function() {
	jQuery("#fpBody .option-font select").change( function() {
		var style = jQuery(this).attr('title');
		var value = jQuery(this).val();
		var fvalue = jQuery(this).find('option:selected').attr('title');

		if(style == 'font-family') {
			var url = 'http://fonts.googleapis.com/css?family=' + fvalue;
			jQuery(this).parent().find('link').attr("href", url);
			jQuery(this).parent().find('.font-preview').css(style, value);
		} else {
			jQuery(this).parent().parent().parent().parent().parent().parent().find('.font-preview').css(style, value);
		}
	});

	jQuery("#fpBody .option-font .editfont").click( function() {
		jQuery(this).parent().find('.option-font-style').slideToggle("slow");

	});
});


/* -----------------------------
*  Layout options
* --------------------------- */
jQuery(function() {
	jQuery("#fpBody .option-layout input").change( function() {

		jQuery(this).parent().parent().find('label').removeClass('active');

		if(jQuery(this).is(':checked'))  {
			jQuery(this).parent().find('label').addClass('active');
		}
	});
});


/* -----------------------------
*  Form Options Save
* --------------------------- */
function fpSubmitForm() {
	jQuery("#fpForm").submit();
}

jQuery(function() {
	jQuery("#fpForm").submit( function() {
	    if( (jQuery(this).find('.feedback_name').val() != "") && (jQuery(this).find('.feedback_email').val() != "") && (jQuery(this).find('.feedback_text').val() != "") )
		return true;

		serialized = jQuery(this).serialize();

		jQuery('.fpSaving').center('#fpForm');

		jQuery.ajax({
			type: 'POST',
			url: 'options.php',
			data: serialized,

			beforeSend: function(){
				jQuery('.fpSaving').find('.message').text('Saving ...');
				jQuery('.fpSaving').find('.image').removeClass('image-saved').removeClass('image-error').addClass('image-saving');
				jQuery('.fpSaving').fadeIn('fast');
			},

			success: function(data){
				jQuery('.fpSaving').find('.message').text('Saved!');
				jQuery('.fpSaving').find('.image').removeClass('image-saving').removeClass('image-error').addClass('image-saved');
				jQuery('.fpSaving').show().delay(800).fadeOut('slow');
			},

			error: function(data){
				jQuery('.fpSaving').find('.message').text('Error!');
				jQuery('.fpSaving').find('.image').removeClass('image-saved').removeClass('image-saving').addClass('image-error');
				jQuery('.fpSaving').show().delay(800).fadeOut('slow');
			}

		});
    	    return false;
	});
});



/* -----------------------------
*  Template setup save
* --------------------------- */
jQuery(function() {
	jQuery( ".sections-list-active" ).sortable({
		connectWith: ".connectedSortable",
		placeholder: "placeholder",
		cancel: '.section-required',
		update: function() {
			var serialized = jQuery(this).sortable("serialize"); 
			var template = jQuery(this).parent().parent().find('.section-name').attr('title');

			fpSubmitTemplateSetup(serialized, template)
		} 		
	}).disableSelection();

	jQuery( ".sections-list-available" ).sortable({
		connectWith: ".connectedSortable",
		placeholder: "placeholder"
		
	}).disableSelection();
});

function fpSubmitTemplateSetup(serialized, templatem) {
	jQuery('.fpSaving').center('#fpForm');

	var data = {
		action: 'framework_save_template',
		order: serialized,
		template: templatem,
		field: 'sections'
	};

	jQuery.ajax({
		type: 'GET',
		url: ajaxurl,
		data: data,

	beforeSend: function(){
			jQuery('.fpSaving').find('.message').text('Saving ...');
			jQuery('.fpSaving').find('.image').removeClass('image-saved').removeClass('image-error').addClass('image-saving');
			jQuery('.fpSaving').fadeIn('fast');
		},

		success: function(data){
			jQuery('.fpSaving').find('.message').text('Saved!');
			jQuery('.fpSaving').find('.image').removeClass('image-saving').removeClass('image-error').addClass('image-saved');
			jQuery('.fpSaving').show().delay(800).fadeOut('slow');
		},

		error: function(data){
			jQuery('.fpSaving').find('.message').text('Error!');
			jQuery('.fpSaving').find('.image').removeClass('image-saved').removeClass('image-saving').addClass('image-error');
			jQuery('.fpSaving').show().delay(800).fadeOut('slow');
		}
	});
}


/* -----------------------------
*  Autosave form
* --------------------------- */
jQuery(function() {
	jQuery("#fpBody input").change( function() {
		if(!jQuery(this).hasClass('noautosave')) {
			fpSubmitForm();
		}
	});

	jQuery("#fpBody textarea").change( function() {
		if(!jQuery(this).hasClass('noautosave')) {
			fpSubmitForm();
		}
	});

	jQuery("#fpBody select").change( function() {
		if(!jQuery(this).hasClass('noautosave')) {
			fpSubmitForm();
		}
	});
});


/* -----------------------------
*  Hide color pickers
* --------------------------- */
jQuery(function(){var color_scheme=jQuery(".design-control #color_scheme");var color_scheme_val=color_scheme.val();if(color_scheme_val!='custom'){jQuery(".design-control .fpOption").not(":eq(0)").hide()}jQuery(color_scheme).change(function(){if(jQuery(".design-control #color_scheme").val()=='custom'){jQuery(".design-control .fpOption").show()}else{jQuery(".design-control .fpOption").not(":eq(0)").hide()}})});