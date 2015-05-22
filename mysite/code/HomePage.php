<?php
class HomePage extends Page {

    static $db = array(
        'FooterContent' => 'HTMLText'
    );

    private static $has_one = array(
    );
    
    private static $has_many = array(
    );
    
    function getCMSFields() {

        // Get the fields from the parent implementation
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', new LabelField('FooterLabel', 'For elements that should serve as link to top, specific code should be applied in source: class="gototop"<br />Example:<br />&lt;a href="#" class="gototop"&gt;Take me up&lt;/a&gt;'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('FooterContent', 'Footer Content'));
        return $fields;

    }
    
}

class HomePage_Controller extends Page_Controller {

    public function init() {
        parent::init();    

        
 
    }



}