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
            <div class="col-md-9 mb-xs-24">
                <div class="post-snippet mb64">
                    <div class="image-slider slider-thumb-controls controls-inside">
                        <ul class="slides">
                            <% loop $GalleryImages %>
                                <li><img alt="Image" src="$Image.CroppedImage(1440, 960).Link" /></li>
                            <% end_loop %>
                        </ul>
                    </div>
                    <% if $RecipeCategories %>
                        <ul class="post-meta">
                            <li>
                                <i class="ti-view-list"></i>
                                <span>Categories
                                    <% loop $RecipeCategories %>
                                        <a href="$AbsoluteLink">$Title</a>
                                    <% end_loop %>
                                </span>
                            </li>
                        </ul>
                    <% end_if %>
                    $Content
                </div>
            </div>

            <div class="col-md-3 hidden-sm">
                <% if $Categories %>
                    <div class="widget">
                        <h6 class="title">Categories</h6>
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
    </div>
</section>