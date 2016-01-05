<footer class="footer-1 bg-dark">
    <div class="container">
        <div class="row">
            <% if $SiteConfig.FooterMenus %>
                <% loop $SiteConfig.FooterMenus %>
                    <div class="col-md-4 col-sm-6">
                        <div class="widget">
                            <h6 class="title">$Title</h6>
                            <hr>
                            <% if $Pages %>
                                <ul class="link-list recent-posts">
                                    <% loop $Pages %>
                                        <li>
                                            <a href="$Page.Link" title="Go to $Title.XML">$Title.XML</a>
                                        </li>
                                    <% end_loop %>
                                </ul>
                            <% end_if %>
                        </div>
                    </div>
                <% end_loop %>
            <% end_if %>
            <div class="col-md-4 col-sm-6">
                 <div class="widget">
                     <h6 class="title">$SiteConfig.FooterContactTitle</h6>
                     <hr>
                    <% if $SiteConfig.SocialMediaServices %>
                        <ul class="list-inline social-list mb16">
                            <% loop $SiteConfig.SocialMediaServices %>
                                <li>
                                    <a href="$ExternalURL" title="$Title" target="_blank">
                                        <% if $SocialMediaServices == 'Twitter' %>
                                            <i class="ti-twitter-alt"></i>
                                        <% end_if %>
                                        <% if $SocialMediaServices == 'Facebook' %>
                                            <i class="ti-facebook"></i>
                                        <% end_if %>
                                    </a>
                                </li>
                            <% end_loop %>
                        </ul>                
                    <% end_if %>                     
                     <ul class="link-list recent-posts">
                        <% if $SiteConfig.Address %>
                            <li><i class="ti-marker"></i> $SiteConfig.Address</li>
                        <% end_if %>

                         <% if $SiteConfig.ContactNumber %>
                            <li><i class="ti-mobile"></i> $SiteConfig.ContactNumber</li>
                        <% end_if %>

                         <% if $SiteConfig.Email %>
                            <li><i class="ti-email"></i> <a href="email:$SiteConfig.Email">$SiteConfig.Email</a></li>
                        <% end_if %>

                         <li>$SiteConfig.FooterContactText</li>                         
                     </ul>
                 </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-left">
                <span class="sub">$SiteConfig.CopyrightText</span>
                <span class="sub">
                    <p>Responsive Web Design by <a href="http://www.newedge.co.uk" target="_blank">Newedge</a></p>
                </span>
            </div>
        </div>
    </div>
    <a class="btn btn-sm fade-half back-to-top inner-link" href="#top">Top</a>
</footer>