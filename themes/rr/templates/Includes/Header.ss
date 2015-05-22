<div class="block-wrapper" id="main-menu-container">
    <div class="block" id="main-menu">
        <% loop Menu(1) %>
            <a href="$Link" <% if Last %>style="padding: 0px 0px 0px 7px;"<% else_if First %>style="border-right: 2px solid #aca295; padding: 0px 9px 0px 0px;"<% else %>style="border-right: 2px solid #aca295; padding: 0px 9px 0px 7px;"<% end_if %>>$Title</a>
        <% end_loop %>
    </div>
</div>

<div class="block-wrapper" id="logo-container">
    <div class="block" id="logo" style="background: url('$SiteConfig.SitewideHeaderImage.URL') no-repeat top center;">
    </div>
</div>

<div class="block-wrapper">
    <div class="block" id="news-ticker">
        <div class="marquee">
            <% loop getNewsItemsForNewsTicker %>
                <a href="stories/#news$ID">$Title</a>
                <% if Last %><% else %> | <% end_if %>
            <% end_loop %>
        </div>
    </div>
</div>