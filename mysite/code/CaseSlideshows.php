<?php
class CaseSlideshows extends Page {

    private static $db = array(
    );

    private static $has_one = array(
    );
    
    private static $has_many = array(
        'SlideshowItems' => 'Slideshow'
    );
    
    private static $allowed_children = 'none';
    
    public function getCMSFields() {
        
        // Get the fields from the parent implementation
        $fields = parent::getCMSFields();
        
        // 
        // Slideshow related
        // 
        // Create a default configuration for the new GridField, allowing record editing
        $configSlideshow = GridFieldConfig_RelationEditor::create();
        // Set the names and data for our gridfield columns
        $configSlideshow->getComponentByType('GridFieldDataColumns')->setDisplayFields(array(
            'Priority' => 'Priority',
            'Description' => 'Description'
        ));
        $slideshowItemsField = new GridField(
            'SlideshowItems', // Field name
            'Slideshow Data', // Field title
            $this->SlideshowItems(),
            $configSlideshow
        );
        $fields->addFieldToTab('Root.Main', $slideshowItemsField);
        
        $fields->removeFieldFromTab('Root.Main', 'Content');

        return $fields;
    }
    
}

class CaseSlideshows_Controller extends Page_Controller {


    public function init() {
        parent::init();    

        
 
    }



}