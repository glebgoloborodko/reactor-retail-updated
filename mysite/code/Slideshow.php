<?php

class Slideshow extends DataObject {
    private static $singular_name = 'Slideshow Item';
    private static $plural_name = 'Slideshow Items';
    static $db = array(
        'Description' => 'Text',
        'Priority' => 'Int'
    );
	
    public static $has_one = array(
        'CaseSlideshows' => 'CaseSlideshows',
        'Picture' => 'Image'
    );
    


    function getCMSFields() {

        $fields = new FieldList(
            new TextareaField('Description', 'Description'),
            new TextField('Priority', 'Priority'),
            new UploadField("Picture", "Slideshow Image")
        );

        return $fields;
    }

    
}

?>
