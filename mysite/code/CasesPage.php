<?php
class CasesPage extends Page {

    private static $db = array(
        'FooterContent' => 'HTMLText'
    );

    private static $has_one = array(
    );
    
    private static $has_many = array(
    );
    
    private static $allowed_children = array('CaseItems');
    
    public function getCMSFields() {
        
        // Get the fields from the parent implementation
        $fields = parent::getCMSFields();
        
        $fields->removeFieldFromTab('Root.Main', 'Content');
        $fields->addFieldToTab('Root.Main', new LabelField('FooterLabel', 'For elements that should serve as link to top, specific code should be applied in source: class="gototop"<br />Example:<br />&lt;a href="#" class="gototop"&gt;Take me up&lt;/a&gt;'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('FooterContent', 'Footer Content'));
        return $fields;
    }
    
}

class CasesPage_Controller extends Page_Controller {

    public function init() {

        parent::init();    
        
        $OS = $this->getOS();
        
        if ($OS == "Mac OS X" || $OS == "Mac OS 9") {
            $CSSForCounter = "font-size: 17px; line-height: 11px; font-family: tahoma;";
        } else {
            $CSSForCounter = "font-size: 17px; line-height: 20px; font-family: tahoma;";
        }

        // Generating custom JS for CaseItem Slideshows
        $masterOutput = "";
        $CaseItemPages = DataObject::get("CaseItems", "`ParentID` = '$this->ID'");
        foreach ($CaseItemPages as $CaseItemPage) {
            $masterOutput .= '
                // Slideshow Group '.$CaseItemPage->ID.'
            ';
            $CaseSlideshows = DataObject::get("CaseSlideshows", "`ParentID` = '$CaseItemPage->ID'")->limit(1);
            foreach ($CaseSlideshows as $CaseSlideshow) {
                $masterOutput .= '
                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshow->ID.'").show();
                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshow->ID.'_caption").show();
                ';
            }
            $CaseSlideshows = DataObject::get("CaseSlideshows", "`ParentID` = '$CaseItemPage->ID'");
            $i = 1;
            foreach ($CaseSlideshows as $CaseSlideshow) {
                if (count($CaseSlideshows)>1) {
                    $masterOutput .= '
                        jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshow->ID.'-next a").click(function() {
                            if(jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshow->ID.'-next").hasClass("disabled")){
                                jQuery("#slideshowGroup'.$CaseItemPage->ID.' .slideshow-container").hide();
                                jQuery("#slideshowGroup'.$CaseItemPage->ID.'").parent().find(".slideshow-caption").hide();
                    ';
                    if ($CaseSlideshows[$i]) {
                        $masterOutput .= '
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' .slideshow-holder").children("img").removeClass("cycle-slide-active");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' .slideshow-holder").children("img").css("visibility", "hidden");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' div.slideshow-holder img:nth-child(2)").addClass("cycle-slide-active");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' div.slideshow-holder img:nth-child(2)").css("visibility", "visible");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.'-next").removeClass("disabled");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.'-prev").addClass("disabled");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' .slideshow-holder").data("cycle.opts").currSlide=0;
                                    var captionNext = 1 + "<br /><span style=\"'.$CSSForCounter.'\">–</span><br />" + jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' .slideshow-holder").data("cycle.opts").slideCount;
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' .slideshow-holder").next().find(".counter").html(captionNext);
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.'").fadeIn("slow", "swing");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.'"+"_caption").fadeIn("slow", "swing");
                                    jQuery("#slideshow-menu'.$CaseItemPage->ID.' a").removeClass("active");
                                    jQuery("a[href$=\"/#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.'\"]").addClass("active");
                                }
                            });
                        ';
                    }
                    else {
                        $masterOutput .= '
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.' .slideshow-holder").children("img").removeClass("cycle-slide-active");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.' .slideshow-holder").children("img").css("visibility", "hidden");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.' div.slideshow-holder img:nth-child(2) ").addClass("cycle-slide-active");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.' div.slideshow-holder img:nth-child(2)").css("visibility", "visible");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.'-next").removeClass("disabled");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.'-prev").addClass("disabled");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.' .slideshow-holder").data("cycle.opts").currSlide=0;
                                    var captionNext = 1 + "<br /><span style=\"'.$CSSForCounter.'\">–</span><br />" + jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.' .slideshow-holder").data("cycle.opts").slideCount;
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.' .slideshow-holder").next().find(".counter").html(captionNext);
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.'").fadeIn("slow", "swing");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.'"+"_caption").fadeIn("slow", "swing");
                                    jQuery("#slideshow-menu'.$CaseItemPage->ID.' a").removeClass("active");
                                    jQuery("a[href$=\"/#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.'\"]").addClass("active");
                                }
                            });
                        ';
                    }
                }
                else {
                    $masterOutput .= '
                        jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshow->ID.'-next a").click(function() {
                            if(jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshow->ID.'-next").hasClass("disabled")){
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.' .slideshow-holder").children("img").removeClass("cycle-slide-active");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.' .slideshow-holder").children("img").css("visibility", "hidden");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.' div.slideshow-holder img:nth-child(1) ").addClass("cycle-slide-active");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.' div.slideshow-holder img:nth-child(1)").css("visibility", "visible");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.'-next").removeClass("disabled");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.'-prev").addClass("disabled");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[0]->ID.' .slideshow-holder").data("cycle.opts").currSlide=-1;
                            }
                        });
                    ';
                }
                $i++;
            }
            $CaseSlideshows = DataObject::get("CaseSlideshows", "`ParentID` = '$CaseItemPage->ID'");
            $i = -1;
            foreach ($CaseSlideshows as $CaseSlideshow) {
                if (count($CaseSlideshows)>1) {
                    $masterOutput .= '
                        jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshow->ID.'-prev a").click(function() {
                            if(jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshow->ID.'-prev").hasClass("disabled")){
                                jQuery("#slideshowGroup'.$CaseItemPage->ID.' .slideshow-container").hide();
                                jQuery("#slideshowGroup'.$CaseItemPage->ID.'").parent().find(".slideshow-caption").hide();
                    ';
                    if ($i!=-1) {
                        $masterOutput .= '
                                    jQuery("#slideshow1Group'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' .slideshow-holder").children("img").removeClass("cycle-slide-active");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' .slideshow-holder").children("img").css("visibility", "hidden");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' div.slideshow-holder img:last-child").addClass("cycle-slide-active");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' div.slideshow-holder img:last-child").css("visibility", "visible");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.'-prev").removeClass("disabled");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.'-next").addClass("disabled");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' .slideshow-holder").data("cycle.opts").currSlide=jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' .slideshow-holder").data("cycle.opts").slideCount - 1;
                                    var captionNext = jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' .slideshow-holder").data("cycle.opts").slideCount + "<br /><span style=\"'.$CSSForCounter.'\">–</span><br />" + jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' .slideshow-holder").data("cycle.opts").slideCount;
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.' .slideshow-holder").next().find(".counter").html(captionNext);
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.'").fadeIn("slow", "swing");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.'"+"_caption").fadeIn("slow", "swing");
                                    jQuery("#slideshow-menu'.$CaseItemPage->ID.' a").removeClass("active");
                                    jQuery("a[href$=\"/#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[$i]->ID.'\"]").addClass("active");
                                }
                            });
                        ';
                    }
                    else {
                        $masterOutput .= '
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.' .slideshow-holder").children("img").removeClass("cycle-slide-active");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.' .slideshow-holder").children("img").css("visibility", "hidden");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.' div.slideshow-holder img:last-child").addClass("cycle-slide-active");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.' div.slideshow-holder img:last-child").css("visibility", "visible");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.'-prev").removeClass("disabled");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.'-next").addClass("disabled");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.' .slideshow-holder").data("cycle.opts").currSlide=jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.' .slideshow-holder").data("cycle.opts").slideCount - 1;
                                    var captionNext = jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.' .slideshow-holder").data("cycle.opts").slideCount + "<br /><span style=\"'.$CSSForCounter.'\">–</span><br />" + jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.' .slideshow-holder").data("cycle.opts").slideCount;
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.' .slideshow-holder").next().find(".counter").html(captionNext);
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.'").fadeIn("slow", "swing");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.'"+"_caption").fadeIn("slow", "swing");
                                    jQuery("#slideshow-menu'.$CaseItemPage->ID.' a").removeClass("active");
                                    jQuery("a[href$=\"/#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.'\"]").addClass("active");
                                }
                            });
                        ';
                    }
                    $i++;
                }
                else {
                    $masterOutput .= '
                        jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshow->ID.'-prev a").click(function() {
                            if(jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshow->ID.'-prev").hasClass("disabled")){
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.' .slideshow-holder").children("img").removeClass("cycle-slide-active");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.' .slideshow-holder").children("img").css("visibility", "hidden");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.' div.slideshow-holder img:last-child").addClass("cycle-slide-active");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.' div.slideshow-holder img:last-child").css("visibility", "visible");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.'-prev").removeClass("disabled");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.'-next").addClass("disabled");
                                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.' .slideshow-holder").data("cycle.opts").currSlide=jQuery("#slideshowGroup'.$CaseItemPage->ID.'_slideshow'.$CaseSlideshows[count($CaseSlideshows)-1]->ID.' .slideshow-holder").data("cycle.opts").slideCount;
                            }
                        });
                    ';
                }
            }

            $masterOutput .= '
                jQuery("#slideshow-menu'.$CaseItemPage->ID.' a").click(function() {
                    jQuery("#slideshow-menu'.$CaseItemPage->ID.' a").removeClass("active");
                    jQuery(this).addClass("active");
                    slideGroupToBeShown'.$CaseItemPage->ID.' = jQuery(this).attr("href");
                    slideGroupToBeShown'.$CaseItemPage->ID.' = slideGroupToBeShown'.$CaseItemPage->ID.'.replace("/", "");
//                    if (slideGroupToBeShown'.$CaseItemPage->ID.'.search("/cases/") >= 0) {
//                        slideGroupToBeShown'.$CaseItemPage->ID.' = slideGroupToBeShown'.$CaseItemPage->ID.'.replace("/cases/", "");
//                    } else {
//                        slideGroupToBeShown'.$CaseItemPage->ID.' = slideGroupToBeShown'.$CaseItemPage->ID.'.replace("/cases", "");
//                    }
                    jQuery("#slideshowGroup'.$CaseItemPage->ID.' .slideshow-container").hide();
                    jQuery("#slideshowGroup'.$CaseItemPage->ID.'").parent().find(".slideshow-caption").hide();
                    jQuery(slideGroupToBeShown'.$CaseItemPage->ID.').fadeIn("slow", "swing");
                    jQuery(slideGroupToBeShown'.$CaseItemPage->ID.'+"_caption").fadeIn("slow", "swing");
                    
                });
            ';

        }
        

        Requirements::javascript("mysite/javascript/jquery.cycle2.min.js");
        Requirements::javascript("mysite/javascript/jquery.cycle2.center.min.js");
        Requirements::javascript("mysite/javascript/jquery.lazyload.js");
        Requirements::customScript('

            jQuery(function() {
                jQuery("img.cycle-slide").lazyload({
                    event : "sporty"
                });
            });

            jQuery(window).bind("load", function() {
                var timeout = setTimeout(function() {
                    jQuery("img.cycle-slide").trigger("sporty")
                }, 5000);
            });  

            jQuery(document).ready(function(){

                jQuery(".slideshow-menu a:first-child").addClass("active");

                jQuery(".cases-gototop").click(function() {
                    var elementId = jQuery(this).attr("data-master-holder");
                    var sliderPosition = jQuery("#"+elementId).offset().top;
                    var heightOfTopMenu = jQuery("#main-menu-container").outerHeight(true);
                    var heightOfTitle = jQuery("#"+elementId).prev("h1").outerHeight(true);
                    var scrollToPosition = sliderPosition - heightOfTopMenu - heightOfTitle + 1; // +1 goes for top border of Title
                    jQuery("html, body").animate({ scrollTop: scrollToPosition }, 500);
                });
                
                var inners = jQuery(".slideshow-holder");

                jQuery(".slideshow-holder").on("cycle-update-view", function (e, optionHash, slideOptionsHash, currSlideEl) {
                    var caption = (optionHash.currSlide + 1) + "<br /><span style=\"'.$CSSForCounter.'\">–</span><br />" + optionHash.slideCount;
                    jQuery(this).next().find(".counter").html(caption);
                });
                
                // add for each slideshow group appropriate javascript
                
                '.$masterOutput.'

            });

            jQuery(window).load(function() {    

                jQuery("html, body").animate({ scrollTop: jQuery(document).height() - jQuery(window).height() }, 20, function() {
                    jQuery(this).animate({ scrollTop: 0 }, 1000, function() {
                        jQuery("#logo").css("background-attachment", "fixed");
                        jQuery(this).animate({ scrollTop: 151 }, 500);
                    });
                }).delay(1000);

            });
        ');
        
 
    }



}