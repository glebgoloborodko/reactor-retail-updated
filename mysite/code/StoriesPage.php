<?php
class StoriesPage extends Page {

    private static $db = array(
        'FooterContent' => 'HTMLText'
    );

    private static $has_one = array(
    );
    
    private static $has_many = array(
    );
    
    private static $allowed_children = array('StoryItems');
    
    public function getCMSFields() {
        
        // Get the fields from the parent implementation
        $fields = parent::getCMSFields();
        
        $fields->removeFieldFromTab('Root.Main', 'Content');
        $fields->addFieldToTab('Root.Main', new LabelField('FooterLabel', 'For elements that should serve as link to top, specific code should be applied in source: class="gototop"<br />Example:<br />&lt;a href="#" class="gototop"&gt;Take me up&lt;/a&gt;'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('FooterContent', 'Footer Content'));
        return $fields;
    }
    
}

class StoriesPage_Controller extends Page_Controller {


    public function init() {
        parent::init();    

        Requirements::customScript('
            jQuery(document).ready(function(){
                var windowHeight = jQuery(window).height();
                var footerHeight = jQuery("#footer-container").height();
                jQuery(".stories-column-right").height(windowHeight - 218);
                jQuery(".stories-column-right").css("position", "fixed");
                jQuery(".stories-column-right").css("margin-left", "615px");
                jQuery(".stories-column-right").css("margin-top", "0px");
            });
            
            jQuery(window).scroll(function() {
                var columnPosition = jQuery(".stories-column-left").offset().top - jQuery(window).scrollTop();
                var windowHeight = jQuery(window).height();
                var footerHeight = jQuery("#footer-container").height();
                if (columnPosition >= 34) {
                    var rightColumnTopMargin = columnPosition - 198;
                    jQuery(".stories-column-right").css("margin-top", rightColumnTopMargin);
                    jQuery(".stories-column-right").height(windowHeight - 20 - columnPosition);
                } else {
                    jQuery(".stories-column-right").css("margin-top", "-182px");
                    jQuery(".stories-column-right").height(windowHeight - 34 - footerHeight);
                }
            });

        ');
        
 
    }
    
    public function getNewsItemsForStories() {
        return NewsItems::get()->filter(array('ShowNews' => 1))->sort('Date', 'DESC');
    }
    
    
    
    
    


}