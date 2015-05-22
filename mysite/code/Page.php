<?php
class Page extends SiteTree {

    private static $db = array(
    );

    private static $has_one = array(
    );

}

class Page_Controller extends ContentController {

    public $user_agent;
    
    private static $allowed_actions = array (
    );

    public function init() {
        parent::init();

        $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $OS = $this->getOS();
        
        if ($OS == "Mac OS X" || $OS == "Mac OS 9") {
            Requirements::themedCSS("styles-mac");
        } else {
            Requirements::themedCSS("styles");
        }
        
        Requirements::themedCSS("form");
        Requirements::javascript("mysite/javascript/jquery-1.11.0.min.js");
        Requirements::javascript("mysite/javascript/jquery.marquee.min.js");
        Requirements::customScript('
            jQuery.noConflict();

            jQuery(document).ready(function() {

                jQuery(".gototop").click(function() {
                     jQuery("html, body").animate({ scrollTop: 0 }, 1000);
                });
                jQuery(".marquee").marquee({
                    //speed in milliseconds of the marquee
                    duration: 15000,
                    //gap in pixels between the tickers
                    gap: 150,
                    //time in milliseconds before the marquee will start animating
                    delayBeforeStart: 0,
                    //"left" or "right"
                    direction: "left",
                    //true or false - should the marquee be duplicated to show an effect of continues flow
                    duplicated: false,
                    pauseOnHover: true
                });

            });
        ');
        
    }

    public function getNewsItemsForNewsTicker() {
        return NewsItems::get()->filter(array('ShowTicker' => 1, 'ShowNews' => 1))->sort('Date', 'DESC')->limit(3);
    }
    
    public function getOS() { 

        $user_agent = $this->user_agent;

        $os_platform    =   "Unknown OS Platform";

        $os_array       =   array(
                                '/windows nt 10/i'     =>  'Windows 10',
                                '/windows nt 6.3/i'     =>  'Windows 8.1',
                                '/windows nt 6.2/i'     =>  'Windows 8',
                                '/windows nt 6.1/i'     =>  'Windows 7',
                                '/windows nt 6.0/i'     =>  'Windows Vista',
                                '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                                '/windows nt 5.1/i'     =>  'Windows XP',
                                '/windows xp/i'         =>  'Windows XP',
                                '/windows nt 5.0/i'     =>  'Windows 2000',
                                '/windows me/i'         =>  'Windows ME',
                                '/win98/i'              =>  'Windows 98',
                                '/win95/i'              =>  'Windows 95',
                                '/win16/i'              =>  'Windows 3.11',
                                '/macintosh|mac os x/i' =>  'Mac OS X',
                                '/mac_powerpc/i'        =>  'Mac OS 9',
                                '/linux/i'              =>  'Linux',
                                '/ubuntu/i'             =>  'Ubuntu',
                                '/iphone/i'             =>  'iPhone',
                                '/ipod/i'               =>  'iPod',
                                '/ipad/i'               =>  'iPad',
                                '/android/i'            =>  'Android',
                                '/blackberry/i'         =>  'BlackBerry',
                                '/webos/i'              =>  'Mobile'
                            );

        foreach ($os_array as $regex => $value) { 

            if (preg_match($regex, $user_agent)) {
                $os_platform    =   $value;
            }

        }   

        return $os_platform;

    }

    public function getBrowser() {

        $user_agent = $this->user_agent;

        $browser        =   "Unknown Browser";

        $browser_array  =   array(
                                '/msie/i'       =>  'Internet Explorer',
                                '/firefox/i'    =>  'Firefox',
                                '/safari/i'     =>  'Safari',
                                '/chrome/i'     =>  'Chrome',
                                '/opera/i'      =>  'Opera',
                                '/netscape/i'   =>  'Netscape',
                                '/maxthon/i'    =>  'Maxthon',
                                '/konqueror/i'  =>  'Konqueror',
                                '/mobile/i'     =>  'Handheld Browser'
                            );

        foreach ($browser_array as $regex => $value) { 

            if (preg_match($regex, $user_agent)) {
                $browser    =   $value;
            }

        }

        return $browser;

    }

}
