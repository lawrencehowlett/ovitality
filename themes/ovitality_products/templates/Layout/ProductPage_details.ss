<section class="page-title page-title-4 bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="uppercase mb0">$Title</h3>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="product-single">
                    <div class="row mb24 mb-xs-48">

                        <div class="col-md-5 col-sm-6">
                            <% if $CurrentProduct.GalleryImages %>
                                <div class="image-slider slider-thumb-controls controls-inside">
                                    <ul class="slides">
                                        <% loop $CurrentProduct.GalleryImages %>
                                            <li><img alt="$Image.Title" src="$Image.PaddedImage(600, 800).Link" /></li>
                                        <% end_loop %>
                                    </ul>
                                </div>
                            <% end_if %>
                        </div>

                        <div class="col-sm-6">
                            <div class="description">
                                <h4 class="uppercase">$CurrentProduct.Title</h4>
                                $CurrentProduct.Summary
                            </div>
                            <%-- <hr class="mb48 mb-xs-24">
                            <a href="$CurrentProduct.PurchaseLink" target="_blank" class="btn btn-sn btn-filled" title="Go purchase $CurrentProduct.Title">Buy</a> --%>
                        </div>
                    </div>
                    <!--end of row-->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="tabbed-content text-tabs">
                                <ul class="tabs">
                                    <li class="active">
                                        <div class="tab-title">
                                            <span>Description</span>
                                        </div>
                                        <div class="tab-content">
                                            $CurrentProduct.Content
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!--end of text tabs-->
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of product single-->
            </div>

            <div class="col-md-3 hidden-sm">
                <% if $Categories %>
                    <div class="widget">
                        <h6 class="title">Shop Categories</h6>
                        <hr>
                        <ul class="link-list">
                            <% loop $Categories %>
                                <li>
                                    <a href="$AbsoluteLink">$Title</a>
                                </li>
                            <% end_loop %>
                        </ul>
                    </div>
                <% end_if %>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>