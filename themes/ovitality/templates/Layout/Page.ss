<% if $Blocks %>
    <% loop $Blocks %>
        <% if $ClassName == 'BlockPrice' %>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h4 class="uppercase mb16">$Title</h4>
                            $Content
                        </div>
                    </div>
                    <div class="row">
                        <% loop $PriceTables %>
                            <div class="col-md-4 col-sm-6">
                                <div class="pricing-table pt-2 text-center <% if $MultipleOf(2) %>boxed<% else_if $MultipleOf(3) %>emphasis<% end_if %>">
                                    <h5 class="uppercase">$Title</h5>
                                    <span class="price">$Price</span>
                                    <% if $RedirectPage %>
                                        <a class="btn <% if $MultipleOf(3) %>btn-white<% else %>btn-filled<% end_if %> btn-lg" href="$RedirectPage.Link">$ButtonText</a>
                                    <% end_if %>

                                    $Content
                                </div>
                            </div>
                        <% end_loop %>
                    </div>
                </div>
            </section>
        <% end_if %>

        <% if $ClassName == 'BlockTeam' %>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h4 class="uppercase mb16">$Title</h4>
                            $Content
                        </div>
                    </div>
                    <div class="row">
                        <% loop $TeamMembers %>
                            <div class="col-md-12 col-sm-12 mb40 mb-xs-24 p0">
                                <% if $MultipleOf(2) %>
                                    <div class="col-sm-6 mb64 mb-xs-24">
                                        <h5 class="uppercase mb0">$Title</h5>
                                        <span class="inline-block mb40 mb-xs-24">$Position</span>
                                        $Content
                                    </div>

                                    <div class="col-sm-6 mb64 mb-xs-24">
                                        <img alt="$Image.Title" src="$Image.CroppedImage(577, 442).Link" />
                                    </div>
                                <% else %>
                                    <div class="col-sm-6 mb64 mb-xs-24">
                                        <img alt="$Image.Title" src="$Image.CroppedImage(577, 442).Link" />
                                    </div>
                                    <div class="col-sm-6 mb64 mb-xs-24">
                                        <h5 class="uppercase mb0">$Title</h5>
                                        <span class="inline-block mb40 mb-xs-24">$Position</span>
                                        $Content

                                    </div>
                                <% end_if %>
                            </div>
                        <% end_loop %>
                    </div>
                </div>
            </section>
        <% end_if %>

        <% if $ClassName == 'BlockTab' %>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 text-center">
                            <h4 class="uppercase mb80">$Title</h4>
                            <div class="tabbed-content icon-tabs">
                                <ul class="tabs">
                                    <% loop $Tabs %>
                                        <li class="<% if $First %>active<% end_if %>">
                                            <div class="tab-title">
                                                <% if $TabIcon %>
                                                    <i class="$TabIcon icon"></i>
                                                <% end_if %>
                                                <span>$Title</span>
                                            </div>
                                            <div class="tab-content">
                                                $Content
                                                <% if $RedirectPage %>
                                                    <a class="btn" href="$RedirectPage.Link">$ButtonText</a>
                                                <% end_if %>
                                            </div>
                                        </li>
                                    <% end_loop %>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>            
        <% end_if %>

        <% if $ClassName == 'BlockVideo' %>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-5 mb-xs-24">
                            <h3>$Title</h3>
                            $Content
                            <% if $RedirectPage %>
                                <a class="btn" href="$RedirectPage.Link">$ButtonText</a>
                            <% end_if %>
                        </div>
                        <div class="col-md-7 col-md-offset-1 col-sm-6 col-sm-offset-1 text-center">
                            <% if $VideoURL %>
                                <div class="embed-video-container embed-responsive embed-responsive-16by9">
                                    <iframe src="$VideoURL?badge=0&amp;title=0&amp;byline=0&amp;title=0" class="embed-responsive-item"></iframe>
                                </div>
                            <% end_if %>
                        </div>
                    </div>
                </div>
            </section>        
        <% end_if %>        

        <% if $ClassName == 'BlockImage' %>
            <section>
                <div class="container">
                    <div class="row v-align-children">
                        <% if $Position == 'Left' %>
                            <div class="col-md-7 col-sm-6 text-center mb-xs-24">
                                <img class="cast-shadow" alt="Screenshot" src="$Image.Link" />
                            </div>

                            <div class="col-md-4 col-md-offset-1 col-sm-5 col-sm-offset-1">
                                <h3>$Title</h3>
                                $Content
                                <% if $RedirectPage %>
                                    <a class="btn" href="$RedirectPage.Link">$ButtonText</a>
                                <% end_if %>
                            </div>
                        <% else %>
                            <div class="col-md-4 col-sm-5 mb-xs-24">
                                <h3>$Title</h3>
                                $Content
                                <% if $RedirectPage %>
                                    <a class="btn" href="$RedirectPage.Link">$ButtonText</a>
                                <% end_if %>
                            </div>
                            <div class="col-md-7 col-md-offset-1 col-sm-6 col-sm-offset-1 text-center">
                                <img class="cast-shadow" alt="Screenshot" src="$Image.Link" />
                            </div>
                        <% end_if %>
                    </div>
                </div>
            </section>            
        <% end_if %>

        <% if $ClassName == 'BlockMap' %>
            <section id="map" class="p0" style="height:320px;"></section>          
        <% end_if %>

        <% if $ClassName == 'BlockForm' %>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-5">
                            <h4 class="uppercase">$Title</h4>
                            $Content
                        </div>
                        <div class="col-sm-6 col-md-5 col-md-offset-1">
                            $Top.Content
                        </div>
                    </div>
                </div>
            </section>        
        <% end_if %>

        <% if $ClassName == 'BlockAccordion' %>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h4 class="uppercase mb16">$Title</h4>
                            $Content
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="accordion accordion-1">
                                <% loop $Accordions %>
                                    <li>
                                        <div class="title">
                                            <span>$Title</span>
                                        </div>
                                        <div class="content">
                                            $Content
                                        </div>
                                    </li>
                                <% end_loop %>
                            </ul>                            
                        </div>
                    </div>
                </div>
            </section>
        <% end_if %>

        <% if $ClassName == 'BlockCarousel' %>
<section>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h4 class="uppercase mb16">Scrolling Carousel</h4>
                            <p class="lead mb64">
                                Initialize a carousel using the '.logo-carousel' class.
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="logo-carousel">
                            <ul class="slides">
                                <% loop $Carousels %>
                                    <li>
                                        <a href="<% if $RedirectPage %>$RedirectPage.Link<% else %>javascript:void(0);<% end_if %>">
                                            <img alt="$Image.Title" src="$Image.Link" />
                                        </a>
                                    </li>
                                <% end_loop %>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        <% end_if %>

        <% if $ClassName == 'BlockGallery' %>
<section>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h4 class="uppercase mb16">$Title</h4>
                            $Content
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="lightbox-grid square-thumbs" data-gallery-title="Gallery">
                                <ul>
                                    <% loop $Images %>
                                        <li>
                                            <a href="$Image.Link" data-lightbox="true">
                                                <div class="background-image-holder">
                                                    <img alt="image" class="background-image" src="$Image.Link" />
                                                </div>
                                            </a>
                                        </li>
                                    <% end_loop %>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>            
        <% end_if %>

        <% if $ClassName == 'BlockText' %>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="uppercase mb16">$Title</h4>
                            $Content
                        </div>
                    </div>                    
                </div>
            </section>
        <% end_if %>

        <% if $ClassName == 'BlockSpinningBanner' %>
            <section class="pt0 pb0">
                <div class="slider-all-controls">
                    <ul class="slides">
                        <% loop $SpinningBanners %>
                            <li class="img-bg image-bg overlay pt240 pb240">
                                <div class="background-image-holder">
                                    <img alt="Background Image" class="background-image" src="$Image.CroppedImage(1080, 720).Link">
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h1 class="large">$Title</h1>
                                            $Description
                                            <% if $RedirectPage %>
                                                <a href="$RedirectPage.Link" class="btn">$RedirectButtonText</a>
                                            <% end_if %>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <% end_loop %>
                    </ul>
                </div>
            </section>        
        <% end_if %>

        <% if $ClassName == 'BlockBanner' %>
            <section class="page-title page-title-2 image-bg overlay parallax">
                <div class="background-image-holder fadeIn" style="transform: translate3d(0px, 0px, 0px); background-color: transparent; background-image: url($Image.Link); background-repeat: repeat; background-attachment: scroll; background-position: initial; background-clip: border-box; background-origin: padding-box; background-size: auto auto; top: -100px;">
                    <img src="$Image.Link" class="background-image" alt="Background Image" style="display: none;">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="uppercase mb8">$Title</h2>
                            <p class="lead mb0">$Content</p>
                        </div>
                    </div>
                </div>
            </section>        
        <% end_if %>

        <% if $ClassName == 'BlockActionBox' %>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h4 class="uppercase mb16">$Title</h4>
                        </div>
                    </div>
                    <div class="row">
                        <% loop $ActionBoxes %>
                            <div class="col-sm-4">
                                <div class="feature feature-2 bordered text-center">
                                    <div class="text-center">
                                        <h5 class="uppercase">$Title</h5>
                                    </div>
                                    $Content
                                    <% if $RedirectPage %>
                                        <a href="$RedirectPage.Link" class="btn btn-filled">$ButtonText</a>
                                    <% end_if %>
                                </div>
                            </div>
                        <% end_loop %>
                    </div>
                </div>
            </section>
        <% end_if %>

    <% end_loop %>
<% end_if %>