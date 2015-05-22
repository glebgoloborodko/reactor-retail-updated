<div class="block-wrapper">
    <div class="block">
        <div class="block-stories">
            <div class="stories-column-left">
                <% loop Children %>
                    <div class="story">
                        <div class="sotry-image-holder">
                            <img src="$StoryImage.URL" />
                        </div>
                        $StoryHeader
                        <div class="stories-content-holder">
                            <div class="stories-content-column-left">
                                $ContentColLeft
                            </div>
                            <div class="stories-content-column-right">
                                $ContentColRight
                            </div>
                        </div>
                        <div class="stories-column-left-separator"></div>
                    </div>
                <% end_loop %>
            </div>
            <div class="stories-column-right">
                <% loop getNewsItemsForStories %>
                    <div class="news" <% if Last %>style="background: url($ThemeDir/graphics/stories-content-right-separator.png) bottom repeat-x;"<% end_if %>>
                        <a name="news$ID"></a>
                        $Content
                        <% if $NewsImage %><img src="<% control NewsImage %>$SetWidth(260).URL<% end_control %>" /><% end_if %>
                    </div>
                <% end_loop %>
            </div>
        </div>
    </div>
</div>

<div class="block-wrapper">
    <div class="block" id="footer-container">
        $FooterContent
        $SiteConfig.SitewideFooterContent
    </div>
</div>