<?php
class AdvisoryPage extends Page {

    private static $db = array(
        'FooterContent' => 'HTMLText'
    );

    private static $has_one = array(
    );
    
    private static $has_many = array(
    );
    
    private static $allowed_children = array('AdvisoryItems');
    
    public function getCMSFields() {
        
        // Get the fields from the parent implementation
        $fields = parent::getCMSFields();
        
        $fields->removeFieldFromTab('Root.Main', 'Content');
        $fields->addFieldToTab('Root.Main', new LabelField('FooterLabel', 'For elements that should serve as link to top, specific code should be applied in source: class="gototop"<br />Example:<br />&lt;a href="#" class="gototop"&gt;Take me up&lt;/a&gt;'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('FooterContent', 'Footer Content'));
        return $fields;
    }
    
}

class AdvisoryPage_Controller extends Page_Controller {


    public function init() {
        parent::init();    

        Requirements::customScript('
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