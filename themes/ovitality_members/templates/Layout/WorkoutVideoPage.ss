<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>        
            <div class="col-md-10 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb0">
                        <% if $CurrentCategory %>
                            Category: $CurrentCategory.Title
                        <% else %>
                            $Title
                        <% end_if %>
                    </h3>
                    <hr>
                </div>
                <div class="col-md-12 mt16">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 pull-left">
                            <div class="select-option">
                                <i class="ti-angle-down"></i>
                                <select id="VideoCategorySelection">
                                    <option value="$Link">All Categories</option>
                                    <% loop $Categories %>
                                        <option value="$AbsoluteLink" <% if $ID == $Top.CurrentCategory.ID %>selected<% end_if %>>$Title</option>
                                    <% end_loop %>
                                </select>
                            </div>                        
                        </div>
                    </div>
                    <div class="row masonry masonryFlyIn mb40">
                        <% loop $PaginatedVideos %>
                            <div class="col-xs-6 col-sm-4 post-snippet masonry-item">
                                
                                <a href="$AbsoluteLink">
                                    <img alt="Post Image" src="$FeaturedImage.Link" />
                                </a>

                                <div class="inner">
                                    <a href="$AbsoluteLink">
                                        <h5 class="mb0 text-center">$Title</h5>
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
            </div>
        </div>
    </div>
</section>