<section class="page-title page-title-4 bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="uppercase mb8">
                    <% if $CurrentCategory %>
                        Category: $CurrentCategory.Title
                    <% else %>
                        $Title
                    <% end_if %>
                </h2>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row masonry">
                    <% if $PaginatedProducts.exists %>
                        <% loop $PaginatedProducts %>
                            <div class="col-md-4 col-sm-4 masonry-item col-xs-12">
                                <div class="image-tile outer-title text-center">
                                    <a href="$AbsoluteLink" title="Read more about $Title">
                                        <img alt="$Title" class="product-thumb" src="$GalleryImages.First.Image.PaddedImage(600, 800).Link" />
                                    </a>
                                    <div class="title text-left">
                                        <h5 class="mb0">$Title</h5>
                                        $Summary
                                        <a href="$AbsoluteLink" class="btn btn-sm">Read More</a>
                                        <a href="$PurchaseLink" class="btn btn-sm btn-filled" target="_blank">Buy</a>
                                    </div>
                                </div>
                            </div>
                        <% end_loop %>
                    <% end_if %>
                </div>

                <% if $PaginatedProducts.MoreThanOnePage %>
                    <div class="text-center mt40">
                        <ul class="pagination">
                            <% if $PaginatedProducts.NotFirstPage %>
                                <li>
                                    <a href="$PaginatedProducts.PrevLink" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <% end_if %>
                            
                            <% loop $PaginatedProducts.Pages %>
                                <li class="<% if $CurrentBool %>active<% end_if %>">
                                    <a href="$Link">$PageNum</a>
                                </li>
                            <% end_loop %>

                            <% if $PaginatedProducts.NotLastPage %>
                                <li>
                                    <a href="$PaginatedProducts.NextLink" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <% end_if %>

                        </ul>
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
                                <li><a href="$AbsoluteLink">$Title</a></li>
                            <% end_loop %>
                        </ul>
                    </div>
                <% end_if %>
            </div>

        </div>
    </div>
</section>