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
                    <% if $VideoURL %>
                        <div class="embed-video-container embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{$VideoURL}?badge=0&title=0&byline=0&title=0"></iframe>
                        </div>
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