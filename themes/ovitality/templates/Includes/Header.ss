<!--<div class="nav-container">
    <a id="top"></a>
    <nav>
        <div class="nav-utility">
            <% if $SiteConfig.Address %>
                <div class="module left">
                    <i class="ti-location-arrow">&nbsp;</i>
                    <span class="sub">$SiteConfig.Address</span>
                </div>
            <% end_if %>

            <% if $SiteConfig.Email %>
                <div class="module left">
                    <i class="ti-email">&nbsp;</i>
                    <span class="sub"><a href="mailto:$SiteConfig.Email">$SiteConfig.Email</a></span>
                </div>
            <% end_if %>

            <div class="module right">
                <% if $CurrentUser %>
                    <a href="Security/logout" class="btn btn-sm hidden-xs hidden-sm hidden-md color-red">Sign Out</a>
                    <a href="#" class="btn btn-sm btn-filled">Go to your member area</a>
                <% else %>
                    <a href="Security/login" class="btn btn-sm hidden-xs hidden-sm hidden-md">Sign In</a>
                    <a href="#" class="btn btn-sm btn-filled">Sign Up</a>
                <% end_if %>
            </div>            

        </div>
        <div class="nav-bar">

            <% if $SiteConfig.Logo %>
                <div class="module left">
                    <a href="$BaseHref">
                        <img class="logo logo-dark" alt="Foundry" src="$SiteConfig.Logo.Link" />
                    </a>
                </div>
            <% end_if %>

            <div class="module widget-handle mobile-toggle right visible-sm visible-xs">
                <i class="ti-menu"></i>
            </div>
            <div class="module-group right">
                <div class="module left">
                    <% include Navigation %>
                </div>
                <% if $SearchForm %>
                    <div class="module widget-handle search-widget-handle left">
                        <div class="search">
                            <i class="ti-search"></i>
                            <span class="title">Search Site</span>
                        </div>
                        <div class="function">
                            $SearchForm
                        </div>
                    </div>
                <% end_if %>
            </div>
        </div>
    </nav>
</div>-->

<div class="nav-container">
    <nav class="nav-centered">
        <div class="nav-utility">

            <% if $SiteConfig.Address %>
                <div class="module left">
                    <i class="ti-location-arrow">&nbsp;</i>
                    <span class="sub">$SiteConfig.Address </span>
                </div>
            <% end_if %>

            <% if $SiteConfig.Email %>
                <div class="module left">
                    <i class="ti-email">&nbsp;</i>
                    <span class="sub"><a href="mailto:$SiteConfig.Email">$SiteConfig.Email</a></span>
                </div>
            <% end_if %>

            <div class="module right">
                <% if $CurrentUser %>
                    <a href="Security/logout" class="btn btn-sm hidden-xs hidden-sm hidden-md color-red">Sign Out</a>
                    <a href="#" class="btn btn-sm btn-filled">Go to your member area</a>
                <% else %>
                    <a href="Security/login" class="btn btn-sm hidden-xs hidden-sm hidden-md">Sign In</a>
                    <a href="$SignupPage.Link" title="Go to signup page" class="btn btn-sm btn-filled">$SignupPage.Title</a>
                <% end_if %>
            </div>            

        </div>
        <% if $SiteConfig.Logo %>
            <div class="text-center">
                 <a href="$BaseHref">
                    <img class="logo logo-dark" alt="$SiteConfig.Title" src="$SiteConfig.Logo.Link">
                </a>
            </div>
        <% end_if %>

        <div class="nav-bar text-center">
            <div class="module widget-handle mobile-toggle right visible-sm visible-xs">
                <i class="ti-menu"></i>
            </div>
            <div class="module-group text-left">
                <div class="module left">
                    <% include Navigation %>
                </div>

                <% if $SearchForm %>
                    <div class="module widget-handle search-widget-handle left">
                        <div class="search">
                            <i class="ti-search"></i>
                            <span class="title">Search Site</span>
                        </div>
                        <div class="function">
                            $SearchForm
                        </div>
                    </div>
                <% end_if %>
            </div>
        </div>
    </nav>
</div>