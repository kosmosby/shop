<?php

class shopRevolutionsliderPlugin extends shopPlugin {
    public function frontendHead() {
        $active_app = wa()->getApp();
        if($active_app == 'shop') {
            $plugin = wa()->getPlugin('revolutionslider');
            if ($plugin && $plugin->getSettings('status')) {
                $this->addCss('css/revolution/settings.css', 'revolutionslider');
                $this->addCss('css/revolution/layers.css', 'revolutionslider');
                $this->addCss('css/revolution/navigation.css', 'revolutionslider');
                $this->addCss('css/revolution/tooltip.css', 'revolutionslider');
            }
        }
    }

    public function frontendFooter() {
        $active_app = wa()->getApp();
        if($active_app == 'shop') {
            $plugin = wa()->getPlugin('revolutionslider');
            if ($plugin && $plugin->getSettings('status')) {
                $this->addJs('js/revolution/jquery.themepunch.tools.min.js', 'revolutionslider');
                $this->addJs('js/revolution/jquery.themepunch.revolution.min.js', 'revolutionslider');
                $this->addJs('js/revolution/extensions/revolution.extension.carousel.min.js', 'revolutionslider');
                $this->addJs('js/revolution/extensions/revolution.extension.parallax.min.js', 'revolutionslider');
            }
        }
    }


    public function backendMenu() {
        if ($this->getSettings('status')) {
            $html = '<li ' . (waRequest::get('plugin') == $this->id ? 'class="selected"' : 'class="no-tab"') . '>
                        <a href="?plugin=revolutionslider">Revolutionslider</a>
                    </li>';
            return array('core_li' => $html);
        }
    }

    public static function display($slider_id, $slide_num = 0) {
        $active_app = wa()->getApp();
        if($active_app == 'shop') {
            $plugin = wa()->getPlugin('revolutionslider');
            if ($plugin && $plugin->getSettings('status')) {

                $slider_model = new shopRevolutionsliderPluginModel();
                $slides = $slider_model->getById($slider_id);

                $sliderHtml = shopRevolutionsliderPlugin::getSliderHtml($slides, $slide_num);
                $sliderJs = shopRevolutionsliderPlugin::getSliderJs($slides);

                $slider = $sliderHtml;
                $slider .= $sliderJs;

                return $slider;
            }
        } else {
            return shopRevolutionsliderPlugin::generalDisplay($slider_id);
        }
    }


    public static function generalDisplay($slider_id) {
        $pluginUrl = wa()->getAppStaticUrl('shop', true) . 'plugins/revolutionslider/';

        $sc = '<link rel="stylesheet" href="' . $pluginUrl . 'css/revolution/settings.css"> ';
        $sc .= '<link rel="stylesheet" href="' . $pluginUrl . 'css/revolution/layers.css"> ';
        $sc .= '<link rel="stylesheet" href="' . $pluginUrl . 'css/revolution/navigation.css"> ';
        $sc .= '<link rel="stylesheet" href="' . $pluginUrl . 'css/revolution/tooltip.css"> ';

        $sc .= '<script type="text/javascript" src="' . $pluginUrl . 'js/revolution/jquery.themepunch.tools.min.js"></script> ';
        $sc .= '<script type="text/javascript" src="' . $pluginUrl . 'js/revolution/jquery.themepunch.revolution.min.js"></script> ';
        $sc .= '<script type="text/javascript" src="' . $pluginUrl . 'js/revolution/extensions/revolution.extension.carousel.min.js"></script> ';
        $sc .= '<script type="text/javascript" src="' . $pluginUrl . 'js/revolution/extensions/revolution.extension.parallax.min.js"></script> ';

        $slider_model = new shopRevolutionsliderPluginModel();
        $slides = $slider_model->getById($slider_id);

        $sliderHtml = shopRevolutionsliderPlugin::getSliderHtml($slides);
        $sliderJs = shopRevolutionsliderPlugin::getSliderJs($slides);

        $slider = $sc;
        $slider .= $sliderHtml;
        $slider .= $sliderJs;

        return $slider;
    }


    private static function getSliderHtml($slides, $slide_num = 0) {
        $data = '<div class="rev_slider_wrapper" style="background-color">';

        if(empty($slides)) return '';

        foreach ($slides as $key => $val) {
            $data .= '<div class="rev_slider" id="revoslider_' . $val['slider_id'] . '" >';

            if (is_array($val['layers'])) {
                $data .= '<ul>';
                $first = true;
                foreach ($val['layers'] as $layerkey => $layer) {
                    if($slide_num > 0 && ($layerkey+1) != $slide_num) continue;

                    $data .= '<li 
                        data-title="' . $layer['properties']['slidetitle'] . '" 
                        data-description="' . $layer['properties']['slidedescription'] . '"
                        data-slotamount="' . $layer['properties']['rslideslotamount'] . '"
                        data-data-rotate="' . $layer['properties']['rsliderotate'] . '" 
                        data-easein="' . $layer['properties']['rslideeasein'] . '"
                        data-easeout="' . $layer['properties']['rslideeaseout'] . '" ';

                    if(!empty($layer['properties']['thumbimage'])) $data .= 'data-thumb="' . $layer['properties']['thumbimage'] . '"';

                    if ($first) {
                        $data .= 'data-fsmasterspeed="' . $layer['properties']['rslidemasterspeed'] . '" ';
                        $data .= 'data-fstransition="' . $layer['properties']['rslidetransition'] . '" ';
                        $first = false;
                    } else {
                        $data .= 'data-masterspeed="' . $layer['properties']['rslidemasterspeed'] . '" 	data-transition="' . $layer['properties']['rslidetransition'] . '" ';
                    }

                    $data .= 'data-delay="' . $layer['properties']['rslidedelay'] . '" data-rotate="' . $layer['properties']['rsliderotate'] . '">';

                    if (!empty($layer['properties']['background'])) {
                        $rsLayerBgAlt = '';
                        if(isset($layer['properties']['rsLayerBgAlt'])) $rsLayerBgAlt = 'alt="' . $layer['properties']['rsLayerBgAlt'] . '"';

                        $data .= '<img ' . $rsLayerBgAlt . '  
                            style="background-color:' . $layer['properties']['bgcolor'] . '"
                            src="' . $layer['properties']['background'] . '"                         
                            data-bgparallax="' . $layer['properties']['bgparallaxlevel'] . '" ' ;

                                if (!empty($layer['properties']['kenburns'])) {

                                    $data .= 'data-kenburns="on"
                                        data-duration="' . $layer['properties']['kenburnsduration'] . '"
                                        data-ease="' . $layer['properties']['kenburnsease'] . '" 
                                        data-scalestart="' . $layer['properties']['kenburnsscalestart'] . '"
                                        data-scaleend="' . $layer['properties']['kenburnsscaleend'] . '"
                                        data-rotatestart="' . $layer['properties']['kenburnsrotatestart'] . '"
                                        data-rotateend="' . $layer['properties']['kenburnsrotateend'] . '"
                                        data-offsetstart="' . $layer['properties']['kenburnsoffsetstartx'] . ' ' . $layer['properties']['kenburnsoffsetstarty'] . '"
                                        data-offsetend="' . $layer['properties']['kenburnsoffsetendx'] . ' ' . $layer['properties']['kenburnsoffsetendy'] . '" ';
                                }

                        $data .= '	data-bgposition="' . $layer['properties']['bgposition'] . '" 
                            data-bgfit="' . $layer['properties']['bgfit'] . '"  
                            data-bgrepeat="' . $layer['properties']['bgrepeat'] . '" ';
                        $data .= 'class="rev-slidebg" data-no-retina>';

                    }else {
                        $data .= '<img  
                            style="background-color:' . $layer['properties']['bgcolor'] . '"
                            src="' . $layer['properties']['background'] . '"                         
                            data-bgparallax="5"' ;

                        $data .= '  data-bgposition="' . $layer['properties']['bgposition'] . '" 
                            data-bgfit="' . $layer['properties']['bgfit'] . '"  
                            data-bgrepeat="' . $layer['properties']['bgrepeat'] . '" ';
                        $data .= 'class="rev-slidebg" data-no-retina>';
                    }


                    if (!empty($layer['sublayers'])) {

                        if (is_array($layer['sublayers'])) {

                            foreach ($layer['sublayers'] as $sublayer) {

                                // data-transform_idle="o:' . $sublayer['rsLayerOpacityIdle'] . ';skX:' . $sublayer['rsLayerTransformIdleSkewX'] . ';skY:' . $sublayer['rsLayerTransformIdleSkewY'] . ';rX:' . $sublayer['rsLayerTransformIdleRotateX'] . ';rY:' . $sublayer['rsLayerTransformIdleRotateY'] . ';rZ:' . $sublayer['rsLayerTransformIdleRotateZ'] . ';"




                                if (!empty($sublayer['type']) && $sublayer['type'] == 'image') {

                                    if (!empty($sublayer['image'])) {
                                        if(!empty($sublayer['rsLayerActionLink'])) $data .= '<a target="' . $sublayer['rsLayerDataLinktarget'] . '" href="' . $sublayer['rsLayerActionLink'] . '">';
                                        $data .= '<div class="tp-caption tp-resizeme';
                                        if(!empty($sublayer['rsLayerParallaxlevel']) && $sublayer['rsLayerParallaxlevel'] != 'off') {
                                            $data .= ' rs-parallaxlevel-' . $sublayer['rsLayerParallaxlevel'] . '" ';
                                         } else {
                                            $data .= '" ';
                                        }
                                        $data .= 'data-x="left" data-y="top" data-hoffset="' . shopRevolutionsliderPlugin::revo_unit_check($sublayer['left']) . '" data-voffset="' . shopRevolutionsliderPlugin::revo_unit_check($sublayer['top']) . '" data-width="' . $sublayer['rsLayerStyleWidth'] . '" data-height="' . $sublayer['rsLayerStylehHeight'] . '"  data-whitespace="nowrap" data-transform_idle="o:' . $sublayer['rsLayerOpacityIdle'] . ';sX:' . $sublayer['rsLayerTransformIdleScaleX'] . ';sY:' . $sublayer['rsLayerTransformIdleScaleY'] . ';skX:' . $sublayer['rsLayerTransformIdleSkewX'] . ';rX:' . $sublayer['rsLayerTransformIdleRotateX'] . ';rY:' . $sublayer['rsLayerTransformIdleRotateY'] . ';rZ:' . $sublayer['rsLayerTransformIdleRotateZ'] . ';" data-transform_in="y:' . $sublayer['rsLayerTransformInY'] . 'px;x:' . $sublayer['rsLayerTransformInX'] . 'px;z:' . $sublayer['rsLayerTransformInZ'] . 'px;skX:'. $sublayer['rsLayerTransformInSkewX'] .';skY:'. $sublayer['rsLayerTransformInSkewY'] .';sX:'. $sublayer['rsLayerTransformInScaleX'] .';sY:'. $sublayer['rsLayerTransformInScaleY'] .';o:' . $sublayer['rsLayerOpacityIn'] . ';rZ:' . $sublayer['rsLayerTransformInRotateZ'] . ';rY:' . $sublayer['rsLayerTransformInRotateY'] . ';rX:' . $sublayer['rsLayerTransformInRotateX'] . ';s:' . $sublayer['rsLayerTransformInDuration'] . ';e:' . $sublayer['rsLayerTransformInTransition'] . '" data-transform_out="y:' . $sublayer['rsLayerTransformOutY'] . ';x:' . $sublayer['rsLayerTransformOutX'] . ';skX:'. $sublayer['rsLayerTransformOutSkewX'] .';skY:'. $sublayer['rsLayerTransformOutSkewY'] .';sX:'. $sublayer['rsLayerTransformOutScaleX'] .';sY:'. $sublayer['rsLayerTransformOutScaleY'] .';opacity:' . $sublayer['rsLayerOpacityOut'] . ';rZ:' . $sublayer['rsLayerTransformOutRotateZ'] . ';rY:' . $sublayer['rsLayerTransformOutRotateY'] . ';rX:' . $sublayer['rsLayerTransformOutRotateX'] . ';s:' . $sublayer['rsLayerTransformOutDuration'] . ';e:' . $sublayer['rsLayerTransformOutTransition'] . ';" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-start="' . $sublayer['delayin'] . '" ';
                                                    if(!empty($sublayer['delayout'])) $data .= 'data-end="' . $sublayer['delayout'] . '"';        
                                        $data .= '>';

                                        $rsSublayerImageAlt = '';
                                        if(isset($sublayer['rsSublayerImageAlt'])) $rsSublayerImageAlt = 'alt="' . $sublayer['rsSublayerImageAlt'] . '"';

                                        $data .= '<img ' . $rsSublayerImageAlt . ' src="' . $sublayer['image'] . '" data-ww="' . $sublayer['rsLayerStyleWidth'] . '" data-hh="' . $sublayer['rsLayerStylehHeight'] . '">';
                                        $data .= '</div>';
                                        if(!empty($sublayer['rsLayerActionLink'])) $data .= '</a>';
                                    }

                                } elseif(!empty($sublayer['type']) && $sublayer['type'] == 'tooltip')  {
                                    $data .= '<div class="tp-caption  rs-parallaxlevel-' . $sublayer['rsLayerParallaxlevel'] . '" data-x="left" data-y="top" data-hoffset="' . shopRevolutionsliderPlugin::revo_unit_check($sublayer['left']) . '" data-voffset="' . shopRevolutionsliderPlugin::revo_unit_check($sublayer['top']) . '" data-transform_idle="0:1" data-whitespace="normal" data-transform_in="y:' . $sublayer['rsLayerTransformInY'] . ';x:' . $sublayer['rsLayerTransformInX'] . ';skX:'. $sublayer['rsLayerTransformInSkewX'] .';skY:'. $sublayer['rsLayerTransformInSkewY'] .';sX:'. $sublayer['rsLayerTransformInScaleX'] .';sY:'. $sublayer['rsLayerTransformInScaleY'] .';opacity:' . $sublayer['rsLayerOpacityIn'] . ';rZ:' . $sublayer['rsLayerTransformInRotateZ'] . ';rY:' . $sublayer['rsLayerTransformInRotateY'] . ';rX:' . $sublayer['rsLayerTransformInRotateX'] . ';s:' . $sublayer['rsLayerTransformInDuration'] . ';e:' . $sublayer['rsLayerTransformInTransition'] . ';" data-transform_out="y:' . $sublayer['rsLayerTransformOutY'] . ';x:' . $sublayer['rsLayerTransformOutX'] . ';skX:'. $sublayer['rsLayerTransformOutSkewX'] .';skY:'. $sublayer['rsLayerTransformOutSkewY'] .';sX:'. $sublayer['rsLayerTransformOutScaleX'] .';sY:'. $sublayer['rsLayerTransformOutScaleY'] .';opacity:' . $sublayer['rsLayerOpacityOut'] . ';rZ:' . $sublayer['rsLayerTransformOutRotateZ'] . ';rY:' . $sublayer['rsLayerTransformOutRotateY'] . ';rX:' . $sublayer['rsLayerTransformOutRotateX'] . ';s:' . $sublayer['rsLayerTransformOutDuration'] . ';e:' . $sublayer['rsLayerTransformOutTransition'] . ';"  data-start="' . $sublayer['delayin'] . '" >';

                                    if(isset($sublayer['rsLayerTipDescriptionHeight'])) {
                                        $rsLayerTipDescriptionHeight = 'height:' . (int)$sublayer['rsLayerTipDescriptionHeight'] . 'px;';
                                    }

                                    $data .= '
                                        <div class="rstooltipwrapper" style=" background-color:' . $sublayer['rsLayerTipBgColor'] . '; border-width:' . $sublayer['rsLayerTipBorderSize'] . 'px; border-color:' . $sublayer['rsLayerTipBorderColor'] . '; width:' . $sublayer['rsLayerTipSize'] . 'px; height:' . $sublayer['rsLayerTipSize'] . 'px; display:block;">
                                            <div class="rstooltip" style="width:' . $sublayer['rsLayerTipDescriptionSize'] . 'px; ' . $rsLayerTipDescriptionHeight . ' background-color:' . $sublayer['rsLayerTipDescriptionBgColor'] . ';left:' . $sublayer['rsLayerTipDescriptionLeftOffset'].'px;top:' . $sublayer['rsLayerTipDescriptionTopOffset'].'px">
                                                <span class="rstooltip-title" style="color:' . $sublayer['rsLayerTipTitleColor'] . '">' . $sublayer['rsLayerHtmlTiptitle'] . '</span>
                                                <span class="rstooltip-description" style="color:' . $sublayer['rsLayerTipDescriptionColor'] . '">' . $sublayer['rsLayerHtmlTipdescription'] . '</span>
                                                <span class="rstooltip-arrow" style="border-top-color:' . $sublayer['rsLayerTipDescriptionBgColor'] . '"></span>
                                            </div>            
                                        </div>';

                                    $data .= '</div>';

                                } elseif(!empty($sublayer['type']) && $sublayer['type'] == 'html')  {
                                    if(!empty($sublayer['rsLayerActionLink'])) $data .= '<a target="' . $sublayer['rsLayerDataLinktarget'] . '" href="' . $sublayer['rsLayerActionLink'] . '">';
                                    

                                    $data .= '<div class="tp-caption  tp-resizeme furtherclasses rs-parallaxlevel-' . $sublayer['rsLayerParallaxlevel'] . '" data-x="left" data-y="top" data-hoffset="' . shopRevolutionsliderPlugin::revo_unit_check($sublayer['left']) . '" data-responsive_offset="on" data-voffset="' . shopRevolutionsliderPlugin::revo_unit_check($sublayer['top']) . '" data-width="' . $sublayer['rsLayerStyleWidth'] . '" data-height="' . $sublayer['rsLayerStylehHeight'] . '" data-whitespace="' . $sublayer['rsLayerWordWrap'] . '" data-transform_idle="o:' . $sublayer['rsLayerOpacityIdle'] . ';sX:' . $sublayer['rsLayerTransformIdleScaleX'] . ';sY:' . $sublayer['rsLayerTransformIdleScaleY'] . ';skX:' . $sublayer['rsLayerTransformIdleSkewX'] . ';skY:' . $sublayer['rsLayerTransformIdleSkewY'] . ';rX:' . $sublayer['rsLayerTransformIdleRotateX'] . ';rY:' . $sublayer['rsLayerTransformIdleRotateY'] . ';" data-transform_in="y:' . $sublayer['rsLayerTransformInY'] . ';x:' . $sublayer['rsLayerTransformInX'] . ';skX:'. $sublayer['rsLayerTransformInSkewX'] .';skY:'. $sublayer['rsLayerTransformInSkewY'] .';sX:'. $sublayer['rsLayerTransformInScaleX'] .';sY:'. $sublayer['rsLayerTransformInScaleY'] .';opacity:' . $sublayer['rsLayerOpacityIn'] . ';rZ:' . $sublayer['rsLayerTransformInRotateZ'] . ';rY:' . $sublayer['rsLayerTransformInRotateY'] . ';rX:' . $sublayer['rsLayerTransformInRotateX'] . ';s:' . $sublayer['rsLayerTransformInDuration'] . ';e:' . $sublayer['rsLayerTransformInTransition'] . ';" data-transform_out="y:' . $sublayer['rsLayerTransformOutY'] . ';x:' . $sublayer['rsLayerTransformOutX'] . ';skX:'. $sublayer['rsLayerTransformOutSkewX'] .';skY:'. $sublayer['rsLayerTransformOutSkewY'] .';sX:'. $sublayer['rsLayerTransformOutScaleX'] .';sY:'. $sublayer['rsLayerTransformOutScaleY'] .';opacity:' . $sublayer['rsLayerOpacityOut'] . ';rZ:' . $sublayer['rsLayerTransformOutRotateZ'] . ';rY:' . $sublayer['rsLayerTransformOutRotateY'] . ';rX:' . $sublayer['rsLayerTransformOutRotateX'] . ';s:' . $sublayer['rsLayerTransformOutDuration'] . ';e:' . $sublayer['rsLayerTransformOutTransition'] . ';" data-start="' . $sublayer['delayin'] . '" ';
                                                if(!empty($sublayer['delayout'])) $data .= 'data-end="' . $sublayer['delayout'] . '"'; 
                                        $data .= '>';
                                    $data .= '<' . $sublayer['htmltype'] . '                                  
                                style="                                  
                                    color:' . (isset($sublayer['rsLayerStyleTxtColor']) ? $sublayer['rsLayerStyleTxtColor'] : "") . ';
                                    font-family:' . (isset($sublayer['rsLayerStyleTxtFontfamily']) ? $sublayer['rsLayerStyleTxtFontfamily'] : "") . ';                                    
                                    font-size:' . (isset($sublayer['rsLayerStyleTxtfontsize']) ? $sublayer['rsLayerStyleTxtfontsize'] : "") . 'px;
                                    line-height:' . (isset($sublayer['rsLayerStyleTxtlineheight']) ? $sublayer['rsLayerStyleTxtlineheight'] : "") . 'px;
                                    font-weight:' . (isset($sublayer['rsLayerStyleTxtWeight']) ? $sublayer['rsLayerStyleTxtWeight'] : "") . ';
                                    color:' . (isset($sublayer['rsLayerStyleTxtWeight']) ? $sublayer['rsLayerStyleTxtWeight'] : "") . ';
                                    text-decoration:' . (isset($sublayer['rsLayerStyleTxtDecoration']) ? $sublayer['rsLayerStyleTxtDecoration'] : "") . ';
                                    text-align:' . (isset($sublayer['rsLayerStyleTxtAlign']) ? $sublayer['rsLayerStyleTxtAlign'] : "") . ';
                                    background-color:' . (isset($sublayer['rsLayerStyleBackgroundColor']) ? $sublayer['rsLayerStyleBackgroundColor'] : "") . ';
                                    padding-top:' . (isset($sublayer['rsLayerStyleBackgroundPaddingTop']) ? $sublayer['rsLayerStyleBackgroundPaddingTop'] : "") . 'px;
                                    padding-right:' . (isset($sublayer['rsLayerStyleBackgroundPaddingRight']) ? $sublayer['rsLayerStyleBackgroundPaddingRight'] : "") . 'px;
                                    padding-bottom:' . (isset($sublayer['rsLayerStyleBackgroundPaddingBottom']) ? $sublayer['rsLayerStyleBackgroundPaddingBottom'] : "") . 'px;
                                    padding-left:' . (isset($sublayer['rsLayerStyleBackgroundPaddingRight']) ? $sublayer['rsLayerStyleBackgroundPaddingRight'] : "") . 'px;
                                    border-color:' . (isset($sublayer['rsLayerStyleBorderColor']) ? $sublayer['rsLayerStyleBorderColor'] : "") . ';
                                    border-style:' . (isset($sublayer['rsLayerStyleBorderStyle']) ? $sublayer['rsLayerStyleBorderStyle'] : "") . ';
                                    border-width:' . (isset($sublayer['rsLayerStyleBorderSize']) ? $sublayer['rsLayerStyleBorderSize'] : "") . 'px;
                                    border-top-left-radius:' . (isset($sublayer['rsLayerStyleBorderTopLeftRadius']) ? $sublayer['rsLayerStyleBorderTopLeftRadius'] : "") . 'px;
                                    border-top-right-radius:' . (isset($sublayer['rsLayerStyleBorderTopRightRadius']) ? $sublayer['rsLayerStyleBorderTopRightRadius'] : "") . 'px;
                                    border-bottom-right-radius:' . (isset($sublayer['rsLayerStyleBorderBottomRightRadius']) ? $sublayer['rsLayerStyleBorderBottomRightRadius'] : "") . 'px;
                                    border-bottom-left-radius:' . (isset($sublayer['rsLayerStyleBorderBottomLeftRadius']) ? $sublayer['rsLayerStyleBorderBottomLeftRadius'] : "") . 'px;                                    
                                ">';
                                    $data .= (isset($sublayer['rsLayerHtml']) ? $sublayer['rsLayerHtml'] : "");
                                    $data .= '</'. $sublayer['htmltype'] . '>';
                                    $data .= '</div>';
                                    if(!empty($sublayer['rsLayerActionLink'])) $data .= '</a>';
                                }
                            }
                        }
                    }

                    $data .= '</li>';
                }

                $data .= '</ul>';
            }

            $data .= '</div>';

        }
         $data .= '</div>';

        return $data;

    }


    private static function revo_unit_check($str) {
        if (strstr($str, 'px') == false && strstr($str, '%') == false) {
            return $str . 'px';
        } else {
            return $str;
        }
    }


    private static function getSliderJs($slides) {
        if(empty($slides)) return '';
        
        $js = ' <script type="text/javascript"> $(document).ready(function () ';
        $js .= ' { ';

        foreach($slides as $key => $val) {
            $js .= ' var revapi = jQuery("#revoslider_'. $val['slider_id'] .'").revolution({
                sliderType: "'. $val['properties']['globallslidertype'] .'",
                sliderLayout: "'. $val['properties']['globallsliderLayout'] .'",
                gridwidth:'. $val['properties']['width'] .',
                gridheight:'. $val['properties']['height'] .',
                disableProgressBar: "'. $val['properties']['globalsProgressBar'] .'",
                lazyType: "'. $val['properties']['globallazyload'] .'",
                spinner: "'. $val['properties']['globalspinner'] .'",
                delay:'. $val['properties']['globaldelay'] .',
                startDelay:'. $val['properties']['globalstartdelay'] .',
                stopAfterLoops:'. $val['properties']['globalstopafterloops'] .',
                stopAtSlide:'. $val['properties']['globalstopatslide'] .',
               


                viewPort: {
                    enable:'. $val['properties']['globalstoviewport'] .',
                    outof: "'. $val['properties']['globalstoviewportoutof'] .'",
                    visible_area: "'. $val['properties']['globalviewportvisiblearea'] .'%",
                },


                navigation : {
                  keyboardNavigation:"'. $val['properties']['keyboardnavigation'] .'", 
                  keyboard_direction:"'. $val['properties']['keyboarddirection'] .'",
                  mouseScrollNavigation:"'. $val['properties']['mousescrollnavigation'] .'",   
                  onHoverStop:"'. $val['properties']['onhoverstop'] .'",

                    touch:{
                         touchenabled:"'. $val['properties']['touchenabled'] .'",
                         swipe_treshold : 75,
                         swipe_min_touches : 1,
                         drag_block_vertical:false,
                         swipe_direction:"horizontal"
                    },

                    arrows: {
                         style:"'. $val['properties']['arrowstyle'] .'",
                         enable:'. $val['properties']['arrowsenabled'] .',
                         rtl:false,
                         hide_onmobile:'. $val['properties']['arrowshideonmobile'] .',
                         hide_onleave:'. $val['properties']['arrowshideonleave'] .',
                         hide_delay:'. $val['properties']['arrowshidedelay'] .',
                         hide_delay_mobile:'. $val['properties']['arrowshidedelaymobile'] .',
                         hide_under:0,
                         hide_over:9999,

                            left : {
                                    container:"slider",
                                    h_align:"'. $val['properties']['arrowlefthorizontalign'] .'",
                                    v_align:"'. $val['properties']['arrowleftvertical'] .'",
                                    h_offset:'. $val['properties']['arrowlefthorizontoffset'] .',
                                    v_offset:'. $val['properties']['arrowleftverticaloffset'] .'
                             },

                             right : {
                                    container:"slider",
                                    h_align:"'. $val['properties']['arrowrighthorizontalign'] .'",
                                    v_align:"'. $val['properties']['arrowRightvertical'] .'",
                                    h_offset:'. $val['properties']['arrowRighthorizontoffset'] .',
                                    v_offset:'. $val['properties']['arrowRightverticaloffset'] .'
                            }
                    },

                    bullets:{
                         style:"'. $val['properties']['bulletsstyle'] .'",
                         enable:'. $val['properties']['bulletenabled'] .',
                         container:"slider",
                         rtl:false,
                         hide_onmobile:'. $val['properties']['bullethideonmobile'] .',
                         hide_onleave:'. $val['properties']['bullethideonleave'] .',
                         hide_delay:'. $val['properties']['bullethidedelay'] .',
                         hide_delay_mobile:'. $val['properties']['bullethidedelaymobile'] .',
                         hide_under:0,
                         hide_over:9999,
                         tmp:\'<span class="tp-bullet-image"></span><span class="tp-bullet-title">{{title}}</span>\', 
                         direction:"'. $val['properties']['bulletdirection'] .'",
                         space:'. $val['properties']['bulletmargin'] .',       
                         h_align:"'. $val['properties']['bullethorizontalign'] .'",
                         v_align:"'. $val['properties']['bulletverticallign'] .'",
                         h_offset:'. $val['properties']['bullethorizontoffset'] .',
                         v_offset:'. $val['properties']['bulletverticaloffset'] .'
                        },



                    thumbnails:{
                         style:"'. $val['properties']['thumbstyle'] .'",
                         enable:'. $val['properties']['thumbenabled'] .',
                         container:"slider",
                         rtl:false,
                         width:'. $val['properties']['thumbwidth'] .',
                         height:'. $val['properties']['thumbheight'] .',
                         wrapper_padding:'. $val['properties']['thumbpadding'] .',
                         wrapper_color:"'. $val['properties']['thumbcolor'] .'",
                         wrapper_opacity:'. $val['properties']['thumbopacity'] .',
                         visibleAmount:'. $val['properties']['thumbamount'] .',
                         tmp:\'<span class="tp-thumb-image"></span><span class="tp-thumb-title">{{title}}</span>\',
                         hide_onmobile:'. $val['properties']['thumbhideonmobile'] .',
                         hide_onleave:'. $val['properties']['thumbhideonleave'] .',
                         hide_delay:'. $val['properties']['thumbhidedelay'] .',
                         hide_delay_mobile:'. $val['properties']['thumbhidedelaymobile'] .',
                         hide_under:0,
                         hide_over:9999,
                         direction:"'. $val['properties']['thumbdirection'] .'",
                         span:false,
                         position:"'. $val['properties']['thumbposition'] .'",
                         space:'. $val['properties']['thumbmargin'] .',       
                         h_align:"'. $val['properties']['thumbhorizontalign'] .'",
                         v_align:"'. $val['properties']['thumbverticallign'] .'",
                         h_offset:'. $val['properties']['thumbhorizontoffset'] .',
                         v_offset:'. $val['properties']['thumbverticaloffset'] .'
                        },

                    tabs:{
                         style:"'. $val['properties']['tabstyle'] .'",
                         enable:'. $val['properties']['tabenabled'] .',
                         container:"slider",
                         rtl:false,
                         width:'. $val['properties']['tabwidth'] .',
                         height:'. $val['properties']['tabheight'] .',
                         wrapper_padding:'. $val['properties']['tabpadding'] .',
                         wrapper_color:"'. $val['properties']['tabcolor'] .'",
                         wrapper_opacity:'. $val['properties']['tabopacity'] .',
                         visibleAmount:'. $val['properties']['tabamount'] .',
                         hide_onmobile:'. $val['properties']['tabhideonmobile'] .',
                         hide_onleave:'. $val['properties']['tabhideonleave'] .',
                         hide_delay:'. $val['properties']['tabhidedelay'] .',
                         hide_delay_mobile:'. $val['properties']['tabhidedelaymobile'] .',
                         hide_under:0,
                         hide_over:9999,
                         tmp:\'<div class="tp-tab-content"><span class="tp-tab-title">{{title}}</span><span class="tp-tab-date">{{description}}</span></div><div class="tp-tab-image"></div>\', 
                         direction:"'. $val['properties']['tabdirection'] .'",
                         span:false,
                         position:"'. $val['properties']['tabposition'] .'",
                         space:'. $val['properties']['tabmargin'] .',       
                         h_align:"'. $val['properties']['tabhorizontalign'] .'",
                         v_align:"'. $val['properties']['tabverticallign'] .'",
                         h_offset:'. $val['properties']['tabhorizontoffset'] .',
                         v_offset:'. $val['properties']['tabverticaloffset'] .'
                    },
                },

                parallax:{
                       type:"'. $val['properties']['globalparallaxtype'] .'",
                       levels:[1,2,3,4,5,6,7,8,9,10,15,20,25,30,40,45,50],
                       origo:"'. $val['properties']['globalparallaxorigo'] .'",
                       speed:'. $val['properties']['globalsparallaxspeed'] .',
                       bgparallax:"'. $val['properties']['globalsparallaxbg'] .'",
                       disable_onmobile:"'. $val['properties']['globalsparallaxmobileoff'] .'",
                                ddd_shadow: "'. $val['properties']['globalsparallaxdddshadow'] .'",
                                ddd_bgfreeze: "'. $val['properties']['globalsparallaxdddbgfreeze'] .'",
                                ddd_overflow: "'. $val['properties']['globalsparallaxdddoverflow'] .'",
                                ddd_layer_overflow: "'. $val['properties']['globalsparallaxdddlayeroverflow'] .'",
                                ddd_z_correction: '. $val['properties']['globalsparallaxdddcropfix'] .'
                    },

              

            

            carousel: {
                    maxRotation: 65,
                    vary_rotation: "on",
                    minScale: 55,
                    vary_scale: "on",
                    horizontal_align: "center",
                    vertical_align: "canter",
                    fadeout: "off",
                    vary_fade: "on",
                    maxVisibleItems: 10,
                    infinity: "on",
                    space: -150,
                    stretch: "off"
                },

            

            shadow:' . $val['properties']['globalshadow'] . ',

        });';

        }

        $js .= ' }); </script> ';

        return $js;
    }

}
