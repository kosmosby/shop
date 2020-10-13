(function($){
    var call = function(s){
            return $(document).find(s);
        },

        xml_dialog,
        preloader = '<i class="icon16 loading"></i>',
        event = function( type, selector, callback ) {
            callback = callback || function(){};
            callback = (typeof selector == 'function') ? selector : callback;
            $(document).on(type, selector, callback);
        },

        _cache = {},

        number_format = function ( number, decimals, dec_point, thousands_sep ) {
            var i, j, kw, kd, km;

            // input sanitation & defaults
            if( isNaN(decimals = Math.abs(decimals)) ){
                decimals = 2;
            }
            if( dec_point == undefined ){
                dec_point = ",";
            }
            if( thousands_sep == undefined ){
                thousands_sep = ".";
            }

            i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

            if( (j = i.length) > 3 ){
                j = j % 3;
            } else{
                j = 0;
            }

            km = (j ? i.substr(0, j) + thousands_sep : "");
            kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
            //kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
            kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");


            return km + kw + kd;
        },

        formatSize = function ($size) {

            if ($size >= 1073741824){
                $size = number_format($size / 1073741824, 2) + ' GB';
            } else if ($size >= 1048576){
                $size = number_format($size / 1048576, 2) + ' MB';
            } else if ($size >= 1024) {
                $size = number_format($size / 1024, 2) + ' KB';
            } else if ($size > 1){
                $size = $size + ' bytes';
            } else if ($size === 1) {
                $size = $size + ' bytes';
            } else {
                $size = '0 bytes';
            }

            return $size;
        },

        /**
         * Parse type from string and return object
         * @param string type:field[:feature_id]
         * @example product:name
         * @example feature:existing:4
         * @example sku:price
         * @return object
         */
        parseType = function(type_str){
            var result = {};

            if ( type_str ){
                var pre_str = type_str.split('|'), str;

                if ( pre_str[1] ){
                    result.up = 0;
                } else {
                    result.up = 1;
                }

                result.multiple = 0;

                str = pre_str[0].split(':');

                if ( str && str.length ){
                    result.original   = pre_str[0];
                    result.primary    = str[0];
                    result.secondary  = str[1];
                    result.key        = str[0] + ':' + str[1] + ((str[1] === 'stock') && str[2] ? ':' + str[2] : '');

                    if ( str[2] ){
                        var key = str[1] === 'exists' ? 'feature_id' : 'feature_type';
                        result[key] = str[2];

                        if ( (key === 'feature_id') && str[3] ){
                            result.multiple = (str[3] === '+') ? 1 : 0;
                        }
                    }
                }
            }

            return result;
        },

        Dialog = function(html, pre_open, options){
            pre_open = pre_open || false;
            options = options || {};
            this.options = $.extend({
                'title': ''
            }, options);

            this.reset();
            this._saveHandler = (typeof options.save === 'function') ? options.save : function(e){e.preventDefault();};

            var $this = this;
            $(document).off('submit', '#xml-dialog form[name="xml-dialog-form"]');
            event('submit', '#xml-dialog form[name="xml-dialog-form"]', function(e){
                $this._saveHandler(e);
            });

            this.dialog = call('#xml-dialog');
            this.dialog_content = this.dialog.find('.xml-dialog-content');

            this.dialog.appendTo('body');

            this.shown = false;

            if ( options.buttons ){
                var btns = '';
                for ( var b in options.buttons ){
                    if ( options.buttons[b]){
                        var button = options.buttons[b];
                        btns += '<button type="'+button.type+'" title="' + button.title + '" class="' + button.class + '"><i class="icon16 ' + button.icon + '"></i></button>';
                    }
                }
                this.dialog.find('.xml-dialog-buttons').html(btns);
            }

            if ( pre_open ){
                this.open();
            }

            if ( this.options.title ){
                this.dialog.find('.xml-dialog-title').html(this.options.title);
            }

            this.html = html;

            if ( this.html ){
                $this = this;
                setTimeout(function(){
                    $this.dialog_content.html($this.html);
                    //$this.tooltips();
                }, 300);
            }
        };

    Dialog.prototype.open = function (){
        if ( this.dialog && this.dialog.length ){
            var overlay = call('#xml-dialog-overlay');

            if ( !$(overlay).length ){
                overlay = $('<div/>',{id:"xml-dialog-overlay"}).css('display', 'none');
                call('body').append(overlay);
            }

            if ( !$(overlay).is(':visible') ){
                $(overlay).fadeIn();
            }

            this.dialog.fadeIn();
            this.shown = true;
        }
        return this;
    };

    Dialog.prototype.tooltips = function(){
        $('#xml-dialog .xml-item:not(.disabled-tag)').tooltipster({
            interactive: true,
            contentCloning: true,
            functionBefore: function(instance, helper){
                var type = $(helper.origin).find('input[type=hidden]').val(),
                    set_type = false;

                if ( type && xml_fields ){
                    var type_parts = type.split(':');
                    if ( xml_fields[type_parts[0]] ){
                        type = xml_fields[type_parts[0]][type_parts[1]];
                        set_type = !!type;
                    }
                }

                var content = $('<span/>',{'class':'xml-tooltip-param'}).html(
                    '<div><span class="tooltip-p2">' + $(helper.origin).data('value') +'</span></div>' +
                    (set_type ?
                        '<div><span class="tooltip-p1">'+xml_t.load_as+':</span> <span class="tooltip-p2">' + type + '</span></div>' : '')
                );
                instance.content(content);
            }
        });
    };

    Dialog.prototype.close = function(){
        if ( this.shown && this.dialog && this.dialog.length ){
            this.dialog.fadeOut(350, function(){
                call('#xml-dialog-overlay').remove();
            });
            this.shown = false;
            this.dialog.removeClass('activated');
            call('#xml-dialog form[name="xml-dialog-form"]').off();
            this.reset();
        }
        return this;
    };

    Dialog.prototype.reset = function(){
        if ( this.dialog && this.dialog.length ){
            this.dialog_content.html(this.preloader());
        }
        return this;
    };

    Dialog.prototype.reload = function(html, with_preloader){
        if ( this.dialog && this.dialog.length && this.dialog_content.length ){
            this.html = html ? html : this.html;

            if (with_preloader){
                this.dialog_content.html(this.preloader());
                $this = this;
                setTimeout(function(){
                    $this.dialog_content.html($this.html);
                    //$this.tooltips();
                }, 500);
            } else {
                this.dialog_content.html(this.html);
                //this.tooltips();
            }
        }

        return this;
    };

    Dialog.prototype.preloader = function(){
        return $('<div/>',{'class': 'xml-loader-wrap'});
    };

    $.xml = {
        init: function(){
            this.render();
            this.events();
            this.file.events();
            this.longAction();

            setTimeout(function(){
                $.xml.nav.hideDoesntFit();
            }, 330);
        },

        profileId: function(){
            var profile_id = call('#xml .profiles .tabs li.selected').data('id');
            return profile_id ? profile_id : 0;
        },

        render: function(){
            call(".iButton").iButton({
                enableDrag: true,
                labelOn: '',
                labelOff: '',
                className: 'mini'
            });

            call('#xml input[type=radio], #xml input[type=checkbox]').styler();

            var sv = call('#xml #slider-value'),
                svp = sv.parent(),
                _xml_slider_input =  sv.parent().find('input[type=hidden]'),
                _xml_slider = sv.closest('#xml-slider').find('.xml-slider');


            call('.xml-slider').slider({
                min: 1,
                max: 100,
                slide: function(ev, ui){
                    sv.html(ui.value);
                    _xml_slider_input.val(ui.value);
                },
                value: _xml_slider_input.val() || 40
            });

            event('change', '#xml #xml-slider input[type=checkbox]', function(){
                if ( $(this).prop('checked') ){
                    svp.fadeIn();
                    _xml_slider.fadeIn();
                } else {
                    svp.fadeOut();
                    _xml_slider.fadeOut();
                }
            });

            $('#xml .xml-pname-items').sortable();

            $.xml.file.init();
        },

        events: function(){

            event('submit' , '#xml form' , function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                var form = $(this);

                call('#save-status').html('<i class="icon16 loading"></i>');

                $.ajax({
                    type: form.attr('method'),
                    url:  form.attr('action'),
                    data: form.serialize(),
                    success: function(r){
                        if ( r.status == 'ok' ) {
                            var profile_name = call('#profile-name input[type=text]').val();

                            if ( profile_name ){
                                call('#xml .profiles .tabs li.selected a').html(profile_name);
                            }

                            call('#save-status').html('<i class="icon16 yes"></i> ' + xml_t.saved);
                        } else {
                            call('#save-status').html('<i class="icon16 no"></i> ' + xml_t.error);
                        }

                        setTimeout(function(){
                            call('#save-status').html('');
                        }, 1000);
                    }
                });
            });

            event('change', '#xml-auth input[type=checkbox]', function(e){
                e.preventDefault();

                var data_block = $(this).closest('.xml-auth').find('.xml-auth-data');

                if ( $(this).prop('checked') ){
                    data_block.show();
                } else {
                    data_block.hide();
                }
            });

            event('change', '#importCategs', function(){
                if ( $(this).prop('checked') ){
                    call('#category-settings').fadeIn();
                } else {
                    call('#category-settings').fadeOut();
                }
            });

            event('change', '#xml .xml-pnames input[type=radio]', function(){
                var self  = $(this),
                    block = self.closest('.value').find('.xml-pname-multi'),
                    value = parseInt(self.val());

                if ( value === 2 ){
                    block.show();
                } else {
                    block.hide();
                }
            });

            event('click', '#xml .xml-pname-multi .pname-update:not(.no-click)', function(){
                if ( $(this).hasClass('no-click') ){
                    return false;
                }

                var self   = $(this),
                    icon   = self.find(".icon16"),
                    parent = self.closest('.xml-pname-multi');

               icon.removeClass('update').addClass('loading no-click');

                $.ajax({
                    url: '?plugin=xml&module=product&action=names&profile_id=' + $.xml.profileId(),
                    success: function(r){
                        if ( r.status === 'ok' ){
                            if ( r.data.html ){
                                icon.removeClass('loading').addClass('yes');
                                parent.find('.xml-pnames-message').hide();
                                parent.find('.xml-pname-items').html(r.data.html).show();
                                $(document).find('#xml .xml-pname-items').sortable();
                            } else {
                                icon.removeClass('loading').addClass('no');
                                parent.find(".xml-pnames-message").show();
                                parent.find('.xml-pname-items').hide().html('');
                            }
                        } else {
                            icon.removeClass('loading').addClass('no');
                        }
                    }
               }).always(function(){
                   setTimeout(function(){
                        icon.removeClass('yes no loading no-click').addClass('update');
                   }, 1500);
                });
            });

            event('click', '#xml .profiles .tabs li.add-profile', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                var self = $(this);
                $.ajax({
                    type:    'POST',
                    url:     '?plugin=xml&module=profile&action=add',
                    success: function(r){
                        if ( r.status == 'ok' ){
                            var profile_id   = r.data.profile_id,
                                profile_name = r.data.name;

                            if ( profile_id ){
                                var tab_nav = '<li data-id="' + profile_id + '" class="selected" id="profile' + profile_id + '">' +
                                    '<a href="#/xml:' + profile_id + '/">' + profile_name + '</a>' +
                                    '</li>';

                                self.before(tab_nav);
                                $.xml.profile(profile_id);
                            }
                        }
                    }
                });
            });

            event('click', '#xml .profiles .tabs li:not(.add-profile)', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                var self = $(this);
                if ( self.hasClass('selected') ){
                    return false;
                }
                var profile_id = self.data('id');
                $.xml.profile(profile_id);
            });

            event('change', '#importform input[type=radio]', function(){
                $(this).parents('div.value').find('.checkedinput').removeClass();
                $(this).parent('label').addClass('checkedinput');
            });

            event('change', '#importform input[type=checkbox]:not(.no_highlight)', function(){
                var selector = $(this).hasClass('x') ? '.value-w' : 'div.value';

                if($(this).prop('checked')){
                    $(this).parents(selector).find('div').first().addClass('checkedinput');
                    $(this).parents(selector).find('.istrue').addClass('checkedinput');
                } else {
                    $(this).parents(selector).find('.checkedinput').removeClass('checkedinput');
                }
            });

            event('change', '#duplicate_as_child input[type=checkbox]', function(){
                if ( $(this).prop('checked') ){
                    call('#parent-category').show();
                } else {
                    call('#parent-category').hide();
                }
            });

            event('click', '#profile-content .delete-profile', function(){
                if ( confirm( xml_t.delete_profile + '?') ){
                    var profile_id = $(this).data('id');

                    $.ajax({
                        type: 'POST',
                        url:  '?plugin=xml&module=profile&action=delete',
                        data: { profile_id: profile_id },
                        success: function(r){
                            if ( r.status == 'ok' ){
                                var current = $('#profile' + profile_id),
                                    next    = current.next(':not(.no-tab)');

                                if ( !$(next).length ){
                                    next = current.prev();
                                }

                                current.fadeOut(150, function(){
                                    $(this).remove();
                                });

                                $.xml.profile(next.data('id'));
                            } else {
                                alert(xml_t.error_request);
                            }
                        }
                    });
                }
            });

            function _save(e){
                if ( e ){
                    e.preventDefault();
                    e.stopImmediatePropagation();
                }

                var formData = {}, _type, _key, _field, _i = 0,
                    send = function(d, reset){
                        reset  = typeof reset === 'undefined' ? 0 : reset;

                        if ( d ){
                            $.ajax({
                                type: 'POST',
                                async: false,
                                url: '?plugin=xml&module=snapshot&action=save',
                                data: {map: d, profile_id: $.xml.profileId(), reset: reset, preserve: 1},
                                success: function(){
                                    xml_dialog.close();
                                }
                            });
                        } else {
                            alert(xml_t.no_matches + '!');
                        }
                    };

                var i = 0, first = 1;
                call('#xml-dialog span.xml-item.ready:not(.disabled-tag):not(.xml-tag-fixed)').each(function(){
                    _type = $(this).data('type');

                    if (_type && $(this).data('key')){
                        _type = parseType(_type);
                        _key  = $(this).data('key');

                        formData[_key] = {
                            type: _type.original,
                            up: _type.up
                        };

                        i+=2;
                        if ( i >= max_inputs ){
                            send(formData, first);
                            formData = {};
                            first = 0;
                            i = 0;
                        }
                    }
                });

                if (formData){
                    send(formData, first);
                }
            }

            function minifyXML(reset, offset){
                offset = typeof offset === 'undefined' ? -1 : offset;
                $.ajax({
                    type : 'POST',
                    url  : '?plugin=xml&module=snapshot&action=make',
                    data : {'profile_id' : $.xml.profileId(), reset: reset, offset: offset},
                    success: function(r){
                        if ( r.status == 'ok' ){
                            if ( r.data.error ){
                                alert(r.data.error);
                            } else {
                                if ( r.data.html ){
                                    xml_dialog.reload(r.data.html, true).open();
                                } else {
                                    minifyXML(0, r.data.offset);
                                }
                            }
                        }
                    }
                });
            }

            function makeSnapshot(e){
                e.stopImmediatePropagation();

                if ( xml_dialog ){
                    xml_dialog.reset();
                }

                xml_dialog = new Dialog(false, true, {
                    title: xml_t.match_manager,
                    buttons: {
                        0: {
                            type: 'button',
                            'class': 'xml-dialog-reset',
                            icon: 'update',
                            title: xml_t.up_scheme
                        },

                        1: {
                            type: 'submit',
                            icon: 'yes',
                            class: '',
                            title: xml_t.save,
                        },

                        2: {
                            type: 'button',
                            icon: 'no',
                            class: 'xml-dialog-close',
                            title: xml_t.cancel
                        }
                    },

                    save: _save
                });

                minifyXML($(this).hasClass('xml-dialog-reset') ? 1 : 0, -1);
            }

            event('click', '#xml .make-snapshot', makeSnapshot);
            event('click', '#xml-dialog .xml-dialog-reset', makeSnapshot);

            var xml_info_busy = false;
            event('click', '#xml-dialog .xml-s-info .xml-s-info-title', function(){
                var parent  = $(this).parent(),
                    arrow   = $(this).find('.expand-icon'),
                    info   = $(parent).find('.xml-s-details');

                if (xml_info_busy){
                    return false;
                }

                xml_info_busy = true;
                if ( info.is(':visible') ){
                    info.slideUp(300,function(){
                        call('#xml-dialog .xml-tags-map').addClass('long-height');
                        xml_info_busy = false;
                    });
                } else {
                    call('#xml-dialog .xml-tags-map').removeClass('long-height');
                    info.slideDown(300, function(){
                        xml_info_busy = false;
                    });
                }

                var arr = $(arrow).attr('data-next-code');
                $(arrow).attr('data-next-code', $(arrow).html());
                $(arrow).html(arr);
            });

            event('click', '#xml-dialog .xml-dialog-close', function(){
                if ( xml_dialog ){
                    xml_dialog.close();
                    xml_dialog = null;
                }
            });

            event('click', '#xml-dialog .xml-dialog-cancel', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();
                if ( xml_dialog ){
                    xml_dialog.close();
                    xml_dialog = null;
                }
            });

            event('click', '#xml-dialog .xml-s-row .xml-item:not(.xml-tag-fixed):not(.disabled-tag)', function(e){
                e.stopImmediatePropagation();
                e.preventDefault();

                var self   = $(this),
                    parent = self.parent(),
                    clone  = self.clone(),
                    ovrl   = '<div class="xml-tags-overlay"></div>',
                    list   = call('#xml-dialog .xml-tags-list'),
                    ext_type;

                $(this).addClass('selected');

                list.append(ovrl);
                clone.addClass('xml-tag-fixed').css({
                    left: ((self.offset().left - self.parent().offsetParent().offset().left)) + 'px',
                    top: ((self.offset().top - self.parent().offsetParent().offset().top) - 2) + 'px'
                }).appendTo(parent.parent());

                var item_type     = call('#xml-dialog .xml-item-type'),
                    item_type_sel = item_type.find('select[name=item_type]'),
                    param_type    = self.data('type');

                if ( param_type == '0' ){
                    param_type = null;
                }

                if ( param_type ){

                    var _type = param_type.split('#');

                    if ( _type.length > 1 ){
                        var multi_item, item_set, multi_list = item_type.find('.multi-list');
                        for ( var i in _type ){
                            var t = _type[i];
                            item_set = parseType(t);
                            multi_item = '<span class="multi-item" data-type="'+ t +'"> ' + xml_fields[item_set.primary][item_set.secondary] + '<i class="icon10 delete"></i></span>';
                            multi_list.append(multi_item);
                        }
                        param_type = _type[0];
                    }

                    ext_type   = parseType(param_type);
                    item_type_sel.find('option[value="' + ext_type.key + '"]').prop('selected',true);

                    if ( (ext_type.primary == 'feature') && (ext_type.secondary == 'exists') ){
                        var feature_value,
                            block_id    = ext_type.secondary == 'exists' ? 'f-existing' : 'f-new',
                            feature_key = (feature_value = ext_type.feature_id) ? 'feature_id' : ((feature_value= ext_type.feature_type) ? 'feature_type' : null);

                        item_type.find('.feature-settings').fadeIn();
                        item_type.find('#' + block_id).fadeIn();

                        if ( feature_key && feature_value ){
                            item_type.find('select[name=' + feature_key + '] option[value=' + feature_value + ']').prop('selected', true);
                        }

                        call('#create_sku input[type=checkbox]').prop('checked', ext_type.multiple);
                    } else {
                        item_type.find('.f-settings-item').hide();
                        item_type.find('.feature-settings').hide();
                    }

                    item_type.find('.xml-type-options input[type=checkbox][name=up]').prop('checked', ext_type.up);
                } else {
                    item_type_sel.find('option:selected').prop('selected', false);
                    item_type.find('.f-settings-item').hide();
                    item_type.find('.feature-settings').hide();
                    item_type.find('.xml-type-options input[type=checkbox][name=up]').prop('checked', true);
                }

                if ( (ext_type && ext_type.multiple) || isMultipleSelected() ){
                    call('#create_sku').show();
                } else {
                    call('#create_sku').hide();
                }

                var features_block = call('#f-existing');
                if ( param_type.indexOf('feature:') > -1 ){
                    features_block.fadeIn();
                } else if ( features_block.is(':visible') ) {
                    features_block.fadeOut();
                }

                item_type_top = ((self.offset().top - self.parent().offsetParent().offset().top) - 2);

                if ( item_type_top <= item_type.outerHeight() ){
                    item_type_top += self.outerHeight() + 5;
                } else {
                    item_type_top -=  item_type.outerHeight();
                }

                var _key = self.data('key').split(':'),
                    tag  = _key[1];

                if ( self.hasClass('tag') && (tag === 'param') ){
                    item_type_sel.find('option[value="feature:auto"]').css('display', 'block');
                } else {
                    item_type_sel.find('option[value="feature:auto"]').css('display', 'none');
                }

                var item_type_left = ((self.offset().left - self.parent().offsetParent().offset().left));

                item_type_left -= (item_type.outerWidth() - self.outerWidth())/2;

                if ( item_type_left > item_type.outerWidth() ){
                    item_type_left -= item_type.outerWidth() - item_type_left;
                }

                if ( item_type_left < item_type.offsetParent().offset().left ){
                    item_type_left = item_type.offsetParent().offset().left + 10;
                } else if ( (item_type_left + item_type.outerWidth())  > (item_type.offsetParent().offset().left + item_type.parent().outerWidth()) ){
                    item_type_left = (item_type.offsetParent().offset().left + item_type.parent().outerWidth()) - item_type.outerWidth();
                }

                item_type.css({
                    top: item_type_top + 'px',
                    left: item_type_left + 'px'
                }).appendTo(parent.parent()).fadeIn();
            });

            event('click', '#xml-dialog .end-tag', function(e){
                e.stopImmediatePropagation();
                $(this).closest('.xml-s-row').find('.xml-item.tag').first().click();
            });

            function collectType(value){
                value = value == '0' ? null : value;

                if ( value && (value.indexOf('feature:') !== -1) ){
                    var type_parts   = value.split(':'),
                        feature_mode = type_parts[1];

                    switch ( feature_mode ){
                        case 'exists':
                            var feature_id = call('#f-existing select[name=feature_id]').val();

                            if ( !feature_id ){
                                alert(  xml_t.no_feature + '!');
                                return false;
                            }

                            value += ':' + feature_id;

                            var create_sku = call('#create_sku');
                            if ( $(create_sku).is(':visible') && $(create_sku).find('input[type=checkbox]').prop('checked') ){
                                value += ':+';
                            }

                            break;

                        case 'new':
                            var feature_type_wrp = call('#f-new'),
                                feature_type     = feature_type_wrp.find('select[name="feature_type"]').val();

                            if ( !feature_type ){
                                alert('Необходимо выбрать тип характеристики!');
                                return false;
                            }

                            value += ':' + feature_type;
                            break;
                    }
                }

                if ( value && !call('.xml-type-options input[name=up]').prop('checked') ) {
                    value += '|1';
                }

                return value;
            }

            event('click', '#xml-dialog .xml-type-actions .type-action', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                if ( $(this).hasClass('type-save') ){
                    var type_wrap = $(this).closest('.xml-item-type'),
                        value     = type_wrap.find('select').val();

                    var items;
                    if ( (items = type_wrap.find('.multi-list .multi-item')).length ){
                        var _value = [];
                        items.each(function(){
                            if ( $(this).data('type') ){
                                _value.push($(this).data('type'))
                            }
                        });
                        if ( _value.length ){
                            value = _value.join('#');
                        }
                    } else {
                        value = collectType(value);
                    }

                    var selected = call('#xml-dialog .xml-item.selected');
                    if ( value ){
                        $(selected).addClass('ready').data('type', value).attr('data-type', value);

                        if ( $(selected).hasClass('tag') ){
                            $(selected).closest('.xml-s-row').addClass('tag-ready');
                        }
                    } else {
                        $(selected).removeClass('ready').data('type', '');

                        if ( $(selected).hasClass('tag') ){
                            $(selected).closest('.xml-s-row').removeClass('tag-ready');
                        }
                    }
                }

                call('.xml-item-type').fadeOut(300, function(){
                    call('#xml-dialog .xml-tag-fixed').remove();
                    call('.xml-tags-overlay').remove();
                    call('#xml-dialog .xml-item.selected').removeClass('selected');
                    call('#xml-dialog .multi-list').empty();
                });
            });

            function findTypeByVal(val){

                var multi = call('#xml-dialog .multi-list');
                var _v = val.replace('|1','').replace('+','');

                return multi.find('.multi-item[data-type*="'+_v+'"]');


                if ( val.indexOf('|1') > -1 ){
                    var _val = val.replace('|1','');
                } else {
                    var _val = val + '|1';
                }

                var multi = call('#xml-dialog .multi-list'),
                    item  = multi.find('.multi-item[data-type="' + _val + '"]');

                return $(item).length ? item : multi.find('.multi-item[data-type="' + val + '"]');
            }

            event('click', '#xml-dialog .type-multi-add', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                var self = $(this),
                    sel  = self.closest('.xml-item-type').find('select[name=item_type]'),
                    text = sel.find("option:selected").text(),
                    val  = sel.val();

                if ( text && val ){
                    var multi = self.closest('.xml-item-type').find('.multi-list');
                    val = collectType(val);

                    var type = $(findTypeByVal(val));
                    if ( !type.length ){
                        item = '<span class="multi-item" data-type="'+ val +'"> ' + text + '<i class="icon10 delete"></i></span>';
                        multi.append(item);
                    } else {
                        type.data('type', val);
                    }
                }
            });

            event('click', '#xml-dialog .multi-list .multi-item', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                var self     = $(this),
                    type     = parseType(self.data('type')),
                    itemType = $(this).closest('.xml-item-type');

                itemType.find('select[name=item_type] option[value="'+type.key+'"]').prop('selected', true);
                itemType.find('input[name="up"]').prop('checked', type.up);

                if ( (type.key === 'feature:exists') && type.feature_id ){
                    var set = itemType.find('.feature-settings'),
                        setSel = set.find('select[name=feature_id]');

                    setSel.find('option[value='+type.feature_id+']').prop('selected', true);
                    call('#xml-dialog .feature-settings').fadeIn(150);
                    call('#f-existing').show();

                    if (isMultipleSelected()){
                        call('#create_sku').show();
                        call('#create_sku input').prop('checked', !!type.multiple);
                    } else {
                        call('#create_sku').hide();
                    }

                } else {
                    call('#xml-dialog .feature-settings').hide();
                    call('#create_sku').hide();
                }
            });

            function showCreateSku(){
                if ( isMultipleSelected() ){
                    call('#create_sku').show();
                } else {
                    call('#create_sku').hide();
                }
            }

            function isMultipleSelected(){
                return call('#f-existing').find('option:selected').data('multiple') && (call('.xml-item-type select[name=item_type]').val() === 'feature:exists');
            }

            event('change', '#xml-dialog form .xml-item-type select[name=item_type]', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                if ( $(this).val() == 'feature:exists' ){
                    call('#xml-dialog .feature-settings').fadeIn();
                    call('#f-new').hide();
                    call('#f-existing').show();
                    showCreateSku();

                } else if ( $(this).val() == 'feature:new' ) {
                    call('#xml-dialog .feature-settings').fadeIn();
                    call('#f-new').css('display', 'inline-block');
                    call('#f-existing').hide();
                    call('#create_sku').hide();
                } else {
                    call('#xml-dialog .feature-settings').fadeOut();
                    call('#create_sku').hide();
                }
            });

            event('change', '#f-existing select', function(){
                var ex = call('#f-existing');

                var op = ex.find('option:selected').data('multiple');
                if ( op ){
                    call('#create_sku').show();
                } else {
                    call('#create_sku').hide();
                }
            });

            event('click', '#xml-dialog .multi-list .multi-item .icon10.delete', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                if ( confirm( xml_t.delete_item_type + '?') ){
                    $(this).parent().fadeOut(300, function(){
                        $(this).remove();
                    });
                }
            });

            event('change', '#xml-dialog #f-new .product-type-all input[type=checkbox]', function(){
                var item_block  = $(this).closest('.settings-item-block'),
                    other_types = item_block.find('.product-type-other');

                if ( ($(this).val() == '0') && $(this).prop('checked') ){
                    other_types.find('input[type=checkbox]:checked').prop('checked', false);
                    other_types.hide();
                } else if($(this).val() == '0'){
                    other_types.show();
                    other_types.find('input[type=checkbox]:first').prop('checked',true);
                }
            });

            event('change', '#xml #enforce-protocol input[type=checkbox]', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();
                var option = call('#enforce-protocol .enforce-option');

                if ( $(this).prop('checked') ){
                    option.show();
                } else {
                    option.hide();
                }
            });

            event('change', '#xml .xml-markup .xml-markup-types input[type=radio]', function(e){
                e.stopImmediatePropagation();
                var item = $(this).closest('label');

                call('.xml-markup-content .xml-markup-tab').hide();
                if ( $(item).data('id') ){
                    call('#xml-markup-' + $(item).data('id')).show();
                }
            });

            event('click', '#xml-markup-stepped .stepped-markup-add', function(e){
                e.preventDefault();

                var stepped   = call('#xml-markup-stepped'),
                    empty_row = stepped.find('.xml-stepped-row.empty'),
                    id        = call('.xml-stepped-row:not(.empty):not(#stepped-template):not(.step-default)').length;

                if ( $(empty_row).length ){
                    $(empty_row).hide();
                }

                if ( !id ){
                    id = 0;
                } else {
                    var _id = call('.xml-stepped-row:not(.empty):not(#stepped-template):not(.step-default)').last().data('id');
                    if ( _id ){
                        id = parseInt(_id)+1;
                    }
                }

                stepped.find('.step-default').show();

                var template = call('#stepped-template').clone();
                template.find('input,select').each(function(){
                    $(this).attr('name', 'stepped_markup[' + id + '][' + $(this).data('key') + ']');
                });

                template.data('id',id).attr('id', '').addClass('new').insertBefore(stepped.find('.step-default')).show();
            });

            event('click', '.xml-markup .markup-delete', function(e){
                e.preventDefault();

                if (confirm('Удалить правило?')){
                    var row = $(this).closest('.xml-stepped-row'),
                        body = $(this).closest('.xml-stepped-body');

                    function remove(){
                        if ( !(body.find('.xml-stepped-row:not(.step-default):not(.empty)').length) ){
                            body.find(".step-default").hide();
                            body.find('.empty').show();
                        }
                    }

                    if ( !$(row).hasClass('new') ){
                        $.ajax({
                            type: 'POST',
                            url: '?plugin=xml&module=markup&action=delete',
                            data: {profile_id: $.xml.profileId(), row_id: $(row).data('id')},
                            success: function(){
                                $(row).remove();
                                remove();
                            }
                        });
                    } else {
                        $(row).remove();
                        remove();
                    }
                }
            });

            event('click', '#xml #match-categories .button', function(e){
                e.stopImmediatePropagation();

                var self   = $(this),
                    parent = self.parent(),
                    loader = parent.find(".icon16");

                if ( !$(loader).length ){
                    loader = $('<i/>', {
                        'class': 'icon16 loading'
                    });
                    parent.append(loader);
                }

                $.ajax({
                    type: 'POST',
                    url: '?plugin=xml&module=matching&action=categories',
                    data: {profile_id: $.xml.profileId(), reset: self.data('reset')},
                    success: function(r){
                        if ( r.status === 'ok' ){
                            if ( r.data.html ){
                                xml_dialog = new Dialog(r.data.html, true, {
                                    title: 'Мастер сопоставления категорий',
                                    buttons: {
                                        0: {
                                            type: 'button',
                                            icon: 'update',
                                            class: 'xml-categ-update',
                                            title: 'Обновить структуру категорий'
                                        },
                                        1: {
                                            type: 'button',
                                            class: 'xml-dialog-close',
                                            icon: 'no',
                                            title: 'Закрыть'
                                        }
                                    },
                                    save: _save
                                });
                            }
                        }
                        loader.remove();
                    }
                });
            });

            event('click', '#xml-dialog #match-categs .xml-category-tree .category-name.has_children', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                var arrow = $(this).find('.category-arr .icon16');

                $(this).parent().find('ul.xml-category-tree:first').slideToggle(200, function(){
                    if ( $(this).is(':visible') ){
                        arrow.removeClass('darr').addClass('uarr');
                    } else {
                        arrow.removeClass('uarr').addClass('darr');
                    }
                });
            });

            event('change', '#allowCategMap', function(){
                if ( $(this).prop('checked') ){
                    call('#match-categories').fadeIn();
                } else {
                    call('#match-categories').fadeOut();
                }
            });

            event('click', '#xml-dialog #match-categs .js-cat-name', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                var self = $(this),
                    m    = $(document).find('#match-categs'),
                    local_wrap = m.find('.local-tree-wrap'),
                    parent     = self.parent();

                if ( _cache.file_category ){
                    _cache.file_category.removeClass('selected');
                }

                _cache.file_category = self.closest('li');
                _cache.file_category.addClass('selected');
                m.addClass('matching');

                if ( !$(local_wrap).length ){
                    local_wrap = $('<div class="local-tree-wrap"></div>');
                    m.append(local_wrap);
                }

                local_wrap.html('<i class="icon16 loading"></i>');

                call('#xml-dialog').addClass('activated');

                $.ajax({
                    type: 'POST',
                    url: '?plugin=xml&module=matching&action=localTree',
                    data: {
                        profile_id: $.xml.profileId(),
                        foreign_category: {
                            id: parent.data('id'),
                            parent_id: parent.data('parent-id'),
                            name: self.text()
                        }
                    },

                    success: function(r){
                        if ( r.status == 'ok' ){
                            if ( r.data.html ){
                                local_wrap.html(r.data.html);

                                var selected = local_wrap.find('#xml-selected-local').val(),
                                    e;

                                if ( selected && (e = call('#xml-category-' + selected)).length ){
                                    _cache.selected_local = e;
                                }
                            }
                        } else {
                            alert(xml_t.bad_request);
                        }
                    }
                });
            });

            event('click', '#xml-dialog .local-tree-wrap .s-product-list', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                var li   = $(this).closest('li'),
                    ul   = li.children('.menu-v'),
                    item = _cache.file_category.children('.category-name');

                if ( !$(ul).length ){
                    $.ajax({
                        type: 'POST',
                        url: '?plugin=xml&module=matching&action=localTree',
                        data: {
                            profile_id: $.xml.profileId(),
                            local_id: $(li).data('id'),
                            depth: parseInt($(li).data('depth'))+1,
                            no_foreign: 1,
                            foreign_category: {
                                id: item.data('id'),
                                parent_id: item.data('parent-id')
                            }
                        },
                        success: function(r){
                            if ( r.status == 'ok' ){
                                if ( r.data.html ){
                                    $(li).append(r.data.html);
                                } else {
                                    alert('Подкатегории не найдены');
                                }
                            } else {
                                alert('Не удалось получить подкатегории');
                            }
                        }
                    });
                } else {
                    ul.slideToggle();
                }
            });

            event('click', '#xml-dialog .local-tree-wrap .s-product-list .name', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                var categm   = call('#match-categs'),
                    options  = $(categm).find('.match-options'),
                    ovr      = '<div class="ovrlay"></div>';

                if ( _cache.selected_local ){
                    _cache.selected_local.removeClass('matched selected');
                }

                _cache.local_category = $(this).closest('li');
                _cache.local_category.addClass('selected');

                var option_value = _cache.local_category.data('mode') || 1;
                options.find('input[type=radio][value='+ option_value +']').prop('checked', true);

                call('#xml-dialog .xml-dialog-inner .xml-dialog-content').append(ovr);
                options.fadeIn();
            });

            event('click', '#xml-dialog .local-tree-wrap .foreign-category .back', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                $(this).closest('.local-tree-wrap').fadeOut(200, function(){
                    $(this).remove();
                    if ( _cache.file_category ){
                        _cache.file_category.removeClass('selected');
                        _cache.file_category = null;
                    } else {
                        call('#match-categs .match-sides .xml-category-tree.first li.selected').removeClass('selected');
                    }

                    if ( _cache.local_category ){
                        _cache.local_category = null;
                    }

                    if ( _cache.selected_local ){
                        _cache.selected_local = null;
                    }

                    call('#xml-dialog').removeClass('activated');
                    call('#match-categs').removeClass('matching');
                });
            });

            event('click', '#xml-dialog .match-options .button.match-type', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                var self = $(this),
                    param = call('#xml-dialog .match-options-in input[type=radio]:checked'),
                    file_categ_name = _cache.file_category.children('.category-name');

                if ( $(param).length && $(_cache.local_category).length ){
                    $.ajax({
                        type: 'post',
                        url: '?plugin=xml&module=matching&action=set',
                        data: {
                            profile_id: $.xml.profileId(),
                            foreign_id: file_categ_name.data('id'),
                            local_id:   _cache.local_category.data('id'),
                            mode:       $(param).val(),
                            ids:        $.xml.getCategoryIds()
                        },
                        success: function(r){
                            if ( r.status === 'ok' ){
                                if ( $(param).val()  === '0' ){
                                    _cache.local_category.removeClass('selected matched');
                                    _cache.local_category.removeAttr('data-mode');
                                    if ( _cache.selected_local ){
                                        _cache.selected_local.addClass('matched');
                                    }
                                } else {
                                    if ( _cache.selected_local ){
                                        _cache.selected_local.removeClass('selected matched');
                                    }
                                    _cache.selected_local = _cache.local_category;
                                    _cache.local_category.data('mode', $(param).val());

                                    call('#xml-selected-local').val(_cache.local_category.data('id'));

                                    _cache.local_category.removeClass('selected').addClass('matched');
                                    _cache.file_category.removeClass('selected').addClass('matched');
                                }

                                var options = self.closest('.match-options');
                                options.fadeOut();
                                options.closest('.xml-dialog-content').find('.ovrlay').remove();
                            } else {
                                alert(xml_t.cannot_save);
                            }
                        }
                    });
                } else {
                    alert(xml_t.select_option);
                }
            });

            event('click', '#xml-dialog .match-options .mo-close', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                var options = $(this).closest('.match-options');

                options.fadeOut();
                options.closest('.xml-dialog-content').find('.ovrlay').remove();
                _cache.local_category.removeClass('selected');
                _cache.local_category = null;

                if ( _cache.selected_local ){
                    _cache.selected_local.addClass('matched');
                }
            });

            event('click', '#xml-dialog .xml-categ-update', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                xml_dialog.reset();
                var b = call('#match-categories .button');
                b.data('reset',1);
                b.click();
            });

            event('mouseenter', '.xml-item.tag, .end-tag',function(){
                $(this).closest('.xml-s-row').addClass('highlight-tag');
            });

            event('mouseleave', '.xml-item.tag, .end-tag',function(){
                $(this).closest('.xml-s-row').removeClass('highlight-tag');
            });

            event('click', '#xml .session .session-remove', function(e){
                e.stopImmediatePropagation();

                if ( confirm(xml_t.delete_session + '?') ){
                    $.ajax({
                        type: 'POST',
                        url: '?plugin=xml&module=session&action=unset',
                        data: {profile_id: $.xml.profileId()},
                        success: function(r){
                            if ( r.status == 'ok' ){
                                call('#xml .session').fadeOut(200, function(){
                                    $(this).remove();
                                });
                            } else {
                                alert(xml_t.error_occurred);
                            }
                        }
                    });
                }
            });

            event('change', '#xml #mark-with-feature select', function(){
                if ( $(this).val() == '0' ){
                    $(this).parent().find('input[type=text]').hide();
                } else {
                    $(this).parent().find('input[type=text]').show();
                }
            });

            function right(){
                var profiles = $('#xml .profiles ul'),l;

                if ( (l = profiles.find('li:not(.no-tab):visible:last').next()).length){
                    if ( !l.hasClass('no-tab') ){
                        $('#xml .profiles ul li:not(.no-tab):visible:first').hide();
                        l.show();
                    } else {
                        l = null
                    }
                }

                if ( $(l).length && $(l).next().length && !$(l).next().hasClass('no-tab') ){
                    return true;
                }

                return false;
            }

            function left(){
                var profiles = $('#xml .profiles ul'),f;

                if ( (f = profiles.find('li:not(.no-tab):visible:first').prev()).length ){
                    $('#xml .profiles ul li:not(.no-tab):visible:last').hide();
                    f.show();
                }

                if ( $(f).length && $(f).prev().length ){
                    return true;
                }

                return false;
            }
            event('click', '#xml .profiles .profile-nav .profile-nav-button', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                switch ( $(this).data('direction') ){
                    case 'left':
                        left();
                        break;

                    case 'right':
                        right();
                        break;

                }

            });

            // Hide profile tabs that doesn't fit
            $(window).resize(function(){
                $.xml.nav.hideDoesntFit();
            });
        },

        profile: function(profile_id, in_background){
            var profile_content = $(document).find("#profile-content"),
                form            = profile_content.find('form'),
                loader          = '<i class="icon16 loading"></i>',
                tabs            = $(document).find('#xml .profiles'),
                in_background   = !!in_background;

            tabs.find('.selected').removeClass('selected');

            if ( !in_background ){
                form.css('opacity', 0);
                profile_content.prepend(loader);
            }

            var tab_selector = '#' + (profile_id ? 'profile' + profile_id : 'default-profile');
            $(document).find(tab_selector).addClass('selected');

            $.ajax({
                type: 'POST',
                url:  '?plugin=xml&module=backend&action=setup',
                data: { profile: profile_id },
                success: function(r){
                    if ( !in_background ){
                        $('#profile-content .icon16.loading').remove();
                    }

                    if ( r ){
                        $('#profile-content').html($(r).find('#profile-content').html());
                        $.xml.render();
                    }
                }
            });
        },

        getCategoryIds: function(){
            if ( _cache.file_category ){
                var res  = [],
                    elem = _cache.file_category.children('.xml-category-tree');

                if ( $(elem).length ){
                    $(elem).find('.category-name:not(.has_children)').each(function(){
                        res.push($(this).data('id'));
                    });
                }

                return res;
            }

            return null;
        },

        nav: {
            isSplitted: function(){
                if ( $.xml.nav.realWidth() < $.xml.nav.width() ){
                    return false;
                } else {
                    return true;
                }
            },

            realWidth: function(){
                var vv = 0;
                call('#xml .profiles ul li').each(function(){
                    vv += $(this).outerWidth();
                });

                return vv;
            },

            width: function(){
                return call('#xml .profiles ul').outerWidth() - (call('#xml .profiles ul li.add-profile').outerWidth() + 40);
            },

            hideDoesntFit: function(){
                var vv = 0,
                    w  = $.xml.nav.width();

                call('#xml .profiles ul li:not(.add-profile)').each(function(){
                    vv += $(this).outerWidth();
                    if ( vv < w ){
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                if ( $.xml.nav.isSplitted() ){
                    call('#xml .profile-nav').show();
                } else {
                    call('#xml .profile-nav').hide();
                }
            }
        },

        file: {
            init: function(){
                var source_file = call('#local-source-file');
                source_file.fileupload({
                    url: '?plugin=xml&module=upload',
                    sequentialUploads: true,
                    dropZone: null,
                    start: function () {
                        call('.sources .source-tab.local .progress').fadeIn();
                    },

                    progress: function (e, data) {
                        var $progress = call('.sources .source-tab.local .progress .progress-bar');
                        $progress.css('width', Math.round((100 * data.loaded / data.total), 0) + '%');
                    },

                    done: function (e, data) {

                        if (data.files && data.files[0] ){

                            var file = data.files[0];

                            if ( file.name ){
                                call('#xml .sources .local .server-col.right').show();
                                var n = file.name.toString().substring(0,35);

                                if ( n.length < file.name.length ){
                                    n += '..';
                                }

                                call('#xml .sources .local .server-file-name').html(n).attr('title', file.name);

                                call('#xml .sources .local .server-file-size').html(formatSize(file.size));
                            }
                        } else {
                            alert(xml_t.not_uploaded);
                        }

                        call('.sources .source-tab.local .progress').hide().find('.progress-bar').css('width',0);
                    },

                    fail: function(e, data){
                        console.log('ok', data);
                    },

                    formData: {
                        profile_id: $.xml.profileId(),
                        _csrf: _csrf
                    }
                });

                return this;
            },
            events: function(){

                event('click', '#xml .sources .sources-head .sh-col', function(){
                    var type = $(this).data('type'),
                        stabs = $(this).closest('.sources').find('.source-tabs');

                    if ( type ){
                        $(this).parent().find('.active').removeClass('active');
                        $(this).addClass('active');

                         stabs.find('.source-tab.active').removeClass('active');
                         stabs.find('.source-tab.' + type).addClass('active');
                         $(this).parent().find('input[type=hidden]').val(type);

                        $.ajax({
                            type: 'POST',
                            url: '?plugin=xml&module=set&action=config',
                            data: {profile_id: $.xml.profileId(), config_key: 'source_type', config_value: type}
                        });
                    }
                });


                var scan = function(data){
                    xml_dialog = new Dialog(false, true, {
                            title: xml_t.file_manager,
                            buttons: {
                                0: {
                                    type: 'button',
                                    'class': 'xml-filemngr-update',
                                    icon: 'update',
                                    title: xml_t.update
                                },

                                1: {
                                    type: 'submit',
                                    icon: 'yes',
                                    class: '',
                                    title: xml_t.save
                                },

                                2: {
                                    type: 'button',
                                    icon: 'no',
                                    class: 'xml-dialog-close',
                                    title: xml_t.close,
                                }
                            },
                            save: function(e){
                                e.preventDefault();

                                var form = call('#xml-dialog .xml-dialog-inner > form[name=xml-dialog-form]'),
                                    path = form.find('.selected-file').data('path'),
                                    file_name = form.find('.selected-file').data('name');

                                if ( !path || !file_name ){
                                    alert(xml_t.select_file);
                                    return false;
                                }

                                $.ajax({
                                    type: 'POST',
                                    url: '?plugin=xml&module=filemng&action=save',
                                    data: {file: path + '/' + file_name, profile_id: $.xml.profileId()},
                                    success: function(r){
                                        if ( r.status == 'ok' ){

                                            var info_block = call('.sources .source-tab.server .server-col.right');

                                            info_block.find('.server-file.path').html(path);
                                            info_block.find('.server-file.file .server-file-name').html(file_name);
                                            info_block.show();
                                        } else {
                                            alert(xml_t.save_error);
                                        }

                                        xml_dialog.close();
                                    }
                                });

                            }
                        });

                    $.ajax({
                        type: 'POST',
                        url: '?plugin=xml&module=filemng&action=scan',
                        data: data,
                        success: function(r){
                            if ( r.status == 'ok' ){
                                if ( r.data.html ){
                                    xml_dialog.reload(r.data.html,true).open();
                                } else {
                                    alert(xml_t.error);
                                    xml_dialog.close();
                                }
                            } else {
                                alert(xml_t.error);
                                xml_dialog.close();
                            }
                        }
                    });
                };

                event('click', '.sources .server-col.right .xml-file-delete', function () {
                    var $this = $(this),
                        col   = $this.closest('.server-col');

                    if ( confirm(xml_t.delete_file + '?') ){
                        $.ajax({
                            type: 'POST',
                            url: '?plugin=xml&module=filemng&action=delete',
                            data: {profile_id: $.xml.profileId(), type: $(col).closest('.sources').find('> .sources-head .sh-col.active').data('type')},
                            success: function(r){
                                if ( r.status == 'ok' ){
                                    col.slideUp();
                                    col.find('.server-file-name,.server-file-size, .server-file.path').html('');
                                    col.find('input[name="settings[server.file]"]').val('');
                                } else {
                                    alert(xml_t.delete_failed);
                                }
                            }
                        });
                    }
                });

                event('click', '#xml .sources .source-tab.server.active .button', function(e){
                    e.stopImmediatePropagation();
                    e.preventDefault();

                    scan({profile_id: $.xml.profileId()});
                });

                event('click', '.xml-file-manager .file.dir a', function(e){
                    e.preventDefault();
                    scan({profile_id: $.xml.profileId(), root_path: $(this).parent().data('path')});
                });

                event('click', '.xml-file-manager .back', function(e){
                    e.preventDefault();

                    if ( $(this).data('path') ){
                        scan({profile_id: $.xml.profileId(), root_path: $(this).data('path')});
                    }
                });

                event('click', '.xml-file-manager .file:not(.dir)', function(e){
                    e.preventDefault();

                    var parent = $(this).closest('.xml-file-manager');

                    parent.find('.file:not(.dir).selected').removeClass('selected');
                    $(this).closest('.file').addClass('selected');

                    var $this = $(this),
                        file_name = $this.data('file'),
                        full_path = $this.data('path'),
                        fpath_no_file = call('#xml-dialog .root-path').text(),
                        selected = parent.find('.xml-filmng-head .selected-file');

                    selected.html(file_name).data('name', file_name).data('path', fpath_no_file).show();
                });

                event('click', '#xml-dialog .xml-filemngr-update', function(e){
                    e.preventDefault();

                    var path = $(this).closest('.xml-dialog-inner').find('.xml-file-manager .xml-filmng-head .root-path').text();
                    if ( path ){
                        scan({profile_id: $.xml.profileId(), root_path: path});
                    }
                });

                event('click', '#xml-dialog .selected-file', function(){
                    var path = $(this).data('path');
                    if ( path ){
                        scan({profile_id: $.xml.profileId(),root_path: path});
                    }
                });

                event('click', '#xml-dialog .xml-row-expand', function(){
                    var parent = $(this).parent();

                    if ( !parent.hasClass('expanded') ){
                        parent.css('height', 'auto').addClass('expanded');
                    } else {
                        parent.css('height', '30px').removeClass('expanded');
                    }
                });

            }
        },

        longAction: function(){
            var $this  = this,
                abort  = false,
                toggle = function( form, state ){
                    form.find('input:not(.iButton),button,select').prop('disabled', state);
                    call('.iButton').iButton('disable', state);
                };

            $(document).on('click' , '#xml-start-sync' , function(e){
                e.preventDefault();
                e.stopImmediatePropagation();
                $(document).find('#xml-pre-sync').click();
                toggle(call('#xml form'), true);
                startSync();
            });

            $(document).on('click', '#xml-cancel', function(){

            });

            function startSync(){
                var progressBar = $('#progressbar'),
                    progressIn  = progressBar.find('.progressbar-inner'),
                    report      = $('#report'),
                    form        = $('#xml form');

                progressBar.show();
                progressBar.find('.progressbar').show();
                report.children().remove();
                report.hide();

                progressBar.find('.errormsg').html('');

                var url   = '?plugin=xml&module=sync&action=run',
                    pull  = [], processId,
                    profile_id = $.xml.profileId(),
                    step  = function (delay, response) {
                        delay = delay || 2000;
                        var timer_id = setTimeout(function () {
                            $.post(
                                url,
                                {processId: response ? response.processId || processId : processId},
                                function (r) {
                                    if (!r) {
                                        step(3000);
                                    } else if (r && r.ready) {
                                        $(progressIn).animate({
                                            'width' : '100%'
                                        });

                                        progressBar.find('.progressbar-description').text('100%');

                                        $.post(url, {processId: response ? response.processId || processId : processId, cleanup: 1}, function (r) {
                                            if (r.report) {
                                                setTimeout(function () {
                                                    progressBar.hide();
                                                    report.show();
                                                    if (r.report) {
                                                        report.html(r.report);
                                                    }

                                                    toggle(form , false);
                                                }, 1000);
                                            }
                                        }, 'json');
                                    } else if (r && r.error) {
                                        progressBar.find('.errormsg').html(r.error);
                                        toggle(form , false);
                                    } else {
                                        if (r && r.progress) {
                                            var progress = parseFloat(r.progress);
                                            $(progressIn).animate({
                                                'width': progress + '%'
                                            });

                                            if (r.stageLabel) {
                                                progressBar.find('.stage_label').show().html(r.stageLabel);
                                            } else {
                                                progressBar.find('.stage_label').hide();
                                            }

                                            progressBar.find('.progressbar-description').text(r.progress);
                                        }

                                        if (r && r.warning) {
                                            progressBar.find('.progressbar-description').append('<i class="icon16 exclamation"></i><p>' + r.warning + '</p>');
                                        }

                                        step(2500, r);
                                    }
                                },
                                'json'
                            ).error(function () {
                                step(3000);
                            });
                        }, delay);

                        pull.push(timer_id);
                    };

                $.post(url, {profile_id: profile_id}, function (r) {
                    if (r && r.processId) {
                        processId = r.processId;
                        step(3000, r);
                        step(2000, r);
                    } else if (r && r.error) {
                        progressBar.find('.errormsg').text(r.error);
                        toggle(form, false);
                    } else {
                        progressBar.find('.errormsg').text(xml_t.server_error);
                        toggle(form, false);
                    }
                }, 'json').error(function(){
                    progressBar.find('.errormsg').text(xml_t.server_error);
                    toggle(form, false);
                });
            }

        }
    };

    $.xml.init();

})(jQuery);