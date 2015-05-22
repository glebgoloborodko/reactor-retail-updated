<?php
class MySiteConfig extends DataExtension {     

    public static $db = array(			
        'SitewideFooterContent' => 'HTMLText'
    );
    
    public static $has_one = array(
        'SitewideHeaderImage' => 'Image'	
    );
 
    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('SitewideFooterContent', 'Sitewide Footer Content'));
        $fields->addFieldToTab("Root.Main", new UploadField("SitewideHeaderImage", "Sitewide Header Image"));
    }
}