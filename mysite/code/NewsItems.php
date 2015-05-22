<?php
class NewsItems extends DataObject {
    
    static $db = array(
        'Title' => 'Text',
        'NewsTitle' => 'Text',
        'Date' => 'Date',
        'Content' => 'HTMLText',
        'ShowTicker' => 'Boolean',
        'ShowNews' => 'Boolean'
    );
	
    public static $has_one = array(
        'NewsImage' => 'Image'
    );


    private static $summary_fields = array(
        'NewsTitle',
        'Date'
    );
    
    function getCMSFields() {

        $fields = new FieldList(
            new TextField('Title', 'Ticker Title'),
            new TextField('NewsTitle', 'News Title'),
            DateField::create('Date', 'Date')->setConfig('showcalendar', true),
            new CheckboxField('ShowTicker', 'Show Ticker'),
            new CheckboxField('ShowNews', 'Show News'),
            new HtmlEditorField('Content', 'Content'),
            new UploadField('NewsImage', 'Image')
        );

        return $fields;
    }
}


class NewsItemsAdmin extends ModelAdmin {
    public static $managed_models = array('NewsItems');
    static $url_segment = 'NewsAdmin';   // Linked as /admin/newsitemsadmin/
    static $menu_title = 'News Admin';
}

?>