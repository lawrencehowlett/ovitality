<div class="blocks">
<% if $Blocks %>
    <% loop $Blocks %>
        <% if $ClassName == 'BlockPrice' %>
            <section class="BlockPrice">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="UpperCaseMe mb16">$Title</h4>
                            $Content
                        </div>
                    </div>
                    <div class="row">
                        <% loop $PriceTables %>
                            <div class="col-md-4 col-sm-6">
                                <div class="pricing-table pt-2 <% if $MultipleOf(2) %>boxed<% else_if $MultipleOf(3) %>emphasis<% end_if %> text-center">
                                    <h5 class="UpperCaseMe">$Title</h5>
                                    <span class="price">$Price</span>
                                    <% if $RedirectPage %>
                                        <a class="btn <% if $MultipleOf(3) %>btn-white<% else %>btn-filled<% end_if %> btn-lg" href="$RedirectPage.Link">$ButtonText</a>
                                    <% end_if %>
                                    <div class="text-left">
                                        $Content
                                    </div>
                                </div>
                            </div>
                        <% end_loop %>
                    </div>
                </div>
            </section>
        <% end_if %>

        <% if $ClassName == 'BlockTeam' %>
            <section class="BlockTeam">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="UpperCaseMe mb16">$Title</h4>
                            $Content
                        </div>
                    </div>
                    <div class="row">
                        <% loop $TeamMembers.Sort(SortOrder) %>
                            <div class="col-md-12 col-sm-12 mb40 mb-xs-24 p0">
                                <% if $MultipleOf(2) %>
                                    <div class="col-sm-6 mb64 mb-xs-24">
                                        <h5 class="UpperCaseMe mb0">$Title</h5>
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
                                        <h5 class="UpperCaseMe mb0">$Title</h5>
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
            <section class="BlockTab">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h4 class="UpperCaseMe mb80">$Title</h4>
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
            <section class="BlockVideo">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-sm-5 col-xs-12">
                            <h3 class="UpperCaseMe">$Title</h3>
                            $Content
                            <% if $RedirectPage %>
                                <a class="btn" href="$RedirectPage.Link">$ButtonText</a>
                            <% end_if %>
                        </div>
                        <div class="col-md-4 col-md-offset-1 col-sm-6 col-sm-offset-1 col-xs-12">
                            <% if $VideoURL %>
                                <div class="embed-video-container embed-responsive embed-responsive-16by9">
                                    <% if $VideoChannel == 'Youtube' %>
                                        <iframe src="$VideoURL" frameborder="0" allowfullscreen></iframe>
                                    <% end_if %>

                                    <% if $VideoChannel == 'Vimeo' %>
                                        <iframe class="embed-responsive-item" src="$VideoURL?badge=0&title=0&byline=0&title=0"></iframe>
                                    <% end_if %>
                                </div>
                            <% end_if %>
                        </div>
                    </div>
                </div>
            </section>        
        <% end_if %>        

        <% if $ClassName == 'BlockImage' %>
            <section class="BlockImage">
                <div class="container">
                    <div class="row">
                        <% if $Position == 'Left' %>
                            <div class="col-md-5 col-sm-5 mb-xs-24">
                                <img class="cast-shadow" alt="Screenshot" src="$Image.Link" />
                            </div>

                            <div class="col-md-7 col-sm-5">
                                <h3 class="UpperCaseMe">$Title</h3>
                                <div class="blockContent">$Content</div>
                                <% if $RedirectPage %>
                                    <a class="btn" href="$RedirectPage.Link">$ButtonText</a>
                                <% end_if %>
                            </div>
                        <% else %>
                            <div class="col-md-7 col-sm-5">
                                <h3 class="UpperCaseMe">$Title</h3>
                                <div class="blockContent">$Content</div>
                                <% if $RedirectPage %>
                                    <a class="btn" href="$RedirectPage.Link">$ButtonText</a>
                                <% end_if %>
                            </div>
                            <div class="col-md-5 col-sm-5 mb-xs-24">
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
            <section class="">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-5">
                            <h4 class="UpperCaseMe">$Title</h4>
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
            <section class="BlockAccordion">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="UpperCaseMe mb16">$Title</h4>
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
<section class="BlockCarousel">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="UpperCaseMe mb16">Scrolling Carousel</h4>
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
<section class="BlockGallery">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="UpperCaseMe mb16">$Title</h4>
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
            <section class="BlockText">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="UpperCaseMe mb16">$Title</h4>
                            $Content

                            <% if $RedirectPage %>
                                <a href="$RedirectPage.Link" class="btn">$ButtonText</a>
                            <% end_if %>
                        </div>
                    </div>                    
                </div>
            </section>
        <% end_if %>

        <% if $ClassName == 'BlockSpinningBanner' %>
            <section class="cover fullscreen image-slider slider-all-controls controls-inside">
                <ul class="slides">
                    <% loop $SpinningBanners %>
                        <li class="overlay image-bg bg-dark">
                            <div class="background-image-holder">
                                <img alt="image" class="background-image" src="<% loop Image %>$SetWidth(2400).URL<% end_loop %>" />
                            </div>
                            <div class="container v-align-transform">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <h1 class="mb40 mb-xs-16 large">$Title</h1>
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
                            <h2 class="UpperCaseMe mb8">$Title</h2>
                            <p class="lead mb0">$Content</p>
                        </div>
                    </div>
                </div>
            </section>        
        <% end_if %>

        <% if $ClassName == 'BlockActionBox' %>
            <section class="BlockActionBox">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12"> 
                            <h4 class="UpperCaseMe mb16">$Title</h4>
                        </div>
                    </div>
                    <div class="row">
                        <% loop $ActionBoxes %>
                            <div class="col-sm-4">
                                <div class="feature feature-2 bordered text-center">
                                    <% if ActionBoxImage %>
                                        <% loop ActionBoxImage %>
                                            <img src="$CroppedImage(400,400).URL" class="img-responsive ActionBoxImg">
                                        <% end_loop %>
                                    <% end_if %>
                                    <div class="text-center">
                                        <h5 class="UpperCaseMe">$Title</h5>
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
</div>