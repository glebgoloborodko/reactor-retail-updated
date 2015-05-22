<?php
class CaseItems extends Page {

    private static $db = array(
    );

    private static $has_one = array(
    );
    
    private static $has_many = array(
    );
    
    private static $allowed_children = array('CaseSlideshows');
    
    public function getCMSFields() {
        
        // Get the fields from the parent implementation
        $fields = parent::getCMSFields();
        
        $fields->removeFieldFromTab('Root.Main', 'Content');

        return $fields;
    }
    
}

class CaseItems_Controller extends Page_Controller {


    public function init() {
        parent::init();    

        
 
    }



}