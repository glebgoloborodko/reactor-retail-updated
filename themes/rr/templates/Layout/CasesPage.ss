<div class="block-wrapper">
        <div class="block-cases">
            <div class="cases">
                <% loop Children %>
                
                <div class="case">    
                    <h1 <%if First %>style="border-top: 1px solid #aca295;"<% end_if %>>$Title</h1>
                    <div id="slideshowGroup{$ID}">
                        <% loop Children %>
                        
                        <div class="slideshow-container" id="slideshowGroup{$Up.ID}_slideshow{$ID}">
                            <div class="slideshow-left"><div class="arrow-left" id="slideshowGroup{$Up.ID}_slideshow{$ID}-prev"><a href="#"><img src="$ThemeDir/graphics/arrow-left.png" /></a></div></div>
                            <div class="slideshow-holder cycle-slideshow" 
                                data-cycle-fx="scrollHorz" 
                                data-cycle-speed="500" 
                                data-cycle-timeout="0"
                                data-cycle-allow-wrap="false"
                                data-cycle-slides="> img"
                                data-cycle-center-horz="true"
                                data-cycle-center-vert="true"
                                data-cycle-prev="#slideshowGroup{$Up.ID}_slideshow{$ID}-prev"
                                data-cycle-next="#slideshowGroup{$Up.ID}_slideshow{$ID}-next"
                                data-cycle-caption="#slideshowGroup{$Up.ID}_slideshow{$ID}_alt-caption"
                                data-cycle-caption-template="{{alt}}"
                            >

                                <% if First %>
                                    <% loop $SlideshowItems.Sort(Priority, ASC) %>
                                        <% if First %>
                                            <img src="$Picture.URL" alt="$Description" />
                                        <% else %>
                                            <img src="/assets/Uploads/farge-int-13.jpg" data-original="$Picture.URL" alt="$Description" />
                                        <% end_if %>
                                    <% end_loop %>
                                <% else %>
                                    <% loop $SlideshowItems.Sort(Priority, ASC) %>
                                        <img src="/assets/Uploads/farge-int-13.jpg" data-original="$Picture.URL" alt="$Description" />
                                    <% end_loop %>
                                <% end_if %>
                            </div>
                            <div class="slideshow-right"><div class="arrow-right" id="slideshowGroup{$Up.ID}_slideshow{$ID}-next"><a href="#"><img src="$ThemeDir/graphics/arrow-right.png" /></a></div><div class="counter"></div></div>
                            
                        </div>
                        
                        <% end_loop %>
                        
                    </div>
                    <div class="slideshow-menu" id="slideshow-menu{$ID}">
                        <% loop Children %>
                        <a href="#slideshowGroup{$Up.ID}_slideshow{$ID}" data-master-holder="slideshowGroup{$Up.ID}" class="cases-gototop"
                            <% if Last %>
                                style="padding: 0px 0px 0px 7px;"
                            <% else %>
                                <% if First %>
                                    style="border-right: 2px solid #a0968a; padding: 0px 9px 0px 0px;"
                                <% else_if Middle %>
                                    style="border-right: 2px solid #a0968a; padding: 0px 9px 0px 7px;"
                                <% end_if %>
                            <% end_if %>
                        >$Title</a>
                        <% end_loop %>
                    </div>
                    
                    <% loop Children %>
                        <div class="slideshow-caption" id="slideshowGroup{$Up.ID}_slideshow{$ID}_caption"> <p id="slideshowGroup{$Up.ID}_slideshow{$ID}_alt-caption"></p></div>
                    <% end_loop %>
                    
                </div>
                
                <% end_loop %>
            </div>
    </div>
</div>

<div class="block-wrapper">
    <div class="block" id="footer-container">
        $FooterContent
        $SiteConfig.SitewideFooterContent
    </div>
</div>