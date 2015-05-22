<?php
class AdvisoryItems extends Page {

    private static $db = array(
        'HeaderColLeft' => 'HTMLText',
        'HeaderColRight' => 'HTMLText',
        'ContentColRight' => 'HTMLText',
        'SmallContent' => 'HTMLText',
        'FooterColLeft' => 'HTMLText',
        'FooterColRight' => 'HTMLText'
    );

    private static $has_one = array(
        'ContentColLeft' => 'Image'
    );
    
    private static $has_many = array(
    );
    
    private static $allowed_children = 'none';
    
    public function getCMSFields() {
        
        // Get the fields from the parent implementation
        $fields = parent::getCMSFields();
        
        $fields->removeFieldFromTab('Root.Main', 'Content');
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('HeaderColLeft', 'Header, Left Column'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('HeaderColRight', 'Header, Right Column'));
        $fields->addFieldToTab('Root.Main', new UploadField('ContentColLeft', 'Content, Left Column, Image'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('ContentColRight', 'Content, Right Column'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('SmallContent', 'Small Content'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('FooterColLeft', 'Footer, Left Column'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('FooterColRight', 'Footer, Right Column'));

        return $fields;
    }
    
}

class AdvisoryItems_Controller extends Page_Controller {


    public function init() {
        parent::init();    

    }

}