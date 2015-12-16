<section class="page-title page-title-4 bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="uppercase mb0">You've been invited to join a challenge</h3>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="embed-video-container embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{$Challenge.FeaturedVideo}?badge=0&title=0&byline=0&title=0"></iframe>
                </div>
                <div class="mt16">
                    $Challenge.Content
                </div>
            </div>
            <div class="col-sm-6 feature boxed text-center">
                <h4 class="uppercase">Invited by:</h4>

                <div class="feature bordered">
                    <div class="row">
                        <% if $Referrer.ProfileImage %>
                            <div class="col-md-6 col-sm-6 mb-xs-24 text-left">
                                <img src="$Referrer.ProfileImage.Link" alt="$Referrer.ProfileImage.Title" class="cast-shadow">
                            </div>
                        <% end_if %>
                        <div class="<% if $Referrer.ProfileImage %>col-md-6<% else %>col-md-12<% end_if %> text-left">
                            <h5 class="mb8">$Referrer.FullName</h5>
                            <a href="">$Referrer.Email</a><br>
                            $Referrer.Phone
                        </div>
                    </div>
                </div>

                <div class="feature bordered">
                    <h5>$Challenge.Title</h5>
                    <p>$Challenge.StartLabel $Challenge.StartDate.Format(jS M Y)</p>
                </div>

                <a href="{$Link}info" class="btn btn-lg btn-filled">Join the challenge</a>
            </div>
        </div>
    </div>
</section>