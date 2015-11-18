<section class="page-title page-title-4 bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="uppercase mb0">$Title</h3>
                <% if $Query %>
                   <p class="lead mb0">You searched for &quot;{$Query}&quot;</strong></p>
                <% end_if %>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <% if $Results %>
                    <% loop $Results %>
                        <div class="post-snippet mb64">
                            <div class="post-title">
                                <a href="#">
                                    <h4 class="inline-block">
                                        <% if $MenuTitle %>
                                            $MenuTitle
                                        <% else %>
                                            $Title
                                        <% end_if %>
                                    </h4>
                                </a>
                            </div>
                            <hr>
                            <p>$Content.LimitWordCountXML</p>
                            <a class="btn btn-sm" href="$Link" title="Read more about $Title">Read More</a>
                        </div>
                    <% end_loop %>

                    <% if $Results.MoreThanOnePage %>
                        <div class="text-center">
                            <ul class="pagination">

                                <% if $Results.NotFirstPage %>
                                    <li>
                                        <a href="$Results.PrevLink" title="View the next page" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <% end_if %>

                                <% loop $Results.Pages %>
                                    <li class="<% if $CurrentBool %>active<% end_if %>">
                                        <a href="$Link" title="View page number $PageNum">$PageNum</a>
                                    </li>
                                <% end_loop %>

                                <% if $Results.NotLastPage %>
                                    <li>
                                        <a href="$Results.NextLink" title="View the next page" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <% end_if %>

                            </ul>
                        </div>
                    <% end_if %>

                <% else %>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        Sorry, your search query did not return any results.
                    </div>                    
                <% end_if %>
            </div>
        </div>
    </div>
</section>