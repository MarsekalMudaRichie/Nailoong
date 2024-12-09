/**
 * admin.js
 *
 * Admin / Dashboard JavaScript functions
 *
 * 1. Gallery Post Format Media Uploader - Repeatable Images
 * 2. Change Font To Google Font On Select Change
 * 3. Show And Hide Additional Metaboxes Used By Post Formats
 */
jQuery(document).ready(function(){
	/**
	 * -----------------------------------------------------------
	 * 1. GALLERY POST FORMAT MEDIA UPLOADER - REPEATABLE IMAGES
	 * -----------------------------------------------------------
	 */
	var custom_uploader;

	jQuery('.st_upload_button').click(function(e) {

		var button_clicked = jQuery(this).prev().attr('name');

		// Extend the wp.media object
		custom_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Upload',
			button: {
				text: 'Upload'
			},
			multiple: false
		});

		// When a file is selected, grab the URL and set it as the text field's value
		custom_uploader.on('select', function() {
			attachment = custom_uploader.state().get('selection').first().toJSON();

			jQuery('[name="'+ button_clicked +'"]').val(attachment.url);
		});

		// Open the uploader dialog
		custom_uploader.open();
	});


	var n = jQuery('.custom_repeatable li').length;
	if(n>1) { jQuery('.custom_repeatable li .repeatable-remove').attr('style', 'display:inline');}

	jQuery('.repeatable-add').click(function() {

		field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
		fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
		jQuery('.upload-url', field).val('').attr('name', function(index, name) {
			return name.replace(/(\d+)/, function(fullMatch, n) {
				return Number(n) + 1;
			});
		});

		field.insertAfter(fieldLocation, jQuery(this).closest('td'));
		var n = jQuery('.custom_repeatable li').length;
		if(n>1) { jQuery('.custom_repeatable li .repeatable-remove').attr('style', 'display:inline');}

		return false;
	});

	// Remove one image from repeatable
	var relval = '';
	jQuery('.repeatable-remove').click(function(){

		jQuery(this).parent().remove();
		relval = jQuery(this).attr('rel');
		var n = jQuery('.custom_repeatable li').length;
		if(n=='1') { jQuery('.custom_repeatable li:first-child .repeatable-remove').attr('style', 'display:none');}
		return false;

	});

	// Enable draging and reordering repeatable images for gallery post format
	jQuery('.custom_repeatable').sortable({
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.sort'
	});


	/**
	 * ---------------------------------------------------------------
	 * 2. CHANGE FONT TO GOOGLE FONT ON SELECT CHANGE
	 * ---------------------------------------------------------------
	 */
	jQuery('select.gf').change(function() {
		var val = jQuery(this).val();
		val.replace('spooner_font_', '');
	});


	/**
	 * ---------------------------------------------------------------
	 * 3. SHOW AND HIDE ADDITIONAL METABOXES USED BY POST FORMATS
	 * ---------------------------------------------------------------
	 */
	var quote_meta = jQuery('#post_format_quote');
	var quote_radio = jQuery('#post-format-quote');
	quote_meta.css('display', 'none');


	var image_meta = jQuery('#postimagediv');
	var image_radio = jQuery('#post-format-image');

	var standard_meta = jQuery('#postimagediv');
	var standard_radio = jQuery('#post-format-0');

	var link_meta = jQuery('#post_format_link');
	var link_radio = jQuery('#post-format-link');
	link_meta.css('display', 'none');

	var audio_meta = jQuery('#post_format_audio');
	var audio_radio = jQuery('#post-format-audio');
	audio_meta.css('display', 'none');

	var gallery_meta = jQuery('#post_format_gallery');
	var gallery_radio = jQuery('#post-format-gallery');
	gallery_meta.css('display', 'none');

	var video_meta_show = jQuery('#postimagediv');
	var video_meta = jQuery('#post_format_video');
	var video_radio = jQuery('#post-format-video');
	video_meta.css('display', 'none');

	jQuery('#menu_sections_box_meta').hide();
	//jQuery('#sidebar_position_meta').hide();


	var page_template_select = jQuery('#page_template');
	//var templates_array = new Array('tk-templates/template-menu.php');
	var sidebar_array = new Array('templates/template-events.php', 'templates/template-albums.php', 'templates/template-front.php', 'templates/template-gallery.php');

	//Hide sidebar meta box on load if certain template selected
	var template_load = page_template_select.val();
	if(sidebar_array.indexOf(template_load) != -1){
		jQuery('#sidebar_position_meta').hide();
	}
	else {
		jQuery('#sidebar_position_meta').show();
	}


	//Hide sidebar metabox for certain template selected
	page_template_select.change(function(){
		var template = jQuery(this).val();

		if(sidebar_array.indexOf(template) != -1){
			jQuery('#sidebar_position_meta').hide();
		}
		else {
			jQuery('#sidebar_position_meta').show();
		}

	});

	jQuery(document).on('change', 'select[id*="post-format"]', function() {
        if(this.value == 'quote') {
            quote_meta.css('display', 'block');
            hide_metabox(quote_meta);

        } else if(this.value == '0') {
            standard_meta.css('display', 'block');
            hide_metabox(standard_meta);

        } else if(this.value == 'gallery') {
            gallery_meta.css('display', 'block');
            hide_metabox(gallery_meta);

        } else if(this.value == 'link') {
            link_meta.css('display', 'block');
            hide_metabox(link_meta);

        } else if(this.value == 'audio') {
            audio_meta.css('display', 'block');
            hide_metabox(audio_meta);

        } else if(this.value == 'video') {
            video_meta.css('display', 'block');
            hide_metabox(video_meta);
            video_meta_show.css('display', 'block');

        } else if(this.value == 'image') {
            image_meta.css('display', 'block');
            hide_metabox(image_meta);

        } else {
            quote_meta.css('display', 'none');
            video_meta.css('display', 'none');
            link_meta.css('display', 'none');
            audio_meta.css('display', 'none');
        }
    });

	setTimeout(function(){
        var postFormatSelect = jQuery('select[id*="post-format"]').val();

        if(postFormatSelect == 'gallery')
            gallery_meta.css('display', 'block');

        if(postFormatSelect == 'quote')
            quote_meta.css('display', 'block');

        if(postFormatSelect == 'link')
            link_meta.css('display', 'block');

        if(postFormatSelect == 'audio')
            audio_meta.css('display', 'block');

        if(postFormatSelect == 'video')
            video_meta.css('display', 'block');

        if(postFormatSelect == 'image')
            image_meta.css('display', 'block');
    }, 2000);

	function hide_metabox(current) {
		video_meta.css('display', 'none');
		quote_meta.css('display', 'none');
		link_meta.css('display', 'none');
		audio_meta.css('display', 'none');
		gallery_meta.css('display', 'none');
		current.css('display', 'block');
	}

	var post_type = jQuery('#post_type').val();
	if(post_type == 'post') {
		jQuery('#post-format-aside').css('display', 'none');
		jQuery('#post-format-aside').next().css('display', 'none');
		jQuery('#post-format-aside').next().next().css('display', 'none');
	}

});
