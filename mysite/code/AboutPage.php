<?php
class AboutPage extends Page {

    static $db = array(
        'ContentTopLeft' => 'HTMLText',
        'ContentTopRight' => 'HTMLText',
        'ContentCenter' => 'HTMLText',
        'ContentBottomLeft' => 'HTMLText',
        'ContentBottomRight' => 'HTMLText',
        'FooterContent' => 'HTMLText'
    );

    private static $has_one = array(
        'ContentTopCenterImage' => 'Image'
    );
    
    private static $has_many = array(
    );
    
    function getCMSFields() {

        // Get the fields from the parent implementation
        $fields = parent::getCMSFields();
        $fields->removeFieldFromTab('Root.Main', 'Content');
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('ContentTopLeft', 'Top Left Content'));
        $fields->addFieldToTab('Root.Main', new UploadField("ContentTopCenterImage", "Top Center Content Image"));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('ContentTopRight', 'Top Right Content'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('ContentCenter', 'Center Content'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('ContentBottomLeft', 'Bottom Left Content'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('ContentBottomRight', 'Bottom Right Content'));
        $fields->addFieldToTab('Root.Main', new LabelField('FooterLabel', 'For elements that should serve as link to top, specific code should be applied in source: class="gototop"<br />Example:<br />&lt;a href="#" class="gototop"&gt;Take me up&lt;/a&gt;'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('FooterContent', 'Footer Content'));
        return $fields;

    }
    
}

class AboutPage_Controller extends Page_Controller {

    public function init() {
        parent::init();    

        
 
    }



}