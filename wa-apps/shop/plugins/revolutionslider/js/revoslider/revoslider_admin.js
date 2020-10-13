/**
 * @author MorbiPlay.com <support@morbiplay.com>
 * @link http://morbiplay.com/
 */


var uploadInput;
var revoslider = {
	
	g : {
		dragContainer : null
	},
	
	init : function() {
		
		// Bind an event to add new slide
		$('.revoslider_add_slide').live('click', function(e) {
			e.preventDefault();
			revoslider.addSlide(this);
			revoslider.updateAfterAdd();
		});
		
		// Bind add sublayer button event
		$('.dropdown-menu li a').live('click', function(e) {
			e.preventDefault();
            $(this).parent().parent().parent().removeClass('open');
			revoslider.addSublayer(this);
            assign_fileupload();
			return false;
		});

		// Bind upload button to show media uploader
		$('.revo_upload_input').live('click', function() {
			uploadInput = this;
			$('.draggable iframe, .draggable embed, .draggable object').hide();
			//tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true&width=650&height=400');
			return false;
		});


		$('.slide-preview, .globalpreview').live('click', function(e) {
			e.preventDefault();
			$('.tooltip').remove();
			if($(this).hasClass("already-clicked")) return;
			$(this).addClass("already-clicked");

			$('.slider-preview').remove();

			var slider_id = $("#slider_id").val();
			if (slider_id == null) return;

			var slide_num = "";
			if ($(this).hasClass("slide-preview")) {
				slide_num = $(this).closest(".revoslider_slides").index() + 1;
			}

            $.post( "?plugin=revolutionslider&action=sliderpreview", { slider_id: slider_id, slide_num: slide_num }, function(response) {
                if (response.status == 'ok') {

                    var preview_box = '<div class="slider-preview" style="display: none;">'
                        +'<span class="close-preview"><a href="javascript:void(0);" class="close-link"><i class="icon-close" aria-hidden="true"></i></a></span>'
                        +'<div class="container">'
                        +'<div class="col-lg-12">'
                        +'<div id="myModal"></div>'
                        +'</div>'
                        +'</div>'
                        +'</div>';

                    $("body").append(preview_box);

					$('.slider-preview').show();
                    $('#myModal').html(response.data.html);

                } else {
                    new jBox('Notice', {
                        content: _str_error + ": " + response.errors,
                        color: 'red',
                        addClass: 'revo-notice',
                        position: {x: 'left', y: 'bottom'},
						offset: {x: 15, y: -15}
                    });
                }
				$(".already-clicked").removeClass("already-clicked");
            });
		});

        $('.close-preview').live('click', function(e) {
			$(".already-clicked").removeClass("already-clicked");
            $('.slider-preview').remove();
        });



		// $('.open-sublayer').live('click', function(e) {
		// 	toggleSublayer(this);
		// });

		// function toggleSublayer(me) {
		// 	var e = me;
		// 	if($(me).hasClass("sublayer")) {
		// 		e = $(me).find("open-sublayer");
		// 	}
        //
		// 	var ehtml = $(e).parent().parent().find(".html");
        //
		// 	if($(e).hasClass('active')) {
		// 		$(e).html("+");
		// 		$(e).removeClass("active");
		// 		$(ehtml).stop().hide();
		// 	} else {
		// 		$(ehtml).closest(".sublayers").find(".html").removeClass("active").hide();
		// 		$(ehtml).closest(".sublayers").find(".open-sublayer").html("+");
		// 		$(e).html("-");
		// 		$(e).addClass("active");
		// 		$(ehtml).stop().show();
		// 	}
		// }

		// function closeSublayers(me) {
		// 	$.each($(me).closest(".sublayers").find(".open-sublayer"), function () {
		// 		var ehtml = $(this).parent().parent().find(".html");
        //
		// 		if ($(this).hasClass('active')) {
		// 			$(this).html("+");
		// 			$(this).removeClass("active");
		// 			$(ehtml).stop().hide();
		// 		}
		// 	});
		// }


		// clone sublayer
		$('.clone-sublayer').live('click', function(e) {
			e.preventDefault();
			var eleme = $(this).closest(".sublayer");
			$('.tooltip').remove();
			var clone = $(eleme).clone();

			$(clone).insertAfter(eleme).hide().slideDown();
			revoslider.updatePreview(this);
			revoslider.updateAfterAdd();
			$(".sublayer-selected").removeClass("sublayer-selected");
		});


		$('.remove-sublayer').live('click', function(e) {
			e.preventDefault();
			if(confirm(_str_delete_layer)) {
				// $(this).closest('.revoslider_slides').find('.draggable *').eq($(this).closest(".sublayer").index()).remove();
				$(this).closest('.revoslider_slides').find('.draggable').children().eq($(this).closest(".sublayer").index()).remove();
				$(this).parent().parent().remove();
			}
		});


		// clone layer
		$('.duplicate-slide').live('click', function(e) {
			e.preventDefault();
			var clone = $(this).closest('.revoslider_slides').clone();

			$(clone).insertAfter($(this).closest('.revoslider_slides')).hide().slideDown();

			$('html,body').animate({ scrollTop: $(clone).offset().top-60}, 1500);

			// $.fn.bootstrapSwitch.defaults.size = 'mini';
			// $(clone).find('.bootstrap-switch').replaceWith( '<input class="js-switch" type="checkbox" name="testswitch" value="1" checked="checked">' );
			// $(clone).find('.js-switch').bootstrapSwitch();
			// $('.js-switch').bootstrapSwitch();

			revoslider.updateAfterAdd();
		});


		$('.delete-slide').live('click', function(e) {
			e.preventDefault();
			if(confirm(_str_delete_layer)) {
				$(this).closest('.revoslider_slides').remove();
			}
		});


		$('#revoslider_form').bind('submit',function(e){e.preventDefault();});

		// Bind submit event
		// $('#revoslider_form').submit(function(e) {
		$('.globalsave').live('click', function(e) {
			e.preventDefault();

			if($(this).hasClass("saving")) return;

			$(this).addClass("saving");
			revoslider.submit(this);
		});


		revoslider.addSortables();


		// Global
		$('input[name="globalthumbimagefull"]').live('input', function() {
			var val = $(this).val();

			$(this).parent().parent().find('.imgplaceholder').attr("src", val);
			$(this).parent().parent().find('.thumbImage').val(val);
		});

		$('input[name="background"]').live('input', function() {
			$(this).closest(".revoslider_slides").find(".draggable").css("background-image", "url("+$(this).val()+")");
		});

		$('.remove-bg').live('click', function(e) {
			e.preventDefault();
			$(this).closest(".revoslider_slides").find(".draggable").css("background-image", "");
			$(this).parent().find('input[name="background"]').val("");
		});

		$('select[name="globalparallaxtype"]').live('change', function() {
			var val = $(this).val();

			if(val == '3d') {
				$(".dddsettings").slideDown();
			} else {
				$(".dddsettings").slideUp();
			}
		});


		$('input[name="bgcolor"]').live('input', function() {
			var val = $(this).val();
			var sl = $(this).closest(".revoslider_slides").find(".draggable");
			$(sl).css("background-color", val);
		});

		$('input[name="rslideslotamount"]').live('input', function() {
			var val = $(this).val();
			var sl = $(this).closest(".revoslider_slides").find(".draggable");
			$(sl).css("color", val);
		});

		$('select[name="bgrepeat"]').live('input', function() {
			var val = $(this).val();
			var sl = $(this).closest(".revoslider_slides").find(".draggable");
			$(sl).css("background-repeat", val);
		});

		$('select[name="bgfit"]').live('input', function() {
			var val = $(this).val();
			var sl = $(this).closest(".revoslider_slides").find(".draggable");
			$(sl).css("background-size", val);
		});

		$('select[name="bgposition"]').live('input', function() {
			var val = $(this).val();
			var sl = $(this).closest(".revoslider_slides").find(".draggable");
			$(sl).css("background-position", val);
		});


		// Sublayers
		$('input[name="name"]').live('input', function() {
			$(this).closest(".sublayer").find('input[name="name"]').val( $(this).val() );
		});

		$('input[name="delayin"]').live('input', function() {
			$(this).closest(".sublayer").find('input[name="delayin"]').val( $(this).val() );
		});

		$('input[name="delayout"]').live('input', function() {
			$(this).closest(".sublayer").find('input[name="delayout"]').val( $(this).val() );
		});

		$('input[name="top"]').live('input', function() {
			$(this).closest(".sublayer").find('input[name="top"]').val( $(this).val() );
		});

		$('input[name="left"]').live('input', function() {
			$(this).closest(".sublayer").find('input[name="left"]').val( $(this).val() );
		});

		$('input[name="top"],input[name="left"]').live('input', function() {
			var val = $(this).val();

			var index = $(this).closest('.sublayer').index(); // -1
			var container = $(this).closest('.revoslider_slides').find('.draggable');
			var sl = container.children().eq(index);

			if(val.indexOf('px') == -1 && val.indexOf('%') == -1) {
				val = val + 'px';
			}

			if($(this).attr('name') == 'top') {
				if( val.indexOf('%') != -1 ){
					sl.css({
						top : container.height() / 100 * parseInt(val) - sl.outerHeight() / 2
					});
				} else {
					container.children().eq(index).css('top', val);
				}
			} else {
				if( val.indexOf('%') != -1 ){
					sl.css({
						left : container.width() / 100 * parseInt(val) - sl.outerWidth() / 2
					});
				} else {
					container.children().eq(index).css('left', val);
				}
			}
		});


		/*text*/
		$('input[name="rsLayerHtml"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).html(val);
		});


		$('select[name="htmltype"]').live('change', function() {
			var val = $(this).val();
			var sl = getElem(this);

			var attrs = { };

			$.each($(sl)[0].attributes, function(idx, attr) {
				attrs[attr.nodeName] = attr.nodeValue;
			});

			$(sl).replaceWith(function () {
				return $("<" + val + " />", attrs).append($(this).contents());
			});
			revoslider.addDrag();
		});


		$('input[name="rsLayerStyleTxtColor"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("color", val);
		});

		$('input[name="rsLayerStyleTxtfontsize"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("font-size", val+"px");
		});


		$('input[name="rsLayerStyleTxtlineheight"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("line-height", val+"px");
		});


		$('select[name="rsLayerStyleTxtWeight"]').live('change', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("font-weight", val);
		});


		$('select[name="rsLayerStyleTxtDecoration"]').live('change', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("text-decoration", val);
		});


		$('select[name="rsLayerStyleTxtAlign"]').live('change', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("text-align", val);
		});

		$('input[name="rsLayerStyleTxtFontfamily"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("font-family", "'"+val+"'");
		});

		$('input[name="rsLayerStyleWidth"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("width", val+"px");
		});

		$('input[name="rsLayerStylehHeight"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("height", val+"px");
		});


		/*background*/

		$('input[name="rsLayerStyleBackgroundColor"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("background-color", val);
		});

		$('input[name="rsLayerStyleBackgroundPaddingTop"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("padding-top", val+"px");
		});

		$('input[name="rsLayerStyleBackgroundPaddingRight"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("padding-right", val+"px");
		});

		$('input[name="rsLayerStyleBackgroundPaddingBottom"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("padding-bottom", val+"px");
		});

		$('input[name="rsLayerStyleBackgroundPaddingLeft"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("padding-left", val+"px");
		});

		/*transformation*/

		$('input[name="rsLayerOpacityIdle"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("opacity", val);
		});


		$('input[name="rsLayerTransformIdleScaleX"], input[name="rsLayerTransformIdleScaleY"], input[name="rsLayerTransformIdleSkewX"], input[name="rsLayerTransformIdleSkewY"], input[name="rsLayerTransformIdleRotateX"], input[name="rsLayerTransformIdleRotateY"], input[name="rsLayerTransformIdleRotateZ"]').live('input', function() {
			var scaleX = $(this).closest('.tab-content').find('input[name="rsLayerTransformIdleScaleX"]').val();
			var scaleY = $(this).closest('.tab-content').find('input[name="rsLayerTransformIdleScaleY"]').val();
			var skewX = $(this).closest('.tab-content').find('input[name="rsLayerTransformIdleSkewX"]').val();
			var skewY = $(this).closest('.tab-content').find('input[name="rsLayerTransformIdleSkewY"]').val();
			var rotateX = $(this).closest('.tab-content').find('input[name="rsLayerTransformIdleRotateX"]').val();
			var rotateY = $(this).closest('.tab-content').find('input[name="rsLayerTransformIdleRotateY"]').val();
			var rotateZ = $(this).closest('.tab-content').find('input[name="rsLayerTransformIdleRotateZ"]').val();

			var trans = "scaleX("+scaleX+") scaleY("+scaleY+") skewX("+skewX+"deg) skewY("+skewY+"deg) rotateX("+rotateX+"deg) rotateY("+rotateY+"deg) rotateZ("+rotateZ+"deg)";

			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css({
				'-webkit-transform' : trans,
				'-moz-transform'    : trans,
				'-ms-transform'     : trans,
				'-o-transform'      : trans,
				'transform'         : trans
			});
		});


		/*border*/

		$('input[name="rsLayerStyleBorderColor"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("border-color", val);
		});

		$('select[name="rsLayerStyleBorderStyle"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("border-style", val);
		});

		$('input[name="rsLayerStyleBorderSize"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("border-width", val+"px");
		});

		$('input[name="rsLayerStyleBorderTopLeftRadius"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("border-top-left-radius", val+"px");
		});

		$('input[name="rsLayerStyleBorderTopRightRadius"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("border-top-right-radius", val+"px");
		});

		$('input[name="rsLayerStyleBorderBottomRightRadius"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("border-bottom-right-radius", val+"px");
		});

		$('input[name="rsLayerStyleBorderBottomLeftRadius"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("border-bottom-left-radius", val+"px");
		});

		$('input[name="image"]').live('input', function() {
			var val = $(this).val();

			$(this).parent().parent().find('.imgplaceholder').attr("src", val);
			$(this).parent().parent().find('.thumbImage').val(val);

			var sl = getElem(this);
			$(sl).attr("src", val);
		});

		$('input[name="globalname"]').live('input', function() {
			var val = $(this).val();

			$(this).closest(".revoslider_tabs").find(".title-val").html(val);
		});


		/* tululutip*/
		$('input[name="rsLayerHtmlTiptitle"]').live('input', function() {
			var val = $(this).val();

			var sl = getElem(this);
			$(sl).find(".rstooltip-title").html(val);
		});

		$('input[name="rsLayerHtmlTipdescription"]').live('input', function() {
			var val = $(this).val();

			var sl = getElem(this);
			$(sl).find(".rstooltip-description").html(val);
		});

		$('input[name="rsLayerTipDescriptionBgColor"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).find(".rstooltip").css("background-color", val);
			$(sl).find(".rstooltip-arrow").css("border-top-color", val);
		});

		$('input[name="rsLayerTipBgColor"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("background-color", val);
		});

		$('input[name="rsLayerTipSize"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css({"width" : val+"px", "height" : val+"px",});
		});

		$('input[name="rsLayerTipBorderColor"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("border-color", val);
		});

		$('input[name="rsLayerTipBorderSize"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).css("border-width", val+"px");
		});

		$('input[name="rsLayerTipDescriptionSize"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).find(".rstooltip").css("width", val+"px");
		});

		$('input[name="rsLayerTipTitleColor"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).find(".rstooltip-title").css("color", val);
		});

		$('input[name="rsLayerTipDescriptionColor"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).find(".rstooltip-description").css("color", val);
		});



		$('input[name="rsLayerTipDescriptionLeftOffset"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).find(".rstooltip").css("left", val+"px");
		});

		$('input[name="rsLayerTipDescriptionTopOffset"]').live('input', function() {
			var val = $(this).val();
			var sl = getElem(this);
			$(sl).find(".rstooltip").css("top", val+"px");
		});



		$('.showtipdescription').live('click', function() {
			var sl = getElem(this);
			if($(this).is(":checkbox") && $(this).is(':checked')) {
				$(sl).addClass("tipactive");
			} else {
				$(sl).removeClass("tipactive");
			}
		});


		function getElem(i) {
			var index = $(i).closest('.sublayer').index(); // -1
			var container = $(i).closest('.revoslider_slides').find('.draggable');
			return container.children().eq(index);
		}


		$('.ui-draggable').live('click', function() {
			// $('.sublayers .sublayer-selected').trigger('detach.ScrollToFixed');

			// $(this).siblings().removeClass("sublayer-selected");
			$(".sublayer-selected").removeClass("sublayer-selected");
			// $(this).addClass("sublayer-selected");

			if($(this).hasClass("rstooltipwrapper") || $(this).is("img")) {
				$(this).addClass("sublayer-selected");
			} else {
				revoslider.addResize($(this));
				if ($(this).parent().hasClass("ui-wrapper")) {
					$(this).parent().addClass("sublayer-selected");
					$(this).draggable('destroy');
					revoslider.addDrag();
				} else {
					$(this).addClass("sublayer-selected");
				}
			}

			var ind = $(".sublayer-selected").index();
			var sublayer = $(this).closest('.revoslider_slides').find('.sublayer:eq('+ind+')');


			if(!$(this).hasClass("rstooltipwrapper") && $(this).parent().hasClass("ui-wrapper")) {
				$(this).parent().zIndex(ind+1);
			}


			// $(sublayer).siblings().removeClass("sublayer-selected");
			$(sublayer).addClass("sublayer-selected");

			// fixed_sublayer();
			// $(this).siblings().trigger('detach.ScrollToFixed');

			var sublayer_selected = $('.sublayers .sublayer-selected');

			// var top = 0;
			// if(sublayer_selected.offset() != undefined) {
			// 	top = sublayer_selected.offset().top;
			// }

			// sublayer_selected.scrollToFixed( { bottom: 0, limit: top } );
			// closeSublayers(sublayer);
		});


		$('.hide-sublayer').live('click', function() {
			var i = $(this).closest(".sublayer").index();
			var slide = $(this).closest('.revoslider_slides').find('.ui-draggable:eq('+i+')');

			if($(this).hasClass("icon-eye")) {
				$(this).removeClass("icon-eye");
				$(this).addClass("icon-eye-off");
				slide.hide();

			} else {
				$(this).removeClass("icon-eye-off");
				$(this).addClass("icon-eye");
				slide.show();
			}
		});


		$('.close-editor').live('click', function(e) {
			e.preventDefault();
			e.stopPropagation();
			$('.ui-draggable').removeClass("sublayer-selected");
			$('.sublayer').removeClass("sublayer-selected");
		});


		$('.change-editor-position').live('click', function(e) {
			e.preventDefault();
			// var fa = $(this).find(".fa");
			var html = $(".sublayers .html");

			if($(html).hasClass("right")) {
				$(html).addClass("left").removeClass("right");
				// $(fa).removeClass("fa-step-backward").addClass("fa-step-forward");
			} else {
				$(html).addClass("right").removeClass("left");
				// $(fa).removeClass("fa-step-forward").addClass("fa-step-backward");
			}
		});


		$('.sublayers .sublayer h4').live('click', function() {
			// clearInterval(interval);
			if($(this).next().is(":visible")) {
				$(this).next().slideUp();
				$(this).find(".icon-angle-right").removeClass("icon-angle-right").addClass("icon-angle-down");

			} else {
				$(this).next().slideDown();
				$(this).find(".icon-angle-down").removeClass("icon-angle-down").addClass("icon-angle-right");
			}
		});


		$('.sublayer').live('click', function() {
			if($(this).hasClass("sublayer-selected")) return;

			// $('.sublayers .sublayer-selected').trigger('detach.ScrollToFixed');
			// $(this).siblings().removeClass("sublayer-selected");
			$(".sublayer-selected").removeClass("sublayer-selected");
			$(this).addClass("sublayer-selected");

			var ind = $(this).index();

			// $(this).closest('.revoslider_slides').find('.ui-draggable:eq('+ind+')').siblings().removeClass("sublayer-selected");

			var el = $(this).closest('.revoslider_slides').find('.ui-draggable:eq('+ind+')');

			if(el.hasClass("rstooltipwrapper") || el.is("img")) {
				el.addClass("sublayer-selected");
			} else {
				revoslider.addResize(el);
				if (el.parent().hasClass("ui-wrapper")) {
					el.parent().zIndex(ind+1);
					el.parent().addClass("sublayer-selected");
					el.draggable('destroy');
					revoslider.addDrag();
				} else {
					el.addClass("sublayer-selected");
				}
			}

			// $(this).closest('.revoslider_slides').find('.ui-draggable:eq('+ind+')').addClass("sublayer-selected");

			// $('.sublayers .sublayer-selected').scrollToFixed( { bottom: 0, limit: $('.sublayers .sublayer-selected').offset().top } );
			// closeSublayers(this);
		});


		$(document).mouseup(function(e) {
			if (!$(".ui-draggable").is(e.target) && $(".ui-draggable").has(e.target).length === 0
				&& !$(".sublayer").is(e.target) && $(".sublayer").has(e.target).length === 0) {

				// $('.sublayers .sublayer-selected').trigger('detach.ScrollToFixed');

				$('.ui-draggable').removeClass("sublayer-selected");
				// $('.ui-draggable').removeClass("sublayer-fixed");
				$('.sublayer').removeClass("sublayer-selected");
				// $('.sublayer').removeClass("sublayer-fixed");

				$('.ui-resizable').resizable('destroy');
				revoslider.addDrag();
			}
		});


		$(document).live('keydown', function(e) {
			var focused = $(':focus');
			if(focused.attr("name") != "top" && focused.attr("name") != "left") return;

			var position,
				draggable = $('.draggable .sublayer-selected'),
				distance = 1; // Distance in pixels the draggable should be moved

			position = draggable.position();

			if(position == undefined) return;

			if(event.shiftKey && (event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40)) {
				distance = 10;
			}

			// Reposition if one of the directional keys is pressed
			switch (e.keyCode) {
				case 37: position.left -= distance; break; // Left
				case 38: position.top  -= distance; break; // Up
				case 39: position.left += distance; break; // Right
				case 40: position.top  += distance; break; // Down
				default: return true; // Exit and bubble
			}

			// Keep draggable within container
			// if (position.left >= 0 && position.top >= 0 &&
			// 	position.left + draggable.width() <= container.width() &&
			// 	position.top + draggable.height() <= container.height()) {
				draggable.css(position);

				var el = draggable.index();

				$(draggable).closest('.revoslider_slides').find('.sublayer:eq('+el+') input[name="top"]').val(position.top);
				$(draggable).closest('.revoslider_slides').find('.sublayer:eq('+el+') input[name="left"]').val(position.left);
			// }

			// Don't scroll page
			e.preventDefault();
		});



		// Bind layer select event
		$('.revoslider-layer-select').live('click', function() {

			// Save clicked checkbox
			var checkbox = this;

			// Iterate over the checkboxes of the parent element
			$(this).closest('table').find('.revoslider-layer-select').each(function() {

				// Leave checked the clicked element
				if(this == checkbox) {
					return true;
				}

				// Disable all the other checkboxes
				$(this).attr('checked', false);
			});

			// Check the state of the checkbox
			if($(checkbox).attr('checked') == true || $(checkbox).attr('checked') == 'checked') {

				// Hide other layers
				$(checkbox).closest('.revoslider_slides').find('.draggable:first > *').css({ opacity : 0.4 });

				// Get selected layer's image property
				var index = $(checkbox).closest('tr').index() -1;

				// Show the one that selected
				$(checkbox).closest('.revoslider_slides').find('.draggable:first > *').eq(index).css({ opacity : 1, zIndex : 100 });

			} else {

				// Show all the layers
				$(checkbox).closest('.revoslider_slides').find('.draggable:first > *').each(function(index) {

					$(this).css({ opacity : 1, zIndex : (index+1) });
				})
			}
		});

		// Bind remove layer event
		$('.revoslider_slides .remove').live('click', function(e) {
			e.preventDefault();
			revoslider.removeSubLayer(this);
		});

		revoslider.addDrag();


		// Remove layer
		$('.revoslider_remove_layer').live('click', function(e) {
			e.preventDefault();
			if(confirm(_str_delete_layer)) {
				$(this).closest('li').slideUp(function() {
					$(this).remove();
				});
			}
		});

		// Update preview width
		$('input[name="width"]').live('input', function() {

			// Get top value
			var width = $(this).val();

			if(width.indexOf('px') == -1 && width.indexOf('%') == -1) {
				width = width + 'px';
			}

			$(this).closest('.revoslider_tabs').find('.draggable_wrapper').css('width', width );
			$(this).closest('.revoslider_tabs').find('.draggable').css('width', '100%' );

			// Update preview
			$(this).closest('.revoslider_tabs').find('.revoslider_slides').each(function() {
				$(this).find('.sublayers').each(function() {
					revoslider.updatePreview(this);
				});
			});
		});

		// Update preview height
		$('input[name="height"]').live('input', function() {

			// Get top value
			var height = $(this).val();

			if(height.indexOf('px') == -1 && height.indexOf('%') == -1) {
				height = height + 'px';
			}

			$(this).closest('.revoslider_tabs').find('.draggable_wrapper').css('height', height );
			$(this).closest('.revoslider_tabs').find('.draggable').css('height', '100%' );

			// Update preview
			$(this).closest('.revoslider_tabs').find('.revoslider_slides').each(function() {
				revoslider.updatePreview($(this).find('table:eq(1)')); //TODO
			});
		});

		// Disable text fields depending on content type
		$('.revoslider_slides_wrapper > li table tr').each(function() {

			// Disable HTML and Style fields
			if( $(this).find('select[name="type"] option:selected').val() == 'img') {
				$(this).find('input[name="html"]').attr('disabled', true);
				$(this).find('input[name="style"]').attr('disabled', true);

			// Disable image field
			} else {
				$(this).find('input[name="image"]').attr('disabled', true);
			}
		});

		// Bind change event in type selects
		$('select[name="type"]').live('change', function() {

			// revoslider.updatePreview( $(this).closest('table') );
			revoslider.updatePreview( $(this) );
		});


		$('input[name="style"]').live('input', function() {

			// revoslider.updatePreview( $(this).closest('table') );
			revoslider.updatePreview( $(this) );
		});

		$('.resize').live('focus', function(){
			$(this).animate({
				width: 600
			}, 350 );
		});

		$('.resize').live('blur', function(){
			$(this).animate({
				width: 50
			}, 350 );
		});

/*		$('#TB_closeWindowButton, #TB_closeWindowButton img').live('click', function() {
			$('.draggable iframe, .draggable embed, .draggable object').show();
		});
*/
		$('input[name="backgroundcolor"]').live('input', function() {
			$(this).closest('table').next().find('.draggable').css('background-color', $(this).val() );
		});

		$('.revoslider_sort_layers').live('click', function(e) {
			e.preventDefault();

			if( $(this).hasClass('reordering') ) {
				$(this).closest(".revoslider_tabs").find('.revoslider_slides_wrapper .revoslider_slides').each(function(){
					$(this).css({
						border: '1px solid #ccc'
					});
					$(this).find('h1:first').remove();
					$(this).find('> *').show();
				});
				$(this).closest(".revoslider_tabs").find('.revoslider_slides_wrapper').sortable( 'option', 'disabled', true );

				// $(this).html('Изменить порядок слоев');
				$(this).removeClass('reordering');
				$(this).find("i").removeClass('icon-ok').addClass('icon-retweet');
			} else {
				$(this).closest(".revoslider_tabs").find('.revoslider_slides_wrapper .revoslider_slides').each(function(){
					$(this).css({
						border: '2px dotted #777'
					});
					$(this).find('> *').hide();
					$('<h1>').css({
						paddingLeft: '10px',
						fontSize: '18px',
						color: '#555'
					}).html( $(this).find('input[name="title"]').val() ).prependTo( $(this) );
					$('<i>').css({
						fontSize: '15px',
						fontWeight: 'normal',
						color: '#777'
					}).html(' (перетащите этот блок, чтобы изменить порядок)').appendTo( $(this).find('h1:first') );
				});

				$(this).closest(".revoslider_tabs").find('.revoslider_slides_wrapper').sortable( 'option', 'disabled', false );
				// $(this).html('Завершить изменение порядка');
				$(this).addClass('reordering');
				$(this).find("i").removeClass('icon-retweet').addClass('icon-ok');
			}
		});

        $('.revoslider_slides_wrapper').sortable({
			containment: 'parent',
			tolerance: 'pointer',
			disabled: true
        });

        // BG reset
        $('.revoslider-bg-reset').live('click', function(e) {

        	e.preventDefault();
        	if( $(this).hasClass('empty') ) {
        		$(this).prev().attr('value', '');

        	} else {
        		$(this).prev().attr('value', 'false');
        	}

			if( $(this).prev().is('input[name="background"]') ) {

				// Get the BG image input
				var bgimage = $(this).closest('.revoslider_tabs').find('input[name="backgroundimage"]');

        		// Change the background if any
        		if( bgimage.val() != '') {

        			$(this).closest('li').find('.draggable').css('background-image', 'url('+bgimage.val()+')');
        		}
        	}


        	if( $(this).prev().is('input[name="backgroundimage"]') ) {

				$(this).closest('.revoslider_tabs').find('input[name="background"]').each( function() {

					if( $(this).val() == '') {
						$(this).closest('li').find('.draggable').css('background-image', 'none');
					}
				});
        	}
        });

        // Yourlogo style
        // $('input[name="yourlogostyle"]').live('keyup', function() {
        //
        // 	// Get the slider container
        // 	var slider = $(this).closest('.revoslider_tabs');
        //
        // 	// Get the style settings input
        // 	var settings = this;
        //
        // 	// Get the preview image
        // 	slider.find('.revoslider-yourlogo-img').each(function() {
        //
        // 		// Apple new style settings
        // 		$(this).attr('style', $(settings).val() );
        // 	});
        // });
	},


	updateAfterAdd : function () {
		assign_fileupload();
		revoslider.addSortables();
		revoslider.initColorpick();
		revoslider.addDrag();
		$('[data-toggle="tooltip"]').tooltip();
		$('.dropdown-toggle').dropdown();
			// revoslider.initSwitchery();
	},


	hexToRgb : function (hex) {
		var bigint = parseInt(hex, 16);
		var r = (bigint >> 16) & 255;
		var g = (bigint >> 8) & 255;
		var b = bigint & 255;

		return r + "," + g + "," + b;
	},

	updatePreview : function(el) {
		// Remove all preview items
		$(el).closest('.revoslider_slides').find('.draggable > *').remove();

		$(el.closest(".sublayers")).find('.sublayer').each(function(index) {

			// if(index == 0) {
			// 	return true;
			// }

			// Get type val
			var type = $(this).find('input[name="type"]').val();

			// Disable HTML and Style fields
			if( type == 'image') {

				// Re-enable all fields
				// $(this).find('input,select').attr('disabled', false);

				// Disable certain fields
				// $(this).find('input[name="rsLayerHtml"]').attr('disabled', true);
				// $(this).find('input[name="rsLayerStyle"]').attr('disabled', true);

				// var index = $(this).index() - 1;
				var index = $(this).index();

				var container = $(this).closest('.revoslider_slides').find('.draggable');

				var target = container.children().eq(index);

				// if( $(this).find('input[name="image"]').val() != '') {
					var clone = $('<img>').appendTo(container).attr('src', $(this).find('input[name="image"]').val());

					var sll = $(this).find('input[name="left"]').val();
					var slt = $(this).find('input[name="top"]').val();

					if( $.browser.msie || $.browser.opera ) {
						if( sll.indexOf('%') != -1 ) {
							clone.css({
								left : (clone.parent().width() / 100 * parseInt(sll) - clone.outerWidth() / 2) + "px"
							});
						} else {
							clone.css({ left : parseInt(sll) + "px" });
						}

						if( slt.indexOf('%') != -1 ) {
							clone.css({
								top : (clone.parent().height() / 100 * parseInt(slt) - clone.outerHeight() / 2) + "px"
							});
						} else {
							clone.css({ top : parseInt(slt) + "px" });
						}
					} else {
						clone.load(function() {
							if( sll.indexOf('%') != -1 ) {
								clone.css({
									left : (clone.parent().width() / 100 * parseInt(sll) - clone.outerWidth() / 2) + "px"
								});
							} else {
								clone.css({ left : parseInt(sll) + "px" });
							}

							if( slt.indexOf('%') != -1 ) {
								clone.css({
									top : (clone.parent().height() / 100 * parseInt(slt) - clone.outerHeight() / 2) + "px"
								});
							} else {
								clone.css({ top : parseInt(slt) + "px" });
							}
						});
					}

					clone.css('z-index', index + 1);

					// Add dragging
				// ----transform-----------

				clone.css("opacity", $(this).find('input[name="rsLayerOpacityIdle"]').val());

				var scaleX = $(this).find('input[name="rsLayerTransformIdleScaleX"]').val();
				var scaleY = $(this).find('input[name="rsLayerTransformIdleScaleY"]').val();
				var skewX = $(this).find('input[name="rsLayerTransformIdleSkewX"]').val();
				var skewY = $(this).find('input[name="rsLayerTransformIdleSkewY"]').val();
				var rotateX = $(this).find('input[name="rsLayerTransformIdleRotateX"]').val();
				var rotateY = $(this).find('input[name="rsLayerTransformIdleRotateY"]').val();
				var rotateZ = $(this).find('input[name="rsLayerTransformIdleRotateZ"]').val();

				var trans = "scaleX("+scaleX+") scaleY("+scaleY+") skewX("+skewX+"deg) skewY("+skewY+"deg) rotateX("+rotateX+"deg) rotateY("+rotateY+"deg) rotateZ("+rotateZ+"deg)";

				clone.css({
					'-webkit-transform' : trans,
					'-moz-transform'    : trans,
					'-ms-transform'     : trans,
					'-o-transform'      : trans,
					'transform'         : trans
				});

					// Remove target
					target.remove();
				// }

			} else if ( type == 'tooltip') {

				var title = $(this).find('input[name="rsLayerHtmlTiptitle"]').val();
				var descr = $(this).find('input[name="rsLayerHtmlTipdescription"]').val();

				var clone = $('<div class="rstooltipwrapper">'
				+'<div class="rstooltip">'
					+'<span class="rstooltip-title">'+title+'</span>'
					+'<span class="rstooltip-description">'+descr+'</span>'
					+'<span class="rstooltip-arrow"></span>'
					+'</div>'
				+'</div>');

				var container = $(this).closest('.revoslider_slides').find('.draggable');

				var target = container.children().eq(index);

				var sll = $(this).find('input[name="left"]').val();
				var slt = $(this).find('input[name="top"]').val();

				if( sll.indexOf('%') != -1 ) {
					clone.css({
						left : (clone.parent().width() / 100 * parseInt(sll) - clone.outerWidth() / 2) + "px"
					});
				} else {
					clone.css({ left : parseInt(sll) + "px" });
				}

				if( slt.indexOf('%') != -1 ) {
					clone.css({
						top : (clone.parent().height() / 100 * parseInt(slt) - clone.outerHeight() / 2) + "px"
					});
				} else {
					clone.css({ top : parseInt(slt) + "px" });
				}

				var bgColor = $(this).find('input[name="rsLayerTipDescriptionBgColor"]').val();
				$(clone).find(".rstooltip").css("background-color", bgColor);

				$(clone).css("border-top-color", bgColor);

				$(clone).css("background-color", $(this).find('input[name="rsLayerTipBgColor"]').val());

				var size = $(this).find('input[name="rsLayerTipSize"]').val();
				$(clone).css({"width" : size+"px", "height" : size+"px",});

				$(clone).css("border-color", $(this).find('input[name="rsLayerTipBorderColor"]').val());

				$(clone).css("border-width", $(this).find('input[name="rsLayerTipBorderSize"]').val()+"px");

				$(clone).find(".rstooltip").css("width", $(this).find('input[name="rsLayerTipDescriptionSize"]').val()+"px");

				$(clone).find(".rstooltip-title").css("color", $(this).find('input[name="rsLayerTipTitleColor"]').val());

				$(clone).find(".rstooltip-description").css("color", $(this).find('input[name="rsLayerTipDescriptionColor"]').val());

				$(clone).find(".rstooltip").css("left", $(this).find('input[name="rsLayerTipDescriptionLeftOffset"]').val()+"px");
				$(clone).find(".rstooltip").css("top", $(this).find('input[name="rsLayerTipDescriptionTopOffset"]').val()+"px");

				if( $(this).find(".showtipdescription").is(":checked") ) {
					$(clone).addClass("tipactive");
				}

				clone.css('z-index', index + 1);

				$(clone).appendTo(container);

				target.remove();

			} else {
                var htmlType = $(this).find('select[name="htmltype"] option:selected').val();

				$(this).find('input,select').attr('disabled', false);

				$(this).find('input[name="image"]').attr('disabled', true);

				// var index = $(this).index() - 1;
				var index = $(this).index();

				var container = $(this).closest('.revoslider_slides').find('.draggable');

				var target = container.children().eq(index);

				var type = $(this).find('select[name="type"] option:selected').val();

				// TODO remove
				// type = "div";

				var html = $(this).find('input[name="rsLayerHtml"]').val();


				var style = $(this).find('input[name="rsLayerStyle"]').val();

				var clone = $('<'+htmlType+'>').appendTo(container).html(html).attr('style', style);

				var sll = $(this).find('input[name="left"]').val();
				var slt = $(this).find('input[name="top"]').val();

				if( sll.indexOf('%') != -1 ) {
					clone.css({
						left : (clone.parent().width() / 100 * parseInt(sll) - clone.outerWidth() / 2) + "px"
					});
				} else {
					clone.css({ left : parseInt(sll) + "px" });
				}

				if( slt.indexOf('%') != -1 ) {
					clone.css({
						top : (clone.parent().height() / 100 * parseInt(slt) - clone.outerHeight() / 2) + "px"
					});
				} else {
					clone.css({ top : parseInt(slt) + "px" });
				}


				// mum nicamb

				clone.css("font-family", $(this).find('input[name="rsLayerStyleTxtFontfamily"]').val());

				clone.css("width", $(this).find('input[name="rsLayerStyleWidth"]').val() + "px");

				clone.css("height", $(this).find('input[name="rsLayerStylehHeight"]').val() + "px");


				// ----text-----------

				clone.css("color", $(this).find('input[name="rsLayerStyleTxtColor"]').val());

				clone.css("font-size", $(this).find('input[name="rsLayerStyleTxtfontsize"]').val() + "px");

				clone.css("line-height", $(this).find('input[name="rsLayerStyleTxtlineheight"]').val() + "px");

				clone.css("font-weight", $(this).find('select[name="rsLayerStyleTxtWeight"]').val());

				clone.css("text-decoration", $(this).find('select[name="rsLayerStyleTxtDecoration"]').val());

				clone.css("text-align", $(this).find('select[name="rsLayerStyleTxtAlign"]').val());


				// ----background-----------

				clone.css("background-color", $(this).find('input[name="rsLayerStyleBackgroundColor"]').val());

				clone.css("padding-top", $(this).find('input[name="rsLayerStyleBackgroundPaddingTop"]').val() + "px");

				clone.css("padding-right", $(this).find('input[name="rsLayerStyleBackgroundPaddingRight"]').val() + "px");

				clone.css("padding-bottom", $(this).find('input[name="rsLayerStyleBackgroundPaddingBottom"]').val() + "px");

				clone.css("padding-left", $(this).find('input[name="rsLayerStyleBackgroundPaddingLeft"]').val() + "px");


				// ----border-----------

				clone.css("border-color", $(this).find('input[name="rsLayerStyleBorderColor"]').val());

				clone.css("border-style", $(this).find('select[name="rsLayerStyleBorderStyle"]').val());

				clone.css("border-width", $(this).find('input[name="rsLayerStyleBorderSize"]').val() + "px");

				clone.css("border-top-left-radius", $(this).find('input[name="rsLayerStyleBorderTopLeftRadius"]').val() + "px");

				clone.css("border-top-right-radius", $(this).find('input[name="rsLayerStyleBorderTopRightRadius"]').val() + "px");

				clone.css("border-bottom-right-radius", $(this).find('input[name="rsLayerStyleBorderBottomRightRadius"]').val() + "px");

				clone.css("border-bottom-left-radius", $(this).find('input[name="rsLayerStyleBorderBottomLeftRadius"]').val() + "px");

				// ----transform-----------

				clone.css("opacity", $(this).find('input[name="rsLayerOpacityIdle"]').val());

				var scaleX = $(this).find('input[name="rsLayerTransformIdleScaleX"]').val();
				var scaleY = $(this).find('input[name="rsLayerTransformIdleScaleY"]').val();
				var skewX = $(this).find('input[name="rsLayerTransformIdleSkewX"]').val();
				var skewY = $(this).find('input[name="rsLayerTransformIdleSkewY"]').val();
				var rotateX = $(this).find('input[name="rsLayerTransformIdleRotateX"]').val();
				var rotateY = $(this).find('input[name="rsLayerTransformIdleRotateY"]').val();
				var rotateZ = $(this).find('input[name="rsLayerTransformIdleRotateZ"]').val();

				var trans = "scaleX("+scaleX+") scaleY("+scaleY+") skewX("+skewX+"deg) skewY("+skewY+"deg) rotateX("+rotateX+"deg) rotateY("+rotateY+"deg) rotateZ("+rotateZ+"deg)";

				clone.css({
					'-webkit-transform' : trans,
					'-moz-transform'    : trans,
					'-ms-transform'     : trans,
					'-o-transform'      : trans,
					'transform'         : trans
				});


				clone.css('z-index', index + 1);

				// revoslider.addDrag();

				target.remove();
			}

			revoslider.addDrag();
		});
	},

	addSortables : function() {

		// Bind sortable function
        $('.sortable').sortable({
			sort: function(event, ui){
				revoslider.g.dragContainer = $('.ui-sortable-helper').closest('li').find('.draggable');
				// revoslider.g.subLayers = $('.ui-sortable-helper').closest('table');
				revoslider.g.subLayers = $('.ui-sortable-helper').closest('.sublayer');
			},
			stop: function(event, ui) {
				// revoslider.updatePreview( revoslider.g.subLayers );
				revoslider.updatePreview( this );
            },
            containment: 'parent',
			handle : '.moveable'
			// items: '.sublayer'
        });
	},


	addResize : function(el) {
		$(el).resizable({
			resize: function (e, ui) {
				var index = $(".ui-resizable-resizing").index();
				var l = $(".ui-resizable-resizing").closest('.revoslider_slides').find(".sublayers").children().eq(index);

				l.find('input[name="rsLayerStyleWidth"]').val(ui.size.width);
				l.find('input[name="rsLayerStylehHeight"]').val(ui.size.height);
			}
		});
	},


	addDrag : function(el) {

		if(!el){
			var el = $('.draggable')
		}

		// setTimeout(function(){
		// 	$.each(el.children(), function () {
		// 		if (!$(this).hasClass("rstooltipwrapper")) {
		// 			$(this).resizable({
		// 				resize: function (e, ui) {
		// 					var index = $(".ui-resizable-resizing").index();
		// 					var l = $(".ui-resizable-resizing").closest('.revoslider_slides').find(".sublayers").children().eq(index);
        //
		// 					l.find('input[name="rsLayerStyleWidth"]').val(ui.size.width);
		// 					l.find('input[name="rsLayerStylehHeight"]').val(ui.size.height);
		// 				}
		// 			});
		// 		}
		// 	});
		// }, 1000);

        el.children().draggable({
        	drag : function() {
        		revoslider.dragging();
				revoslider.highlightOnDragging(this);
        	},
        	stop : function() {
        		revoslider.dragging();
        		revoslider.stopHighlightOnDragging(this);
        	}
        });
	},

	dragging : function() {
		var top = $('.ui-draggable-dragging').position().top;
		var left = $('.ui-draggable-dragging').position().left;

		// var image = $('.ui-draggable-dragging').index()+1;
		var image = $('.ui-draggable-dragging').index();

		$('.ui-draggable-dragging').closest('.revoslider_slides').find('.sublayer:eq('+image+') input[name="top"]').val(top);
		$('.ui-draggable-dragging').closest('.revoslider_slides').find('.sublayer:eq('+image+') input[name="left"]').val(left);
	},

	highlightOnDragging : function(e) {
		var index = $(e).index();
		var l = $(e).closest('.revoslider_slides').find(".sublayers").children().eq(index);
		l.addClass("highlight-drag");
	},

	stopHighlightOnDragging : function(e) {
		var index = $(e).index();
		var l = $(e).closest('.revoslider_slides').find(".sublayers").children().eq(index);
		l.removeClass("highlight-drag");
	},

	addSlide : function(button) {
		// Clone the template element
		var clone = $('.add-new-slide li:first').clone();

		// Find cointainer to append to
		var eleme = $(".revoslider_slides_wrapper");

		// Append new slide
		var append = $(clone).appendTo(eleme).hide();

		// Get preview size settings
		var width = $(button).closest(".revoslider_tabs").find('.global-slider-settings input[name="width"]').val();
		var height = $(button).closest(".revoslider_tabs").find('.global-slider-settings input[name="height"]').val();

		// Set preview size
		$(append).find('.draggable').width(width);
		$(append).find('.draggable').height(height);

		$(append).find('.draggable_wrapper').width(width);
		$(append).find('.draggable_wrapper').height(height);

		// Add slide title
		$(append).find('input[name="title"]').val('Слой #' + ($(append).index() + 1) );

		// Set preview background options
		// $(append).find('.draggable').css('background-color', $(append).find('input[name="backgroundcolor"]').val() );
		// $(append).find('.draggable').css('background-image', 'url('+$(append).find('input[name="backgroundimage"]').val()+')');

		// Add sorables
		// revoslider.addSortables();

		// Show the new slide
		$(append).slideDown(function(){
			// Set width
			// $(this).css({
			// 	width : $(this).find('table:eq(1)').outerWidth(true)
			// });
		});

		// $.fn.bootstrapSwitch.defaults.size = 'mini';
		// $(append).find('.bootstrap-switch').replaceWith( '<input class="js-switch" type="checkbox" name="testswitch" value="1" checked="checked">' );
		// $(append).find('.js-switch').bootstrapSwitch();
		// $('.js-switch').bootstrapSwitch();

		// revoslider.initSwitchery();

		// assign_fileupload();
		$('html,body').animate({ scrollTop: $(clone).offset().top-60}, 1500);
	},


	addSublayer : function(ele) {
		var clone = null;
		if($(ele).attr("class") == "menu-item-img") {
			clone = $('.imagetype > div').clone();

		} else if($(ele).attr("class") == "menu-item-tooltip") {
			clone = $('.tooltiptype > div').clone();

		} else {
			clone = $('.htmltype > div').clone();
		}

		// var eleme = $(ele).closest('.revoslider_slides').find('table:eq(1)');
		var eleme = $(ele).closest('.revoslider_slides').find('.sublayers');

		$(clone).appendTo(eleme).hide().slideDown();

		$(clone).find('input[name="name"]').val("Слой " + ($(clone).index()+1));

		if($(clone).prev().find('input[name="delayin"]').val() != undefined) {
			$(clone).find('input[name="delayin"]').val(parseInt($(clone).prev().find('input[name="delayin"]').val()) + 300);
		}

		// assign_fileupload();

		revoslider.updatePreview( clone.parent() );
		revoslider.updateAfterAdd();

		// revoslider.initColorpick();

		// $('[data-toggle="tooltip"]').tooltip();
	},

	removeSubLayer : function(ele) {

		// Get layer index
		var index = $(ele).closest('tr').index() - 1;

		// Remove layer from preview
		$(ele).closest('.revoslider_slides').find('.draggable *').eq(index).remove();

		// Remove layer row
		$(ele).closest('tr').remove();
	},


	makeResponsive : function(ele) {

		if( $(ele)[0].style.left.indexOf('%') != -1 ){
		    $(ele).css({
		    	left : $(ele).parent().width() / 100 * parseInt( $(ele)[0].style.left ) - $(ele).outerWidth() / 2
		    });
		}
		if( $(ele)[0].style.top.indexOf('%') != -1 ){
		    $(ele).css({
		    	top : $(ele).parent().height() / 100 * parseInt( $(ele)[0].style.top ) - $(ele).outerHeight() / 2
		    });
		}
	},

	submit : function(ele) {
		// $(this).attr('disabled', true);

		var slider_id = $("#slider_id").val();
		var slider = {};

		$('#revoslider-tabs > div').each(function() {
			var v = {};

			$(this).find('.form-table input, .form-table textarea, .form-table select ').each(function() { // Iterate over the slide properties
				if($(this).is(":checkbox") && !$(this).is(':checked')) { return true; }
				// params['revoslider-slides'][slider_id]['properties'][$(this).attr('name')] = $(this).val();
				v[$(this).attr('name')] = $(this).val();
			});

			slider['properties'] = v;

			var ll = {};

			$(this).find('.revoslider_slides_wrapper > li').each(function(layer) { // Iterate over the main layers
				var v = {};
				var p = {};

				$(this).find('.global-slide-options input, .global-slide-options textarea, .global-slide-options select').each(function() { // Save main layer properties
					if($(this).is(":checkbox") && !$(this).is(':checked')) { return true; }
					// params['revoslider-slides'][slider_id]['layers'][layer]['properties'][$(this).attr('name')] = $(this).val();

					v[$(this).attr('name')] = $(this).val();
			    });

				p['properties'] = v;

				var sl = {};
				$(this).find('.sublayer').each(function(sublayer) { // Iterate over the slides
					var v = {};
			    	$(this).find('input, select').each(function() { // Save slides properties
						if($(this).is(":checkbox") && !$(this).is(':checked')) { return true; }
						// params['revoslider-slides'][slider_id]['layers'][layer]['sublayers'][sublayer][$(this).attr('name')] = $(this).val();

						v[$(this).attr('name')] = $(this).val();
			    	});

					sl[sublayer] = v;
			    });

				p['sublayers'] = sl;
				ll[layer] = p;

			});

			slider['layers'] = ll;
		});

		// Post the form
		$(ele).removeClass("saving");
		$.post( $('#revoslider_form').attr('action'), {slider_id: slider_id, slider_data: JSON.stringify(slider)}, function(response) {
			// window.location.reload(true);
			// $(ele).find('input[type="submit"]').attr('disabled', false);
			// $(this).attr('disabled', false);

			if (response.status == 'ok') {
				new jBox('Notice', {
					content: _str_slider_saved,
					color: 'green',
					addClass: 'revo-notice',
					position: {x: 'left', y: 'bottom'},
					offset: {x: 15, y: -15}
				});
			} else {
				// alert(response.errors.join(', '));
				new jBox('Notice', {
					content: _str_error + ": " + response.errors,
					color: 'red',
					// addClass: 'revo-notice',
					position: {x: 'left', y: 'bottom'},
					animation: {open: 'slide:bottom', close: 'slide:left'},
					adjustDistance: {bottom: 20, left: 20},
					offset: {x: 15, y: -15}
				});
			}
		});
	},

	initColorpick : function() {
		$('.colorpick').each( function() {
			$(this).minicolors('destroy');
			$(this).minicolors({
				control: $(this).attr('data-control') || 'hue',
				defaultValue: $(this).attr('data-defaultValue') || '',
				format: $(this).attr('data-format') || 'hex',
				keywords: $(this).attr('data-keywords') || '',
				inline: $(this).attr('data-inline') === 'true',
				letterCase: $(this).attr('data-letterCase') || 'lowercase',
				opacity: $(this).attr('data-opacity'),
				position: $(this).attr('data-position') || 'bottom left',
				swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
				change: function(value, opacity) {
					if( !value ) return;
					if( opacity ) value += ', ' + opacity;
					if( typeof console === 'object' ) {
						// console.log(value);
					}
				},
				theme: 'bootstrap'
			});
		});
	}
};


function assign_fileupload() {
	$('.fileupload').fileupload({
		progressall: function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#progress .bar').css(
				'width',
				progress + '%'
			);
		},

		dataType: 'json',
		add: function (e, data) {
			data.submit();
			return true;

		},

		done: function (e, data) {
			var file = data.result.data.file;

			if($(this).hasClass("main-background")) {
				var target = $(e.target);
				// $.each(data.result.files, function (index, file) {
					$(target).closest(".revoslider_slides").find(".draggable").css("background-image", "url("+file.url+")");
					$(target).prev('input[name="background"]').val(file.url);
				// });

			} else {
				var target = $(e.target);
				// $.each(data.result.files, function (index, file) {
					$(target).parent().parent().find('.imgplaceholder').attr("src", file.thumbnailUrl);
					$(target).parent().parent().find('.thumbImage').val(file.thumbnailUrl);
					$(target).prev('input[name="image"]').val(file.url);
					$(target).prev('input[name="globalthumbimagefull"]').val(file.url);
				// });

				// $(this).closest('.revoslider_slides').find('.revoslider_slides').each(function () {
					if(!$(this).hasClass("thumb")) revoslider.updatePreview(this);
				// });
			}
		}
	});
}


$(document).ready(function() {

	// $('.globalsave').scrollToFixed({marginTop : $('#mainmenu').outerHeight(true) + 10});
	// $('.revoslider_add_slide').scrollToFixed({marginTop : $('#mainmenu').outerHeight(true) + 10});
	// $('.revoslider_sort_layers').scrollToFixed({marginTop : $('#mainmenu').outerHeight(true) + 10});
	// $('.globalpreview').scrollToFixed({marginTop : $('#mainmenu').outerHeight(true) + 10});

	// $.fn.bootstrapSwitch.defaults.size = 'mini';
	// $(".js-switch").bootstrapSwitch();

	assign_fileupload();

	var tabsFn = (function() {

		function init() {
			setHeight();
		}
	});

	$(function () {
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
	});

	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});

	$('.nav-tabs li:not(.tab-title, .controls)').live('click', function(e) {
		e.preventDefault();
//            var tabIndex = $(this).index();
		var tabIndex = $(this).parent().find('li:not(.tab-title, .controls)').index(this);

		$(this).siblings().removeClass("active");
		$(this).addClass("active");

		var cont = $(this).parent().parent().children(".tab-content");

		$(cont).children().eq(tabIndex).siblings().removeClass("in active");
		$(cont).children().eq(tabIndex).addClass("in active");
	});
	
	// Bind an event to image url insert
	window.send_to_editor = function(html) {
		
		var img = $('img',html).attr('src');
		
		$(uploadInput).val( img );
		tb_remove();
		$('.draggable iframe, .draggable embed, .draggable object').show();
		
		var container = $(uploadInput).closest('.revoslider_slides').find('.draggable');
		
		// If it is a background image, change in the preview
		if($(uploadInput).is('input[name="background"]')) {
			container.css('background-image', 'url('+img+')');
		
		} else if($(uploadInput).is('input[name="backgroundimage"]')) {
			$(uploadInput).closest('table').next().find('.draggable').css('background-image', 'url('+$(uploadInput).val()+')');
		
		} else if($(uploadInput).is('input[name="yourlogo"]')) {
			
			// Remove old yourlogo image
			$(uploadInput).closest('.revoslider_tabs').find('.revoslider-yourlogo-img').remove();
			
			// Append the new one
			var yourlogo = $('<img>').attr('src', img).prependTo( $(uploadInput).closest('.revoslider_tabs').find('.draggable_wrapper') );
			
			// Apply style settings
			yourlogo.attr('style', $(uploadInput).closest('.revoslider_tabs').find('input[name="yourlogostyle"]').val() );
		
		// Show the new layer
		} else {

			// Get row index
			var index = $(uploadInput).closest('tr').index() - 1;
			
			// Check container for row element
			// Update image src when found
			if($(container).find('img').eq(index).length) {
				
				$(container).find('img').eq(index).attr('src', img);
			
			// Insert as new layer
			} else {
			
				// Add the new layer and set properties
				var ele = $('<img>').appendTo(container).attr('src', img);
					ele.css({ 'position' : 'absolute', top : 0, left : 0, 'z-index' : ($(ele).index()+1) });
			
				// Reinit dragable content
				revoslider.addDrag(container);
			}
		}
	}

	// set width of .revoslider_slides
	
	$('.revoslider_slides:gt(0)').each(function(){
		$(this).css({
			width : $(this).find('table:eq(1)').outerWidth(true)
		});
	});

	revoslider.init();

	// make responsiveLayout
	$('.draggable').children().each(function(){

		if( $(this).is('img') && !$.browser.opera && !$.browser.msie ){
			$(this).load(function(){
				revoslider.makeResponsive(this);
			});
		}else{
			revoslider.makeResponsive(this);
		}
	});
	
	// minimize global settings
	$('.ls-openclose').live('click',function(e){
		e.preventDefault();
		if( $(this).hasClass('minimized') ){
			$(this).removeClass('minimized').closest('.ls-global-table').animate({
				height: $(this).closest('tbody').height()
			}, 750, 'easeInOutQuad');
		}else{
			$(this).addClass('minimized').closest('.ls-global-table').find('td, th, tr, tbody').animate({
				height: 0
			}, 750, 'easeInOutQuad');
		}
	});

	$(document).on( 'scroll', function() {
		$('.tooltip').remove();
	});

	revoslider.initColorpick();
});

(function (original) {
	jQuery.fn.clone = function () {
		var result           = original.apply(this, arguments),
			my_textareas     = this.find('textarea').add(this.filter('textarea')),
			result_textareas = result.find('textarea').add(result.filter('textarea')),
			my_selects       = this.find('select').add(this.filter('select')),
			result_selects   = result.find('select').add(result.filter('select'));

		for (var i = 0, l = my_textareas.length; i < l; ++i) $(result_textareas[i]).val($(my_textareas[i]).val());
		for (var i = 0, l = my_selects.length;   i < l; ++i) {
			for (var j = 0, m = my_selects[i].options.length; j < m; ++j) {
				if (my_selects[i].options[j].selected === true) {
					result_selects[i].options[j].selected = true;
				}
			}
		}
		return result;
	};
}) (jQuery.fn.clone);