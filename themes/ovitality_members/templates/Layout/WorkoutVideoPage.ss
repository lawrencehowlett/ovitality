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
                <% loop $PaginatedVideos %>
                    <div class="col-sm-6 post-snippet masonry-item">
                        
                        <a href="$AbsoluteLink">
                            <img alt="Post Image" src="$FeaturedImage.Link" />
                        </a>

                        <div class="inner">
                            <a href="$AbsoluteLink">
                                <h5 class="mb0">$Title</h5>
                            </a>
                        </div>

                    </div>
                <% end_loop %>
            </div>

            <% if $PaginatedVideos.MoreThanOnePage %>
                <div class="row">
                    <div class="text-center">
                        <ul class="pagination">
                            <% if $PaginatedVideos.NotFirstPage %>
                                <li>
                                    <a href="$PaginatedVideos.PrevLink" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <% end_if %>

                            <% loop $PaginatedVideos.Pages %>
                                <li <% if $CurrentBool %>class="active"<% end_if %>>
                                    <a href="$Link">$PageNum</a>
                                </li>
                            <% end_loop %>

                            <% if $PaginatedVideos.NotLastPage %>
                                <li>
                                    <a href="$PaginatedVideos.NextLink" aria-label="Next">
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