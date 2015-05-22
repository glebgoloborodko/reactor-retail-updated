<?php
class StoryItems extends Page {

    private static $db = array(
        'StoryHeader' => 'HTMLText',
        'ContentColLeft' => 'HTMLText',
        'ContentColRight' => 'HTMLText'
    );

    private static $has_one = array(
        'StoryImage' => 'Image'
    );
    
    private static $has_many = array(
    );
    
    private static $allowed_children = 'none';
    
    public function getCMSFields() {
        
        // Get the fields from the parent implementation
        $fields = parent::getCMSFields();
        
        $fields->removeFieldFromTab('Root.Main', 'Content');
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('StoryHeader', 'Header'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('ContentColLeft', 'Content, Left Column'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('ContentColRight', 'Content, Right Column'));
        $fields->addFieldToTab('Root.Main', new UploadField('StoryImage', 'Story Image'));

        return $fields;
    }
    
}

class StoryItems_Controller extends Page_Controller {


    public function init() {
        parent::init();    

    }

}