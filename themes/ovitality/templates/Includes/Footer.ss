<footer class="footer-2 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center mb64 mb-xs-24">
                <% if $SiteConfig.SocialMediaServices %>
                <ul class="list-inline social-list spread-children">
                    <% loop $SiteConfig.SocialMediaServices %>
                        <li>
                            <a href="$ExternalURL" title="$Title" target="_blank">
                                <% if $SocialMediaServices == 'Twitter' %>
                                    <i class="icon icon-sm ti-twitter-alt"></i>
                                <% end_if %>
                                <% if $SocialMediaServices == 'Facebook' %>
                                    <i class="icon icon-sm ti-facebook"></i>
                                <% end_if %>
                            </a>
                        </li>
                    <% end_loop %>
                </ul>
                <% end_if %>
            </div>
        </div>
    
        <div class="row fade-half">
            <div class="col-sm-12 text-center">
                <span>$SiteConfig.CopyrightText</span>
            </div>
        </div>
    </div>
    <a class="btn btn-sm fade-half back-to-top inner-link" href="#top">Top</a>
</footer>