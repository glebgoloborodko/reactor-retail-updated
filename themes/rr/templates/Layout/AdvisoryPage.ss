<div class="block-wrapper">
    <div class="block" id="advisory-holder">
        <% loop Children %>
            <div class="block-advisory">
                <img src="$ThemeDir/graphics/advisory.png" />
                <div class="advisory-header-holder">
                    <div class="advisory-header-column-left">
                        $HeaderColLeft
                    </div>
                    <div class="advisory-header-column-right">
                        $HeaderColRight
                    </div>
                </div>
                <div class="advisory-content-holder">
                    <div class="advisory-column-left">
                        <img src="$ContentColLeft.URL" />
                    </div>
                    <div class="advisory-column-right">
                        $ContentColRight
                    </div>
                </div>
                <div class="advisory-small-content-holder">
                    $SmallContent
                </div>
                <div class="advisory-footer-holder">
                    <div class="advisory-footer-column-left">
                        $FooterColLeft
                    </div>
                    <div class="advisory-footer-column-right">
                        $FooterColRight
                    </div>
                </div>
                <div class="block-advisory-separator"></div>
            </div>
        <% end_loop %>
    </div>
</div>

<div class="block-wrapper">
    <div class="block" id="footer-container">
        $FooterContent
        $SiteConfig.SitewideFooterContent
    </div>
</div>