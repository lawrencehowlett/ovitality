<section class="page-title page-title-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="uppercase mb0">
                    <% if $CurrentCategory %>
                        Category: $CurrentCategory.Title
                    <% else %>
                        $Title
                    <% end_if %>
                </h3>
            </div>
        </div>
    </div>
</section>
<section class="bg-secondary">
    <div class="container">
        <div class="col-md-9">
            <div class="row masonry-loader">
                <div class="col-sm-12 text-center">
                    <div class="spinner"></div>
                </div>
            </div>
            <div class="row masonry masonryFlyIn mb40">
                <% loop $PaginatedRecipes %>
                    <div class="col-sm-6 post-snippet masonry-item">
                        
                        <a href="$AbsoluteLink">
                            <img alt="Post Image" src="$GalleryImages.First.Image.CroppedImage(800, 600).Link" />
                        </a>

                        <div class="inner">
                            <a href="$AbsoluteLink">
                                <h5 class="mb0">$Title</h5>
                            </a>
                        </div>

                    </div>
                <% end_loop %>
            </div>

            <% if $PaginatedRecipes.MoreThanOnePage %>
                <div class="row">
                    <div class="text-center">
                        <ul class="pagination">
                            <% if $PaginatedRecipes.NotFirstPage %>
                                <li>
                                    <a href="$PaginatedRecipes.PrevLink" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <% end_if %>

                            <% loop $PaginatedRecipes.Pages %>
                                <li <% if $CurrentBool %>class="active"<% end_if %>>
                                    <a href="$Link">$PageNum</a>
                                </li>
                            <% end_loop %>

                            <% if $PaginatedRecipes.NotLastPage %>
                                <li>
                                    <a href="$PaginatedRecipes.NextLink" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <% end_if %>
                        </ul>
                    </div>
                </div>
            <% end_if %>
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
</section>