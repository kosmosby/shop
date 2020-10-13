/**
 * @author MorbiPlay.com <support@morbiplay.com>
 * @link http://morbiplay.com/
 */


$(document).ready(function() {
	function initTips() {
		$('[data-toggle="popover"]').popover({
			container: 'body'
		});

		$('body').on('click', function (e) {
			$('[data-toggle="popover"]').each(function () {
				//the 'is' for buttons that trigger popups
				//the 'has' for icons within a button that triggers a popup
				if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
					$(this).popover('hide');
				}
			});
		});

		$('[data-toggle="tooltip"]').tooltip();
	}

	initTips();

	// add new slider
	$('.revoslider-add-tab').click(function(e) {
		e.preventDefault();

		if($(this).hasClass("already-clicked")) return;
		$(this).addClass("already-clicked");

		var group_id = $(".opened-group").closest(".sliders_group").attr("data-slider_group_id");

		$.post( "?plugin=revolutionslider&action=createslider", { group_id: group_id }, function(response) {
			$(".already-clicked").removeClass("already-clicked");
			
			if (response.status == 'ok') {
				window.location.replace("?plugin=revolutionslider&slider="+response.data.slider_id);
			} else {
				new jBox('Notice', {
					content: _str_error + ": " + response.errors,
					color: 'red',
					addClass: 'revo-notice',
					position: {x: 'left', y: 'top'},
					offset: {x: 15, y: -15}
				});
			}

		});
	});


	$('.clone-slider').live('click', function(e) {
		e.preventDefault();

		if($(this).hasClass("already-clicked")) return;
		$(this).addClass("already-clicked");

		var slider_id = $(this).closest(".slider-options").data("slider_id");
		if(slider_id == null) return;

		var group_id = $(".opened-group").closest(".sliders_group").attr("data-slider_group_id");

		var clone = $(this).closest('.slider-block').clone();

		$.post( "?plugin=revolutionslider&action=cloneslider", { slider_id: slider_id, group_id: group_id }, function(response) {
			$(".already-clicked").removeClass("already-clicked");

			if (response.status == 'ok') {
				var new_id = response.data.slider_id;

				$(clone).find(".slider-options").data("slider_id", new_id);
				$(clone).find(".link").attr("href", "?plugin=revolutionslider&slider=" + new_id);

				var code = $(clone).find(".templcode-slider span").attr("data-content");

				code = code.replace("display("+slider_id+")", "display("+new_id+")");
				code = code.replace("generalDisplay("+slider_id+")", "generalDisplay("+new_id+")");

				$(clone).find(".templcode-slider span").attr("data-content", code);

				$(clone).insertBefore( $(".opened-group").find(".add-new-slider") ).hide().fadeIn();
                // $(clone).appendTo().fadeIn();

				$(clone).find(".delete-slider").show();
				$(clone).find(".edit-slider").show();
				$(clone).find(".templcode-slider").show();

				$(clone).find(".tooltip").remove();

				initTips();

			} else {
				new jBox('Notice', {
					content: _str_error + ": " + response.errors,
					color: 'red',
					addClass: 'revo-notice',
					position: {x: 'left', y: 'top'},
					offset: {x: 15, y: -15}
				});
			}
		});
	});


	$('.delete-slider').live('click', function(e) {
		e.preventDefault();

		if($(this).hasClass("already-clicked")) return;
		$(this).addClass("already-clicked");

		if(confirm(_str_delete_slider)) {
			var slider_id = $(this).closest(".slider-options").data("slider_id");
			if(slider_id == null) return;

			var slider_block = $(this).closest('.slider-block');

			$.post( "?plugin=revolutionslider&action=deleteslider", { slider_id: slider_id }, function(response) {
				$(".already-clicked").removeClass("already-clicked");

				if (response.status == 'ok') {
					$(slider_block).fadeOut(400, function(){
						$(this).remove();
					});

				} else {
					new jBox('Notice', {
						content: _str_error + ": " + response.errors,
						color: 'red',
						addClass: 'revo-notice',
						position: {x: 'left', y: 'top'},
						offset: {x: 15, y: -15}
					});
				}
			});
		}
	});


	$('.sliderpreview').live('click', function(e) {
		e.preventDefault();

		if($(this).hasClass("already-clicked")) return;
		$(this).addClass("already-clicked");

		var slider_id = $(this).closest(".slider-options").data("slider_id");
		if(slider_id == null) return;


		$.post( "?plugin=revolutionslider&action=sliderpreview", { slider_id: slider_id }, function(response) {
			$(".already-clicked").removeClass("already-clicked");

			if (response.status == 'ok') {

				$('.slider-preview-main').show();
				$('#myModal').html(response.data.html);

			} else {
				new jBox('Notice', {
					content: _str_error + ": " + response.errors,
					color: 'red',
					addClass: 'revo-notice',
					position: {x: 'left', y: 'top'},
					offset: {x: 15, y: -15}
				});
			}
		});
	});


	$('.close-preview').live('click', function(e) {
		$(".already-clicked").removeClass("already-clicked");
		$('.slider-preview-main').hide();
		$('.slider-preview-main .container').html('<div class="col-lg-12"><div id="myModal"></div></div>');
	});



	// open group
	$('.show-folder').live('click', function(e) {
		$("#sliders_filter").val("");
		$(this).hide();
		$(".add-new-folder").hide();
		$(this).parent().find('.back-to-root').show();

		$(this).closest('.sliders_groups').find('.sliders_group').not($(this).parent()).hide();
		$(this).closest('.sliders_groups').find('.all-sliders').removeClass("opened-group");

		var sliders_group = $(this).closest('.sliders_group');
		$(sliders_group).find('.all-sliders').fadeIn();
		$(sliders_group).find('.all-sliders').addClass("opened-group");
	});


	// close group
	$('.back-to-root').live('click', function(e) {
		$("#sliders_filter").val("");
		filterSliders("");
		$(this).hide();
		$(".add-new-folder").show();
		$('.show-folder').show();

		var sliders_groups = $(this).closest('.sliders_groups');
		$(sliders_groups).find('.all-sliders').hide();
		$(sliders_groups).find('.all-sliders').removeClass("opened-group");
		$(sliders_groups).find('.sliders_group').fadeIn();

		var not_grouped = $(sliders_groups).find('.not-grouped-sliders');
		$(not_grouped).fadeIn();
		$(not_grouped).find('.all-sliders').addClass("opened-group").fadeIn();
	});


	$('.add-new-folder').live('click', function(e) {
		e.preventDefault();

		if($(this).hasClass("already-clicked")) return;
		$(this).addClass("already-clicked");

		$.post( "?plugin=revolutionslider&action=creategroup", null, function(response) {
			$(".already-clicked").removeClass("already-clicked");

			if (response.status == 'ok') {
				var new_group = $("#new_slider_group").find(".sliders_group").clone();

				new_group.attr("data-slider_group_id", response.data.group_id);

				$(new_group).prependTo($(".sliders_groups")).hide().fadeIn();

				initEditable();

			} else {
				new jBox('Notice', {
					content: _str_error + ": " + response.errors,
					color: 'red',
					addClass: 'revo-notice',
					position: {x: 'left', y: 'top'},
					offset: {x: 15, y: -15}
				});
			}

		});
	});


	function initEditable() {
		$('.group-title').editable('?plugin=revolutionslider&action=renamegroup', {
			name : 'newgroupname',
			submitdata : function(value, settings) {
				var group_id = $(this).closest(".sliders_group").attr("data-slider_group_id");
				return { group_id: group_id };
			},
			indicator : _str_saving,
			tooltip   : _str_click_to_edit
		});

		$('.group-title').live('click', function(e) {
			e.preventDefault();
			e.stopPropagation();
		});
	}

	initEditable();


	$('.delete-folder').live('click', function(e) {
		e.preventDefault();
		e.stopPropagation();

		if($(this).hasClass("already-clicked")) return;
		$(this).addClass("already-clicked");

		if(confirm(_str_delete_folder)) {
			var del_el = $(this).closest(".show-folder");
			var sliders_group = $(this).closest(".sliders_group");

			var group_id = sliders_group.attr("data-slider_group_id");
			if(group_id == null) return;

			$.post( "?plugin=revolutionslider&action=deletegroup", { group_id: group_id }, function(response) {
				$(".already-clicked").removeClass("already-clicked");

				if (response.status == 'ok') {
					$( $(sliders_group).find(".slider-block") ).insertBefore( $(".not-grouped-sliders .all-sliders").find(".add-new-slider") ).hide().fadeIn();

					$(sliders_group).fadeOut(400, function(){
						$(del_el).remove();
					});

				} else {
					new jBox('Notice', {
						content: _str_error + ": " + response.errors,
						color: 'red',
						addClass: 'revo-notice',
						position: {x: 'left', y: 'top'},
						offset: {x: 15, y: -15}
					});
				}
			});
		}
	});


	$("#sliders_filter").live('input', function() {
		var val = $(this).val().toLowerCase();
		filterSliders(val);
	});


	function filterSliders(val) {
		if(val.length > 0) {
			$(".show-folder").hide();
			$(".sliders_groups .all-sliders").show();
			if(!$(".back-to-root").is(":visible")) $(".add-new-in-group").hide();

			$(".slider-title").each(function () {
				if ($(this).html().toLowerCase().search(val) > -1) {
					$(this).closest(".slider-block").show();
				} else {
					$(this).closest(".slider-block").hide();
				}
			});

		} else {
			if(!$(".back-to-root").is(":visible")) $(".show-folder").show();
			$(".sliders_groups .all-sliders").hide();
			$(".opened-group").show();
			$(".add-new-in-group").show();

			$(".slider-title").closest(".slider-block").show();
		}
	}


	$('.shortcode, .site-shortcode').live('click', function(e) {
		e.preventDefault();
		e.stopPropagation();

		var code = $(this).html();
		code = code.replace(/&nbsp;/g, "").replace(/<br\s*\/?>/mg, "");
		code = code.replace("&nbsp;", "").replace("<br>", "").replace("</b>","");
		code = code.replace("  ", " ");

		var text = $('<input id="copy_clipboard" style="margin: -999px;" type="text" value="' + code + '">');

		$(text).appendTo('body');

		$("#copy_clipboard").select();

		if(document.execCommand('copy')) {
			var copied_mess = $('<div id="copied_mess" style="position: absolute; margin-top: -22px; display: none; margin-left: 15px; background: #68bf68; color: white; width: 90%; padding: 1px 10px;">'+_str_copied_to_clipboard+'</div>');
			$(copied_mess).appendTo( $(this).closest('.popover-content') );
			$("#copied_mess").fadeIn(400, function() { setTimeout(function(){ $("#copied_mess").fadeOut(1000, function() { $(this).remove(); }); }, 1000); });
		}

		$("#copy_clipboard").remove();
	});
});